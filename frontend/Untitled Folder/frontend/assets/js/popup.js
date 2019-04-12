
$(function(){
	$('#modalContent').html("");
	
	$('a[title="Update"]').addClass("showModalButton");
	$('a[title="update"]').addClass("showModalButton");
	$('a[title="View"]').addClass("showModalButton");
	$('a[title="Payment"]').addClass("showModalButton");
	$('a[title="Generate"]').addClass("showModalButton");
	$('a[title="Create"]').addClass("showModalButton");
	$('a:contains("Create")').addClass("showModalButton");
	
	//Add title attribute to create button by assigning it to anchor content
	$('a:contains("Create")').each(function(){
		var title = $(this).html();
		$(this).attr("title", title);
	});
	
	$('a:contains("Update")').each(function(){
        var value = $(this).attr('href');
        $(this).attr("value", value);
    });
	
	$('th:contains("Add")').each(function(){
		//var title = $(this).html();
		$(this).attr("title", "Add New");
	});
	
	 // Take all href-value and assign it to value-value
	 $('.showModalButton').each(function(){
        var value = $(this).attr('href');
        $(this).attr("value", value);
    });
	
	$('.showModalButton').on("click",function(e) {
		e.preventDefault(); // cancel the link itself
		//empty modal content
		$('#modalContent').empty();
	});
	
	
	//close or hide modal backrop when modal is closed
	$('.close').on("click",function(e) {
		$('#modalContent').html("");
		$('.modal-backdrop').hide();
	});
	
	$('body .modal-content').on('beforeSubmit', 'form', function (e) {
		 var form = $(this);
		 // return false if form still have some validation errors
		 if (form.find('.has-error').length) {
				$("#message").html(result.message);
				return false;
		 }
		 // submit form
		 $.ajax({
			  url: form.attr('action'),
			  type: 'post',
			  data: form.serialize(),
			  success: function (response) {
				   $(form).trigger("reset");
				   alert('Saved successfully!!');
				   location.reload();//goback
				   //$(document).find('#modal').modal('hide');
				   //$.pjax.reload({container:'.grid-view'});
				   return false;
				   
			  }
		 });
		 return false;
	});
	
	
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
$(document).on('click', '.showModalButton', function(){
         //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content.
        $('#modalContent').html("");
        // $("h1").hide();
        $( "#modalHeader > h2" ).html("Create New");
        
        var value = $(this).attr('href');
        $(this).attr("value", value);
        
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
	        	        
            //dynamiclly set the header for the modal
            $( "#modalHeader > h2" ).html($(this).attr('title'));
	        // $("h1").hide();
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));

            $('#modal').removeClass('fade');

             //dynamiclly set the header for the modal
            $( "#modalHeader > h2" ).html($(this).attr('title'));
        }        
    });
    
});



