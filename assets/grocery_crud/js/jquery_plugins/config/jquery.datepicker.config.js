$(function(){
    
	$('.datepicker-input').datepicker({
			dateFormat: js_date_format,
			showButtonPanel: true,
			changeMonth: true,
			changeYear: true
	});
	
//	$( ".datepicker-input" ).datepicker({dateFormat: "dd-mm-yy"});
	
	$('.datepicker-input-clear').button();
	
	$('.datepicker-input-clear').click(function(){
		$(this).parent().find('.datepicker-input').val("");
		return false;
	});
	
});