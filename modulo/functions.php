<?php

	function cutPath($path, $begin, $end){
		return substr($path, $begin, $end);
	}

	function cutPathNoEnd($path, $begin){
		return substr($path, $begin);
	}

//    function completeStringWith($string, $textToComplete, $startToComplete){
//        for($i = 0; $i < strlen($string); $i++){
//
//            $text += String{i}; 
//
//            if (strlen($text)) {
//                # code...
//            }
//        }
//    }

	function setDateFormat($formatTo, $date){
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

    function setPhoneFormat($phone){
        return "(".substr($phone, 0, 3 ).") ".substr($phone, 3, 4)."-".substr($phone, 7);
    }

?>