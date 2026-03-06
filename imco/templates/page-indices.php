<?php
/**
* Template Name: Índices Page
*
* @package WordPress
*/
get_header(); 
get_website_header();
get_top_scroll_bar();
?>

<style>
    /* Contenedor general */
    .content-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 1200px;
        margin: auto;
        padding: 1rem;
    }

    /* Estilos de las tarjetas */
    .card-container {
        display: flex;
        flex-direction: column; /* Apilar en móviles */
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        margin-top: 5px; /* Reducir margen superior */
        width: 100%;
    }

    /* Diseño de columnas para pantallas grandes */
    @media (min-width: 768px) {
        .card-container {
            flex-direction: row; /* Columnas horizontales en pantallas grandes */
            align-items: flex-start;
        }
    }

    /* Imagen */
    .card-image {
        width: 100%;
        max-width: 180px; /* Imagen un poco más grande */
        display: flex;
        justify-content: center; /* Centrar en la columna en móviles */
        align-items: center; /* Centrar verticalmente en la columna */
        margin: auto; /* Asegurar que esté centrada horizontalmente */
        margin-bottom: 5px;
    }

    /* Ajustar alineación de la imagen en pantallas grandes */
    @media (min-width: 768px) {
        .card-image {
            width: 25%;
            justify-content: flex-start; /* Alinear a la izquierda en pantallas grandes */
            align-items: flex-start; /* Alinear en la parte superior en pantallas grandes */
            margin-bottom: 0;
        }
    }

    .card-image img {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    /* Contenido principal */
    .card-content {
        width: 100%;
        margin-bottom: 5px;
    }

    /* Ajustar ancho del contenido en pantallas grandes */
    @media (min-width: 768px) {
        .card-content {
            width: 50%;
            margin-bottom: 0;
            padding-right: 5px;
        }
    }

    .card-title {
        font-size: 1.25rem;
        color: #1d4ed8;
        font-weight: bold;
        margin-bottom: 5px;
        text-align: left; /* Alinear el título a la izquierda */
    }

    .card-description {
        color: #4a5568;
        margin-bottom: 5px;
        text-align: justify; /* Justificar el texto */
    }

    .card-link {
        color: #3b82f6;
        text-decoration: underline;
        text-align: left; /* Alinear el enlace a la izquierda */
    }

    /* Descargas */
    .card-downloads {
        width: 100%;
        background-color: #eff6ff;
        padding: 1rem;
        border-radius: 4px;
    }

    /* Ajustar ancho de descargas en pantallas grandes */
    @media (min-width: 768px) {
        .card-downloads {
            width: 25%;
            margin-bottom: 0;
        }
    }

    .downloads-title {
        color: #2563eb;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-bottom: 5px;
    }

    .downloads-list {
        color: #3b82f6;
        list-style-type: none;
        padding: 0;
    }

    .downloads-list li {
        margin-bottom: 5px;
        display: flex;
        align-items: center;
    }
</style>

<div id="primary" class="content-area primary_post primary_post_article">
    <main id="main" class="site-main">
        <div class="page_content_container">
            <div class="page_content_container_wrapper container" id="post_article">
                <div class="section_container">
                    <?php get_breadcrumb($post); ?>
                    <div class="section_content">
                        <h1 class="post_title text-center card-title">Índices de Competitividad</h1>
                        
                        <!-- Tarjetas de Índices -->
                        <?php 
                        $tarjetas = [
                            [
                                "titulo" => "Índice de Competitividad Estatal 2024",
                                "descripcion" => "A partir de esta edición del ICE, el IMCO construyó una herramienta de consulta dinámica para acceder al detalle de los indicadores para cada una de las 32 entidades del país. Si deseas conocer las alternativas de acceso a esta interfaz, por favor envía un correo a <b>tableros@imco.org.mx</b>",
                                "imagen" => "https://api.imco.org.mx/release/latest/archivos/indice-de-competitividad-estatal/2024/portada/jpeg",
                                "micrositio" => "https://imco.org.mx/URL_DEL_MICROSITIO",
                                "descargas" => [
                                    "Boletín" => "https://imco.org.mx/URL_BOLETIN",
                                    "Presentación" => "https://imco.org.mx/URL_PRESENTACION ",
                                    "Anexo Metodológico" => "https://imco.org.mx/URL_ANEXO_METODOLOGICO",
                                    "Documento" => "https://imco.org.mx/URL_DOCUMENTO",
                                    "Boletas entidades" => "https://imco.org.mx/URL_BOLETAS_ENTIDADES"
                                ]
                            ],
                            [
                                "titulo" => "Índice de Competitividad Urbana 2023",
                                "descripcion" => "El Índice de Competitividad Urbana(ICU) 2023 mide la capacidad de las ciudades para generar, atraer y retener talento e inversión que detonen la productividad y el bienestar de sus habitantes.<br>Está compuesto por 69 indicadores, categorizados en 10 subíndices.<br>El análisis muestra los avances y retrocesos en cada uno de los subíndices e indicadores analizados para 362 municipios, que conforman 66 ciudades.",
                                "imagen" => "https://api.imco.org.mx/release/latest/archivos/indice-de-competitividad-urbana/2023/portada/png",
                                "descargas" => [
                                    "Resumen" => "https://imco.org.mx/URL_RESUMEN_URBANA",
                                    "Metodología" => "https://imco.org.mx/URL_METODOLOGIA_URBANA"
                                ]
                            ],
                            [
                                "titulo" => "Índice de Competitividad Estatal 2023",
                                "descripcion" => "El Índice de Competitividad Estatal 2023 (ICE) mide la capacidad de las entidades para generar, atraer y retener talento e inversiones. Un estado competitivo es aquel que logra las condiciones y capacidades para el desarrollo sostenible tanto del capital humano como físico. Esta edición busca visibilizar las fortalezas y áreas por atender de las 32 entidades federativas.",
                                "imagen" => "https://api.imco.org.mx/release/latest/archivos/indice-de-competitividad-estatal/2023/portada/jpeg",
                                "micrositio" => "URL_MICROSITIO_INTERNACIONAL",
                                "descargas" => [
                                    "Reporte Completo" => "URL_REPORTE_COMPLETO_INTERNACIONAL"
                                ]
                            ],
                            [
                                "titulo" => "Índice de Competitividad Urbana 2022",
                                "descripcion" => "El Índice de Competitividad Urbana(ICU) 2022 mide la capacidad de las ciudades para generar, atraer y retener talento e inversión que detonen la productividad y el bienestar de sus habitantes.<br>Está compuesto por 69 indicadores, categorizados en 10 subíndices.<br>El análisis muestra los avances y retrocesos en cada uno de los subíndices e indicadores analizados para 362 municipios, que conforman 66 ciudades.",
                                "imagen" => "https://api.imco.org.mx/release/latest/archivos/indice-de-competitividad-urbana/2022/portada/png",
                                "micrositio" => "URL_MICROSITIO_INNOVACION",
                                "descargas" => [
                                    "Boletín" => "URL_BOLETIN_INNOVACION"
                                ]
                            ],
                            [
                                "titulo" => "Índice de Competitividad Internacional 2022",
                                "descripcion" => "El Índice de Competitividad Internacional 2022 (ICI) mide la capacidad de las 43 economías más importantes del mundo para generar, atraer y retener talento e inversión. Un país competitivo es aquel que, más allá de las posibilidades con las que cuenta gracias a sus propios recursos y capacidades, resulta atractivo para el talento y la inversión, y de esta forma está en condiciones de alcanzar una mayor productividad y generar bienestar para sus habitantes.<br>El ICI está compuesto por 85 indicadores, categorizados en 10 subíndices que evalúan distintas dimensiones de la competitividad de los países considerados.",
                                "imagen" => "https://api.imco.org.mx/release/latest/archivos/indice-de-competitividad-internacional/2022/portada/jpg",
                                "micrositio" => "URL_MICROSITIO_SOSTENIBILIDAD",
                                "descargas" => [
                                    "Resumen Ejecutivo" => "URL_RESUMEN_SOSTENIBILIDAD"
                                ]
                            ]
                        ];
                        
                        foreach ($tarjetas as $tarjeta): ?>
                            <div class="card-container">
                                <!-- Imagen de la publicación -->
                                <div class="card-image">
                                    <img src="<?php echo $tarjeta['imagen']; ?>" alt="<?php echo $tarjeta['titulo']; ?>">
                                </div>
                                
                                <!-- Contenido principal -->
                                <div class="card-content">
                                    <h2 class="card-title"><?php echo $tarjeta['titulo']; ?></h2>
                                    <p class="card-description"><?php echo $tarjeta['descripcion']; ?></p>
                                    <a href="<?php echo $tarjeta['micrositio']; ?>" class="card-link">Visita el micrositio</a>
                                </div>
                                
                                <!-- Sección de Descargas -->
                                <div class="card-downloads">
                                    <h3 class="downloads-title">
                                        Descargas <span class="text-xl">📥</span>
                                    </h3>
                                    <ul class="downloads-list">
                                        <?php foreach ($tarjeta['descargas'] as $nombre => $url): ?>
                                            <li><a href="<?php echo $url; ?>">📄 <?php echo $nombre; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- Fin de las tarjetas de índice -->
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php get_footer(); ?>
<?php wp_footer(); ?>
