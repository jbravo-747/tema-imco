<?php
/**
* Template Name: Donaciones
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<style>

#donate p {
    margin: 0 !important;
    display: block;
    margin-left: auto;
    margin-right: auto;
    text-align: justify;
    text-justify: inter-word;
}

.centrar-listas ul,
.centrar-listas ol {
    text-align: left;
    display: inline-block;
}

.centrar {
    padding-top: 2% !important;
    padding: 1rem;
    /* IMPORTANT */
    text-align: center;
	border-width: 5px;
	border-color: red;
}

.menu_work {z
    border-radius: 8px;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
    width: 45%;
}

.menu_work:hover {
    box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
}



	.donar{
		padding-top: 50px;
		background: aqua;
		margin: 30px;
		border-width: 10px;
		border-color: red;
		border-radius: 30px;
		width: 50%;
		display: block;
		/* IMPORTANT */
		align-items: center;
		margin-left: auto;
  		margin-right: auto;
		
	}
@media screen and (max-width: 600px) {
    #soon p {
        margin: 0 !important;
        padding-left: 5%;
        padding-right: 5%;
        display: block;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
        text-justify: inter-word;
    }

	.menu_work {
		background-color: #00bfda;
		border-radius: 8px;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: flex;
		font-size: 18px;
		margin: 4px 2px;
		cursor: pointer;
		width: 100%;
	}
}
</style>

<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>"
    value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_proximamente" style="background: url('https://imco.org.mx/wp-content/uploads/2021/04/landing-ice2021-back.png') no-repeat fixed center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; height: 100%; width: 100%; text-align: center;">
    <main id="main" class="site-main" role="main">
        <div class="page_content_container">
            <div class="page_content_container_wrapper" id="donate">
                <div class="centrar">
                    <?php echo wpautop($post->post_content);?>
                    <br>
                    <br>
                </div>
            </div>
			<span><?php custom_get_post_share_module(); ?></span>
        </div>
    </main>
</div>
<?php get_footer(); ?>