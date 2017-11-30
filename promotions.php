<?php
    // IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/promotionsDAO.php");
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
    <link rel="stylesheet" type="text/css" href="css/promotionsStyle.css">
    <link rel="shortcut icon" type="image/x-icon" href="pictures/logo/logo.png">
  
  </head>
  <body>
    <form name="promotionsForm" method="post" action="promotions.php">
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
            Promoções
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
                    <h1>PROMOÇÕES</h1>
                </div>
              </div>
              <!-- ************** -->

              <?php

                // GETTING ITEMS FROM DB
                $items = getActiveItems();

                for($i = 0; $i < mysql_num_rows($items); $i++){

                  $item = mysql_fetch_array($items);
                ?>

                  <!-- PROMOTION <?php echo($item["idItemPagina"]); ?> -->
                  <div class="promotionalStripBox">
                      <div class="promotionalStripBox_NO_SHADOW">
                        <div class="promotionalStrip">
                            
                            <!-- PROMOTIONAL PICTURE -->
                            <div class="promotionalPicture">
                                <img class="promoImg" src="<?php echo(cutPathNoEnd($item["imagem"], 4)); ?>" title="A Primeira é da Casa :)" alt="A Primeira é da Casa!!!">
                            </div>
                            <!-- ******************* -->
                            
                            <!-- NAME / DESCRIPTION -->
                            <div class="promotionsNameAndDescrptn">
                                <div class="promotionsName">
                                    NOME: <?php echo($item["titulo"]); ?>
                                </div>
                                
                                <div class="promotionsDescription">
                                    DESCRIÇÃO: <?php echo($item["descricao"]); ?>
                                </div>
                            </div>
                            <!-- ****************** -->
                            
                            <!-- PRICES AND VALIDATIONS -->
                            <div class="priceAndValidation">
                                <div class="realPrice">
                                    Preço SEM promoção: <span class="badPrice">R$ <span class="lineThrough"><?php echo($item["precoNaoPromocional"]); ?></span></span>
                                </div>
                                
                                <div class="promotionalPrice">
                                    Preço PROMOCIONAL: <span class="goodPrice">R$ <?php echo($item["precoPromocional"]); ?></span>
                                </div>
                                
                                <div class="validUntil">
                                    promoção válida até: <?php echo(setDateFormat("user", $item["dtValidade"])); ?>
                                </div>
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

