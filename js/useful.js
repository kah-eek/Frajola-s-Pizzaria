function valed(character, allowType, field){
    //CHECK IF IS IT ACCESSING ON IE
    if(window.Event){
        //CODING TO ASCII
        var letter= character.charCode;
    }else{ 
        //CODING TO ASCII FOR CHROME AND FIREFOX
        var letter = character.which;
    }
    
    //BLOCKING SPECIAL CHARACTERS
    if(allowType=="number"){
        if(letter >= 33 && letter <= 47 || letter >= 58 && letter <= 126 || letter == 168){
            return false;
        }
    }else if(allowType=="character"){
        if(letter >= 48 && letter <= 57){
            return false;            
        }
    }
}

// SET CLICK ON PRODUCT FOR STATISTICS
function setClick(id, table){
    $.ajax({
       type:"POST",
       url:"./controller/indexController.php",
       data:{itemId:id, tableFromDb: table},
       success:function(dados){
        // alert(dados);
        $("#controller").html(dados);
       }
    });
}

function error(rowNumber, archive){
    return "\n\nERROR("+rowNumber+")_"+archive;
}