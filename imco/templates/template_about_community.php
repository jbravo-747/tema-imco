<?php
/**
* Template Name: Comunicadad IMCO
*
* @package WordPress
*/
get_header();
get_website_header();
?>
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
			<div class="comunity_container">
				<div class="about_section_content_header">
					<?php echo wpautop($post->post_content);?>
				</div>
				<?php 
				//get Colaboratives slider
				if( have_rows('colaboratives_items') ){
				?>
				<div class="community_item_container community_colaboratives">
						<?php 
						$colaboratives_header_text = get_post_meta($post->ID,'colaboratives_header_text',true);
						if(!empty($colaboratives_header_text)){
						?>
					<div class="community_item_header">
						<?php echo wpautop($colaboratives_header_text);?>
					</div>
					<?php } ?>
					<div class="community_item_wrapper">
							<div class="slider_container">
							<div class="slider_container_wrapper">
							<div class="main_slider_container clear">
								<div class="swiper-container" id="community_colaboratives_slider">
									<div class="swiper-wrapper">
								<?php
								$index = 0;
									while( have_rows('colaboratives_items') ): the_row();
									$image = get_sub_field('colaboratives_item_logo');
									$text = get_sub_field('colaboratives_item_text');
									$url = get_sub_field('colaboratives_item_url');
									
									?>
									<div class="slide swiper-slide" index="<?php echo $index;?>">
										<a <?php echo !empty($url)?'href="'.$url.'" target="_blank"':''; ?> class="slider_wrapper">
											<div class="slider_logo_container">
												<div class="slider_logo" style="background-image:url(<?php echo $image['url'];?>)" ></div>
											</div>
											<div class="slider_text_container">
												<div class="slider_text_container_wrapper ellipsis" lines="7">
												<?php if(!empty($text)){ ?>
												<?php echo $text;?>
												<?php } ?>
												</div>
											</div>
										</a>
									</div>
									<?php
									$index++;
								endwhile;
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
					</div>
				</div>
			</div>
			<?php 
			}
			?>
			<?php 
				//get logos slider
				if( have_rows('logos_items') ){
				?>
				<div class="community_item_container community_logos">
						<?php 
						$logos_header_text = get_post_meta($post->ID,'logos_header_text',true);
						if(!empty($logos_header_text)){
						?>
					<div class="community_item_header">
						<?php echo wpautop($logos_header_text);?>
					</div>
					<?php } ?>
					<div class="community_item_wrapper">
							<div class="slider_container">
							<div class="slider_container_wrapper">
							<div class="main_slider_container clear">
								<div class="swiper-container" id="community_logos_slider">
									<div class="swiper-wrapper">
								<?php
								$index = 0;
									while( have_rows('logos_items') ): the_row();
									$image = get_sub_field('logos_item_logo');
									$url = get_sub_field('logos_item_url');
									
									?>
									<div class="slide swiper-slide" index="<?php echo $index;?>">
										<a <?php echo !empty($url)?'href="'.$url.'" target="_blank"':''; ?> class="slider_wrapper">
											<div class="slider_logo_container">
												<div class="slider_logo" style="background-image:url(<?php echo $image['url'];?>)" ></div>
											</div>
										</a>
									</div>
									<?php
									$index++;
								endwhile;
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
					</div>
				</div>
			</div>
			<?php 
			}
			?>
		</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/community.js"></script>