<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <title>Frajola’s Pizzaria - CMS</title>
    <link type="text/css" rel="stylesheet" href="./css/cmsShowProductItemModalStyle.css">
    <meta charset="utf-8">
    <script src="./js/jquery.js"></script>
    <script src="./js/modal.js"></script>
  </head>
  <body>

    <script type="text/javascript">

      $(document).ready(function(){

        // CLOSE MODAL WHEN CLOSE BUTTON WAS CLICKED
        $(".closeModal").click(function(){

          // RESET STYLE VALUES TO DEFAULT - MODAL
          $(".modal").attr({"style":"width: 500px; height 200px; background-color: #212121; transition-delay: 5s;"});

          // CLOSE MODAL CONTAINER
          $(".modalContainer").slideToggle(1500);
        });

        // OPEN MANAGEMENT CATEGORIES AND SUBCATEGORIES MODAL
        // $(".showCategoriesAndSubcategories").click(function(){
        //
        //   // CLOSE MAIN MODAL
        //   $(".modalContainer").slideToggle(1000);
        //
        //
        // });

        // OPEN ADD NEW CATEGORIES MODAL
        $(".addNewCategory").click(function(){

          // CLOSE BUTTONS' BOX
          $("#buttonsBox").slideToggle(1000);

          // OPEN ADD NEW CATEGORY BOX
          $(".categoryAndSubcategoryModalContainer").slideToggle(2000);
          // MOVE CLOSE BUTTON TO TOP
          $("#closeButtonArea").attr({"style":"margin-top: -200px; transition: 5s"});
        });


        // OPEN ADD NEW SUBCATEGORIES MODAL
        $(".addNewSubcategory").click(function(){

          // CLOSE BUTTONS' BOX
          $("#buttonsBox").slideToggle(1000);

          // OPEN ADD NEW SUBCATEGORY BOX
          $(".categoryAndSubcategoryModalContainer").slideToggle(2000);
          // MOVE CLOSE BUTTON TO TOP
          $("#closeButtonArea").attr({"style":"margin-top: -200px; transition: 5s"});
        });


        // OPEN MANAGE CATEGORY AND SUBCATEGORY MODAL
        $(".manageCategoriesAndSubcategories").click(function(){

          // CLOSE BUTTONS' BOX
          $("#buttonsBox").slideToggle(1000);

          // OPEN MANAGE CATEGORY AND SUBCATEGORY BOX
          $(".categoryAndSubcategoryModalContainer").slideToggle(2000);

          // SET POSITION AND COLOR FOR modal
          $(".modal").attr({"style":"height:600px; width: 800px; background-color: #cccccc"});

          // MOVE CLOSE BUTTON TO TOP
          $("#closeButtonArea").attr({"style":"margin-left: 765px; margin-top: -600px;"});
        });


      });

    </script>

    <div class="categoryAndSubcategoryModalContainer">
      <div class="categoryAndSubcategoryModal">

      </div>
    </div>

    <div id="closeButtonArea">
      <a class="closeModal" href="#">X</a>
    </div>

    <!-- BUTTONS BOX -->
    <div id="buttonsBox">

      <!-- MANAGE CATEGORIES AND SUBCATEGORIES -->
      <div class="button">
        <a class="manageCategoriesAndSubcategories" href="#" onclick="modal(-1, 'manageCategoriesAndSubcategories')">
          <img src="../pictures/icons/check_list_items_48dp.png" title="Gerenciar categorias e subcategorias">
        </a>
      </div>

      <!-- ADD NEW CATEGORY -->
      <div class="button">
        <a class="addNewCategory" href="#" onclick="modal(-1, 'addNewCategory')">
          <img src="../pictures/icons/add_list_item_48dp.png" title="Adicionar nova categoria" alt="Adicionar nova categoria">
        </a>
      </div>

      <!-- ADD NEW SUBCATEGORY -->
      <div class="button">
        <a class="addNewSubcategory" href="#" onclick="modal(-1, 'addNewSubcategory')">
          <img src="../pictures/icons/numbered_list_48dp.png" title="Adicionar nova subcategoria" alt="Adicionar nova subcategoria">
        </a>
      </div>

    </div>

  </body>
</html>
