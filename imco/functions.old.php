<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */


if ( ! isset( $content_width ) ) {
	$content_width = 660;
}


if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
function twentyfifteen_setup() {
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

function twentyfifteen_widgets_init() {

}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :

function twentyfifteen_fonts_url() {

}
endif;


function twentyfifteen_javascript_detection() {
	
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );


function twentyfifteen_scripts() {

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

function twentyfifteen_post_nav_background() {

}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';

// Remove annoying admin bar
add_action('after_setup_theme', 'remove_admin_bar' );

	function remove_admin_bar() {
	show_admin_bar(false);
	}

// Get post excerpt for social metatags
	function get_excerpt_or_croped_content($post_id,$count = 200){
	$excerpt = custom_get_the_excerpt($post_id);
	if(!$excerpt){
	$last="";
	$this_post = get_post($post_id);
	$excerpt = $this_post->post_content;
	$excerpt = apply_filters('the_content', $excerpt);
	$excerpt = str_replace(']]>',']]&gt;', $excerpt);
	if(strlen ($excerpt)>100){
	$last="...";
	}
	$excerpt= substr(strip_tags($excerpt),0,$count);
	$excerpt.=$last;
	}
	return strip_tags($excerpt);

	}
	
	// Crop text and add 3 dots
	function crop_text($text,$count = 200){
	if(strlen ($text)>$count){
	$last="...";
	}
	$text= substr(strip_tags($text),0,$count);
	return $text.$last;
	}
	// Get post excerpt by id
	function custom_get_the_excerpt($post_id) {
	global $post;
	$save_post = $post;
	$post = get_post($post_id);
	$output = get_the_excerpt();
	$post = $save_post;
	return $output;
	}
// Create general keywords textbox for  social metatags.
$new_general_setting_keywords = new new_general_setting_keywords();
class new_general_setting_keywords {
    function new_general_setting_keywords( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields_keywords' ) );
    }
    function register_fields_keywords() {
        register_setting( 'general', 'keywords', 'esc_attr' );
        add_settings_field('keywords', '<label for="keywords">'.__('Keywords' , 'keywords' ).'</label>' , array(&$this, 'fields_html_keywords') , 'general' );
    }
    function fields_html_keywords() {
        $value = get_option( 'keywords', '' );
        echo '<textarea  id="keywords" name="keywords"  style="width:800px;height:300px;" >'.$value.'</textarea>';
    }
}
// Create general Google Analitycs field.
$new_general_setting_googlea = new new_general_setting_googlea();

class new_general_setting_googlea {
    function new_general_setting_googlea( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields_googlea' ) );
    }
    function register_fields_googlea() {
        register_setting( 'general', 'googlea', 'esc_attr' );
        add_settings_field('googlea', '<label for="googlea">'.__('Google Analytics code' , 'googlea' ).'</label>' , array(&$this, 'fields_html_googlea') , 'general' );
    }
    function fields_html_googlea() {
        $value = get_option( 'googlea', '' );
        echo '<input type="text"  id="googlea" name="googlea" value="'.$value.'"  style="width:800px;" >';
    }
}
// Create general description textbox for social metatags.
$new_general_setting_default_desc = new new_general_setting_default_desc();

class new_general_setting_default_desc {
    function new_general_setting_default_desc( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields_default_desc' ) );
    }
    function register_fields_default_desc() {
        register_setting( 'general', 'default_desc', 'esc_attr' );
        add_settings_field('default_desc', '<label for="default_desc">'.__('Descripcion' , 'default_desc' ).'</label>' , array(&$this, 'fields_html_default_desc') , 'general' );
    }
    function fields_html_default_desc() {
        $value = get_option( 'default_desc', '' );
        echo '<textarea  id="default_desc" name="default_desc"  style="width:800px;height:300px;" >'.$value.'</textarea>';
    }
}
// Create general address textbox.
$new_general_setting_address = new new_general_setting_address();

class new_general_setting_address {
    function new_general_setting_address( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields_address' ) );
    }
    function register_fields_address() {
        register_setting( 'general', 'address', 'esc_attr' );
        add_settings_field('address', '<label for="address">'.__('Direccion' , 'address' ).'</label>' , array(&$this, 'fields_html_address') , 'general' );
    }
    function fields_html_address() {
        $value = get_option( 'address', '' );
        echo '<input type="text"  id="address" name="address" value="'.$value.'"  style="width:800px;" >';
    }
}
// Create contact email field.
$new_general_setting_contact_email = new new_general_setting_contact_email();

class new_general_setting_contact_email {
    function new_general_setting_contact_email( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields_contact_email' ) );
    }
    function register_fields_contact_email() {
        register_setting( 'general', 'contact_email', 'esc_attr' );
        add_settings_field('contact_email', '<label for="contact_email">'.__('Email' , 'contact_email' ).'</label>' , array(&$this, 'fields_html_contact_email') , 'general' );
    }
    function fields_html_contact_email() {
        $value = get_option( 'contact_email', '' );
        echo '<input type="text"  id="contact_email" name="contact_email" value="'.$value.'"  style="width:800px;" >';
    }
}
// Create phone field.
$new_general_setting_phone = new new_general_setting_phone();

class new_general_setting_phone {
    function new_general_setting_phone( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields_phone' ) );
    }
    function register_fields_phone() {
        register_setting( 'general', 'phone', 'esc_attr' );
        add_settings_field('phone', '<label for="phone">'.__('Telefono' , 'phone' ).'</label>' , array(&$this, 'fields_html_phone') , 'general' );
    }
    function fields_html_phone() {
        $value = get_option( 'phone', '' );
        echo '<input type="text"  id="phone" name="phone" value="'.$value.'"  style="width:800px;" >';
    }
}
// Create copyrights field.
$new_general_setting_copyrights = new new_general_setting_copyrights();

class new_general_setting_copyrights {
    function new_general_setting_copyrights( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields_copyrights' ) );
    }
    function register_fields_copyrights() {
        register_setting( 'general', 'copyrights', 'esc_attr' );
        add_settings_field('copyrights', '<label for="copyrights">'.__('Copyright' , 'copyrights' ).'</label>' , array(&$this, 'fields_html_copyrights') , 'general' );
    }
    function fields_html_copyrights() {
        $value = get_option( 'copyrights', '' );
        echo '<textarea id="copyrights" name="copyrights" "  style="width:800px;" >'.$value.'</textarea>';
    }
}

// Get user IP address
if (!function_exists("get_ip_address")) {
function get_ip_address() {
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                    return $ip;
                }
            }
        }
    }
}
}
// Get website header
function get_website_header(){
global $post;
?>
<header id="masthead" class="site-header" role="banner">
	<div class="header_wrapper clear">
		<div class="top_header_container">
			<div class="top_header_wrapper clear">
					<div class="main_logo">
						<a href="<?php echo get_home_url(); ?>" >
							<div class="logo">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" />
							</div>
							<div class="logo_text">
								CENTRO DE INVESTIGACIÓN
								</br>EN POLÍTICA PÚBLICA
							</div>
						</a>
					</div>
					<div class="top_header_right_container">
						<div class="top_menu" >
					<div class="top_menu_wrapper_container">
						<div class="top_menu_wrapper clear">
							<nav class="top-nav-div">
								<ul class="top-nav" >
									<?php
									$menu_name = 'top_menu';
									
									$menu_object = wp_get_nav_menu_object( $menu_name );
									  $menuitems = wp_get_nav_menu_items( $menu_object->term_id, array( 'order' => 'DESC' ) );
									    $count = 0;
										if(!empty($menuitems)){
									    foreach( $menuitems as $item ):
									        $title = $item->title;
									        $link = $item->url;
									    ?>
									     <li class="item"  id="menu_item_<?php echo $count; ?>" item_id="<?php echo $item->ID; ?>">
									        <a href="<?php echo $link; ?>" class="title underline_link">
									        <?php echo $title;?>
									        </a>
									    </li>
									<?php $count++; endforeach; 
										}
									?>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<?php 
					$page = get_page_by_path( 'resultados' );
				// Search container
				?>
				<div class="search_form_container">
					<div class="search_field_container clear">
						<form method="get" id="searchform" action="<?php echo get_permalink($page->ID)?>">
						<input type="text" placeholder="¿Qué estás buscando?" value="<?php echo $_GET['cs'];?>" id="s" name="cs" />
						<input type="submit" value=" "  id="search_btn" />
						//Agrega filtros a la búsqueda
						<input type="hidden" name="t[]" value="investigacion">
						</form>
					</div>
				</div>
					</div>
			</div>
		</div>
		<?php 
		// Get and print Areas Menu
		?>
		<div class="bottom_header_container">
			<div class="bottom_header_wrapper">
				<div class="main_menu" >
					<div class="main_menu_wrapper_container">
						<div class="main_menu_wrapper clear">
							<nav class="main-nav-div">
								<ul class="main-nav" >
									<?php
									$menu_name = 'main_menu';
									
									$menu_object = wp_get_nav_menu_object( $menu_name );
									  $menuitems = wp_get_nav_menu_items( $menu_object->term_id, array( 'order' => 'DESC' ) );
									    $count = 0;
										if(!empty($menuitems)){
									    foreach( $menuitems as $item ):
									        $title = $item->title;
									        $link = $item->url;
									    ?>
									     <li class="item"  id="menu_item_<?php echo $count; ?>" item_id="<?php echo $item->ID; ?>">
									     	<?php if(!empty($item->object_id)){
									     		$color = get_post_meta($item->object_id,'area_color',true);
												?>
												<style>
												.main_menu .main_menu_wrapper_container .main_menu_wrapper nav ul li#menu_item_<?php echo $count; ?> a:after{
													background-color:<?php echo $color;?>;
												}
									     		</style>
									     		<?php
									     	}?>
									        <a href="<?php echo $link; ?>" class="title underline_link">
									        <?php echo $title;?>
									        </a>
									    </li>
									<?php $count++; endforeach; 
										}
									?>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
		// Print Hamburger button
		?>
	<div class="menu_black_btn closed">
					<a class="header__mobile-icon" data-has-menu="true">
				        <button class="hamburger">
				          <span></span>
				        </button>
      				</a>
				</div>
</header>
<?php 
// Print Hamburger button
?>
<div class="mobile_menu">
	<div class="mobile_menu_container">
	<div class="mobile_menu_container_wrapper">
		<div class="search_form_container">
				<div class="search_field_container clear">
						<form method="get" id="searchform" action="<?php echo get_permalink($page->ID)?>">
						<input type="text" placeholder="Buscar..." value="<?php echo $_GET['cs'];?>" id="s" name="cs" />
						<input type="submit" value=" "  id="search_btn" />
						</form>
					</div>
				</div>	
						<nav class="mobile-nav-div">
								<ul class="mobile-nav" >
									<?php
									$menu_name = 'top_menu';
									
									$menu_object = wp_get_nav_menu_object( $menu_name );
									  $menuitems = wp_get_nav_menu_items( $menu_object->term_id, array( 'order' => 'DESC' ) );
									    $count = 0;
										if(!empty($menuitems)){
									    foreach( $menuitems as $item ):
									        $title = $item->title;
									        $link = $item->url;
									    ?>
									     <li class="item"  id="menu_item_<?php echo $count; ?>" item_id="<?php echo $item->ID; ?>">
									        <a href="<?php echo $link; ?>" class="title underline_link">
									        <?php echo $title;?>
									        </a>
									    </li>
									<?php $count++; endforeach; 
										}
									?>
									<li><a>Áreas</a></li>
								</ul>
								<div class="areas_submenu">
									<ul class="areas_submenu-nav" >
									<?php
									$menu_name = 'main_menu';
									
									$menu_object = wp_get_nav_menu_object( $menu_name );
									  $menuitems = wp_get_nav_menu_items( $menu_object->term_id, array( 'order' => 'DESC' ) );
									    $count = 0;
										if(!empty($menuitems)){
									    foreach( $menuitems as $item ):
									        $title = $item->title;
									        $link = $item->url;
									    ?>
									     <li class="item"  id="menu_item_<?php echo $count; ?>" item_id="<?php echo $item->ID; ?>">
									     	<?php if(!empty($item->object_id)){
									     		$color = get_post_meta($item->object_id,'area_color',true);
												?>
												<style>
												.areas_submenu ul li#menu_item_<?php echo $count; ?>:before{
													background-color:<?php echo $color;?>;
												}
									     		</style>
									     		<?php
									     	}?>
									        <a href="<?php echo $link; ?>" class="title underline_link">
									        <?php echo $title;?>
									        </a>
									    </li>
									<?php $count++; endforeach; 
										}
									?>
								</ul>
								</div>
							</nav>
									<div class="bottom_footer_container">
			<div class="center_footer clear">
				<!--  social menu -->
				<div class="social_menu">
					<nav>
						<ul class="social-nav" ><?php
							$menu_name = 'footer_social_menu';
							$menu_object = wp_get_nav_menu_object( $menu_name );
							  $menuitems = wp_get_nav_menu_items( $menu_object->term_id, array( 'order' => 'DESC' ) );
							    $count = 0;
							    $submenu = false;
								$submenu_html = '';
								if(!empty($menuitems)){
							    foreach( $menuitems as $item ):
							        // set up title and url
							        $title = $item->title;
							        $link = $item->url;
							    ?><li class="item"  id="social_menu_item_<?php echo $count; ?>" >
							        <a  target="_blank" href="<?php echo $link; ?>" class="social_item  <?php echo $title;?>">
							        	<span></span>
							        </a>
							    </li><?php $count++; endforeach; 
								}
							?></ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<?php
}
// Add Federico Salort's Styles to backend
/* function my_admin_theme_style() {
    wp_enqueue_style('my-admin-theme', get_stylesheet_directory_uri().'/admin-theme/wp-admin.css');
	wp_enqueue_style('my-admin-theme2', 'http://federicosalort.com/fsadmin/wp-admin.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style'); */
// Add Federico Salort's footer to backend
/* function my_crazy_admin_footer() {
 echo file_get_contents("http://federicosalort.com/fsadmin/get_content.php");
}
add_action('admin_footer', 'my_crazy_admin_footer'); */
// Add Federico Salort's Login message to backend
/* function smallenvelop_login_message( $message ) {
    if ( empty($message) ){
        return file_get_contents("http://federicosalort.com/fsadmin/get_content_login.php");
    } else {
        return $message;
    }
}
add_filter( 'login_message', 'smallenvelop_login_message' );
add_filter( 'login_message', 'smallenvelop_login_message' );
 */
// Check if is Mobile.
function custom_is_mobile(){
	require_once ('Mobile_Detect.php');
$detect = new Mobile_Detect(); //redireccionar a versin mvil si nos visitan desde un mvil o tablet
if
($detect->isMobile() || $detect->isTablet()) {
	$mobile = true;
}else{
	$mobile = false;
}	
	return $mobile;
}
// Compress Webiste HTML code.

// class WP_HTML_Compression
// {
    // // Settings
    // protected $compress_css = true;
    // protected $compress_js = true;
    // protected $info_comment = true;
    // protected $remove_comments = true;
// 
    // // Variables
    // protected $html;
    // public function __construct($html)
    // {
   	 // if (!empty($html))
   	 // {
   		 // $this->parseHTML($html);
   	 // }
    // }
    // public function __toString()
    // {
   	 // return $this->html;
    // }
    // protected function bottomComment($raw, $compressed)
    // {
   	 // $raw = strlen($raw);
   	 // $compressed = strlen($compressed);
//    	 
   	 // $savings = ($raw-$compressed) / $raw * 100;
//    	 
   	 // $savings = round($savings, 2);
//    	 
   	 // return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
    // }
    // protected function minifyHTML($html)
    // {
   	 // $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
   	 // preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
   	 // $overriding = false;
   	 // $raw_tag = false;
   	 // // Variable reused for output
   	 // $html = '';
   	 // foreach ($matches as $token)
   	 // {
   		 // $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
//    		 
   		 // $content = $token[0];
//    		 
   		 // if (is_null($tag))
   		 // {
   			 // if ( !empty($token['script']) )
   			 // {
   				 // $strip = $this->compress_js;
   			 // }
   			 // else if ( !empty($token['style']) )
   			 // {
   				 // $strip = $this->compress_css;
   			 // }
   			 // else if ($content == '<!--wp-html-compression no compression-->')
   			 // {
   				 // $overriding = !$overriding;
//    				 
   				 // // Don't print the comment
   				 // continue;
   			 // }
   			 // else if ($this->remove_comments)
   			 // {
   				 // if (!$overriding && $raw_tag != 'textarea')
   				 // {
   					 // // Remove any HTML comments, except MSIE conditional comments
   					 // $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
   				 // }
   			 // }
   		 // }
   		 // else
   		 // {
   			 // if ($tag == 'pre' || $tag == 'textarea')
   			 // {
   				 // $raw_tag = $tag;
   			 // }
   			 // else if ($tag == '/pre' || $tag == '/textarea')
   			 // {
   				 // $raw_tag = false;
   			 // }
   			 // else
   			 // {
   				 // if ($raw_tag || $overriding)
   				 // {
   					 // $strip = false;
   				 // }
   				 // else
   				 // {
   					 // $strip = true;
//    					 
   					 // // Remove any empty attributes, except:
   					 // // action, alt, content, src
   					 // $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
//    					 
   					 // // Remove any space before the end of self-closing XHTML tags
   					 // // JavaScript excluded
   					 // $content = str_replace(' />', '/>', $content);
   				 // }
   			 // }
   		 // }
//    		 
   		 // if ($strip)
   		 // {
   			 // $content = $this->removeWhiteSpace($content);
   		 // }
//    		 
   		 // $html .= $content;
   	 // }
//    	 
   	 // return $html;
    // }
//    	 
    // public function parseHTML($html)
    // {
   	 // $this->html = $this->minifyHTML($html);
//    	 
   	 // if ($this->info_comment)
   	 // {
   		 // $this->html .= "\n" . $this->bottomComment($html, $this->html);
   	 // }
    // }
//     
    // protected function removeWhiteSpace($str)
    // {
   	 // $str = str_replace("\t", ' ', $str);
   	 // $str = str_replace("\n",  '', $str);
   	 // $str = str_replace("\r",  '', $str);
//    	 
   	 // while (stristr($str, '  '))
   	 // {
   		 // $str = str_replace('  ', ' ', $str);
   	 // }
//    	 
   	 // return $str;
    // }
// }
// 
// function wp_html_compression_finish($html)
// {
    // return new WP_HTML_Compression($html);
// }
// 
// function wp_html_compression_start()
// {
    // ob_start('wp_html_compression_finish');
// }
// add_action('get_header', 'wp_html_compression_start');
// add_action('wp_login_failed', 'my_front_end_login_fail'); 
// 
    // function my_front_end_login_fail($username){
        // // Get the reffering page, where did the post submission come from?
        // $referrer = $_SERVER['HTTP_REFERER'];
        // if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')){
              // if(!strstr($referrer,'&login=failed'))
               // {
                // wp_redirect( get_permalink( get_page_by_path( 'login' ) ) . '?login=failed' );  
               // }
              // else
               // {
                // wp_redirect( get_permalink( get_page_by_path( 'login' ) ) . '?login=failed' );  
               // }
// 
        // exit;
        // }
// 
    // }
    
// Send scripts to footer (to improve loading time).    
function scripts_footer() {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
 
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action( 'wp_enqueue_scripts', 'scripts_footer' );

// Get custom footer menu
function custom_get_footer_menu($menu_name){
	$menu_object = wp_get_nav_menu_object( $menu_name );
  	$menuitems = wp_get_nav_menu_items( $menu_object->term_id, array( 'order' => 'DESC' ) );
    $count = 0;
    $submenu = false;
	$submenu_html = '';
    foreach( $menuitems as $item ):
        // set up title and url
        $title = $item->title;
        $link = $item->url;
		       if ( !$item->menu_item_parent ){
        $parent_id = $item->ID;
    ?>
     	<div class="footer_menu_item footer_cell">
     		<div class="footer_menu_item">
        <a  <?php echo !empty($link)?'href="'.$link.'"':''; ?> class="title dropdown_title">
            <?php echo $title; ?>
        </a>
    <?php }; ?>
       <?php if ( $parent_id == $item->menu_item_parent ){ ?>
       	 <?php if ( !$submenu ){ $submenu = true; ?>
           <div class="sub-menu">
            <ul >
            <?php }; ?>
       	 <li class="item">
                    <a <?php echo !empty($link)?'href="'.$link.'"':''; ?> class="title"><?php echo $title; ?></a>
          </li>
                   <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
            </ul>
            </div>
            <?php $submenu = false; endif; ?>

        <?php }; ?>
          <?php if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
           </div>	
           </div>	
    <?php $submenu = false; endif; ?>

<?php $count++; endforeach; 
}

/**
 * Generate breadcrumbs
 */
function get_breadcrumb($mypost) {
    echo '<div class="breadcrumb_menu" ><a href="'.home_url().'" rel="nofollow">Inicio</a>';
	global $post_type_archive,$post_type_single;
	$separator = ' <span class="breadcrumb_separator"></span> ';
    if ($post_type_archive) {
    	echo $separator;
		echo $mypost->post_title ;
     } elseif ($post_type_single || is_single()) {
        
     	$page = get_page_by_path($post_type_single);
		if($page){
			echo $separator;
			echo '<a href="'.get_permalink($page->ID).'" >'.$page->post_title.'</a>';
		}
            if (is_single()) {
               
				if($mypost->post_type=='post'){
					$post_area= get_post_meta($mypost->ID,'post_area',true);
					if(!empty($post_area)){
					$the_slug =$post_area[0];
					$args = array(
					  'name'        => $the_slug,
					  'post_type'   => 'area',
					  'post_status' => 'publish',
					  'numberposts' => 1
					);
					$my_posts = get_posts($args);
					if( $my_posts ) :
					$post_area_post = $my_posts[0];
					endif;
					
					if($post_area_post){
						echo $separator;
						echo '<a href="'.get_permalink($post_area_post->ID).'" >'.$post_area_post->post_title.'</a>';
					}
					}
				}
				 echo $separator;
                the_title();
			}
    } elseif (is_page()) {
        echo $separator;
        echo the_title();
    } elseif (is_search()) {
        echo $separator;
         echo the_title();
    }
	echo '</div>';
}
/**
 * Get search results
 */
function custom_get_results(){
	?>
	<div class="search_content_list">
	<?php
   // Loop Posts, paged every 6 posts.
		// //$_GET['cs'] = '&t%5B%5D=investigacion&order_by=date_desc';
		// //$_GET['t'] = 'investigacion';
		// if(empty($_GET['t'])){
		// 	echo 'Dx';
		// 	array_push($_GET['t'],"investigacion");
		// }
		// foreach ($_GET['t'] as $value) {
		// 	echo $value;
		// }
		// echo $_GET['t'];
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
		
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page'         => 7,
		'paged' => $paged);
		if(!empty($_GET['cs'])){
			$args['suppress_filters'] = false;
			$args['s'] = $_GET['cs'];
		}

		switch ($_GET['order_by']) {
			case 'date_asc':
$meta_query[] = array(
			 'relation' => 'AND',
			 array(
		'search_date_cause' => array(
            'key'     => 'search_date',
        ), 
        'search_priority_cause' => array(
            'key'     => 'search_priority',
        ), 
    )
	);
			$args['orderby'] =array(
        'search_date_cause' => 'ASC',
        'search_priority_cause' => 'DESC',
    );
				break;
			case 'title_asc':
				$args['orderby'] = 'title';
				$args['order'] = 'ASC';
				break;
			case 'title_desc':
				$args['orderby'] = 'title';
				$args['order'] = 'desc';
				break;	
			default:
			$meta_query[] = array(
			 'relation' => 'AND',
			 array(
		'search_date_cause' => array(
            'key'     => 'search_date',
        ), 
        'search_priority_cause' => array(
            'key'     => 'search_priority',
        ), 
    )
	);
			$args['orderby'] =array(
        'search_date_cause' => 'DESC',
        'search_priority_cause' => 'DESC',
    );
	
	break;
		}
			// if(!empty($_GET['cs'])){
// 				
			 // $meta_query[] = array(
			 // 'relation' => 'AND',
			 // array(
			        // 'key'       => 'search_author',
			        // 'value'     => $_GET['cs'],
			        // 'compare'   => 'LIKE',
			  // )
			  // );
		// }
			if(!empty($_GET['a'])){
			foreach ($_GET['a'] as $value) {
			    $meta_query[] = array(
			   'relation' => 'OR', array(
			        'key'       => 'post_area',
			        'value'     => $value,
			        'compare'   => 'LIKE',
			    )
				);
			}
		}
			if(!empty($meta_query)){
			$args['meta_query']=array($meta_query);
			}
		if(!empty($_GET['t'])){
			$tax_query = array('relation' => 'OR');
			foreach ($_GET['t'] as $value) {
			    $tax_query[] = array(
			        'taxonomy'       => 'custom_post_type',
			        'field'   => 'slug',
			        'terms'     => array($value),
			    );
				if($value=='investigacion'){
					 $tax_query[] = array(
			        'taxonomy'       => 'custom_post_type',
			        'field'   => 'slug',
			        'terms'     => array('colaboracion'),
			    );
				}
			}
			$args['tax_query']=array($tax_query);
		}
		if(!empty($_GET['y'])){
			$date_query = array('relation' => 'OR');
			foreach ($_GET['y'] as $value) {
			    $date_query[] = array(
			        'year'     => $value,
			    );
			}
			$args['date_query']=array($date_query);
		}
		if(!empty($_GET['au'])){
			$args['author__in'] = $_GET['au'];
		}
		$results = new WP_Query( $args );
		//print_r($args);
		$post_ids = wp_list_pluck( $results->posts, 'ID' );
		// print_r($post_ids);
		if(!empty($results->posts)){
			foreach($results->posts as $post_item){
					$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_item->ID), 'full', false, '');
					$text= get_excerpt_or_croped_content($post_item->ID,500);
					$custom_post_type = wp_get_post_terms( $post_item->ID, 'custom_post_type' );
						if(!empty($post_item_image[0])){
								$image = $post_item_image[0];
							}else{
								$image = get_stylesheet_directory_uri().'/images/default_post.png';
								
							}
					?>
					<a href="<?php echo get_permalink($post_item->ID);?>" class="post_item" <?php echo get_post_meta($post_item->ID,'search_priority',true);?> >
						<div class="post_item_wrapper">
							<div class="post_item_content clear">
								<div class="post_item_image_container" style="background-image:url(<?php echo $image; ?>)"></div>
								<div class="post_text_content_container">
									<div class="vertical_center_table">
										<div class="post_content_header clear">
										<?php 
										if(!empty($custom_post_type)){
											?>
											<div class="post_type_label">
												<?php echo $custom_post_type[0]->name;?>
											</div>
											<?php
										}
										?>	
										<div class="post_date_container">
											<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/date_icon.svg"/></span>
											<?php echo spanish_date(get_the_date( 'Y-m-d' ,$post_item->ID))?>
										</div>
										</div>
										<h2 class="post_text_content_title ellipsis" lines="2" ><?php echo $post_item->post_title;?></h2>
										<div class="post_text_content_text ellipsis" lines="3"><?php echo  strip_tags($text);?></div>
										<?php 
										$author_id = get_post_field ('post_author', $post_item->ID);
										$display_name = get_the_author_meta( 'display_name' , $author_id ); 
										if(!empty($display_name)){
										?>
										<div class="post_author_content">
											Autor: <label><?php echo $display_name;?></label>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>

						</div>
					</a>
				<?php
			}
		}else{
		echo '<div class="no_results_found">No se encontraron resultados.</div>';
		}
		if($results->max_num_pages >1){
			?>
			<div class="post_pagination" >
		<?php 
			pagination_bar( $results );
		?>
			</div>
		<?php } 
		?>
		<div class="press_footer">
											<a href="<?php echo get_home_url(); ?>" class="btn btn_goback">REGRESAR</a>
										</div>
		</div>
		<?php
}
/**
 * Get results by Area slug
 */
function custom_get_results_areas($area_slug){
	?>
	<div class="search_content_list">
	<?php
   // Loop Posts, paged every 4 posts.
		$paged = ($_GET['cpage']) ? $_GET['cpage'] : 1;
		$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page'         => 4,
		'orderby' => 'date',
		'paged' => $paged,
		'order' => 'DESC');
		if(!empty($area_slug)){
			    $meta_query[] = array(
			        'key'       => 'post_area',
			        'value'     => $area_slug,
			        'compare'   => 'LIKE',
			    );
			$args['meta_query']=array($meta_query);
		}
		$results = new WP_Query( $args );
		if(!empty($results->posts)){
			foreach($results->posts as $post_item){
					$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_item->ID), 'full', false, '');
					$custom_post_type = wp_get_post_terms( $post_item->ID, 'custom_post_type' );
											if(!empty($post_item_image[0])){
								$image = $post_item_image[0];
							}else{
								$image = get_stylesheet_directory_uri().'/images/default_post.png';
								
							}
					?>
					<a href="<?php echo get_permalink($post_item->ID);?>" class="post_item" >
						<div class="post_item_wrapper">
							<div class="post_item_content clear">
								<div class="post_item_image_container" style="background-image:url(<?php echo $image; ?>)"></div>
								<div class="post_text_content_container">
									<div class="vertical_center_table">
										<div class="post_content_header clear">
										<?php 
										if(!empty($custom_post_type)){
											?>
											<div class="post_type_label">
												<?php echo $custom_post_type[0]->name;?>
											</div>
											<?php
										}
										?>	
										</div>
										<h2 class="post_text_content_title ellipsis" lines="2" ><?php echo $post_item->post_title;?></h2>
											<div class="post_date_container">
											<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/date_icon.svg"/></span>
											<?php echo spanish_date(get_the_date( 'Y-m-d' ,$post_item->ID))?>
										</div>
										<div class="see_more">Ver más</div>
										<?php 
										$author_id = get_post_field ('post_author', $post_item->ID);
										$display_name = get_the_author_meta( 'display_name' , $author_id ); 
										if(!empty($display_name)){
										?>
										<div class="post_author_content">
											Autor: <label><?php echo $display_name;?></label>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>

						</div>
					</a>
				<?php
			}
		}else{
		echo '<div class="no_results_found">No se encontraron resultados.</div>';
		}
		if($results->max_num_pages >1){
			?>
			<div class="post_pagination" >
		<?php 
			pagination_bar_custom( $results );
		?>
			</div>
		<?php } 
		?>
		</div>
		<?php
}

/**
* Add Related User Meta Box
*
*/

add_action( 'add_meta_boxes', 'user_custom_meta_box' );

function user_custom_meta_box($post){
    add_meta_box('user_meta_box', 'Usuario Relacionado', 'user_class_meta_box', 'equipo', 'normal' , 'high');
}

add_action('save_post', 'user_save_metabox');

/**
* Save Related User Meta Box value
*
*/
function user_save_metabox(){ 
    global $post;
    if(isset($_POST["related_user"])){
         //UPDATE: 
        $related_user = $_POST['related_user'];
        //END OF UPDATE
        update_post_meta($post->ID, 'related_user', $related_user);
        //print_r($_POST);
    }
}
/**
* Related User Meta Box HTML
*
*/
function user_class_meta_box($post){
    $related_user =  get_post_meta($post->ID, 'related_user',true);
    ?>   
    <select name="related_user" id="related_user">
    	<option value="" ></option>
      <?php 
		// Array of WP_User objects.
      	$users = get_users();
		foreach ( $users as $user ) {
			echo '<option value="'.$user->ID.'" '.selected( $related_user, $user->ID ).' >' . esc_html( $user->display_name ) . '</option>';
		}
      ?>
    </select>
    <?php
}

/**
* Add Related Banner Meta Box
*
*/

add_action( 'add_meta_boxes', 'banner_custom_meta_box' );

function banner_custom_meta_box(){
	global $post;;
	$frontpage_id = get_option( 'page_on_front' );
	if($post->post_type == 'post' || $post->post_type == 'area' || ($post->post_type == 'page' && $post->ID==8)){
    add_meta_box('banner_meta_box', 'Banner del footer', 'banner_class_meta_box', array('post','area','page'), 'normal' , 'high');
	}
	}

add_action('save_post', 'banner_save_metabox');

/**
* Save Related Banner Meta Box value
*
*/
function banner_save_metabox(){ 
    global $post;
    if(isset($_POST["related_banner"])){
         //UPDATE: 
        $related_banner = $_POST['related_banner'];
        //END OF UPDATE
        update_post_meta($post->ID, 'related_banner', $related_banner);
        //print_r($_POST);
    }
}
/**
* Related Banner Meta Box HTML
*
*/
function banner_class_meta_box($post){
    $related_banner =  get_post_meta($post->ID, 'related_banner',true);
    ?>   
    <select name="related_banner" id="related_banner">
    	<option value="" >Ninguno</option>
    	<option value="default" <?php echo empty($related_banner)?'selected':'';?> >Predeterminado</option>
    	<option value="newsletter" <?php selected( $related_banner, 'newsletter' )?> >Newsletter</option>
      <?php 
		// Array of Banners objects.
		 $args = array(
		    'post_type'      => 'banner',
		    'posts_per_page' => -1,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );
		$banners_query = new WP_Query( $args );
		$banners_posts = $banners_query->posts;
		if(!empty($banners_posts)){
		foreach ( $banners_posts as $banner ) {
			echo '<option value="'.$banner->ID.'" '.selected( $related_banner, $banner->ID ).' >' . esc_html( $banner->post_title ) . '</option>';
		}
		}
      ?>
    </select>
    <?php
}
/**
* Get about sections header (include submenu, title and main text)
*
*/
function get_about_header($use_parent_data=false){
	global $post;
	$the_post= $post;
	if($use_parent_data && $post->post_parent){
		$the_post = get_post($post->post_parent);
	}
	
				?>
				<div class="about_submenu">
				<nav class="about_submenu-nav-div">
								<ul class="about_submenu-nav" >
									<?php
									$menu_name = 'about_sub_menu';
									
									$menu_object = wp_get_nav_menu_object( $menu_name );
									  $menuitems = wp_get_nav_menu_items( $menu_object->term_id, array( 'order' => 'DESC' ) );
									    $count = 0;
										if(!empty($menuitems)){
									    foreach( $menuitems as $item ):
									        $title = $item->title;
									        $link = $item->url;
									    ?><li class="item"  id="menu_item_<?php echo $count; ?>" item_id="<?php echo $item->ID; ?>">
									        <a href="<?php echo $link; ?>" class="title underline_link">
									        <?php echo $title;?>
									        </a>
									    </li><?php $count++; endforeach; 
										}
									?>
								</ul>
							</nav>
			</div>
			<h1 class="about_section_title">
				<?php echo $the_post->post_title;?>
			</h1>
			<div class="about_section_content_header">
					<?php 
					$header_text = get_post_meta($the_post->ID,'header_text',true);

					echo wpautop($header_text);?>
			</div>
			<?php
}
/**
* Get menu of page children.
*
*/
function get_children_submenu(){
global $post;
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => 3,
    'post_parent'    => $post->post_parent,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );


$parent = new WP_Query( $args );
$parent_posts = $parent->posts;
if(!empty($parent_posts)){
	?>
	<div class="children_menu" >
		<div class="children_menu_position" id="submenu" ></div>
		<ul>
	<?php
	foreach($parent_posts as $child){
		?><li>
			<a href="<?php echo get_permalink($child->ID);?>#submenu"><span><?php echo $child->post_title;?></span></a>
		</li><?php
	}
	?>
	</ul>
	</div>
	<?php
}
}
/**
* Get pagination menu by query.
*
*/
function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        $pagination =  paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
             'show_all'           => false,
             'add_fragment'       => '',
     'end_size'           => 0,
    'mid_size'           => 2,
            'prev_text'          => '<',
			'next_text'          =>'>',
			 'type' => 'array',

        ));
		$allowed = array(
    ' current',
    'prev ',
    'next ',
    sprintf( '/page/%d/', $current_page-2 ),
    sprintf( '/page/%d/', $current_page-1 ),
    sprintf( '/page/%d/', $current_page+1 ),
    sprintf( '/page/%d/', $current_page+2 )
);
		$pagination = array_filter(
    $pagination,
    function( $value ) use ( $allowed ) {
        foreach( (array) $allowed as $tag )
        {
            if( false !== strpos( $value, $tag ) )
                return true;
        }
        return false;
    }
);
foreach ($pagination as $pag)
{
  echo $pag;
}
    }
}
/**
* Get custom pagination menu by query.
*
*/
function pagination_bar_custom( $custom_query ) {
    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, intval($_GET['cpage']));
        $pagination=  paginate_links(array(
            'format' => '?cpage=%#%/',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'          => '<',
			'next_text'          =>'>',
			 'end_size'           => 0,
    'mid_size'           => 2,
			 'type' => 'array',
        ));
				$allowed = array(
    ' current',
    'prev ',
    'next ',
    'next ',
    sprintf( '/?cpage=%d/', $current_page-2 ),
    sprintf( '/?cpage=%d/', $current_page-1 ),
    sprintf( '/?cpage=%d/', $current_page+1 ),
    sprintf( '/?cpage=%d/', $current_page+2 )
);
		$pagination = array_filter(
    $pagination,
    function( $value ) use ( $allowed ,$current_page) {
        foreach( (array) $allowed as $tag )
        {
        	if($current_page<=3 && strip_tags($value)==1){
        		return true;
        	}	
            if( false !== strpos( $value, $tag ) )
                return true;
        }
        return false;
    }
);
    foreach ($pagination as $pag)
{
  echo $pag;
}
	}
}
/**
* Get date in spanish.
*
*/
function spanish_date ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $numeroDia." ".$nombreMes.', '.$anio;
}
/**
* Get date in spanish for the home events module.
*
*/
function spanish_date_events ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return '<span>'.$anio.'</span><label>'.$nombreMes.'</label><h1>'.$numeroDia.'</h1>';
}
/**
* Format chart information.
*
*/
function get_format_chart_array($data){
	$titles=array();
	$values= array();
	if(!empty($data)){
		foreach($data as $row){
			$value=$row['transparency_chart_data_value'];
			$title=$row['transparency_chart_data_title'];			
					$titles[]=$title;
					$values[]= '{y: '.$value.'}';
	}
	if(!empty($values)){
	return array('data' =>implode(', ', $values),'titles' =>$titles);
	}else{
		return null;
	}
}
}
/**
 * Adds areas box to the main column on the Post add/edit screens.
 */
function areas_add_meta_box() {

        add_meta_box(
                'areas_sectionid', 'Áreas', 'areas_meta_box_callback', 'post'
        ); //you can change the 4th paramter i.e. post to custom post type name, if you want it for something else

}

add_action( 'add_meta_boxes', 'areas_add_meta_box' );

/**
 * Prints the areas abox content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function areas_meta_box_callback( $post ) {
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'areas_meta_box', 'areas_meta_box_nonce' );

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $value = get_post_meta( $post->ID, 'post_area', true );

        ?>
        <?php 
        $args = array(
		'post_type' => 'area',
		'post_status' => 'publish',
		 'posts_per_page'         => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC');
		
		$results = new WP_Query( $args );
		if(!empty($results->posts)){
			foreach($results->posts as $area_item){
        ?>
       <label class="post-format-icon" style="padding:5px 0;display:block"><input type="checkbox" name="post_area[]" value="<?php echo $area_item->post_name;?>" <?php echo in_array( $area_item->post_name, $value )?'checked':''; ?> ><?php echo $area_item->post_title;?></label>
        <?php
        }
		}

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function areas_save_meta_box_data( $post_id ) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( !isset( $_POST['areas_meta_box_nonce'] ) ) {
                return;
        }

        // Verify that the nonce is valid.
        if ( !wp_verify_nonce( $_POST['areas_meta_box_nonce'], 'areas_meta_box' ) ) {
                return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
        }

        // Check the user's permissions.
        if ( !current_user_can( 'edit_post', $post_id ) ) {
                return;
        }


        // Sanitize user input.
        $new_meta_value = ( isset( $_POST['post_area'] ) ? sanitize_html_class( $_POST['post_area'] ) : '' );

        // Update the meta field in the database.
        update_post_meta( $post_id, 'post_area', $new_meta_value );

}

add_action( 'save_post', 'areas_save_meta_box_data' );
/**
 * Get search sidebar html
 *
 */
function get_filters_sidebar(){
	$page = get_page_by_path( 'resultados' );
?>
<div class="search_sidebar_content_float">
	<div class="search_sidebar_content_float_content">
		<div class="search_sidebar_wrapper">
			<div class="search_sidebar_header">
				<h2 class="main_content_title">Búsqueda avanzada</h2>
				<a href="<?php echo get_permalink($post -> ID); ?>" class="remove_search_parameters">Borrar busqueda</a>
			</div>
			<div class="filters_container">
					<a href="<?php echo get_permalink($post -> ID); ?>" class="mobile_module remove_search_parameters">Borrar parámetros de busqueda</a>
					<form class="filters_form" method="get" action="<?php echo get_permalink($page->ID)?>">
						<input type="hidden" name="cs" value="<?php echo $_GET['cs']?>" />
												<div class="filter_container post_type_filter <?php echo !empty($_GET['t'])?'open':'';?>">
							<div class="filter_wrapper">
								<div class="filter_header">Formato</div>
								<div class="filter_body" <?php echo !empty($_GET['t'])?'style="display:block"':'';?> >
									<ul>
									<?php 
							      $terms = get_terms(array(
									    'taxonomy' => 'custom_post_type',
									    'hide_empty' => false,
									));
									foreach ($terms as $term) 
									{
							        ?>
							       <li>
							       <label class="input_container" >
							       	<input type="checkbox" name="t[]" <?php echo in_array($term->slug,$_GET['t'])?'checked':'';?> value="<?php echo  $term->slug;?>" >
							       	<?php echo $term->name;?>
							       	</label>
							       </li>
							        <?php
									}
									?>
									</ul>
								</div>
							</div>
						</div>
						<div class="filter_container areas_filter">
							<div class="filter_wrapper">
								<div class="filter_header">Áreas</div>
								<div class="filter_body" <?php echo !empty($_GET['a'])?'style="display:block"':'';?>>
									<ul>
									<?php 
							        $args = array(
									'post_type' => 'area',
									'post_status' => 'publish',
									 'posts_per_page'         => -1,
									'orderby' => 'menu_order',
									'order' => 'ASC');
									$results = new WP_Query( $args );

									if(!empty($results->posts)){
										$unique_areas = array();
										foreach($results->posts as $area_item){
											   if( ! in_array( $area_item->ID, $unique_areas ) ) {
           							 $unique_areas[] = $area_item->ID;
							        ?>
							       <li>
							       <label class="input_container" >
							       	<input type="checkbox" name="a[]" <?php echo in_array($area_item->post_name,$_GET['a'])?'checked':'';?> value="<?php echo $area_item->post_name;?>" >
							       	<?php echo $area_item->post_title;?>
							       	</label>
							       </li>
							        <?php
										}
							        }
									}
									?>
									</ul>
								</div>
							</div>
						</div>
						
							<div class="filter_container order_filter" <?php echo !empty($_GET['order_by'])?'open':'';?>>
							<div class="filter_wrapper">
								<div class="filter_header">Orden</div>
								<div class="filter_body" <?php echo !empty($_GET['order_by'])?'style="display:block"':'';?>>
									<ul>
							       <li>
							       <label class="input_container" >
							       	<input type="radio" name="order_by" <?php echo (empty($_GET['order_by'])||$_GET['order_by']=='date_desc'?'checked':'');?> value="date_desc" >
							       	Más reciente
							       	</label>
							       	</li>
							       <li>
							       <label class="input_container" >
							       	<input type="radio" name="order_by" <?php echo $_GET['order_by']=='date_asc'?'checked':'';?> value="date_asc" >
							       	Menos reciente
							       	</label>
							       	</li>
							       	<li>
							       <label class="input_container" >
							       	<input type="radio" name="order_by" <?php echo $_GET['order_by']=='title_asc'?'checked':'';?> value="title_asc" >
							       	A-Z
							       	</label>
							       	</li>
							       	<li>
							       <label class="input_container" >
							       	<input type="radio" name="order_by" <?php echo $_GET['order_by']=='title_desc'?'checked':'';?> value="title_desc" >
							       	Z-A
							       	</label>
							       	</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="filter_container author_filter <?php echo !empty($_GET['au'])?'open':'';?>">
							<div class="filter_wrapper">
								<div class="filter_header">Autor</div>
								<div class="filter_body" <?php echo !empty($_GET['au'])?'style="display:block"':'';?> >
									<ul>
									<?php 
							        $args = array(
									'role'         => 'author',
									'orderby'      => 'login',
									'order'        => 'ASC',
									  'meta_key' => 'show_on_filters',
   										'meta_value' => true,
								 ); 
									
									$users = get_users($args);
									foreach ($users as $user) 
									{
							        ?>
							       <li>
							       <label class="input_container" >
							       	<input type="checkbox" name="au[]" <?php echo in_array($user->ID,$_GET['au'])?'checked':'';?> value="<?php echo  $user->ID;?>" >
							       	<?php echo $user->display_name;?>
							       	</label>
							       </li>
							        <?php
									}
									?>
									</ul>
								</div>
							</div>
						</div>
												<div class="filter_container year_filter <?php echo !empty($_GET['y'])?'open':'';?>">
							<div class="filter_wrapper">
								<div class="filter_header">Año</div>
								<div class="filter_body" <?php echo !empty($_GET['y'])?'style="display:block"':'';?> >
									<ul>
									<?php 
									$years = get_posts_years_array();
									foreach ($years as $year) 
									{
							        ?>
							       <li>
							       <label class="input_container" >
							       	<input type="checkbox" name="y[]" <?php echo in_array($year,$_GET['y'])?'checked':'';?> value="<?php echo $year;?>" >
							       	<?php echo $year;?>
							       	</label>
							       </li>
							        <?php
									}
									?>
									</ul>
								</div>
							</div>
						</div>
					</form>
				</div>
		</div>	
	</div>
</div>
<?php
}
/**
 * Get list of years when posts have been published
 *
 */
function get_posts_years_array() {
    global $wpdb;
    $result = array();
    $years = $wpdb->get_results(
            "SELECT YEAR(post_date) FROM {$wpdb->posts} WHERE post_status = 'publish' GROUP BY YEAR(post_date) DESC"
        ,ARRAY_N
    );
    if ( is_array( $years ) && count( $years ) > 0 ) {
        foreach ( $years as $year ) {
            $result[] = $year[0];
        }
    }
    return $result;
}
/**
 * Adds areas_team box to the main column on the Post add/edit screens.
 */
function areas_team_add_meta_box() {

        add_meta_box(
                'areas_team_sectionid', 'Áreas', 'areas_team_meta_box_callback', 'equipo'
        ); //you can change the 4th paramter i.e. post to custom post type name, if you want it for something else

}

add_action( 'add_meta_boxes', 'areas_team_add_meta_box' );

/**
 * Prints the areas_team abox content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function areas_team_meta_box_callback( $post ) {
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'areas_team_meta_box', 'areas_team_meta_box_nonce' );

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $value = get_post_meta( $post->ID, 'post_area_team', true );
        ?>
        <?php 
        $args = array(
		'post_type' => 'area',
		'post_status' => 'publish',
		 'posts_per_page'         => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC');
		
		$results = new WP_Query( $args );
		if(!empty($results->posts)){
			foreach($results->posts as $area_item){
        ?>
       <label class="post-format-icon" style="padding:5px 0;display:block"><input type="checkbox" name="post_area_team[]" <?php echo in_array($area_item->post_name,$value)?'checked':'';?> value="<?php echo $area_item->post_name;?>" ><?php echo $area_item->post_title;?></label>
        <?php
        }
		}

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function areas_team_save_meta_box_data( $post_id ) {

        /*
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( !isset( $_POST['areas_team_meta_box_nonce'] ) ) {
                return;
        }

        // Verify that the nonce is valid.
        if ( !wp_verify_nonce( $_POST['areas_team_meta_box_nonce'], 'areas_team_meta_box' ) ) {
                return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
        }

        // Check the user's permissions.
        if ( !current_user_can( 'edit_post', $post_id ) ) {
                return;
        }


        // Sanitize user input.
        $new_meta_value = ( isset( $_POST['post_area_team'] ) ? sanitize_html_class( $_POST['post_area_team'] ) : '' );

        // Update the meta field in the database.
        update_post_meta( $post_id, 'post_area_team', $new_meta_value );

}
add_action( 'save_post', 'areas_team_save_meta_box_data' );
/**
 * Get posts related by author
 */
function custom_get_same_author_posts($author_id,$mypost){
$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' =>3,
		'author' => $author_id,
		'post__not_in' => array($mypost->ID) ,
		'orderby' => 'date',
		'order' => 'DESC');	
		
		$results = new WP_Query( $args );
		if(!empty($results->posts)){
				$page = get_page_by_path( 'resultados' );
			?>
			<div class="author_related_posts">
				
			<h2><a href="<?php echo get_permalink($page->ID);?>?cs=&au[]=<?php echo $author_id;?>">MÁS DEL AUTOR</a></h2>
			<div>
			<?php
			foreach($results->posts as $post_item){
					$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_item->ID), 'full', false, '');
					$text= get_excerpt_or_croped_content($post_item->ID,500);
					$custom_post_type = wp_get_post_terms( $post_item->ID, 'custom_post_type' );
							if(!empty($post_item_image[0])){
								$image = $post_item_image[0];
							}else{
								$image = get_stylesheet_directory_uri().'/images/default_post.png';
								
							}
					?>
					<a href="<?php echo get_permalink($post_item->ID);?>" class="post_item" >
						<div class="post_item_wrapper">
							<div class="post_item_content clear">
								<div class="post_item_image_container" style="background-image:url(<?php echo $image; ?>)"></div>
								<div class="post_text_content_container">
									<div class="vertical_center_table">
										<h2 class="post_text_content_title ellipsis" lines="2" ><?php echo $post_item->post_title;?></h2>
										<div class="post_date_container">
											<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/date_icon.svg"/></span>
											<?php echo spanish_date(get_the_date( 'Y-m-d' ,$post_item->ID))?>
										</div>
									</div>
								</div>
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
}
/**
 * Get posts related by area
 */
function custom_get_same_area_posts(){
	global $post;
	$area_current = get_post_meta($post->ID,'post_area',true);
$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' =>3,
		'post__not_in' => array($post->ID) ,
		'orderby' => 'date',
		'order' => 'DESC');	
		
					if(!empty($area_current)){
			$meta_query = array('relation' => 'OR');
			foreach ($area_current as $value) {
			    $meta_query[] = array(
			        'key'       => 'post_area',
			        'value'     => $value,
			        'compare'   => 'LIKE',
			    );
			}
			$args['meta_query']=array($meta_query);
		}
		$results = new WP_Query( $args );
		if(!empty($results->posts)){
			?>
			<div class="author_related_posts">
			<h2>RELACIONADOS</h2>
			<div>
			<?php
			foreach($results->posts as $post_item){
					$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_item->ID), 'full', false, '');
					$text= get_excerpt_or_croped_content($post_item->ID,500);
					$custom_post_type = wp_get_post_terms( $post_item->ID, 'custom_post_type' );
					if(!empty($post_item_image[0])){
								$image = $post_item_image[0];
							}else{
								$image = get_stylesheet_directory_uri().'/images/default_post.png';
								
							}
					?>
					<a href="<?php echo get_permalink($post_item->ID);?>" class="post_item" >
						<div class="post_item_wrapper">
							<div class="post_item_content clear">
								<div class="post_item_image_container" style="background-image:url(<?php echo $image; ?>)"></div>
								<div class="post_text_content_container">
									<div class="vertical_center_table">
										<h2 class="post_text_content_title ellipsis" lines="2" ><?php echo $post_item->post_title;?></h2>
										<div class="post_date_container">
											<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/date_icon.svg"/></span>
											<?php echo spanish_date(get_the_date( 'Y-m-d' ,$post_item->ID))?>
										</div>
									</div>
								</div>
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
}
/**
 * Get posts sidebar
 */
function custom_get_sidebar(){
	// check if the flexible content field has rows of data
								if( get_field('post_sidebar_items') ):
								?>
								<div class="sidebar_right_container">
								<?php
								 	// loop through the rows of data
								    while ( has_sub_field('post_sidebar_items') ) :
								
										 if( get_row_layout() == 'post_sidebar_item_twitter_quotes' ):
											$quote = get_sub_field('post_sidebar_item_twitter_quote');
								        	
											echo do_shortcode('[twitter quote="'.$quote.'"]');
								
								        elseif( get_row_layout() == 'post_sidebar_item_images' ): 
								
								        	$image = get_sub_field('post_sidebar_item_image');
								        	$url = get_sub_field('post_sidebar_item_image_link');
											?>
											<div class="sidebar_image">
												<?php 
												if(!empty($url)){
													?>
													<a href="<?php echo $url;?>">
													<?php
												}
												?>
												<img src="<?php echo $image['url']?>" />
												<?php 
												if(!empty($url)){
													?>
													</a>
													<?php
												}
												?>
											</div>
											<?php
											elseif( get_row_layout() == 'post_sidebar_item_titles' ):
												$title = get_sub_field('post_sidebar_item_title');
												$url = get_sub_field('post_sidebar_item_title_url');
												if(!empty($url)){
													?>
													<a href="<?php echo $url;?>">
													<?php
												}
													?>
													<h1><?php echo $title;?></h1>
													<?php 
												if(!empty($url)){
													?>
													</a>
													<?php
												}
												
								        endif;
								
								    endwhile;
								?>
								</div>
								<?php
								else :
								
								    // no layouts found
								
								endif;
}
/**
 * Get downloads module
 */
function custom_get_post_downloads(){
	$custom_downloads = get_field('custom_downloads',$press_item->ID);
	if($custom_downloads)
	{
		echo '<div class="post_downloads"><div class="custom_item_downloads clear"><label>DESCARGAS: </label>';
		foreach($custom_downloads as $custom_download)
		{
			$icon ='';
			if(!empty($custom_download['custom_download_icon'])){
				$icon ='<div class="download_icon" style="background-image:url('.$custom_download['custom_download_icon']['url'].')"></div>'; 
			}
			echo '<div class="custom_download_btn_container"><a href="'.$custom_download['custom_download_file']['url'].'" class="custom_download_btn" download target="_blank">'.$icon.'<span>'.$custom_download['custom_download_title'].'</span></a></div>';
		}
		echo '</div></div>';
	}
}
/**
 * Get share module
 */
function custom_get_post_share_module(){
	global $post;
	{
		?>
		<div class="post_share_module">
			<div class="custom_item_share_module clear">
				<label>COMPARTIR: </label>
				<div class="custom_share_module_btn_container">
					<?php 
					 $share_title = get_post_meta($post->ID,'social_title',true);
					 if(!!empty($share_title)){
						$share_title =  get_bloginfo( 'name' ).' — '.($post->post_title);
					 }else{
					 	$share_title =  get_bloginfo( 'name' ).' — '.$share_title;
					 }
					?>
					<input type="hidden" id="social_title" value="<?php echo $share_title;?>" />
					<?php 
					 $share_desc = get_post_meta($post->ID,'social_description',true);
					if(!$share_desc){
					if(trim(strip_tags(get_excerpt_or_croped_content($post->ID)))){
					$share_desc = trim(strip_tags(get_excerpt_or_croped_content($post->ID)));
					}else{
					$share_desc = get_option('default_desc', '');
					}
				
					} ?>
					<input type="hidden" id="social_description" value="<?php echo $share_desc;?>" />
					<input type="hidden" id="social_url" value="<?php echo get_permalink( $post->ID ); ?>" />
					 <?php 
				    $social_image = get_post_meta($post->ID,'social_image',true);
					if($social_image){
						$img_src = wp_get_attachment_image_src($social_image, 'medium', false, '');
					}else{
					$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID ), 'medium', false, '');	
					}
				  	
				  	if($img_src[0]){
				  	$share_image =$img_src[0];
					}
				  	?>
					<input type="hidden" id="social_image" value="<?php echo $share_image;?>" />
					<div  class="custom_share_module_btn whatsapp_share_btn">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/share_icons/whatsapp.svg" />
					</div>
					<div  class="custom_share_module_btn facebook_share_btn">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/share_icons/facebook.svg" />
					</div>
					<div  class="custom_share_module_btn twitter_share_btn">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/share_icons/twitter.svg" />
					</div>
<a class="custom_share_module_btn email_share_btn" href="mailto:?subject=<?php echo $share_title;?>&body=<?php echo $share_desc;?> <?php echo get_permalink( $post->ID ); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/share_icons/email.svg" />
			</a>			</div>
		</div>
	</div>
	<?php
	}
}
// Function to add subscribe text to posts and pages
  function twitter_shortcode($atts) {
  		$html = '';
  	$atts=shortcode_atts(
        array(
            'quote' => '',
        ), $atts, 'twitter');
	$twitter_button= '<div class="twitter_btn"><span><img src="'.get_stylesheet_directory_uri().'/images/twitter_label.svg" /></span><label>Comparte este tweet</label></div>';
	$html.='<div class="twitter_module_container" quote="'.$atts['quote'].'"><div class="twitter_module_wrapper"><label>"'.$atts['quote'].'"</label></div>'.$twitter_button.'</div>';	
		
    return $html;
}
add_shortcode('twitter', 'twitter_shortcode');
// Hide authors shortcode from other webiste
  function author_shortcode($atts) {
  		$html = '';
  	
    return $html;
}
add_shortcode('avatar', 'author_shortcode');
/**
 * Get featured post list
 */
function custom_get_featured_posts(){
	global $post;
		$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page'         => 3,
		'orderby' => 'date',
		'post__not_in' => array($post->ID) ,
		'meta_key' => 'featured_post',
		'meta_value' => true,
		'orderby' => 'rand');
			$results = new WP_Query( $args );
		if(!empty($results->posts)){
			?>
			<div class="featured_posts_container">
			<div class="featured_posts_wrapper">
				<h2>DESTACADOS</h2>
				<div class="featured_post_items clear">
			<?php
			foreach($results->posts as $post_item){
					$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_item->ID), 'full', false, '');
					$custom_post_type = wp_get_post_terms( $post_item->ID, 'custom_post_type' );
					?>
					<a  href="<?php echo get_permalink($post_item->ID);?>" class="featured_post_item">
						<div class="featured_post_item_container" style="background-image:url(<?php echo $post_item_image[0]; ?>);" >
							<?php 
							if(!empty($custom_post_type)){
								?>
								<div class="featured_post_item__type_label">
									<?php echo $custom_post_type[0]->name;?>
								</div>
								<?php
							}
							?>	
							<div class="featured_post_title">
								<label class="ellipsis" lines="2">
									<?php echo $post_item->post_title;?>
								</label>
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
}

/**
 * Add email to sendgrid list ajax function
 */
add_action( 'wp_ajax_nopriv_add_to_newsletter', 'add_to_newsletter' );
add_action( 'wp_ajax_add_to_newsletter', 'add_to_newsletter' );
function add_to_newsletter(){
$email= $_POST['newsletter_email'];
$res = suscribe_sendgrid($email);
echo '0';
exit;
}
/**
 * Suscribe to sendgrid function
 */
function suscribe_sendgrid($email){
if($email){
$recipient = get_sendgrid_recipient($email);
add_recipient_to_list($recipient);
}
}
/**
 * Get sendgrid module
 */
function get_mailchimp_module(){
	$frontpage_id = get_option( 'page_on_front' );	
if($frontpage_id){
$title =get_post_meta($frontpage_id,'home_membership_title',true);
$desc =get_post_meta($frontpage_id,'home_membership_description',true);
}
?>
	<form  class="newsletter_form"  method="post" action="<?php echo admin_url('admin-ajax.php'); ?>" >
		<div class="newsletter_container_content">
						<div class="newsletter_content_wrapper clear">
							<div class="newsletter_content_left_column">
								<h2><?php echo $title;?></h2>
								<p><?php echo $desc;?></p>
							</div>
								<div class="newsletter_content_right_column">
								<div class="newsletter_content_right_column_wrapper clear">
									<input type='text' class="newsletter_email" name="newsletter_email" placeholder="CORREO ELECTRÓNICO"/>
									<input type="submit"  class="newsletter_submit" value="ENVIAR" />
								</div>
								<div class="newsletter_thanks_wrapper">
				<div class="newsletter_thanks_container">
					<h1>GRACIAS POR SUSCRIBIRTE</h1>
					<label>¡Recibirás noticias nuestras pronto!</label>
				</div>
			</div>	
								</div>
								<input type="hidden" name="action" value="add_to_newsletter" />
								
							</div>
		</div>
	</form>
<?php
}
/**
 * Get Author Module
 */
function custom_get_author_module(){
global $post;
$related_team_post = false;
$author_id = $post->post_author;
$args = array(
'post_type' => 'equipo',
'post_status' => 'publish',
'posts_per_page'         => 1,
'orderby' => 'date',
'meta_key' => 'related_user',
'meta_value' => $author_id,
'order' => 'DESC');
$results = new WP_Query( $args );
if(!empty($results->posts)){
	$related_team_post = $results->posts[0];
}
if ( function_exists ( 'mt_profile_img' ) ) {

    $author_image = custom_mt_profile_url( $author_id, 
        array(
            'size' => 'medium',
            'echo' => false,
        )
    );
}
$author_name = km_get_users_name($author_id);
$job_description= get_user_meta($author_id,'job_description',true);
$team_item_twitter_username= get_user_meta($author_id,'team_item_twitter_username',true);
$team_item_twitter_url= get_user_meta($author_id,'team_item_twitter_url',true);
if($related_team_post){
	$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($related_team_post->ID ), 'medium', false, '');	
	$author_image = $img_src[0];
	$author_name = $related_team_post->post_title;
	$job_description_to_check = get_post_meta($related_team_post->ID,'job_description',true);
	if(!empty($job_description_to_check)){
		$job_description=$job_description_to_check;	
	}
	$team_item_twitter_username_to_check = get_post_meta($related_team_post->ID,'team_item_twitter_username',true);
	if(!empty($team_item_twitter_username_to_check)){
		$team_item_twitter_username=$$team_item_twitter_username_to_check;	
	}
	$team_item_twitter_url_to_check = get_post_meta($related_team_post->ID,'team_item_twitter_url',true);
	if(!empty($team_item_twitter_url_to_check)){
		$team_item_twitter_url=$team_item_twitter_url_to_check;	
	}	
	
}
if(empty($author_image)){
$author_image =get_stylesheet_directory_uri().'/images/shapeofyou.jpg';
}
?>
<div class="post_author_container">
	<div class="post_author_wrapper">
		<div class="post_author_container_content clear">
			<a href="<?php echo get_permalink($related_team_post->ID);?>" class="post_author_image" style="background-image:url(<?php echo $author_image;?>);"></a>
			<div class="post_author_info">
				<div class="post_author_header">
					<label><a href="<?php echo get_permalink($related_team_post->ID);?>"><?php echo $author_name;?></a></label><?php 
					if(!empty($team_item_twitter_username) && !empty($team_item_twitter_url)){
						?><a href="<?php echo $team_item_twitter_url;?>"><?php echo $team_item_twitter_username;?></a><?php
					}
					?></div>
				<?php if(!empty($job_description)){
					 ?><div class="post_author_job_position"><?php echo $job_description;?></div><?php
				 } ?></div>
		</div>
		<div class="post_date_container">
			<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/date_icon.svg"/></span>
			<?php echo spanish_date(get_the_date( 'Y-m-d' ,$post->ID))?>
		</div>
	</div>
</div>
										
<?php
}
/**
 * Get custom author image
 */
function custom_mt_profile_url( $user_id, $args = array() ) {
	$profile_post_id = absint( get_user_option( 'metronet_post_id', $user_id ) );

	if ( 0 === $profile_post_id || 'mt_pp' !== get_post_type( $profile_post_id ) ) {
		return false;
	}

	$defaults = array(
		'size' => 'thumbnail',
		'attr' => '',
		'echo' => true,
	);
	$args     = wp_parse_args( $args, $defaults );
	extract( $args ); //todo - get rid of evil extract

	$post_thumbnail_id = get_post_thumbnail_id( $profile_post_id );

	//Return false or echo nothing if there is no post thumbnail
	if ( ! $post_thumbnail_id ) {
		if ( $echo ) {
			echo '';
		} else {
			return false;
		}
		return;
	}

	//Implode Classes if set and array - dev note: edge case
	if ( is_array( $attr ) && isset( $attr['class'] ) ) {
		if ( is_array( $attr['class'] ) ) {
			$attr['class'] = implode( ' ', $attr['class'] );
		}
	}

	$post_thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, $size, false, $attr );

	if ( $echo ) {
		echo wp_kses_post( $post_thumbnail );
	} else {
		return $post_thumbnail[0];
	}
} //end mt_profile_img


/**
 * Get user's first and last name, else just their first name, else their
 * display name. Defalts to the current user if $user_id is not provided.
 *
 * @param  mixed  $user_id The user ID or object. Default is current user.
 * @return string          The user's name.
 */
 
 /**
 * Get user name by ID
 */
function km_get_users_name( $user_id = null ) {
	$user_info = $user_id ? new WP_User( $user_id ) : wp_get_current_user();
	if ( $user_info->first_name ) {
		if ( $user_info->last_name ) {
			return $user_info->first_name . ' ' . $user_info->last_name;
		}
		return $user_info->first_name;
	}
	return $user_info->display_name;
}

/**
 * Get posts top scroll bar
 */
function get_top_scroll_bar(){
	?>
	<div class="top_scroll_bar">
		<div class="top_scroll_bar_progress">
		</div>
	</div>
	<?php
}
/**
 * Get post custom footer content
 */
function custom_get_footer_content(){
	// check if the flexible content field has rows of data
								if( get_field('footer_content_layout') ):
								?>
								<div class="post_footer_content">
									<div class="post_footer_content_wrapper">
								<?php
								 	// loop through the rows of data
								    while ( has_sub_field('footer_content_layout') ) :
								
										 if( get_row_layout() == 'footer_content_layout_slider' ):
											$title = get_sub_field('footer_content_layout_slider_title');
											$gallery = get_sub_field('footer_content_layout_slider_gallery');
											?>
													<div class="post_footer_content_gallery_container">
													<h1><?php echo $title;?></h1>
													<div class="post_footer_content_gallery">
														<div class="swiper-container">
															<div class="swiper-wrapper">
																<?php foreach($gallery as $image){
																	?>
																	<div class="slide swiper-slide" style="background-image:url(<?php echo $image['url'];?>);"></div>
																	<?php
																}?>
															</div>
														</div>
														<div class="swiper-pagination"></div>
													</div>
												</div>
											<?php
								
								        elseif( get_row_layout() == 'post_sidebar_item_images' ): 
												
								        endif;
								
								    endwhile;
								?>
									</div>
								</div>
								<?php
								else :
								
								    // no layouts found
								
								endif;
}

/**
 *Get footer banners
 */
function get_custom_footer_banner(){
	global $post;
	$related_banner =  get_post_meta($post->ID, 'related_banner',true);
	if(!empty($related_banner)){
	switch ($related_banner) {
		case 'newsletter':
			get_mailchimp_module();
			break;
		case 'default':
	global $post;
		$args = array(
		'post_type' => 'banner',
		'post_status' => 'publish',
		'posts_per_page'         => 1,
		'meta_key' => 'default-banner',
		'meta_value' => 'yes');
			$results = new WP_Query( $args );
		if(!empty($results->posts)){
			foreach($results->posts as $banner){
				get_banner_html($banner);
		}
	}
			break;
		default:
			$banner_post = get_post($related_banner);
			if($banner_post){
 				get_banner_html($banner_post);
			}
			break;
	}
	}
}
/**
 * Get footer Banners HTML
 */
function get_banner_html($banner_post){
		$banner_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($banner_post->ID), 'full', false, '');
					$banner_url = get_post_meta( $banner_post->ID, 'custom_url', true );
					if(!empty($banner_image_src)){
						?>
						<div class="banner_container">
							<a target="_blank" href="<?php echo $banner_url;?>" class="banner_item">
								<img src="<?php echo $banner_image_src[0];?>" />
							</a>
						</div>
						<?php
					}
}
/**
 * Adds a meta box to the post editing screen
 */
function default_default_meta() {
    add_meta_box( 'default_meta', __( 'Predeterminado', 'default-textdomain' ), 'default_meta_callback', 'banner', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'default_default_meta' );
 
/**
 * Outputs the content of the meta box
 */
 
function default_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'default_nonce' );
    $default_stored_meta = get_post_meta( $post->ID );
    ?>
 
 <p>
    <div class="default-row-content">
        <label for="default-banner">
            <input type="checkbox" name="default-banner" id="default-banner" value="yes" <?php if ( isset ( $default_stored_meta['default-banner'] ) ) checked( $default_stored_meta['default-banner'][0], 'yes' ); ?> />
            <?php _e( 'Banner predeterminado', 'default-textdomain' )?>
        </label>
 
    </div>
</p>   
 
    <?php
}
 
/**
 * Saves the custom meta input
 */
function default_meta_save( $post_id ) {
 
    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'default_nonce' ] ) && wp_verify_nonce( $_POST[ 'default_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 

 
// Checks for input and saves - save checked as yes and unchecked at no
if( isset( $_POST[ 'default-banner' ] ) ) {
	 		// Array of Banners objects.
		 $args = array(
		    'post_type'      => 'banner',
		    'posts_per_page' => -1,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );
		$banners_query = new WP_Query( $args );
		$banners_posts = $banners_query->posts;
		if(!empty($banners_posts)){
		foreach ( $banners_posts as $banner ) {
			   update_post_meta( $banner->ID, 'default-banner', 'no');
		}
		}
    update_post_meta( $post_id, 'default-banner', 'yes' );
} else {
    update_post_meta( $post_id, 'default-banner', 'no');
}
 
}
add_action( 'save_post', 'default_meta_save' );

/**
 * Get home areas module
 */
function get_home_layout(){
	// check if the flexible content field has rows of data
	if( get_field('home_layout') ){
	 	// loop through the rows of data
	    while ( has_sub_field('home_layout') ) {
	
			 if( get_row_layout() == 'home_layout_areas' ){
				// Get home Areas slider	
				$home_layout_areas_items = get_sub_field('home_layout_areas_items');
				get_home_areas_slider($home_layout_areas_items);
	        }else if( get_row_layout() == 'home_layout_fullscreen_images' ){
	        	// Get home full image
	        	$image = get_sub_field('home_layout_fullscreen_image');
	        	$url = get_sub_field('home_layout_fullscreen_image_url');
				get_home_full_image($image,$url);
			}else if( get_row_layout() == 'home_layout_featured_posts'){
				$main_items = get_sub_field('home_layout_featured_main_posts_items');
				$secondary_items = get_sub_field('home_layout_featured_main_posts_secondary_items');
				$active= get_sub_field('home_layout_featured_main_posts_active');
				get_home_featured_posts($main_items,$secondary_items,$active);
			}else if( get_row_layout() == 'home_layout_featured_posts_fullscreen_slider'){
				$main_items = get_sub_field('home_layout_featured_posts_fullscreen_slider_items');
				$secondary_items = get_sub_field('home_layout_featured_posts_fullscreen_slider_secondary_items');
				$active= get_sub_field('home_layout_featured_posts_fullscreen_slider_active');
				get_home_featured_posts_fullscreen_slider($main_items,$secondary_items,$active);
			/* ACF Joel 2022*/
			}else if( get_row_layout() == 'home_layout_featured_posts_main'){
				$main_items = get_sub_field('home_layout_featured_posts_main_slider_items');
				$secondary_items = get_sub_field('home_layout_featured_posts_main_slider_secondary_items');
				$active= get_sub_field('home_layout_featured_posts_main_slider_active');
				get_home_featured_posts_main_slider($main_items,$secondary_items,$active);
			/* fin ACF Joel 2022 */
			}else if( get_row_layout() == 'home_layout_index_masonry'){
				$masonry_items = get_sub_field('home_layout_index_masonry_images');
				$out_pages_items = get_sub_field('home_layout_index_out_pages');
				get_home_index_module($masonry_items,$out_pages_items);
			}else if( get_row_layout() == 'home_layout_recommended'){
				$r_post = get_sub_field('home_layout_recommended_post');
				$banner_image = get_sub_field('home_layout_recommended_banner_image');
				$banner_image_url = get_sub_field('home_layout_recommended_banner_url');
				get_home_recommended_module($r_post,$banner_image,$banner_image_url);
			}
			else if( get_row_layout() == 'home_layout_last_events'){
				$items = get_sub_field('home_layout_last_events_items');
				get_home_next_events_module($items);
			}else if( get_row_layout() == 'home_layout_elections'){
				$title = get_sub_field('home_layout_elections_title');
				$image = get_sub_field('home_layout_elections_image');
				$posts = get_sub_field('home_layout_elections_posts');
				get_home_elections_module($title,$image,$posts);
			}
			
				
		}
	}
}
// Get home Areas slider	
function get_home_areas_slider($home_layout_areas_items){
		        	if(!empty($home_layout_areas_items)){
	        		?><div class="home_areas_slider">
	        			<div class="home_areas_slider_wrapper">
	        				<h1 class="home_modules_title">Áreas</h1>
	        				<div class="home_areas_slider_container">
	        					<div class="swiper-container">
									<div class="swiper-wrapper">
										<?php foreach($home_layout_areas_items as $home_layout_areas_item){
											$icon = $home_layout_areas_item['home_layout_area_icon'];
											$title = $home_layout_areas_item['home_layout_area_title'];
											$url = $home_layout_areas_item['home_layout_area_url'];
											$color = $home_layout_areas_item['home_layout_area_color'];
											
											?>
											<a href="<?php echo $url;?>" class="slide swiper-slide" style="background:<?php echo $color;?>;">
												<div class="area_slide_container">
													<div class="area_slide_icon_container">
														<div class="area_slide_icon" style="background-image:url(<?php echo $icon['url']; ?>);"></div>
													</div>
													<h2><?php echo $title; ?></h2>
												</div>
											</a>
											<?php
										}?>
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
	        		</div><?php
	        	}	
}
function get_home_full_image($image,$url){
	?><a <?php echo !empty($url)?'href="'.$url.'"':'';?> class="home_full_image_container">
				<img src="<?php echo $image['url']; ?>" />
			</a>
			<?php 
}
// Get home featured posts.
function get_home_featured_posts($main_items,$secondary_items,$active){
	if($active){	
	if(!empty($main_items) || !empty($secondary_items)){
		?>
		<div class="home_featured_posts_container normal_main_post_items">
			<div class="home_featured_posts_wrapper clear">
				<?php 
				if(!empty($main_items)){
				?>
				<div class="home_featured_slider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
						<?php
						foreach($main_items as $main_item){
							$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($main_item->ID), 'full', false, '');
							$text= get_excerpt_or_croped_content($main_item->ID,500);
							$custom_post_type = wp_get_post_terms( $main_item->ID, 'custom_post_type' );
							?>
								<a href="<?php echo get_permalink($main_item->ID);?>" class="slide swiper-slide" style="background-image:url(<?php echo $post_item_image[0];?>);">
									<div class="home_featured_container">
										<?php 
										if(!empty($custom_post_type)){
											?>
											<div class="post_type_label">
												<?php echo $custom_post_type[0]->name;?>
											</div>
											<?php
										}
										?>	
										<div class="home_featured_container_text">
											<h2 class="ellipsis" lines="2" ><?php echo $main_item->post_title; ?></h2>
											<div class="post_text_content_text ellipsis" lines="2"><?php echo $text;?></div>
										</div>
									<div class="post_featured_shadow" ></div>
									</div>
									
								</a><?php
						}
						?>
						</div>
						</div>
						<div class="swiper-pagination"></div>
						</div>
						
						<?php
				}
				?>
					<?php 
				if(!empty($secondary_items)){
				?>
				<div class="home_secondary_featured_items">
					<div class="home_secondary_featured_items_container">
					<?php foreach($secondary_items as $secondary_item){
							$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($secondary_item->ID), 'full', false, '');
							$text= get_excerpt_or_croped_content($secondary_item->ID,500);
							$custom_post_type = wp_get_post_terms( $secondary_item->ID, 'custom_post_type' );
							?>
								<a href="<?php echo get_permalink($secondary_item->ID);?>" class="home_secondary_featured_item" style="background-image:url(<?php echo $post_item_image[0];?>);">
									<div class="home_featured_container">
										<?php 
										if(!empty($custom_post_type)){
											?>
											<div class="post_type_label">
												<?php echo $custom_post_type[0]->name;?>
											</div>
											<?php
										}
										?>	
										<div class="home_featured_container_text">
											<h2 class="ellipsis" lines="2" ><?php echo $secondary_item->post_title; ?></h2>
										</div>
									<div class="post_featured_shadow" ></div>
									</div>
									
								</a><?php
					}?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php
		
	}
	}
	
}
// Get home featured posts with fullscreen slider.
function get_home_featured_posts_fullscreen_slider($main_items,$secondary_items,$active){
	if($active){
	if(!empty($main_items) || !empty($secondary_items)){
		?>
		<div class="home_featured_posts_container fullscreen_slider">
			<div class="home_featured_posts_wrapper clear">
				<?php 
				if(!empty($main_items)){
				?>
				<div class="home_featured_slider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
						<?php
						foreach($main_items as $main_item){
							$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($main_item->ID), 'full', false, '');
							$text= get_excerpt_or_croped_content($main_item->ID,500);
							$custom_post_type = wp_get_post_terms( $main_item->ID, 'custom_post_type' );
							?>
								<a href="<?php echo get_permalink($main_item->ID);?>" class="slide swiper-slide" style="background-image:url(<?php echo $post_item_image[0];?>);">
									<div class="home_featured_container">
										<div class="home_featured_container_bottom">
										<?php 
										if(!empty($custom_post_type)){
											?>
											<div class="post_type_label">
												<?php echo $custom_post_type[0]->name;?>
											</div>
											<?php
										}
										?>	
										<div class="home_featured_container_text">
											<h2 class="ellipsis" lines="2" ><?php echo $main_item->post_title; ?></h2>
											<div class="post_text_content_text ellipsis" lines="2"><?php echo $text;?></div>
										</div>
										</div>
									<div class="post_featured_shadow" ></div>
									</div>
									
								</a><?php
						}
						?>
						</div>
						</div>
						<div class="swiper-pagination"></div>
						</div>
						
						<?php
				}
				?>
					<?php 
				if(!empty($secondary_items)){
				?>
					        				<div class="home_fullscreen_slider_bottom_posts">
	        					<div class="swiper-container">
									<div class="swiper-wrapper">
										<?php foreach($secondary_items as $secondary_item){
							$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($secondary_item->ID), 'full', false, '');
							$text= get_excerpt_or_croped_content($secondary_item->ID,500);
							$custom_post_type = wp_get_post_terms( $secondary_item->ID, 'custom_post_type' );
											?>
											<a href="<?php echo get_permalink($secondary_item->ID);?>" class="slide swiper-slide" >
												<div class="home_fullscreen_slider_bottom_post_image" style="background-image:url(<?php echo $post_item_image[0];?>);">
													<?php 
										if(!empty($custom_post_type)){
											?>
											<div class="post_type_label">
												<?php echo $custom_post_type[0]->name;?>
											</div>
											<?php
										}
										?>	
												</div>
												<div class="home_featured_container_text">
											<h2 class="ellipsis" lines="2" ><?php echo $secondary_item->post_title; ?></h2>
										</div>
											</a>
											<?php
										}?>
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

				<?php } ?>
			</div>
		</div>
		<?php
		
	}
	}
}
// ACF Joel 2022 Get home featured posts with main slider.
function get_home_featured_posts_main_slider($main_items,$secondary_items,$active){
	if($active){
	if(!empty($main_items) || !empty($secondary_items)){
	?>
	
		<div class="home_featured_posts_container fullscreen_slider ">
			<div class="home_featured_posts_wrapper clear">
				<?php 
					if(!empty($main_items)){
					?>
					<br>
				<div class="home_featured_slider main_slider_superior" style="height: 55vh; ">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php
							foreach($main_items as $main_item){
								$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($main_item->ID), 'full', false, '');
								$text= get_excerpt_or_croped_content($main_item->ID,500);
								$custom_post_type = wp_get_post_terms( $main_item->ID, 'custom_post_type' );
								?>
							<a href="<?php echo get_permalink($main_item->ID);?>" class="slide swiper-slide"
								style="background-image:url(<?php echo $post_item_image[0];?>);">
								<div class="home_featured_container">
									<div class="home_featured_container_bottom">
										<?php 
											if(!empty($custom_post_type)){
												?>
										<div class="post_type_label">
											<?php echo $custom_post_type[0]->name;?>
										</div>
										<?php
											}
											?>
										<div class="home_featured_container_text">
											<h2 class="ellipsis" lines="2" style="font-size: 25px;">
												<?php echo $main_item->post_title; ?>
											</h2>
											<div class="post_text_content_text ellipsis" lines="2" style="font-size: 19px;">
												<?php echo $text;?>
											</div>
										</div>
									</div>
									<div class="post_featured_shadow"></div>
								</div>
	
							</a>
							<?php
							}
							?>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
	
				<?php
					}
					?>
				<?php 
					if(!empty($secondary_items)){
					?>
				<div class="home_fullscreen_slider_bottom_posts">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach($secondary_items as $secondary_item){
								$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($secondary_item->ID), 'full', false, '');
								$text= get_excerpt_or_croped_content($secondary_item->ID,500);
								$custom_post_type = wp_get_post_terms( $secondary_item->ID, 'custom_post_type' );
												?>
							<a href="<?php echo get_permalink($secondary_item->ID);?>" class="slide swiper-slide">
								<div class="home_fullscreen_slider_bottom_post_image"
									style="background-image:url(<?php echo $post_item_image[0];?>);">
									<?php 
											if(!empty($custom_post_type)){
												?>
									<div class="post_type_label">
										<?php echo $custom_post_type[0]->name;?>
									</div>
									<?php
											}
											?>
								</div>
								<div class="home_featured_container_text">
									<h2 class="ellipsis" lines="2">
										<?php echo $secondary_item->post_title; ?>
									</h2>
								</div>
							</a>
							<?php
											}?>
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
	
				<?php } ?>
			</div>
		</div>
	
	<?php	
		}
		}
	}
	// fin ACF Joel 2022 Get home featured posts with main slider.
// Get Home Index module
function get_home_index_module($masonry_items,$our_websites_items){
		if(!empty($masonry_items)){
			?>
			<div class="index_our_pages_container clear">
			<div class="index_container">
			<h1 class="home_modules_title">ÍNDICES</h1>
			<div class="projects_container_list">
				<?php
				$index = 0;
				foreach($masonry_items as $masonry_item){
					$image = $masonry_item['home_layout_index_masonry_image'];
					$url = $masonry_item['home_layout_index_masonry_image_url'];
					?>
					<a <?php echo !empty($url)?'href="'.$url.'"':'';?> class="item_pk item_type_<?php echo $index;?>">
						<div class="item_pk_image" style="background-image:url(<?php echo $image['url']; ?>);"></div>
					</a>
					<?php
				$index++;	
				}
				?>
			</div>
			</div>
			<div class="our_pages_container">
			<h1 class="home_modules_title">NUESTRAS PÁGINAS</h1>
			<div class="our_pages_container_list">
				<?php
				$index = 0;
				foreach($our_websites_items as $our_websites_item){
					$image = $our_websites_item['home_layout_index_masonry_image'];
					$url = $our_websites_item['home_layout_index_masonry_image_url'];
					?>
					<a <?php echo !empty($url)?'href="'.$url.'"':'';?> class="item_pk item_type_<?php echo $index;?>">
						<div class="item_pk_image" style="background-image:url(<?php echo $image['url']; ?>);"></div>
					</a>
					<?php
				$index++;	
				}
				?>
			</div>
			</div>
			</div>
			<?php
		}
}
// Get Home Recomendend module
function get_home_recommended_module($r_post,$banner_image,$banner_image_url){
	if($r_post){
		$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($r_post[0]->ID), 'full', false, '');
		$text= get_excerpt_or_croped_content($r_post[0]->ID,500);
		$custom_post_type = wp_get_post_terms( $r_post[0]->ID, 'custom_post_type' );
		?>
		<div class="home_recommended_module_container clear">
			<div class="home_recommended_module_container">
			<h1 class="home_modules_title">TE RECOMENDAMOS</h1>
			<div class="home_recommended_module_content">
				<a class="home_recommended_module_content_post" href="<?php echo get_permalink($r_post[0]->ID); ?>">
					<div class="home_recommended_post_info">
						<?php 
						if(!empty($custom_post_type)){
							?>
							<div class="post_type_label">
								<?php echo $custom_post_type[0]->name;?>
							</div>
							<?php
						}
						?>	
						<div class="home_recommended_post_text">
								<h2 class="post_text_content_title ellipsis" lines="3" ><?php echo $r_post[0]->post_title;?></h2>
										<div class="post_text_content_text ellipsis" lines="3"><?php echo  $text;?></div>
						</div>	
					</div>
					<div class="home_recommended_post_image" style="background-image:url(<?php echo $post_item_image[0]?>)"></div>
				</a>
				<div class="home_recommended_banner_container">
				<a <?php echo !empty($banner_image_url)?'href="'.$banner_image_url.'"':'';?> class="home_recommended_banner">
					<div class="banner_image" style="background-image:url(<?php echo $banner_image['url']?>)">
					</div>
				</a>
			
			</div>
			</div>
			
			</div>
		</div>
		<?php
	}
}
// Get home next events
function get_home_next_events_module($items){
	if(!empty($items)){
		?>
		<div class="home_events_container">
			<div class="home_events_wrapper">
				<h1 class="home_modules_title">PRÓXIMOS EVENTOS</h1>
				<div class="home_events_list clear">
					
		<?php
		foreach($items as $item){
			$event_title = $item['home_layout_last_events_item_title'];
			$event_subtitle = $item['home_layout_last_events_item_subtitle'];
			$event_details = $item['home_layout_last_events_item_details'];
			$event_address = $item['home_layout_last_events_item_address'];
			$event_date = $item['home_layout_last_events_item_date'];
			$event_link = $item['home_layout_last_events_item_link'];
			?>
			<div class="home_event_item">
				<div class="home_event_item_wrapper clear">
					<div class="home_event_left_container">
						<div class="event_date_container">
							<?php echo spanish_date_events($event_date);?>
						</div>
						<?php if(!empty($event_link)){
							?>
							<a href="<?php echo $event_link;?>" class="btn event_btn">Agendar</a>
							<?php
						}?>
					</div>
					<div class="home_event_right_container">
						<h4>PRÓXIMO EVENTO</h4>
						<div class="home_events_item_title"><?php echo $event_title;?></div>
						<div class="home_events_item_subtitle"><?php echo $event_subtitle;?></div>
						<div class="home_events_item_details"><?php echo $event_details;?></div>
						<div class="home_events_item_address"><?php echo $event_address;?></div>
						<?php if(!empty($event_link)){
							?>
							<a href="<?php echo $event_link;?>" class="btn event_btn mobile_btn">Agendar</a>
							<?php
						}?>
					</div>
				</div>
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
// Get home elections module
function get_home_elections_module($title,$image,$posts){
	if(!empty($posts)){
		?>
		<div class="home_elections_container">
			<div class="home_elections_wrapper">
				<h1 class="home_modules_title"><?php echo $title;?></h1>
					<div class="home_elections_posts_list clear" style="background-image:url(<?php echo $image['url'];?>);">
			<div class="home_elections_posts home_slider_mobile"><div class="swiper-container">
						<div class="swiper-wrapper"><?php foreach($posts as $election_post){
							$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($election_post->ID), 'medium', false, '');				
							?><div class="slide swiper-slide"><a  href="<?php echo get_permalink($election_post->ID);?>" class="home_election_item">
								<div class="home_election_item_image" style="background-image:url(<?php echo $post_item_image[0];?>);"></div>
								<div class="home_election_item_title">
									<h2 class="ellipsis" lines="3" ><?php echo $election_post->post_title; ?></h2>
								</div>
							</a></div><?php
						}
						?></div></div><div class="swiper-pagination"><</div></div>
				<div class="home_elections_posts home_slider_desktop"><?php foreach($posts as $election_post){
							$post_item_image = wp_get_attachment_image_src(get_post_thumbnail_id($election_post->ID), 'medium', false, '');				
							?><a  href="<?php echo get_permalink($election_post->ID);?>" class="home_election_item">
								<div class="home_election_item_image" style="background-image:url(<?php echo $post_item_image[0];?>);"></div>
								<div class="home_election_item_title">
									<h2 class="ellipsis" lines="3" ><?php echo $election_post->post_title; ?></h2>
								</div>
							</a><?php
						}
						?></div>
				</div>
			</div>
		</div>
		<?php 
	}
	
}

// Get SendGrid recipient info 
function get_sendgrid_recipient($email){
	$url = 'https://api.sendgrid.com/v3/';
$request =  $url.'contactdb/recipients';  
$params = array(array(
'email' => $email,
'first_name' => '',
'last_name' => ''
));
$json_post_fields = json_encode($params);
// Generate curl request
$ch = curl_init();
	$frontpage_id = get_option( 'page_on_front' );	
if($frontpage_id){
$sendgrid_api_key =get_post_meta($frontpage_id,'sendgrid_api_key',true);
$headers = 
array("Content-Type: application/json",
"Authorization: Bearer ".$sendgrid_api_key);
curl_setopt($ch, CURLOPT_POST, true);   
curl_setopt($ch, CURLOPT_URL, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Apply the JSON to our curl call
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_post_fields);
$data = curl_exec($ch);
if (curl_errno($ch)) {
print "Error: " . curl_error($ch);
} else {
// Show me the result
curl_close($ch);
}
$data_array = json_decode($data,true);
return  $data_array['persisted_recipients'][0];
}
}
// Get SendGrid add contact 
function add_recipient_to_list($recipient){
	$frontpage_id = get_option( 'page_on_front' );	
if($frontpage_id){
$sendgrid_api_key =get_post_meta($frontpage_id,'sendgrid_api_key',true);
}
$url = 'https://api.sendgrid.com/v3/';
$request =  $url.'contactdb/lists/11740279/recipients/'.$recipient; 
// Generate curl request
$ch = curl_init();
$headers = 
array("Content-Type: application/json",
"Authorization: Bearer ".$sendgrid_api_key);
curl_setopt($ch, CURLOPT_POST, true);   
curl_setopt($ch, CURLOPT_URL, $request);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// Apply the JSON to our curl call
$data = curl_exec($ch);
if (curl_errno($ch)) {
print "Error: " . curl_error($ch);
} else {
// Show me the result
curl_close($ch);
}
$data_array = json_decode($data,true);
print_r($data_array);
return true;
}
// Get area by post id
function get_post_area($post_ID) {
   $post_area= get_post_meta($post_ID,'post_area',true);
        return $post_area;
}
// Add area column to posts
function area_columns_head($defaults) {
	 $new = array();
  foreach($defaults as $key => $title) {
    if ($key=='author') // Put the Thumbnail column before the Author column
      $new['post_area'] = 'Área';
    $new[$key] = $title;
  }
  return $new;
}
 
// Show area value
function area_columns_content($column_name, $post_ID) {
    if ($column_name == 'post_area') {
         $post_area= get_post_meta($post_ID,'post_area',true);
		$areas_array=array();
		foreach($post_area as $area){
							$the_slug =$area;
							if(!empty($the_slug)){
					$args = array(
					  'name'        => $the_slug,
					  'post_type'   => 'area',
					  'post_status' => 'publish',
					  'numberposts' => 1
					);
					$my_posts = get_posts($args);
					if( $my_posts ) :
					$areas_array[]= $my_posts[0]->post_title;
					endif;
							}
		}
					if(!empty($areas_array)){
								echo  implode(', ', $areas_array);
					}
    }
}
add_filter('manage_posts_columns', 'area_columns_head');
add_action('manage_posts_custom_column', 'area_columns_content', 10, 2);
// Get main Banner
function get_home_main_banner(){
	global $post;
	$main_banner_image_id = get_post_meta($post->ID,'main_banner_image',true);
	$main_banner_url = get_post_meta($post->ID,'main_banner_url',true);
	if(!empty($main_banner_image_id) && !empty($main_banner_url)){
		$main_banner_image = wp_get_attachment_image_src($main_banner_image_id,'full', false, '');
		?>
		<div class="main_banner_container">
			<div class="main_banner_container_wrapper">
			<a href="<?php echo $main_banner_url;?>" class="main_banner_image">
				<img src="<?php echo $main_banner_image[0];?>" />
			</a>
			<div class="close_main_banner"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close_banner.svg"/></div>
		</div>
		</div>
		<?php
	}
}
// Migration scripts, don't use this, is complicated.

	// require 'PHPspreadsheet/spreadsheet/vendor/autoload.php';
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
// add_action( 'wp_loaded', 'fix_posts' );
// function fix_posts(){
// if($_GET['fix_featured']=='true'){
	// $the_query = new WP_Query( array('post_type'=>'post',
	// 'posts_per_page'         => -1,
// 'tax_query' => array(
    // array(
        // 'taxonomy' => 'category',
        // 'field' => 'slug',
        // 'terms' => 'imco-recomienda'
    // )
// )
// ) );
// if(!empty($the_query->posts)){
	// foreach($the_query->posts as $featured_posts){
		// echo $featured_posts->post_title.'</br>';	
	// }
// }
// }
// if($_GET['fix_posts']=='true'){

// $inputFileName = 'test.xlsx';
// /**  Identify the type of $inputFileName  **/
// $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
// 
// /**  Create a new Reader of the type that has been identified  **/
// $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
// 
// /**  Load $inputFileName to a Spreadsheet Object  **/
// $spreadsheet = $reader->load($inputFileName);
// 
// /**  Convert Spreadsheet Object to an Array for ease of use  **/
// $schdeules = $spreadsheet->getActiveSheet()->toArray();
// $index = 1;
// foreach( $schdeules as $single_schedule )
// {
	// $ID = $single_schedule[0];
	// $the_post = get_post($ID);
	// if($the_post){
	// $keywords = $single_schedule[9];  
			// if(!empty($keywords) && $keywords!='NULL'){
				// update_post_meta($the_post->ID,'social_keywords',$keywords);
			// }
	// }
	// $title = $single_schedule[3];
	// $excerpt = $single_schedule[4];
	// $author_id = $single_schedule[8];
	// $document = $single_schedule[13];
	// $presentation = $single_schedule[14];
	// $database = $single_schedule[15];
	// $boletin = $single_schedule[16];
	// $resumen = $single_schedule[17];
	// $is_anticorrupcion = $single_schedule[18]=='1'?true:false;
	// $is_ciudades = $single_schedule[19]=='1'?true:false;
	// $is_competitividad = $single_schedule[20]=='1'?true:false;
	// $is_education = $single_schedule[21]=='1'?true:false;
	// $is_energia = $single_schedule[22]=='1'?true:false;
	// $is_gobierno = $single_schedule[23]=='1'?true:false;
	// $is_justicia = $single_schedule[24]=='1'?true:false;
	// $tipo = $single_schedule[25];
	// $custom_status = $single_schedule[26];
// 
// 
// // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
	 // require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
  // require_once( ABSPATH . 'wp-admin' . '/includes/file.php' );
  // require_once( ABSPATH . 'wp-admin' . '/includes/media.php' );
// $custom_downloads = array();
  // if(!empty($document)){
// $attch_id = my_custom_upload_file($document);
// $custom_downloads[]=array(
// 'custom_download_icon' => acf_get_attachment(58910),
// 'custom_download_file' => acf_get_attachment($attch_id),
// 'custom_download_title' => 'Documento'
// );
  // }
  	    // if(!empty($presentation)){
// $attch_id = my_custom_upload_file($presentation);
// $custom_downloads[]=array(
// 'custom_download_icon' => acf_get_attachment(58910),
// 'custom_download_file' => acf_get_attachment($attch_id),
// 'custom_download_title' => 'Presentación'
// );
  // }
    // if(!empty($database)){
// $attch_id = my_custom_upload_file($database);
// $custom_downloads[]=array(
// 'custom_download_icon' => acf_get_attachment(58912),
// 'custom_download_file' => acf_get_attachment($attch_id),
// 'custom_download_title' => 'Base de datos'
// );
  // }
// 
// if(!empty($boletin)){
// $attch_id = my_custom_upload_file($boletin);
// $custom_downloads[]=array(
// 'custom_download_icon' => acf_get_attachment(58912),
// 'custom_download_file' => acf_get_attachment($attch_id),
// 'custom_download_title' => 'Boletín'
// );
  // }
// if(!empty($resumen)){
// $attch_id = my_custom_upload_file($resumen);
// $custom_downloads[]=array(
// 'custom_download_icon' => acf_get_attachment(58911),
// 'custom_download_file' => acf_get_attachment($attch_id),
// 'custom_download_title' => 'Resumen ejecutivo'
// );
  // }
// if(!empty($custom_downloads)){
	// update_field('custom_downloads', $custom_downloads, $the_post->ID);
// }
	// $areas = array();
	// if($is_anticorrupcion){
		// $slug = 'anticorrupcion';
		// $areas[]=$slug;
	// }
// 	
	// if($is_ciudades){
		// $slug = 'ciudades';
		// $areas[]=$slug;
	// }
// 	
	// if($is_education){
		// $slug = 'educacion-y-salud';
		// $areas[]=$slug;
	// }
// 	
	// if($is_energia){
		// $slug = 'energia-y-medio-ambiente';
		// $areas[]=$slug;
	// }
// 
	// if($is_gobierno){
		// $slug = 'gobierno-y-finanzas';
		// $areas[]=$slug;
	// }
// 	
	// if($is_justicia){
		// $slug = 'justicia-y-seguridad';
		// $areas[]=$slug;
	// }
// 	
	// if($is_competitividad){
		// $slug = 'competitividad';
		// $areas[]=$slug;
	// }	
			// if(!empty($areas)){
				// update_post_meta($the_post->ID,'post_area',$areas);
			// }
		// if(!empty($tipo) && $tipo !='-'){
			// switch (trim($tipo)) {
				// case 'Investigación':
				// case 'Colaboración':
				// case 'Institucional':
				// case 'IMCO Recomienda':
					// $post_type = 'investigation_post';
					// break;
				// case 'Especial':
					// $post_type = 'special_post';
					// break;
				// default:
					// $post_type = 'article_post';
					// break;
			// }
			// update_post_meta($the_post->ID,'custom_post_type',$post_type);
			// $term = term_exists( $tipo, 'custom_post_type' );
// 			
// if ( 0 !== $term && null !== $term ) {
// 
// }else{
// 	
	// $term = wp_insert_term(
  // $tipo, // the term 
  // 'custom_post_type' // the taxonomy
// );
// 
// }
// if($term){
	// $term_id = $term['term_id']?$term['term_id']:$term->term_id;
	// wp_set_post_terms( $the_post->ID, $term_id,  'custom_post_type' );
// }
		// }
		// echo $title.' '.get_post_meta($the_post->ID,'custom_status',true).' '.$index.'</br>';	
		// if($custom_status=='1'){
		// update_post_meta($the_post->ID,'custom_status','public');
		// }
		 // $updatePost = array(   
        // 'ID' => $the_post->ID, // wordpress Id
        // 'post_title'    => $title, // Updated title
        // 'post_author'   => $author_id,
        // 'post_excerpt'=> $excerpt,
    // );
// 
    // wp_update_post( $updatePost );
// 		
	
		// $index++;
// }
// $index=1;
// $args = array(
		// 'post_type' => 'post',
		// 'posts_per_page'         => -1,
		// 'orderby' => 'date',
		 // 'post_status' => array('publish') ,
		// 'meta_query' => array(
    // array(
     // 'key' => 'custom_status',
     // 'value' => 'public' // this should work...
    // ),
// ));
				// $results = new WP_Query( $args );
		// if(!empty($results->posts)){
			// foreach($results->posts as $post_item){
		// $custom_downloads = get_field('custom_downloads',$post_item->ID);
	// if($custom_downloads)
	// {
    	 // echo $post_item->post_title.'</br></br>';	
		// foreach($custom_downloads as $custom_download)
		// {
			// $ext = pathinfo(wp_get_attachment_url($custom_download['custom_download_file']['ID']), PATHINFO_EXTENSION);
			// if($ext!='pdf'){
			// echo '<a href="'.wp_get_attachment_url($custom_download['custom_download_file']['ID']).'" target="_blank">'. wp_get_attachment_url($custom_download['custom_download_file']['ID']).'</a>'.'</br>';
			// }
			// }
	 // $index++;
	// }
			// }
// 			
// echo 'all_done';
// }
// }
// }
function my_custom_upload_file($imageurl){
	$ext = pathinfo($imageurl, PATHINFO_EXTENSION);
$start = getimagesize($imageurl);
$imagetype = end(explode('/', $start['mime']));
$uniq_name = date('dmY').''.(int) microtime(true); 
$filename = preg_replace( '/\.[^.]+$/', '', basename( $imageurl ) ).'.'.$ext;

$uploaddir = wp_upload_dir();
$uploadfile = $uploaddir['path'] . '/' . $filename;
$contents= file_get_contents($imageurl);
$savefile = fopen($uploadfile, 'w');
fwrite($savefile, $contents);
fclose($savefile);

$wp_filetype = wp_check_filetype(basename($filename), null );
$attachment = array(
    'post_mime_type' => $wp_filetype['type'],
    'post_title' =>  preg_replace( '/\.[^.]+$/', '', basename( $imageurl ) ),
    'post_content' => '',
    'post_status' => 'inherit'
);

$attach_id = wp_insert_attachment( $attachment, $uploadfile );
$imagenew = get_post( $attach_id );
$fullsizepath = get_attached_file( $imagenew->ID );
$attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
wp_update_attachment_metadata( $attach_id, $attach_data );
return $attach_id;
}


// Get area by post id
// Add team category column to posts
function type_columns_head($defaults) {
	 $new = array();
  foreach($defaults as $key => $title) {
    if ($key=='date') // Put the Thumbnail column before the Author column
      $new['typeteam'] = 'Categoria de equipo';
    $new[$key] = $title;
  }
  return $new;
}
 
// Show team category value
function type_columns_content($column_name, $post_ID) {
    if ($column_name == 'typeteam') {
// get the assigned terms to the post
$terms = get_the_terms( $post_id, 'team_category' );
// create an empty array for storing category names
$terms_meta = array();
if ( ! empty( $terms ) ) {
    foreach ( $terms as $term ) {
        $terms_meta[] = $term->name;
    }
}

if ( ! empty( $terms_meta ) ) {
    $terms_string = implode( ', ', $terms_meta );
} else {
    $terms_string = '';
}

print_r( $terms_string );
    }
}
add_filter('manage_equipo_posts_columns', 'type_columns_head');
add_action('manage_equipo_posts_custom_column', 'type_columns_content', 10, 2);

function fix_posts_for_search(){
	if($_GET['fixing_shit']=='true' && isset($_GET['fakepage'])){
	$paged =$_GET['fakepage'];
			$args = array(
		'post_type' => 'post',
		'post_status' =>  array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
		'posts_per_page'   => 750,
		'orderby' => 'date',
		'paged' => $paged,
		'order' => 'DESC');
		$results = new WP_Query( $args );
		if(!empty($results->posts)){
			foreach($results->posts as $post_item){
				 set_things_for_search($post_item->ID);
// echo get_post_meta($post_item->ID,'search_author',true)."</br>";
// echo get_post_meta($post_item->ID,'search_priority',true)."</br>";
 echo get_post_meta($post_item->ID,'search_date',true)."</br>";
			}
		}
					
	echo 'done '.count($results->posts);
	}
}
function set_things_for_search($post_id) {
	
	$post_date = get_the_date( 'Y-m-d' ,$post_id);
	update_post_meta($post_id,'search_date',($post_date));
	
		$author_id = get_post_field ('post_author', $post_id);
		if(!empty($author_id)){
		$display_name = get_the_author_meta( 'display_name' , $author_id ); 
		if(!empty($display_name)){
			update_post_meta($post_id,'search_author',$display_name);
		}
		}

if( has_term( 'investigacion', 'custom_post_type' , $post_id) ) {
update_post_meta($post_id,'search_priority','1');
}else{
update_post_meta($post_id,'search_priority','0');
}
}
add_action( 'save_post', 'set_things_for_search' );
function mv_meta_in_search_query( $pieces, $args ) {
    global $wpdb;
    if ( ! empty( $_GET['cs']) ) { // only run on search query.
        $keywords        =   $_GET['cs'];
        $escaped_percent = $wpdb->placeholder_escape(); // WordPress escapes "%" since 4.8.3 so we can't use percent character directly.
        $query           = "";

            $query .= " (unique_postmeta_selector.meta_key='search_author' AND  unique_postmeta_selector.meta_value LIKE '{$escaped_percent}{$keywords}{$escaped_percent}') OR ";

        if ( ! empty( $query ) ) { // append necessary WHERE and JOIN options.
            $pieces['where'] = str_replace( "((({$wpdb->posts}.post_title LIKE '{$escaped_percent}", "( {$query} (({$wpdb->posts}.post_title LIKE '{$escaped_percent}", $pieces['where'] );
            $pieces['join'] = $pieces['join'] . " INNER JOIN {$wpdb->postmeta} AS unique_postmeta_selector ON ({$wpdb->posts}.ID = unique_postmeta_selector.post_id) ";
        }
    }
    return $pieces;
}
add_filter( 'posts_clauses', 'mv_meta_in_search_query', 20, 2 );

// Agrega modal 
function add_popup_scripts() {
	wp_enqueue_script( 'popup-script', get_stylesheet_directory_uri() . '/js/popup.js', array('jquery'), '1.0', true );
	wp_enqueue_style( 'popup-style', get_stylesheet_directory_uri() . '/css/popup.css', array(), '1.0', 'all' );
  }
  add_action( 'wp_enqueue_scripts', 'add_popup_scripts' );
?>
