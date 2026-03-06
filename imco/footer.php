<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
</div><!-- .site-content -->
<style>
	.banderita {
		margin:0;
  		padding:0;
		color: white;
		font-size:10px;
		display: flex;
		text-align: center;
		height: auto;
		position: relative;
		z-index: 1;
	}
</style> 
<!--  Website Footer -->
<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="footer_wrapper">
		<div class="main_footer_container">
			<div class="center_footer">
				<div class="main_footer_columns_container clear">
					<div class="main_footer_column logo_column">
						<div class="footer_logo">
							<a href="<?php echo get_home_url(); ?>" >
								<div class="logo">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" />
								</div>
								<div class="logo_text">
									INSTITUTO MEXICANO PARA
								</br>LA COMPETITIVIDAD A.C.
								</div>
							</a>
						</div>
						<?php 
						custom_get_footer_menu('legal_footer_menu');
						?>
						<div class="banderita">
							<span>Language:&nbsp;<br> </span>
							<a href="https://imco.org.mx/en/"><img src="https://imco.org.mx/wp-content/uploads/2024/04/UnitedStates_US_USA_840_Flag1_26093.png" alt=""></a>
						</div>
					</div>
					<div class="main_footer_column aboutus_column">
						<?php 
						custom_get_footer_menu('aboutus_footer_menu');
						?>
					</div>
					<div class="main_footer_column press_column">
						<?php 
						custom_get_footer_menu('press_footer_menu');
						?>
					</div>
					<div class="main_footer_column others_column">
						<?php 
						custom_get_footer_menu('others_footer_menu');
						?>
					</div>
					<div class="main_footer_column contact_column">
						<div class="footer_menu_item footer_cell">
     						<div class="footer_menu_item">
        						<a class="title dropdown_title">Contacto</a>
        							<div class="sub-menu">
        								<ul>
        									<?php 
											 $phone = get_option( 'phone', '' );
											 if(!empty($phone)){
											 	?>
												<li class="item">
	        										<a class="title">
	        											<b>Teléfono: </b> <?php echo $phone;?>
	        										</a>
	        									</li> 
											 	<?php
											 }
											?>
											<?php 
											 $contact_email = get_option( 'contact_email', '' );
											 if(!empty($contact_email)){
											 	?>
												<li  class="item">
	        										<a href="mailto:<?php echo $contact_email;?>" class="title">
	        											<b>Mail: </b> <?php echo $contact_email;?>
	        										</a>
	        									</li> 
											 	<?php
											 }
											?>
											<?php 
											 $address = get_option( 'address', '' );
											 if(!empty($address)){
											 	?>
												<li class="item">
	        										<a class="title">
	        											<b>Oficinas: </b> <?php echo $address;?>
	        										</a>
	        									</li> 
											 	<?php
											 }
											?>
        									
        								</ul>
        							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom_footer_container">
			<div class="center_footer clear">
				<!--  social menu -->
				<div class="social_menu">
					<nav>
						<ul class="social-nav" >
							<?php
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
							    ?>
							     <li class="item"  id="social_menu_item_<?php echo $count; ?>" >
							        <a  target="_blank" href="<?php echo $link; ?>" class="social_item  <?php echo $title;?>">
							        	<span></span>
							        </a>
							    </li>
							<?php $count++; endforeach; 
								}
							?>
						</ul>
					</nav>
				</div>
				<?php 
				//Copiright text
				 $copyrights = get_option( 'copyrights', '' );
				 if(!empty($copyrights)){
				 	echo '<div class="copyright_container">'.$copyrights.'</div>';
				 }
				?>
			</div>
		</div>
	</div>
</footer>		

</div><!-- .site -->
<?php wp_footer(); ?>
<?php
/**
 * Js Scripts
 */
	$value = get_option('googlea', '');
	?>
		<meta name="google" content="translate" />

<script src="https://cdn.jsdelivr.net/ga-lite/latest/ga-lite.min.js">
</script> <script> var galite = galite || {}; galite.UA = '<?php echo ($value); ?>'; // Insert your tracking code here </script>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.cookie.js"></script>
<script type="text/javascript"   src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.documentsize.js"></script>
<script type="text/javascript"   src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.form.js"></script>
<script type="text/javascript"   src="<?php echo get_stylesheet_directory_uri(); ?>/js/swiper.min.js"></script>
<script type="text/javascript"   src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.ellipsis.min.js"></script>
<script type="text/javascript"   src="<?php echo get_stylesheet_directory_uri(); ?>/js/common.js"></script>

</div>	
</div>

</body>
</html>
