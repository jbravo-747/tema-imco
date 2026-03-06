<?php
/*
Template Name: ICE_Final
*/
get_header();           // Carga estructura base del tema
get_website_header();   // Carga la barra de navegación institucional de IMCO
?>

<!-- Contenedor principal -->
<main id="primary" 
      style="margin:0; padding:clamp(90px, 11vh, 140px) 0 0; background:#fff;">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="entry-content" 
         style="width:100%; max-width:none; margin:0 auto; padding:10px 0 0; box-sizing:border-box;">
      <?php the_content(); ?>
    </div>
  <?php endwhile; ?>
</main>

<!-- Librería iframe-resizer -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.3.9/iframeResizer.min.js"
        integrity="sha512-+bpyZqiNr/4QlUd6YnrAeLXzgooA1HKN5yUagHgPSMACPZgj8bkpCyZezPtDy5XbviRm4w8Z1RhfuWyoWaeCyg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Inicialización del iframe-resizer -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const iframe = document.getElementById('idIframe') ||
                 document.querySelector('iframe[src*="alphacast.io"]');
  if (!iframe) return;

  // Limpiar atributos y aplicar estilos responsivos
  iframe.removeAttribute('height');
  iframe.setAttribute('scrolling', 'no');
  iframe.style.display = 'block';
  iframe.style.width = '1px';
  iframe.style.minWidth = '100%';
  iframe.style.border = '0';
  if (!iframe.id) iframe.id = 'idIframe';

  // Inicializar autoajuste de altura
  iFrameResize({
    log: false,
    checkOrigin: ['https://www.alphacast.io'],
    heightCalculationMethod: 'max',
    warningTimeout: 0
  }, '#' + iframe.id);
});
</script>

<?php get_footer(); ?>
