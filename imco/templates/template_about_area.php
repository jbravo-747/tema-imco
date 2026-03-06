<?php
/**
* Template Name: Areas
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> post_parent); ?>" value="<?php echo get_permalink($post -> post_parent); ?>">
<div id="primary" class="content-area primary_areas">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="areas">
		<div class="about_section">
			<?php 
			//Get about header (include submenu, title and main text).
			get_about_header(true);
			?>
			<?php 
			//get menu of page children.
			get_children_submenu();
			?>
			<?php 
			$area_title = get_field('area_title',$post->ID);
			$area_items = get_field('area_items',$post->ID);
			if($area_items)
			{
				?>
				<div class="area_items_list_container">
					<h2 class="area_items_title"><?php echo $area_title;?></h2>				
				<div class="area_items_list clear">
				<?php
				foreach($area_items as $area_item)
				{
					$area_item_image= $area_item['area_item_image'];
					$area_item_title= $area_item['area_item_title'];
					$area_item_text= $area_item['area_item_text'];
					$area_item_background_color= $area_item['area_item_background_color'];
					$area_item_size= $area_item['area_item_size'];
					$area_item_float= $area_item['area_item_float'];
					$url= $area_item['area_item_url'];
					?>
					<a <?php echo !empty($url)?'href="'.$url.'"':'';?> class="area_item <?php echo $area_item_size;?> <?php echo $area_item_float;?>">
						<div class="area_item_container" style="background-color:<?php echo $area_item_background_color;?>;">
							<div class="area_item_image_container">
								<div class="area_item_image" style="background-image:url(<?php echo $area_item_image['url'];?>);"></div>
							</div>
							<div class="area_item_title_container">
								<div class="area_item_title_container_table">
									<div class="area_item_title_container_cell">
										<h3><?php echo $area_item_title;?></h3>
									</div>
								</div>
							</div>
							<div class="area_item_text_container">
								<div class="area_item_text"><?php echo wpautop($area_item_text);?></div>
							</div>
						</div>
					</a>
					<?php

				}
				?>
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
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/areas.js">
</script>