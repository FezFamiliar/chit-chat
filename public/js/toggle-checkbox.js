$( document ).ready(function() {

	$(".toggle").click(function(){

		var nearest = $(this).find(" > label"); // find the closest label

		if(nearest.hasClass("true_90"))
		{
			nearest.removeClass("true_90");
			//console.log("off");
		}
		else
		{
			nearest.addClass("true_90");
			//console.log("on");
		}

	});
});


