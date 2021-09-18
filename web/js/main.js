$(document).ready(function () {
  var titles = null;
  var titleIndex = 0;
  var $iama = $('#i-am-a');
  var walkCount = 0;

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
    ],
    walk: function(index) {
      if (!$iama) {
        return;
      }
      walkCount++;
      if (!titles) {
        titles = $(document.body).data('titles');
      }
      if (!titles || titles.length < 2) {
        return;
      }
      if (walkCount <= 5) {
        return;
      }
      var old = titleIndex;
      titleIndex = index % titles.length;
      if (old === titleIndex) {
        // no need to fade to the same thing
        return;
      }
      var newTitle = titles.slice(titleIndex, titleIndex + 1);
      $iama.fadeOut('fast', function() {
        $iama.text(newTitle).fadeIn('fast');
      });
    }
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
