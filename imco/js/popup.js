jQuery(document).ready(function($) {
    // Mostrar el pop-up al hacer clic en un botón
    $('#open-popup').on('click', function() {
      $('#popup').fadeIn();
    });
  
    // Cerrar el pop-up al hacer clic en el botón de cerrar
    $('#close-popup').on('click', function() {
      $('#popup').fadeOut();
    });
  
    // Cerrar el pop-up al hacer clic en cualquier lugar fuera del contenido del pop-up
    $(document).on('click', function(e) {
      if ($(e.target).is('#popup')) {
        $('#popup').fadeOut();
      }
    });
  });