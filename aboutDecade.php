<?php
    // IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/decadeDAO.php");
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
    <link rel="stylesheet" type="text/css" href="css/aboutDecadeStyle.php">
    <link rel="shortcut icon" type="image/x-icon" href="pictures/logo/logo.png">
    <script src="js/jquery.js"></script>

  </head>
  <body>

    <script>
      $(document).ready(function(){

        // SHOW SITE MAP FOR ANOTHER PAGES
        $(".logo").click(function(){
          $(".menuItems").toggle("slow");
          $("#menuItems").toggle("slow");
        });

      });
    </script>

    <form name="aboutDecadeForm" method="post" action="aboutDecade.php">
      <!-- ******************* MENU ITEMS ********************************** -->
      <header>
        <nav>

          <!-- FOR DESKTOP -->
          <div id="logo">
            <a href="index.php">
              <img id="logoImg" src="./pictures/logo/logo.png" title="Frajola’s Pizzaria" alt="Logo da Frajola’s Pizzaria" >
            </a>
          </div>

          <!-- FOR MOBILE -->
          <div class="logo" id="logoMOBILE">
            <img id="logoImgMOBILE" src="./pictures/logo/logo.png" title="Frajola’s Pizzaria" alt="Logo da Frajola’s Pizzaria" >
          </div>

          <div id="menuItems">
            <a href="index.php">
                Home
            </a>
          </div>

          <div class="menuItems">
            Curiosidades Anos 60, 70 e 80
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
      <div id="main">
          <section>

              <!-- MAIN TITLE -->
              <div id="mainTitleBox">
                <div id="mainTitle">
                    <h1>ROCK and ROLL E UMA MUDANÇA CUTURAL</h1>
                </div>
              </div>
              <!-- ************** -->

              <?php

                // GETTING ITEMS FROM DB
                $items = getActiveItems();

                // KEEPING OLD DECATE
                $oldDecade = "";

                for($i = 0; $i < mysql_num_rows($items); $i++){

                  $item = mysql_fetch_array($items);

                  // CHECK IF IS A ITEM WITH NEW DECADE
                  if ($item["decada"] == $oldDecade) {// ITEM WITH EXISTING DECADE

                    // echo(cutPathNoEnd($item["imagemPrincipal"], 5));
                  ?>

                    <!-- <?php echo($item["titulo"]); ?> -->
                    <div class="StripBox">
                        <div id="<?php echo('item_'.$item['idItemPagina']); ?>">
                          <div class="strip">

                              <!-- DESCRIPTION -->
                              <div class="description">

                                  <?php echo($item["descricao"]); ?>

                              </div>
                              <!-- ****************** -->

                              <!-- LABEL AND PICTURE -->
                              <div class="labelAndPicture">

                                  <!-- LABEL ABOUT <?php echo($item["titulo"]); ?> -->
                                  <div class="label">
                                      <strong><?php echo($item["titulo"]); ?></strong>
                                  </div>

                                  <!-- PICTURE ABOUT <?php echo($item["titulo"]); ?> -->
                                  <div class="picture">
                                      <img class="img" src="<?php echo(cutPathNoEnd($item["imagemPrincipal"], 4)); ?>" title="<?php echo($item["titulo"]); ?>" alt="<?php echo($item["titulo"]); ?>">
                                  </div>

                              </div>

                          </div>
                        </div>
                    </div>

                    <?php
                      // SET OLD DECADE
                       $oldDecade = $item["decada"];
                    ?>
                    <!-- ***************************************************************************** -->

                  <?php
                  }else{//ITEM WITH NEW DECADE
                  ?>

                    <!-- <?php echo($item["decada"]);?>'s -->

                    <!-- <?php echo($item["titulo"]); ?> -->
                    <div class="StripBox">
                        <span class="textShadow">ANOS <?php echo($item["decada"]);?></span>
                        <div id="<?php echo('item_'.$item['idItemPagina']); ?>">
                          <div class="strip">

                              <!-- DESCRIPTION -->
                              <div class="description">

                                  <?php
                                    echo($item["descricao"]);
                                  ?>

                              </div>
                              <!-- ****************** -->

                              <!-- LABEL AND PICTURE -->
                              <div class="labelAndPicture">

                                  <!-- LABEL ABOUT <?php echo($item["titulo"]); ?> -->
                                  <div class="label">
                                      <strong><?php echo($item["titulo"]); ?></strong>
                                  </div>

                                  <!-- PICTURE ABOUT <?php echo($item["titulo"]); ?> -->
                                  <div class="picture">
                                      <img class="img" src="<?php echo(cutPathNoEnd($item["imagemPrincipal"], 4)); ?>" title="<?php echo($item["titulo"]); ?>" alt="<?php echo($item["titulo"]); ?>">
                                  </div>

                              </div>

                          </div>
                        </div>
                    </div>

                    <!-- ***************************************************************************** -->

                    <?php
                      // SET OLD DECADE
                       $oldDecade = $item["decada"];
                  }
                }
              ?>

          </section>
      </div>

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
