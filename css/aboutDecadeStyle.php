<?php

  // Define que o arquivo terá a codificação de saída no formato CSS
  header("Content-type: text/css");
  
  /*IMPORT*/
  require_once("../modulo/dbFunctions.php");
  require_once("../modulo/decadeDAO.php");
  require_once("../modulo/functions.php");
  /* *************** */

  connectToDB();

?>

/*FONT`s IMPORT*/
@font-face{
    font-family: hemiheadbdi;
    src: url("../fonts/hemihead426/hemiheadbdit.ttf");
}
@font-face{
    font-family: CarvedRock;
    src: url("../fonts/carved-rock/CarvedRock.ttf");
}
/* ********************************************* */

body{
  margin: 0px;
  padding: 0px;
  background-image: url("../pictures/background/crazyVibe.png");
  background-size: cover;
  background-attachment: fixed;
}
header{
  width: 100%;
  height: 80px;
  background-color: #000000;
  position: fixed;
  z-index: 999;
}
#fillBlank{
  width: 100%;
  height: 80px;
}
/*---------------- MENU -----------------*/
nav{
  width: 1200px;
  height: 50px;
  margin-left: auto;
  margin-right: auto;
}
/*-- MENU ITEMS --*/
#logo{
  width: 100px;
  height: 80px;

/*  background-color: gray;*/

  float: left;
}
#logoImg{
    width: 100px;
    height: 80px;
}
.menuItems{
  width: 150px;
  height: 50px;
  padding-top: 30px;
  text-align: center;
  float: left;

  /*TEXT*/
  font-family: verdana, "Chaparral Pro";
  font-size: 14px;
  color: #d84315;
  font-weight:bold;
}
#loginArea{
  width: 200px;
  height: 80px;
  float: left;
}
.inputArea_LOGIN{
  width: 90px;
  height: 65px;
  padding-top: 15px;
  text-align: left;
  float: left;

  /*TEXT*/
  font-family: verdana, "Chaparral Pro";
  font-size: 14px;
  color: #d9d9d9;
}
.inputText_LOGIN{
  width: 85px;
  float: left;
}
#buttonArea_LOGIN{
  width: 20px;
  height: 48px;
  padding-top: 32px;
  float: left;
}
#btnOk_LOGIN{
  width: 20px;
  height: 20px;
  padding: 0px;
  font-size: 10px;
  float: left;
}
/*------------ MAIN CONTENT -----------------*/
main{
    width: 100%;
    height: 100%;
/*    background-color: aqua; */
}
section{
    width: 100%;
    height: 100%;
/*    background-color: green;*/
}

/*-- MAIN TITLE --*/
#mainTitleBox{
    width: 100%;
    height: 100px;
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.4);
    padding-bottom: 35px;
/*    background-color: green;*/
}
#mainTitle{
    width: 1200px;
    height: 80px;
    padding-top: 20px;
/*    background-color: paleturquoise;*/
    margin-left: auto;
    margin-right: auto;
}
h1{
  text-align: center;
  color: #d84315;
  font-family: hemiheadbdi, "Bernard MT Condensed";
  font-size: 48px;
  font-weight: bold;
  margin: 0px;
  text-shadow: 2px 2px 1px #000000;
}

/*-- LOCAL STRIP --*/
.StripBox{
    width: 100%;
    height: 415px;
    background-color: #263238;
    background: rgb(38,50,56);
    background: rgba(38,50,56, 0.5);
    padding-top: 15px;
    padding-bottom: 10px;
    box-shadow: 5px 5px 5px #212121;
    
    /* TEXT */
    word-wrap: break-word;
    text-align: center;
}
.textShadow{
    text-shadow: 2px 2px 1px #000000;
    font-family: CarvedRock, "Chaparral Pro";
    font-size: 32px;
    font-weight: bold;
    color: #d84315;
}
<?php
  
  /*GETTING BACKGROUND PICTURES*/
  $items = getActiveItems();

  for($i = 0; $i < mysql_num_rows($items); $i++){

    $item = mysql_fetch_array($items);
  ?>

    #<?php echo("item_".$item["idItemPagina"]); ?>{
    width: 100%;
    height: 380px;
    background-color: #263238;
    background-image: url("<?php echo(cutPathNoEnd($item['imagemFundo'], 1)); ?>");
    background-attachment: fixed;
    background-size: cover;
/*
    background: rgb(38,50,56);
    background: rgba(38,50,56, 0.1);
*/
    }

  <?php
  }

?>
.strip{
    margin-left: auto;
    margin-right: auto;
    width: 1200px;
    height: 380px;
/*    background-color: #263238; */
}
.labelAndPicture{
    width: 390px; 
    height: 380px;
/*    background-color: darkorange;*/
    float: left;
}
.label{
    width: 390px;
    height: 40px;
    padding-top: 10px;
/*    background-color: aqua;*/
    
    /* TEXT */
    text-align: center;
    word-wrap: break-word;
    font-family: CarvedRock, "Chaparral Pro";
    font-size: 28px;
    font-weight: bold;
    color: #d84315;
}
.picture{
    width: 380px;
    height: 320px;
    padding-top: 10px;
    padding-left: 10px;
/*    background-color: yellow;*/
}
.img{
    width: 370px;
    height: 310px;
    border-radius: 10px 10px 10px 10px;
}
.description{
    width: 770px;
    height: 335px;
    padding-right: 40px;
    padding-top: 45px;
/*    background-color: darkseagreen;*/
    float: left;
    
     /* TEXT */
    text-align: justify;
    word-wrap: break-word;
    font-family: CarvedRock, "Chaparral Pro";
    font-size: 22px;
    font-weight: bold;
    color: #d84315;
    text-shadow: 2px 2px 1px #000000;
}
/****************** BLANK SPACE ******************/
#blankSpace{
    width: 1200px;
    height: 400px;
/*    background-color: aqua;*/
    margin-left: auto;
    margin-right: auto;
}

/****************** FOOTER ******************/
footer{
  width: 100%;
  height: 150px;
  float: left;
  background-color: #263238;
}
#footerBox{
  width: 1200px;
  height: 150px;
  margin-left: auto;
  margin-right: auto;
  background-color: #263238;
}
#leftSideFooter{
  width: 200px;
  height: 100px;
  float: left;
  padding-top: 50px;
/*  background-color: aqua; */

  /*TEXT*/
  text-align: center;
  color: #d84315;
  font-size: 10px;
  font-family: verdana, "Chaparral Pro";
}
.icon{
    width: 55px;
    height: 55px;
    margin-left: 8px;
}
#rightSideFooter{
  width: 300px;
  height: 50px;
  float: left;
  padding-top: 100px;

  /*TEXT*/
  text-align: center;
  color: #d84315;
  font-size: 16px;
  font-family: verdana, "Chaparral Pro";
}
#rightSideFooter a{
  text-align: center;
  color: #d84315;
  font-size: 16px;
  font-weight: bold;
  font-family: CarvedRock, "Chaparral Pro";
}

#centerSpaceFooter{
  width: 700px;
  height: 150px;
  float: left;
}
#frsText{
  width: 720px;
  height: 50px;
  padding-top: 25px;

  /*TEXT*/
  text-align: center;
  color: #d84315;
  font-size: 18px;
  font-family: verdana, "Chaparral Pro";
}
#scdnText{
  width: 720px;
  height: 50px;
  padding-top: 25px;

  /*TEXT*/
  text-align: center;
  color: #d84315;
  font-size: 18px;
  font-family: verdana, "Chaparral Pro";
}
/*******************************************/

/**************** GENERAL tags *************/
a{
  text-decoration: none;
  color: #d84315;
  font-family: CarvedRock, "Chaparral Pro";
  font-size: 14px;
}
/*******************************************/
