<?php
    //CONNECT TO DB pizzaria
    function connectToDB(){
        mysql_connect("localhost","root","bcd127");
        mysql_select_db("pizzaria");
    }
?>
