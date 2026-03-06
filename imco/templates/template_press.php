<?php
/**
* Template Name: Prensa
*
* @package WordPress
*/
get_header();
get_website_header();

?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>" value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_press">
	<main id="main" class="site-main" role="main">
		<div class="page_content_container" >
			<div class="page_content_container_wrapper" id="press">
				<div class="section_container">
					<?php get_breadcrumb($post);?>
					<div class="section_content">
						<div class="section_header clear">
							<h1 class="section_title">
								<?php echo $post->post_title;?>
							</h1>
						</div>
						<div class="section_columnize_layour clear">
							<div class="section_main_content">
								<?php
								//Get post type information
								$post_type_slug = 'press-release';
								$pt = get_post_type_object($post_type_slug);
								?>
								<h2 class="main_content_title"><?php echo $pt->label; ?></h2>
								<div class="press_container" >
									<div class="press_container_wrapper">
										<?php 
										// Loop Press Releases, paged every 6 posts.
										$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
										$args = array(
										'post_type' => $post_type_slug,
										'post_status' => 'publish',
										 'posts_per_page'         => 6,
										'orderby' => 'date',
										'paged' => $paged,
										'order' => 'DESC');
										
										$results = new WP_Query( $args );
										if(!empty($results->posts)){ ?>
											<div class="press_list">
												<?php
												$index = 0;
												foreach($results->posts as $press_item){
													$press_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($press_item->ID), 'full', false, '');
													$text= wpautop($press_item->post_content);
													$url = get_post_meta($press_item->ID,'custom_url',true);
												?>
												<div class="press_item" >
													<div class="press_item_wrapper">
														<a <?php echo !empty($url)?'href="'.$url.'"':'';?> class="press_item_content clear">
															<div class="press_item_image_container" style="background-image:url(<?php echo $press_item_image[0]; ?>)"></div>
															<div class="press_text_content_container">
																<div class="vertical_center_table">
																	<div class="press_date_container">
																		<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/date_icon.svg"/></span>
																		<?php echo spanish_date(get_the_date( 'Y-m-d' ,$press_item->ID))?>
																	</div>
																	<h2 class="press_text_content_title ellipsis" lines="2" ><?php echo $press_item->post_title;?></h2>
																	<div class="press_text_content_text ellipsis" lines="2"><?php echo  $text;?></div>
																</div>
															</div>
														</a>
														<?php 
														$custom_downloads = get_field('custom_downloads',$press_item->ID);
														if($custom_downloads)
														{
															echo '<div class="custom_item_downloads clear"><label>DESCARGAS: </label>';
															foreach($custom_downloads as $custom_download)
															{
																$icon ='';
																if(!empty($custom_download['custom_download_icon'])){
																	$icon ='<div class="download_icon" style="background-image:url('.$custom_download['custom_download_icon']['url'].')"></div>'; 
																}
																echo '<div class="custom_download_btn_container"><a href="'.$custom_download['custom_download_file']['url'].'" class="custom_download_btn" download target="_blank">'.$icon.'<span>'.$custom_download['custom_download_title'].'</span></a></div>';
															}
															echo '</div>';
														}
														?>
													</div>
												</div>
												<?php	
												}
												?>
											<?php 
											if($results->max_num_pages >1){
												?>
												<div class="post_pagination" >
											<?php 
												pagination_bar( $results );
											?>
												</div>
											<?php } ?>
										<div class="press_footer">
											<a href="<?php echo get_home_url(); ?>" class="btn btn_goback">REGRESAR</a>
										</div>
										</div>
										<?php
									}
									?>
									</div>
								</div>
							</div>
							<div class="section_side_content">
									<div class="section_side_content_float">
										<div class="section_side_content_float_content">
										<?php 
										$right_column_title = get_post_meta($post->ID,'right_column_title',true);
										$right_column_html = get_post_meta($post->ID,'right_column_html',true);
										?>
										<h2 class="main_content_title"><?php echo $right_column_title; ?></h2>
										<div class="section_side_content_html">
											<?php echo wpautop($right_column_html); ?>
										</div>
											<?php 
														$right_column_buttons = get_field('right_column_buttons',$post->ID);
														if(!empty($right_column_buttons))
														{
															echo '<div class="section_side_content_buttons">';
															$index =0;
															foreach($right_column_buttons as $right_column_button)
															{
																?>
																<a href="<?php echo $right_column_button['right_column_button_link'];?>" <?php echo $right_column_button['target_blank']?'target="_blank"':'';?> class="sidebar_btn" id="sidebar_btn_<?php echo $index;?>">
																	<style>
																	#sidebar_btn_<?php echo $index;?>{
																		color:<?php echo $right_column_button['right_column_button_text_color'];?>;
																		background-color:<?php echo $right_column_button['right_column_button_background_color'];?>;
																	}
																	#sidebar_btn_<?php echo $index;?>:hover{
																		color:<?php echo $right_column_button['right_column_button_text_color_hover'];?>;
																		background-color:<?php echo $right_column_button['right_column_button_background_color_hover'];?>;
																	}
																	#sidebar_btn_<?php echo $index;?>.mobile_hover{
																		color:<?php echo $right_column_button['right_column_button_text_color_hover'];?>;
																		background-color:<?php echo $right_column_button['right_column_button_background_color_hover'];?>;
																	}
																		
																	</style>
																	<?php echo $right_column_button['right_column_button_text'];?>
																</a>
																<?php
															$index++;
															}
															echo '</div>';
														}
														?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/press.js"></script>