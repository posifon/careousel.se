jQuery(document).ready(function ($) {
  // Inside of this function, $() will work as an alias for jQuery()
  // and other libraries also using $ will not be accessible under this shortcut

  
  var jsSrc = $('script[src*=main]').attr('src');  // the js file path
  jsSrc = jsSrc.replace(/main\.js.*$/, ''); // the js folder path
  
  // Smooth scrolling to anchor
  $('a[href*=#]:not([href=#])').click(function () {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') || location.hostname === this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 600);
        return false;
      }
    }
  });
  
  $('#nav-button').on('click', function () {
    $('#nav').slideToggle();
  });
  
  // Flexbox polyfill
  (function ($, window, document, undefined) {
    'use strict';

    var s = document.body || document.documentElement,
      s = s.style;
    if (s.webkitFlexWrap === '' || s.msFlexWrap === '' || s.flexWrap === '') return true;

    var $list = $('.row'),
      $items = $list.find('.flexbox'),
      setHeights = function () {
        $items.css('height', 'auto');

        var perRow = Math.floor($list.width() / $items.width());
        if (perRow === null || perRow < 2) return true;
        var i,
          j;
        for (i = 0, j = $items.length; i < j; i += perRow) {
          var maxHeight = 0,
            $row = $items.slice(i, i + perRow);

          $row.each(function () {
            var itemHeight = parseInt($(this).outerHeight());
            if (itemHeight > maxHeight) maxHeight = itemHeight;
          });
          $row.css('height', maxHeight);
        }
      };

    setHeights();
    $(window).on('resize', setHeights);
    $list.find('img').on('load', setHeights);

  })(jQuery, window, document);
  // end Flexbox polyfill
  
  var current;
    
  function expanderHide() {
    $('.expander-content').slideUp(200);
    $('.minimized').fadeIn(200);
    $('.expanded').fadeOut(200);
    return false;
  }
  
  expanderHide();
  
  $('.expander-container').on('click', function (e) {
    current = $(this);
    expanderHide();
    current.find('.expander-content').slideDown(200);
    current.children('.minimized').fadeOut(200);
    current.children('.expanded').fadeIn(200);
    return false;
  });
  
  $('.expanded').on('click', function () {
    current = $(this).parents('.expander-container');
    expanderHide();
    return false;
  });

  $('.expander-content').on('click', function (e) {
    e.stopPropagation();
  });
  
  $(document).on('click', function () {
    expanderHide();
  });

  // function cousins() used by tab-box
  (function ($) {
    $.fn.cousins = function (selector) {
      var cousins;
      this.each(function () {
        var auntsAndUncles = $(this).parent().siblings();
        auntsAndUncles.each(function () {
          if (cousins == null) {
            if (selector)
              cousins = auntsAndUncles.children(selector);
            else
              cousins = auntsAndUncles.children();
          } else {
            if (selector)
              cousins.add(auntsAndUncles.children(selector));
            else
              cousins.add(auntsAndUncles.children());
          }
        });
      });
      return cousins;
    }
  })(jQuery);
  

  function openTab(clickedTab) {
    var thisTab = clickedTab.attr('id').replace("button-", ""); // gets the id of the clicked button
    clickedTab.cousins().removeClass("active"); // selects the other a-elemnts in the same tab-box and removes the highlight
    clickedTab.addClass("active"); // adds active class to clicked tab
    clickedTab.parents(".tab-box").find(".tab-content").hide(); // hides any open content related to the clicked tab
    $("#" + thisTab).show();
  }
    
  openTab($("#button-advance-gsm"));
  
  $(".tab-nav li a").on('click', function (e) {
    e.preventDefault(); // prevents following the anchor link.
    openTab($(this)); // calls function openTab with the current tab object as argument. 
  });
  
  Modernizr.load({
    test: Modernizr.cssremunit,
    nope: (jsSrc + '/rem.min.js')
  });

});
