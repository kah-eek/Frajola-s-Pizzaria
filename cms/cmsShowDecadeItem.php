<?php
    //IMPORT CONNECTION TO DB MODULE
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/userDAO.php");
    require_once("./modulo/employeeDAO.php");
    require_once("./modulo/decadeDAO.php");
    //**************************************************><

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
    // $employeesCellphone = $employeesData["celular"];
    // $employeesEmail = $employeesData["email"];
    // $employeesTelephone = $employeesData["telefone"];
    // $employeesUsername = $employeesData["usuario"];
    // $employeesPassword = $employeesData["senha"];
    // $employeesCpf = $employeesData["cpf"];
    // $employeesBirthDate = $employeesData["dtNasc"];
    // $employeesSalary = $employeesData["salario"];
    // $employeesPrivilege = $employeesData["privilegio"];
    // $employeesMaritalStatus = $employeesData["estado_civil"];


    //CHECK IF btnLogout EXISTS
    if(isset($_POST["btnLogout"])){

        //LOGOUT AND RETURNS TO SITE HOME PAGE
        logout($_SESSION["employeesId"], "../index.php");
    }

    // CHECK IF IS TO ALTER ITEM'S STATUS
    if (isset($_GET["active"])) {
        $active = $_GET["active"];

        // ENABLE ITEM
        if ($active == "true") {
            setStatus($_GET["id"], 1);
            header("location:cmsShowDecadeItem.php");

        }
        // DISABLE ITEM
        else if($active == "false"){
            setStatus($_GET["id"], 0);
            header("location:cmsShowDecadeItem.php");
        }
    }

    // CHECK IF IS TO DELETE ITEM
    if(isset($_GET["mode"])){
        $mode = $_GET["mode"];

        if ($mode == "delete") {
            deleteItem($_GET["id"]);
            header("location:cmsShowDecadeItem.php");
        }
    }

?>
<!DOCTYPE HTML>
<html lang="pt">
    <head>
        <title>Frajola’s Pizzaria - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/cmsShowDecadeItem.css">
        <link rel="shortcut icon" type="image x-icon" href="../pictures/logo/logo.png">
    </head>
    <body>
        <!-- HEADER -->
        <header>
            <div id="headerTitle">
                <a href="../cms/cmsHome.php">
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
        <form name="frmNavigatioItems" method="post" action="cmsShowUsers.php">
            <nav>
                <div class="sectionItem">
                    <div class="sectionItemImgBox">
                        <img class="sectionItemImg" src="../pictures/icons/Content128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                    </div>

                    <div class="sectionItemLabelBox">
                        <a href="./cmsManageProducts.php">
                            Adm. Conteúdo
                        </a>
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
            <!-- SHOW TABLE WITH DATA (IMAGE, TITLE, DESCRIPTION, ACTIVE STATUS)-->
            <div id="showDecadeItemsBox">

                <div id="itemLabelBox">

                    <div class="itemLabel">
                        Imagem
                    </div>

                    <div class="itemLabel">
                        Título
                    </div>

                    <div class="itemLabel">
                        Descrição
                    </div>

                    <div class="itemLabel">
                        Statu
                    </div>
                </div>

                <?php

                //GETTING DECADES' CURIOSITY ITEMS 

                // SIZE RECORDS FOUNDS  
                $size = getDecadeCuriosityItems();

                for($i = 0; $i < mysql_num_rows($size); $i++){

                    
                    // GET ARRAY FROM QUERY
                    $rs = mysql_fetch_array($size); /* POR QUE ELE AUTO PULA PARA O PROXIMO INDICIE AUTOMATICAMENTE ? */

                    // CHECK STATUS CAME FROM DB AND TRANSFORM DATA TO SET IN URL ("true" OR "false")
                    $active = transformStatusToURL($rs["ativo"]);

                ?>
                    <div class="decadeItemBox">
                        <div class="itemImage">
                            <img src="<?php echo(cutPathNoEnd($rs["imagemPrincipal"], 1));?>" title="<?php echo($rs["titulo"])?>" alt="Imagem do item a ser gerenciado (<?php echo($rs["titulo"])?>)">
                            
                        </div>

                        <div class="itemTitle">
                            <?php echo($rs["titulo"])?>
                        </div>

                        <div class="itemDescription">
                            <?php echo($rs["descricao"])?>
                        </div>

                        <div class="itemStatus">

                        <?php
                        // CHECK IF ITEM'S STATUS IS ANABLED OR DISABLED
                        if ($rs["ativo"] == 1) {
                        ?>
                            <a href="?id=<?php echo($rs["idItemPagina"]);?>&active=false">
                                <img src="../pictures/icons/greenCheck48x48.png" title="Ativado" alt="Representação gráfica do status do item, ao clicar alterna de Item Ativado para Item Desativado e vice-versa">
                            </a>
                        <?php
                        }else{
                        ?>
                            <a href="?id=<?php echo($rs["idItemPagina"]);?>&active=true">
                                <img src="../pictures/icons/grayCheck48x48.png" title="Desativado" alt="Representação gráfica do status do item, ao clicar alterna de Item Ativado para Item Desativado e vice-versa">
                            </a>
                        <?php
                        }
                        ?>
                        </div>

                        <!-- SHOW DELETE AND UPDATE OPTIONS ONE ITEM -->
                        <div class="editDeleteBox">
                            <a href="?id=<?php echo($rs["idItemPagina"]);?>&mode=delete">
                                <img src="../pictures/icons/delete-icon512.png" title="Deletar" onclick="return confirm('Deseja realmente excluir ?')" alt="Deletar este item">
                            </a>
                            
                            <a href="cmsAddDecadeItem.php?id=<?php echo($rs["idItemPagina"]);?>&mode=update">
                                <img src="../pictures/icons/edit-validated-icon256.png" title="Atualizar" alt="Atualizar as informações deste item">
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>

            <!-- ADD USER BUTTON -->
            <div class="addItemButtonBox">
                <a href="cmsAddDecadeItem.php?mode=add&status=false&checkedStatus=true&id=-1">
                    <img id="addItemButtonImg" src="../pictures/icons/fba300x300.png" title="Adicionar novo item" alt="Botão para adicionar novo item">
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
