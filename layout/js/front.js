
$(function () {

	'use strict';

	$(document).ready(function() {
		$('#category_id').select2();
	});
    /*================================
    datatable active
	==================================*/
	$('#category_id').on('change',function(){
			jQuery.ajax({
				url : '/store/bind_items.php' ,
				type:'POST' ,
				data:{
					category_id : $('#category_id').val()
				} ,
				success : function(data){
					jQuery('#dataTable1 tbody').html(data) ;

				} ,
				error(){
					console.log('Recored Not Founded');
				}
			});
		});

	
	$('#dataTable1').DataTable({
		responsive: true  ,
		pagingType: "full_numbers"
	});
    if ($('#dataTable').length) {
        $('#dataTable').DataTable({
            responsive: true ,
            "oLanguage": {
                "sSearch": "بحث :",
            },
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "paginate": {
                "previous": "الخلف" ,
                "next" : "التالى"
            }


		});
		$('#dataTable1').DataTable({
            responsive: true 
        });
    }
 
	$('#dataTable1_wrapper').removeClass('form-inline');
$(window).load(function(){
    $(".loading").fadeOut(10000);
});
 
    /*
	$('.login-page h1 span').click(function () {

		$(this).addClass('selected').siblings().removeClass('selected');

		$('.login-page form').hide();

		$('.' + $(this).data('class')).fadeIn(100);

	});


*/



	// Trigger The Selectboxit

	

	// Hide Placeholder On Form Focus

	$('[placeholder]').focus(function () {

		$(this).attr('data-text', $(this).attr('placeholder'));

		$(this).attr('placeholder', '');

	}).blur(function () {

		$(this).attr('placeholder', $(this).attr('data-text'));

	});

	// Add Asterisk On Required Field

	$('input').each(function () {

		if ($(this).attr('required') === 'required') {

			$(this).after('<span class="asterisk">*</span>');

		}

	});


    

    /* get clinic child */
     function get_clinic_options() {

		var parentID = jQuery('#parent').val();
		jQuery.ajax({
			url: '/graduation/child.php',
			type: 'post',
			data: {parentID : parentID},
			success: function(data) {
				jQuery('#child').html(data);
			},
			error: function() {
				alert("Something went wrong with the child options!");
			},
		});
	}
	jQuery('select[name="parent"]').change(get_clinic_options);




    


	// Confirmation Message On Button

	$('.confirm').click(function () {

		return confirm('Are You Sure?');

	});

	$('.live').keyup(function () {

		$($(this).data('class')).text($(this).val());

	});

});







/*start  loading */


/*end loading*/