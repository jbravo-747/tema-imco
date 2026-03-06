<?php
/**
* Template Name: Categoria Nuestro Equipo
*
* @package WordPress
*/
get_header();
get_website_header();
?>

<style>
.button1 {
  background-color: #00bfda;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> post_parent); ?>" value="<?php echo get_permalink($post -> post_parent); ?>">
<div id="primary" class="content-area primary_about">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="about">
		<div class="about_section">
			<?php 
			//Get about header (include submenu, title and main text).
			get_about_header(true);
			?>
			<?php 
			//get menu of page children.
			get_children_submenu();
			?>
							<div class="team_list_container">
					<div class="team_list">
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
						    'tax_query' => array(
						        array (
						            'taxonomy' => 'team_category',
						            'field' => 'slug',
						            'terms' => $post->post_name,
						        )
						    ));
						
						$results = new WP_Query( $args );
						if(!empty($results->posts)){
							$index = 1;
							$questions = '';
							foreach($results->posts as $team_item){
								$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($team_item->ID ), 'full', false, '');
								$job_description = get_post_meta($team_item->ID,'job_description',true);
								$title = $team_item->post_title;
								// if(empty($img_src)){
								// $img_src[0] =get_stylesheet_directory_uri().'/images/shapeofyou.jpg';
								// }
								?><a  href="<?php echo get_permalink($team_item->ID);?>" class="team_item">
									<div class="team_item_wrapper">
															<?php 
					if(!empty($img_src)){
					?>
										<div class="team_item_image_container">
											<div class="team_item_image" style="background-image:url(<?php echo $img_src[0];?>)" ></div>
										</div>
															<?php 
					}
					?>
										<div class="team_item_footer">
											<label><?php echo $title;?></label>
											<span><?php echo nl2br($job_description);?></span>
										</div>
									</div>
								</a><?php
							}
						}
							?>
					</div>
					<div class="button1"><a href="https://imco.org.mx/trabaja-con-nosotros/">Trabaja con nosotros</a></div>
				</div>
		</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/about.js">
</script>