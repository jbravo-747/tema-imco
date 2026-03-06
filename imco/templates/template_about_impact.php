<?php
/**
* Template Name: Impacto
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> post_parent); ?>" value="<?php echo get_permalink($post -> post_parent); ?>">
<div id="primary" class="content-impact primary_impact">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="impact">
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
			$impact_title = get_field('impact_title',$post->ID);
			$impact_items = get_field('impact_items',$post->ID);
			if($impact_items)
			{
				?>
				<div class="impact_items_list_container">
					<h2 class="impact_items_title"><?php echo $impact_title;?></h2>				
				<div class="impact_items_list clear">
				<?php
				foreach($impact_items as $impact_item)
				{
					$impact_item_title= $impact_item['impact_item_title'];
					$impact_item_text= $impact_item['impact_item_text'];
					?>
					<div class="impact_item">
						<div class="left_line"></div>
						<div class="impact_item_container">
							<div class="impact_item_title_container">
										<h1><span></span><?php echo $impact_item_title;?></h1>
							</div>
							<div class="impact_item_text_container">
								<div class="impact_item_text"><?php echo wpautop($impact_item_text);?></div>
							</div>
						</div>
					</div>
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
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/impact.js">
</script>