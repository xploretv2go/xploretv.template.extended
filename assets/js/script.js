(function($) {
  "use strict"; // Start of use strict

    //time
    function a1xploretvTime() {
      var currentdate = new Date();
      var minutes = currentdate.getMinutes();
          minutes = minutes > 9 ? minutes : '0' + minutes;
      var time = currentdate.getHours() + ":" + minutes;

      $('#js-a1xploretv-date-time .js-a1xploretv-time').text(time);

      setTimeout(a1xploretvTime, 1000);
    };
    function a1xploretvDate() {
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      var currentdate = new Date();
      var day = currentdate.toLocaleDateString("de-AT", options);

      $('#js-a1xploretv-date-time .js-a1xploretv-date').text(day);
    }
    if($('#js-a1xploretv-date-time').length > 0) {
      a1xploretvTime();
      a1xploretvDate();
    }

    // slider
    if($('.js-a1xploretv-k-slider').length > 0) {
        var slider = $('.js-a1xploretv-k-slider');
        $(slider).each(function(){
            console.log('admin');
         slider.not('.slick-initialized').slick({
           infinite: true,
           slidesToShow: 1,
           slidesToScroll: 1,
           centerMode: true,
           centerPadding: '25px',
           focusOnSelect: true,
           variableWidth: true,
           dots: false,
           arrows: false
         })
       });
    }

    if($('.js-a1xploretv-l-slider').length > 0) {
        $('.js-a1xploretv-l-slider').each(function(index){
            $(this).addClass('a1xploretv-l-slider_'+index);
            $('.js-a1xploretv-l-slider').not('.slick-initialized').slick({
                  accessibility: false,
                  infinite:true,
                  slidesToShow: 4,
                  slidesToScroll: 1,
                  centerMode: true,
                  speed:300,
                  asNavFor: '.productInfo',
                  initialSlide: 0,
                  centerPadding: '225px',
                  focusOnSelect: true,
                  dots: false,
                  arrows: false,
                  responsive: [
                               {
                                   breakpoint: 1300,
                                   settings: {
                                       centerPadding: '125px',
                                   }
                               },
                           ]
            })

            $('.a1xploretv-l-slider_'+index+' .slick-slide').each(function(){
                $(this).on('sn:willmove', function(evt){
                    if(evt.detail.direction == 'right'){
                        $('.a1xploretv-l-slider_'+index+'#js-a1xploretv-l-slider').slick('slickNext');
                    } else if(evt.detail.direction == 'left'){
                        $('.a1xploretv-l-slider_'+index+'#js-a1xploretv-l-slider').slick('slickPrev');
                    }
                })
            });


        });

        if($('.productInfo').length > 0) {
            $('.productInfo').each(function(index){
                $(".productInfo").not('.slick-initialized').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    speed: 260,
                    fade: true,
                    initialSlide: 0,
                    asNavFor: '.a1xploretv-l-slider_'+index
                });
            });
        };


    }

    $('.a1xploretv-e-radio-ui').on('sn:focused',function(){
       $('.a1xploretv-e-radio').find('input').each(function(){
           $(this).prop('checked', false);
       })
       $(this).parent().find('input').prop('checked', true);
    });


    $('.a1xploretv-e-checkbox').on('sn:enter-down',function(){
        if($(this).find('input').prop('checked') == true) {
            $(this).find('input').prop('checked', false);
        } else {
            $(this).find('input').prop('checked', true);
        }
    });

    // Send contact form
    $(".myForm").submit(function(e) {
      e.preventDefault();
      var form = $(this);
      var form_data = $(this).serializeArray();
      var method = form.attr('method');
      var url = form.attr('action');

      $.ajax({
        method: method,
        url: url,
        data: form_data,
        success: function(data) {
          //if (data === 'success') {
              $( ".response" ).html( '<h3>' + data + '</h3>' );
              $( ".myForm" ).hide();
          //}
        },
        error: function( jqXHR, textStatus) {
          alert( "Request failed: " + textStatus );
        }
      });
    });

    // Initialize
    SpatialNavigation.init();

    //Define navigable elements (anchors and elements with "focusable" class).
    SpatialNavigation.add({
        id:'main',
        selector: '.focusable'
    });

    /*debugging*/
    var validEvents = [
         'sn:willmove',
         'sn:willunfocus',
         'sn:unfocused',
         'sn:willfocus',
         'sn:focused',
         'sn:enter-down',
         'sn:enter-up',
         'sn:navigatefailed'
       ];

   var eventHandler = function(evt) {

        //console.log(evt);

   };

   validEvents.forEach(function(type) {
      window.addEventListener(type, eventHandler);
   });
   /*end*/


   function scrollSmooth(section) {
       $(section).on('sn:willfocus', function() {
       if($(this).closest( "section" ).offset().top > 720) {
          var val = $(this).closest( "section" ).offset().top - ($(window).height() - $(this).closest( "section" ).outerHeight(true)) / 2.5;
           $('html, body').animate({
               scrollTop: val
           }, 300);
       } else {
           $('html, body').animate({
               scrollTop: 0
           }, 300);
       }
       });
   }

   var sections = [
       '.focusable'
       // '#a1xploretv-f-f-first',
       // '#set-first',
       // '#a1xploretv-g-btn1',
       // '#js-a1xploretv-d-start',
       // '#a1xploretv-h-btn'
   ]

   sections.forEach(function(value){
       scrollSmooth(value);
   });


    $('.js-a1xploretv-d-start').on('click sn:enter-down', function() {
            // Add "clicking" style.
            if($(this).parent().parent().parent().find('.js-a1xploretv-d-video').length > 0) {
                $(this).parent().parent().parent().find('.js-a1xploretv-d-video').trigger('play');
                $(this).parent().parent().parent().find('.js-a1xploretv-d-content').fadeTo("fast", 0);
            } else {
                var link = $(this).parent().parent().parent().find('iframe').attr('data-src');
                var type = $(this).parent().parent().parent().find('iframe').attr('data-type');
                if(type=='youtube') {
                    $(this).parent().parent().parent().find('iframe').attr('src',link + '?autoplay=1&mute=1');
                } else {
                    $(this).parent().parent().parent().find('iframe').attr('src',link + '?autoplay=1&loop=0');
                }
                $(this).parent().parent().parent().find('.js-a1xploretv-d-content').fadeTo("fast", 0);
            }
    });

    // // custom for video down
    // if($('#a1xploretv-video-section').next().find('#set-first').length > 0){
    //     $('#js-a1xploretv-d-start').attr('data-sn-down','#set-first');
    // };
    //
    // // custom for slider up
    // if($('.a1xploretv-l').prev().find('#js-a1xploretv-d-start').length > 0){
    //     $('#js-a1xploretv-l-slider img').each(function(){
    //         $(this).attr('data-sn-up','#js-a1xploretv-d-start');
    //
    //     });
    // };

   // Make the *currently existing* navigable elements focusable.
   //SpatialNavigation.makeFocusable();



   // Focus the first navigable element.
   SpatialNavigation.focus();





   $('.js-a1xploretv-d-video').on('ended', function(){
      $('.js-a1xploretv-d-content').fadeTo("fast",1);
   });

   window.addEventListener("keyup", function(e){ if(e.keyCode == 27) history.back(); }, false);

})(jQuery); // End of use strict
