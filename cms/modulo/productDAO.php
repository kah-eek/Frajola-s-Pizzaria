<?php

		function getItems(){
			$sql = "SELECT * FROM  view_mostrar_produtos;";

			return mysql_query($sql);
		}

		function getItem($itemId){
			$sql = "SELECT * FROM view_mostrar_produtos WHERE idProduto = $itemId;";

			return mysql_query($sql);
		}

		function getMarketingData($numberOfProducts){
			$sql = "SELECT * FROM view_analise_marketing_clicks LIMIT $numberOfProducts;";

			return mysql_query($sql);
		}

		function deleteCategory($categoryId){
			$sql = "DELETE FROM tbl_categoria WHERE idCategoria = $categoryId;";

			// CHECK IF DELETE WAS OK INTO DATABASE
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}

		}

		function deleteSubcategory($itemId){
			$sql = "DELETE FROM tbl_subcategoria WHERE idSubcategoria = $itemId;";

			// CHECK IF DELETE WAS OK INTO DATABASE
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}
		}

		function getMaxClicks(){
			$sql = "SELECT SUM(click) AS clicks FROM view_analise_marketing_clicks;";

			$result = mysql_query($sql);

			$clicks = mysql_fetch_array($result);

			return $clicks["clicks"];
		}

		function getClicksAverage(){
			$sqlStoredProcedure = "CALL sp_obter_media_click_produtos(@clicksAverage);";
			mysql_query($sqlStoredProcedure);

			$sqlResultSP = "SELECT TRUNCATE(@clicksAverage,2) AS media_clicks;";

			$result = mysql_query($sqlResultSP);

			$clicksAverage = mysql_fetch_array($result);

			return $clicksAverage["media_clicks"];
		}

		function getColumnChart($productClicksNumber){
			$sqlStoredProcedure = "CALL sp_obter_margem_click_produtos($productClicksNumber, @parcent);";
			mysql_query($sqlStoredProcedure);

			$sqlResultSP = "SELECT @parcent AS porcentagem";

			$result = mysql_query($sqlResultSP);

			$parcent = mysql_fetch_array($result);

			return $parcent["porcentagem"];
		}

		function deleteItem($itemId){
			$sql = "DELETE FROM tbl_produto WHERE idProduto = $itemId;";

			// CHECK IF DELETE WAS OK INTO DATABASE
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}
		}

		function updateCategory($categoryId, $category){
			$sql = "UPDATE tbl_categoria SET categoria = '$category' WHERE idCategoria = $categoryId;";

			// CHECK IF UPDATE WAS OK INTO DATABASE
			if (mysql_query($sql)) {
				return true;
			}else{
				return false;
			}
		}

		function getCategory($categoryId){
			$sql = "SELECT * FROM tbl_categoria;";

			return mysql_query($sql);
		}

		function getCategories(){
			$sql = "SELECT * FROM tbl_categoria;";

			return mysql_query($sql);
		}

		function getAllSubcategories(){
			$sql = "SELECT * FROM view_mostrar_subcategorias_e_categorias;";

			return mysql_query($sql);
		}

		function getSubcategories($categoryId){
			$sql = "SELECT * FROM tbl_subcategoria WHERE idCategoria = $categoryId;";

			return mysql_query($sql);
		}

		function addCategory($category){
			$sql = "INSERT INTO tbl_categoria (categoria) VALUES('$category');";

			// CHECK IF INSERT WAS OK INTO DATABASE
			if (mysql_query($sql)) {
				return true;
			}else {
				return false;
			}

		}

		function addSubcategory($categoryId, $subcategory){
				$sql = "INSERT INTO tbl_subcategoria (idCategoria, subcategoria) VALUES($categoryId, '$subcategory');";

				// CHECK IF INSERT WAS OK INTO DATABASE
				if (mysql_query($sql)) {
					return true;
				}else{
					return false;
				}
		}

		function addItem($title, $price, $description, $details, $pictureObj, $subcategoryId, $evaluation, $active){

			// GETTING PICTURE'S NAME
			$pictureName = basename($pictureObj["name"]);

			// SETTING PICTURE'S PATH
			$picturePath = "../../pictures/pizzas/products/";


			// VALIDATE PICTURE'S EXTENSION  (ALLOW png AND jpg)
			if (isValidExtension($pictureName, ".png") || isValidExtension($pictureName, ".jpg")) {

				// GETTING PICTURE'S EXTENSION
				$pictureArchiveExtension = getFileExtension($pictureName);

				// ENCRYPT DATA
				$picture = encryptPictureName($pictureName, $pictureArchiveExtension);

				//READY TO UPLOAD IMAGE (path + archive name)
				$readyToUploadPicture = $picturePath.$picture;

				// MOVING FILE
				if (move_uploaded_file($pictureObj["tmp_name"], $readyToUploadPicture)) { // IT WAS MOVED WITH SUCCESSS

					// SQL INSERT FOR RUN INTO DATABASE
					$sqlTblProduto = "INSERT INTO tbl_produto (titulo, preco, descricao, detalhes, imagemProduto, idSubcategoria, ativo) VALUES('$title', $price, '$description', '$details', '$readyToUploadPicture', $subcategoryId, $active);";

					// CHECK IF INSERT WAS OK - tbl_produto
					if(mysql_query($sqlTblProduto)){// IT IS OKAY

						$sqlTblAvaliacao = "INSERT INTO tbl_avaliacao (idProduto, avaliacao) VALUES(".mysql_insert_id().", $evaluation);";

						// CHECK IF INSERT WAS OK - tbl_avaliacao
						if (mysql_query($sqlTblAvaliacao)) {
							return true;
						}
					}else{// IT ISN'T OKAY
						return false;
					}


				}else{// IT WASN'T MOVED WITH SUCCESS
					return false;
				}

			}else{
				return false;
			}

		}


		function updateItem($itemId, $title, $price, $description, $details, $pictureObj, $subcategoryId, $evaluation, $active){

			// GETTING PICTURE'S NAME
			$pictureName = basename($pictureObj["name"]);

			// SETTING PICTURE'S PATH
			$picturePath = "../../pictures/pizzas/products/";

			// CHECK IF IT IS TO UPDATE PRODUCT IMAGE
			if (empty($pictureName)) {// IT ISN'T TO UPDATE

				// UPDATE ITEM BUT NOT UPDATES THE IMAGE
				$sqlTblProduto = "UPDATE tbl_produto SET titulo = '$title', preco = $price, descricao = '$description', detalhes = '$details', idSubcategoria = $subcategoryId, ativo = $active WHERE idProduto = $itemId;";
				$sqlTblAvaliacao = "UPDATE tbl_avaliacao SET avaliacao = $evaluation WHERE idProduto = $itemId;";

				// CHECK IF INSERT WAS OK
				if (mysql_query($sqlTblProduto) && mysql_query($sqlTblAvaliacao)) {
					return true;
				}else{
					return false;
				}
			}else{

				// VALIDATE PICTURE'S EXTENSION  (ALLOW png AND jpg)
				if (isValidExtension($pictureName, ".png") || isValidExtension($pictureName, ".jpg")) {

					// GETTING PICTURE'S EXTENSION
					$pictureArchiveExtension = getFileExtension($pictureName);

					// ENCRYPT DATA
					$picture = encryptPictureName($pictureName, $pictureArchiveExtension);

					//READY TO UPLOAD IMAGE (path + archive name)
					$readyToUploadPicture = $picturePath.$picture;

					// MOVING FILE
					if (move_uploaded_file($pictureObj["tmp_name"], $readyToUploadPicture)) {// IT WAS MOVED WITH SUCCESSS

						// UPDATE FULL ITEM
						$sqlTblProduto = "UPDATE tbl_produto SET titulo = '$title', preco = $price, descricao = '$description', detalhes = '$details', imagemProduto = '$readyToUploadPicture', idSubcategoria = $subcategoryId, ativo = $active WHERE idProduto = $itemId;";
						$sqlTblAvaliacao = "UPDATE tbl_avaliacao SET avaliacao = $evaluation WHERE idProduto = $itemId;";

						// CHECK IF INSERT WAS OK
						if (mysql_query($sqlTblProduto) && mysql_query($sqlTblAvaliacao)) {
							return true;
						}else{
							return false;
						}

					}else{// IT WASN'T MOVED WITH SUCCESS
						return false;
					}
				}

			}


		}

		function setStatus($itemId, $status){

		$sql = "UPDATE tbl_produto SET ativo = ".$status." WHERE idProduto = ".$itemId.";";

		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

?>
