    ////////////////
// swiper
/////////////////////
;(function($, window, document, undefined) {
    "use strict";
    // one page menu
    if( $('#fullpage').length ) {
        $('.wpt-top-menu li a').on('click', function(e){
            e.preventDefault();
            var index = $( this ).data( "block" )
          $.fn.fullpage.moveTo(index );
        });
    }

    // go to home slide
    $('.wpc-go-home').on('click', function(e){
        e.preventDefault();
        
      $.fn.fullpage.moveTo('slide1', 2);
      $('.wpt-top-menu').attr('style', 'display: block;');
    });

    var content_img = $('.img-content-before').find('img').wrap('<div class="before-element-img"></div>');

    /***********************************/
    /*         ONE PAGE SCROLL         */
    /***********************************/

    $('.menu-scroll a').on('click', function() {
        $(this).parent().siblings().removeClass('active');
        var $hash = $(this).attr('href').split('#');
        if( $hash.length > 1 ) {
            $('html, body').animate({
                scrollTop: $("#" + $hash[1]).offset().top
            }, 600);
            $(this).parent().addClass('active');
            return false;
        }
    });

    $('.bg-first-part').append('<div class="background-part-contact"></div>');
    $('.team-slider-border').append('<div class="border-team-onepage"></div>');

    ///////////////
    // dropdown
    ///////////////
    $('.nav-menu-icon a').on('click', function(e) {
        e.preventDefault();
        $('#nav-toggle').toggleClass('active');
        $('.wpt_fix_footer_body').slideToggle()
        if ($('nav').hasClass('slide-menu')) {
            $('nav').removeClass('slide-menu');
            $(this).removeClass('active');
        } else {
            $('nav').addClass('slide-menu');
        }
    });

    $('.nav-menu-icon-hidden a').on('click', function(e) {
        e.preventDefault();
            $('.nav-menu-icon-hidden a i').toggleClass('active');
        if ($('.wpt-top-menu').hasClass('active')) {
            $('.wpt-top-menu').removeClass('active');
        } else {
            $('.wpt-top-menu').addClass('active');
        }
    });
    
    $('.team_item_show a').on('click', function(e) {
        e.preventDefault();
        return false;
    });

    $('.img-post').each(function() {
        var bgSrc = $(this).attr('src');
        $(this).parent().addClass('background-banner').css({
            'background-image': 'url(' + bgSrc + ')'
        });
        $(this).hide();
    });

    $('.blog_item').each(function() {

        var _this = $(this);
        if( _this.children().hasClass('post-bg') ) {
            return;
        } else {
            _this.addClass('no-bg');
        }
    });

    $('.banner-post').each(function() {

        var _this = $(this);
        if( _this.children().hasClass('img-post') ) {
            return;
        } else {
            _this.addClass('no-bg');
        }
    });
 
    /*================*/
    /* 01 - VARIABLES */
    /*================*/

    var swipers = [],
        winW, winH, winScr, $container, _isresponsive, xsPoint = 451,
        smPoint = 768,
        mdPoint = 992,
        lgPoint = 1200,
        addPoint = 1600,
        _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

    /*========================*/
    /* 02 - PAGE CALCULATIONS */
    /*========================*/
    function pageCalculations() {
        winW = $(window).width();
        winH = $(window).height();
    }

    /*=================================*/
    /* 03 - FUNCTION ON DOCUMENT READY */
    /*=================================*/
    pageCalculations();

    /*=================================*/
    /* 04 - SWIPER SLIDER */
    /*=================================*/
    function initSwiper() {
        var initIterator = 0;
        $('.swiper-container').each(function() {
            var $t = $(this);

            if ($t.find('.swiper-slide').length <= 1) { 
                $t.find('.pagination').hide(); 
                $t.find('.swiper-slide').css('width','100%');
                return 0; 
            }

            var index = 'swiper-unique-id-' + initIterator;

            $t.addClass('swiper-' + index + ' initialized').attr('id', index);
            $t.find('.pagination').addClass('pagination-' + index);

            var autoPlayVar = parseInt($t.attr('data-autoplay'), 10);
            var mode = $t.attr('data-mode');
            var centerVar = parseInt($t.attr('data-center'), 10);
            var simVar = ($t.closest('.circle-description-slide-box').length) ? false : true;

            var slidesPerViewVar = $t.attr('data-slides-per-view');
            if (slidesPerViewVar == 'responsive') {
                slidesPerViewVar = updateSlidesPerView($t);
            } else slidesPerViewVar = parseInt(slidesPerViewVar, 10);

            var loopVar = parseInt($t.attr('data-loop'), 10);
            var speedVar = parseInt($t.attr('data-speed'), 10);

            swipers['swiper-' + index] = new Swiper('.swiper-' + index, {
                speed: speedVar,
                pagination: '.pagination-' + index,
                loop: loopVar,
                paginationClickable: true,
                autoplay: autoPlayVar,
                slidesPerView: slidesPerViewVar,
                keyboardControl: true,
                calculateHeight: true,
                simulateTouch: simVar,
                roundLengths: true,
                centeredSlides: centerVar,
                mode: mode || 'horizontal',
                onInit: function(swiper) {},
                onSlideChangeEnd: function(swiper) {
                    var activeIndex = (loopVar === 1) ? swiper.activeLoopIndex : swiper.activeIndex;
                },
                onSlideChangeStart: function(swiper) {
                    $t.find('.swiper-slide.active').removeClass('active');

                    var activeIndex = (loopVar === 1) ? swiper.activeLoopIndex : swiper.activeIndex;
                },
                onSlideClick: function(swiper) {
                }
            });

            swipers['swiper-' + index].reInit();
            if (!centerVar) {
                if ($t.attr('data-slides-per-view') == 'responsive') {
                    var paginationSpan = $t.find('.pagination span');
                    var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
                    if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
                    else $t.removeClass('pagination-hidden');
                    paginationSlice.show();
                }
            }
            initIterator++;
        });

    }

    $('.slide-prev').on('click', function() {
        swipers['swiper-' + $(this).closest('.slider-wrap').find('.swiper-container').attr('id')].swipePrev();
        return false;
    });

    $('.slide-next').on('click', function() {
        swipers['swiper-' + $(this).closest('.slider-wrap').find('.swiper-container').attr('id')].swipeNext();
        return false;
    });

    function updateSlidesPerView(swiperContainer) {
        if (winW >= addPoint) return parseInt(swiperContainer.attr('data-add-slides'), 10);
        else if (winW >= lgPoint) return parseInt(swiperContainer.attr('data-lg-slides'), 10);
        else if (winW >= mdPoint) return parseInt(swiperContainer.attr('data-md-slides'), 10);
        else if (winW >= smPoint) return parseInt(swiperContainer.attr('data-sm-slides'), 10);
        else return parseInt(swiperContainer.attr('data-xs-slides'), 10);
    }


    /*============================*/
    /* WINDOW LOAD                */
    /*============================*/

    $(window).on('load', function() {

        initSwiper();

        //sub menu
        $('.menu-item').each(function() {

            var _this = $(this);

            if( _this.hasClass('menu-item-has-children') ) {
                _this.addClass('all_page');
            }
            
        });

        $('.all_page').on('click', function(e) {
            $(this).toggleClass('active');
        });

        $('.wpt_fix_footer .slide_num a:odd').addClass('color_black');

// full page slider home1
        if( $('#fullpage').length ) {
            if($(window).width()<=992 && $.fn.fullpage){
               $.fn.fullpage.setAutoScrolling(false); 
            }
        }

    });

    var top_menu = $('.wpt_page_first .wpt-top-menu');
    if( $('#fullpage').length ) {
        $('#fullpage').fullpage({
            slidesNavigation: true,
            anchors: ['slide1', 'slide2', 'slide3', 'slide4', 'slide5', 'slide6', 'slide7'],
             menu: '#myMenu',
             controlArrows: false,
             afterRender: function(anchorLink, index){
                top_menu.show(); 
             },
             onLeave: function(index, nextIndex, direction){
                var leavingSection = $(this);

                // language color 
                var color_elem = $('.wpt_fix_footer .slide_num a'),
                    leng_elem = $('.wpt_fix_footer .change_lang a:last-child'),
                    top_menu = $('.wpt_page_first .wpt-top-menu'),
                    lang_button = $('.wpt_fix_footer .change_lang'),
                    slide_botton =$('.wpt_fix_footer .next_slide a');
                   
                if(color_elem.eq(index).hasClass('color_black') ){
                    leng_elem.addClass('active_color');
                    if ($(window).width()>992) {
                    $('.wpt_page_first #nav-toggle span').addClass('color_bg');
                    $('.wpt_page_first .wpt-top-menu').addClass('color_bg');
                        
                    }
                }
                else{
                   leng_elem.removeClass('active_color');
                     if ($(window).width()>992) {
                   $('.wpt_page_first #nav-toggle span').removeClass('color_bg');
                   $('.wpt_page_first .wpt-top-menu').removeClass('color_bg');
                        
                    }
                }

                 // top menu
                if (index==2 && nextIndex != 3) {
                    slide_botton.show();
                }else  { 
                    slide_botton.hide();
                }

                if( $('#fullpage').attr('data-menu-show') != 1 ) {
                    // top menu
                    if (index==2 && nextIndex != 3) {
                        top_menu.show();
                        top_menu.show();
                    }else  { 
                        top_menu.hide();
                    }
                }

                // lang button
                if ($('#section0 ').hasClass('active')) {
                    lang_button.removeClass('active');
                   
                }else  { 
                    lang_button.addClass('active');
                }
            }
        });
    }

    /*============================*/
    /* RESIZE               */
    /*============================*/
    $(window).on('resize load', function() {

        // pre load
        $('.pre_loader').hide();

        resizeCall();
        if( $('#fullpage').length ) {
            if($(window).width()>992 && $.fn.fullpage){
                $.fn.fullpage.reBuild();
                $.fn.fullpage.setAutoScrolling(true);
            }else if($(window).width()<=992 && $.fn.fullpage){
                $.fn.fullpage.setAutoScrolling(false);
                $('.wpt_page_first .fp-section, .fp-tableCell').css('height', 'auto');

            }
        }    
    });



     function resizeCall() {
        pageCalculations();
        $('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function () {
            var thisSwiper = swipers['swiper-' + $(this).attr('id')],
                $t = $(this),
                slidesPerViewVar = updateSlidesPerView($t),
                centerVar = thisSwiper.params.centeredSlides;
            thisSwiper.params.slidesPerView = slidesPerViewVar;
            thisSwiper.reInit();
            if (!centerVar) {
                var paginationSpan = $t.find('.pagination span');
                var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
                if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
                else $t.removeClass('pagination-hidden');
                paginationSlice.show();
            }
        });
    }

    // button to down slide
    $('.wpt_fix_footer .next_slide a').on('click', function (e) {
        e.preventDefault();
        $.fn.fullpage.moveSectionDown();
    });


    // count about page

    var counters = function() {
        $(".process .process-item h2 span").not('.animated').each(function(){
            if($(window).scrollTop() >= $('.process').offset().top-$(window).height()*0.7 ) {
                $(this).addClass('animated').countTo();
            }
        });
    };


    var counters_home = function() {
        $(".stats_body .process-item h2").not('.animated').each(function(){
            if($(window).scrollTop() >= $('.process-item').offset().top-$(window).height()*0.7 ) {
                $(this).addClass('animated').countTo();
            }
        });
    };


    // popup
    if ($('.two_column .izotope_container').length) {
        $('.two_column .izotope_container').magnificPopup({
                delegate: '.item_hide a',
                type: 'image',
                removalDelay: 100,
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-fade',
                closeBtnInside: false,
                gallery: {
                    enabled: true
                }
        });
    }
    if ($('.works_body .izotope_container').length) {
        $('.works_body .izotope_container').magnificPopup({
                delegate: '.item_show a',
                type: 'image',
                removalDelay: 100,
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-fade',
                closeBtnInside: false,
                gallery: {
                    enabled: true
                }
        });
    }
    if ($('.izotope_item .izotop_hide').length) {
        $('.izotope_item .izotop_hide ').magnificPopup({
                delegate: '.izotop_hide a',
                type: 'image',
                removalDelay: 100,
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-fade',
                closeBtnInside: false,
                gallery: {
                    enabled: true
                }
        });
    }
    /////////////////
    // scroll
    ////////////////
    var noScroll = $('.wpt-top-menu2');
    var scrolSection = $('.wpt-top-menu li a');
    if ( !noScroll.length) {
 
    scrolSection.on('click touchstart', function(e) {
        e.preventDefault();
        var el = $(this).attr('href');
        $('body, html').animate({
            scrollTop: $(el).offset().top
        }, 1000);
        $('.wpt-top-menu').removeClass('active');
        return false;
    });
    }
    var scrolSectionButton = $('.home .home_scroll_elem a');
   scrolSectionButton.on('click touchstart', function(e) {
        e.preventDefault();
        var el = $(this).attr('href');
        $('body, html').animate({
            scrollTop: $(el).offset().top -80
        }, 1000);
        $('.wpt-top-menu').removeClass('active');
    });


    $(window).on('scroll resize load',function(){
        counters();
        counters_home();

    });
    $(window).on('resize load',function () {
        //////////////////
        // izotop
        /////////////////
        $('#filters ').on('click touchstart', '.but', function() {

            var izotope_container = $('.izotope_container');

            for (var i = izotope_container.length - 1; i >= 0; i--) {
                $(izotope_container[i]).find('.item').removeClass('animated');
            }

            $('#filters .but').removeClass('activbut');
            $(this).addClass('activbut');
            var filterValue = $(this).attr('data-filter');
            $container.isotope({
                filter: filterValue
            });
            return false;
        });

        if($(window).width()>768){
            $('#fullpage .izotope_item').css({
                'height': $(window).height() / 2,
                'width': ($('#fullpage .izotope_container').width() ) /2
            });
        }else{
        $('#fullpage .izotope_item').css({
                'height': $(window).height() / 2,
                'width': '50%'
            });
        }

        if($(window).width() <= 550){
            $('#fullpage .izotope_item').css({
                'height': $(window).height() / 2,
                'width': '100%'
            });
        }


        if ($('.izotope_container').length) {
            var $container = $('.izotope_container');
            $container.isotope({
                itemSelector: '.izotope_item'
            });
        }

        function wpc_add_img_bg( img_sel, parent_sel){

            if (!img_sel) {
                console.info('no img selector');
                return false;
            }
            var $parent, _this;

            $(img_sel).each(function(){
                _this = $(this);
                $parent = _this.closest( parent_sel );
                $parent = $parent.length ? $parent : _this.parent();
                $parent.css( 'background-image' , 'url(' + this.src + ')' );
                _this.hide();
            });

        }
        wpc_add_img_bg('#section3 .izotop_show img','#section3 .izotop_show');

        ////////////////////////////////////////
        // add active class for active group
        ////////////////////////////////////////////
        var active_izotop = $('.works_body .fillter_wrap .but');
        active_izotop.on('click touchstart', function(event) {
            event.preventDefault();
            active_izotop.removeClass('active');
            $(this).addClass('active');
        });
        ////////////////////////
        // show_more
        /////////////////
        var linkCopy = $('.works_body .izotope_container .izotope_item').clone();

        ///////////////
        // hide input placeholder on focus
        //////////////
        $('input,textarea').focus(function() {
            $(this).data('placeholder', $(this).attr('placeholder'))
                .attr('placeholder', '');
        }).blur(function() {
            $(this).attr('placeholder', $(this).data('placeholder'));
        });


        $(document).on("scroll", function() {
            var scrollTop = $(document).scrollTop();
            if (scrollTop > 20) {
                $('.wpt-header-menu').addClass('active');
            } else {
                $('.wpt-header-menu').removeClass('active');
            }
        });

        ///////////////////////
        // timer
        //////////////////////

        // var deadline = '2016-12-31';
        var deadline = new Date(Date.parse(new Date()) + 43 * 24 * 60 * 60 * 1000);
        // data-time
        var data_time = $('.coming-time').attr('data-time');

        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                var t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
        if ($('#clockdiv').length) {
        initializeClock('clockdiv', data_time);
        }

        ////////////////
        // google maps
        ///////////////

        if( $('#map').length ) {
          $('#map').each(function() {
            initialize(this);
          });
        }
         
        function initialize(_this) {
            
            var stylesArray = {
              //style 1
              'style-1' : [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}],
            };
         
            var styles ,map, marker, infowindow,
              lat = $(_this).attr("data-lat"),
                lng = $(_this).attr("data-lng"),
              contentString = $(_this).attr("data-string"),
              image = $(_this).attr("data-marker"),
              styles_attr = $(_this).attr("data-style"),
              zoomLevel = parseInt($(_this).attr("data-zoom"),10),
              myLatlng = new google.maps.LatLng(lat,lng);
              
         
            // style_1
            if (styles_attr == 'style-1') {
              styles = stylesArray[styles_attr];
            }
            // custom
            if (typeof antica_style_map != 'undefined' && styles_attr == 'custom') {
              styles = antica_style_map;
            }
            // or default style
            
            var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
              
            var mapOptions = {
              zoom: zoomLevel,
              disableDefaultUI: true,
              center: myLatlng,
                  scrollwheel: false,
              mapTypeControlOptions: {
                  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
              }
            };
            
            map = new google.maps.Map(_this, mapOptions);
         
            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
         
            infowindow = new google.maps.InfoWindow({
              content: contentString
            });
            
              
              marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              icon: image
            });
         
            google.maps.event.addListener(marker, 'click', function() {
              infowindow.open(map,marker);
            });
         
          }

        ////////////////
        // scroll efect  header to fixed
        ///////////////
        $(document).scroll(function() {
            var scrollTop = $(document).scrollTop();
            var menu = $('.fix_header');
            if (scrollTop > 5) {
                menu.addClass('active');
            }
            menu.removeClass('active');
        });

    });


})(jQuery, window, document);












