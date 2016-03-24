jQuery(document).ready(function ($) {
  // Inside of this function, $() will work as an alias for jQuery()
  // and other libraries also using $ will not be accessible under this shortcut 

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
  
/*  function flipCard(card) {
    var cardId = card.parents('.tab-content').siblings('[id$=' + card.parents('.tab-content').attr('id').replace('accessories-', '') + ']').addBack().toggle();
    console.log(cardId);
  }
  
   $('.accessories-toggle').on('click', function (e) {
     e.preventDefault();
     flipCard($(this));
   });*/

});
