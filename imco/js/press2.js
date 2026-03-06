$(function(){
	fix_sidebar();
});
$(window).on('load', function() {
	fix_sidebar_height();
	fix_sidebar();    
});
$(window).scroll(function() {
    fix_sidebar_height();
    fix_sidebar();
});
$(window).resize(function() {
    fix_sidebar_height();
    fix_sidebar();
});
//Fix sidebar position
function fix_sidebar(){
	
	var scrollTop = $(window).scrollTop();
		$('body').removeClass('fixed_sidebar_bottom');
	$('body').removeClass('fixed_sidebar');
	var sidebar_top = $('.section_side_content').offset().top;
	var header_height =  $('#masthead').height();


	if((scrollTop+header_height)>=(sidebar_top)){
		$('body').addClass('fixed_sidebar');
	}
	var floating_sidebar_bottom = $('.section_side_content_float').offset().top+$('.section_side_content_float').outerHeight();
	sidebar_bottom =  $('.section_side_content').offset().top+$('.section_side_content').outerHeight();
	if(floating_sidebar_bottom>=sidebar_bottom){
		$('body').addClass('fixed_sidebar_bottom');
	}
		
}
//Fix sidebar height
function fix_sidebar_height(){
	 $('.section_side_content').css('min-height','');
	 if($('.section_side_content_float_content').outerHeight()>$('.section_main_content').outerHeight()){
		min_height = $('.section_side_content_float_content').outerHeight();
	 }else{
	 	min_height = $('.section_main_content').outerHeight();
	 }
	  $('.section_side_content').css('min-height',min_height+'px');
}
