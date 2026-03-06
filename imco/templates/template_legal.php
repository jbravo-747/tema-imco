<?php
/**
* Template Name: legal
* 
* @package WordPress
*/
get_header();
get_website_header();
get_top_scroll_bar();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_post primary_post_article legal_template">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="post_article">
		<div class="section_container">
			<?php get_breadcrumb($post);?>
			<div class="section_content">
						<div class="section_columnize_layour clear">
							<div class="section_main_content">
								<div class="post_container">
									<div class="post_header">
										<h1 class="post_title"><?php echo $post->post_title;?></h1>
									</div>
									<div class="post_content_container">
										<div class="post_content_wrapper">
											<?php 
											$content= do_shortcode($post->post_content);
											echo wpautop($content);?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="post_footer_container">
								<div class="post_footer">
									<a href="<?php echo get_home_url(); ?>" class="btn btn_goback">REGRESAR</a>
								</div>
						</div>
			</div>
    </div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/post.js">
</script>