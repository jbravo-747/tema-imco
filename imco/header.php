<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 * V2.0
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />

	<title><?php echo $post->post_title;?></title>
	<?php 
		global $mobile;
		require_once ('Mobile_Detect.php');
		$detect = new Mobile_Detect(); 
		$class="desktop_version";
		if($detect->isMobile() || $detect->isTablet()){
		$class="mobile_version";
		}
		?>

<meta property="fb:app_id" content="141448832714787" />

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/fonts.css"/>
<?php 
if($_GET['version']=='1'){
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/stylev1.css"/>
<?php
}else{
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css"/>
<?php 
}
?>
<?php 
if($class!="mobile_version"){
	?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/hovers.css"/>			
	<?php
}else{
	?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/hovers.css"/>			
	<?php	
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/mobile.css"/>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var theme_url = "<?php echo get_stylesheet_directory_uri(); ?>";
    var home_url="<?php echo get_home_url(); ?>/";
    
</script>
	<?php wp_head(); ?>

	<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(documento,"script","https://chimpstatic.com/mcjs-connected/js/users/c3db59ffdd396b96e15280017/ac530401e339a71397b48db1f.js");</script>
</head>
<body <?php body_class(array( "landscape")); ?>  >
<div class="post_image_pop_up">
<div class="post_image_pop_up_wrapper">
<div class="post_image_pop_up_close"></div>
<div class="post_image_pop_up_img_div"></div>
	
</div>
</div>
<div class="fake_background"></div>
	<div class="site_container">

	<div id="checkVw"></div>

<div id ="site_container" class="<?php echo $class;?>">
<div id="page" class="hfeed site">


	<div id="content" class="site-content">
