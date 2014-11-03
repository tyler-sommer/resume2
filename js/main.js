$(document).ready(function () {
  $('ul.nav-pills li a').click(function (e) {
    $('ul.nav-pills li.active').removeClass('active');
    $(this).parent('li').addClass('active');
  });

  $(window).load(function () {
    var $container = $('.grid-wrapper');
    $container.isotope({
      filter:           '*',
      animationOptions: {
        duration: 750,
        easing:   'linear',
        queue:    false
      }
    });

    $('.grid-controls li a').click(function () {
      $('.grid-controls .current').removeClass('current');
      $(this).addClass('current');

      var selector = $(this).attr('data-filter');
      $container.isotope({
        filter:           selector,
        animationOptions: {
          duration: 750,
          easing:   'linear',
          queue:    false
        }
      });
      return false;
    });
  });

  $('.grid-wrapper').magnificPopup({
    delegate: 'a',
    type:     'image',
    gallery:  {
      enabled: true
    }
  });

  $(".navbar").sticky({topSpacing: 0});

  $('#main-menu').onePageNav({
    currentClass:    "active",
    changeHash:      true,
    scrollThreshold: 0.5,
    scrollSpeed:     750,
    filter:          "",
    easing:          "swing"
  });

  $('.chart').waypoint(function () {
    $(this).easyPieChart({
      barColor: '#3498db',
      size:     '150',
      easing:   'easeOutBounce',
      onStep:   function (from, to, percent) {
        $(this.el).find('.percent').text(Math.round(percent));
      }
    });
  }, {
    triggerOnce: true,
    offset:      'bottom-in-view'
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