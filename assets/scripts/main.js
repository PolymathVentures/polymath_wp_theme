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

      },
      finalize: function() {

          function calculateHeights() {
              // Code to make all elements equal heights
              var allHeights = {};
              $('.calc-height').each(function() {
                  var heightGroup = $(this).data('height-group');
                  var height = $(this).height();
                  if(allHeights[heightGroup]) {
                      allHeights[heightGroup].push(height);
                  } else {
                      allHeights[heightGroup] = [height];
                  }
              });

              $.each(allHeights, function(key, val) {
                  var maxHeight = Math.max.apply(null, val);
                  $("[data-height-group='" + key + "']").height(maxHeight);
              });
          }

        // Disable jump to top for buttons with href #
        $('[href="#"]').click(function(e) {
            e.preventDefault();
        });

        var lg = $( window ).width() >= 977;
        $('.menu-item.dropdown').mouseover(function(e) {
            if(!$(this).hasClass('open') && lg) {
                $(this).find('.dropdown-toggle').dropdown('toggle');
            }
        }).mouseleave(function(e) {
            if($(this).hasClass('open') && lg) {
                $(this).find('.dropdown-toggle').dropdown('toggle');
            }
        });

        //re-enable click on dropdown parent
        $('.dropdown-toggle').click(function(e) {
            if(lg) {
                window.location.href = $(this).attr('href');
            }
        });

        //Populate button text with selected option
        $('.show-selected a').click(function(e) {

            $('.custom-button').each(function() {
                $(this).text($(this).data('label'));
            });

            var button = $(this).parents('ul').prev();
            button.text(button.data('label') + ': ' + $(this).text());
        });

        var startFilter = $('.mixitup-container').data('start-filter');
        $('.mixitup-container').mixItUp({
            load: {
        		filter: startFilter
        	}
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
                        arrows: false,
                        dots: true
                    }
                }]
            });

            //Center arrow in the middle of caption
            var captionHeights = $(this).find('.caption').map(function() {
                return $(this).height();
            }).get();

            var maxHeight = Math.max.apply(null, captionHeights);
            var bottomOffset = (maxHeight / 2) - 20;

            if($(this).parents('.slick-container').hasClass('personal_story')) {
                bottomOffset = bottomOffset + 40;
            }

            $(this).parent().find('.slick-arrow .icons').css('bottom', bottomOffset);

            //adjust dots
            var dotElements = $(this).parent('.tab_slider.dots, .timeline.dots');

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

        if ($('.mixitup-container').length) {
            $('.mixitup-container').on('mixEnd', function(e, state){
                calculateHeights();
            });
        } else {
            calculateHeights();
        }



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

            var sizes = [];
            var sizeKeys = {};
            $.each(bgJSON, function(k, v) {

                sizeOptions = ['medium', 'large', 'medium_large', 'extra_large', 'original'];
                if(sizeOptions.indexOf(k) === -1) { return true; }
                sizes.push(bgJSON[k + '-width']);
                sizeKeys[bgJSON[k + '-width']] = k;

            });

            sizes.sort(function(a,b){return a - b;});

            $.each(sizes, function(v) {

                var k = sizeKeys[sizes[v]];

                var w = bgJSON[k + '-width'];
                var h = bgJSON[k + '-height'];
                var wM = w / 10;
                var hM = h / 10;

                if(w > largest.size) { largest = {'size': w, 'name': k}; }

                if(w + wM > elWidth && h + hM > elHeight) {
                    url = bgJSON[k];
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