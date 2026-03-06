<?php
/**
* Template Name: Quíenes somos
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_about">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="about">
		<div class="about_section">
			<?php 
			//Get about header (include submenu, title and main text).
			get_about_header();
			?>
			<div class="about_section_content">
				<div class="about_section_content_text">
					<?php echo wpautop($post->post_content);?>
				</div>
			</div>
		</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/about.js">
</script>