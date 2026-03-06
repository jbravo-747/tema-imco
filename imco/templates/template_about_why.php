<?php
/**
* Template Name: ¿Por qué medimos la competitividad?
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> post_parent); ?>" value="<?php echo get_permalink($post -> post_parent); ?>">
<div id="primary" class="content-factors primary_why">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="why">
		<div class="about_section">
			<?php 
			//Get about header (include submenu, title and main text).
			get_about_header(true);
			?>
			<?php 
			//get menu of page children.
			get_children_submenu();
			?>
				
			<div class="about_section_content">
				<div class="about_section_content_title">
					<h2><?php echo $post->post_title;?></h2>
				</div>
				<div class="about_section_content_text">
					<?php echo wpautop($post->post_content);?>
				</div>
				<?php 
				$factors_items = get_field('factors_items',$post->ID);
				if($factors_items)
				{
					?>
					<div class="factors_items_list_container">
						<h2 class="factors_items_title"><?php echo count($factors_items);?> Factores</h2>				
					<div class="factors_items_slider_container">
						<div class="background_number">1</div>
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								$index = 1;
								foreach($factors_items as $factors_item)
								{
									$factors_item_title= $factors_item['factors_item_title'];
									$factors_item_text= $factors_item['factors_item_text'];
									?>
									<div class="factors_item swiper-slide" index="<?php echo $index;?>">
											<div class="factors_item_title_container">
														<h4><?php echo $factors_item_title;?></h4>
											</div>
											<div class="factors_item_text_container">
												<div class="factors_item_text"><?php echo wpautop($factors_item_text);?></div>
											</div>
										</div>
									<?php
				
								$index++;
								}
								?>
								</div>
							</div>
						<div class="pagination_wrapper">
									<div class="pagination_container">
										<div class="next_arrow slider_arrow">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/next_arrow.svg" />
										</div>
										<div class="prev_arrow slider_arrow">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/prev_arrow.svg" />
										
										</div>
									</div>
								</div>
						</div>
					</div>
					<?php
				}
				?>
				<div class="about_secondary_text">
				<div class="about_section_content_text">
					<?php 
					$secondary_text= get_post_meta($post->ID,'secondary_text',true);
					echo wpautop($secondary_text);?>
				</div>
				</div>
			</div>

		</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/why.js">
</script>