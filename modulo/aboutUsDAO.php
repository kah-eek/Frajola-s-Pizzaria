<?php

	function getActiveItems(){
    	$sql = "SELECT * FROM tbl_item_sobre_pizzaria WHERE ativo = 1";

    	return mysql_query($sql);
    }


?>