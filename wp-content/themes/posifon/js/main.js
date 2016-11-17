jQuery(document).ready(function ($) {
    // Inside of this function, $() will work as an alias for jQuery()
    // and other libraries also using $ will not be accessible under this shortcut
    // Modernizr
    var jsSrc = $('script[src*=main]').attr('src'); // the js file path
    jsSrc = jsSrc.replace(/main\.js.*$/, ''); // the js folder path
    // This will select everything with the class smoothScroll
    // This should prevent problems with carousel, scrollspy, etc...
    $('.smooth-scroll').click(function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
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
        var s = document.body || document.documentElement
            , s = s.style;
        if (s.webkitFlexWrap === '' || s.msFlexWrap === '' || s.flexWrap === '') {
            return true;
        }
        var $list = $('.row')
            , $items = $list.find('.flexbox')
            , setHeights = function () {
                $items.css('height', 'auto');
                var perRow = Math.floor($list.width() / $items.width());
                if (perRow === null || perRow < 2) return true;
                var i, j;
                for (i = 0, j = $items.length; i < j; i += perRow) {
                    var maxHeight = 0
                        , $row = $items.slice(i, i + perRow);
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
  
    $('#tabs').tabs();
 
    //hover states on the static widgets
    $('#dialog_link, ul#icons li').hover(
      function() { $(this).addClass('ui-state-hover'); },
      function() { $(this).removeClass('ui-state-hover'); }
    );
    
    $('.accessories-toggle').click(function(e) {
      e.stopPropagation();
      var href = $(this).attr('data');
      console.log(href);
      $('a[href="' + href + '"]').click();
      return false;
    });
    
//    function hide_accessories() {
//      var links = $('.accessories-toggle');
//      console.log(links);
//      for (link in links) {
//        if(link === null) {
//          link.hide();
//        }
//      }
//    }
//  hide_accessories();
  
    Modernizr.load({
        test: Modernizr.cssremunit
        , nope: (jsSrc + '/rem.min.js')
    });
});