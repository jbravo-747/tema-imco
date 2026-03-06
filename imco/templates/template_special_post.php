<?php
/**
* Post Items 
* Type Special Post 
* 
* @package WordPress
*/
get_header();
get_website_header();
get_top_scroll_bar();
$post_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false, '');
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_post primary_post_special">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="post_article">
		<div class="section_container">
			<div class="section_content">
							<div class="special_post_header">
								<div class="special_post_header_wrapper" style="background-image:url(<?php echo $post_image[0];?>)">
									<div class="special_post_header_content">	
										<?php 
										get_breadcrumb($post);
										custom_get_author_module();
										$title = get_post_meta($post->ID,'html_title',true);
										if(empty($title)){
											$title = $post->post_title;
										}
										?>
										<h1 class="post_title"><span><?php echo nl2br($title);?></span></h1>
									</div>
								</div>
							</div>
							<div class="special_post_container">
								<div class="post_header">
									
									<?php 
									custom_get_post_downloads();
									custom_get_post_share_module();
									?>
									</div>
						<div class="section_columnize_layour clear">
							<div class="section_main_content">
								<div class="post_container">
									<div class="post_content_container">
										<div class="post_content_wrapper">
											<?php 
											$content= do_shortcode($post->post_content);
											echo wpautop($content);?>
										</div>
										
									</div>
								</div>
							</div>
							<div class="section_side_content">
								<?php 
								custom_get_sidebar();
								?>
							</div>
							<?php 
							custom_get_footer_content();
							?>
						</div>
						<div class="post_footer_modules">
											<?php 
											custom_get_post_downloads();
											custom_get_post_share_module();
											?>
										</div>
						<div class="post_footer_container">
								<div class="post_footer">
									<a href="<?php echo get_home_url(); ?>" class="btn btn_goback">REGRESAR</a>
								</div>
								<?php get_custom_footer_banner();?>
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