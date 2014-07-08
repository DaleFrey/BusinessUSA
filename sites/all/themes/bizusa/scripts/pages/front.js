(function ($) {
	$(document).ready(function(){


		/****************************************
		***   OLD DESKTOP RESOLUTION STUFF   ****
		****************************************/
        var oldDesktopWizards = function(){
    		if(windowWidth > 1024 || $('body').hasClass('ie8')){
                (function(){

                    /* Wizard List Wrappers - wizardhighlight, wizardstandard and wizardbacklight divs */
                    /* wizards in the spotlight */
                    var classList1 = [],
                        classList2 = [],
                        classList3 = [],
                        classMaker = function(selected, array){
                            var className  = $(selected).attr('class');
                            className = className.split(' ');
                            className = ".view-wizard-list ." + className[1];
                            array.push(className);
                        };         
                    $('.view-wizard-list .views-row').each(function(i){
                        if(i < 2){
                            classMaker($(this), classList1);
                        }
                        else if(i >= 2 && i < 10){
                            classMaker($(this), classList2);
                        }
                        else if(i >= 10){
                            classMaker($(this), classList3);
                        }
                    });
                    $(classList1.join(", ")).wrapAll('<div class="wizardSpotlight" />');
                    $(classList2.join(", ")).wrapAll('<div class="wizardStandard" />');
                    $(classList3.join(", ")).wrapAll('<div class="wizardBacklight" />');

                    /* Front Page - wizards - Add Launch Wizard Link for Highlighted Items */
                    $('.wizardSpotlight .views-row').each(function(){
                        var linkVal = $(this).find('.views-field-title a').attr('href');
                        $(this).find('.views-field-field-summary').after('<a href="' + linkVal + '" class="wizardLink" >Launch the Wizard </a>')
                    });



                    /* Font Page - wizards - Hover over backlight items */
                    if(windowWidth > 768 || $('body').hasClass('ie8')){
                        $('.wizardBacklight .views-row').hoverIntent(
                            function(){
                                $(this).find('.views-field-title, .views-field-title .field-content, .views-field-title .field-content a').andSelf().animate({
                                    width: "242px",
                                    backgroundColor: "#97e8c1",
                                    opacity: "1"
                                }, 200);
                        },  function(){
                                $(this).find('.views-field-title, .views-field-title .field-content, .views-field-title .field-content a').andSelf().animate({
                                    width: "54px",
                                    backgroundColor: "#6885a2",
                                    opacity: "0.85"
                                }, 200);
                        });
                    }

                    /* Front Page - Carousel */
                    $('#carousel .slider').bxSlider({
                        controls: false,
                        auto: true,
                        autoStart: true
                    });

                })();
    		}
        }

		/******************************************
		 ***   DESKTOP AND TABLET RESOLUTION   ****
		 *****************************************/
		if(windowWidth >= 768 || $('body').hasClass('ie8') ){
            (function(){

                /* Wizard List Wrappers - wizardhighlight, wizardstandard and wizardbacklight divs */
                /* wizards in the spotlight */
                var classList1 = [],
                    classList2 = [],
                    classList3 = [],
                    classMaker = function(selected, array){
                        var className  = $(selected).attr('class');
                        className = className.split(' ');
                        className = ".view-wizard-list ." + className[1];
                        array.push(className);
                    };         
                $('.view-wizard-list .views-row').each(function(i){
                    if(i < 2){
                        classMaker($(this), classList1);
                    }
                    else if(i >= 2 && i < 9){
                        classMaker($(this), classList2);
                    }
                    else if(i >= 9){
                        classMaker($(this), classList3);
                    }
                });
                $(classList1.join(", ")).wrapAll('<div class="wizardSpotlight" />');
                $(classList2.join(", ")).wrapAll('<div class="wizardStandard" />');
                $(classList3.join(", ")).wrapAll('<div class="wizardStandard" />');
                $('.view-wizard-list .wizardStandard').wrapAll('<div class="menuMore" />');
                $('.menuMore').wrap('<div class="menuMoreWrap" />');
                $('.view-wizard-list .menuMore').bxSlider({
                    controls: true
                });

                /* Front Page - Add Launch Wizard Link for Highlighted Items */
                $('.wizardSpotlight .views-row').each(function(){
                    var linkVal = $(this).find('.views-field-title a').attr('href');
                    $(this).find('.views-field-field-summary').after('<a href="' + linkVal + '" class="wizardLink" >Launch the Wizard </a>');
                });

                /* Front Page - Add Class for Backlight Wizard Row Items */
                $('.wizardBacklight .views-row .views-field-title a').each(function(){
                    var className = $(this).attr('href');
                    className = className.substring(10);
                    $(this).parent().parent().parent().addClass(className);
                });

                /* Font Page - Hover over backlight items */
                if(windowWidth > 768){
                    $('.wizardBacklight .views-row').hoverIntent(
                        function(){
                            $(this).find('.views-field-title, .views-field-title .field-content, .views-field-title .field-content a').andSelf().animate({
                                width: "242px",
                                backgroundColor: "#97e8c1",
                                opacity: "1"
                            }, 200);
                    },  function(){
                            $(this).find('.views-field-title, .views-field-title .field-content, .views-field-title .field-content a').andSelf().animate({
                                width: "54px",
                                backgroundColor: "#6885a2",
                                opacity: "0.85"
                            }, 200);
                    });
                }

                /* Front Page - Carousel */
                $('#carousel .slider').bxSlider({
                    //for more options go to http://bxslider.com/options
                    controls: false,
                    auto: true,
                    autoHover: true, //Auto show will pause when mouse hovers over slider
                    pause: 8000, //The amount of time (in ms) between each auto transition - default 4000
                    autoStart: true
                });


                // Main Menu - Shows child elements when element is onfocus
                $('#block-system-main-menu > ul li a').focus(function() {
                    $(this).next().css('display', 'block');
                    $(this).next().children().find('ul').css('display', 'none');
                    $(this).parent().next().children('ul').removeAttr('style');
                });

                $('#block-system-main-menu > ul li ul li a').focus(function() {
                    $(this).next().css('display', 'block');
                    $(this).parent().next().children('ul').removeAttr('style');
                    $(this).parent().prev().children('ul').removeAttr('style');
                });


                $('#block-system-main-menu > ul > li > ul > li.last a').blur(function(){
                    $(this).parent().parent().removeAttr('style');
                });

                $('#block-system-main-menu > ul > li > ul > li > ul > li.last a').blur(function(){
                    $(this).parent().parent().removeAttr('style');
                });


            })();
		}


		/*****************************
		 ***   MULTI RESOLUTION   ****
		 ****************************/
        (function(){

            /* Front Page - Hover over regular items */
            $('.wizardStandard .views-row').hoverIntent(
                    function(){
                        $(this).find('.views-field-title, .views-field-title .field-content, .views-field-title .field-content a').andSelf().animate({
                            backgroundColor: "#6885a2",
                            color: "#ffffff"
                        }, 95);
                },  function(){
                        $(this).find('.views-field-title, .views-field-title .field-content, .views-field-title .field-content a').andSelf().animate({
                            backgroundColor: "#97e8c1",
                            color: "#205589"
                        }, 95);
            });


            /*Resources Section - Toggle*/
            $('#listView, .resevents-googlemap-container').hide();

            $( "#mapView" ).click(function(e) {
                e.preventDefault();
                $(this).hide();
                $("#listView").show();
                $('.resevents-googlemap-container, #locationsList').slideToggle();
                google.maps.event.trigger(map, 'resize');
                phpFunction('getLatLongFromZipCode', $('.resevents-titlebar-controle-zipcode').val(), function (locInfo) { /* Coder Bookmark: CB-K6RKMWE-BC */
                    consoleLog('Panning map to L/L ' + locInfo['lat'] + ', ' + locInfo['lng'] + ' Coder Bookmark: CB-MI3STFF-BC');
                    map.panTo( new google.maps.LatLng(locInfo['lat'], locInfo['lng']) );
                });
                drawAllMarkersOnGoogleMap();
            });

            $( "#listView" ).click(function(e) {
                e.preventDefault();
                $(this).hide();
                $('#mapView').show();
                $('.resevents-googlemap-container, #locationsList').slideToggle();
                google.maps.event.trigger(map, 'resize');
            });

            /* sets the height of the map and the list view to the same height */
            setTimeout(function(){
              

              
              /* sets the heights of the success stories and the resources to the same height */
              var maxHeight = Math.max($('.resevents-mastercontainer').height(), $('.resevents-succstores-container').height());
              $('.resevents-mastercontainer').height(maxHeight);
              $('.resevents-succstores-container').height((maxHeight - 20));
              $('#map-canvas').height((maxHeight - 60));



            },1000);


        })();



	});
})(jQuery);