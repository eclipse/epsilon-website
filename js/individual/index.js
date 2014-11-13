// make code pretty
prettyPrint();

// enable and start the slideshow
$('#epsilonSlideshow').carousel({
 interval: 7000
});

// make the control buttons disappear when the mouse is not over the slideshow
$('.carousel').on('mouseout', function(e) {
  $('.carousel-control', this).addClass('hidden');
});
$('.carousel').on('mouseover', function(e) {
  $('.carousel-control', this).removeClass('hidden');
});