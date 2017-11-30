<?php

	// IMPORTS
	require_once("../modulo/dbFunctions.php");
	require_once("../modulo/functions.php");
	require_once("../modulo/indexDAO.php");

	/* ************************* */

	// CONNECT TO DATABASE
	connectToDB();

	$item = mysql_fetch_array(getItem($_POST["id"]));
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Frajola’s Pizzaria</title>
		<link rel="stylesheet" type="text/css" href="./css/aboutProduct_IndexPageModalStyle.css">
		<meta charset="utf-8">
	</head>
	<body>

		<!-- COLSE MODAL WHEN CLOSE BUTTON WAS CLICKED -->
		<script type="text/javascript">
			$(document).ready(function(){
				$(".closeModal").click(function(){
					$(".modalContainer").slideToggle(1500);
				});
			});
		</script>

		<!-- MODEL CLOSE BUTTON -->
		<div id="closeModalBox">
			<a href="#" class="closeModal">X</a>
		</div>

		<div id="pictureAndTitleBox">
			<div id="pictureBox">
				<img src="<?php echo(cutPathNoEnd($item['imagemProduto'], 6)); ?>" title="<?php echo($item["titulo"]); ?>" align="<?php echo($item["titulo"]); ?>">
			</div>

			<div id="titleBox">
				<?php echo($item["titulo"]); ?>
			</div>
		</div>
		<!-- ******************************************** -->


		<!-- CATEGORY, SUBCATEGORY AND DESCRIPTION BOX -->
		<div id="categorySubcategoryAndDescription">
			
			<!-- CATEGORY -->
			<div class="dataBox">
				<?php echo($item["categoria"]); ?>
			</div>

			<!-- SUBCATEGORY -->
			<div class="dataBox">
				<?php echo($item["subcategoria"]); ?>
			</div>

			<!-- DESCRIPTION -->
			<div id="descriptionBox">
				<?php echo($item["descricao"]); ?>
			</div>
		</div>
		<!-- ******************************************** -->

		<!-- DETAILS -->
		<div id="detailsBox">
			<?php echo($item["detalhes"]); ?>
		</div>
		<!-- ******************************************** -->

	</body>
</html>