<?php


	function getItems(){
		$sql = "SELECT * FROM tbl_item_promocao;";

		return mysql_query($sql);
	}

	function setStatus($itemId, $status){

		$sql = "UPDATE tbl_item_promocao SET ativo = ".$status." WHERE idItemPagina = ".$itemId.";";

		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

	function deleteItem($itemId){
		$sql = "DELETE FROM tbl_item_promocao WHERE idItemPagina = ".$itemId.";";

		if (mysql_query($sql)) {
			return true;
		}else{
			return false;
		}
	}

	function getItem($itemId){
		$sql = "SELECT * FROM tbl_item_promocao WHERE idItemPagina = ".$itemId.";";

		return mysql_query($sql);
	}
	
	function addItem($title, $pictureObj, $description, $noPromotion, $withPromotion, $expiryDate,$status){
		
		// GETTING PICTURE'S NAME
		$picture= basename($pictureObj["name"]);

		// SETTING PICTURE'S PATH 
		$uploadPath = "../../pictures/aboutUs/uploaded/"; 


		// VALIDATE PICTURE'S EXTENSION  (ALLOW png AND jpg)
		if (isValidExtension($picture,".jpg") || isValidExtension($picture, ".png")){

			// GETTING PICTURE'S EXTENSION
			$pictureArchiveExtension = getFileExtension($picture);

			// ENCRYPT DATA
			$picture = encryptPictureName($picture, $pictureArchiveExtension);

			//READY TO UPLOAD IMAGE (path + archive name)
			$readyToUploadPicture = $uploadPath.$picture;

			// MOVING FILE
			if (move_uploaded_file($pictureObj["tmp_name"], $readyToUploadPicture)) {
				
				$pictureStatus = true;

			}else{

				$pictureStatus = false;
			?>
				<script type="text/javascript">
					alert("Falha ao enviar o arquivo! Por favor, tente novamente.");
				</script>
			<?php
			}
			
		}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS
		?>
			<script type="text/javascript">
				alert("Extensão inválida para a imagem principal :( \n\nExtensões válidas: jpg e png");
			</script>
		<?php
			$pictureStatus = false;
		}

		// CHECK IF THE IMAGE WAS MOVED WITH SUCCESS AND SO INSERT A NEW ITEM INTO DB 
		if ($pictureStatus == true) {

			// CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "INSERT INTO tbl_item_promocao (titulo, imagem, descricao, precoNaoPromocional, precoPromocional, dtValidade, ativo) VALUES('".addslashes($title)."','".$readyToUploadPicture."','".addslashes($description)."',".$noPromotion.",".$withPromotion.",'".setDateFormat("mysql", $expiryDate)."',".$status.");";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}
		}else{ // RETURN INFORMATING THAT IMAGE DON'T WAS MOVED WITH SUCCESS BECAUSE IMAGE EXTENSION IS NOT ALLOW 
			return "error_img";
		}
	}

	function updateItem($itemId,$title, $pictureObj, $description, $noPromotion, $withPromotion, $expiryDate, $status){
        
        // DEFAULT VARIABLES
        $pictureMoved = false;
        /* ****************************** */


		// GETTING PICTURE'S NAME
		$picture= basename($pictureObj["name"]);
        
        // SETTING PICTURE'S PATH 
		$uploadPath = "../../pictures/aboutUs/uploaded/"; 

		// CHECK IF TO UPDATE PICTURE
		if (empty($picture)) {// DOES'N NEED TO UPDATE PICTURE
            
			$pictureStatus = "noImg";

		}else{// NEEDS TO UPDATE PICTURE

			// VALIDATE PICTURE'S EXTENSION  (ALLOW png AND jpg)
			if (isValidExtension($picture,".jpg") || isValidExtension($picture, ".png")){

				// GETTING ONLYE PICTURE'S EXTENSION
				$pictureArchiveExtension = getFileExtension($picture);

				// ENCRYPT DATA
				$picture = encryptPictureName($picture, $pictureArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadPicture = $uploadPath.$picture;

				// MOVING FILE
				if (move_uploaded_file($pictureObj["tmp_name"], $readyToUploadPicture)) {
					
					$pictureMoved = true;

				}else{

					$pictureMoved = false;
				?>
					<script type="text/javascript">
						alert("Falha ao enviar o arquivo! Por favor, tente novamente.");
					</script>
				<?php
				}
				
			}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS

				$pictureMoved = false;
			?>
				<script type="text/javascript">
					alert("Extensão inválida para a imagem principal :( \n\nExtensões válidas: jpg e png");
				</script>
			<?php
			}

		}

		// CHECK IF THE IMAGE WAS MOVED WITH SUCCESS AND SO UPDATE ITEM INTO DB    
		if ($pictureMoved == true) {// UPDATE IMAGE
            
            // CHECK ITEM STATUS
            $status = transformStatusToDB($status);

            $sql = "UPDATE tbl_item_promocao SET titulo = '".addslashes($title)."', imagem = '".$readyToUploadPicture."', descricao = '".addslashes($description)."', precoNaoPromocional = ".$noPromotion.", precoPromocional = ".$withPromotion.", dtValidade = '".setDateFormat("mysql", $expiryDate)."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}else if(isset($pictureStatus)){// DO NOT UPDATE IMAGE

			// CHECK ITEM STATUS
            $status = transformStatusToDB($status);

            $sql = "UPDATE tbl_item_promocao SET titulo = '".addslashes($title)."', descricao = '".addslashes($description)."', precoNaoPromocional = ".$noPromotion.", precoPromocional = ".$withPromotion.", dtValidade = '".setDateFormat("mysql", $expiryDate)."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}

	}
?>