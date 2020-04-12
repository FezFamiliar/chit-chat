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
		
		target.replaceWith(textarea);

		cancel_m.show();


	});
});