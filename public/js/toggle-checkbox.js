$( document ).ready(function() {

	$(".toggle").click(function(){

		var nearest = $(this).find(" > label"); // find the closest label
		var s_id = $(this).find(" > input").attr('data-id');
    				
	    $.ajaxSetup({
	        headers: 
	        {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

		if(nearest.hasClass("true_90")) // active = 1, set active = 0
		{
			
				 $.ajax({

		           type: "POST",
		           url: "/toggle/" + s_id,
		           data: {toggle: "0"},
		           beforeSend: function(){
		           		$('body').addClass("loader");
		           },
		           success: function (data) {
		          	   nearest.removeClass("true_90");
		          	   $('body').removeClass("loader");
		           }

		   		 });
		}
		else
		{

				 $.ajax({

		           type: "POST",
		           url: "/toggle/" + s_id,
		           data: {toggle: "1"},
		           beforeSend: function(){
						$('body').addClass("loader");
		           },
		           success: function (data) {
		          		nearest.addClass("true_90");
		          		$('body').removeClass("loader");
		           }
		          
		   		 });
			
		}

	});
});


