<footer class="content-info purple text-center">
  <style type="text/css">
    @media (min-width: 768px) { footer .text-2 { border-right: 1px solid; } }
    footer .text-2 { height:300px; }
  </style>
  <div class="container">
      <div class="extra-padding-vertical">
        <?php dynamic_sidebar('sidebar-footer'); ?>
      </div>
  </div>

<div class="content-padding-wrapper">
    <div class="content-padding">
        &copy; Polymath Ventures 2016.
        <a href="http://www.polymathv.com/terms-of-use.pdf" target="_blank">Terms of use</a> &
        <a href="http://www.polymathv.com/privacy-policy.pdf" target="_blank">Privacy policy</a>
    </div>
</div>

</footer>

<?php include(locate_template("templates/element-mc-newsletter.php")); ?>

<div class="modal fade" id="person-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="row">
              <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <img class="person-picture" src="http://www.polymathv.com/wp-content/themes/polymath_wp_theme/dist/images/Polymath_Logo_transparent.png"/>
              </div>
              <div class="col-sm-6">
                  <h2 class="person-title">title</h2>
                  <div class="person-description">description</div>
              </div>
          </div>
    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tell-friend-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="row">
              <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="row">
              <div class="col-sm-12">
				  <?php gravity_form( 1, false, false, false, '', true); ?>
              </div>
          </div>
    </div>
    </div>
  </div>
</div>
