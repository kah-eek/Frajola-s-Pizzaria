<?php
  // IMPORTS
  require_once("../modulo/dbFunctions.php");
  require_once("../modulo/productDAO.php");
  // ************************

  // CONNECT TO DATABASE
  connectToDb();

  // GET CATEGORIES EXISTENTS INTO DATABASE
  // $categories =

?>
<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <title>Frajola’s Pizzaria - CMS</title>
    <link type="text/css" rel="stylesheet" href="./css/addNewSubcategoryStyle.css">
    <meta charset="utf-8">

    <script type="text/javascript">
      $(document).ready(function(){

        // INSERT NEW CATEGORY INTO DATABASE
        $("#frmAddNewSubcategory").submit(function(event){

          // REMOVE DEFAULT SUBMIT
          event.preventDefault();

          $.ajax({
            type:"POST",
            url:"./controller/cmsAddProductItemController.php?mode=addNewSubcategory",
            data: new FormData($("#frmAddNewSubcategory")[0]),
            processData: false,
            contentType: false,
            async:true,
            success: function(dados){
              $(".categoryAndSubcategoryModal").html(dados);
            }
          });

        });

      });
    </script>

  </head>
  <body>

    <form id="frmAddNewSubcategory" name="frmAddNewSubcategory" method="POST">

        <!-- FIELDS' AND INPUTS' AREA -->
        <div id="fieldsAndInputsArea">

          <!-- FIRST BOX -->
          <div id="dividationBox1">

            <!-- LOAD CATEGORIES EXISTENTS INTO DATABASE -->
            <select required name="cbxCategory">
                <option value="">SELECIONE</option>

                <?php
                  // GET CATEGORIES EXISTENTS INTO DATABASE
                  $size = getCategories();

                  // LOAD SUBCATEGORIES INTO COMBO BOX
                  while($category = mysql_fetch_array($size)){
                  ?>
                      <option value="<?php echo($category['idCategoria']); ?>"><?php echo($category["categoria"]); ?></option>
                  <?php
                  }
                ?>

            </select>
            <!-- ***************************************** -->

            <!-- TEXT FIELD -->
            <input  id="addNewSubcategoryTextField" required name="txtSubcategory" type="text" maxlength="50" placeholder="Título da Subcategoria">

          </div>

          <!-- SECOND BOX -->
          <div id="dividationBox2">
            <!-- BUTTON -->
            <input id="addNewSubcategoryButton" name="btnAddNewSubcategory" type="submit" value="Cadastrar" >
          </div>

    </form>

    </div>
  </body>
</html>
