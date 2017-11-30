function modal(itemId){
	$.ajax({
		type:"POST",
		url:"./modal/aboutProduct_IndexPage.php",
		data:{id:itemId},
		success: function(data){
			$(".modal").html(data);
		}
	});
}