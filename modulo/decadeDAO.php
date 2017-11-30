<?php
    
    function getItems(){
        $sql = "SELECT * FROM tbl_item_curiosidade_decada AS icd INNER JOIN tbl_decada AS dc ON dc.idDecada = icd.idDecada  ;";
        
        return mysql_query($sql);
    }

    function getActiveItems(){
    	$sql = "SELECT * FROM tbl_item_curiosidade_decada AS icd INNER JOIN tbl_decada AS dc ON dc.idDecada = icd.idDecada WHERE ativo = 1";

    	return mysql_query($sql);
    }

    function getBackgroundPictures(){
    	$sql = "SELECT imagemFundo FROM tbl_item_curiosidade_decada;";

    	return mysql_query($sql);
    }
    

?>