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
<div class="resevents-mastercontainer" rendersource="<?php print basename(__FILE__); ?>">
    
    <img class="mobile-gmap-icon mobile-only" src="/sites/all/themes/bizusa/images/map_icon_blue.png" />
    
    <!-- START: GoogleMap area -->
    <div class="resevents-googlemap-container">

        <!-- JavaScript injects a google map into the following div -->
        <div id="map-canvas" class="resevents-googlemap-mapcanvas"></div>

    </div>
    <!-- END: GoogleMap area -->
    
    <div id="locationsList" class="resevents-list-container">
        <?php print views_embed_view('front_page_resource_and_events_views', 'front_page_events'); ?>
        <?php print views_embed_view('front_page_resource_and_events_views', 'front_page_resource_centers'); ?>
        <?php print views_embed_view('front_page_resource_and_events_views', 'front_page_state_resources'); ?>
    </div>
    
    <div class="reqappt-viewall-buttoncontainer" rendersource="<?php print basename(__FILE__); ?>">
            <a class="button-viewall" href="javascript: document.location = '/request-appointment-and-closest-resource-centers?zip=' + jQuery('.resevents-titlebar-controle-zipcode').val(); void(0);">
                View All
            </a>
    </div>

</div>




