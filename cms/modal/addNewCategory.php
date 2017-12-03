<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <title>Frajola’s Pizzaria - CMS</title>
    <link type="text/css" rel="stylesheet" href="./css/addNewCategoryStyle.css">
    <meta charset="utf-8">

    <script type="text/javascript">
      $(document).ready(function(){

        // INSERT NEW CATEGORY INTO DATABASE
        $("#frmAddNewCategory").submit(function(event){

          // REMOVE DEFAULT SUBMIT
          event.preventDefault();

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
            <input  id="addNewCategoryTextField" required name="txtCategory" type="text" maxlength="80" placeholder="Título da Categoria">
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
