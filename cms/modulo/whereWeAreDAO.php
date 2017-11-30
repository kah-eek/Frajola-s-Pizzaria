<?php

	function setStatus($itemId, $status){

		$sql = "UPDATE tbl_item_estabelecimento SET ativo = ".$status." WHERE idItemPagina = ".$itemId.";";

		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

	function deleteItem($itemId){

		// GET ITEM FROM DB
		$item = mysql_fetch_array(getItemById($itemId));

		// DEFAULT VARIABLES
		$tblItemEstablishmentStatus = false;
		$tblPizzeriaStatus = false;
		$tblAddressStatus = false;
		/* ******************************** */

		// DELETE ITEM INTO ESTABLISHMENT-ITEM TABLE
		$sql = "DELETE FROM tbl_item_estabelecimento WHERE idItemPagina = ".$itemId.";";

		// CHECK IF QUERY WAS RUNNED INTO DB
		if (mysql_query($sql)) {
			$tblItemEstablishmentStatus = true;
		}
		/* ******************************************************************************* */


		// DELETE ITEM INTO PIZZERIA TABLE
		$sql = "DELETE FROM tbl_pizzaria WHERE idPizzaria = ".$item["idPizzaria"].";";

		// CHECK IF QUERY WAS RUNNED INTO DB
		if (mysql_query($sql)) {
			$tblPizzeriaStatus = true;
		}
		/* ******************************************************************************* */


		// DELETE ITEM INTO ADDRESS TABLE
		$sql = "DELETE FROM tbl_endereco WHERE idEndereco = ".$item["idEndereco"].";";

		// CHECK IF QUERY WAS RUNNED INTO DB
		if (mysql_query($sql)) {
			$tblAddressStatus = true;
		}
		/* ******************************************************************************* */

		// CHECK IF EVERYTHING WAS OK
		if ($tblItemEstablishmentStatus == true && $tblPizzeriaStatus == true && $tblAddressStatus == true) {
			return true;
		}else{
			return false;
		}

	}

	function getItemById($itemId){
		$sql = "SELECT istb.idItemPagina, pizr.telefone, istb.idPizzaria, istb.imagemEstabelecimento, istb.iconeBanda, istb.ativo, pizr.idEndereco, estd.idEstado, estd.estado, cdde.idCidade, cdde.cidade, endc.cep, endc.logradouro, endc.numero, endc.bairro, estd.uf FROM tbl_item_estabelecimento AS istb INNER JOIN tbl_pizzaria AS pizr ON istb.idPizzaria = pizr.idPizzaria INNER JOIN tbl_endereco AS endc ON endc.idEndereco = pizr.idEndereco INNER JOIN tbl_cidade AS cdde ON cdde.idCidade = endc.idCidade INNER JOIN tbl_estado AS estd ON estd.idEstado = cdde.idEstado WHERE idItemPagina = ".$itemId.";";

		return mysql_query($sql);
	}

	function getItems(){
		$sql = "SELECT istb.idItemPagina, pizr.telefone, istb.idPizzaria, istb.imagemEstabelecimento, istb.iconeBanda, istb.ativo, pizr.idEndereco, estd.idEstado, estd.estado, cdde.idCidade, cdde.cidade, endc.cep, endc.logradouro, endc.numero, endc.bairro, estd.uf FROM tbl_item_estabelecimento AS istb INNER JOIN tbl_pizzaria AS pizr ON istb.idPizzaria = pizr.idPizzaria INNER JOIN tbl_endereco AS endc ON endc.idEndereco = pizr.idEndereco INNER JOIN tbl_cidade AS cdde ON cdde.idCidade = endc.idCidade INNER JOIN tbl_estado AS estd ON estd.idEstado = cdde.idEstado;";

		return mysql_query($sql);
	}

	function getStates(){
		$sql ="SELECT * FROM tbl_estado;";

		return mysql_query($sql);
	}

	function getCities(){
		$sql ="SELECT * FROM tbl_cidade AS cdde INNER JOIN tbl_estado AS estd ON cdde.idEstado = estd.idEstado;";

		return mysql_query($sql);
	}

	function addAddressAndPizzeria($cityId, $zipCode, $street, $number, $neighborhood, $phone){

		// ADD ADDRESS INTO tbl_endereco AND SET ADDRESS STATUS (IF IT WAS ADDED)
		if(addAddress($cityId, $zipCode, $street, $number, $neighborhood)){
			$addAdressStatus = true;
		}else{
			$addAdressStatus = false;
		}

		// ADD PIZZERIA INTO tbl_pizzaria AND SET PIZZERIA STATUS (IF IT WAS ADDED)
		if(addPizzeria(getAddressIdByZipCodeAndNumber($zipCode, $number), $phone)){
			$addPizzeriaStatus = true;
		}else{
			$addPizzeriaStatus = false;
		}

		// CHECK IF BOTH STATUS IS EQUALS TRUE TO RETURN TRUE ELSE RETURN FALSE 
		if ($addAddressStatus == true && $addPizzeriaStatus == true) {
			return true;
		}else{
			return false;
		}

	}

	function updateAddressAndPizzeria($oldZipCode, $oldNumber, $cityId, $zipCode, $street, $number, $neighborhood, $phone, $itemId, $establishmentPictureObj, $bandIcon, $status){

		// GETTING ADDRESS' ID
		$addressId = getAddressIdByZipCodeAndNumber($oldZipCode, $oldNumber);

		// UPDATE ADDRESS INTO tbl_endereco AND SET UPDATED ADDRESS STATUS (IF IT WAS UPDATED)
		if(updateAddress($addressId, $cityId, $zipCode, $street, $number, $neighborhood)){
			$updatedAdressStatus = true;
		}else{
			$updatedAdressStatus = false;
		}

		// UPDATE PIZZERIA INTO tbl_pizzaria AND SET UPDATED PIZZERIA STATUS (IF IT WAS UPDATED)
		if(updatePizzeria(getPizzeriaIdByaddressId($addressId), $addressId, $phone)){
			$updatedPizzeriaStatus = true;
		}else{
			$updatedPizzeriaStatus = false;
		}

		// UPDATE PIZZERIA TEM INTO tbl_item_estabelecimento AND SET UPDATED ITEM STATUS (IF IT WAS UPDATED)
		if(updateItem($itemId, $addressId, $establishmentPictureObj, $bandIcon, $status)){
			$updatedItemStatus = true;
		}else{
			$updatedItemStatus = false;
		}

		

		// CHECK IF BOTH STATUS IS EQUALS TRUE TO RETURN TRUE ELSE RETURN FALSE 
		if ($updatedAdressStatus == true && $updatedPizzeriaStatus == true && $updatedItemStatus == true) {
			return true;
		}else{
			return false;
		}


	}
	
	function addPizzeria($addressId, $phone){
		
		$sql = "INSERT INTO tbl_pizzaria (idEndereco, telefone) VALUES(".$addressId.",'".$phone."')";
			
		if (mysql_query($sql)) {
			return true;
		}else{
			return false;
		}
	}

	function updatePizzeria($pizzeriaId, $addressId, $phone){
		$sql = "UPDATE tbl_pizzaria SET idEndereco = ".$addressId.", telefone = '".$phone."' WHERE idPizzaria = ".$pizzeriaId.";";

		if (mysql_query($sql)) {
			return true;
		}else{
			return false;
		}

	}

	function addAddress($cityId, $zipCode, $street, $number, $neighborhood){

		$sql = "INSERT INTO tbl_endereco (idCidade, cep, logradouro, numero, bairro) VALUES(".$cityId.", '".$zipCode."', '".addslashes($street)."', '".$number."', '".addslashes($neighborhood)."');";
			
		if (mysql_query($sql)) {
			return true;
		}else{
			return false;
		}

	}

	function updateAddress($addressId, $cityId, $zipCode, $street, $number, $neighborhood){
		$sql = "UPDATE tbl_endereco SET idCidade = ".$cityId.", cep = '".$zipCode."', logradouro = '".addslashes($street)."', numero = '".$number."', bairro = '".addslashes($neighborhood)."' WHERE idEndereco = ".$addressId.";";

		if (mysql_query($sql)) {
			return true;
		}else{
			return false;
		}

	}

	function getStateByCityId($cityId){
		$sql = "SELECT cdde.idEstado, estd.estado FROM tbl_cidade AS cdde INNER JOIN tbl_estado AS estd ON estd.idEstado = cdde.idEstado WHERE cdde.idCidade = ".$cityId.";";

		return mysql_query($sql);
	}

	function getAddressIdByZipCodeAndNumber($zipCode, $number){
		$sql = "SELECT idEndereco FROM tbl_endereco WHERE cep = '".$zipCode."' AND numero = '".$number."';";

		$rs = mysql_query($sql);

		$addressId = mysql_fetch_array($rs);

		return $addressId["idEndereco"];
	}

	function getPizzeriaIdByaddressId($addressId){
		$sql = "SELECT idPizzaria FROM tbl_pizzaria WHERE idEndereco = ".$addressId.";";

		$rs = mysql_query($sql);

		$pizzeriaId = mysql_fetch_array($rs);

		return $pizzeriaId["idPizzaria"];
	}

	function addItem($pizzeriaId, $establishmentPictureObj, $bandIcon, $status){

		// GETTING ESTABLISHMENT PICTURE'S NAME
		$establishmentArchiveName = basename($establishmentPictureObj["name"]);

		// GETTING BAND PICTURE'S NAME
		$bandArchiveName = basename($bandIcon["name"]);

		// SETTING PICTURE'S PATH TO BOTH PICTURES 
		$uploadPath = "../../pictures/whereWeAre/uploaded/"; 


		// VALIDATE ESTABLISHMENT PICTURE'S EXTENSION  (ALLOW png AND jpg)
		if (isValidExtension($establishmentArchiveName,".jpg") || isValidExtension($establishmentArchiveName, ".png")){

			// GETTING ONLYE ESTABLISHMENT PICTURE'S EXTENSION
			$estabishmentArchiveExtension = getFileExtension($establishmentArchiveName);

			// ENCRYPT DATA
			$establishmentArchiveName = encryptPictureName($establishmentArchiveName, $estabishmentArchiveExtension);

			//READY TO UPLOAD IMAGE (path + archive name)
			$readyToUploadEstablishmentPictureObj = $uploadPath.$establishmentArchiveName;

			// MOVING FILE
			if (move_uploaded_file($establishmentPictureObj["tmp_name"], $readyToUploadEstablishmentPictureObj)) {
				
				$establishmentPictureObjStatus = true;

			}else{

				$establishmentPictureObjStatus = false;
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
			$establishmentPictureObjStatus = false;
		}



		// VALIDATE BAND PICTURE'S EXTENSION  (ALLOW png AND jpg)  IF ESTABLISHMENT PICTURE STATUS IS true
		if ($establishmentPictureObjStatus) {
			
			if (isValidExtension($bandArchiveName,".jpg") || isValidExtension($bandArchiveName, ".png")){

				// GETTING ONLYE BACKGORUND PICTURE'S EXTENSION
				$bandArchiveExtension = getFileExtension($bandArchiveName);

				// ENCRYPT DATA
				$bandArchiveName = encryptPictureName($bandArchiveName, $bandArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadBandPicture = $uploadPath.$bandArchiveName;

				// MOVING FILE
				if (move_uploaded_file($bandIcon["tmp_name"], $readyToUploadBandPicture)) {
					
					$bandIconStatus = true;

				}else{

					$bandIconStatus = false;
				?>
					<script type="text/javascript">
						alert("Falha ao enviar o arquivo! Por favor, tente novamente.");
					</script>
				<?php
				}
				
			}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS

				$bandIconStatus = false;
			?>
				<script type="text/javascript">
					alert("Extensão inválida para a imagem de fundo :( \n\nExtensões válidas: jpg e png");
				</script>
			<?php
			}

		}else{

			$bandIconStatus = false;

		}



		// CHECK IF THE IMAGES WAS MOVED WITH SUCCESS AND SO INSERT A NEW ITEM INTO DB 
		if ($bandIconStatus == true && $establishmentPictureObjStatus == true) {

			// CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "INSERT INTO tbl_item_estabelecimento (idPizzaria, imagemEstabelecimento, iconeBanda, ativo) VALUES(".$pizzeriaId.", '".$readyToUploadEstablishmentPictureObj."','".$readyToUploadBandPicture."', ".$status.")";

			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}else{ // RETURN INFORMATING THAT IMAGE DON'T WAS MOVED WITH SUCCESS BECAUSE IMAGE EXTENSION IS NOT ALLOW 
			return "error_img";
		}

	}

	function updateItem($itemId, $addressId, $establishmentPictureObj, $bandIcon, $status){
        
        // DEFAULT VARIABLES
        $bandPictureMoved = false;
        $establishmentPictureMoved = false;
        /* ****************************** */


		// GETTING ESTABLISHMENT PICTURE'S NAME
		$establishmentArchiveName = basename($establishmentPictureObj["name"]);

		// GETTING BAND PICTURE'S NAME
		$bandArchiveName = basename($bandIcon["name"]);

		// SETTING PICTURE'S PATH TO BOTH PICTURES 
		$uploadPath = "../../pictures/whereWeAre/uploaded/"; 

		// CHECK IF TO UPDATE ESTABLISHMENT PICTURE
		if (empty($establishmentArchiveName)) {// DOES'N NEED TO UPDATE ESTABLISHMENT PICTURE
            
			$establishmentPictureStatus = "noImg";

		}else{// NEEDS TO UPDATE ESTABLISHMENT PICTURE

			// VALIDATE ESTABLISHMENT PICTURE'S EXTENSION  (ALLOW png AND jpg)
			if (isValidExtension($establishmentArchiveName,".jpg") || isValidExtension($establishmentArchiveName, ".png")){

				// GETTING ONLYE MAIN PICTURE'S EXTENSION
				$establishmentArchiveExtension = getFileExtension($establishmentArchiveName);

				// ENCRYPT DATA
				$establishmentArchiveName = encryptPictureName($establishmentArchiveName, $establishmentArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadEstablishmentPicture = $uploadPath.$establishmentArchiveName;

				// MOVING FILE
				if (move_uploaded_file($establishmentPictureObj["tmp_name"], $readyToUploadEstablishmentPicture)) {
					
					$establishmentPictureMoved = true;

				}else{

					$establishmentPictureMoved = false;
				?>
					<script type="text/javascript">
						alert("Falha ao enviar o arquivo! Por favor, tente novamente.");
					</script>
				<?php
				}
				
			}else{  // SHOW ALERT ABOUR PICTURE'S EXTENSIONS

				$establishmentPictureMoved = false;
			?>
				<script type="text/javascript">
					alert("Extensão inválida para a imagem principal :( \n\nExtensões válidas: jpg e png");
				</script>
			<?php
			}

		}


		// CHECK IF TO UPDATE BAND PICTURE
		if (empty($bandArchiveName)) {
            
			$bandPictureStatus = "noImg";

		}else{// NEEDS TO UPDATE BACKGROUND PICTURE

			// VALIDATE BAND PICTURE'S EXTENSION  (ALLOW png AND jpg)
			if (isValidExtension($bandArchiveName,".jpg") || isValidExtension($bandArchiveName, ".png")){

				// GETTING ONLYE BAND PICTURE'S EXTENSION
				$bandArchiveExtension = getFileExtension($bandArchiveName);

				// ENCRYPT DATA
				$bandArchiveName = encryptPictureName($bandArchiveName, $bandArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadBandPicture = $uploadPath.$bandArchiveName;

				// MOVING FILE
				if (move_uploaded_file($bandIcon["tmp_name"], $readyToUploadBandPicture)) {
					
					$bandPictureMoved = true;

				}else{

					$bandPictureMoved = false;
				?>
					<script type="text/javascript">
						alert("Falha ao enviar o arquivo! Por favor, tente novamente.");
					</script>
				<?php
				}
				
			}else{  // SHOW ALERT ABOUT PICTURE'S EXTENSIONS

				$bandPictureMoved = false;
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
		if ($bandPictureMoved == true && $establishmentPictureMoved == true && !isset($bandPictureStatus) && !isset($establishmentPictureStatus)) {
            
            // CHECK ITEM STATUS
            $status = transformStatusToDB($status);

            $sql = "UPDATE tbl_item_estabelecimento SET idPizzaria = ".getPizzeriaIdByaddressId($addressId).", imagemEstabelecimento = '".$readyToUploadEstablishmentPicture."', iconeBanda = '".$readyToUploadBandPicture."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}
        /* CHECK IF THE BAND IMAGE WAS MOVED WITH SUCCESS AND SO UPDATE ITEM INTO DB
            *OBS.: UPDATE ONLY BAND IMAGE
        */
        else if($bandPictureMoved == true && isset($establishmentPictureStatus)){ 
            
			// CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "UPDATE tbl_item_estabelecimento SET idPizzaria = ".getPizzeriaIdByaddressId($addressId).", iconeBanda = '".$readyToUploadBandPicture."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}
        /* CHECK IF THE ESTABLISHMENT IMAGE WAS MOVED WITH SUCCESS AND SO UPDATE ITEM INTO DB
            * OBS.: UPDATE ONLY ESTABLISHMENT PICTURE
        */
        else if($establishmentPictureMoved == true && isset($bandPictureStatus)){
        	
			// CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "UPDATE tbl_item_estabelecimento SET idPizzaria = ".getPizzeriaIdByaddressId($addressId).", imagemEstabelecimento = '".$readyToUploadEstablishmentPicture."', ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
			
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}	

		}
        /* CHECK IF THE NONE IMAGE WAS MOVED AND SO UPDATE ITEM INTO DB
            * OBS.: UPDATE NO PICTURE
        */
        else if(isset($bandPictureStatus) && isset($establishmentPictureStatus)){
            
            // CHECK ITEM STATUS
			$status = transformStatusToDB($status);

			$sql = "UPDATE tbl_item_estabelecimento SET idPizzaria = ".getPizzeriaIdByaddressId($addressId).", ativo = ".$status." WHERE idItemPagina = ".$itemId;";";
            
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}	
            
        }

	}

	function getAddress($addressId){
		$sql = "SELECT endc.idEndereco, endc.idCidade, endc.cep, endc.logradouro, endc.numero, endc.bairro, cdde.cidade, estd.estado FROM tbl_endereco AS endc INNER JOIN tbl_cidade AS cdde ON cdde.idCidade = endc.idCidade INNER JOIN tbl_estado AS estd ON estd.idEstado = cdde.idEstado WHERE endc.idEndereco = ".$addressId.";";

		$result = mysql_query($sql);

		$rs = mysql_fetch_array($result);

		return $rs; 
	}


	

?>