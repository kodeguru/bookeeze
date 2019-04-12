$(window).bind("load", function() {
	$('.showModalButton').unbind( "click" );
	//$('.showModalButton').removeClass("showModalButton");
	$('.showModalButton').removeAttr('value');
	$('.showModalButton').removeAttr('data-toggle');
	$('.showModalButton').removeAttr('data-target');

	$('.showModalButton').on("click",function(e) {
		$('#modalContent').empty();
		$(this).removeAttr('value');
		$(this).removeAttr('data-toggle');
		$(this).removeAttr('data-target');
		$(this).removeClass("showModalButton");
	});
	$('.showModalButton').removeClass("showModalButton");
	$('.showModalButton').removeAttr('value');

});


