<?php
/**
* Template Name: Home
*
* @package WordPress
*/
get_header();
get_website_header();
?>
<input type="hidden" class="associated_page" original="<?php echo get_permalink($post -> ID); ?>"
  value="<?php echo get_permalink($post -> ID); ?>">
<div id="primary" class="content-area primary_home">
  <main id="main" class="site-main" role="main">
    <?php get_home_main_banner(); ?>
    <div class="home_slider_container"></div>
    <div class="page_content_container">
      <div class="page_content_container_wrapper" id="home">
        <div class="home_layout">
          <?php echo get_home_layout(); ?>

          <!-- mailchimp -->
          <div id="mc_embed_shell">
            <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
            <style type="text/css">
            #mc_embed_signup {
              background: #00bfda;
              false;
              clear: left;
              font: 14px Helvetica, Arial, sans-serif;
              width: 80%;
            }

            /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
            </style>
            <!-- <dmailchipiv id="mc_embed_signup">
    <form action="https://imco.us14.list-manage.com/subscribe/post?u=c3db59ffdd396b96e15280017&amp;id=8839f21fb2&amp;f_id=00df5ee0f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
        <div id="mc_embed_signup_scroll"><h2>SUSCRÍBETE A NUESTRO BOLETÍN</h2>
            <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
            <div class="mc-field-group"><label for="mce-EMAIL">Correo electrónico <span class="asterisk">*</span></label><input type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value=""></div>
<div hidden=""><input type="hidden" name="tags" value="7350912"></div>
        <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display: none;"></div>
            <div class="response" id="mce-success-response" style="display: none;"></div>
        </div><div aria-hidden="true" style="position: absolute; left: -5000px;"><input type="text" name="b_c3db59ffdd396b96e15280017_8839f21fb2" tabindex="-1" value=""></div><div class="clear"><input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Subscribe"></div>
    </div>
</form>
</div> -->
            <div id="mc_embed_shell">
              <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
              <style type="text/css">
              #mc_embed_signup {
                background: #333333;
                border: 1px solid #000;
                border-radius: 4px;
                padding: 20px;
                box-sizing: border-box;
                false;
                clear: left;
                font: 14px Helvetica, Arial, sans-serif;
                color: #fff;
                width: 100%;
                max-width: 700px;
                margin: 16px 0 0 0;
              }
              #mc_embed_signup h2,
              #mc_embed_signup label,
              #mc_embed_signup .indicates-required {
                color: #fff;
              }
              #mc_embed_signup .button {
                background: #fff;
                color: #000;
                border: 1px solid #fff;
              }
              #mc_embed_signup .button:hover,
              #mc_embed_signup .button:focus {
                background: #e5e5e5;
                border-color: #e5e5e5;
              }

              /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
              </style>
              <div id="mc_embed_signup">
                <form
                  action="https://imco.us14.list-manage.com/subscribe/post?u=c3db59ffdd396b96e15280017&amp;id=8839f21fb2&amp;f_id=00df5ee0f0"
                  method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
                  target="_blank">
                  <div id="mc_embed_signup_scroll">
                    <h2>SUSCRÍBETE A NUESTRO BOLETÍN</h2>
                    <div class="indicates-required"><span class="asterisk">*</span> indica que es obligatorio</div>
                    <div class="mc-field-group"><label for="mce-EMAIL">Correo electrónico <span
                          class="asterisk">*</span></label><input type="email" name="EMAIL" class="required email"
                        id="mce-EMAIL" required="" value=""></div>
                    <div hidden=""><input type="hidden" name="tags" value="7350912,40201558"></div>
                    <div id="mce-responses" class="clear">
                      <div class="response" id="mce-error-response" style="display: none;"></div>
                      <div class="response" id="mce-success-response" style="display: none;"></div>
                    </div>
                    <div aria-hidden="true" style="position: absolute; left: -5000px;"><input type="text"
                        name="b_c3db59ffdd396b96e15280017_8839f21fb2" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button"
                        value="Suscribete"></div>
                  </div>
                </form>
              </div>
              <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js">
              </script>
              <script type="text/javascript">
              (function($) {
                window.fnames = new Array();
                window.ftypes = new Array();
                fnames[0] = 'EMAIL';
                ftypes[0] = 'email';
                fnames[1] = 'FNAME';
                ftypes[1] = 'text';
                fnames[2] = 'MMERGE2';
                ftypes[2] = 'text';
                fnames[5] = 'MMERGE5';
                ftypes[5] = 'text';
                /*
                 * Translated default messages for the $ validation plugin.
                 * Locale: ES
                 */
                $.extend($.validator.messages, {
                  required: "Este campo es obligatorio.",
                  remote: "Por favor, rellena este campo.",
                  email: "Por favor, escribe una dirección de correo válida",
                  url: "Por favor, escribe una URL válida.",
                  date: "Por favor, escribe una fecha válida.",
                  dateISO: "Por favor, escribe una fecha (ISO) válida.",
                  number: "Por favor, escribe un número entero válido.",
                  digits: "Por favor, escribe sólo dígitos.",
                  creditcard: "Por favor, escribe un número de tarjeta válido.",
                  equalTo: "Por favor, escribe el mismo valor de nuevo.",
                  accept: "Por favor, escribe un valor con una extensión aceptada.",
                  maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
                  minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
                  rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
                  range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
                  max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
                  min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
                });
              }(jQuery));
              var $mcj = jQuery.noConflict(true);
              </script>
            </div>

            <!-- finmailchimp -->

            <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
            <script type="text/javascript">
            (function($) {
              window.fnames = new Array();
              window.ftypes = new Array();
              fnames[0] = 'EMAIL';
              ftypes[0] = 'email';
              fnames[1] = 'FNAME';
              ftypes[1] = 'text';
              fnames[2] = 'MMERGE2';
              ftypes[2] = 'text';
              fnames[5] = 'MMERGE5';
              ftypes[5] = 'text';
              /*
               * Translated default messages for the $ validation plugin.
               * Locale: ES
               */
              $.extend($.validator.messages, {
                required: "Este campo es obligatorio.",
                remote: "Por favor, rellena este campo.",
                email: "Por favor, escribe una dirección de correo válida",
                url: "Por favor, escribe una URL válida.",
                date: "Por favor, escribe una fecha válida.",
                dateISO: "Por favor, escribe una fecha (ISO) válida.",
                number: "Por favor, escribe un número entero válido.",
                digits: "Por favor, escribe sólo dígitos.",
                creditcard: "Por favor, escribe un número de tarjeta válido.",
                equalTo: "Por favor, escribe el mismo valor de nuevo.",
                accept: "Por favor, escribe un valor con una extensión aceptada.",
                maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
                minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
                rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
                range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
                max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
                min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
              });
            }(jQuery));
            var $mcj = jQuery.noConflict(true);
            </script>
          </div>

          <!-- fin mailchimp -->

        </div>
        <div class="home_footer">
          <?php
		/* get_mailchimp_module(); */
		/* get_custom_footer_banner(); */
		?>
        </div>
      </div>
    </div>
  </main>
</div>
<?php
fix_posts_for_search();
get_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/packery.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/home.js">
</script>
