$(document).ready(function(){
  $('.carousel').slick({
  	arrows: false,
	fade: true,
	dots: false,
	adaptiveHeight: true,
	lazyLoad: 'ondemand',
	centerMode: true,
	autoplay: true,
  	autoplaySpeed: 5000,
  	infinite: true
  });
});