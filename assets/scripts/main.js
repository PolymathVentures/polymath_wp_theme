/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
          var ssOptions = {
              debug: true,
              prefetch: true,
              cacheLength: 4,
              scroll: false,
              onStart: {
                  duration: 250,
                  render: function ($container) {
                      $container.addClass('is-exiting');
                      smoothState.restartCSSAnimations();
                  }
              },
              onProgress: {
                duration: 0,
                render: function ($container) {
                    $('#smoothstate').append('<div class="text-center"><h1>Loading, one second please...</h1></div>');
                }
              },
              onReady: {
                  duration: 0,
                  render: function ($container, $newContent) {
                      $container.removeClass('is-exiting');
                      $container.html($newContent);

                      //body_classes is passed to this script from setup.php
                      $('body').removeClass().addClass(body_classes.join(' '));

                      //reset slider for correct display
                      $('.slick').slick('setPosition');
                  }
              }
          };
          //TODO: This causes a depreciation warning XMLhttprequest because script is loaded in footer. Switch to header
          smoothState = $('#smoothstate').smoothState(ssOptions).data('smoothState');
      },
      finalize: function() {

        $('.mixitup-container').mixItUp({
            // animation: {
            //     enable: false
            // }
        });

        $('.slick').each(function (idx, item) {
            var carouselId = "carousel" + idx;
            this.id = carouselId;
            $(this).slick({
                slide: "#" + carouselId +" .slide",
                appendArrows: $("#" + carouselId).parent(".slick-container"),
                prevArrow: '<a class="left prev" href="#" role="button">' +
                    	        '<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>' +
                    	        '<span class="sr-only">Previous</span>' +
                            '</a>',
                nextArrow: '<a class="right next" href="#" role="button">' +
                    	        '<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>' +
                    	        '<span class="sr-only">Next</span>' +
                            '</a>',
                responsive: [{
                    breakpoint: 767,
                    settings: {
                    slidesToShow: 1,
                    arrows: false
                    }
                }]
            });

            var self = $(this);
            $('.slick-control a').click(function (e) {
                var slideIndex = $(this).parent('li').index();
                self.slick( 'slickGoTo', parseInt( slideIndex ) );
                e.preventDefault();
            });

        });

        // Little hack because initializing slick slider on display: none elements doesn't work.
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var id = $(this).attr('href').replace('#', '');
            $('#' + id + ' .slick').slick('setPosition');
        });

      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us
    //TODO: This is currently not working because of smoothstate. The body classes will always be one page behind.
    'post_type_archive_team_members': {
      finalize: function() {
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
