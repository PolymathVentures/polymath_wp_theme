<div class="row extra-row-padding">
    <div class="col-md-12">
        <?php echo post_list(array('maximum' => 3)); ?>
    </div>
</div>

<div class="row text-center extra-row-padding">
    <div class="col-md-12">
        <h1>HOW WE BUILD</h1>
        <p class="lead">We're here to build incredible companies</p>

        <div class="row extra-row-padding">
            <div class="col-sm-2 col-sm-offset-1 col-xs-6">
                <img src="http://localhost/polymathv/wp-content/uploads/2016/05/iMac-icon-300x300.png" width="100%"><br />
                <strong>DESIGN</strong><br />
                THE COMPANY
            </div>
            <div class="col-sm-2 col-xs-6">
                <img src="http://localhost/polymathv/wp-content/uploads/2016/05/iMac-icon-300x300.png" width="100%"><br />
                <strong>DESIGN</strong><br />
                THE COMPANY
            </div>
            <div class="col-sm-2 col-xs-6">
                <img src="http://localhost/polymathv/wp-content/uploads/2016/05/iMac-icon-300x300.png" width="100%"><br />
                <strong>DESIGN</strong><br />
                THE COMPANY
            </div>
            <div class="col-sm-2 col-xs-6">
                <img src="http://localhost/polymathv/wp-content/uploads/2016/05/iMac-icon-300x300.png" width="100%"><br />
                <strong>DESIGN</strong><br />
                THE COMPANY
            </div>
            <div class="col-sm-2 col-sm-offset-0 col-xs-6 col-xs-offset-3">
                <img src="http://localhost/polymathv/wp-content/uploads/2016/05/iMac-icon-300x300.png" width="100%"><br />
                <strong>DESIGN</strong><br />
                THE COMPANY
            </div>
        </div>

        <p><a href="/about" class="btn btn-primary">Learn more</a></p>
    </div>
</div>

<div class="row extra-row-padding lila">
    <div class="col-md-12">
        <?php team_members_slider(); ?>
    </div>
</div>

<div class="row adjust-height">
    <div class="col-sm-8 extra-row-padding dark-lila">
        <?php echo quote(array('quote' => get_field('quote'))); ?>
    </div>
    <div class="col-sm-4 extra-row-padding red">
        <?php echo promo(array('promo' => get_field('promo'))); ?>
    </div>
</div>
<?php the_content(); ?>
