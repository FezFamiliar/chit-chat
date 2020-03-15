$( document ).ready(function() {
$("#myModal").on("hidden.bs.modal", function(){
    $("#myModal .modal-body").html("");
});
$('.like-peek').click(function(e){
	// e.preventDefault()
	var id = $(this).attr('data-attribute');

	   $.ajax({
          type: "GET",
          url: "/show/likes/" + id,
          success: function (data) {
          	var n = data['success']['length'];


          	for(var i = 0;i < n;i++){

           	   $("#myModal .modal-body").append(data['success'][i] + '<br>');
          	}
              $("#myModal").modal("show");
          }
   });
}); 
});