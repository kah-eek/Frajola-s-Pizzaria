<?php

  // IMPORTS
  require_once("../modulo/productDAO.php");
  require_once("../modulo/dbFunctions.php");
  // *********************

  // CONNECT TO DATABASE
  connectToDB();

  // DEFAULT VALUE
  $rs = null;

  if(isset($_GET["mode"])){

    if ($_GET["mode"] == "updateCategory") {
      $query = getCategory($_POST["id"]);

      $rs = mysql_fetch_array($query);
    ?>
      <script>
        $("#addNewCategoryButton").attr({"value":"atualizar"});
      </script>
    <?php
    }

  }

?>
<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <title>Frajola’s Pizzaria - CMS</title>
    <link type="text/css" rel="stylesheet" href="./css/addNewCategoryStyle.css">
    <script src="./js/jquery.js"></script>
    <meta charset="utf-8">

    <script type="text/javascript">
      $(document).ready(function(){

        // INSERT NEW CATEGORY INTO DATABASE
        $("#frmAddNewCategory").submit(function(event){

          // REMOVE DEFAULT SUBMIT
          event.preventDefault();

          if ($("#addNewCategoryButton").val() == "atualizar") {

            $.ajax({
              type:"POST",
              url:"./controller/cmsAddProductItemController.php?mode=updateCategory",
              data: new FormData($("#frmAddNewCategory")[0]),
              processData: false,
              contentType: false,
              async:true,
              success: function(dados){
                $(".categoryAndSubcategoryModal").html(dados);
              }
            });

          }else{

            $.ajax({
              type:"POST",
              url:"./controller/cmsAddProductItemController.php?mode=addNewCategory",
              data: new FormData($("#frmAddNewCategory")[0]),
              processData: false,
              contentType: false,
              async:true,
              success: function(dados){
                $(".categoryAndSubcategoryModal").html(dados);
              }
            });

          }

        });

      });
    </script>

  </head>
  <body>

    <form id="frmAddNewCategory" name="frmAddNewCategory" method="POST">

        <!-- FIELDS' AND INPUTS' AREA -->
        <div id="fieldsAndInputsArea">

          <!-- FIRST BOX -->
          <div id="dividationBox1">
            <!-- TEXT FIELD -->
            <input  id="addNewCategoryTextField" required name="txtCategory" type="text" maxlength="80" placeholder="Título da Categoria" value="<?php echo($rs["categoria"]); ?>">
          </div>

          <!-- SECOND BOX -->
          <div id="dividationBox2">
            <!-- BUTTON -->
            <input id="addNewCategoryButton" name="btnAddNewCategory" type="submit" value="Cadastrar" >
          </div>

    </form>

    </div>
  </body>
</html>
