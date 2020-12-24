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
    if($('#js-a1xploretv-k-slider').length > 0) {
        var slider = $('#js-a1xploretv-k-slider');
         slider.slick({
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
    }

    if($('#js-a1xploretv-l-slider').length > 0) {
         $('#js-a1xploretv-l-slider').slick({
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

        jQuery("#productInfo").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            speed: 260,
            fade: true,
            initialSlide: 0,
            asNavFor: '.a1xploretv-l-slider'
        });


        // combine slick and spatialnavigation
        $('#js-a1xploretv-l-slider .slick-slide').each(function(){
            $(this).on('sn:willmove', function(evt){
                if(evt.detail.direction == 'right'){
                    $("#js-a1xploretv-l-slider").slick('slickNext');
                } else if(evt.detail.direction == 'left'){
                    $("#js-a1xploretv-l-slider").slick('slickPrev');
                }
            })
        });

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

        console.log(evt.target, evt.detail);

   };

   validEvents.forEach(function(type) {
      window.addEventListener(type, eventHandler);
   });
   /*end*/


   function scrollSmooth(section) {
       $(section).on('sn:willfocus', function() {
           $('html, body').animate({
               scrollTop: $(this).offset().top - ($(window).height() - $(this).outerHeight(true)) / 3
           }, 500);
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


    $('#js-a1xploretv-d-start').on('click sn:enter-down', function() {
            // Add "clicking" style.
            $('#js-a1xploretv-d-video').trigger('play');
            $('#js-a1xploretv-d-content').fadeTo("fast", 0);
    });

   // Make the *currently existing* navigable elements focusable.
   //SpatialNavigation.makeFocusable();



   // Focus the first navigable element.
   SpatialNavigation.focus();


   $('#js-a1xploretv-d-video').on('ended', function(){
      $('#js-a1xploretv-d-content').fadeTo("fast",1);
   });

})(jQuery); // End of use strict
