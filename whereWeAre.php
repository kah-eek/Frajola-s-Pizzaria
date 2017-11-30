<?php
    // IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/whereWeAreDAO.php");
    require_once("./modulo/functions.php");
    /* ****************** */
    
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

    
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>Frajola’s Pizzaria</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/whereWeAreStyle.css">
    <link rel="shortcut icon" type="image/x-icon" href="pictures/logo/logo.png">
 
  </head>
  <body>
    <form name="whereWeAreForm" method="post" action="whereWeAre.php">
      <!-- ******************* MENU ITEMS ********************************** -->
      <header>
        <nav>
          <div id="logo">
            <a href="index.php">
                <img id="logoImg" src="./pictures/logo/logo.png" title="Frajola’s Pizzaria" alt="Logo da Frajola’s Pizzaria" >              
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
            Nossos Ambientes
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
              <input class="inputText_LOGIN" type="text" name="txtUsername">
            </div>

            <div class="inputArea_LOGIN">
              Senha
              <input class="inputText_LOGIN" type="password" name="txtPassword">
            </div>

            <div id="buttonArea_LOGIN">
              <input id="btnOk_LOGIN" type="submit" name="btnLogin" value="OK">
            </div>
          </div>
        </nav>
      </header>
      <!-- FILL BLANK-->
      <div id="fillBlank"></div>
      <!-- ********* -->

      <!-- ******************************************************************** -->
      
      <!-- ************************** MAIN CONTENT **************************** -->
      <main>
          <section>
              
              <!-- MAIN TITLE -->
              <div id="mainTitleBox">
                <div id="mainTitle">
                    <div id="title">
                        <h1>ONDE ESTAMOS</h1>
                    </div>
                    <div id="titleIcon">
                        <img id="titleIconResize" src="./pictures/icons/orangeMapLocation512x512.png" title="Veja Onde Nós Estamos" alt="Icone de marcação em um map. Veja Onde Nós Estamos">
                    </div>
                </div>
              </div>
              <!-- ************** -->

              <?php

                // GETTING ITEMS FROM DB
                $items = getActiveItems();

                for($i = 0; $i < mysql_num_rows($items); $i++){

                  $item = mysql_fetch_array($items);
                ?>

                    <!-- LOCAL <?php echo($item["idItemPagina"]); ?> -->
                    <div class="localStripBox">
                        <div class="localStripBox_NO_SHADOW">
                          <div class="localStrip">
                              
                              <!-- LOCAL PICTURE -->
                              <div class="localPicture">
                                  <img class="localImg" src="<?php echo(cutPathNoEnd($item["imagemEstabelecimento"], 4)); ?>" title="<?php echo($item["logradouro"]); ?>, <?php echo($item["uf"]); ?>" alt="pequena demostração da unidade localizada no endereço <?php echo($item["logradouro"]); ?>, <?php echo($item["uf"]); ?>">
                              </div>
                              <!-- ******************* -->
                              
                              <!-- LOCAL DESCRIPTION -->
                              <div class="placeDescrptn">
                                  <div class="localName">
                                      <?php echo($item["bairro"]); ?>, <?php echo($item["uf"]); ?>
                                  </div>
                                  
                                  <div class="localDescription">
                                      RUA: <?php echo($item["logradouro"]); ?>, nº <?php echo($item["numero"]); ?>
                                  </div>
                                  
                                  <div class="localTelephone">
                                      TELEFONE: <?php echo(setPhoneFormat($item["telefone"])); ?>
                                  </div>
                              </div>
                              <!-- ****************** -->
                              
                              <!-- JUST A PICTURE -->
                              <div class="justAPicture">
                                  <img class="justAPictureResize" src="<?php echo(cutPathNoEnd($item["iconeBanda"], 4)); ?>" title="Just a bit Rock and Roll" alt="Just a bit Rock and Roll (Foto decorativa)">
                              </div>
                              <!-- ****************** -->
                          </div>
                        </div>
                    </div> 
                    <!-- ***************************************************************************** -->

                <?php
                }


              ?>
              
          </section>
      </main>
        
      <div id="blankSpace">
        <!-- JUST ONE BLANK SPACE-->  
      </div>  
      
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
    </form>
  </body>
</html>

