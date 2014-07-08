<?php
//move into main module, or pull from somewhere if it exists
$state_abbr = array(
    'AL'=> 'Alabama',
    'AK'=> 'Alaska',
    'AS'=> 'America Samoa',
    'AZ'=> 'Arizona',
    'AR'=> 'Arkansas',
    'CA'=> 'California',
    'CO'=> 'Colorado',
    'CT'=> 'Connecticut',
    'DE'=> 'Delaware',
    'DC'=> 'District of Columbia',
    'FM'=> 'Micronesia1',
    'FL'=> 'Florida',
    'GA'=> 'Georgia',
    'GU'=> 'Guam',
    'HI'=> 'Hawaii',
    'ID'=> 'Idaho',
    'IL'=> 'Illinois',
    'IN'=> 'Indiana',
    'IA'=> 'Iowa',
    'KS'=> 'Kansas',
    'KY'=> 'Kentucky',
    'LA'=> 'Louisiana',
    'ME'=> 'Maine',
    'MH'=> 'Islands1',
    'MD'=> 'Maryland',
    'MA'=> 'Massachusetts',
    'MI'=> 'Michigan',
    'MN'=> 'Minnesota',
    'MS'=> 'Mississippi',
    'MO'=> 'Missouri',
    'MT'=> 'Montana',
    'NE'=> 'Nebraska',
    'NV'=> 'Nevada',
    'NH'=> 'New Hampshire',
    'NJ'=> 'New Jersey',
    'NM'=> 'New Mexico',
    'NY'=> 'New York',
    'NC'=> 'North Carolina',
    'ND'=> 'North Dakota',
    'OH'=> 'Ohio',
    'OK'=> 'Oklahoma',
    'OR'=> 'Oregon',
    'PW'=> 'Palau',
    'PA'=> 'Pennsylvania',
    'PR'=> 'Puerto Rico',
    'RI'=> 'Rhode Island',
    'SC'=> 'South Carolina',
    'SD'=> 'South Dakota',
    'TN'=> 'Tennessee',
    'TX'=> 'Texas',
    'UT'=> 'Utah',
    'VT'=> 'Vermont',
    'VI'=> 'Virgin Island',
    'VA'=> 'Virginia',
    'WA'=> 'Washington',
    'WV'=> 'West Virginia',
    'WI'=> 'Wisconsin',
    'WY'=> 'Wyoming'
);
//test embed view function taken from /sys/ajax, needs renaming
function test_view_embed_view($viewMachineName,$displayMachineName,$viewParameterList=Array()){
    $myview = views_get_view($viewMachineName);
    $myview->set_display($displayMachineName);
    $myview->set_arguments($viewParameterList);
    $myview->set_current_page(0);
    $myview->pre_execute();
    $out = $myview->preview();
    return $out;
}
//main template code start
global $user; $user->uid ;
$user_info = user_load( $user->uid);
dpm($user_info);
$zipcode = $user_info->field_usr_zipcode['und'][0]['Value'];
$pastsearches = $user_info->field_usr_past_searches['und'];
if(!$zipcode){
    $zipcode = "22070";//for testing, i think we can get this from myusa
}
$loc_info = getLatLongFromZipCode($zipcode);
//print_r($loc_info);
?>
<style>
    /*temporary*/
    .userdashboard-mastersection-container{
        border:2px dotted black;
        float:left;
    }
    .userdashboard-mastersection-container-size-1{
        width:316px;
    }
    .userdashboard-mastersection-container-size-2{
        width:636px;
    }
    .userdashboard-mastersection-container-size-3{
        width:956px;
    }
    /*end temporary*/

    #map-canvas {
        height: 280px;
        margin: 0px;
        padding: 0px
    }
</style>
<div class="userdashboard-mastersections-mastercontainer">
    <!-- User Dashboard - Saved Resources &amp; Tools -->
    <div class="userdashboard-mastersection-container userdashboard-mastersection-container-resourcesevents userdashboard-mastersection-container-size-2">
        <div class="userdashboard-mastersection-titlebar-container">
            <div class="userdashboard-mastersection-titlebar-titletext">
                <h2>Resources and Events in your area</h2>
                <a class="toggleControl" id="mapView" href="#map-canvas">view map</a>
                <a class="toggleControl" id="listView" href="#locationsList">view list</a>
            </div>
        </div>
        <!-- START: GoogleMap area -->
        <div class="userdashboard-googlemap-container">

            <!-- Include the GoogleMap-JavaScript-API -->
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
            <script>
                map = null;
                google.maps.event.addDomListener(window, 'load', function () {
                    var mapOptions = {
                        zoom: 8,
                        center: new google.maps.LatLng(<?php print $loc_info['lat']; ?>, <?php print $loc_info['lng']; ?>),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                    infowindow = new google.maps.InfoWindow();
                });
            </script>

            <!-- JavaScript above injects a google map into the following div -->
            <div id="map-canvas" class="userdashboard-googlemap-mapcanvas"></div>

        </div>
        <!-- END: GoogleMap area -->

        <div id="locationsList" class="userdashboard-list-container">
            <?php
                $events_params = array($loc_info['lat'],$loc_info['lng']);
                $resource_params = array($loc_info['lat'],$loc_info['lng']);
                $stateresource_params = array($state_abbr[$loc_info['state']]);
            ?>
            <?php print test_view_embed_view('front_page_resource_and_events_views', 'front_page_events',$events_params); ?>
            <?php print test_view_embed_view('front_page_resource_and_events_views', 'front_page_resource_centers',$resource_params); ?>
            <?php print test_view_embed_view('front_page_resource_and_events_views', 'front_page_state_resources',$stateresource_params); ?>
        </div>

        <div class="reqappt-viewall-buttoncontainer" rendersource="<?php print basename(__FILE__); ?>">
            <input type="button" value="View All" class="button-viewall" onclick="document.location = '/request-appointment-and-closest-resource-centers?zip=<?php print $zipcode;?>';" />
        </div>
    </div>
    <!-- User Dashboard - Support -->
    <div class="userdashboard-mastersection-container userdashboard-mastersection-container-support userdashboard-mastersection-container-size-1">
        <div class="userdashboard-mastersection-titlebar-container">
            <div class="userdashboard-mastersection-titlebar-titletext">
                <h2>Support</h2>
                <span class="support_icon"></span>
            </div>
        </div>
        <div class="userdashboard-support-content">
            <div class="userdashboard-support-content-header">
                <h3>Ticket State</h3>
                <span>5</span>
                <a href="#">View All</a>
            </div>

            <div class="userdashboard-support-content-tickets">
                <ul>
                    <li>View your Ticket Status <a class="userdashboard-support-ticket-btn" href="#">Open</a></li>
                    <li>This ticket has been completed <a class="userdashboard-support-ticket-btn ticket-btn-closed" href="#">Closed</a></li>
                    <li>View your Ticket Status <a class="userdashboard-support-ticket-btn" href="#">Open</a></li>
                </ul>
            </div>
            <p>
                lorem ipsum
            </p>
            <div>
                <a class="userdashboard-support-create-ticket" href="#">Create a ticket</a>
            </div>
        </div>
    </div>
    <!-- User Dashboard - Resource Centers Near You -->
    <div class="userdashboard-mastersection-container userdashboard-mastersection-container-savedresources userdashboard-mastersection-container-size-2">
        <div class="userdashboard-mastersection-titlebar-container">
            <h2 class="userdashboard-mastersection-titlebar-titletext">
                Saved Resource &amp; Tools
            </h2>
            <div class="userdashboard-mastersection-titlebar-addtile">
                <a href="#">Add a Tile</a>
            </div>
        </div>
        <div class="userdashboard-savedresources-content">
            <span class="userdashboard-savedresources-pagetileleft"></span>
            <ul class="userdashboard-savedresources-tiles">
                <li><a href="#">
                        <span class="userdashboard-savedresources-tileicon"></span>Begin Exporting
                    </a></li>
            </ul>
            <span class="userdashboard-savedresources-pagetileright"></span>
            <ul class="userdashboard-savedresources-pager">
                <li>circle button</li>
                <li>circle button</li>
                <li>circle button</li>
            </ul>
        </div>
    </div>
    <!-- User Dashboard - Programs & Services -->
    <div class="userdashboard-mastersection-container userdashboard-mastersection-container-programs userdashboard-mastersection-container-size-1">
        <div class="userdashboard-mastersection-titlebar-container">
            <h2 class="userdashboard-mastersection-titlebar-titletext">
                Programs & Services
            </h2>
        </div>
        <div class="userdashboard-programs-content">
            a new view that pulls the content could go here
        </div>
    </div>
    <!-- User Dashboard - Blog -->
    <div class="userdashboard-mastersection-container userdashboard-mastersection-container-blog userdashboard-mastersection-container-size-2">
        <div class="userdashboard-mastersection-titlebar-container">
            <div class="userdashboard-mastersection-titlebar-titletext">
                <h2>Blog</h2>
            </div>
        </div>
        <div class="userdashboard-blog-content">
            <?php print test_view_embed_view('blog', 'block_1');//new view probably, we're using an existing one ?>
        </div>
    </div>
    <!-- User Dashboard - My Recent Searches -->
    <div class="userdashboard-mastersection-container userdashboard-mastersection-container-searches userdashboard-mastersection-container-size-1">
        <div class="userdashboard-mastersection-titlebar-container">
            <div class="userdashboard-mastersection-titlebar-titletext">
                <h2>My Recent Searches</h2>
            </div>
        </div>
        <div class="userdashboard-searches-content">
            <?php foreach($pastsearches as $pastsearch):
                $search = unserialize($pastsearch['value']);
                ?>
                <div><a href="<?php echo $search['search-url'];?>"><?php echo $search['search-term'];?></a></div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- User Dashboard - Support -->
    <div class="userdashboard-mastersection-container userdashboard-mastersection-container-faqs userdashboard-mastersection-container-size-3">
        <div class="userdashboard-mastersection-titlebar-container">
            <h2 class="userdashboard-mastersection-titlebar-titletext">
                Faqs
            </h2>
        </div>
        <div class="userdashboard-faqs-content">
            <ul>
                <li><a href="#">lorem ipsum</a></li>
                <li><a href="#">lorem ipsum</a></li>
                <li><a href="#">lorem ipsum</a></li>
            </ul>
            <div class="userdashboard-faqs-viewall">
                <a href="#">View All</a>
            </div>
        </div>
    </div>
</div>
