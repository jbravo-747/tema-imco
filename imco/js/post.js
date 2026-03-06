$(function(){
	//initilise gallery Sliders
	$('.post_footer_content_gallery_container .swiper-container').each(function(index){
		$(this).parents('.post_footer_content_gallery_container').attr('id','footer_slider_'+index);
		new Swiper(this, {
      pagination: {
        el: '#footer_slider_'+index+' .swiper-pagination',
        clickable: true,
      },
    });
	});
	//fix first image margin
	if($('.post_content_wrapper p:first img')[0]){
		$('.post_content_wrapper p:first').addClass('remove_padding_top');
	}
	//fix iframes to keep ratio
	$('.post_content_wrapper iframe').each(function(){
		var width = $(this).attr('width');
		var height = $(this).attr('height');
		if(width && height){
			$(this).keepRatio('width', width, height, true);
		}
	});
	//fix slides to keep ratio
		$('.post_footer_content .post_footer_content_wrapper .post_footer_content_gallery_container .post_footer_content_gallery .swiper-container .swiper-wrapper .swiper-slide').each(function(){
		var width =795;
		var height = 565;
		if(width && height){
			$(this).keepRatio('width', width, height, true);
		}
	});
});
