$(function(){
	//initilise slider
	 factors_slider = new Swiper('.factors_items_slider_container .swiper-container', {
	 	allowSlidePrev:true,
		 loop:false,
  navigation: {
        nextEl: '.factors_items_slider_container .next_arrow',
        prevEl: '.factors_items_slider_container  .prev_arrow',
     }, keyboard: {
    enabled: true,
    onlyInViewport: true,
  },  mousewheel: {
    invert: false,
  },
    });
    
factors_slider.on('slideChangeTransitionStart', function() { 
var index = $('.factors_items_slider_container .swiper-container .swiper-slide-active').attr('index');
$('.background_number').html(index);
});
});
