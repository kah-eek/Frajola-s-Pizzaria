function modal(itemId, linkToSend){

  if (linkToSend == "feedbackItem") {
    $.ajax({
        type:"POST",
        url: "./modal/feedbackModal.php",
        data:{id:itemId},
        success: function(dados){
            $(".modal").html(dados);
        }
    });
  }else if (linkToSend == "userDetails") {
    $.ajax({
      type:"POST",
      url: "./modal/employeeModal.php",
      data:{id:itemId},
      success: function(dados){
        $(".modal").html(dados);
      }
    });
  }
}
