<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 global $post_type_single; 
 $post_type = get_post_type($post);
 $post_type_single = $post_type;
global $share_slug;
		$share = false;;
		$js ="";
		switch ($post_type) {
		case 'equipo':	
		include_once('templates/template_team_item.php');
		break;
		case 'post':
		$custom_post_type = get_post_meta($post->ID,'custom_post_type',true)	;
			switch ($custom_post_type) {
				case 'special_post':
					include_once('templates/template_special_post.php');
					break;
				case 'investigation_post':
					include_once('templates/template_investigation_post.php');
					break;
				default:
					include_once('templates/template_article_post.php');
					break;
				}
		break;
		case 'area':	
		include_once('templates/template_area_item.php');
		break;
		default:	
		include_once('404.php');
				
				break;
		}
		if($include!=""){
		include_once($include);
	
			}
			?>
					