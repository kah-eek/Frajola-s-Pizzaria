<?php
    //IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/employeeDAO.php");
    /* ************************************* */

    //CONNECTING TO DB
    connectToDB();

    //STARTING SESSION VARIABLES
    session_start();

    //GETTING EMPLOYEE'S DATA
    $employeesData = getEmployeeById($_SESSION["employeesId"]);

    // CHECK IF EXISTS LOGGED USER AND LEVEL IS ALLOW (ALLOW "administrador" AND "operador básico")
    if (!isset($_SESSION["employeesId"])) { // NOT EXISTS USER LOGGED

        header("location:../index.php");

    }else if(isset($_SESSION["employeesId"]) && strtolower($employeesData["privilegio"]) != "administrador" && strtolower($employeesData["privilegio"]) != "operador básico"){ // NOT LEVEL ALLOW

        header("location:../index.php");

    }

    //SETTING DATA INTO VARIABLES
    $employeesName = $employeesData["nome"];

    //CHECK IF btnLogout EXISTS
    if(isset($_POST["btnLogout"])){

        //LOGOUT AND RETURNS TO SITE HOME PAGE
        logout($_SESSION["employeesId"], "../index.php");

    }

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Frajola’s Pizzaria - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/cmsManageProductsStyle.css">
        <link rel="shortcut icon" type="image x-icon" href="../pictures/logo/logo.png">
    </head>
    <body>
        <!-- HEADER -->
        <header>
            <div id="headerTitle">
                <a href="./cmsHome.php">
                    CMS - Sistema de Gerenciamento do Site
                </a>
            </div>

            <div id="headerLogo">
                <a href="../index.php" target="_blank">
                    <img id="logo" src="../pictures/logo/logo.png" title="Frajola’s Pizzaria" alt="Logo da Frajola’s Pizzaria">
                </a>
            </div>
        </header>
        <!-- ***************************************************************************************************************** -->

        <!-- NAVEGATION -->
        <form name="frmNavegationItems" action="cmsHome.php" method="post">
            <nav>
                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/Content128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">
                        Adm. Conteúdo
                    </div>
                </div>

                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/contactUs128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">
                        <a href="./cmsContactUs.php">
                            Adm. Fale Conosco
                        </a>
                    </div>
                </div>

                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/products128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">
                      <a href="./cmsShowProductItem.php">
                          Adm. Produtos
                      </a>
                    </div>
                </div>

                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/users128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">
                        <a href="../cms/cmsShowUsers.php">
                            Adm. Usuários
                        </a>
                    </div>
                </div>

                <div id="welcomeBox">
                    <div id="welcomeField">
                        Bem-Vindo
                    </div>

                    <div id="welcomeFieldName">
                        <?php echo(strtoupper($employeesName)); ?>
                    </div>

                    <div id="btnLogoutBox">
                        <input id="btnLogout" type="submit" name="btnLogout" value="logout">
                    </div>
                </div>
            </nav>
        </form>
        <!-- ***************************************************************************************************************** -->

        <!-- MAIN CONTENT -->
        <div id="main">

            <!-- DECADE CURIOSITIES -->
            <div class="itemBox">
                <a href="./cmsShowDecadeItem.php">
                    <img src="../pictures/icons/grayOrangeDecades160x160.png" title="Curiosidades Anos 60, 70 e 80" alt="Curiosidades Anos 60, 70 e 80 (gerenciar)">
                    Curiosidades Anos 60, 70 e 80
                </a>
            </div>

            <!-- ABOUT US -->
            <div class="itemBox">
                <a href="./cmsShowAboutUsItem.php">
                    <img src="../pictures/icons/aboutUs.png" title="Sobre a Pizzaria" alt="Sobre a Pizzaria (gerenciar)">
                    Sobre a Pizzaria
                </a>
            </div>

            <!-- PROMOTIONS -->
            <div class="itemBox">
                <a href="./cmsShowPromotionItem.php">
                    <img src="../pictures/icons/promotions.png" title="Promoções" alt="Promoções (gerenciar)">
                    Promoções
                </a>
            </div>

            <!-- WHERE WE ARE -->
            <div class="itemBox">
                <a href="./cmsShowWhereWeAreItem.php">
                    <img src="../pictures/icons/ambients256x256.png" title="Nossos Ambientes" alt="Nossos Ambientes (gerenciar)">
                    Nossos Ambientes
                </a>
            </div>

            <!-- MONTH'S PIZZA -->
            <div class="itemBox">
                <a href="./cmsShowMonthsPizzaItem.php">
                    <img src="../pictures/icons/calendarAndPizza256x256.png" title="A Pizza do Mês " alt="A Pizza do Mês (gerenciar)">
                    A Pizza do Mês
                </a>
            </div>



        </div>
        <!-- ***************************************************************************************************************** -->

        <!-- FOOTER -->
        <footer>
            Desenvolvido por <strong>Caique M. Oliveira</strong>
        </footer>
        <!-- ***************************************************************************************************************** -->
    </body>
</html>
