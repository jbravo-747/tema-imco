$(function(){
		//Initialise featured posts slider
	var featured_swiper = new Swiper('.normal_main_post_items .home_featured_slider .swiper-container', {
		autoplay: {
        delay: 7000,
        disableOnInteraction: false,
      },
         speed: 800,
         loop:true,
        pagination: {
        el: '.normal_main_post_items .home_featured_slider .swiper-pagination',
        clickable: true,
      },
    });
    		//Initialise elections posts slider
	var election_swiper = new Swiper('.home_elections_posts .swiper-container', {
         speed: 800,
         loop:true,
        pagination: {
        el: '.home_elections_posts .swiper-pagination',
        clickable: true,
      },
    });
    
    	if($('.fullscreen_slider')[0]){
		$('.fullscreen_slider').appendTo('.home_slider_container');
	}
    		//Initialise featured posts slider
	var featured_swiper = new Swiper('.fullscreen_slider .home_featured_slider .swiper-container', {
		autoplay: {
        delay: 7000,
        disableOnInteraction: false,
      },
         speed: 800,
         loop:true,
        pagination: {
        el: '.fullscreen_slider .home_featured_slider .swiper-pagination',
        clickable: true,
      },
    });
    	   var swiper = new Swiper('.home_fullscreen_slider_bottom_posts .swiper-container', {
      slidesPerView: 3,
      spaceBetween: 50,
      slidesPerGroup:3,
      navigation: {
        nextEl: '.home_fullscreen_slider_bottom_posts .next_arrow',
        prevEl: '.home_fullscreen_slider_bottom_posts .prev_arrow',
      },
         speed: 800,
         loop:false,
 breakpoints: {
    960: {
      slidesPerView: 2,
      spaceBetween: 20,
       slidesPerGroup:2,
    },
    767: {
      slidesPerView: 1,
      spaceBetween: 0,
       slidesPerGroup:1,
    }
  }
    });
       // Text ellipsis
   $('.fullscreen_slider .ellipsis').each(function(){
   	var lines = $(this).attr('lines');
   	if(!lines){
   		lines = 2;
   	}
   	 $(this).ellipsis(
    	{
    		  lines: parseInt(lines),
    		  responsive:true
    	 });
   });
    
		//Initialise areas slider
	   var swiper = new Swiper('.home_areas_slider_container .swiper-container', {
      slidesPerView: 3,
      spaceBetween: 20,
      slidesPerGroup:3,
      navigation: {
        nextEl: '.home_areas_slider_container .next_arrow',
        prevEl: '.home_areas_slider_container .prev_arrow',
      },
         speed: 800,
         loop:false,
 breakpoints: {
    960: {
      slidesPerView: 2,
      spaceBetween: 20,
       slidesPerGroup:2,
    },
    767: {
      slidesPerView: 1,
      spaceBetween: 0,
       slidesPerGroup:1,
    }
  }
    });
    
    // Initialice index module
    	$container = $('.projects_container_list').packery({
		itemSelector : '.item_pk',
		percentPosition : true,
		// disable resize
	});

	var pckry = $container.data('packery');
	pckry.fit();
	$('img').on('load', function() {
		var pckry = $container.data('packery');
		pckry.layout();
	});
	var pckry = $container.data('packery');
	pckry.layout();
	
});
