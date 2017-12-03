<?php

    //IMPORTS
    require_once("../modulo/dbFunctions.php");
    require_once("../modulo/functions.php");
    require_once("../modulo/userDAO.php");
    require_once("../modulo/employeeDAO.php");
    require_once("../modulo/productDAO.php");
    ?>
      <script src="../js/useful.js"></script>
    <?php
    //**************************************************><

    //CONNECTING TO DB
    connectToDB();

    // CHECK IF MODE IS EQUALS SOME OPTIONS AVAILABLE BELOW, CASE IT IS SO GET DATA FROM SPECIFIC FIELDS
    if ($_GET["mode"] == "add" || $_GET["mode"] == "update" ) {

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
        if(!addItem($title, $price, $description, $details, $pictureObj, $subcategoryId, 0 ,$active)){
          ?>
          <script type="text/javascript">
            alert("Falha ao inserir novo item no Banco de Dados :("+error("31","PRODUCT_CONTROLLER"));
          </script>
          <?php
        }else{
          ?>
          <script type="text/javascript">
          window.location.href = "../cms/cmsShowProductItem.php";
          </script>
          <?php
        }

      }else if($_GET["mode"] == "update"){ // CHECK IF mode EQUALS update TO UPDATE ONE ITEM

        // UPDATE ITEM INTO DATABASE AND CHECK IF ITEM WAS UPDATED INTO DATABASE
        if (!updateItem(addslashes($_GET["id"]), $title, $price, $description, $details, $pictureObj, $subcategoryId, 0 ,$active)) {
          ?>
          <script type="text/javascript">
            alert("Falha ao atualizar o item no Banco de Dados :("+error("47","PRODUCT_CONTROLLER"));
          </script>
          <?php
        }else{
          ?>
          <script type="text/javascript">
          window.location.href = "../cms/cmsShowProductItem.php";
          </script>
          <?php
        }
      }

    // GET ONLY SOME FIELDS
  }else if($_GET["mode"] == "addNewCategory"){ // ADD NEW CATEGORY
        // GET CATEGORY INTO TEXT FIELD
        $newCatageory = $_POST["txtCategory"];

        // INSERT NEW ITEM INTO DB AND CHECK IF ITEM WAS INSERTED INTO DATABASE
        if (!addCategory($newCatageory)) {
        ?>
            <script type="text/javascript">
              alert("Falha ao inserir nova categoria no Banco de Dados :("+error("67","PRODUCT_CONTROLLER"));
              window.location.href = "../cms/cmsShowProductItem.php";
            </script>
        <?php
      }else{
      ?>
          <script type="text/javascript">
              window.location.href = "../cms/cmsShowProductItem.php";
          </script>
      <?php
      }

    }else if($_GET["mode"] == "addNewSubcategory"){ // ADD NEW SUBCATEGORY
      // GET SUBCATEGORY INTO TEXT FIELD
      $newSubcatagory = $_POST["txtSubcategory"];
      $category = $_POST["cbxCategory"];

      // INSERT NEW ITEM INTO DB AND CHECK IF ITEM WAS INSERTED INTO DATABASE
      if (!addSubcategory($category, $newSubcatagory)) {
      ?>
          <script type="text/javascript">
            alert("Falha ao inserir nova categoria no Banco de Dados :("+error("95","PRODUCT_CONTROLLER"));
            window.location.href = "../cms/cmsShowProductItem.php";
          </script>
      <?php
      }else{
      ?>
          <script type="text/javascript">
              window.location.href = "../cms/cmsShowProductItem.php";
          </script>
      <?php
      }

    }else if($_GET["mode"] == "deleteCategory"){

      // INSERT NEW ITEM INTO DB AND CHECK IF ITEM WAS INSERTED INTO DATABASE
      if (!deleteCategory($_POST["id"])) {
      ?>
          <script type="text/javascript">
            alert("Falha ao deletar a categoria no Banco de Dados :("+error("113","PRODUCT_CONTROLLER"));
            window.location.href = "../cms/cmsShowProductItem.php";
          </script>
      <?php
      }else{
      ?>
          <script type="text/javascript">
              window.location.href = "../cms/cmsShowProductItem.php";
          </script>
      <?php
      }

    }


?>
