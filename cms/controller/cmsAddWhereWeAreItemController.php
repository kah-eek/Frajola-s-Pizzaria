<?php
    
    //IMPORTS
    require_once("../modulo/dbFunctions.php");
    require_once("../modulo/functions.php");
    require_once("../modulo/userDAO.php");
    require_once("../modulo/employeeDAO.php");
    require_once("../modulo/whereWeAreDAO.php");
    //**************************************************><

    //CONNECTING TO DB
    connectToDB();

    // CHECK IF MOTHOD IS EQUALS POST COMING VIEW PAGE
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // GETTING DATA FROM TEXT FIELDS
        $cityId = $_POST["cbxCity"];
        $zipCode = $_POST["txtZipCode"];
        $street = $_POST["txtStreet"];
        $number = $_POST["txtNumber"];
        $neighborhood = $_POST["txtNeighborhood"];
        $phone = $_POST["txtPhone"];
        $establishmentPicture = $_FILES["establishmentPicture"];
        $bandIcon = $_FILES["bandIcon"];

        $status = transformTitleToStatus($_GET["status"]);
        $mode = $_GET["mode"];        
        /* ********************************** */
        

        // CHECK IF mode EQUALS add TO ADD NEW ITEM
        if ($mode == "add") {

            // INSERT NEW ITEM INTO DB AND CHECK IF ITEM WAS INSERTED INTO DB
            if(!addAddressAndPizzeria($cityId, $zipCode, $street, $number, $neighborhood, $phone) && !addItem(getPizzeriaIdByAddressId(getAddressIdByZipCodeAndNumber($zipCode, $number)), $establishmentPicture, $bandIcon, $status)){
            ?>
                <script type="text/javascript">
                    alert("Falha ao inserir novo item no Banco de Dados :("+error("39","WHERE_WE_ARE_CONTROLLER"));
                </script>
            <?php
            }else{
            ?>
                <script type="text/javascript">
                    window.location.href = "../cms/cmsShowWhereWeAreItem.php";
                </script>
            <?php
            }

        }else if($mode == "update"){ // CHECK IF mode EQUALS update TO UPDATE ONE ITEM

            // SETTING OLD ADDRESS COMING FROM DB INTO VARIABLE 
            $oldAddress = getAddress($_GET["id"]);

            // TRY TO UPDATE ITEM INTO DB 
            if (!updateAddressAndPizzeria($oldAddress["cep"], $oldAddress["numero"], $cityId, $zipCode, $street, $number, $neighborhood, $phone, $_GET["id"], $establishmentPicture, $bandIcon, $status)){
            ?>
                <script type="text/javascript">
                alert("Falha ao atualizar o item no Banco de Dados :("+error("59","WHERE_WE_ARE_CONTROLLER"));
                </script>
            <?php
            }else{
            ?>
                <script type="text/javascript">
                     window.location.href = "../cms/cmsShowWhereWeAreItem.php";
                </script>
            <?php
            }

        }
        
    }

?>