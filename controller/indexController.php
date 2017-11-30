<?php
	//IMPORTS
    require_once("../modulo/dbFunctions.php");
    require_once("../modulo/indexDAO.php");
    require_once("../js/useful.js");
    //**************************************************><

    //CONNECTING TO DB
    connectToDB();

    // if ($_SERVER["RESQUEST_METHOD"] == "POST") {

        // MAKES SEARCH AND RETURN IT
        if (isset($_POST["text"])) {

        	// GETTING REQUIRED SEARCH 
        	return getSearch($text);

        }
        // ********************************************************

        // SET CLICK ON PRODUCT FOR STATISTICS
        if (isset($_POST["itemId"]) && isset($_POST["tableFromDb"])) {
            
            // CHECK IF UPDATE INTO DATABASE WAS OK
            if(!setClickOnItem($_POST["itemId"], $_POST["tableFromDb"])){
            ?>
                <script type="text/javascript">
                    alert("Ops!\n\nOcorreu uma falha desconhecida"+error(26, "indexController"));
                </script>
            <?php
            }            
        }
        // ********************************************************


    // }
	
?>