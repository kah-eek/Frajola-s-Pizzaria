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

    // CHECK IF EXISTS LOGGED USER
    if (!isset($_SESSION["employeesId"])) {

        header("location:../index.php");

    }

    //GETTING EMPLOYEE'S DATA
    $employeesData = getEmployeeById($_SESSION["employeesId"]);
    
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
        <link rel="stylesheet" type="text/css" href="css/cmsHomeStyle.css">
        <link rel="shortcut icon" type="image/x-icon" href="../pictures/logo/logo.png">
    </head>
    <body>
        <!-- HEADER -->
        <header>
            <div id="headerTitle">
                CMS - Sistema de Gerenciamento do Site
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

                        <?php
                            // CHECK ACCOUNT LEVEL (ALLOW "ADMINISTRADOR" OR "OPERADOR BÁSICO")
                            if (strtolower($employeesData["privilegio"]) == "administrador" || strtolower($employeesData["privilegio"]) == "operador básico") { // ALLOW BLOCK
                            ?>

                                <a href="./cmsManageProducts.php">
                                    Adm. Conteúdo
                                </a>

                            <?php
                            }else{ // NOT ALLOW BLOCK
                            ?>

                                Adm. Conteúdo

                            <?php
                            }
                        ?>

                    </div>                
                </div>

                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/contactUs128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">

                        <?php
                            // CHECK ACCOUNT LEVEL (ALLOW "ADMINISTRADOR" OR "OPERADOR BÁSICO")
                            if (strtolower($employeesData["privilegio"]) == "administrador" || strtolower($employeesData["privilegio"]) == "operador básico") { // ALLOW BLOCK
                            ?>

                                <a href="./cmsContactUs.php">
                                    Adm. Fale Conosco
                                </a>

                            <?php
                            }else{ // NOT ALLOW BLOCK
                            ?>

                                Adm. Fale Conosco

                            <?php
                            }
                        ?>
                        
                    </div>                
                </div>

                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/products128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">

                        <?php
                            // CHECK ACCOUNT LEVEL (ALLOW "ADMINISTRADOR" OR "CATALOGUISTA")
                            if (strtolower($employeesData["privilegio"]) == "administrador" || strtolower($employeesData["privilegio"]) == "cataloguista") { // ALLOW BLOCK
                            ?>

                                <a href="./cmsShowProductItem.php">
                                    Adm. Produtos
                                </a>

                            <?php
                            }else{ // NOT ALLOW BLOCK
                            ?>

                                Adm. Produtos

                            <?php
                            }
                        ?>
                        
                    </div>                
                </div>

                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/users128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">

                        <?php
                            // CHECK ACCOUNT LEVEL (ALLOW "ADMINISTRADOR" OR "OPERADOR BÁSICO")
                            if (strtolower($employeesData["privilegio"]) == "administrador" || strtolower($employeesData["privilegio"]) == "operador básico") { // ALLOW BLOCK
                            ?>

                                <a href="../cms/cmsShowUsers.php">
                                    Adm. Usuários
                                </a>

                            <?php
                            }else{ // NOT ALLOW BLOCK
                            ?>

                                Adm. Usuários

                            <?php
                            }
                        ?>
                        
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
            após selecionar um item para gerenciar, os dados aparecerão aqui ;)
        </div>
        <!-- ***************************************************************************************************************** -->

        <!-- FOOTER -->
        <footer>
            Desenvolvido por <strong>Caique M. Oliveira</strong>
        </footer>
        <!-- ***************************************************************************************************************** -->
    </body>
</html>