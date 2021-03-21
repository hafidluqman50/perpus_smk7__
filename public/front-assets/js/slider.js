$(function(){
  $('.center-slide').slick({
    infinite: false,
    slidesToShow: 2,
    arrows: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
        infinite: false,
          arrows: true,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
      infinite: false,
          arrows: true,
          slidesToShow: 1
        }
      }
    ]
  });
});