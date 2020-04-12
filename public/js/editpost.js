$( document ).ready(function() {

	$('.cancel_m').click(function(){

		var parent_tx = $(this).parent().find(" > textarea");
		
		parent_tx.replaceWith("<p>" + parent_tx.text() + "</p>");
		$('.cancel_m').hide();
	});

	$(".dropdown-menu-right > li").click(function(){

		var target = $(this).parent().parent().find(" > p");
		var text = target.text();
		var textarea = $("<textarea class='form-control'>" + text + "</textarea>");
		var cancel_m = $(this).parent().parent().find(".cancel_m:first");
		var id = cancel_m.attr("data-attr");

		target.replaceWith(textarea);

		cancel_m.show();

		$(document).keypress(function(e) {
    		if(e.which == 13)
    		{
    			var content = textarea.val();
    			if(content != '')
    			{
    				
				    $.ajaxSetup({
				        headers: 
				        {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
				    });

    			   $.ajax({
			          type: "POST",
			          url: "http://chitchat.loc/post/edit",
			          data: {

			          	id: id,
			          	data: content,

			          },
			          success: function (data) 
			          {

			          		textarea.replaceWith("<p>" + content + "</p>");
			          		cancel_m.hide();
			          }
			   });

    			}
    			else
    			{
    				alert("You can't leave it blank");
    			}
    		}
		});
	});
});