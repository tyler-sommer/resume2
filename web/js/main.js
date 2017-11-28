$(document).ready(function () {
  $(".navbar").sticky({topSpacing: 0});

  $('#main-menu').onePageNav({
    currentClass:    "active",
    changeHash:      true,
    scrollThreshold: 0.5,
    scrollSpeed:     750,
    filter:          "",
    easing:          "swing"
  });

  $.vegas('slideshow', {
    backgrounds: [
      {src: 'img/slider/01.jpg', fade: 1000},
      {src: 'img/slider/02.jpg', fade: 1000},
      {src: 'img/slider/03.jpg', fade: 1000},
      {src: 'img/slider/04.jpg', fade: 1000}
    ]
  })('overlay', {
    src: 'img/overlays/05.png'
  });
  $("#vegas-next").click(function () {
    $.vegas('next');
  });
  $("#vegas-prev").click(function () {
    $.vegas('previous');
  });
});
