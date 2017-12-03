<?php
    //IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/userDAO.php");
    require_once("./modulo/employeeDAO.php");
    require_once("./modulo/productDAO.php");
    //**************************************************><

    //CONNECTING TO DB
    $con = connectToDB();

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

    // SET DEFAULT VALUE
    $item = null;
    // $_POST["cbxCategory"] = "-1";


    //CHECK IF btnLogout EXISTS
    if(isset($_POST["btnLogout"])){

        //LOGOUT AND RETURNS TO SITE HOME PAGE
        logout($_SESSION["employeesId"], "../index.php");

    }


    // CHECK IF mode IS EQUALS update TO AUTO FILL THE TEXT FIELDS
    if(isset($_GET["mode"])){

        $mode = $_GET["mode"];

        if ($mode == "update"){

            // GETTING ITEM FROM DB
            $item = mysql_fetch_array(getItem($_GET["id"]));

            // CHECK STATUS CAME FROM DB AND TRANSFORM DATA TO SET IN URL ("true" OR "false")
            $active = transformStatusToURL($item["ativo"]);

        }

    }

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Frajola’s Pizzaria - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/cmsAddProductItem.css">
        <link rel="shortcut icon" type="image x-icon" href="../pictures/logo/logo.png">
        <script src="js/useful.js"></script>
        <script src="js/jquery.js"></script>

        <script type="text/javascript">

            //SET STATUS' LINK TITLE WHEN OPENS PAGE
            var status = $(".statusLink").attr('title');


            $(document).ready(function() {

                // ACTIVE OR DESACTIVE ITEM'S STATUS

                //STATUS' LINK LISTENER
                $(".statusLink").click(function() {

                    //STATUS' LINK TITLE
                    status = $(".statusLink").attr('title');


                    //CHECK IF STATUS' TITLE IS EQUALS desativado
                    if(status =='Desativado'){

                        //CHANGES PICTURE TO GREEN (STATUS' IMAGE)
                        $("#statusImage").attr({'src':'../pictures/icons/greenCheck48x48.png'})

                        //CHANGES IMAGE'S TITLE ( = ativado)
                        $("#statusImage").attr({'title':'Ativado'});

                        //ALTERS LINK'S TITLE ( = ativado)
                        $(".statusLink").attr({'title':'Ativado'});


                    }else{ //IF STATUS' TITLE IS EQUALS ativado

                        //CHANGES PICTURE TO GRAY (STATUS' IMAGE)
                        $("#statusImage").attr({'src':'../pictures/icons/grayCheck48x48.png'})

                        //CHANGES IMAGE'S TITLE ( = desativado)
                        $("#statusImage").attr({'title':'Desativado'});

                        //ALTERS LINK'S TITLE ( = desativado)
                        $(".statusLink").attr({'title':'Desativado'});
                    }

                    //SET alt ATTRIBUTE ON STATUS' IMAGE
                    $("#statusImage").attr({"alt":"Representação gráfica do status do item. Status atual: "+$(".statusLink").attr('title')});

                });

                // REMOVE BUTTON'S DEFAULT SUBMITE AND SEND DATA ACROSS ajax
                $("#frmAddDecadeItem").submit(function(event){

                    // REMOVE DEFAULT SUBMITE
                    event.preventDefault();

                    // GET VARIABLES VALUES FROM URL TO SEND TO AJAX
                    <?php
                        $mode = $_GET['mode'];
                        $id = $_GET['id'];
                    ?>

                    // SET VALUES GOT FROM PHP TO JAVASCRIPT VARIABLES
                    var mode = "<?php echo($mode); ?>";
                    var status = $(".statusLink").attr('title');  //STATUS' LINK TITLE
                    var id = "<?php echo($id); ?>";

                    // SEND DATA TO ANOTHER PAGE
                    $.ajax({
                        type:"POST",
                        url:"./controller/cmsAddProductItemController.php?mode="+mode+"&status="+status+"&id="+id+"",
                        data: new FormData($("#frmAddDecadeItem")[0]),
                        cache:false,
                        contentType:false,
                        processData:false,
                        async:true,
                        success: function(dados){
                            $('#controller').html(dados)
                            // alert(dados);
                            // alert("Dados enviados\n\n./controller/cmsAddDecadeItemController.php?mode="+mode+"&status="+status+"&id="+id+"");
                            // alert(mode+status+id);
                        }
                    });

                });


                // CHECK IF CATEGORY WAS SELECT
                // $("#category_js").

            });

        </script>


    </head>
    <body>

        <!-- PROCESS DATA TO INSERT AND ADD INTO DB -->
        <div id="controller">

        </div>


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
        <nav>
            <div class="sectionItem">
                <div class="sectionItemImgBox">
                    <img class="sectionItemImg" src="../pictures/icons/Content128x128.png" title="Adm. Conteúdo" alt="Ícone. Administração de conteúdo">
                </div>

                <div class="sectionItemLabelBox">
                    <a href="cmsManageProducts.php">
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
                    <a href="cmsShowUsers.php">
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
            <!-- ***************************************************************************************************************** -->

        <!-- MAIN CONTENT -->
        <form name="frmAddDecadeItem" id="frmAddDecadeItem" method="POST" action="cmsAddProductItem.php?mode=<?php echo($_GET['mode']);?>&id=<?php echo($_GET['id']); ?>" enctype="multipart/form-data">
            <div id="main">
                <!-- TEXT FIELDS TO FILL ABOUT NEW ITEM -->
                <div id="showItemsBox">

                    <div id="mainBox">

                        <!-- TITLE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                TÍTULO
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="25" name="txtTitle" value="<?php echo($item["titulo"]);?>" required>
                            </div>
                        </div>

                        <!-- MAIN PICTURE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                IMAGEM
                            </div>

                            <!-- CHECK IF MODE EQUALS UPDATE OR NOT
                                *mode == update - DISABLE required PARAMETER
                                *mode == add -  ENABLE required PARAMETER
                            -->

                            <div class="textField">
                                <?php
                                if (isset($_GET["mode"])) {
                                    $mode = $_GET["mode"];

                                    if ($mode == "update") {
                                    ?>
                                        <input type="file" name="picture">
                                    <?php
                                    }else if($mode == "add"){
                                    ?>
                                        <input type="file" name="picture" required>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                DESCRIÇÃO
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="40" name="txtDescription" value="<?php echo($item["descricao"]);?>" required>
                            </div>
                        </div>

                        <!-- TEXT AREA -->
                        <div id="textAreaBox">
                            <div id="textAreaLabel">
                                DETALHES
                            </div>
                            <textarea required maxlength="350" name="txtDetails" rows="8" cols="74"><?php echo(strip_tags($item["detalhes"]));?></textarea>
                        </div>

                        <!-- PRICE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                PREÇO
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="5" onkeypress="return blockType(event,'characterAllowDot')" name="txtPrice" value="<?php echo($item["preco"]);?>" required>
                            </div>
                        </div>

                        <!-- CATEGORY -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                CATEGORIA
                            </div>
                            <div class="textField">

                                <select name="cbxCategory" required>

                                    <!-- DEFAULT VALUE -->
                                    <option value="">SELECIONE</option>

                                    <?php

                                        // LOAD CATEGORIES INTO DB

                                        // GET ITEMS FROM DATABASE (mysql_query)
                                        $size = getCategories();

                                        // LOAD ITEMS INTO OPTIONS
                                        for($i = 0; $i < mysql_num_rows($size); $i++){

                                            $rs = mysql_fetch_array($size);

                                            // SET CATEGORIES INTO OPTIONS

                                            // SELECT ACCORDING SELECTED CATEGORY THAT CAME FROM DATABASE
                                            if ($item['idCategoria'] == $rs['idCategoria']) {
                                            ?>
                                                <option selected value="<?php echo $rs['idCategoria'] ?>"><?php echo $rs['categoria'] ?></option>
                                            <?php
                                            }
                                        ?>
                                            <option value="<?php echo $rs['idCategoria'] ?>"><?php echo $rs['categoria'] ?></option>
                                        <?php
                                        }
                                    ?>

                                </select>
                            </div>
                        </div>


                        <!-- SUBCATEGORY -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                SUBCATEGORIA
                            </div>
                            <div id="subcategoryItemsArea">

                                <select name="cbxSubcategory" required>
                                    <!-- onfocus="loadItem('#subcategoryItemsArea');"  -->

                                    <!-- DEFAULT VALUE -->
                                    <option value="">SELECIONE</option>

                                    <?php

                                        // LOAD SUBCATEGORIES INTO DB

                                        // GET ITEMS FROM DATABASE (mysql_query)
                                        $size = getSubcategories(1); /*$_POST["cbxCategory"]*/

                                        // LOAD ITEMS INTO OPTIONS
                                        for($i = 0; $i < mysql_num_rows($size); $i++){

                                            $rs = mysql_fetch_array($size);

                                            // SET SUBCATEGORIES INTO OPTIONS


                                            // SELECT ACCORDING SELECTED CATEGORY THAT CAME FROM DATABASE
                                            if ($item["idSubcategoria"] == $rs["idSubcategoria"]) {
                                            ?>
                                                <option selected value="<?php echo $rs['idSubcategoria'] ?>"><?php echo $rs['subcategoria'] ?></option>
                                            <?php
                                            }
                                        ?>
                                            <option value="<?php echo $rs['idSubcategoria'] ?>"><?php echo $rs['subcategoria'] ?></option>
                                        <?php
                                        }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <!-- STATUS -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                STATUS
                            </div>
                            <div class="textField">

                              <div id="statusIconBox">

                                <!-- CHECK IF mode EQUALS update OR add-->
                                <?php
                                    if($_GET["mode"] == "update"){//CHECK MODE AT URL

                                            // CHECK IF IS TO ACTIVE STATUS OR NOT ACTIVE AS DATA CAME FROM DB

                                            // FILL STATUS AS DATA CAME FROM DB
                                            if ($item['ativo']==1){//ENABLE STATUS

                                                //LOAD GREEN IMAGE
                                                $statusImageBD = "../pictures/icons/greenCheck48x48.png";

                                                //SET STATUS LINK TITLE
                                                $statusLinkTitle = "Ativado";

                                            }else{//DISABLE STATUS

                                                //LOAD GRAY IMAGE
                                                $statusImageBD = "../pictures/icons/grayCheck48x48.png";

                                                //SET STATUS LINK TITLE
                                                $statusLinkTitle = "Desativado";
                                            }


                                                // IMAGE ABOUT ITEM'S STATUS

                                                // LOAD IMAGE AS CAME FROM DB
                                            ?>
                                                <a class="statusLink" title="<?php echo($statusLinkTitle) ?>">
                                                    <img id="statusImage" src="<?php echo($statusImageBD); ?>" title="<?php echo($statusLinkTitle); ?>"  alt="Representação gráfica do status do item. Status atual: <?php echo($statusLinkTitle); ?>">
                                                </a>
                                            <?php




                                    }else if($_GET["mode"] == "add"){//CHECK MODE AT URL

                                        //LOAD DEFAULT DATA

                                        //LOAD GRAY IMAGE
                                        $statusImageBD = "../pictures/icons/grayCheck48x48.png";

                                        //SET STATUS LINK TITLE
                                        $statusLinkTitle = "Desativado";


                                            // IMAGE ABOUT ITEM'S STATUS

                                            // LOAD IMAGE AS CAME FROM DB
                                        ?>
                                        <a class="statusLink" title="<?php echo($statusLinkTitle) ?>">
                                            <img id="statusImage" src="<?php echo($statusImageBD); ?>" title="<?php echo($statusLinkTitle); ?>"  alt="Representação gráfica do status do item. Status atual: <?php echo($statusLinkTitle); ?>">
                                        </a>
                                        <?php
                                    }

                                ?>
                              </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ADD ITEM BUTTON -->
                <div class="addItemButtonBox">
                    <input id="btnSubmit" type="submit" name="btnSubmit" title="Gravar registro" value="&#10004;">
                </div>
            </div>
        </form>
        <!-- ***************************************************************************************************************** -->

            <!-- FOOTER -->
            <footer>
                Desenvolvido por <strong>Caique M. Oliveira</strong>
            </footer>
            <!-- ***************************************************************************************************************** -->
    </body>
</html>
