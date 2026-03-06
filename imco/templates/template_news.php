<?php
/*
Template Name: News_Semanal
Template Post Type: post, page
Description: Plantilla para publicar el contenido del news semanal.
*/
get_header();
get_website_header();

// Estilos inline mínimos para no limitar el formato del contenido.
wp_register_style('news-semanal-template', false);
wp_enqueue_style('news-semanal-template');
wp_add_inline_style('news-semanal-template', "
  .news-semanal .page_content_container{
    width: 100%;
    max-width: 100%;
    padding-left: 0;
    padding-right: 0;
  }
  .news-semanal .page_content_container_wrapper{
    width: 100%;
    max-width: 920px;
    margin: 0 auto;
    padding: 28px 16px 56px;
    box-sizing: border-box;
  }
  .news-semanal .news-header{
    margin-bottom: 16px;
  }
  .news-semanal .news-title{
    margin: 0 0 6px;
  }
  .news-semanal .news-meta{
    font-size: 13px;
    opacity: 0.7;
  }
  .news-semanal .news-content{
    padding: 0;
  }
  .news-semanal .news-content a{
    text-decoration: underline;
  }
  .news-semanal .news-content img{
    max-width: 100%;
    height: auto;
    display: block;
    margin: 18px auto;
  }
  .news-semanal .news-content iframe,
  .news-semanal .news-content embed,
  .news-semanal .news-content object,
  .news-semanal .news-content video{
    max-width: 100%;
  }
  .news-semanal .news-footer{
    text-align: center;
    margin-top: 18px;
    font-size: 12px;
    opacity: 0.7;
  }
  @media (max-width: 700px){
    .news-semanal .page_content_container_wrapper{
      padding: 24px 12px 48px;
    }
  }
");
?>

<input type="hidden" class="associated_page"
  original="<?php echo get_permalink($post->ID); ?>"
  value="<?php echo get_permalink($post->ID); ?>">

<div id="primary" class="content-area news-semanal">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container">
      <div class="page_content_container_wrapper">
        <header class="news-header">
          <h1 class="news-title"><?php echo esc_html(get_the_title($post)); ?></h1>
          <div class="news-meta">
            <?php echo esc_html(get_the_date('', $post)); ?>
          </div>
        </header>

        <article class="news-content">
          <?php echo wpautop($post->post_content); ?>
        </article>

        <div class="news-footer">
          Instituto Mexicano para la Competitividad (IMCO)
        </div>
      </div>
    </div>
  </main>
</div>

<?php get_footer(); ?>
