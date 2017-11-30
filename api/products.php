<?php

    // IMPORTS 
    require_once("../modulo/dbFunctions.php");
    // *******************

    // CONNECT TO DATABASE;
    connectToDB();


    // DEFAULT VARIABLES
    $ERROR_MESSAGE = "ERROR: ";
    $success = false;



    // FUNCTION
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
            
            echo($ERROR_MESSAGE);
        }
    // ******************************************
    
    
    // CHECK IF METHOD IS GET FOR ALLOW USES THAT FUNCTONS
    /*
        SELECT;
        DELETE.
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
                
            }
            
            // DELETE A PRODUCT ACCORDING ID REPORTED
            else if($action == "delete"){
                    
                // CHECK IF EXISTS id AT URL
                if(isset($_GET["id"])){
                    echo($_GET["id"]);
                }else{
                    echo($ERROR_MESSAGE."DOESN'T EXISTS ID AT URL");
                }
            }
            
            
            
            
            
            
        }
        
    }

?>