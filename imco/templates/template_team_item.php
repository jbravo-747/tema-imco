<?php
/**
 * Template Name: Item Equipo
 *
 * @package WordPress
 */
get_header();
get_website_header();
$page = get_page_by_path( 'equipo' );
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($page -> ID); ?>" value="<?php echo get_permalink($page -> ID); ?>">
<div id="primary" class="content-area primary_team_item">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="home">
		<div class="section_container">
			<?php get_breadcrumb($post);?>
			<div class="section_content team_item_section_content">
				<div class="team_item_header clear" >
					<?php 
					$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID ), 'full', false, '');
					$job_description = get_post_meta($post->ID,'job_description',true);
					$team_item_details = get_post_meta($post->ID,'team_item_details',true);
					$title = $post->post_title;
													// if(empty($img_src)){
								// $img_src[0] =get_stylesheet_directory_uri().'/images/shapeofyou.jpg';
								// }
					?>
					<?php 
					if(!empty($img_src)){
					?>
					<div class="team_item_image_container">
						<div class="team_item_image" style="background-image:url(<?php echo $img_src[0];?>)"></div>
					</div>
					<?php } ?>
					<div class="team_item_info_container">
						<div class="team_item_main_info">
							<h1 class="team_item_main_info_title"><?php echo $title;?></h1>
							<span><?php echo preg_replace("/<br\W*?\/>/", " ", wpautop($job_description));;?></span>
						</div>
						<div class="team_item_details">
							<?php echo wpautop($team_item_details);?>
						</div>
					</div>
				</div>
				<div class="team_item_content text_container" >
					<?php echo wpautop($post->post_content);?>
				</div>	
				<?php 
				$team_item_downloads = get_field('team_item_downloads');
				if($team_item_downloads)
				{
					echo '<div class="team_item_downloads">';
					foreach($team_item_downloads as $team_item_download)
					{
						echo '<div class="download_btn_container"><a href="'.$team_item_download['team_item_file']['url'].'" class="download_btn" download target="_blank">'.$team_item_download['team_item_title'].'</a></div>';
					}
					echo '</div>';
				}
				?>
							<?php
			//Get posts by author id
			$related_user =  get_post_meta($post->ID, 'related_user',true);
			if($related_user){
			$args = array(
			  'author'        =>  $related_user, 
			  'orderby'       =>  'post_date',
			  'post_type'     => 'post',
			  'order'         =>  'DESC',
			  'posts_per_page' => 2,
			   'post_status' => array('publish') 
			);
			
			$current_user_posts = new WP_Query($args);
			if(!empty($current_user_posts->posts)){
				?>
				<div class="author_posts_container">
					<div class="author_posts_wrapper">
						<h2 class="authoer_posts_title">Últimas publicaciones del autor</h2>
						<div class="author_posts_list clear">
						<?php	
						foreach($current_user_posts->posts as $user_post){
							$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($user_post->ID ), 'full', false, '');
							$post_title = $user_post->post_title;
							if(!empty($img_src[0])){
								$image = $img_src[0];
							}else{
								$image = get_stylesheet_directory_uri().'/images/default_post.png';
								
							}
							?>
							<div class="author_post_item" >
								<a href="<?php echo get_permalink($user_post->ID); ?>" class="author_post_item_wrapper" >
									<div class="author_post_image" style="background-image:url(<?php echo $image;?>);"></div>
									<div class="author_post_title ellipsis" lines="4" ><?php echo $post_title;?></div>
								</a>
							</div>
							<?php  
						}
						?>
						</div>
					</div>
				</div>
				<?php
			}
			}
			?>
			</div>

			<div class="team_footer">
						<a href="<?php echo get_permalink($page -> ID); ?>" class="btn btn_goback">REGRESAR</a>
					</div>
		</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>