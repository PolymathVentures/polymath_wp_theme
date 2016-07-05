<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
  <div id="smoothstate" class="m-scene">
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
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
  </div>
  <!-- Modal -->
    <div class="modal fade text-center" id="loading-modal"
         tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">

        <!-- <img class="extra-padding-vertical" src="<?php // get_template_directory_uri(); ?>/dist/images/squares.gif"> -->

    </div>
  <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
  </body>
</html>
