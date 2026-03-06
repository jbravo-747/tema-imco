$(function(){
	fix_boxes();
});
$(window).on('load', function() {
	fix_boxes();
});

$(window).resize(function() {
    fix_boxes();
});
// Fix boxes height
function fix_boxes(){
$('.half_box .area_item_container').each(function(){
	var ob = $(this);
	var ob_next_parent = ob.parents('.half_box').next();
	var ob_next = ob_next_parent.find('.area_item_container');
	if(ob_next_parent.hasClass('half_box') && ob.offset().top==ob_next.offset().top){
		ob_next.css('height','');
		ob.css('height','');
		height=ob.outerHeight();
		height_next = ob_next.outerHeight();
		min_height = height>height_next?height:height_next;
		ob.css('height',min_height+'px');
		ob_next.css('height',min_height+'px');
	}
});
}
