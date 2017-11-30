<?php
    //IMPORT CONNECTION TO DB MODULE
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/employeeDAO.php");

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

    // CHECK ID MODE IS EQUALS "delete"
    if(isset($_GET["mode"])){

        $mode = $_GET["mode"];

        if($mode == "delete"){

            // CHECK IF USER WILL BE DELETED IS ITSELF
            if ($_SESSION["employeesId"] != $_GET["id"]) {

                //DELETE FROM tbl_usuario
                $sql = "DELETE FROM tbl_usuario WHERE idFuncionario = ".$_GET["id"];
                mysql_query($sql);

                //DROPPING FK TO DELETE RECORD
                $sql = "ALTER TABLE tbl_usuario DROP FOREIGN KEY fk_idFuncionario_tbl_usuario";
                mysql_query($sql);

                //DELETE FROM tbl_funcionario
                $sql = "DELETE FROM tbl_funcionario WHERE idFuncionario = ".$_GET["id"];
                mysql_query($sql);

                //ADD CONSTRAINT AGAIN
                $sql = "ALTER TABLE tbl_usuario ADD CONSTRAINT fk_idFuncionario_tbl_usuario FOREIGN KEY(idFuncionario) REFERENCES tbl_funcionario(idFuncionario)";
                mysql_query($sql);

            }

        }

        header("location:cmsShowUsers.php");
    }


?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Frajola’s Pizzaria - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/cmsShowUsers.css">
        <link rel="shortcut icon" type="image x-icon" href="../pictures/logo/logo.png">
        <script src="./js/modal.js"> </script>
        <script src="./js/jquery.js"> </script>
    </head>
    <body>

        <!-- *********** EMPLOYEE'S DATA MODAL **************** -->

        <!-- SHOWS MODAL -->
        <script type="text/javascript">
            $(document).ready(function(){

                $(".show").click(function(){
                    $(".modalContainer").slideToggle(2000);
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
                        Adm. Usuários
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
            <!-- SHOW TABLE WITH USERS' DATA (NAME, EMAIL, USERNAME)-->
            <div id="showUsersBox">
                <div class="tableLabel">
                    NOME
                </div>

                <div class="tableLabel">
                    E-MAIL
                </div>

                <div class="tableLabel">
                    NOME DE USUÁRIO
                </div>

                <div class="iconLabelBox">
                    OPÇÔES
                </div>

            <?php

                // TEM O METODO QUE FAZ ISSO MAS FICA EM LOOP. POR QUÊ ????
                $sql = "SELECT func.idFuncionario, func.nome, func.celular, func.telefone, func.email, func.sexo, func.cpf, func.dtNasc,func.salario, estcvl.estado_civil, prv.privilegio, usr.usuario, usr.senha, usr.foto_perfil
                    FROM tbl_funcionario AS func
                    INNER JOIN tbl_usuario AS usr ON usr.idFuncionario = func.idFuncionario
                    INNER JOIN tbl_estado_civil AS estcvl ON estcvl.idEstadoCivil = func.idEstadoCivil
                    INNER JOIN tbl_privilegio AS prv ON prv.idPrivilegio = usr.idPrivilegio";

                    $query = mysql_query($sql);

                while($rs = mysql_fetch_array($query)){
            ?>

                    <div class="tableData">
                        <?php echo($rs["nome"]); ?>
                    </div>

                    <div class="tableData">
                        <?php echo($rs["email"]); ?>
                    </div>

                    <div class="tableData">
                        <?php echo($rs["usuario"]); ?>
                    </div>

                    <div class="iconBox">
                        <div class="iconLabel">
                            <a href="cmsAddUser.php?id=<?php echo($rs["idFuncionario"]);?>&mode=update">
                                <img class="iconImg" src="../pictures/icons/edit-validated-icon256.png" title="Editar" alt="Editar registro de usuário">
                            </a>
                        </div>

                        <div class="iconLabel">
                            <a class="show" href="#" onclick="modal(<?php echo($rs["idFuncionario"]); ?>, 'userDetails')">
                                <img class="iconImg" src="../pictures/icons/detailsView512x512.png" title="Ver mais detalhes" alt="Ver mais detalhes sobre o usuário">
                            </a>
                        </div>

                        <div class="iconLabel">
                            <a href="cmsShowUsers.php?id=<?php echo($rs["idFuncionario"]);?>&mode=delete">
                                <img class="iconImg" src="../pictures/icons/delete-icon512.png" onclick="return confirm('Deseja relamente excluir este usuário ?')" title="Deletar" alt="Deletetar registro de usuário">
                            </a>
                        </div>
                    </div>
            <?php
                }
            ?>
                </div>

                <!-- ADD USER BUTTON -->
                <div class="addUserButtonBox">
                    <a href="cmsAddUser.php">
                        <img id="addUserButtonImg" src="../pictures/icons/fba300x300.png" title="Adicionar novo usuário" alt="Botão para adicionar novo usuário">
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
