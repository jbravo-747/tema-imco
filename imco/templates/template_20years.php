<?php
/**
* Template Name: 20_años
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

	.centrado{
		text-align:center;
		padding:8px;
		padding-top: 10%;
		#position: relative;
    margin: 0 auto;
		}
</style>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_proximamente">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="soon">
      <div class="section_main_content">
								<div class="post_container">
									<div class="post_content_container">
										<div class="post_content_wrapper">
											<?php 
											$content= do_shortcode($post->post_content);
											echo wpautop($content);?>
											<!-- codigo popup -->	
										<!-- <div id="popup" class="popup">
  											<div class="popup-content">
    											<button id="close-popup" class="close-popup">&times;</button>
    											<p>Aquí puedes escribir el contenido que deseas mostrar en el pop-up</p>
 											 </div>
										</div>
		                                  -->	
										</div>
									</div>
								</div>
							</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>