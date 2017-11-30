<?php
    
    //IMPORTS
    require_once("../modulo/dbFunctions.php");
    require_once("../modulo/functions.php");
    require_once("../modulo/userDAO.php");
    require_once("../modulo/employeeDAO.php");
    require_once("../modulo/promotionDAO.php");
    //**************************************************><

    //CONNECTING TO DB
    connectToDB();

    // CHECK IF MOTHOD IS EQUALS POST COMING VIEW PAGE
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // GETTING DATA FROM TEXT FIELDS
        $title = $_POST["txtTitle"];
        $picture = $_FILES["picture"];
        $description = $_POST["txtDescription"];
        $noPromotion = $_POST["txtNoPromotion"];
        $withPromotion = $_POST["txtWithPromotion"];
        $expiryDate = $_POST["txtExpiryDate"];
        $status = transformTitleToStatus($_GET["status"]);
        $mode = $_GET["mode"];
        

        // CHECK IF mode EQUALS add TO ADD NEW ITEM
        if ($mode == "add") {

            // INSERT NEW ITEM INTO DB AND CHECK IF ITEM WAS INSERTED INTO DB
            if(!addItem($title, $picture, $description, $noPromotion, $withPromotion, $expiryDate,$status)){
            ?>
                <script type="text/javascript">
                    alert("Falha ao inserir novo item no Banco de Dados :("+error("35","PROMOTION_CONTROLLER"));
                </script>
            <?php
            }else{
            ?>
                <script type="text/javascript">
                    window.location.href = "../cms/cmsShowPromotionItem.php";
                </script>
            <?php
            }

        }else if($mode == "update"){ // CHECK IF mode EQUALS update TO UPDATE ONE ITEM

            if (!updateItem($_GET["id"],$title, $picture, $description, $noPromotion, $withPromotion, $expiryDate, $status)) {
            ?>
                <script type="text/javascript">
                    alert("Falha ao atualizar o item no Banco de Dados :("+error("51","PROMOTION_CONTROLLER"));
                </script>
            <?php
            }else{
            ?>
                <script type="text/javascript">
                     window.location.href = "../cms/cmsShowPromotionItem.php";
                </script>
            <?php
            }
        }
        
    }

?>