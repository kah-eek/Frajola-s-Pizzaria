function blockType(character,blockType){
    
    //CHECK IF ACCESS IS ACROSS IE
    if(window.Event){
        //CODING TO ASCII
        var letter = character.charCode;
    }else{
        //CODING TO ASCII
        var letter = character.which;
    }
    
    //BLOCKING UNWANTED CHARACTERS
    if(blockType == "number"){
        if(letter >= 48 && letter <= 57){
            return false;
        }
    }else if(blockType == "character"){
        if(letter < 48 || letter > 57){
            return false;
        }
    }else if(blockType == "characterAllowDot"){
        if(letter == 46){
            return true;
        }else if (letter < 48 || letter > 57) {
            return false;
        }
    }else if(blockType == "noDate"){
        if(letter < 47 || letter > 57){
            return false;
        }
    }
}

function error(rowNumber, archive){
    return "\n\nERROR("+rowNumber+")_"+archive;
}

function loadItem(partToRefresh){


    if (partToRefresh.charAt(0) == "#") {
        $("#"+partToRefresh).load(location.href + partToRefresh);
    }else{
        $("."+partToRefresh).load(location.href + partToRefresh);
    }
}