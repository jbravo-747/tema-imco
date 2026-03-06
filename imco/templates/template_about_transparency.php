<?php
/**
* Template Name: Transparencia institucional
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-reports primary_about">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="about">
		<div class="about_section">
			<?php 
			//Get about header (include submenu, title and main text).
			get_about_header(false);
			?>
			<?php 
			//Charts data and html
			$transparency_charts = get_field('transparency_charts',$post->ID);
			if(!empty($transparency_charts)){
				?>
				<div class="charts_container">
					<div class="charts_container_wrapper">
						<div class="charts_container_tabs">
							<?php
							$index = 0;
							foreach($transparency_charts as $transparency_chart)
							{
								$transparency_chart_title = $transparency_chart['transparency_chart_title'];
								?>
								<div class="chart_tab <?php echo $index==0?'active':'';?>" goto="<?php echo $transparency_chart_title ?>"><?php echo $transparency_chart_title ?></div>
								<?php
								$index++;
							}
							?>
						</div>
						<div class="carts_object_container">
							<script>
								chart_titles ={};
								chart_data ={};
							</script>
							<?php
							$index=0;
							foreach($transparency_charts as $transparency_chart)
							{
								$transparency_chart_title = $transparency_chart['transparency_chart_title'];
								$transparency_chart_data = $transparency_chart['transparency_chart_data'];
								$chart=get_format_chart_array($transparency_chart_data);
								?>
								<div class="chart_object" chart_id="<?php echo $transparency_chart_title ?>" <?php echo $index==0?'style="display:block"':'';?>>
									<div class="chart_title"><?php echo $transparency_chart_title ?></div>
									<script>
									<?php
									 $js_array_titles = json_encode($chart['titles']);
									echo "chart_titles['". $transparency_chart_title . "'] = ". $js_array_titles . ";\n";
									 $js_array = $chart['data'];
									echo "chart_data['". $transparency_chart_title . "'] = [". $js_array . "];\n";
									 ?>
									</script>
									<div class="chart"></div>
								</div>
								<?php
								$index++;
							}
							?>
						</div>
					</div>
				</div>		
				<?php
			}
			?>
			
			
			<?php 
			$reports_title = get_field('reports_title',$post->ID);
			$reports_items = get_field('reports_items',$post->ID);
			if(!empty($reports_items))
			{
				?>
				<div class="reports_items_list_container">
					<h2 class="reports_items_title"><?php echo $reports_title;?></h2>				
				<div class="reports_items_list clear">
				<?php
				foreach($reports_items as $reports_item)
				{
					$reports_item_title= $reports_item['reports_item_title'];
					$reports_item_background_color= $reports_item['reports_item_background_color'];
					$reports_text_text_color= $reports_item['reports_item_text_color'];
					$reports_item_file= $reports_item['reports_item_file'];
					?>
					<div class="reports_item ">
						<a href="<?php echo $reports_item_file['url']?>" target="_blank" download class="reports_item_container" style="background-color:<?php echo $reports_item_background_color;?>;color:<?php echo $reports_text_text_color;?>">
							<div class="reports_item_title_container">
										<h3>Reporte</br>
											Institucional</br>
											<label><?php echo $reports_item_title;?></label></h3>
							</div>
						</a>
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
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/transparency.js"></script>