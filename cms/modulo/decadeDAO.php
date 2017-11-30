<?php

	function getDecadeCuriosityItems(){
		$sql = "SELECT itempg.idItemPagina, dcd.decada, itempg.titulo, itempg.imagemPrincipal, itempg.imagemFundo, itempg.descricao, itempg.ativo FROM tbl_item_curiosidade_decada AS itempg INNER JOIN tbl_decada AS dcd ON itempg.idDecada = dcd.idDecada;";

		return mysql_query($sql);
	}

	function getItem($itemId){
		$sql = "SELECT * FROM tbl_item_curiosidade_decada WHERE idItemPagina = ".$itemId.";";

		return mysql_query($sql);
	}

	function setStatus($itemId, $status){

		$sql = "UPDATE tbl_item_curiosidade_decada SET ativo = ".$status." WHERE idItemPagina = ".$itemId.";";

		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

	function deleteItem($itemId){
		$sql = "DELETE FROM tbl_item_curiosidade_decada WHERE idItemPagina = ".$itemId.";";

		if (mysql_query($sql)) {
			return true;
		}else{
			return false;
		}
	}

	function updateItem($itemId,$decadeId, $title, $mainImage, $backgroundImage, $description, $status){
        
        // DEFAULT VARIABLES
        $bgPictureMoved = false;
        $mainPictureMoved = false;
        /* ****************************** */


		// GETTING MAIN PICTURE'S NAME
		$mainPictureName = basename($mainImage["name"]);

		// GETTING BACKGROUND PICTURE'S NAME
		$bgPictureName = basename($backgroundImage["name"]);
        
        // SETTING PICTURE'S PATH TO BOTH PICTURES 
		$uploadPath = "../../pictures/decades/uploaded/";

		// CHECK IF TO UPDATE MAIN PICTURE
		if (empty($mainPictureName)) {// DOES'N NEED TO UPDATE MAIN PICTURE
            
			$mainPictureStatus = "noImg";

		}else{// NEEDS TO UPDATE MAIN PICTURE

			// VALIDATE MAIN PICTURE'S EXTENSION  (ALLOW png AND jpg)
			if (isValidExtension($mainPictureName,".jpg") || isValidExtension($mainPictureName, ".png")){

				// GETTING ONLYE MAIN PICTURE'S EXTENSION
				$mainArchiveExtension = getFileExtension($mainPictureName);

				// ENCRYPT DATA
				$mainPictureName = encryptPictureName($mainPictureName, $mainArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadMainPicture = $uploadPath.$mainPictureName;

				// MOVING FILE
				if (move_uploaded_file($mainImage["tmp_name"], $readyToUploadMainPicture)) {
					
					$mainPictureMoved = true;

				}else{

					$mainPictureMoved = false;
				?>
					<script type="text/javascript">
						alert("Falha ao enviar o arquivo! Por favor, tente novamente.");
					</script>
				<?php
				}
				
			}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS

				$mainPictureMoved = false;
			?>
				<script type="text/javascript">
					alert("Extensão inválida para a imagem principal :( \n\nExtensões válidas: jpg e png");
				</script>
			<?php
			}

		}


		// CHECK IF TO UPDATE BACKGROUND PICTURE
		if (empty($bgPictureName)) {
            
			$bgPictureStatus = "noImg";

		}else{// NEEDS TO UPDATE BACKGROUND PICTURE

			// VALIDATE BACKGROUND PICTURE'S EXTENSION  (ALLOW png AND jpg)
			if (isValidExtension($bgPictureName,".jpg") || isValidExtension($bgPictureName, ".png")){

				// GETTING ONLYE MAIN PICTURE'S EXTENSION
				$bgArchiveExtension = getFileExtension($bgPictureName);

				// ENCRYPT DATA
				$bgPictureName = encryptPictureName($bgPictureName, $bgArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadBgPicture = $uploadPath.$bgPictureName;

				// MOVING FILE
				if (move_uploaded_file($backgroundImage["tmp_name"], $readyToUploadBgPicture)) {
					
					$bgPictureMoved = true;

				}else{

					$bgPictureMoved = false;
				?>
					<script type="text/javascript">
						alert("Falha ao enviar o arquivo! Por favor, tente novamente.");
					</script>
				<?php
				}
				
			}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS

				$bgPictureMoved = false;
			?>
				<script type="text/javascript">
					alert("Extensão inválida para a imagem principal :( \n\nExtensões válidas: jpg e png");
				</script>
			<?php
			}


		}

		/* CHECK IF THE BOTH IMAGES WAS MOVED WITH SUCCESS AND SO UPDATE ITEM INTO DB
            *OBS.: UPDATE TWO IMAGES        
        */
		if ($bgPictureMoved == true && $mainPictureMoved == true && !isset($bgPictureStatus) && !isset($mainPictureStatus)) {
            
            // CHECK ITEM STATUS
            $status = transformStatusToDB($status);

            $sql = "UPDATE tbl_item_curiosidade_decada SET idDecada = ".$decadeId.", titulo = '".addslashes($title)."', imagemPrincipal = '".$readyToUploadMainPicture."', imagemFundo = '".$readyToUploadBgPicture."', descricao = '".addslashes($description)."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}
        /* CHECK IF THE BACKGROUND IMAGE WAS MOVED WITH SUCCESS AND SO UPDATE ITEM INTO DB
            *OBS.: UPDATE ONLY BACKGROUND IMAGE
        */
        else if($bgPictureMoved == true && isset($mainPictureStatus)){ 
            
			// CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "UPDATE tbl_item_curiosidade_decada SET idDecada = ".$decadeId.", titulo = '".addslashes($title)."', imagemFundo = '".$readyToUploadBgPicture."', descricao = '".addslashes($description)."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}
        /* CHECK IF THE MAIN IMAGE WAS MOVED WITH SUCCESS AND SO UPDATE ITEM INTO DB
            * OBS.: UPDATE ONLY MAIN PICTURE
        */
        else if($mainPictureMoved == true && isset($bgPictureStatus)){

			// CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "UPDATE tbl_item_curiosidade_decada SET idDecada = ".$decadeId.", titulo = '".addslashes($title)."', imagemPrincipal = '".$readyToUploadMainPicture."', descricao = '".addslashes($description)."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}	

		}
        /* CHECK IF THE NONE IMAGE WAS MOVED AND SO UPDATE ITEM INTO DB
            * OBS.: UPDATE NO PICTURE
        */
        else if(isset($bgPictureStatus) && isset($mainPictureStatus)){
            
            // CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "UPDATE tbl_item_curiosidade_decada SET idDecada = ".$decadeId.", titulo = '".addslashes($title)."', descricao = '".addslashes($description)."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
            
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}	
            
        }

	}

	function getDecades(){
		$sql = "SELECT * FROM tbl_decada;";

		return mysql_query($sql);
	}

	function addItem($title, $decade, $mainPicture, $bgPicture, $description, $status){
		
		// GETTING MAIN PICTURE'S NAME
		$mainArchiveName = basename($mainPicture["name"]);

		// GETTING BACKGROUND PICTURE'S NAME
		$bgArchiveName = basename($bgPicture["name"]);

		// SETTING PICTURE'S PATH TO BOTH PICTURES 
		$uploadPath = "../../pictures/decades/uploaded/"; 

		echo($mainArchiveName);


		// VALIDATE MAIN PICTURE'S EXTENSION  (ALLOW png AND jpg)
		if (isValidExtension($mainArchiveName,".jpg") || isValidExtension($mainArchiveName, ".png")){

			// GETTING ONLYE MAIN PICTURE'S EXTENSION
			$mainArchiveExtension = getFileExtension($mainArchiveName);

			// ENCRYPT DATA
			$mainArchiveName = encryptPictureName($mainArchiveName, $mainArchiveExtension);

			//READY TO UPLOAD IMAGE (path + archive name)
			$readyToUploadMainPicture = $uploadPath.$mainArchiveName;

			// MOVING FILE
			if (move_uploaded_file($mainPicture["tmp_name"], $readyToUploadMainPicture)) {
				
				$mainPictureStatus = true;

			}else{

				$mainPictureStatus = false;
			?>
				<script type="text/javascript">
					alert("Falha ao enviar o arquivo! Por favor, tente novamente. "+error("258", "DECADE_DAO"));
				</script>
			<?php
			}
			
		}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS
		?>
			<script type="text/javascript">
				alert("Extensão inválida para a imagem principal :( \n\nExtensões válidas: jpg e png"+error("266", "DECADE_DAO"));
			</script>
		<?php
			$mainPictureStatus = false;
		}



		// VALIDATE BACKGROUND PICTURE'S EXTENSION  (ALLOW png AND jpg)  IF MAIN PICTURE STATUS IS true
		if ($mainPictureStatus) {
			
			if (isValidExtension($bgArchiveName,".jpg") || isValidExtension($bgArchiveName, ".png")){
			// if (strstr($bgArchiveName,".jpg") || strstr($bgArchiveName, ".png")) {

				// GETTING ONLYE BACKGORUND PICTURE'S EXTENSION
				$bgArchiveExtension = getFileExtension($bgArchiveName);

				// ENCRYPT DATA
				$bgArchiveName = encryptPictureName($bgArchiveName, $bgArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadBgPicture = $uploadPath.$bgArchiveName;

				// MOVING FILE
				if (move_uploaded_file($bgPicture["tmp_name"], $readyToUploadBgPicture)) {
					
					$bgPictureStatus = true;

				}else{

					$bgPictureStatus = false;
				?>
					<script type="text/javascript">
						alert("Falha ao enviar o arquivo! Por favor, tente novamente. "+error("300", "DECADE_DAO"));
					</script>
				<?php
				}
				
			}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS

				$bgPictureStatus = false;
			?>
				<script type="text/javascript">
					alert("Extensão inválida para a imagem de fundo :( \n\nExtensões válidas: jpg e png"+error("310", "DECADE_DAO"));
				</script>
			<?php
			}

		}else{

			$bgPictureStatus = false;

		}



		// CHECK IF THE IMAGES WAS MOVED WITH SUCCESS AND SO INSERT A NEW ITEM INTO DB 
		if ($bgPictureStatus == true && $mainPictureStatus == true) {

			// CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "INSERT INTO tbl_item_curiosidade_decada (idDecada, titulo, imagemPrincipal, imagemFundo, descricao, ativo) VALUES(".$decade.",'".addslashes($title)."', '".$readyToUploadMainPicture."','".$readyToUploadBgPicture."','".addslashes($description)."', ".$status.");";
            
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}
		}else{ // RETURN INFORMATING THAT IMAGE DON'T WAS MOVED WITH SUCCESS BECAUSE IMAGE EXTENSION IS NOT ALLOW 
			return false;
			// return "no_img";
		}
	}
?>