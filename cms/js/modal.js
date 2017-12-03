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
  }else if(linkToSend == "optionsCategorySubcategory"){
    $.ajax({
      type: "POST",
      url: "./modal/optionsCategorySubcategory.php",
      data: {id:itemId},
      success: function(dados){
        $(".modal").html(dados);
      }
    });
  }else if(linkToSend == "addNewCategory"){
    $.ajax({
      type:"POST",
      url:"./modal/addNewCategory.php",
      data:{id:itemId},
      success: function(dados){
        $(".categoryAndSubcategoryModal").html(dados);
      }
    });
  }else if(linkToSend == "addNewSubcategory"){
    $.ajax({
      type:"POST",
      url:"./modal/addNewSubcategory.php",
      data:{id:itemId},
      success: function(dados){
        $(".categoryAndSubcategoryModal").html(dados);
      }
    });
  }else if(linkToSend == "manageCategoriesAndSubcategories"){
    $.ajax({
      type:"POST",
      url:"./modal/manageCategoriesAndSubcategories.php",
      data:{id:itemId},
      success: function(dados){
        $(".categoryAndSubcategoryModal").html(dados);
      }
    });
  }
}
