<?php
    //IMPORTS
    require_once("./modulo/dbFunctions.php");
    require_once("./modulo/functions.php");
    require_once("./modulo/userDAO.php");
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

    //CHECK IF btnLogout EXISTS
    if(isset($_POST["btnLogout"])){
        
        //LOGOUT AND RETURNS TO SITE HOME PAGE
        logout($_SESSION["employeesId"], "../index.php");
        
    }
            $name = "";
            $birthDay = "";
            $sex = "";
            $email = "";
            $cpf = "";
            $salary = "";
            $maritalStatus = "";
            $telephone = "";
            $cellphone = "";
            $privilege = "";
            $username = "";
            $password = "";
            $picturePath = "";
    
    if(isset($_GET["mode"])){
        
        $mode = $_GET["mode"];
        
        //CHECK IF MODE IS TO UPDATE AND ID IS VALID 
        if($mode == "update" && $_GET["id"] > 0){ 
            $employee = getEmployeeById($_GET["id"]);
            
            $name = $employee["nome"];
            
            //SETTING DATE FORMAT TO USER
            $birthDay = setDateFormat("user",$employee["dtNasc"]);
            
            $sex = $employee["sexo"];
            $email = $employee["email"];
            $cpf = $employee["cpf"];
            $salary = $employee["salario"];
            $maritalStatus = $employee["estado_civil"];
            $telephone = $employee["telefone"];
            $cellphone = $employee["celular"];
            $privilege = $employee["privilegio"];
            $username = $employee["usuario"];
            $password = $employee["senha"];
            $picturePath = $employee["foto_perfil"];
        }
    }

    //CHECK IF BUTTON btnSubmit WAS CLICKED
    if(isset($_POST["btnSubmit"])){
        $name = $_POST["txtName"];
        $email = $_POST["txtEmail"];
        $cpf = $_POST["txtCpf"];
        $cellphone = $_POST["txtCellphone"];
        $telephone = $_POST["txtTelephone"];
        $salary = $_POST["txtSalary"];
        $username = $_POST["txtUsername"];
        $password = $_POST["txtPassword"];
        
        //SETTING DATE FORMAT TO MYSQL DB
        $dtBirth = setDateFormat("mysql",$_POST["txtDtBirth"]);
        
        $privilege = $_POST["cbxPrivilege"];
        $sex = $_POST["rbnSex"];
        $maritalStatus = $_POST["cbxMaritalStatus"];
        
        
        //CHECK IF IS TO UPDATE EMPLOYEE
        if(isset($_GET["mode"])){
            $mode = $_GET["mode"];
            
            if($mode == "update"){
                
                //GETTING PICTURE'S NAME
                $archiveName = basename($_FILES["employeeProfilePicture"]["name"]);
                
                //CHECK IF IS NOT TO UPDATE EMPLOYEE PROFILE PICTURE
                if(empty($archiveName)){//HERE IT ISN'T TO UPDATE EMPLOYEE PROFILE PICTURE
                    
                     //GETTING EMPLOYEE'S ID
                    $employee = getEmployeeById($_GET["id"]);

                    //UPDATE EMPLOYEE INTO DB
                    $sql = "UPDATE tbl_funcionario AS func, tbl_usuario AS usr SET func.nome = '".$name."', func.email = '".$email."', func.cpf = '".$cpf."', func.celular = '".$cellphone."', func.telefone = '".$telephone."', func.salario = ".$salary.", func.dtNasc = '".$dtBirth."', func.sexo = '".$sex."', func.idEstadoCivil = ".$maritalStatus.", usr.idPrivilegio = ".$privilege.", usr.usuario = '".$username."', usr.senha = '".$password."' WHERE func.idFuncionario = ".$employee["idFuncionario"]." AND usr.idFuncionario = ".$employee["idFuncionario"]; 


                    mysql_query($sql);
                    /* ************************************************************************************************ */

                    //MOVE TO PREVIOUS PAGE
                    header("location:cmsHome.php");
                    
                }else{//HERE IT'S TO UPDATE EMPLOYEE PROFILE PICTURE
                    
                    //VALIDATE FILE EXTENSION FILE
                    if(strstr($archiveName, ".jpg") || strstr($archiveName, ".png")){

                        //SETTING PATH TO EMPLOYEE PROFILE PICTURE
                        $uploadPath = "../pictures/employees/pictures/profile/";

                        //GETTING ONLY FILE EXTENSION
                        $extension = getFileExtension($archiveName);

                        //ENCRYPT DATA
                        $archiveName = encryptPictureName($archiveName ,$extension);

                        //READY TO UPLOAD IMAGE (path + archive name)
                        $readyToUpload = $uploadPath.$archiveName;

                        //MOVING FILE
                        if(move_uploaded_file($_FILES["employeeProfilePicture"]["tmp_name"], $readyToUpload)){ //QUANDO MOVEMOS O ARQUIVO O PHP JÁ DEFINE O NOME DO ARQUIVO ? QUANOD O NOME DO ARQUIVO É DEFINIDO ?
                            
                            //GETTING EMPLOYEE'S ID
                            $employee = getEmployeeById($_GET["id"]);

                            //UPDATE EMPLOYEE INTO DB
                            $sql = "UPDATE tbl_funcionario AS func, tbl_usuario AS usr SET func.nome = '".$name."', func.email = '".$email."', func.cpf = '".$cpf."', func.celular = '".$cellphone."', func.telefone = '".$telephone."', func.salario = ".$salary.", func.dtNasc = '".$dtBirth."', func.sexo = '".$sex."', func.idEstadoCivil = ".$maritalStatus.", usr.idPrivilegio = ".$privilege.", usr.usuario = '".$username."', usr.senha = '".$password."', foto_perfil = '".$readyToUpload."' WHERE func.idFuncionario = ".$employee["idFuncionario"]." AND usr.idFuncionario = ".$employee["idFuncionario"]; 


                            mysql_query($sql);
                            /* ************************************************************************************************ */

                            //MOVE TO PREVIOUS PAGE
                            header("location:cmsHome.php");

                        }else{
                        ?>
                            <script type="text/javascript">
                                alert("Falha ao registrar a imagem no Bando de Dados :(");
                            </script>
                        <?php
                        }

                    }else{//ALERT ABOUT FILE EXTENSION
                    ?>
                        <script type="text/javascript">
                            alert("Extensão inválida!");
                        </script> 
                    <?php
                    }
                }
                
            }
            
        }else{
            
            //CHECK IF ALREADY EXISTS CPF INTO DB OR USERNAME
            if(!existsCpf($cpf) && !existsUser($username)){
                
                //GETTING PICTURE'S NAME
                $archiveName = basename($_FILES["employeeProfilePicture"]["name"]);

                //VALIDATE FILE EXTENSION
                if(isValidExtension($archiveName, ".jpg") || isValidExtension($archiveName,".png")){
                // if(strstr($archiveName, ".jpg") || strstr($archiveName, ".png")){

                    //SETTING PATH TO EMPLOYEE PROFILE PCTURE
                    $uploadPath = "../pictures/employees/pictures/profile/";

                    //GETTING ONLYE FILE EXTENSION
                    $extension = getFileExtension($archiveName);
    //                $extension = substr($archiveName, strpos($archiveName, "."), 5);

                    //ENCRYPTING DATA
                    $archiveName = encryptPictureName($archiveName,$extension);
    //                $archiveName = md5($archiveName).$extension;

                    //READY TO UPLOAD IMAGE (path + archive name)
                    $readyToUpload = $uploadPath.$archiveName;

                    if(move_uploaded_file($_FILES["employeeProfilePicture"]["tmp_name"], $readyToUpload)){

                        //INSERT NEW EMPLOYEE INTO DB
                        $sql = "INSERT INTO tbl_funcionario (nome,email,cpf,celular,telefone,salario,dtNasc,sexo,idEstadoCivil) VALUES(
                                '".$name."','".$email."','".$cpf."','".$cellphone."','".$telephone."',".$salary.",'".$dtBirth."','".$sex."',".$maritalStatus.")";

                        mysql_query($sql);
                        /* ************************************************************************************************ */

                        //GETTING EMPLOYEE'S ID    
                        $employeeId = getEmployeeId($cpf);
                        /* ************************************************************************************************ */

                        //INSERTING DATA INTO tbl_usuario ABOUT NEW INSERTED EMPLOYEE
                        $sql = "INSERT INTO tbl_usuario (usuario, senha, idPrivilegio, idFuncionario, foto_perfil) VALUES(
                                '".$username."','".$password."',".$privilege.",".$employeeId.",'".$readyToUpload."')";

                        mysql_query($sql);        
                        /* ************************************************************************************************ */  

                        //MOVE TO PREVIOUS PAGE
                        header("location:cmsHome.php");

                    }else{
                    ?>
                        <script type="text/javascript">
                            alert("Falha ao registrar a imagem no Bando de Dados :(");
                        </script>
                    <?php
                    }

                }else{//ALERT ABOUT FILE EXTENSION 
                ?>
                    <script type="text/javascript">
                        alert("Extensão inválida!");
                    </script>   
                <?php
                }          
                
            }else{
                
                if(existsCpf($cpf)){
                    //SHOW ALERT ABOUT CPF ALREADY EXISTS INTO DB
                    ?>
                        <script type="text/javascript">
                            alert("CPF \"<?php echo($cpf)?>\" já cadastrado!");
                        </script>
                    <?php
                }else{
                     //SHOW ALERT ABOUT USERNAME ALREADY EXISTS INTO DB
                    ?>
                        <script type="text/javascript">
                            alert("Nome de usuário \"<?php echo($username)?>\" não disponível!");
                        </script>
                    <?php
                }
            }
        }
    }
    
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Frajola’s Pizzaria - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/cmsAddUser.css">
        <link rel="shortcut icon" type="image x-icon" href="../pictures/logo/logo.png">
        <script src="js/useful.js"></script>
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
        <?php
            //CHECK IF mode IS EQUALS "update", IF IT IS SO UPDATE EXISTENT EMPLOYEE
            if(isset($_GET["mode"])){
                $mode = $_GET["mode"];
                
                if($mode == "update"){
                ?>
                    <form name="frmAddUser" method="post" action="cmsAddUser.php?id=<?php echo(getEmployeeId($cpf));?>&mode=update" enctype="multipart/form-data">
                        
                <?php
                }
                
            }else{
            ?>
                    <form name="frmAddUser" method="post" action="cmsAddUser.php" enctype="multipart/form-data">
      
            <?php
            }
        ?>
            <div id="main">
                <!-- TEXT FIELDS TO FILL ABOUT USER -->
                <div id="showUsersBox">
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            NOME COMPLETO
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="text" name="txtName" onkeypress="return blockType(event,'number')" maxlength="180" value="<?php echo($name);?>" required>
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            CELULAR
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="tel" onkeypress="return blockType(event,'character')" pattern="[0-9]{3}[0-9]{9}" title="DDDxxxxxxxxx" placeholder="SOMENTE NÚMEROS" name="txtCellphone" maxlength="12" value="<?php echo($cellphone);?>" required>
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            E-MAIL
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="email" name="txtEmail" maxlength="70" value="<?php echo($email);?>" required>
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            TELEFONE
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="tel" pattern="[0-9]{3}[0-9]{8}" title="DDDxxxxxxxx" placeholder="SOMENTE NÚMEROS" onkeypress="return blockType(event, 'character')" name="txtTelephone" value="<?php echo($telephone);?>" maxlength="11">
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            USUÁRIO
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="text" name="txtUsername" maxlength="90" value="<?php echo($username);?>" required>
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            SENHA
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="password" name="txtPassword" maxlength="180" value="<?php echo($password);?>" required>
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            CPF
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="text" name="txtCpf" onkeypress="return blockType(event, 'character')" maxlength="11" title="SOMENTE NÚMEROS" value="<?php echo($cpf);?>" required>
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            DATA DE NASCIMENTO
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="text" placeholder="__/__/____" name="txtDtBirth" maxlength="10" onkeypress="return blockType(event, 'noDate')" title="DD/MM/AAAA" value="<?php echo($birthDay);?>" required>
                        </div>
                    </div>
                    
                    <div class="labelAndField">
                        <div class="labelField">
                            SALÁRIO
                        </div>
                        <div class="textField">
                            <input class="inputBox" type="text" name="txtSalary" onkeypress="return blockType(event, 'character')" value="<?php echo($salary);?>" maxlength="7" required>
                        </div>
                    </div>
                    
                    <div class="smallLabelAndField">
                        <div class="smallLabelField">
                            PRIVILÉGIO
                        </div>
                        <div class="smallTextField">
                            <select name="cbxPrivilege" required>
                                
                                <!-- DEFAULT OPTION -->
                                <option value="">Selecione</option>
                                
                                <?php
                                    $sql = "SELECT idPrivilegio, privilegio FROM tbl_privilegio";
                                    $query = mysql_query($sql);

                                    while($rs = mysql_fetch_array($query)){
                                        
                                        //  CHECK IF THIS INDEX CAMES FROM EMPLOYEE'S PROFILE SELECTED 
                                        if($privilege == $rs["privilegio"]){
                                        ?>
                                
                                        <option selected value="<?php echo($rs["idPrivilegio"]);?>"><?php echo($rs["privilegio"]);?></option>
                                        
                                        <?php
                                        }else{
                                        ?>
                                
                                        <option value="<?php echo($rs["idPrivilegio"]);?>"><?php echo($rs["privilegio"]);?></option>
                                
                                        <?php
                                        }     
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="smallLabelAndField">
                        <div class="smallLabelField">
                            ESTADO CIVIL
                        </div>
                        <div class="smallTextField">
                            <select name="cbxMaritalStatus" required>
                                
                                <!-- DEFAULT OPTION -->
                                <option value="">Selecione</option>
                                
                                <?php
                                    $sql = "SELECT idEstadoCivil, estado_civil FROM tbl_estado_civil";
                                    $query = mysql_query($sql);

                                    while($rs = mysql_fetch_array($query)){
                                        
                                        //CHECK IF THIS INDEX CAMES FROM EMPLOYEE'S PROFILE SELECTED 
                                        if($maritalStatus == $rs["estado_civil"]){
                                        ?>
                                
                                        <option selected value="<?php echo($rs["idEstadoCivil"]);?>"><?php echo($rs["estado_civil"]);?></option>
                                
                                        <?php
                                        }else{
                                        ?>
                                
                                        <option value="<?php echo($rs["idEstadoCivil"]);?>"><?php echo($rs["estado_civil"]);?></option>
                                
                                        <?php
                                        }   
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="smallLabelAndField">
                        <div id="sexSmallLabelField">
                            SEXO
                        </div>
                        <div id="sexSmallTextField">
                            <?php
                                if($sex == "M"){
                                ?>
                            
                                <input type="radio" name="rbnSex" value="M" checked><span class="rbnLabel">Masculino</span>
                                <input class="rbnSex" type="radio" name="rbnSex" value="F"><span class="rbnLabel">Feminino</span>
                            
                                <?php
                                }else if($sex == "F"){
                                ?>
                            
                                <input type="radio" name="rbnSex" value="M"><span class="rbnLabel">Masculino</span>
                                <input class="rbnSex" type="radio" name="rbnSex" value="F" checked><span class="rbnLabel">Feminino</span>
                                
                                <?php
                                }else{
                                ?>
                            
                                <input type="radio" name="rbnSex" value="M" checked><span class="rbnLabel">Masculino</span>
                                <input class="rbnSex" type="radio" name="rbnSex" value="F" ><span class="rbnLabel">Feminino</span>
                                
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
                
                <!-- EMPLOYEE PROFILE PICTURE -->
                <div id="profileImgBox">
                    <div id="profileImg">
                        
                        <?php
                        //CHECK IF EXITS A PROFILE PICTURE
                        if($picturePath != ""){
                        ?>
                        
                            <!-- PROFILE PICTURE -->
                            <img id="profileImgResize" src="<?php echo($picturePath);?>" title="Foto de Perfil" alt="Foto de perfil do usuário a ser cadastrado">
                        
                            <!-- UPLOAD BUTTON BOX -->
                            <div id="uploadButtonBox">
                                <input type="file" value="<?php echo($picturePath);?>" name="employeeProfilePicture">
                            </div>

                        <?php
                        }else{
                        ?>
                            <!-- PROFILE PICTURE -->
                            <img id="profileImgResize" src="../pictures/icons/employeeProfilePicture.png" title="Foto de Perfil" alt="Foto de perfil do usuário a ser cadastrado">
                        
                            <!-- UPLOAD BUTTON BOX -->
                            <div id="uploadButtonBox">
                                <input required type="file" name="employeeProfilePicture">
                            </div>
                        
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
                
                <!-- ADD USER BUTTON -->
                <div class="addUserButtonBox">
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