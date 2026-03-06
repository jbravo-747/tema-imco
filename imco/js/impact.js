$(function(){
	//initilise loading effect
	var delay = 0.4;
	$('.impact_item').each(function(index){
		$(this).find('.left_line').css('transition-delay',(delay*index)+'s');
	});
});
$(window).on('load', function() {
		 setTimeout(function(){
	$('.impact_items_list').addClass('animated');
},400);
});

$(window).resize(function() {
});
