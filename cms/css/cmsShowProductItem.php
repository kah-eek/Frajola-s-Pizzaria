<?php

  // SET EXTENSION OF OUTPUT LIKE FILE .php
  header("Content-type: text/css");

  // IMPORTS
  require_once("../modulo/productDAO.php");
  require_once("../modulo/dbFunctions.php");
  // ***************************

  // CONNECT TO DATABASE
  connectToDB();
  // *********************

?>

/* CSS */

/* FONT'S IMPORT*/
@font-face{
    font-family: CarvedRock;
    src: url("../../fonts/carved-rock/CarvedRock.ttf");
}
*{
    padding: 0px;
    margin: 0px;
}
/* ------- PRODUCT'S DATA MODAL -----*/
 .modalContainer{
    width:100%;
    height:100%;
    background: rgba(0, 0, 0, 0.3);
    /*background-color: aqua;*/
    position:fixed;
    display:none;
    z-index: 999;
 }
 .modal{
    transition: 5s;
    width:500px;
    height:200px;
    background-color:#212121;
    margin:auto;
    margin-top:300px;
    /* border: groove 5px #FF6E40; */
    border-radius: 50px 50px 50px 50px;
    box-shadow: 1px 1px 1000px #000000;
 }
 .modal:hover{
   transition-duration: 2s;
   box-shadow: 1px 1px 100px #FF6E40;
 }
 /* *********************************** */
body{
    background-color: #000000;
    font-family: CarvedRock;
}
#labelAndDataBox{
    width: 680px;
    height: 610px;
    float: left;
    border-radius: 0px 0px 25px 0px;
    /*background-color: brown;*/
}
#profilePictureBox{
    transition: 2s;
    float: left;
    width: 300px;
    height: 300px;
    border-radius: 25px 0px 25px 0px;
    margin-right: 10px;
    /*background-color: aqua;*/
}
#profilePictureBox:hover{
    transition: 1s;
    box-shadow: 1px 1px 15px #FF3D00;
}
#profilePicture{
    width: 300px;
    height: 300px;
    border-radius: 25px 0px 25px 0px;
}
.labelAndData{
    transition: 2s;
    width: 660px;
    height: 30px;
    padding-left: 10px;
    padding-top: 20px;
    float: left;
    border-radius: 5px 5px 5px 5px;
    /*background-color: green;*/
}
.labelAndData:hover{
    transition: 1s;
    background-color: #eee;
    box-shadow: 1px 1px 10px #000000;

}
.labelAndData:hover > .labelModal{
    transition: 2s;
    color: #000;
    text-shadow: 1px 1px 1px #FF6E40;
}
.labelAndData:hover > .dataModal{
    transition: 2s;
    color: #000;
}
.labelModal{
    font-family: CarvedRock;
    font-size: 18px;
    color: #000000;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 1px 1px 1px #FF6E40;
}
.dataModal{
    font-family: CarvedRock;
    font-size: 18px;
    color: #212121;
    padding-left: 5px;
    font-weight: bold;
    letter-spacing: 1px;
    text-transform: uppercase;
    /*text-shadow: 1px 1px 2px #FF6E40;*/
}
/* ------------- HEADER --------------*/
header{
    width: 1200px;
    height: 100px;
    background-color: #FF6E40;
    margin-left: auto;
    margin-right: auto;
    border-radius: 20px 20px 0px 0px;
}
#headerTitle{
    width: 1075px;
    height: 70px;
/*    background-color: green;*/
    float: left;
    border-radius: 20px 0px 0px 0px;
    padding-left: 25px;
    padding-top: 30px;

    /* TEXT */
    text-align: left;
    font-size: 34px;
    font-weight:bold;
    text-shadow: 1px 1px 1px #000000;
}
#headerLogo{
    width: 100px;
    height: 100px;
/*    background-color: red;*/
    float: left;
    border-radius: 0px 20px 0px 0px;
}
#logo{
    width: 100px;
    height: 100px;
}
/* ------------- NAVEGATION ------------*/
nav{
    width: 1200px;
    height: 200px;
    margin-left: auto;
    margin-right: auto;
    background-color: #90A4AE;
}
.sectionItem{
    width: 225px;
    height: 200px;
    float: left;
/*    background-color: blueviolet;*/
}
.sectionItemImgBox{
    width: 150px;
    height: 125px;
    padding-top: 25px;
    padding-left: 75px;
/*    background-color: antiquewhite;*/
}
.sectionItemImg{
    width: 100px;
    height: 100px;
/*    background-color: brown;*/
}
.sectionItemLabelBox{
    width: 250px;
    height: 40px;
    padding-top: 10px;
/*    border: solid #000000;*/
/*    background-color: dodgerblue;*/

    /* TEXT */
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-shadow: 1px 1px 1px #FF6E40;
}
#welcomeBox{
    width: 300px;
    height: 200px;
    float: left;
    /*background-color: greenyellow;*/
}
#welcomeField{
    width: 300px;
    height: 45px;
    /*background-color: cadetblue;*/
    word-break: break-all;
    padding-top: 65px;

    /* TEXT */
    text-align: center;
    font-size: 19px;
    text-shadow: 1px 1px 1px #000000;
}
#welcomeFieldName{
    width: 300px;
    height: 45px;
    /*background-color: cadetblue;*/
    word-break: break-all;

    /* TEXT */
    text-align: center;
    font-size: 19px;
    text-shadow: 1px 1px 1px #000000;
}
#btnLogoutBox{
    width: 150px;
    height: 50px;
/*    background-color: blueviolet;*/
    padding-left: 150px;
}
#btnLogout{
    background-color: transparent;
    width: 100px;
    height: 25px;
    border: 0px;

    /* TEXT */
    font-size: 16px;
    color: #000000;
    font-weight: bold;
    text-shadow: 1px 1px 5px #FF6E40;
}
/* ------------- MAIN CONTENT ------------*/
#main{
    width: 1200px;
    min-height: 800px;
    height: auto;
    margin-left: auto;
    margin-right: auto;
    background-color: #E0E0E0;
}
#showProductItemsBox{
    width: 1180px;
    min-height: 505px;
    height: auto;
    padding-top: 25px;
    padding-left: 10px;
    padding-right: 10px;
    overflow: auto;
    /* background-color: aqua; */
}
#itemLabelBox{
    width: 1180px;
    height: 60px;
    background-color: green;
    border-radius: 5px 5px 5px 5px;
    margin-bottom: 15px;
}
.itemLabel{
    width: 293px;
    height: 40px;
    padding-top: 20px;
    background-color: #FF6E40;
    float: left;
    border-right: solid 1px #212121;
    border-left: solid 1px #212121;

    /* TEXT */
    text-align: center;
    font-family: CarvedRock;
    font-weight:bold;
    font-size: 20px;
    text-transform: uppercase;
}
.decadeItemBox{
    transition: 2s;
    width: 1180px;
    height: 120px;
    border-radius: 10px 10px 10px 10px;
    margin-bottom: 25px;
/*    background-color: green;*/
}
.decadeItemBox:hover{
    transition: 1s;
    box-shadow: 1px 1px 15px #000;
}
.decadeItemBox:hover>.itemStatus{
    width: 133px;
    border-left: solid 1px #212121;
    border-right: solid 1px #212121;
}
.decadeItemBox:hover>.editDeleteBox img{
    display: block;
    transition: 2s;
}
.itemImage{
    width: 295px;
    height: 120px;
    float: left;
    background-color: orange;
    border-radius: 10px 0px 0px 10px;
}
.itemImage img{
    width: 295px;
    height: 120px;
    border-radius: 10px 0px 0px 10px;
}
.itemTitle{
    width: 293px;
    height: 80px;
    float: left;
    overflow: auto;
    background-color: #757575;
    padding-top: 40px;
    border-left: solid 1px #212121;
    border-right: solid 1px #212121;
    /* TEXT */
    text-align: center;
    font-family: CarvedRock;
    font-weight:bold;
    font-size: 20px;
    text-transform: uppercase;
}
.itemDescription{
    width: 283px;
    height: 100px;
    float: left;
    overflow: auto;
    background-color: #757575;
    padding-top: 20px;
    padding-left: 5px;
    padding-right: 5px;
    border-left: solid 1px #212121;
    border-right: solid 1px #212121;

    /* TEXT */
    text-align: justify;
    font-family: CarvedRock;
    font-weight:bold;
    font-size: 16px;
}
.itemStatus{
    width: 135px;
/*    width: 175px;*/
    height: 80px;
    float: left;
    padding-left: 120px;
    padding-top: 40px;
/*    border-radius: 0px 10px 10px 0px;*/
    background-color: #757575;
}
.itemStatus img{
    width: 48px;
    height: 48px;
}
.editDeleteBox{
  width: 40px;
  height: 120px;
  border-radius: 0px 10px 10px 0px;
  float: left;
  background-color: #757575;
}
.editDeleteBox img{
    width: 32px;
    height: 32px;
    padding-top: 20px;
    display: none;
    padding-left: 5px;
    /* background-color: aqua;*/
}
.addItemButtonBox{
    transition: 1s;
    width: 80px;
    height: 70px;
    float: left;
    padding-left: 1030px; /* 1120px */
    /*background-color: darkseagreen;*/
}

/*CHART AREA*/
#chartArea{
    width: 1100px;
    height: 400px;
    padding: 50px;
    /*background-color: green;*/
}
#chartLabelBox /* - LEFT SIDE*/{
    width: 150px;
    height: 300px;
    float: left;
    border-radius: 15px 0px 0px 0px;
    background-color: #cccccc;
}

/*UP LABEL*/
#chartUpLabel{
    width: 150px;
    height: 50px;
    border-right: solid 5px #FF6E40;
    /*background-color: purple;*/
}
.chartDataAndLabelBox{
    width: 65px;
    height: 35px;
    padding-top: 15px;
    padding-right: 10px;
    /*background-color: orange;*/
    float: left;

    /*TEXT*/
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
}

/*MIDDLE LABEL*/
#chartMiddleLabel{
    width: 140px;
    height: 120px;
    padding-top: 100px;
    padding-right: 10px;
    border-right: solid 5px #FF6E40;
    /*background-color: blue;*/

    /*TEXT*/
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
}

/*BOTTOM LABEL*/
#chartBottomLabel{
    width: 140px;
    height: 17px;
    padding-top: 13px;
    padding-right: 10px;
    border-right: solid 5px #FF6E40;
    border-bottom: solid 2px #FF6E40;
    /* background-color: gray; */

    /*TEXT*/
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
}

/* CHART COLUMNS AREA */
#chartColumnsArea{
  width: 945px;
  height: 300px;
  float: left;
  margin-left: 5px;
  border-radius: 0px 15px 0px 0px;
  border-bottom: solid 2px #FF6E40;
  background-color: #cccccc;
}

/*CHART COLUMNS*/
<?php
    $size = getMarketingData(3);
    for ($i = 0; $i < mysql_num_rows($size); $i++){
      $items = mysql_fetch_array($size);

      // CHART HEIGHT
      $height = getColumnChart($items["click"]);

      // CHECK IF $height IS SMALLER THAN 1 TO MULTIPLY IT FOR 100
      if ($height < 1) {
        $height = $height*100;
      }
    ?>
      /*COLUMN <?php echo($i+1); ?>*/
      #chartColumn0<?php echo($i+1); ?>{
      width: 100px;
      height:<?php echo($height."px"); ?>;
      margin-top:<?php echo(300-$height)."px"; ?>; /* margin-top -= height*/
      float: left;
      margin-left: 165px;
      border-radius: 10px 10px 0px 0px;
      background-color: #212121;
      box-shadow: 1px 1px 20px #FF6E40;
      }
    <?php
    }
?>;



/* ********************* */

/*BOTTOM BAR - CHARTS TITLE*/
#bottomBar{
  width: 1100px;
  height: 40px;
  float: left;
  border-radius: 0px 0px 25px 25px;
  border-top: solid 5px #FF6E40;
  /*background-color: green;*/
}

/*BOTTOM BAR LABEL*/
#bottomBarlabel{
  width: 140px;
  height: 30px;
  float: left;
  border-right: solid 5px #FF6E40;
  border-radius: 0px 0px 0px 25px;
  /*background-color: purple;*/
  padding-top: 10px;
  padding-right: 10px;

  /*TEXT*/
  text-align: right;
  font-weight: bold;
  text-transform: uppercase;
}

/* COLUMNS LABEL */
.columnLabel{
  width: 100px;
  height: 30px;
  margin-left: 165px;
  float: left;
  /* background-color: yellow; */
  padding-top: 10px;

  /*TEXT*/
  font-size: 18px;
  text-shadow: 1px 1px 2px #000000;
  /*font-weight: bold;*/
  text-align: center;
}
/* ****************** */

/* BUTTONS' AREA */
#buttonsArea{
  width: 1200px;
  height: 65px;
  /* background-color: green; */
}
.buttonsBox{
    width: 70px;
    height: 70px;
    float: left;
    padding-left: 20px;
    /*padding-left: 50px;*/
    /* background-color: green; */
}
.buttonsBox img{
    transition: 1s;
    width: 59px;
    height: 59px;
    background-color: #FF8867;
    border: solid 1px #757575;
    border-radius: 30px 30px 30px 30px;
    box-shadow: 1px 1px 5px #212121;
}
.buttonsBox img:hover{
    transition: 2s;
    background-color: #FF6E40;
    box-shadow: 1px 1px 25px #212121;
}
#addItemButtonImg{
    width: 65px;
    height: 65px;
    transition: 1s;
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    transform: rotate(-90deg);
    /*background-color: yellow;*/
}
#addItemButtonImg:hover{
    transition: 1s;
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);

}
/* ------------- FOOTER ------------*/
footer{
    width: 1200px;
    height: 50px;
    background-color: #FF6E40;
    border-radius: 0px 0px 20px 20px;
    padding-top:30px;

    /* TEXT */
    text-align: center;
    font-weight: bold;
    margin-left: auto;
    margin-right: auto;
    color: #000000;
    font-size: 20px;
    text-shadow: 1px 1px 1px #212121;
}

/* ------------- GENERAL ---------------*/
a{
  text-decoration: none;
  color: #212121;
  font-family: CarvedRock, "Chaparral Pro";
}
