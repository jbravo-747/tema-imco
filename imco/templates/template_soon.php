<?php
/**
* Template Name: Proximamente
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<style>
	#soon p{
		margin:0 !important;
	}
	.primary_proximamente .page_content_container{
padding: 0 !important;
    max-width: 100% !important;
    padding-top: 150px !important;
	}
		.primary_proximamente .page_content_container img{
			display:block;
		}
</style>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_proximamente">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="soon">
      	<?php echo wpautop($post->post_content);?>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>