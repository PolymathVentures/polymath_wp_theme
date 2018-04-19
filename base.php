<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=584419321623896";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript">
      jQuery(function() {
        var i = 0, scroll = function() {
          if( jQuery("#dwpb:visible").length ) {
            var top = parseInt(jQuery("#dwpb").css("top").replace("px", "")) + jQuery("#dwpb").outerHeight();
            jQuery("nav, #navbar-language").css("top", top);
          } else
            jQuery("nav, #navbar-language").css("top", 0);
          if( i<500 )
            setTimeout(scroll, 10);
          else
            document.cookie = "dwpb-close=;expires=Tue, 01 Jan 1970 00:00:00 UTC;path=/";
          i++;
        }
        setTimeout(scroll, 10);
        jQuery(".dwpb-close").click(function() { i = 0; setTimeout(scroll, 10); });
      });
    </script>
    <?php define("WHITNEY_FONT_FACE", true); ?>
    <?php define("WHITNEY_FONT_SRC", "https://polymathv.com/wp-content/themes/polymath_wp_theme/assets/_fonts"); ?>
    <?php if( WHITNEY_FONT_FACE ) { ?>
      <!-- WHITNEY FONT FACE -->
      <style type="text/css">
        @font-face {
          font-family: 'Whitney';
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Medium/WhitneyHTF-Medium.eot);
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Medium/WhitneyHTF-Medium.ttf) format("truetype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Medium/WhitneyHTF-Medium.otf) format("opentype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Medium/WhitneyHTF-Medium.woff) format("woff"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Medium/WhitneyHTF-Medium.ttf) format("svg");
        }
        @font-face {
          font-family: 'Whitney';
          font-weight: bold;
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Bold/WhitneyHTF-Bold.eot);
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Bold/WhitneyHTF-Bold.ttf) format("truetype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Bold/WhitneyHTF-Bold.otf) format("opentype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Bold/WhitneyHTF-Bold.woff) format("woff"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-Bold/WhitneyHTF-Bold.ttf) format("svg");
        }
        @font-face {
          font-family: 'Whitney';
          font-style: italic;
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-MediumItalicSC/WhitneyHTF-MediumItalicSC.eot);
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-MediumItalicSC/WhitneyHTF-MediumItalicSC.ttf) format("truetype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-MediumItalicSC/WhitneyHTF-MediumItalicSC.otf) format("opentype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-MediumItalicSC/WhitneyHTF-MediumItalicSC.woff) format("woff"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-MediumItalicSC/WhitneyHTF-MediumItalicSC.ttf) format("svg");
        }
        @font-face {
          font-family: 'Whitney';
          font-weight: bold; font-style: italic;
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-BoldItalic/WhitneyHTF-BoldItalic.eot);
          src: url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-BoldItalic/WhitneyHTF-BoldItalic.ttf) format("truetype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-BoldItalic/WhitneyHTF-BoldItalic.otf) format("opentype"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-BoldItalic/WhitneyHTF-BoldItalic.woff) format("woff"),
               url(<?= WHITNEY_FONT_SRC ?>/WhitneyHTF-BoldItalic/WhitneyHTF-BoldItalic.ttf) format("svg");
        }
        *:not([class^=icon]):not([class^=fa]):not([class^=si]) {
          font-family: Whitney !important;
        }
        html {
          overflow-x: hidden;
        }
        body.ventures .block-promos .container {
          width: 100%;
        }
        @media(min-width:992px) {
          h2, .h2 {
            font-size: 25px;
          }
        }
      </style>
    <?php } ?>
  <!--[if IE 9]>
  <style>
  .wrap, footer {
  display: none;
};
</style>
    <div class="alert alert-warning">
      This website cannot be displayed by your browser because it is outdated. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </div>
  <![endif]-->
    <!--[if IE]>
    <style>
    .wrap, footer {
    display: none;
  };
  </style>
      <div class="alert alert-warning">
        This website cannot be displayed by your browser because it is outdated. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>

    <div class="scene_element scene_element--fadein">

        <div class="wrap" role="document">
          <div class="content">
            <main>
              <?php include Wrapper\template_path(); ?>
            </main><!-- /.main -->
            <?php if (Setup\display_sidebar()) : ?>
              <aside class="sidebar">
                <?php include Wrapper\sidebar_path(); ?>
              </aside>
            <?php endif; ?>
          </div><!-- /.content -->

        </div><!-- /.wrap -->

    </div>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
    <script type="text/javascript">_linkedin_data_partner_id = "67421";</script>
    <script type="text/javascript">
      (function(){
        var s = document.getElementsByTagName("script")[0];
        var b = document.createElement("script");
        b.type = "text/javascript";b.async = true;
        b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
        s.parentNode.insertBefore(b, s);
      })();
    </script>
    <noscript>
      <img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=67421&fmt=gif" />
    </noscript>
  </body>
</html>
