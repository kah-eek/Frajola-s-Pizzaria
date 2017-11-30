<?php

	// IMPORTS
	require_once("../modulo/dbFunctions.php");
	require_once("../modulo/feedbackDAO.php");
	/* ************************* */

	// CONNECT TO DB
	connectToDB();

	// GETTING ITEM FROM DB
	$feedback = mysql_fetch_array(getItemById($_POST["id"]));

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Frajola’s Pizzaria - CMS</title>
		<script src="../js/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="./css/cmsContactUsModalStyle.css">
	</head>
	<body>

		<!-- COLSE MODAL WHEN CLOSE BUTTON WAS CLICKED -->
		<script type="text/javascript">
			$(document).ready(function(){
				$(".closeModal").click(function(){
					$(".modalContainer").slideToggle(1000);
				});
			});
		</script>

		<!-- MODEL CLOSE BUTTON -->
		<div id="closeModalBox">
			<a href="#" class="closeModal">X</a>
		</div>

		<!-- MAIN CONTENT -->
		<div id="mainContentBox">

			<!-- LEFT BOX -->
			<div id="leftBox">

				<div class="textFieldAndLabel">
					<div class="label">
						NOME
					</div>

					<div class="textField">
						<?php echo($feedback["nome"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						CELULAR
					</div>

					<div class="textField">
						<?php echo($feedback["celular"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						TELEFONE
					</div>

					<div class="textField">
						<?php echo($feedback["telefone"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						E-MAIL
					</div>

					<div class="textField">
						<?php echo($feedback["email"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						PROFISSÃO
					</div>

					<div class="textField">
						<?php echo($feedback["profissao"]); ?>
					</div>
				</div>

			</div>

			<!-- RIGHT BOX -->
			<div id="rightBox">

				<div class="textFieldAndLabel">
					<div class="label">
						HOME PAGE
					</div>

					<div class="textField">
						<?php echo($feedback["home_page"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						LINK NO FACEBOOK
					</div>

					<div class="textField">
						<?php echo($feedback["link_facebook"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						INFORMAÇÕES SOBRE O PRODUTO
					</div>

					<div class="textField">
						<?php echo($feedback["infos_produto"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						SUGESTÃO / CRÍTICA
					</div>

					<div class="textField">
						<?php echo($feedback["sugestao_critica"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						SEXO
					</div>

					<div class="textField">
						<?php echo($feedback["sexo"]); ?>
					</div>
				</div>

			</div>
		</div>

	</body>
</html>
