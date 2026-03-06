<?php
/**
* Template Name: Bolsa_de_Trabajo
*
* @package WordPress
*/
get_header();
get_website_header();
get_top_scroll_bar();
?>
<style>
#soon p {
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
}

.menu_work {
    background-color: #00bfda;
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
<div id="primary" class="content-area primary_proximamente">
    <main id="main" class="site-main" role="main">
        <div class="page_content_container">
            <div class="page_content_container_wrapper" id="soon">
                <div class="centrar centrar-listas">
                    <h1 class="post_title"><?php echo $post->post_title;?></h1>
                    <!-- <br>
                    <a class="menu_work" href="https://imco.org.mx/trabaja-con-nosotros/">Vacantes</a>
                    <a class="menu_work" href="https://imco.org.mx/trabaja-con-nosotros/servicio-social/">Servicio
                        social</a>
                    <br> -->
					<br>
                    <?php echo wpautop($post->post_content);?>
                    <br>
                    <br>
                    <span>COMPARTIR: <?php custom_get_post_share_module(); ?></span>
                </div>
            </div>
        </div>
    </main>
</div>
<?php get_footer(); ?>