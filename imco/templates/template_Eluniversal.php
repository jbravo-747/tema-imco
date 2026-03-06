<?php
/*
Template Name: El_Universal
Description: Mantiene la estructura Hybrid original; centra el embed y fija altura visible al tablero para evitar scroll interno.
*/
get_header();
get_website_header();
?>

<style>
  /* Wrapper centrado con ancho máximo 1200px (ajústalo si quieres) */
  .primary_proximamente .page_content_container .page_content_container_wrapper{
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    box-sizing: border-box;
    padding-left: 0;
    padding-right: 0;
  }

  /* === Tablero de Tableau (solo aplica al iframe de Tableau) === */
  .page_content_container_wrapper .tableauPlaceholder,
  .page_content_container_wrapper object.tableauViz,
  .page_content_container_wrapper iframe[src*="tableau"]{
    display: block;
    margin-left: auto;
    margin-right: auto;
    float: none;
    max-width: 100%;
    height: 4030px !important;  /* altura fija del tablero */
    border: 0;
    overflow: hidden !important;
  }

  /* === Mini Grid iframe (debajo del tablero) === se actualiza desde https://github.com/jbravo-747/mini_grid.git*/
  .mini-grid-embed{
    display: block;
    width: 100%;
    max-width: 100%;
    height: 450px;        /* ajusta si lo quieres más alto/bajo */
    border: 0;
    overflow: hidden;
    margin: 0;            /* sin espacio extra: pegado al tablero */
  }

  /* Por si WP envuelve el iframe en un <p>, eliminamos margen del <p> */
  .page_content_container_wrapper p > iframe.mini-grid-embed {
    margin: 0 !important;
    display: block;
  }
</style>

<input type="hidden" class="associated_page"
  original="<?php echo get_permalink($post->ID); ?>"
  value="<?php echo get_permalink($post->ID); ?>">

<div id="primary" class="content-area primary_proximamente">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container">
      <div class="page_content_container_wrapper">
        <?php echo wpautop($post->post_content); ?>

        <!-- === IFRAME DEL MINI GRID: inmediatamente debajo del tablero === -->
        <iframe
          class="mini-grid-embed"
          src="https://mini-grid.vercel.app/"
          title="Mini Grid"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          allow="fullscreen"
        ></iframe>

        <div></div>
      </div>
    </div>
  </main>
</div>

<?php
/* Asegura la API de Tableau por si el embed no la incluyó */
wp_enqueue_script( 'tableau_v1', 'https://public.tableau.com/javascripts/api/viz_v1.js', array(), null, true );
?>

<script>
/* Reaplica altura al tablero de Tableau si el script de Tableau la cambia */
document.addEventListener('DOMContentLoaded', function () {
  var scope = document.querySelector('.page_content_container_wrapper');
  if (!scope) return;

  /* Selecciona SOLO el iframe de Tableau, no el mini-grid */
  var el = scope.querySelector('.tableauPlaceholder object')
        || scope.querySelector('object.tableauViz')
        || scope.querySelector('iframe[src*="tableau"]');

  if (!el) return;

  function apply() {
    el.style.display = 'block';
    el.style.marginLeft = 'auto';
    el.style.marginRight = 'auto';
    el.style.height = '4030px';   // misma altura que en CSS
    el.style.overflow = 'hidden';
    if (el.tagName && el.tagName.toLowerCase() === 'iframe') {
      el.setAttribute('scrolling', 'no'); // oculta scroll en iframes que lo respetan
    }
  }
  apply();
  setTimeout(apply, 250);
  setTimeout(apply, 1200);
});
</script>

<?php get_footer(); ?>
