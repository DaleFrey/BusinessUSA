<?php
    /*
        Despite this files extension, it is invoked from within a block. 
        This file contains the HTML/PHP code for the "front_page_resources_and_events" block
        See this block: <WebSite>/admin/structure/block/manage/boxes/front_page_resources_and_events/configure
    */
?>

<!-- @TODO: Relocate the following style tag into global.less -->
<style>
    #map-canvas {
        height: 280px;
        margin: 0px;
        padding: 0px
    }
</style>

<!-- The following div is rendered from the file: front_page_resources_and_events.tpl.php /* Coder Bookmark: CB-I544OMJ-BC */ -->
<div class="resevents-mastercontainer" rendersource="front_page_resources_and_events.tpl.php">

    <!-- "Locate Closest Resources & Events" title-bar -->
    <div class="resevents-titlebar-container">
        
        <h2 class="resevents-titlebar-title">
            Locate Closest Resources & Events
        </h2>
        
        <div class="zipSearch">	
        	<a class="toggleControl" id="mapView" href="#map-canvas">view map</a>
            <a class="toggleControl" id="listView" href="#locationsList">view list</a>

            <input type="textbox" value="" class="auto-fill-zip-code resevents-titlebar-controle resevents-titlebar-controle-zipcode" />
            <input type="button" value="Go" class="resevents-titlebar-controle resevents-titlebar-controle-go" />
            <script>
                // Auto-click the "Go" button when the ZipCode input changes (i.e. when the ZipCode gets auto-detected)
                jQuery('.resevents-titlebar-controle-zipcode').bind('change', function () {
                    jQuery('.resevents-titlebar-controle-go').click();
                });
                jQuery('.resevents-titlebar-controle-go').bind('click', function () {
                    postalCodeRegex = /^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/;
                    if(!postalCodeRegex.test(jQuery('.resevents-titlebar-controle-zipcode').val()))
                    {
                       // alert(postalCodeRegex.test(jQuery('.resevents-titlebar-controle-zipcode').val()));
                        alert("Please enter a valid zip-code");
                        return false;
                    }
                    // Show loading-spinners in place of the Views
                    jQuery('#locationsList').html('<table height="100%" width="100%"><tbody style="border-top: 0px;"><tr><td align="center"><img style="width: 55px;" src="data:image/gif;base64,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"/></td></tr></tbody></table>');
                    
                    phpFunction('getLatLongFromZipCode', jQuery('.resevents-titlebar-controle-zipcode').val(), function (locInfo) { /* Coder Bookmark: CB-L6KFTAY-BC */
                    
                        if ( typeof map == 'undefined' || map == null ) {
                            consoleLog('Cannot pan map to L/L ' + locInfo['lat'] + ', '+ locInfo['lng'] + ' yet because the map is not yet initalized');
                        } else {
                            consoleLog('Panning map to L/L ' + locInfo['lat'] + ', ' + locInfo['lng'] );
                            map.panTo( new google.maps.LatLng(locInfo['lat'], locInfo['lng']) );
                            map.setZoom(7);
                        }
                    
                        FrontPageViewsObtained = {};
                        var FrontPageViewsObtainEvent = function (viewDisplayName, htmlObtained) {
                            FrontPageViewsObtained[viewDisplayName] = htmlObtained;
                            if ( typeof FrontPageViewsObtained['front_page_events'] != 'undefined' && typeof FrontPageViewsObtained['front_page_state_resources'] != 'undefined' && typeof FrontPageViewsObtained['front_page_resource_centers'] != 'undefined' ) {
                                jQuery('#locationsList').hide();
                                jQuery('#locationsList').html( FrontPageViewsObtained['front_page_events'] + FrontPageViewsObtained['front_page_state_resources'] + FrontPageViewsObtained['front_page_resource_centers'] );
                                jQuery('#locationsList').fadeIn();
                            }
                        };
                        jQuery.get('/sys/ajax/views_embed_view?view=front_page_resource_and_events_views&display=front_page_resource_centers&param1=' + locInfo['lat'] + '&param2=' + locInfo['lng'], function (renderedViewHTML) {
                            FrontPageViewsObtainEvent('front_page_resource_centers', renderedViewHTML);
                        });
                        jQuery.get('/sys/ajax/views_embed_view?view=front_page_resource_and_events_views&display=front_page_state_resources&param1=' + state_abbr[ locInfo['state'] ], function (renderedViewHTML) {
                            FrontPageViewsObtainEvent('front_page_state_resources', renderedViewHTML);
                        });
                        jQuery.get('/sys/ajax/views_embed_view?view=front_page_resource_and_events_views&display=front_page_events&param1=' + locInfo['lat'] + '&param2=' + locInfo['lng'], function (renderedViewHTML) {
                            FrontPageViewsObtainEvent('front_page_events', renderedViewHTML);
                        });
                        
                    });

                });
            </script>
        </div>
    </div>

    <!-- START: GoogleMap area -->
    <div class="resevents-googlemap-container">

        <!-- Include the GoogleMap-JavaScript-API -->
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script>
            map = null;
            google.maps.event.addDomListener(window, 'load', function () {
                var mapOptions = {
                    zoom: 4,
                    center: new google.maps.LatLng(37.961523, -83.583984),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                infowindow = new google.maps.InfoWindow();
            });
        </script>

        <!-- JavaScript above injects a google map into the following div -->
        <div id="map-canvas" class="resevents-googlemap-mapcanvas"></div>

    </div>
    <!-- END: GoogleMap area -->
    
    <div id="locationsList" class="resevents-list-container">
        <?php print views_embed_view('front_page_resource_and_events_views', 'front_page_events'); ?>
        <?php print views_embed_view('front_page_resource_and_events_views', 'front_page_resource_centers'); ?>
        <?php print views_embed_view('front_page_resource_and_events_views', 'front_page_state_resources'); ?>
    </div>
    
    <div class="reqappt-viewall-buttoncontainer" rendersource="<?php print basename(__FILE__); ?>">
            <input type="button" value="View All" class="button-viewall" onclick="document.location = '/request-appointment-and-closest-resource-centers?zip=' + jQuery('.resevents-titlebar-controle-zipcode').val();" />
    </div>

</div>

<!-- The following div is rendered from the file: front_page_resources_and_events.tpl.php /* Coder Bookmark: CB-VVIQ3XS-BC */ -->
<div class="resevents-succstores-container" rendersource="front_page_resources_and_events.tpl.php">
    <a href="/search/site/*?f[0]=bundle%3Asuccess_story"><h2>Success Stories</h2></a>
    <?php print views_embed_view('front_page_resource_and_events_views', 'front_page_success_stories'); ?>
</div>




