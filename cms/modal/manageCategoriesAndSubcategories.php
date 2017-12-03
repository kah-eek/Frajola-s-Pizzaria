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

			<script type="text/javascript">
				$(document).ready(function(){

					var itemId = $(".deleteItem").val();

					// CHECK IF CLICK WAS OVER DELETE BUTTON
					$(".deleteItem").click(function(){
							$.ajax({
								type:"POST",
								url:"../controller/cmsAddProductItemController.php?mode=deleteCategory",
								data:{id:itemId},
								async:true,
								success:function(dados){
									alert(dados);
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
									<img src="../pictures/icons/edit-validated-icon256.png" title="Deletar" alt="Deletar este item">
								</a>

								<a class="deleteItem" href="#id=<?php echo($item['idCategoria']);?>" onclick="return confirm('Tem certeza que gostaria de excluir esta categoria ?')">
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


			</div>
	</body>
</html>
