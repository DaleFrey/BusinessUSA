<?php
    
    @ob_end_clean();
    @ob_end_clean();
    @ob_end_clean();
    
    if ( empty($_GET['countryCode']) ) {
        exit('Error - Missing countryCode parameter');
    }
    $countryCode = $_GET['countryCode'];
    
    if ( empty($_GET['zipCode']) || intval($_GET['zipCode']) === 0 ) {
        exit('Error - Missing zipCode parameter');
    }
    
    $locationInfo = getLatLongFromZipCode( $_GET['zipCode'] ); // Note: getLatLongFromZipCode() is defined in ZipCodeGeolocation.php
    $state = 'all';
    if ( !empty($locationInfo['state']) ) {
        $state = $locationInfo['state'];
    }
?>

<!-- The following is rendered from <?php print __FILE__; ?> -->
<div class="exporterdashboard-useacsevents-ajax-responce" rendersource="<?php print basename(__FILE__); ?>">
    <div class="exporterdashboard-useacsevents-posthead">
        <span class="exporterdashboard-useacsevents-posthead-loclabel">
            Current Location: 
        </span>
        <span class="exporterdashboard-useacsevents-posthead-locvalue">
            <?php 
                if ( $countryCode === 'US' || $countryCode === 'USA' ) {
                    print $locationInfo['city'] . ', ' . $locationInfo['state'] . ". ";
                } else {
                    print acronymToCountryName($countryCode) . ". "; // Note: This function is deinfed in ZipCodeGeolocation.php
                }
            ?>
        </span>
        <span class="exporterdashboard-useacsevents-posthead-locpost">
            To select a different location, please click <b>"Change Location"</b>
        </span>
    </div>
    
    <div class="exporterdashboard-useacsevents-leftside">
        
        <?php
            if ( $countryCode === 'US' || $countryCode === 'USA' ) {
                $param1 = $state;
                $param2 = 'all';
            } else {
                $param1 = 'all';
                $param2 = $countryCode;
            }
            print "<!-- Invoking View exporting_events, display exporterdash_tradeevents, with parameters {$param1} and {$param2} -->";
            $viewHtml = views_embed_view('exporting_events', 'exporterdash_tradeevents', $param1, $param2); 
            if ( is_null($viewHtml) ) {
                print '<b>Error: This environment does not have the exporting_events => exporterdash_tradeevents View. Please <a href="http://qa.business.usa.reisys.com/admin/structure/views/view/exporting_events/export">export this View from QA by clicking here</a>, and then <a href="/admin/structure/views/import">import the View into this environment here</a>. Remember to tick the checkbox that allows you to overwrite a View if it already exists.</b> ';
            } else {
                print $viewHtml;
            }
        ?>
    </div>
    
    <div class="exporterdashboard-useacsevents-rightside">
        <?php
            if ( $countryCode === 'US' || $countryCode === 'USA' ) {
                $param1 = $state;
                $param2 = 'all';
            } else {
                $param1 = 'all';
                $param2 = acronymToCountryName($countryCode);
            }
            print "<!-- Invoking View useac_location_exporting_wizards, display exporterdash_useacs, with parameters {$param1} and {$param2} -->";
            $viewHtml = views_embed_view('useac_location_exporting_wizards', 'exporterdash_useacs', $param1, $param2);
            if ( is_null($viewHtml) ) {
                print '<b>Error: This environment does not have the useac_location_exporting_wizards => exporterdash_useacs View. Please <a href="http://qa.business.usa.reisys.com/admin/structure/views/view/useac_location_exporting_wizards/export">export this View from QA by clicking here</a>, and then <a href="/admin/structure/views/import">import the View into this environment here</a>. Remember to tick the checkbox that allows you to overwrite a View if it already exists.</b> ';
            } else {
                print $viewHtml;
            }
        ?>
    </div>
    
    <div class="exporterdashboard-useacsevents-bottom">
        <?php if ( $countryCode === 'US' || $countryCode === 'USA' ): ?>
            <!-- /* Coder Bookmark: CB-PYU0UFU-BC */ -->
            <a href="/request-appointment-and-closest-resource-centers?zip=<?php echo intval($_GET['zipCode']);?>&wiz=useac" class="exporterdashboard-useacsevents-viewall">
                View All
            </a>
        <?php else: ?>
            <!-- /* Coder Bookmark: CB-MF8620E-BC */ -->
            <a href="/international-locations#<?php print $countryCode; ?>" class="exporterdashboard-useacsevents-viewall">
                View All
            </a>
        <?php endif; ?>
    </div>
    
</div>
<?php exit(); ?>