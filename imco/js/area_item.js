$(function(){
	//Initialise slider
	   var swiper = new Swiper('.team_slider .swiper-container', {
      slidesPerView: 6,
      spaceBetween: 0,
      slidesPerGroup:6,
      navigation: {
        nextEl: '.team_slider .next_arrow',
        prevEl: '.team_slider .prev_arrow',
      },
         speed: 800,
         loop:false,
 breakpoints: {
    960: {
      slidesPerView: 4,
      spaceBetween: 0,
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
