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
        <a href="//polymathv.com/terms-of-use.pdf" target="_blank">Terms of use</a> &
        <a href="//polymathv.com/datos-personales.pdf" target="_blank">Privacy policy</a>
    </div>
</div>

</footer>

<?php include(locate_template("templates/element-mc-newsletter.php")); ?>
<?php include(locate_template("templates/element-mc-additional.php")); ?>

<div class="modal fade" id="person-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="row">
              <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-fw fa-times"></i></span>
              </button>
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <img class="person-picture" src="//polymathv.com/wp-content/themes/polymath_wp_theme/dist/images/Polymath_Logo_transparent.png"/>
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

  <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <style type="text/css">
    body {
      padding-top:65px;
    }
    nav.navbar {
      min-height:65px;
      background:hsla(0,0%,100%,1);
    }
    .navbar-default .navbar-header .brand img {
      margin:10px 15px;
    }
    .navbar-toggle {
      margin-top:15.5px;
      margin-bottom:15.5px;
    }
    @media(min-width:992px) {
      .navbar-default .navbar-nav li.main-menu-item>a {
        margin:19.5px 15px;
      }
    }
  </style>
  <script type="text/javascript">var _kmq = _kmq || [];
  var _kmk = _kmk || '30ea76b13f8d12819a58c1c93dc1d78a91f2a635';
  function _kms(u){
    setTimeout(function(){
      var d = document, f = d.getElementsByTagName('script')[0],
      s = d.createElement('script');
      s.type = 'text/javascript'; s.async = true; s.src = u;
      f.parentNode.insertBefore(s, f);
    }, 1);
  }
  _kms('//i.kissmetrics.com/i.js');
  _kms('//scripts.kissmetrics.com/' + _kmk + '.2.js');
  </script>