
"use strict";




// Prealoder
 function prealoader () {
   if ($('#loader').length) {
     $('#loader').fadeOut(); // will first fade out the loading animation
     $('#loader-wrapper').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
     $('body').delay(350).css({'overflow':'visible'});
  };
 }


// placeholder remove
function removePlaceholder () {
  if ($("input,textarea").length) {
    $("input,textarea").each(
            function(){
                $(this).data('holder',$(this).attr('placeholder'));
                $(this).on('focusin', function() {
                    $(this).attr('placeholder','');
                });
                $(this).on('focusout', function() {
                    $(this).attr('placeholder',$(this).data('holder'));
                });
                
        });
  }
}


// Search Option
function searchbox () {
  if($("#searchDropdown").length) {
    $("#searchDropdown").on('click', function() {
      $(".search-form").toggleClass('show')
    })
    $(".close-search").on('click', function() {
      $(".search-form").removeClass('show')
    })
  }
}



// Home Page One Banner
function vegasBanner () {
  if($("#banner-slider").length) {
    $("#banner-slider").vegas({
        slides: [
            { src: "images/home/slide-1.jpg" },
            { src: "images/home/slide-2.jpg" },
            { src: "images/home/slide-1.jpg" }
        ],

        transition: [ 'fade', 'zoomOut', 'swirlLeft' ]
    });

    $('button#previous').on('click', function () {
          $("#banner-slider").vegas('options', 'transition', 'zoomOut').vegas('previous');
      });

      $('button#next').on('click', function () {
          $("#banner-slider").vegas('options', 'transition', 'slideLeft2').vegas('next');
      });

  }
}


// Date Select
function dateSelect () {
  if($(".datepicker").length) {
    $( ".datepicker" ).datepicker();
  };
}

// Time Picker
function timeSelect () {
  if ($(".timepicker").length) {
    $(".timepicker").timepicker();
  }
}


// Price Ranger 
function priceRange () {
  if ($('.price-ranger').length) {
      $( '.price-ranger .slider-range' ).slider({
        range: true,
        min: 15000,
        max: 25000,
        values: [ 16500, 22000 ],
        slide: function( event, ui ) {
          $( '.price-ranger .ranger-min-max-block .min' ).val( '$' + ui.values[ 0 ] );
          $( '.price-ranger .ranger-min-max-block .max' ).val( '$' + ui.values[ 1 ] );
        }
      });
        $( '.price-ranger .ranger-min-max-block .min' ).val( '$' + $( '.price-ranger .slider-range' ).slider( 'values', 0 ) );
      $( '.price-ranger .ranger-min-max-block .max' ).val( '$' + $( '.price-ranger .slider-range' ).slider( 'values', 1 ) );        
    };
}


// WOW animation 
function wowAnimation () {
  if($('.wow').length) {
    var wow = new WOW(
    {
      boxClass:     'wow',      // animated element css class (default is wow)
      animateClass: 'animated', // animation css class (default is animated)
      offset:       50,          // distance to the element when triggering the animation (default is 0)
      mobile:       true,       // trigger animations on mobile devices (default is true)
      live:         true,       // act on asynchronously loaded content (default is true)
      callback:     function(box) {
        // the callback is fired every time an animation is started
        // the argument that is passed in is the DOM node being animated
      },
      scrollContainer: null // optional scroll container selector, otherwise use window
    }
  );
  wow.init();
  }
}


// Mixitup gallery
function mixitupGallery () {
  if ($("#mixitUp-item").length) {
    $("#mixitUp-item").mixItUp()
  };
}


// Accordion panel
function themeAccrodion () {
  if ($('.theme-accordion > .panel').length) {
    $('.theme-accordion > .panel').on('show.bs.collapse', function (e) {
          var heading = $(this).find('.panel-heading');
          heading.addClass("active-panel");
          
    });
    
    $('.theme-accordion > .panel').on('hidden.bs.collapse', function (e) {
        var heading = $(this).find('.panel-heading');
          heading.removeClass("active-panel");
          //setProgressBar(heading.get(0).id);
    });

    $('.panel-heading a').on('click',function(e){
        if($(this).parents('.panel').children('.panel-collapse').hasClass('in')){
            e.stopPropagation();
        }
    });

  };
}


// Agent Slider
function agentSlider () {
  if($('.agent-slider').length) {
    $('.agent-slider').owlCarousel({
        loop:true,
        nav:true,
        navText:false,
        dots:false,
        autoplay:true,
        autoplayTimeout:3500,
        autoplaySpeed:1500,
        lazyLoad:true,
        items:1,
    })
  }
}

// Client Slider
function clientSlider () {
  if($('.client-slider').length) {
    $('.client-slider').owlCarousel({
        animateOut: 'fadeOutLeft',
        animateIn: 'fadeOutRight',
        loop:true,
        nav:false,
        navText:false,
        dots:true,
        autoplay:true,
        autoplayTimeout:4000,
        autoplaySpeed:1500,
        lazyLoad:true,
        items:1,
    })
  }
}


// Single gallery slider
function singleGalleryCarousel () {
  if ($('.single-gallery-carousel-content-box').length && $('.single-gallery-carousel-thumbnail-box').length) {

    var $sync1 = $(".single-gallery-carousel-content-box"),
      $sync2 = $(".single-gallery-carousel-thumbnail-box"),
      flag = false,
      duration = 500;

      $sync1
        .owlCarousel({
          items: 1,
          margin: 0,
          nav: false,
          dots: false
        })
        .on('changed.owl.carousel', function (e) {
          if (!flag) {
            flag = true;
            $sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
            flag = false;
          }
        });

      $sync2
        .owlCarousel({
          margin: 1,
          items: 7,
          nav: true,
          dots: false,
          navText:false,
          center: false,
          responsive: {
            0:{
                    items:2,
                    autoWidth: false
                },
                400:{
                    items:3,
                    autoWidth: false
                },
                768:{
                    items:4,
                    autoWidth: false
                }
            },
        })
        .on('click', '.owl-item', function () {
          $sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);

        })
        .on('changed.owl.carousel', function (e) {
          if (!flag) {
            flag = true;    
            $sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
            flag = false;
          }
        });

  };
}


// Counter function
function CounterNumberChanger () {
  var timer = $('.timer');
  if(timer.length) {
    timer.appear(function () {
      timer.countTo();
    })
  }
}

// Scroll to top
function scrollToTop () {
  if ($('.scroll-top').length) {

    //Check to see if the window is top if not then display button
    $(window).on('scroll', function (){
      if ($(this).scrollTop() > 200) {
        $('.scroll-top').fadeIn();
      } else {
        $('.scroll-top').fadeOut();
      }
    });
    
    //Click event to scroll to top
    $('.scroll-top').on('click', function() {
      $('html, body').animate({scrollTop : 0},1500);
      return false;
    });
  }
}



//Contact Form Validation
function contactFormValidation () {
  if($('.form-validation').length){
    $('.form-validation').validate({ // initialize the plugin
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        message: {
          required: true
        }
      },
      submitHandler: function(form) {
                $(form).ajaxSubmit({
                    success: function() {
                        $('.form-validation :input').attr('disabled', 'disabled');
                        $('.form-validation').fadeTo( "slow", 1, function() {
                            $(this).find(':input').attr('disabled', 'disabled');
                            $(this).find('label').css('cursor','default');
                            $('#alert_success').fadeIn();
                        });
                    },
                    error: function() {
                        $('.form-validation').fadeTo( "slow", 1, function() {
                            $('#alert_error').fadeIn();
                        });
                    }
                });
            }
        });
  }
}


// Close suddess Alret
function closeSuccessAlert () {
  if($('.closeAlert').length) {
    $(".closeAlert").on('click', function(){
      $(".alert_wrapper").fadeOut();
    });
    $(".closeAlert").on('click', function(){
      $(".alert_wrapper").fadeOut();
    })
  }
}


// Sticky header
function stickyHeader () {
  if ($('.main-menu').length) {
    var sticky = $('.main-menu'),
        scroll = $(window).scrollTop();

    if (scroll >= 190) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
    
  };
}


// toggle menu for mobile
function mobileDropdown () {
  if($('.main-menu').length) {
    $('.main-menu nav ul li.dropdown-holder').append(function () {
      return '<i class="fa fa-angle-down" aria-hidden="true"></i>';
    });
    $('.main-menu nav ul li.dropdown-holder .fa').on('click', function () {
      $(this).parent('li').children('ul').slideToggle();
    }); 
  }
}


// DOM ready function
jQuery(document).on('ready', function() {
	(function ($) {
	   removePlaceholder ();
     searchbox ();
     vegasBanner ();
     dateSelect ();
     timeSelect ();
     priceRange ();
     wowAnimation ();
     mixitupGallery ();
     themeAccrodion ();
     agentSlider ();
     clientSlider ();
     singleGalleryCarousel ();
     CounterNumberChanger ();
     scrollToTop ();
     contactFormValidation ();
     closeSuccessAlert ();
     mobileDropdown ()
  })(jQuery);
});


// Window load function
jQuery(window).on('load', function () {
   (function ($) {
		  prealoader ()
  })(jQuery);
 });


// Window scroll function
jQuery(window).on('scroll', function () {
  (function ($) {
    stickyHeader ();
  })(jQuery);
});
