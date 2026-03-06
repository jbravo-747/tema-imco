<?php
/**
* Template Name: Equipo
*
* @package WordPress
*/

$page = get_page_by_path( 'equipo' );
global $post;
$post=$page;
setup_postdata( $page ); 
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_home">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="home">
		<div class="section_container">
			<?php get_breadcrumb($post);?>
			<div class="section_content">
				<div class="team_header clear">
					<h1 class="section_title">
						<?php echo $post->post_title;?>
					</h1>
					<?php
					$contact_email = get_option( 'contact_email', '' );
					 if(!empty($contact_email)){
					 ?>
						<a href="mailto:<?php echo $contact_email;?>" class="btn email_btn"><?php echo $contact_email;?></a>
					<?php 
					 }
					?>
				</div>
				<div class="team_list_container">
					<div class="team_list">
						<?php 
						/**
						 * Get and print list of team members
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
						            'terms' => 'equipo',
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
																if(empty($img_src)){
								$img_src[0] =get_stylesheet_directory_uri().'/images/shapeofyou.jpg';
								}
								?><a  href="<?php echo get_permalink($team_item->ID);?>" class="team_item">
									<div class="team_item_wrapper">
										<div class="team_item_image_container">
											<div class="team_item_image" style="background-image:url(<?php echo $img_src[0];?>)" ></div>
										</div>
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
					<?php
					$contact_email = get_option( 'contact_email', '' );
					 if(!empty($contact_email)){
					 ?>
					 <div style="text-align:center" >
						<a href="mailto:<?php echo $contact_email;?>" class="btn email_btn mobile_email_btn"><?php echo $contact_email;?></a>
					</div>
					<?php 
					 }
					?>
					<div class="team_footer">
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
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/team.js">
</script>