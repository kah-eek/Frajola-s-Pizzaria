<?php

	function getActiveItems(){
    	$sql = "SELECT * FROM tbl_item_promocao WHERE ativo = 1";

    	return mysql_query($sql);
    }


?>