<?php
    
    //IMPORTS
    require_once("../modulo/dbFunctions.php");
    require_once("../modulo/functions.php");
    require_once("../modulo/userDAO.php");
    require_once("../modulo/employeeDAO.php");
    require_once("../modulo/decadeDAO.php");
    //**************************************************><

    //CONNECTING TO DB
    connectToDB();

    // CHECK IF MOTHOD IS EQUALS POST COMING VIEW PAGE
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // GETTING DATA FROM TEXT FIELDS
        $title = $_POST["txtTitle"];
        $decade = $_POST["cbxDecade"];
        $mainPicture = $_FILES["mainImage"];
        $bgPicture = $_FILES["bgImage"];
        $description = $_POST["txtDescription"];
        $status = transformTitleToStatus($_GET["status"]);
        $mode = $_GET["mode"];
        

        // CHECK IF mode EQUALS add TO ADD NEW ITEM
        if ($mode == "add") {

            // INSERT NEW ITEM INTO DB AND CHECK IF ITEM WAS INSERTED INTO DB
            if(!addItem($title, $decade, $mainPicture, $bgPicture, $description, $status)){
            ?>
                <script type="text/javascript">
                    alert("Falha ao inserir novo item no Banco de Dados :("+error("34","DECADE_CONTROLLER"));
                </script>
            <?php
            }else{
            ?>
                <script type="text/javascript">
                    window.location.href = "../cms/cmsShowDecadeItem.php";
                </script>
            <?php
            }

        }else if($mode == "update"){ // CHECK IF mode EQUALS update TO UPDATE ONE ITEM

            if (!updateItem($_GET["id"],$decade, $title, $mainPicture, $bgPicture, $description, $status)) {
            ?>
                <script type="text/javascript">
                    alert("Falha ao atualizar o item no Banco de Dados :("+error("50","DECADE_CONTROLLER"));
                </script>
            <?php
            }else{
            ?>
                <script type="text/javascript">
                     window.location.href = "../cms/cmsShowDecadeItem.php";
                </script>
            <?php
            }
        }
        
    }

?>