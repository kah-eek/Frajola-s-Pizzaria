<?php
	
	function getItems(){
		$sql="SELECT * FROM tbl_fale_conosco;";

		return mysql_query($sql);
	}

	function getItemById($itemId){
		$sql = "SELECT * FROM tbl_fale_conosco WHERE id_fale_conosco = ".$itemId.";";

		return mysql_query($sql);
	}


?>