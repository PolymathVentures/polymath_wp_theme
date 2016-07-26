<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
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
  </body>
</html>
