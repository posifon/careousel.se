jQuery(document).ready(function ($) {
  // Inside of this function, $() will work as an alias for jQuery()
  // and other libraries also using $ will not be accessible under this shortcut 
  
  $('#popup').bPopup();
  
  // Toggles for forms and price list
  $('#privat').on('click', function () {
    $('.privat-toggle').show();
    $('.omsorg-toggle').hide();
  });
  
  $('#omsorg').on('click', function () {
    $('.privat-toggle').hide();
    $('.omsorg-toggle').show();
  });
  

  // Function which looks for the currently choosen unit and shows the corresponding options (while hiding the others).
  function showOptions() {
    var id = $('input[name=enhet]:checked').val().toLowerCase();
    id = id.replace(/\s/g, '');
    $('.alternativ').hide();
    $('.alternativ_' + id).each(function() {
      $(this).show();
    });
  }
  showOptions();
  
  $('input[name=enhet]').on('change', function () {
    showOptions();
  });

});
