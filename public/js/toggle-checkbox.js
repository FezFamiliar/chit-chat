$( document ).ready(function() {


	$("#toggle_k90").click(function(){


		if($(".toggle label").hasClass("true_90"))
		{
			$(".toggle label").removeClass("true_90");
		}
		else
		{
			$(".toggle label").addClass("true_90");
		}

	});
});


