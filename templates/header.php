<header class="banner">
  <div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar_top">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?= esc_url(home_url('/')); ?>">
              <img src="http://www.polymathv.com/wp-content/uploads/2014/09/Polymath_Logo_transparent.png">
          </a>
        </div>

            <?php
                if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu( array(
                        'menu'              => 'primary_navigation',
                        'theme_location'    => 'primary_navigation',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'navbar_top',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                endif;
            ?>

        </div>
    </nav>
  </div>
</header>
