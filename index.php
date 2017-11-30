<?php
    //IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/indexDAO.php");
    /* **************************************** */

    //CONNECTING TO DB
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
    <link rel="stylesheet" type="text/css" href="css/indexStyle.css">
    <link rel="shortcut icon" type="image/x-icon" href="pictures/logo/logo.png">
    <script src="./js/modal.js"></script>
    <script src="./js/jquery.js"></script>
    <script src="./js/useful.js"></script>

    <!-- LINK TO SLIDER'S FILES -->
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <link rel="stylesheet" href="./slider/responsiveslides.css">
      <link rel="stylesheet" href="./slider/demo/demo.css">
      <script src="slider/js/slider.js"></script>
     <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>-->
      <script src="./slider/responsiveslides.min.js"></script>
      <script src="slider/sliderFour.js"></script>
    <!-- *********************************************** -->



    <!-- SEARCH BAR -->
      <!-- <script type="text/javascript">
        $("#frmSearch").submit(function(event){

          // REMOVE DEFAULT SUBMIT
          event.preventDefault();

          $.ajax({
            type:"POST",
            url:"./controller/indexController.php"
            data: {text:txtSearch from php here!},
            success: fucntion(data){
              $("#controller").html(data);
            }
          });


        });
      </script> -->
    <!-- *********************************************** -->

  </head>
  <body>

    <!-- PROCESS DATA TO SEARCH OF PRODUTCS INTO DB -->
    <div id="controller">
    </div>


    <!-- ABOUT PRODUCT - MODAL -->

    <script type="text/javascript">
      $(document).ready(function(){
        $(".show").click(function(){
          $(".modalContainer").slideToggle(1500);
        });
      });
    </script>

    <div class="modalContainer">
      <div class="modal">
      </div>
    </div>
    <!-- ********************* -->

    <video loop autoplay poster="videos/bgVideo.mp4" id="backgroundVideo">
      <source src="videos/bgVideo.mp4" type="video/mp4"/>
      <source src="videos/bgVideo.mp4" type="video/webm"/>
      <source src="videos/bgVideo.mp4" type="video/ogg"/>
    </video>
    <form name="homeForm" method="post" action="index.php">
      <!-- ******************* MENU ITEMS ********************************** -->
      <header>
        <nav>

          <!-- FOR DESKTOP -->
          <div id="logo">
            <img id="logoImg" src="./pictures/logo/logo.png" title="Frajola’s Pizzaria" alt="Logo da Frajola’s Pizzaria" >
          </div>

          <!-- FOR MOBILE -->
          <div id="logoMOBILE">
            <img id="logoImgMOBILE" src="./pictures/logo/logo.png" title="Frajola’s Pizzaria" alt="Logo da Frajola’s Pizzaria" >
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
              <input class="inputText_LOGIN" type="text" required name="txtUsername">
            </div>

            <div class="inputArea_LOGIN">
              Senha
              <input class="inputText_LOGIN" type="password" required name="txtPassword">
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

      <!-- ************************** MAIN CONTENT **************************** -->
      <div id="main">
        <div id="slider">

            <!-- Slideshow 4 -->
            <div class="callbacks_container">
              <ul class="rslides" id="slider4">
                <li>
                  <img class="resizeSliderImg" src="./pictures/pizzas/slider/slider01200x375.jpg" alt="NOVOS SABORES">
                  <p class="caption">NOVOS SABORES</p>
                </li>
                <li>
                  <img class="resizeSliderImg" src="./pictures/pizzas/slider/slider11200x375.jpg" alt="">
                  <p class="caption">TRADICIONAIS DA CASA</p>
                </li>
                <li>
                  <img class="resizeSliderImg" src="./pictures/pizzas/slider/slider21200x375.jpg" alt="">
                  <p class="caption">SABORES ÚNICOS</p>
                </li>
              </ul>
            </div>

        </div>
        <section>
          <!-- ************************** LEFT MENU **************************** -->
          <div id="leftMenu">
            <ul id="menuList_LEFT_MENU">

              <?php
                // LOADS CATEGORIES INTO LIST

                // GET QUERY (mysql_query()) FROM DATABASE
                $size = getCategories();

                for($i = 0; $i < mysql_num_rows($size); $i++){

                  // TRANSFORM TO array
                  $category = mysql_fetch_array($size);

                ?>

                  <!-- LIST ITEMS (CATEGORY) -->
                  <li class="lstItem_LEFT_MENU"><?php echo($category["categoria"]); ?>

                    <!-- LIST ITEMS (SUBCATEGORY) -->
                    <ul class="subcategory_LEFT_MENU">
                    <?php

                        // LOADS SUBCATEGORIES INTO LIST

                        // GET HOW MANY ITEMS EXISTS INTO DATABASE
                        $subcategorySize = getSubcategoryById($category["idCategoria"]);

                        for($count = 0; $count < mysql_num_rows($subcategorySize); $count++){

                          $subcategory = mysql_fetch_array($subcategorySize);
                        ?>

                          <li class="subcategory_listItem_LEFT_MENU"><?php echo($subcategory["subcategoria"]); ?></li>

                        <?php
                        }

                    ?>
                    </ul>
                    <!-- ************************ -->

                  </li>

                <?php
                }
              ?>
            </ul>
          </div>
          <!-- ******************************************************************** -->

          <!-- ************************** CENTER CONTENT ************************** -->
          <div id="centerContent">

            <!-- OUTSIDE BOX FROM LEFT -->
              <!-- 1FST BOX-->
              <div id="outsideBox1_CENTER_CONTENT">
                <img  class="adImgSize" src="pictures/icons/Instagram-icon256x256_COLOR.png" title="Instagram" alt="Nos siga no Intragram. Veja nossas fotos e novidades">
              </div>

              <!-- 2SCD BOX-->
              <div id="outsideBox2_CENTER_CONTENT">
                  <img  class="adImgSize" src="pictures/icons/Facebook-icon512x512_COLOR.png" title="Facebook" alt="Nos curta no Facebook. Veja nossas fotos e novidades">
              </div>

              <!-- 3TRD BOX-->
              <div id="outsideBox3_CENTER_CONTENT">
                  <img  class="adImgSize" src="pictures/icons/twitter-icon512x512_COLOR.png" title="Twitter" alt="Nos siga no Twitter. Veja nossas fotos e novidades">
              </div>
            <!-- ******** -->

            <!-- TITLE -->
            <div id="contentTitle_CENTER_CONTENT">
              <h1>Algumas de Nossas Pizzas</h1>
            </div>
            <!-- ******** -->

            <!-- SEARCH BAR -->
            <div id="searchArea">
                <form id="frmSearch" name="frmSearch" action="index.php" method="post">
                    <input id="txtSearch" required placeholder="Pesquise aqui seu produto" name="txtSearch" type="search">
                    <input id="btnSearch" name="btnSearch" type="submit" value="&#x1F50D;">
                </form>
            </div>
            <!-- ****************************** -->

            <!-- ITEMS -->

            <?php
            // TEST************** - SERACH BAR
            if (isset($_POST["btnSearch"])) {

              // GETTING REQUIRED SEARCH
              $size = getSearch($_POST["txtSearch"]);

              for($i = 0; $i < mysql_num_rows($size); $i++){

                // ITEMS FROM SEARCH
                $rs = mysql_fetch_array($size);
              ?>

                <!-- ITEMS BOX <?php echo($rs["idProduto"]); ?>-->
                <div class="itemsBox_CENTER_CONTENT">
                  <!-- PIZZA IMAGE -->
                  <div class="imgBackground_ITEMS_BOX">
                    <div class="pizzaImg_ITEMS_BOX">
                      <img class="pizzaIconImg_ITEMS_BOX" src="<?php echo(cutPathNoEnd($rs["imagemProduto"], 4)); ?>" title="<?php echo($rs["titulo"]); ?>" alt="<?php echo($rs["titulo"]); ?>">
                    </div>
                  </div>
                  <!-- DESCRIPTIONS -->
                  <div class="descArea_ITEMS_BOX">
                    <div class="descLabel_ITEMS_BOX">
                      Nome: <?php echo($rs["titulo"]); ?>
                    </div>

                    <div class="descLabel_ITEMS_BOX">
                      <!--
                      <details>
                        <summary>Descrição</summary>
                          Molho,
                          mussarela,
                          presunto,
                          ovos,
                          palmito,
                          rodelas de tomate,
                          cebola,
                          azeitonas e orégano.
                      </details>
                      -->
                      Descrição: <?php echo($rs["descricao"]); ?>
                    </div>

                    <div class="descLabel_ITEMS_BOX">
                      Preço: R$ <?php echo($rs["preco"]); ?>
                    </div>

                    <div class="detailsDescLabel_ITEMS_BOX">
                      <a class="show" href="#" onclick="modal(<?php echo($rs["idProduto"]); ?>); setClick(<?php echo($rs["idProduto"]); ?>, 'tbl_produto"')">
                        Detalhes
                      </a>
                    </div>
                  </div>
                </div>
                <!-- ******** -->

              <?php
              }
            }else{

                $size = getActiveItems();
                for($i = 0; $i < mysql_num_rows($size); $i++){

                  $rs = mysql_fetch_array($size);
                ?>
                  <!-- ITEMS BOX <?php echo($rs["idProduto"]); ?>-->
                  <div class="itemsBox_CENTER_CONTENT">
                    <!-- PIZZA IMAGE -->
                    <div class="imgBackground_ITEMS_BOX">
                      <div class="pizzaImg_ITEMS_BOX">
                        <img class="pizzaIconImg_ITEMS_BOX" src="<?php echo(cutPathNoEnd($rs["imagemProduto"], 4)); ?>" title="<?php echo($rs["titulo"]); ?>" alt="<?php echo($rs["titulo"]); ?>">
                      </div>
                    </div>
                    <!-- DESCRIPTIONS -->
                    <div class="descArea_ITEMS_BOX">
                      <div class="descLabel_ITEMS_BOX">
                        Nome: <?php echo($rs["titulo"]); ?>
                      </div>

                      <div class="descLabel_ITEMS_BOX">
                        <!--
                        <details>
                          <summary>Descrição</summary>
                            Molho,
                            mussarela,
                            presunto,
                            ovos,
                            palmito,
                            rodelas de tomate,
                            cebola,
                            azeitonas e orégano.
                        </details>
                        -->
                        Descrição: <?php echo($rs["descricao"]); ?>
                      </div>

                      <div class="descLabel_ITEMS_BOX">
                        Preço: R$ <?php echo($rs["preco"]); ?>
                      </div>

                      <div class="detailsDescLabel_ITEMS_BOX">
                        <a class="show" href="#" onclick="modal(<?php echo($rs["idProduto"]); ?>); setClick(<?php echo($rs["idProduto"]); ?>, 'tbl_produto')">
                          Detalhes
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- ******** -->

                <?php
                }
              }
            ?>
          </div>
          <!-- ******************************************************************** -->
        </section>
      </div>

      <!-- FOOTER -->
      <footer>
        <div id="footerBox">
          <div id="leftSideFooter">
            *Imagens meramente ilustrativas
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
  </body>
</html>
