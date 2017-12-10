<?php

	function getActiveItems(){
		$sql = "SELECT prt.idProduto, prt.titulo, prt.preco, prt.descricao, prt.detalhes, prt.imagemProduto, prt.idSubcategoria, subcategoria, sbc.idCategoria, categoria FROM tbl_produto AS prt
				INNER JOIN tbl_subcategoria AS sbc ON sbc.idSubcategoria = prt.idSubcategoria
				INNER JOIN tbl_categoria AS ctg ON sbc.idCategoria = ctg.idCategoria
				WHERE prt.ativo = 1 ORDER BY rand();";

		return mysql_query($sql);
	}

	function getSearch($text){
		$sql = "SELECT prt.idProduto, prt.titulo, prt.preco, prt.descricao, prt.detalhes, prt.imagemProduto, prt.idSubcategoria, subcategoria, sbc.idCategoria, categoria FROM tbl_produto AS prt
				INNER JOIN tbl_subcategoria AS sbc ON sbc.idSubcategoria = prt.idSubcategoria
				INNER JOIN tbl_categoria AS ctg ON sbc.idCategoria = ctg.idCategoria
				WHERE titulo LIKE '%".$text."%' OR categoria LIKE '%".$text."%' OR subcategoria LIKE '%".$text."%';";

		return mysql_query($sql);
	}

	function getCategories(){
		$sql = "SELECT * FROM tbl_categoria;";

		return mysql_query($sql);
	}

	function getSubcategoryById($categoryId){
		$sql = "SELECT * FROM tbl_subcategoria WHERE idCategoria = ".$categoryId.";";

		return mysql_query($sql);
	}

	function getSubcategoryInfoById($categoryId){
		$sql = "SELECT * FROM tbl_subcategoria WHERE idSubcategoria = $categoryId;";

		return mysql_query($sql);
	}

	function getSubcategories(){
		$sql = "SELECT * FROM tbl_subcategoria;";

		return mysql_query($sql);
	}

	function getItem($itemId){
		$sql = "SELECT prt.idProduto, prt.titulo, prt.preco, prt.descricao, prt.detalhes, prt.imagemProduto, prt.idSubcategoria, subcategoria, sbc.idCategoria, categoria FROM tbl_produto AS prt
				INNER JOIN tbl_subcategoria AS sbc ON sbc.idSubcategoria = prt.idSubcategoria
				INNER JOIN tbl_categoria AS ctg ON sbc.idCategoria = ctg.idCategoria
				WHERE prt.idProduto = ".$itemId.";";

		return mysql_query($sql);
	}

	function setClickOnItem($itemId, $tableFromDb){
		$sql = "UPDATE ".$tableFromDb." SET click = click+1 WHERE idProduto = ".$itemId.";";

		// IF QUERY WAS OK RETURN true, ELSE RETURN false
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}
?>
