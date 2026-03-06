<?php
/**
* Post Items 
* Type Investigation Post 
* 
* @package WordPress
*/
get_header();
get_website_header();
get_top_scroll_bar();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_post primary_post_article">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="post_article">
		<div class="section_container">
			<?php get_breadcrumb($post);?>
			<div class="section_content">
					<?php 
							$custom_post_type = wp_get_post_terms( $post->ID, 'custom_post_type' );
							if(!empty($custom_post_type)){
								?>
								<div class="post_type_label">
									<?php echo $custom_post_type[0]->name;?>
								</div>
								<?php
							}
							?>	
						<div class="section_columnize_layour clear">
							<div class="section_main_content">
								<div class="post_container">
									<div class="post_header">
										<h1 class="post_title"><?php echo $post->post_title;?></h1>
									<?php 
									custom_get_author_module();
									custom_get_post_downloads();
									custom_get_post_share_module();
									?>
									</div>
									<div class="post_content_container">
										<div class="post_content_wrapper">
											<?php 
											$content= do_shortcode($post->post_content);
											echo wpautop($content);?>
										</div>
										<div class="post_footer_modules">
											<?php 
											custom_get_post_downloads();
											custom_get_post_share_module();
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="section_side_content">
								<?php 
								custom_get_same_area_posts();
								custom_get_sidebar();
								?>
							</div>
						</div>
						<div class="post_footer_container">
							<?php custom_get_featured_posts();?>
								<div class="post_footer">
									<a href="<?php echo get_home_url(); ?>" class="btn btn_goback">REGRESAR</a>
								</div>
								<?php get_custom_footer_banner();?>
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