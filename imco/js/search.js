$(function(){
// Initialise checkboxes
$('input').iCheck();
// Action on checkbox is checked
$('input').on('ifChecked', function (event){
    $(this).parents("form").submit();          
});
// Action on checkbox is unchecked
$('input').on('ifUnchecked', function (event) {
    $(this).parents("form").submit(); 
});
// Open and close filters
$('.filter_header').click(function(){
	var ob = $(this);
	var parent = ob.parents('.filter_container');
	var body = parent.find('.filter_body');
	if(!parent.hasClass('area_filter')){
	if(!body.is(':visible')){
		body.stop().slideDown();
		parent.addClass('open');
	}else{
		body.stop().slideUp();
		parent.removeClass('open');
	}
	}
});
// Open and close general filters
$('.search_sidebar_header').click(function(){
	var ob = $(this);
	var parent = ob.parents('.search_sidebar_wrapper');
	var body = parent.find('.filters_container');
	if(!body.is(':visible')){
		body.stop().slideDown();
		parent.addClass('open');
	}else{
		body.stop().slideUp();
		parent.removeClass('open');
	}
});
});
