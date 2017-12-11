<?php

    // IMPORTS
    require_once("../modulo/dbFunctions.php");
    // *******************

    // CONNECT TO DATABASE;
    connectToDB();


    // FUNCTIONS

    // GET ONLY ACTIVE PRODUCTS
    function getActiveProducts(){
        $sql = "SELECT * FROM view_mostrar_produtos WHERE ativo = 1;";

        // CHECK IF QUERY WAS OK
        if($query = mysql_query($sql)){


            //PRODUCT LIST
            $products = array();

            // LIST ALL PRODUCTS EXISTENTS INTO DATABASE
            while($item = mysql_fetch_assoc($query)){
                $products[] = $item;
            }

            return json_encode($products);
        }

        // CASE SOMETHING WRONG HAPPEN
        echo($ERROR_MESSAGE);
    }
    // ******************************************

    // SET EVALUATION TO PRODUCT
    function setEvaluate($itemId, $evaluation){
        $sql = "INSERT INTO tbl_avaliacao(idProduto, avaliacao) VALUES($itemId, $evaluation);";

        // CHECK IF UPDATE WAS OK
        if (mysql_query($sql)) {
          return "SUCCESS";
        }

        // CASE SOMETHING WRONG HAPPEN
        echo("ERROR: EVALUATION NOT SETTED");

    }
    // ******************************************


    // CHECK IF METHOD IS GET FOR ALLOW USES THAT FUNCTONS
    /*
        SELECT;
        INSERT.
    */
    if($_SERVER["REQUEST_METHOD"] == "GET"){

        // CHECK IF action VARIABLE EXISTS AND CHECK WHAT ACTION IT IS TO DO
        if(isset($_GET["action"])){

            // KEEPING ACTION VALUE
            $action = $_GET["action"];


            // SHOW ALL ACTIVE PRODUCTS
            if($action == "getActiveProducts"){

                // PRINT ONE JSON WITH ACTIVE PRODUCTS
                echo(getActiveProducts());

            }else if($action == "evaluate"){

              // CHECK IF EXISTS PRODUCT ID AT URL
              if (isset($_GET["id"]) && $_GET["id"] > 0) {

                // CHECK IF EXISTS PRODUCT EVALUTION VALUE AT URL
                if (isset($_GET["evaluation"]) && $_GET["evaluation"] >= 0 && $_GET["evaluation"] <= 5) {

                  // PRINT STATUS MESSAGE - SET EVALUATION ON PRODUCT
                  echo(setEvaluate($_GET["id"], $_GET["evaluation"]));

                }else {
                  echo("ERROR: EVALUATION VALUE NOT FOUND!".$_GET["evaluation"]);
                }


              }else {
                echo("ERROR: ID NOT FOUND!");
              }

            }else{
                echo("ERROR: ACTION NOT DEFINED");
            }

        }else{
          echo("ERROR: NOT FOUND ACTION AT URL");
        }

    }

?>
