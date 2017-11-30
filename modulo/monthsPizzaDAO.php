<?php
	
	function getActiveItems(){
    	$sql = "SELECT * FROM tbl_item_pizza_mes WHERE ativo = 1";

    	return mysql_query($sql);
    }



?>