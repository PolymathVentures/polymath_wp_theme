<footer class="content-info purple text-center">
  <div class="container">
      <div class="extra-padding-vertical">
        <?php dynamic_sidebar('sidebar-footer'); ?>
      </div>
  </div>
</footer>

<div class="modal fade" id="person-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="row">
              <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <img class="person-picture" />
              </div>
              <div class="col-sm-6">
                  <h2 class="person-title"></h2>
                  <div class="person-description"></div>
              </div>
          </div>
    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="tell-friend-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
