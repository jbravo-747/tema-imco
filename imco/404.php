<?php
/**
* 404 error screen
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<input type="hidden" id="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_page_no_found">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="page_no_found">
		<div class="page_no_found_section">
			<div class="page_not_found_content">
				<div class="page_not_found_title">404</div>
				<h1>La página que buscas no está disponible.</h1>
				<div class="page_not_found_footer">
						<a href="<?php echo get_home_url(); ?>" class="btn btn_goback">HOMEPAGE</a>
					</div>			
			</div>
		</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>