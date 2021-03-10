;(function($) {
    "use strict";

    // Set a fallback element to first element.
    var fallback_element = $('#section_0 .focusable:first');
    var keepinfocus_interval = null;

    // Initialize.
    SpatialNavigation.init();

    // Navigable elements are initialized in _functions/section_X.php

    // Make the *currently existing* navigable elements focusable.
    SpatialNavigation.makeFocusable();

    // Focus the first navigable element.
    SpatialNavigation.pause();
    setTimeout(function(){
        SpatialNavigation.focus(fallback_element);
        fallback_element.focus();
        SpatialNavigation.resume();
        //keepinfocus_interval = setInterval(keepInFocus, 100);
    }, 250);

    function keepInFocus() {
        if ($(document.activeElement).hasClass('focusable')) {
            // Set active element as fallback.
            fallback_element = $(document.activeElement);
        } else {
            SpatialNavigation.focus(fallback_element);
            fallback_element.focus();
        }
        // Check if focused element is in the viewport.
        var screenHeight = $(window).height();
        var windowOffset = $(window).scrollTop();
        var elementHeight = fallback_element.outerHeight();
        var elementOffset = fallback_element.offset().top;
        var targetScrollTop = 0;
        if ((elementOffset + elementHeight + 60) >= (windowOffset + screenHeight) || elementOffset < windowOffset) {
            targetScrollTop = elementOffset - (screenHeight - elementHeight) + 60;
            // Always scroll to absolute top if there is only a very small distance.
            if (targetScrollTop < 100) {
                targetScrollTop = 0;
            }
            // All done!
            $('html, body').scrollTop(targetScrollTop);
        }
    }

    // All valid events.
    var validEvents = [
        'sn:willmove',
        'sn:willunfocus',
        'sn:unfocused',
        'sn:willfocus',
        'sn:focused',
        'sn:enter-down',
        'sn:enter-up',
        'sn:navigatefailed',
        'keypress',
        'keydown',
        'keyup',
        'onblur'
     ];

    var eventHandler = function(evt) {

        if (evt.type == 'sn:willfocus') {
            // Scroll to active section.
            var screenHeight = $(window).height();
            var sectionHeight = $(evt.target).closest('section').outerHeight();
            var sectionOffset = $(evt.target).closest('section').offset().top;
            var elementHeight = $(evt.target).outerHeight();
            var elementOffset = $(evt.target).offset().top;
            var targetScrollTop = 0;
            // Scroll to top of section by default.
            targetScrollTop = sectionOffset;
            // Scroll back a little if the section height is smaller as the screen height.
            if (sectionHeight < screenHeight) {
                targetScrollTop = targetScrollTop - (screenHeight/2) + (sectionHeight/2);
            }
            // Scroll if an element within a section is out of the viewport.
            if (sectionHeight >= screenHeight) {
                if ((elementOffset + elementHeight + 60) >= (sectionOffset + screenHeight)) {
                    targetScrollTop = elementOffset - (screenHeight - elementHeight) + 60;
                }
            }
            // Always scroll to absolute top if there is only a very small distance.
            if (targetScrollTop < 100) {
                targetScrollTop = 0;
            }
            // All done!
            $('html, body').animate({
                scrollTop: targetScrollTop
            }, {
                queue: false
            }, 500);

        }

        // Focus on input type text via helper element.
        if ($(evt.target).is('a.input-wrapper')) {
            if (evt.type == 'sn:enter-up') {
                evt.preventDefault();
                if ($(evt.target).hasClass('just-exited')) {
                    $(evt.target).removeClass('just-exited')
                    return false;
                }
                $(evt.target).hide();
                SpatialNavigation.focus($(evt.target).next('input'));
                $(evt.target).next('input').focus();
                $(evt.target).next('input').get(0).setSelectionRange(0, 0); // Set cursor to the beginning.
                SpatialNavigation.pause();
                return false;
            }
        }

        // Leave input type text and reactivate helper element.
        if ($(evt.target).is('input[type="text"]')) {
            if (evt.key == 'ArrowDown' || evt.key == 'ArrowUp' || evt.key == 'Escape' || evt.key == 'Enter') {
                evt.preventDefault();
                $(evt.target).blur();
                $(evt.target).prev().show();
                $(evt.target).prev().addClass('just-exited');
                $(evt.target).prev().focus();
                SpatialNavigation.focus($(evt.target).prev());
                SpatialNavigation.resume();
                return false;
            }
        }

        // Prevent opening a link if attribute href is empty.
        if (evt.type == 'sn:enter-down') {
            if ($(evt.srcElement).attr('href') && $(evt.srcElement).attr('href') == '') {
                evt.preventDefault();
                return false;
            }
        }

        if (evt.type == 'sn:focused') {
            // Pause video on change focus Youtube/Vimeo.
            $('.js-video-global-pause').each(function() {
                if($(this).hasClass('slider-video-play') || $(this).hasClass('vimeo-video-play')) {
                    $(this).trigger('click');
                }
            });

            $('video').each(function() {
                $(this).trigger('pause');
                $(this).attr('currentTime', 0);
                $(this).trigger('load');
                $('.js-xploretv-d-content').fadeTo("fast",1);
            })
        };
    };

    validEvents.forEach(function(type) {
        window.addEventListener(type, eventHandler);
    });

    // Time
    function xploretvTime() {
        var currentdate = new Date();
        var minutes = currentdate.getMinutes();
        minutes = minutes > 9 ? minutes : '0' + minutes;
        var time = currentdate.getHours() + ":" + minutes;

        $('#js-xploretv-date-time .js-xploretv-time').text(time);

        setTimeout(xploretvTime, 1000);
    };

    // Date
    function xploretvDate() {
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        var currentdate = new Date();
        var day = currentdate.toLocaleDateString("de-AT", options);

        $('#js-xploretv-date-time .js-xploretv-date').text(day);
    }

    if($('#js-xploretv-date-time').length > 0) {
        xploretvTime();
        xploretvDate();
    }

    // History back on [ESC].
    //window.addEventListener("keyup", function(e){ if(e.keyCode == 27) history.back(); }, false);



}(jQuery));

function getCookie(name) {
    var dc = document.cookie;
    var prefix = name + "=";
    var begin = dc.indexOf("; " + prefix);
    if (begin == -1) {
        begin = dc.indexOf(prefix);
        if (begin != 0) return null;
    }
    else
    {
        begin += 2;
        var end = document.cookie.indexOf(";", begin);
        if (end == -1) {
            end = dc.length;
        }
    }
    return decodeURI(dc.substring(begin + prefix.length, end));
}
;;(function($) {
    "use strict";

    if ($('.js-xploretv-b-slider').length > 0) {
        var slider = $('.js-xploretv-b-slider');
        $(slider).each(function(index){
            $(this).addClass('xploretv-b-slider_'+index);
            $(this).not('.slick-initialized').slick({
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: '25px',
                initialSlide: 0,
                focusOnSelect: true,
                variableWidth: true,
                dots: false,
                arrows: false
            });

            $('.xploretv-b-slider_'+index).each(function(){
                $(this).on('beforeChange',function(event){
                    SpatialNavigation.pause();
                });
                $(this).on('afterChange',function(event){
                    SpatialNavigation.resume();
                    SpatialNavigation.focus($(this).find('.slick-current'));
                });
            });

        });
    }
}(jQuery));
;;(function($) {
    "use strict";
    
    //  Default Video
    $('.js-xploretv-d-start.loc-video').on('click sn:enter-down', function() {
        if ($(this).parent().parent().parent().parent().find('.js-xploretv-d-video.loc-video').length > 0) {
            $(this).parent().parent().parent().parent().find('.js-xploretv-d-video.loc-video').trigger('play');
            $(this).parent().parent().parent('.js-xploretv-d-content').fadeTo('fast', 0);
        }
    });

    $('.js-xploretv-d-video.loc-video').on('ended', function(){
        $('.js-xploretv-d-content').fadeTo("fast", 1);
        $(this).trigger('load');
    });
}(jQuery));
;;(function($) {
    "use strict";

    if($('.js-xploretv-e-slider').length > 0) {
        $('.js-xploretv-e-slider').each(function(index) {
            $(this).addClass('xploretv-e-slider_'+index);
            var childs = $(this).find('.product').length;
            if (childs > 4) {
                $(this).not('.slick-initialized').slick({
                      accessibility: false,
                      infinite: true,
                      slidesToShow: 4,
                      slidesToScroll: 1,
                      centerMode: true,
                      speed: 300,
                      asNavFor: '.product-info',
                      initialSlide: 0,
                      centerPadding: '225px',
                      focusOnSelect: true,
                      dots: false,
                      arrows: false,
                      responsive: [{
                           breakpoint: 1300,
                           settings: {
                               centerPadding: '125px',
                           }
                       }]
                })
            } else {
                $(this).not('.slick-initialized').slick({
                      accessibility: false,
                      infinite: true,
                      slidesToShow: 3,
                      slidesToScroll: 1,
                      centerMode: true,
                      speed: 300,
                      asNavFor: '.product-info',
                      initialSlide: 0,
                      centerPadding: '225px',
                      focusOnSelect: true,
                      dots: false,
                      arrows: false,
                      responsive: [{
                          breakpoint: 1300,
                          settings: {
                              centerPadding: '125px',
                          }
                      }]
                })
            }

            $('.xploretv-e-slider_'+index+' .slick-slide').each(function(){
                $(this).on('sn:willmove', function(evt){
                    if(evt.detail.direction == 'right'){
                        $('.xploretv-e-slider_'+index+'#js-xploretv-e-slider').slick('slickNext');
                    } else if(evt.detail.direction == 'left'){
                        $('.xploretv-e-slider_'+index+'#js-xploretv-e-slider').slick('slickPrev');
                    }
                })
            });
        });
    }

    if ($('.product-info').length > 0) {
        $('.product-info').each(function(index){
            $(".product-info").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                speed: 260,
                fade: true,
                initialSlide: 0,
                asNavFor: '.xploretv-e-slider_'+index
            });
        });
    };
}(jQuery));
;;(function($) {
    "use strict";

    //Checkboxes
    $('.xploretv-g-radio-ui').on('sn:focused',function(){
        $('.xploretv-g-radio').find('input').each(function(){
            $(this).prop('checked', false);
        })
        $(this).parent().find('input').prop('checked', true);
     });

     $('.xploretv-g-checkbox').on('sn:enter-down',function(){
         if($(this).find('input').prop('checked') == true) {
             $(this).find('input').prop('checked', false);
         } else {
             $(this).find('input').prop('checked', true);
         }
     });

     // Radio buttons.
     $(".radio .xploretv-g-checkbox").on('sn:enter-down', function(){
         $(this).closest('.radio').find('input').prop("checked", false);
         $(this).find('input').prop("checked", true);
     });

     // Send form.
     $(".myForm").submit(function(e) {
         e.preventDefault();
         var form = $(this);
         var form_data = $(this).serializeArray();
         var method = form.attr('method');
         var url = form.attr('action');
         var form_valid = true;

         // Form validation.
         $('.xploretv-g-checkbox-group.required').each(function( index, value ){
             var is_checked = $(this).find('input:checkbox:checked').length;
             if (is_checked == 0) {
                 $(this).find('p.has-error').removeClass('hidden');
                 form_valid = false;
             } else {
                 $(this).find('p.has-error').addClass('hidden');
             }
         });

         $('.xploretv-g-radio-group.required').each(function( index, value ){
             var is_checked = $(this).find('input:checkbox:checked').length;
             if (is_checked == 0) {
                 $(this).find('p.has-error').removeClass('hidden');
                 form_valid = false;
             } else {
                 $(this).find('p.has-error').addClass('hidden');
             }
         });

         if (form_valid) {
             $.ajax({
                 method: method,
                 url: url,
                 data: form_data,
                 success: function(data) {
                     form.next( ".response" ).fadeIn();
                     if (data === 'success') {
                         form.hide();
                     } else {
                         form.next( ".response" ).html('<h3>' + data + '</h3>');
                     }
                 },
                 error: function( jqXHR, textStatus) {
                     form.next( ".response" ).fadeIn();
                     form.next( ".response" ).html('<h3>' + textStatus + '</h3>');
                 }
             });
         }
     });
}(jQuery));
;;(function($) {
    "use strict";

    if ($('.js-xploretv-k-slider').length > 0) {
        var slider = $('.js-xploretv-k-slider');
        $(slider).each(function(){
            slider.not('.slick-initialized').slick({
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: true,
                centerPadding: '25px',
                initialSlide: 0,
                focusOnSelect: true,
                variableWidth: true,
                dots: false,
                arrows: false
            });
        });
    }
}(jQuery));
