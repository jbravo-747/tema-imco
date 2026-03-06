<?php
/**
* Items Areas
*
* @package WordPress
*/
get_header();
get_website_header();
$color = get_post_meta($post->ID,'area_color',true);
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_area_item">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="area_item">
		<div class="area_header" style="background-color:<?php echo $color;?>">
			<div class="area_header_wrapper">
				<?php get_breadcrumb($post);?>
				<div class="area_header_content">
				<div class="area_header_content_title">
					<h1><?php echo $post->post_title;?></h1>
				</div>
				<div class="area_header_content_text">
					<?php echo wpautop($post->post_content);?>
				</div>
				</div>
			</div>
		</div>
		<div class="area_item_top_content_wrapper">
		<div class="area_item_top_content">
			<div class="area_main_images clear" style="background-color:pink; margin: 0px; padding: 0px">
				<?php 
				$area_main_image1_id = get_post_meta($post->ID,'area_main_image1',true);
				$area_main_image2_id = get_post_meta($post->ID,'area_main_image2',true);
				$area_main_url1 = get_post_meta($post->ID,'area_main_url1',true);
				$area_main_url2 = get_post_meta($post->ID,'area_main_url2',true);
				$area_main_image1 = wp_get_attachment_image_src($area_main_image1_id, 'full', false, '');
				$area_main_image2 = wp_get_attachment_image_src($area_main_image2_id, 'full', false, '');
				?>
				<!-- <a <?php echo !empty($area_main_url1)?'href="'.$area_main_url1.'"':''; ?> class="area_main_image_container area_main_image1" > 
					<div style="background-image:url(<?php echo $area_main_image1[0];?>);" class="area_main_image"></div>
				</a>
				<a <?php echo !empty($area_main_url2)?'href="'.$area_main_url2.'"':''; ?> class="area_main_image_container area_main_image2" > 
					<div style="background-image:url(<?php echo $area_main_image2[0];?>);" class="area_main_image"></div>
				</a> -->
			</div>
		</div>
		</div>
		<div class="area_body_container">
		<div class="area_body_wrapper clear">
			<div class="area_body_content">
				<div class="area_body_content_posts">
					<div class="area_body_content_posts_title">
						<h2>ÚLTIMAS PUBLICACIONES</h2>
					</div>
					<div class="area_body_content_posts_items">
					<?php custom_get_results_areas($post->post_name);?>
					</div>
				</div>
			</div>
			<div class="area_body_sidebar section_side_content">
				<div class="area_body_sidebar_wrapper">
								<?php 
								custom_get_sidebar();
								?>
				</div>
			</div>
		</div>
		</div>
		<?php 
		
		/**
		 * Get and print list of team members by category
		 */
		 $args = array(
									'post_type' => 'equipo',
									'post_status' => 'publish',
									 'posts_per_page'         => -1,
									'orderby' => 'menu_order',
									'order' => 'ASC',
									    'meta_query' => array(
									        array (
									            'key' => 'post_area_team',
									            'value' => $post->post_name,
									            'compare' => 'LIKE'
									        )
									    ));
									$results = new WP_Query( $args );
									if(!empty($results->posts)){
		 				?>
		 				<div class="team_slider">
		 				<div class="slider_container">
		 					
						</div>
					</div>
					</div>
					<?php 
					}
					get_custom_footer_banner();?>
					
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/area_item.js">
</script>