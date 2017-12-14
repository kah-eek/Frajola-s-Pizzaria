<?php
  // IMPORTS
  require_once("../modulo/dbFunctions.php");
  require_once("../modulo/productDAO.php");
  // ************************

  // CONNECT TO DATABASE
  connectToDb();

?>
<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<title>Frajola’s Pizzaria - CMS</title>
    <link type="text/css" rel="stylesheet" href="./css/manageCategoryAndSubcategoryModalStyle.css">
    <meta charset="utf-8">
    <script src="./js/jquery.js"></script>
    <script src="./js/modal.js"></script>
	</head>
	<body>

			<script>
				$(document).ready(function(){


					// CHECK IF ITEM WAS CLICKED
					$(".deleteItem").click(function(){

              // GETTING DATA FROM ITEM
              var itemId = $(this).data("id"); // ID
              var itemTytpe = $(this).data("type");// IF IT IS CATEGORY OR SUBCATEGORY

              // CHECK IF IT IS TO DELETE CATEGORY OR SUBCATEGORY
              if(itemTytpe == "category"){ // DELETE CATEGORY
                var mode = "deleteCategory";

              }else if(itemTytpe == "subcategory"){ // DELETE SUBCATEGORY
                var mode = "deleteSubcategory";

              }

							$.ajax({
								type:"POST",
								url:"./controller/cmsAddProductItemController.php?mode="+mode,
								data:{id:itemId},
								async:true,
								success:function(dados){
									$(".modal").html(dados);
								}
							});
					});



          // CHECK IF ITEM WAS CLICKED
					$(".updateItem").click(function(){

              // GETTING DATA FROM ITEM
              var itemId = $(this).data("id"); // ID
              var itemTytpe = $(this).data("type");// IF IT IS CATEGORY OR SUBCATEGORY

              // CHECK IF IT IS TO UPDATE CATEGORY OR SUBCATEGORY
              if(itemTytpe == "category"){ // UPDATE CATEGORY
                var link = "addNewCategory.php?mode=updateCategory";

              }else if(itemTytpe == "subcategory"){ // UPDATE SUBCATEGORY
                var link = "addNewSubcategory.php?mode=updateSubcategory";

              }

              // RESET STYLE VALUES TO DEFAULT - MODAL
              $(".modal").attr({"style":"width: 500px; height 200px; background-color: #212121; transition: 2s; box-shadow:1px 1px 50px #FF6E40;"});

							$.ajax({
								type:"POST",
								url:"./modal/"+link,
								data:{id:itemId},
								async:true,
								success:function(dados){
									$(".modal").html(dados);
								}
							});
					});


				});
			</script>

			<!-- CATEGORIES -->
			<div class="categoryAndSubcategoryArea">

				<!-- BOX TITLE -->
				<div class="boxTitle">
					Categorias
				</div>

				<?php

					$size = getCategories();

					while($item = mysql_fetch_array($size)){
					?>
						<div class="categoryAndSubcategoryData">
							<div class="categoryTitle">
								<?php echo($item["categoria"]);?>
							</div>

							<div class="categoryAndSubcategoryActions">
								<a data-id="<?php echo($item['idCategoria']);?>" data-type="category" class="updateItem" href="#">
									<img src="../pictures/icons/edit-validated-icon256.png" title="Editar" alt="Editar este item">
								</a>

								<a data-id="<?php echo($item['idCategoria']);?>" data-type="category" class="deleteItem" href="#" onclick="return confirm('Tem certeza que gostaria de excluir esta categoria ?')">
									<img src="../pictures/icons/delete-icon512.png" title="Deletar" alt="Deletar este item">
								</a>
							</div>
						</div>
					<?php
					}
				?>
			</div>

			<!-- SUBCATEGORIES -->
			<div class="categoryAndSubcategoryArea">

				<!-- BOX TITLE -->
				<div class="boxTitle">
					Subcategorias
				</div>


        <?php

					$size = getAllSubcategories();

					while($item = mysql_fetch_array($size)){
					?>
						<div class="categoryAndSubcategoryData">
							<div class="categoryTitle">
								<?php echo($item["categoria"]."  -->  ".$item["subcategoria"]);?>
							</div>

							<div class="categoryAndSubcategoryActions">
								<a data-id="<?php echo($item['idSubcategoria']);?>" data-type="subcategory" class="updateItem" href="#">
									<img src="../pictures/icons/edit-validated-icon256.png" title="Editar" alt="Editar este item">
								</a>

								<a data-id="<?php echo($item['idSubategoria']);?>" data-type="subcategory" class="deleteItem" href="#" onclick="return confirm('Tem certeza que gostaria de excluir esta categoria ?')">
									<img src="../pictures/icons/delete-icon512.png" title="Deletar" alt="Deletar este item">
								</a>
							</div>
						</div>
					<?php
					}
				?>

			</div>
	</body>
</html>
