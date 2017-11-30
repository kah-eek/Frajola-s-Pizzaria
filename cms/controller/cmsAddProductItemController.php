<?php
    
    //IMPORTS
    require_once("../modulo/dbFunctions.php");
    require_once("../modulo/functions.php");
    require_once("../modulo/userDAO.php");
    require_once("../modulo/employeeDAO.php");
    require_once("../modulo/productDAO.php");
    //**************************************************><

    //CONNECTING TO DB
    connectToDB();

    // GETTING DATA FROM TEXT FIELDS
    $title = addslashes($_POST["txtTitle"]);
    $pictureObj = $_FILES["picture"];
    $description = addslashes($_POST["txtDescription"]);
    $price = addslashes($_POST["txtPrice"]);
    $details = addslashes($_POST["txtDetails"]);
    $subcategoryId = $_POST["cbxSubcategory"];
    $active = transformTitleToStatus($_GET["status"]);

    // CHECK IF IT IS TO ADD NEW PRODUCT
    if($_GET["mode"] == "add"){

        // INSERT NEW ITEM INTO DB AND CHECK IF ITEM WAS INSERTED INTO DB
        if(!addItem($title, $price, $description, $details, $pictureObj, $subcategoryId, $active)){
        ?>
            <script type="text/javascript">
                alert("Falha ao inserir novo item no Banco de Dados :("+error("31","PRODUCT_CONTROLLER"));
            </script>
        <?php
        }else{
        ?>
            <script type="text/javascript">
                // window.location.href = "../cms/cmsShowProductItem.php";
            </script>
        <?php
        }
        
    }else if($_GET["mode"] == "update"){ // CHECK IF mode EQUALS update TO UPDATE ONE ITEM

        if (!updateItem(addslashes($_GET["id"]), $title, $price, $description, $details, $pictureObj, $subcategoryId, $active)) {
        ?>
            <script type="text/javascript">
                alert("Falha ao atualizar o item no Banco de Dados :("+error("47","PRODUCT_CONTROLLER"));
            </script>
        <?php
        }else{
        ?>
            <script type="text/javascript">
                 // window.location.href = "../cms/cmsShowProductItem.php";
            </script>
        <?php
        }
    }

?>