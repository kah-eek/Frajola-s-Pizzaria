<?php

    //IMPORT
    require_once("./modulo/dbFunctions.php");

    //CONNECT TO DB
    connectToDB();

    //CHECK IF btnLogin EXISTS
    if(isset($_POST["btnLogin"])){

        //GETTING FIELD DATA
        $username = $_POST["txtUsername"];
        $password = $_POST["txtPassword"];

        if(login($username,$password)){


            //STARTING SESSION VARIABLES
            session_start();

            //GETTING EMPLOYEE'S ID
            $employee = getEmployeeIdByLogin($username,$password);

            //SETTING INTO SESSION VARIABLE
            $_SESSION["employeesId"] = $employee["idFuncionario"];

            //MOVING TO CMS PAGE
            header("location:./cms/cmsHome.php");
        }else{
        ?>
            <script type="text/javascript">
                alert("Usuário ou senha incorreto!");
            </script>
        <?php
        }
    }

    if(isset($_POST["btnSend"])){
        $name = $_POST["txtName"];
        $cellPhone = $_POST["txtCellPhone"];
        $telephone = $_POST["txtTelephone"];
        $email = $_POST["txtEmail"];
        $homePage = $_POST["txtHomePage"];
        $linkFacebook = $_POST["txtLinkInFacebook"];
        $profession = $_POST["txtProfession"];
        $productsInfos = $_POST["txtProductsInformations"];
        $suggestionsCritics = $_POST["txtSuggestionsCritics"];
        $sex = $_POST["rbnSex"];

        //INSERT INTO DB
        $sql = "INSERT INTO tbl_fale_conosco (nome,celular, telefone, email, home_page, link_facebook, profissao, infos_produto, sugestao_critica, sexo) VALUES('".$name."','".$cellPhone."','".$telephone."','".$email."','".$homePage."','".$linkFacebook."','".$profession."','".$productsInfos."','".$suggestionsCritics."','".$sex."');";


        if(!mysql_query($sql)){
            ?>
            <script type="text/javascript">
                alert("Falha ao enviar o formulário :(");
            </script>
            <?php
        }else{
            header("location: contactUs.php");
        }
    }

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <title>Frajola’s Pizzaria</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/contactUsStyle.css">
        <link rel="shortcut icon" type="image/x-icon" href="pictures/logo/logo.png">
        <script src="js/useful.js"></script>

    </head>
    <body>
        <form name="contactUsLoginForm" method="post" action="contactUs.php">
          <!-- ******************* MENU ITEMS ********************************** -->
          <header>
            <nav>
              <div id="logo">
                <a href="index.php">
                    <img id="logoImg" src="./pictures/logo/logo.png" title="Frajola’s Pizzaria" alt="Logo da Frajola’s Pizzaria">
                </a>
              </div>

              <div class="menuItems">
                <a href="aboutDecade.php">
                  Curiosidades Anos 60, 70 e 80
                </a>
              </div>

              <div class="menuItems">
                <a href="aboutUs.php">
                    Sobre a Pizzaria
                </a>
              </div>

              <div class="menuItems">
                <a href="promotions.php">
                  Promoções
                </a>
              </div>

              <div class="menuItems">
                  <a href="whereWeAre.php">
                    Nossos Ambientes
                  </a>
              </div>

              <div class="menuItems">
                  <a href="monthsPizza.php">
                    A Pizza do Mês
                  </a>
              </div>

              <div class="menuItems">
                <a href="contactUs.php">
                  Fale Conosco
                </a>
              </div>

              <div id="loginArea">
                <div class="inputArea_LOGIN">
                  Usuário
                  <input class="inputText_LOGIN" type="text" name="txtUsername" required>
                </div>

                <div class="inputArea_LOGIN">
                  Senha
                  <input class="inputText_LOGIN" type="password" name="txtPassword" required>
                </div>

                <div id="buttonArea_LOGIN">
                  <input id="btnOk_LOGIN" type="submit" name="btnLogin" value="OK">
                </div>
              </div>
            </nav>
          </header>
        </form>
          <!-- FILL BLANK-->
          <div id="fillBlank"></div>
          <!-- ********* -->

          <!-- ******************************************************************** -->
        <form name="contactUsForm" method="post" action="contactUs.php">
          <div id="main">
              <section>
                <!-- ******************** MAIN TITLE ********************************** -->
                <div id="aboutPageBg">

                    <div id="mainTitleBox">
                        <div id="frstTitle">
                            <h1>COMO PODEMOS TE AJUDAR ?</h1>
                        </div>
                    </div>

                    <div id="scdnTitleBox">
                        <div id="scdnTitle">
                            <h3>ENVIE-NOS SUA SUGESTÂO, CRÍTICA, OU MESMO COMENTÁRIOS EM GERAL ;)</h3>
                        </div>
                    </div>

                </div>
                <!-- ******************************************************************** -->

                <!-- ******************** SECTION TITLE ********************************* -->
                <div id="sectionTitleBox">
                    <div id="sectionTitle">
                        INFORME SEUS DADOS ABAIXO
                    </div>
                </div>
                <!-- ******************************************************************** -->

                <!-- ******************** FORM'S DATA *********************************** -->
                <div id="formsDataBox">

                    <div id="formsDataCenterBox">

                        <!-- OUTSIDE BUTTON -->
                        <div id="outsideButton">
                            <img id="sendButtonImg" src="pictures/icons/airplane.png" title="Enviar" alt="Enviar">

                            <input id="submitButton" type="submit" name="btnSend" value="Enviar">
                        </div>

                        <div class="inputSpaces">

                            <!-- NAME -->
                            <div class="fieldToFillBox">
                                <div class="fieldsLabel">
                                    NOME
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" id="name" name="txtName" type="text" maxlength="100" onkeypress="return valed(event, 'character', 'name')" required>
                                </div>

                            </div>

                            <!-- CELL PHONE -->
                            <div class="fieldToFillBox">

                                <div class="fieldsLabel">
                                    CELULAR
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" id="cellPhone" onkeypress="return valed(event, 'number', 'cellPhone')" name="txtCellPhone" type="tel" maxlength="14" required pattern="[0-9]{2} [0-9]{5}[0-9]{4}" placeholder="DD XXXXXXXXX" title="SOMENTE NÚMEROS (DD XXXXXXXXX)">
                                </div>

                            </div>

                            <!-- TELEPHONE -->
                            <div class="fieldToFillBox">

                                <div class="fieldsLabel">
                                    TELEFONE
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" id="telephone" pattern="[0-9]{2} [0-9]{8}" placeholder="DD XXXXXXXX" title="SOMENTE NÚMEROS" onkeypress="return valed(event, 'number', 'telephone')" name="txtTelephone" type="tel" maxlength="13">
                                </div>

                            </div>

                            <!-- EMAIL -->
                            <div class="fieldToFillBox">

                                <div class="fieldsLabel">
                                    E-MAIL
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" name="txtEmail" type="email" required maxlength="80">
                                </div>

                            </div>

                        </div>

                        <div class="inputSpaces">

                            <!-- HOME PAGE -->
                            <div class="fieldToFillBox">
                                <div class="fieldsLabel">
                                    <span class="italic">HOME PAGE</span>
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" name="txtHomePage" type="url" maxlength="100">
                                </div>

                            </div>

                            <!-- LINK IN FACEBOOK -->
                            <div class="fieldToFillBox">

                                <div class="fieldsLabel">
                                    <span class="italic">LINK</span> NO <span class="italic">FACEBOOK</span>
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" name="txtLinkInFacebook" type="url" maxlength="100">
                                </div>

                            </div>

                            <!-- PROFESSION -->
                            <div class="fieldToFillBox">

                                <div class="fieldsLabel">
                                    PROFISSÃO
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" id="profession" onkeypress="return valed(event, 'character', 'profession')" name="txtProfession" type="text" required maxlength="80">
                                </div>

                            </div>

                            <!-- PRODUCTS'S INFORMATIONS -->
                            <div class="fieldToFillBox">

                                <div class="fieldsLabel">
                                    INFORMAÇÕES DE PRODUTOS
                                </div>

                                <div class="inputField">
                                    <input class="clientsData" name="txtProductsInformations" type="text" maxlength="255">
                                </div>

                            </div>

                        </div>

                        <div class="inputSpaces">


                            <!-- CRITICS/SUGGESTIONS -->
                            <div id="fieldToFillBox">

                                <div class="fieldsLabel">
                                    SUGESTÕES/CRÍTICAS
                                </div>

                                <div id="inputField">
                                    <textarea name="txtSuggestionsCritics" maxlength="254" rows="6" cols="45"></textarea>
                                </div>

                            </div>

                            <!-- SEX -->
                            <div class="fieldToFillBox">

                                <div class="fieldsLabel">
                                    SEXO
                                </div>

                                 <div class="inputField">
                                    <input type="radio" name="rbnSex" checked value="F"><span class="defaultFont">FEMINO</span>

                                    <input type="radio" name="rbnSex" value="M"><span class="defaultFont">MASCULINO</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- ******************************************************************** -->
              </section>
              <!-- FOOTER -->
              <footer>
                <div id="footerBox">
                  <div id="leftSideFooter">

                    <!-- INSTAGRAM -->
                    <a href="https://www.instagram.com/">
                        <img class="icon" src="./pictures/icons/Instagram-icon256x256_COLOR.png" title="Siga-nos no Intagram" alt="Siga-nos no siga no Intagram">
                    </a>

                    <!-- FACEBOOk -->
                    <a href="https://www.facebook.com/pages/Pizzaria-Frajolas/1507826092789034">
                        <img class="icon" src="./pictures/icons/Facebook-icon512x512_COLOR.png" title="Curta-nos no Facebook" alt="Siga-nos no siga no Intagram">
                    </a>

                    <!-- TWITTER -->
                    <a href="https://twitter.com/frajolabrasil7?lang=en">
                        <img class="icon" src="./pictures/icons/twitter-icon512x512_COLOR.png" title="Siga-nos no Twitter" alt="Siga-nos no siga no Intagram">
                    </a>

                  </div>

                  <div id="centerSpaceFooter">
                    <div id="frsText">
                      <strong>Av. Looney Tunes, nº666</strong>
                    </div>

                    <div id="scdnText">
                      Copyright © 2017 Todos direitos Reservados.
                    </div>
                  </div>

                  <div id="rightSideFooter">
                    Desenvolvido por <a href="./extra/curriculum/curriculo.html" target="_blank">Caique M. Oliveira</a>
                  </div>
                </div>
              </footer>
              <!-- ******************************************************************** -->
          </main>
        </form>
    </body>
</html>
