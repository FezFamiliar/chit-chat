$( document ).ready(function() {

	$('#edit_post').click(function(){

		var text = document.createElement("textarea");

		$(this).closest('media-body p').append(text);


	});
});