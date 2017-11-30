<?php
    //IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/userDAO.php");
    require_once("./modulo/employeeDAO.php");
    require_once("./modulo/whereWeAreDAO.php");
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

    // SET DEFAULT VALUE
    $item = null;


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
            $item = mysql_fetch_array(getItemById($_GET["id"]));
            
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
        <link rel="stylesheet" type="text/css" href="css/cmsAddWhereWeAreItem.css">
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
                        url:"./controller/cmsAddWhereWeAreItemController.php?mode="+mode+"&status="+status+"&id="+id+"",
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
        <form name="frmAddDecadeItem" id="frmAddDecadeItem" method="POST" action="cmsAddDecadeItem.php?mode=<?php echo($_GET['mode']);?>&status=<?php echo($_GET['status']);?>&id=<?php echo($_GET['id']); ?>" enctype="multipart/form-data">
            <div id="main">
                <!-- TEXT FIELDS TO FILL ABOUT NEW ITEM -->
                <div id="showItemsBox">

                    <div id="mainBox">

                        <!-- STREET -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                LOGRADOURO
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="50" placeholder="SOMENTE O NOME DA RUA" onkeypress="return blockType(event,'number')" name="txtStreet" value="<?php echo($item["logradouro"]);?>" required>
                            </div>
                        </div>

                        <!-- NUMBER -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                NÚMERO
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="6" name="txtNumber" onkeypress="return blockType(event,'character')" value="<?php echo($item["numero"]);?>" required>
                            </div>
                        </div>

                        <!-- ZIP CODE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                CEP
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="8" placeholder="SOMENTE NÚMEROS" onkeypress="return blockType(event,'character')" name="txtZipCode" value="<?php echo($item["cep"]);?>" required>
                            </div>
                        </div>

                        <!-- NEIGHBORHOOD -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                BAIRRO
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="180" name="txtNeighborhood" value="<?php echo($item["bairro"]);?>" required>
                            </div>
                        </div>

                        <!-- STATE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                ESTADO
                            </div>
                            <div class="textField">
                                <select required name="cbxState">

                                    <!-- DEFAULT OPTION -->
                                    <option value="">SELECIONE</option>

                                    <!-- GETTING DECADES FROM DB -->
                                    <?php

                                    // GET QUERY FROM DB (mysql_query)
                                    $size = getStates();

                                    for($i = 0; $i < mysql_num_rows($size); $i++){

                                        // TRANSFORM TO ARRAY
                                        $rs = mysql_fetch_array($size);

                                        // SET SELECT ITEM CAME FROM DB
                                        if ($rs["idEstado"] == $item["idEstado"]) {
                                        ?>

                                            <option selected value="<?php echo($rs["idEstado"]);?>"><?php echo($rs["estado"]);?></option>

                                        <?php
                                        }else{
                                        ?>

                                            <option value="<?php echo($rs["idEstado"]);?>"><?php echo($rs["estado"]);?></option>

                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- CITY -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                CIDADE
                            </div>
                            <div class="textField">
                                <select required name="cbxCity">

                                    <!-- DEFAULT OPTION -->
                                    <option value="">SELECIONE</option>

                                    <!-- GETTING DECADES FROM DB -->
                                    <?php

                                    // GET QUERY FROM DB (mysql_query)
                                    $size = getCities();

                                    for($i = 0; $i < mysql_num_rows($size); $i++){

                                        // TRANSFORM TO ARRAY
                                        $rs = mysql_fetch_array($size);

                                        // SET SELECT ITEM CAME FROM DB
                                        if ($rs["idCidade"] == $item["idCidade"]) {
                                        ?>

                                            <option selected value="<?php echo($rs["idCidade"]);?>"><?php echo($rs["cidade"]);?></option>

                                        <?php
                                        }else{
                                        ?>

                                            <option value="<?php echo($rs["idCidade"]);?>"><?php echo($rs["cidade"]);?></option>

                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <!-- PHONE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                TELEFONE
                            </div>
                            <div class="textField">
                                <input type="text" maxlength="11" name="txtPhone" pattern="[0-9]{11}" placeholder="SOMENTE NÚMEROS" title="DDDXXXXXXXX" onkeypress="return blockType(event,'character')"  value="<?php echo($item["telefone"]);?>" required>
                            </div>
                        </div>

                        <!-- MAIN PICTURE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                IMAGEM DO ESTABELECIMENTO
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
                                        <input type="file" name="establishmentPicture">
                                    <?php
                                    }else if($mode == "add"){
                                    ?>
                                        <input type="file" name="establishmentPicture" required>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <!-- BACKGROUND PICTURE -->
                        <div class="labelAndTextFieldBox">
                            <div class="label">
                                ÍCONE DE UMA BANDA
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
                                        <input type="file" name="bandIcon">
                                    <?php
                                    }else if($mode == "add"){
                                    ?>
                                    <input type="file" name="bandIcon" required>
                                    <?php
                                    }
                                }
                                ?>
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
