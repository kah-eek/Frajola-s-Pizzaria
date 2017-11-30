<?php
    function getFileExtension($fileName){
        return substr($fileName,strpos($fileName,"."), 5);
    }

    function encryptPictureName($pictureName, $extension){
        return md5($pictureName).$extension;
    }
    
    function isValidExtension($pictureName, $validExtension){
        
        if(strstr($pictureName, $validExtension)){
            return true;
        }else{
            return false;
        }
    }

    function cutPathNoEnd($path, $begin){

		return substr($path, $begin);
	}

    function addToPath($path, $string){
        return $string.$path;
    }
    
    function setDateFormat($formatTo, $date){

        if (empty($date)) {
            return;
        }

        if($formatTo == "mysql"){
            $day = substr($date, 0, 2);
            $month = substr($date, 3,2);
            $year = substr($date, 6,10);
            
            return $year."-".$month."-".$day;
            
        }else if($formatTo == "user"){
            $day= substr($date, 8,9);
            $month = substr($date, 5,2);
            $year = substr($date, 0,4);
            
            return $day."/".$month."/".$year;
        }
    } 

    function logout($sessionVar, $returnToPage){
        session_unset();
        header("location:".$returnToPage);
    }

    function checkStatus($getURL){
        if ($getURL == "true") {
            return true;
        }else{
            return false;
        }
    }

    function transformTitleToStatus($title){
        
        if ($title == "Ativado") return "true";

        return "false";

    }

    function transformStatusToURL($status){
        if ($status == 1) {
            return "true";
        }else{
            return "false";
        }
    }

    function transformStatusToDB($status){
        if ($status == "true") {
            return 1;
        }else{
            return 0;
        }
    }

?>