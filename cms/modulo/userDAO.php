<?php

    function existsUser($username){
        $i = 0;

        $sql = "SELECT usuario FROM tbl_usuario WHERE usuario = '".$username."'";

        $query = mysql_query($sql);

        while($rs = mysql_fetch_array($query)){
            $i++;
        }

        if($i == 0){
            return false;
        }else{
            return true;
        }
    }

?>