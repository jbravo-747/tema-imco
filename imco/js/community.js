$(function(){
	//Initialise slider
	   var swiper = new Swiper('.community_colaboratives .swiper-container', {
      slidesPerView: 3,
      spaceBetween: 20,
      slidesPerGroup:3,
      navigation: {
        nextEl: '.community_colaboratives .next_arrow',
        prevEl: '.community_colaboratives .prev_arrow',
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
    //Initialise slider
    	   var swiper = new Swiper('.community_logos .swiper-container', {
      slidesPerView: 6,
      // spaceBetween: 20,
      slidesPerGroup:6,
      navigation: {
        nextEl: '.community_logos .next_arrow',
        prevEl: '.community_logos .prev_arrow',
      },
         speed: 800,
         loop:false,
 breakpoints: {
    960: {
      slidesPerView: 4,
      spaceBetween: 20,
      slidesPerGroup:4,
    },
    767: {
      slidesPerView: 1,
      spaceBetween: 0,
      slidesPerGroup:1,
    }
  }
    });
});
