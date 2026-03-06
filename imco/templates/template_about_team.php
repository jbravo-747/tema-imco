<?php
/**
* Template Name: Redireccionar a primer hijo
*
* @package WordPress
*/
$pagekids = get_pages('child_of='.$post->ID.'&sort_column=menu_order');
if ($pagekids) {
$firstchild = $pagekids[0];
wp_redirect(get_permalink($firstchild->ID));
exit();
}