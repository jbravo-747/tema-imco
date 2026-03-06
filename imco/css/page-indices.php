<?php
/**
* Template Name: Índices Page
*
* @package WordPress
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/imco/css/indices-style.css">
    <?php wp_head(); ?><?php
/**
* Template Name: Índices Page
*
* @package WordPress
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <style>
        /* CSS para la página de índices */
        .container {
            width: 80%;
            margin: auto;
        }

        .section_content {
            text-align: center;
            padding: 2em 0;
        }

        .indices {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5em;
            padding: 2em 0;
        }

        .indice-card {
            flex: 1 1 30%;
            padding: 1em;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }

        .indice-card h2 {
            color: #003366;
        }

        .indice-card a {
            display: inline-block;
            margin-top: 1em;
            padding: 0.5em 1em;
            color: #ffffff;
            background-color: #003366;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>
</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<div id="primary" class="content-area primary_post primary_post_article">
    <main id="main" class="site-main" role="main">
        <div class="page_content_container">
            <div class="page_content_container_wrapper">
                <div class="section_container">
                    <div class="section_content">
                        <h1 class="post_title">Índices</h1>
                        <p>Explora los índices que elabora el IMCO para evaluar diversos aspectos de la competitividad y desarrollo en México.</p>
                        
                        <!-- Índices Section -->
                        <section class="indices">
                            <div class="container">
                                <div class="indice-card">
                                    <h2>Índice de Competitividad Estatal</h2>
                                    <p>Analiza la competitividad de las entidades federativas en México.</p>
                                    <a href="#">Ver más</a>
                                </div>
                                <div class="indice-card">
                                    <h2>Índice de Competitividad Urbana</h2>
                                    <p>Evalúa el desempeño de las ciudades en México en términos de competitividad.</p>
                                    <a href="#">Ver más</a>
                                </div>
                                <div class="indice-card">
                                    <h2>Índice de Competitividad Internacional</h2>
                                    <p>Comparación de la competitividad de México a nivel global.</p>
                                    <a href="#">Ver más</a>
                                </div>
                                <!-- Agrega más tarjetas de índice según sea necesario -->
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>

</head>
<body <?php body_class(); ?>>

<?php get_header(); ?>

<div id="primary" class="content-area primary_post primary_post_article">
    <main id="main" class="site-main" role="main">
        <div class="page_content_container">
            <div class="page_content_container_wrapper">
                <div class="section_container">
                    <div class="section_content">
                        <h1 class="post_title">Índices</h1>
                        <p>Explora los índices que elabora el IMCO para evaluar diversos aspectos de la competitividad y desarrollo en México.</p>
                        
                        <!-- Índices Section -->
                        <section class="indices">
                            <div class="container">
                                <div class="indice-card">
                                    <h2>Índice de Competitividad Estatal</h2>
                                    <p>Analiza la competitividad de las entidades federativas en México.</p>
                                    <a href="#">Ver más</a>
                                </div>
                                <div class="indice-card">
                                    <h2>Índice de Competitividad Urbana</h2>
                                    <p>Evalúa el desempeño de las ciudades en México en términos de competitividad.</p>
                                    <a href="#">Ver más</a>
                                </div>
                                <div class="indice-card">
                                    <h2>Índice de Competitividad Internacional</h2>
                                    <p>Comparación de la competitividad de México a nivel global.</p>
                                    <a href="#">Ver más</a>
                                </div>
                                <!-- Add more indice-cards as needed -->
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>
<?php wp_footer(); ?>

</body>
</html>
