<?php
/**
* Template Name: Resultados
*
* @package WordPress
*/
$page = get_page_by_path( 'resultados' );
global $post;
$post=$page;
setup_postdata( $page ); 
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($page -> ID); ?>" value="<?php echo get_permalink($page -> ID); ?>">
<div id="primary" class="content-area primary_search">
  <main id="main" class="site-main" role="main">
    <div class="page_content_container" >
      <div class="page_content_container_wrapper" id="search">
		<div class="section_container">
			<?php get_breadcrumb($page);?>
			<div class="section_content clear">
				<div class="search_sidebar left_sidebar">
						<?php if(!empty($_GET['cs'])){ ?>
						<div class="search_content_title">
							<label>Estás buscando:</label> <span><?php echo $_GET['cs'];?></span>
						</div>
						<?php } ?>
					<?php echo get_filters_sidebar();?>
				</div>
				<div class="search_content right_content">
					<div class="search_content_wrapper">
						<?php if(!empty($_GET['cs'])){ ?>
						<div class="search_content_title">
							<label>Estás buscando:</label> <span><?php echo $_GET['cs'];?></span>
						</div>
						<?php } ?>
						<?php custom_get_results();?>
					</div>
				</div>
				
			</div>
			</div>
      </div>
    </div>
  </main>
</div>
<?php get_footer(); ?>
<script type="text/javascript"   src="<?php echo get_stylesheet_directory_uri(); ?>/js/icheck.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/icheck_skins/minimal/gray.css"/>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/search.js">
</script>
