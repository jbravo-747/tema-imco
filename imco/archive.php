<?php
/**
 * The template for displaying all archives
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 global $post_type_archive; 
$object= $wp_query->query;
$post_type= $object['post_type'];
	global $share_slug;
		$share = false;;
		$js ="";
		if(empty($post_type)){
		$obj = get_queried_object();
		$post_type = $obj->taxonomy;
		}
		$post_type_archive = $post_type;
		switch ($post_type) {
			case 'equipo':
		include_once('templates/template_team.php');
				break;
			default:
		include_once('404.php');
				
				break;
		}
		if($include!=""){
		include_once($include);

			}
			?>