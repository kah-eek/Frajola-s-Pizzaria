<?php

	// IMPORTS
	require_once("../modulo/dbFunctions.php");
	require_once("../modulo/employeeDAO.php");
	require_once("../modulo/functions.php");
	/* ************************* */

	// CONNECT TO DB
	connectToDB();

	// GETTING ITEM FROM DB
	$employee = getEmployeeById($_POST["id"]);

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
						<?php echo($employee["nome"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						CELULAR
					</div>

					<div class="textField">
						<?php echo($employee["celular"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						TELEFONE
					</div>

					<div class="textField">
						<?php echo($employee["telefone"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						E-MAIL
					</div>

					<div class="textField">
						<?php echo($employee["email"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						SEXO
					</div>

					<div class="textField">
						<?php echo($employee["sexo"]); ?>
					</div>
				</div>

			</div>

			<!-- RIGHT BOX -->
			<div id="rightBox">

				<div class="textFieldAndLabel">
					<div class="label">
						CPF
					</div>

					<div class="textField">
						<?php echo($employee["cpf"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						DATA DE NASCIMENTO
					</div>

					<div class="textField">
						<?php echo(setDateFormat("user",$employee["dtNasc"])); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						SALÁRIO
					</div>

					<div class="textField">
						<?php echo($employee["salario"]); ?>
					</div>
				</div>

				<div class="textFieldAndLabel">
					<div class="label">
						ESTADO CIVIL
					</div>

					<div class="textField">
						<?php echo($employee["estado_civil"]); ?>
					</div>
				</div>

			</div>
		</div>

	</body>
</html>
