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

        <?php if (has_post_thumbnail()): ?>
            <div class="featured-image" style="background-image:url(<?php the_post_thumbnail_url( dependent_image_size() ); ?>)">
                <div class="featured-image-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <?php echo get_field('tagline') ? '<h1 class="extra-big">' . get_field('tagline') . '</h1>': ''; ?>
                                <?php echo get_field('description') ? '<p class="big">' . get_field('description') . '</p>': ''; ?>
                                <?php echo get_field('link') ? '<p class="big extra-padding-vertical"><a class="btn btn-primary" href="' . get_home_url() . '/' . get_field('link') . '">' .
                                           get_field('link_title') . '</a></p>': ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

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

          <div class="container adjust-height text-white">
                  <div class="col-sm-8 extra-padding-vertical extra-padding-horizontal dark-lila">
                      <?php if (get_field('quote')): ?>
                          <?php echo quote(array('quote' => get_field('quote'))); ?>
                      <?php endif; ?>
                  </div>
                  <div class="col-sm-4 extra-padding-vertical extra-padding-horizontal red">
                      <?php if (get_field('promo')): ?>
                          <?php echo promo(array('promo' => get_field('promo'))); ?>
                      <?php endif; ?>
                  </div>
          </div>

        </div><!-- /.wrap -->

    </div>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </div>
  </body>
</html>
