<?php

    // IMPORTS
    require_once("../modulo/dbFunctions.php");
    // *******************

    // CONNECT TO DATABASE
    connectToDB();

    // FUNCTIONS

    function getPizzeriaTelephones(){
      $sql = "SELECT telefone FROM tbl_pizzaria ORDER BY RAND();";

      if ($query = mysql_query($sql)) {

          $telephones = array();

          while($telephone = mysql_fetch_assoc($query)){
            $telephones[] = $telephone;
          }

          return json_encode($telephones);
      }

    }

    function getLatitudeLongitude(){
      $sql = "SELECT latitude, longitude FROM tbl_endereco;";

      if ($query = mysql_query($sql)) {

        $addresses = array();

        while ($address = mysql_fetch_assoc($query)) {
          $addresses[] = $address;
        }

        return json_encode($addresses);

      }
    }

    // *****************************************************************************************************


    // CHECK IF METHOD IS GET FOR ALLOW USES THAT FUNCTONS
    /*
        SELECT.
    */
    if($_SERVER["REQUEST_METHOD"] == "GET"){

      // CHECK IF action VARIABLE EXISTS AND CHECK WHAT ACTION IT IS TO DO
      if (isset($_GET["action"])) {

        // KEEPING ACTION VALUE
        $action = $_GET["action"];


        if ($action == "getPizzeriaTelephones") {

            echo(getPizzeriaTelephones());

        }else if($action == "getLatitudeLongitude"){

            echo(getLatitudeLongitude());

        }else{
          echo("ERROR: ACTION NOT DEFINED");
        }

      }else {
        echo("ERROR: NOT FOUND ACTION AT URL");
      }


    }

?>
