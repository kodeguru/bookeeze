$(function(){
   //Load dashboard home menu
	$('a.dashboard').on("click",function(e) {
		e.preventDefault(); // cancel the link itself
		e.stopImmediatePropagation();
		var value = $(this).attr('href');
		$(".content").load(value);
		$('.content-header > h1:nth-child(1)').html('Dashboard');
		callAjax();
	});
	
	//Load dashboard settings menu
	$('a.settings').on("click",function(e) {
		//e.preventDefault(); // cancel the link itself
		//e.stopImmediatePropagation();
		var value = $(this).attr('href');
		$(".content").load(value);
		$('.content-header > h1:nth-child(1)').html('Settings');
		callAjax();
	});
	
	 // Take all href-value and assign it to value-value
	 $('.showModalButton').each(function(){
        var value = $(this).attr('href');
        $(this).attr("value", value);
    });
	
	$('.showModalButton').on("click",function(e) {
		var value = $(this).attr('href');
        $(this).attr("value", value);
		e.preventDefault(); // cancel the link itself
		//empty modal content
		$('#modalContent').empty();
	});

	$('#modal').on('shown.bs.modal', function () {
		  $('h1').hide();
		});

	$('.content h1').hide();
	
});
