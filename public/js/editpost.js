$( document ).ready(function() {

	$(".dropdown-menu-right > li").click(function(){

		var target = $(this).parent().parent().find(" > p");
		var text = target.text();
		var textarea = $("<textarea class='form-control'>" + text + "</textarea>");
		var cancel_m = $(this).parent().parent().find(".cancel_m:first");
		
		target.replaceWith(textarea);

		cancel_m.show();


	});
});