$('document').ready(function() {
   if(breakpoint('lg')) {

    $('.carousel .center').width( $('.carousel .center').width() - 300 );
   }
    var swiper = new Swiper('.carousel .swiper-container', {
        slidesPerView: 4,
   
        spaceBetween: 30,
        breakpoints: {  
          320: {       
             slidesPerView: 2,
             spaceBetween: 10     
          },     
          480: {       
             slidesPerView: 2,       
             spaceBetween: 20     
          },   
      
          1028: {       
             slidesPerView: 3,       
             spaceBetween: 10     
          }
       },
        // slidesPerGroup: 4,
      // centeredSlides: true,
      centerMode: true,

      pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: $('.carousel .swiper-button-next'),
          prevEl: $('.carousel .swiper-button-prev'),
        },
    });

});