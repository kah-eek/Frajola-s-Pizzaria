<?php
    //IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/userDAO.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/employeeDAO.php");
    /* ***************************************** */

    //CONNECT TO DB
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

    //DELETING USER'S DATA
    if(isset($_GET["id"])){
        $sql = "DELETE FROM tbl_fale_conosco WHERE id_fale_conosco=".$_GET["id"];
        mysql_query($sql);
    }

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Frajola’s Pizzaria - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/cmsContactUsStyle.css">
        <link rel="shortcut icon" type="image x-icon" href="../pictures/logo/logo.png">
        <script src="js/modal.js"></script>
        <script src="js/jquery.js"></script>
    </head>
    <body>
        <!-- MODAL -->
        <script type="text/javascript">

            $(document).ready(function() {

              $(".show").click(function() {
                $(".modalContainer").slideToggle(2000);
                // slideToggle
                //toggle
                //FadeIn
              });

            });

        </script>

        <div class="modalContainer">
            <div class="modal">
            </div>
        </div>
        <!-- ***************************************************************************************************************** -->

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
        <form name="frmNavegationItems" action="cmsContactUs.php" method="post">
            <nav>
                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/Content128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">
                      <a href="../cms/cmsManageProducts.php">
                        Adm. Conteúdo
                      </a>
                    </div>
                </div>

                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/contactUs128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">
                        Adm. Fale Conosco
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
                <div id="sectionTitleBox">
                    <div class="infoLabel">
                        Nome
                    </div>

                    <div class="infoLabel">
                        E-mail
                    </div>

                    <div class="infoLabel">
                        Celular
                    </div>

                    <div class="infoLabel">
                        Sugestão/Critica
                    </div>

                    <div class="deleteDetailsIconBox">
                        Excluir / Detalhes
                    </div>
                </div>

                <div id="clientDataBox">
            <?php
                $sql=mysql_query("SELECT * FROM tbl_fale_conosco");

                while ($query = mysql_fetch_array($sql)){

                ?>

                <div id="dataTable">
                    <div class="clientsData">
                        <?php echo($query["nome"]); ?>
                    </div>

                    <div class="clientsData">
                        <?php echo($query["email"]); ?>
                    </div>

                    <div class="clientsData">
                        <?php echo($query["celular"]); ?>
                    </div>

                    <div class="clientsData">
                        <?php echo($query["sugestao_critica"]); ?>
                    </div>

                    <div class="deleteDetailsIconBox">
                        <a href="cmsContactUs.php?id=<?php echo($query["id_fale_conosco"]); ?>">
                            <img class="deleteDetailsIcon" src="../pictures/icons/delete-icon512.png" onclick="return confirm('Deseja excluir este item ?')" title="Editar" alt="Editar as informações deste cliente">
                        </a>

                        <a class="show" href="#" onclick="modal(<?php echo($query["id_fale_conosco"])?>, 'feedbackItem')">
                            <img class="deleteDetailsIcon" src="../pictures/icons/detailsView512x512.png" title="Detalhes" alt="Ver mais informações deste cliente">
                        </a>
                    </div>

                </div>
                <?php
                }
            ?>
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
