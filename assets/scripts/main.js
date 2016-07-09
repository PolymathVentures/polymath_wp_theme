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
                    $('#loading-modal').modal('show');
                }
              },
              onReady: {
                  duration: 0,
                  render: function ($container, $newContent) {
                      $('#loading-modal').modal('hide');
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

        // Disable jump to top for buttons with href #
        $('[href="#"]').click(function(e) {
            e.preventDefault();
        });

        //Populate button text with selected option
        $('.show-selected a').click(function(e) {

            $('.custom-button').each(function() {
                $(this).text($(this).data('label'));
            });

            var button = $(this).parents('ul').prev();
            button.text(button.data('label') + ': ' + $(this).text());
        });

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
                dots: true,
                lazyLoad: 'ondemand',
                waitForAnimate: false,
                prevArrow: '<a class="left prev ' + $("#" + carouselId).parent(".slick-container").data('arrow-bg') + '" href="#" role="button">' +
                    	        '<i class="icon-arrow-left icons"></i>' +
                    	        '<span class="sr-only">Previous</span>' +
                            '</a>',
                nextArrow: '<a class="right next ' + $("#" + carouselId).parent(".slick-container").data('arrow-bg') + '" href="#" role="button">' +
                    	        '<i class="icon-arrow-right icons"></i>' +
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

            //Center arrow in the middle of caption
            var captionHeights = $(this).find('.caption').map(function() {
                return $(this).height();
            }).get();

            var maxHeight = Math.max.apply(null, captionHeights);
            $(this).parent().find('.slick-arrow .icons').css('bottom', (maxHeight / 2) - 20);

            //adjust dots
            var dotElements = $(this).parent('.tab_slider, .timeline');

            dotElements.find('.caption').css('padding-top', 25);
            dotElements.find('.slick-dots').css('bottom', maxHeight - 10);

            $(this).parent('.personal_story').find('.slick-dots').css('bottom', 50);

            var self = $(this);
            $(this).parent().prev('.slick-control').on('hover', 'a', function (e) {
                var tab = $(this).parent('li');
                self.slick( 'slickGoTo', parseInt( tab.index() ) );
                e.preventDefault();
            });

            $(this).on('beforeChange', function(event, slick, currentSlide, nextSlide){
                self.parent().prev('.slick-control').find('li').removeClass('active');
                self.parent().prev('.slick-control').find('li:eq(' + nextSlide + ')').addClass('active');

            });

        });

        // Little hack because initializing slick slider on display: none elements doesn't work.
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var id = $(this).attr('href').replace('#', '');
            if(id) {
                $('#' + id + ' .slick').slick('setPosition');
            }
        });

        $('.show-person-modal').click(function() {

            $('#person-modal .person-title').html($(this).data('title'));
            $('#person-modal .person-description').html($(this).data('description'));
            $('#person-modal .person-picture').attr('src', $(this).data('picture'));

            $('#person-modal').modal('show');

        });

        // Get appropriate image size for screen
        $('.responsive-bg').each(function() {
            var el = $(this);
            var url = false;
            var largest = {'size': 0};

            var elWidth = el.width();
            var elHeight = el.height();

            var bgJSON = el.data('bgJson');

            if(bgJSON) { el.css('background-image', 'url(' + bgJSON.medium + ')'); }

            if(!bgJSON) { return true; }

            $.each(bgJSON, function(k, v) {

                if(k.indexOf('-') > -1) { return true; }

                var w = bgJSON[k + '-width'];
                var h = bgJSON[k + '-height'];
                var wM = w / 10;
                var hM = h / 10;

                if(w > largest.size) { largest = {'size': w, 'name': k}; }

                if(w + wM > elWidth && h + hM > elHeight) {
                    url = v;
                    return false;
                }

            });

            if(!url) { url = bgJSON[largest.name]; }
            // el.removeAttr('data-bg-json');

            var img = new Image();
            img.src = url;
            img.onload = function() {
                el.css('background-image', 'url(' + url + ')');
            };

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