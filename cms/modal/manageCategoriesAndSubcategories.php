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


					// CHECK IF CLICK WAS OVER DELETE BUTTON
					$(".deleteItem").click(function(){

              var itemId = $(this).data("id");

							$.ajax({
								type:"POST",
								url:"./controller/cmsAddProductItemController.php?mode=deleteCategory",
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
								<a href="#">
									<img src="../pictures/icons/edit-validated-icon256.png" title="Editar" alt="Editar este item">
								</a>

								<a data-id="<?php echo($item['idCategoria']);?>" class="deleteItem" href="#" onclick="return confirm('Tem certeza que gostaria de excluir esta categoria ?')">
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
								<a href="#">
									<img src="../pictures/icons/edit-validated-icon256.png" title="Editar" alt="Editar este item">
								</a>

								<a data-id="<?php echo($item['idSubategoria']);?>" class="deleteItem" href="#" onclick="return confirm('Tem certeza que gostaria de excluir esta categoria ?')">
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
