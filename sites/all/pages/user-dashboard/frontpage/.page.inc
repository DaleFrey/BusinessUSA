<?php /*

    [--] FILES [--]
    
    frontpage/.page.inc - Executed FIRST
    frontpage/.page.php - Rendered SECOND, renders the HTML for this page
    frontpage/.page.less - Used by the browser for theming purposes. I will hack this .less file to also be used by the front page 

    [!!] IMPLEMENTATION [!!]
    
    When this is ready, the actual front page of BusinessUSA will load the contents of 
    this page (from the URL of <site>/user-dashboard/frontpage?uid=1 ) though AJAX
    and inject the HTML this file generates into the front page.
    
    Due to Akamai caching, when pulling HTML from this script through ajax, we should 
    always append uid=<DrupalUserId> to the request for this page.
    
    [!!] EXPECTATIONS [!!]
    
    The URL of <site>/user-dashboard/frontpage expects to be given a [Drupal] user-id
    in the URL query, like this: ?uid=1 

*/

// Make sure a [Drupal] user-id was given for us to load information from
define('TOKEN', 'GZTUH36TuANl/WpKHZRRhOu6/mjOkhVvh0PcRArcVHPMpadl4MnHzYaDm3Igl2GL/v3gfYMuMCqDaDHMVv5k0w==');
define('PARATURE_BASE_URL', 'https://help.business.usa.gov/api/v1/30027/30030');
//the returned json has invalid unicode characters, we remove these so the json can be properly decoded
$badChars = array(chr(239), chr(187), chr(191));
if ( empty($_GET['uid']) || intval($_GET['uid']) === 0 ) {
    while (@ob_end_clean());
    print "Error - Missing the uid URL-query parameter in this page request.";
    exit();
}

// Verify certain that certain fields (in the database) exist
$fieldsThatShouldExists = array(
    'field_myusa_ownership', 
    'field_myusa_industry', 
    'field_myusa_tiles', 
    'field_usr_past_searches',
    'field_myusa_firstname',
    'field_myusa_zipcode',
    'field_myusa_last_auth'
);
foreach ( $fieldsThatShouldExists as $fieldsThatShouldExist ) {
    if ( is_null(field_info_field($fieldsThatShouldExist)) ) {
        while (@ob_end_clean());
        print "Error - The {$fieldsThatShouldExist} field does not exists in this database. Please make sure all the fields found in QA at http://qa.business.usa.reisys.com/admin/config/people/accounts/fields exist within this environment.";
        exit();
    }
}

// Load user information
if ( empty($_GET['uid']) || intval($_GET['uid']) === 0 ) {
    while (@ob_end_clean());
    print "Error - Missing the uid URL-query parameter in this page request.";
    exit();
}
$userInfo = user_load(intval($_GET['uid']));
//dsm( $userInfo );


/* START:
---- [!!] MY BUSINESSUSA TILES SECTION [!!]  ----
Determine what tiles to show under the "My BusinessUSA Tiles" section. 
Coder Bookmark: CB-01ZDZB2-BC */

    // Get a list of all wizards this user is interested in (from the field_myusa_tiles files attached to users)
    $usersDesieredWizards = array();
    if ( !empty($userInfo->field_myusa_tiles['und']) && is_array($userInfo->field_myusa_tiles['und']) ) {
        foreach ( $userInfo->field_myusa_tiles['und'] as $valueContainer ) {
            $usersDesieredWizards[] = $valueContainer['value'];
        }
    }
    // Determine what what tiles should show under the "My Business USA Tiles" area.
    $myBusinessUsaTiles = array();
    foreach ( getAllWizards() as $wizardInfo ) { // Note: getAllWizards() is defined in WizardLoader.php
        if ( in_array($wizardInfo['field_swimlane_wizurl_value'], $usersDesieredWizards)  ) {
            $myBusinessUsaTiles[] = $wizardInfo;
        }
    }
    // For the tiles shown under the "My Business USA Tiles" area, if there are more than 8, divide them into 2 paginated "pages"
    $myBusinessUsaTiles_page1 = array_slice($myBusinessUsaTiles, 0, 8);
    $myBusinessUsaTiles_page2 = array_slice($myBusinessUsaTiles, 8);
    //dsm($myBusinessUsaTiles_page1); dsm($myBusinessUsaTiles_page2);


    
/* START:
---- [!!] NOTIFICATIONS SECTION [!!]  ----
Determine what content links should show under the "Notifications" section. 
Coder Bookmark: CB-EVYF5Y5-BC */

$notifications = array();
// @TODO: Remove dummy data, replace in real logic
$notifications[] = array(
    'title' => 'View New Event Near You',
    'link' => 'http://www.google.com/',
    'snippet' => 'Duis sutem vel enum iriure dolor in hendrenrit in vulputat...',
);
$notifications[] = array(
    'title' => 'View New Program for Your Business',
    'link' => 'http://dalefrey.net/',
    'snippet' => 'Duis sutem vel enum iriure dolor in hendrenrit in vulputat...',
);


/* START:
---- [!!] PROGRAMS AND SERVICES SECTION [!!]  ----
Determine what content links should show under the "Programs and Services" section. 
Coder Bookmark: CB-PED6TKA-BC */

    $progsAndServices = array();

    $userIndustries = array();
    foreach ( $userInfo->field_myusa_industry['und'] as $valueContainer ) {
        $userIndustries[] = $valueContainer['value'];
    }
    $queryIndustry = chr(39) . implode(chr(39) . ', ' . chr(39), $userIndustries) . chr(39);

    $userOwnerships = array();
    foreach ( $userInfo->field_myusa_ownership['und'] as $valueContainer ) {
        $userOwnerships[] = $valueContainer['value'];
    }
    $queryOwnerships = chr(39) . implode(chr(39) . ', ' . chr(39), $userOwnerships) . chr(39);

    $query = "
        SELECT
            n.nid AS 'nid',
            COUNT(n.nid) AS 'score'
        FROM node n 
        LEFT JOIN field_data_field_program_industry i ON ( i.entity_id = n.nid )
        LEFT JOIN field_data_field_program_owner_share o ON ( o.entity_id = n.nid )
        WHERE 
            ( n.type = 'program' OR n.type = 'services' )
            AND (
                field_program_industry_value IN ({$queryIndustry})
                OR field_program_owner_share_value IN ({$queryOwnerships})
            )
            AND n.status = 1
        GROUP BY n.nid 
        ORDER BY COUNT(n.nid) DESC
        LIMIT 9
    ";
    foreach ( db_query($query) as $result ) {
        $resultNode = node_load($result->nid);
        $progsAndServices[] = array(
            'title' => $resultNode->title,
            'link' => drupal_get_path_alias('node/' . $resultNode->nid),
            'snippet' => truncate_utf8($resultNode->field_program_detail_desc['und'][0]['value'], 75, true, true),
            'iconurl' => '/sites/all/themes/bizusa/images/content-types-icons/34x34/program.png',
        );
    }
    
    // If there are no results in $, or less than 9 results, grab the latest 9 newest programs/services
    if ( count($progsAndServices) < 9 ) {
        $query = "SELECT n.nid AS 'nid' FROM node n WHERE (type='program' OR type='services') AND status=1 ORDER BY created DESC LIMIT 9;";
        foreach ( db_query($query) as $result ) {
            $resultNode = node_load($result->nid);
            $progsAndServices[] = array(
                'title' => $resultNode->title,
                'link' => drupal_get_path_alias('node/' . $resultNode->nid),
                'snippet' => truncate_utf8($resultNode->field_program_detail_desc['und'][0]['value'], 75, true, true),
                'iconurl' => '/sites/all/themes/bizusa/images/content-types-icons/34x34/program.png',
            );
        }
    }
    $progsAndServices = array_slice($progsAndServices, 0, 9);
    //dsm($progsAndServices);
    
    // Determin the ZipCode that the GoogleMap should center to
    drupal_add_js('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array('type' => 'external'));
    $userZipCode = false;
    if ( !empty($userInfo->field_myusa_zipcode['und'][0]['value']) ) {
        $userZipCode = intval($userInfo->field_myusa_zipcode['und'][0]['value']);
    }
    if ( intval($userZipCode) === 0 ) {
        $userZipCode = false;
    }
    
    // Determine the URL for the "View All" links
    $progsAndServicesViewAllURL = '/search/site/%2A?';
    $params = array(
        'bundle%3Aservices',
        'bundle%3Aprogram'
    );
    foreach ( $userInfo->field_myusa_industry['und'] as $valueContainer ) {
        $params[] = 'sm_field_program_industry%3A' . $valueContainer['value'];
    }
    foreach ( $userInfo->field_myusa_ownership['und'] as $valueContainer ) {
        $params[] = 'sm_field_program_owner_share%3A' . $valueContainer['value'];
    }
    foreach ( $params as $index => $param ) {
        $progsAndServicesViewAllURL .= "f[{$index}]={$param}&";
    }
    $progsAndServicesViewAllURL = rtrim($progsAndServicesViewAllURL, '&');

    
/* START:
---- [!!] RECENT SEARCHES SECTION [!!]  ----
Determine what to show in the "Recent Searches" section
Coder Bookmark: CB-05G7D8Q-BC */
    $lastMyUsaAuth = intval( $userInfo->field_myusa_last_auth['und'][0]['value'] );
    // Note: The getUserPastSearches() function is defined in UserDashboard-PastSearchesSupport.php
    $userPastSearches = getUserPastSearches($userInfo->uid, $lastMyUsaAuth);
    
    // Bug killer - Do not show wild-card searches, and replace %20 with spaces
    foreach ( $userPastSearches as $index => $userPastSearch ) {
        $userPastSearches[$index]['search-term'] = str_replace('%20', ' ', $userPastSearches[$index]['search-term']);
        if ( $userPastSearch['search-term'] === '%2A' || $userPastSearch['search-term'] === '*' ) {
            unset($userPastSearches[$index]);
        }
    }
    //dsm($userPastSearches);



/* START:
---- [!!] BLOG SECTION [!!]  ----
Determine what to show in the "Blog" section
Coder Bookmark: CB-JNM5B5M-BC */
    $blogs = array();
    /* @TODO: If/when this blog section need to be made more relevant to the MyUSA user, alter the following query. 
    In anticipation of such a change in the near future, I am using a MySQL query here instead of a View */
    $query = "
        SELECT 
            n.nid AS 'nid',
            n.title AS 'title',
            descr.field_blog_text_value AS 'description',
            src.field_blog_source_list_value AS 'source'
        FROM node n
        LEFT JOIN field_data_field_blog_text descr ON ( descr.entity_id = n.nid )
        LEFT JOIN field_data_field_blog_source_list src ON ( src.entity_id = n.nid )
        LEFT JOIN field_data_field_publishrange pubdate ON ( pubdate.entity_id = n.nid )
        WHERE
            n.type = 'blog'
            AND n.status=1
        ORDER BY pubdate.field_publishrange_value DESC
        LIMIT 2
    ";
    foreach ( db_query($query) as $result ) {
        switch ( strtolower($result->source) ) { /* Coder Bookmark: CB-3S01W05-BC */
            case 'businessusa':
                $iconUrl = '/sites/all/themes/bizusa/images/businessusa.png';
                break;
            case 'department of commerce':
                $iconUrl = '/sites/all/themes/bizusa/images/departmentofcommerce.png';
                break;
            case 'small business administration':
                $iconUrl = '/sites/all/themes/bizusa/images/smallbusinessadministration.png';
                break;
            case 'whitehouse':
                $iconUrl = '/sites/all/themes/bizusa/images/whitehouse.png';
                break;
            default:
                $iconUrl = '/sites/all/themes/bizusa/images/question-mark-in-circle.png';
                $result->source = 'Unknown';
                break;
        }
        $blogs[] = array(
            'iconURL' => $iconUrl,
            'iconAlt' => 'The following blog comes from: ' . $result->source,
            'link' => drupal_get_path_alias('node/' . $result->nid),
            'title' => $result->title,
            'snippet' => truncate_utf8($result->description, 100, true, true)
        );
    }
    //dsm($blogs);
    
/* START:
---- [!!] FAQs SECTION [!!]  ----
Determine what to show in the "FAQs" section
Coder Bookmark: CB-W3WNLXM-B */
$faqs=array();
// @TODO: Replace dummy data with real data
$faqs[] = array(
    'title' => '10 Steps to Starting a Business',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/Article/694/10-Steps-to-Starting-a-Business',
);
$faqs[] = array(
    'title' => '20 Questions Before Starting',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/Article/693/20-Questions-Before-Starting',
);
$faqs[] = array(
    'title' => 'Thinking About Starting',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/110/Thinking-About-Starting',
);
$faqs[] = array(
    'title' => 'Creating Your Business Plan',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/111/Creating-Your-Business-Plan',
);
$faqs[] = array(
    'title' => 'Choose Your Business Structure',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/112/Choose-Your-Business-Structure',
);
$faqs[] = array(
    'title' => 'Register Your Business',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/113/Register-Your-Business',
);
$faqs[] = array(
    'title' => 'Obtain Business Licenses',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/114/Obtain-Business-Licenses',
);
$faqs[] = array(
    'title' => 'Learn About Business Law',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/115/Learn-About-Business-Law',
);
$faqs[] = array(
    'title' => 'Finance Your Business',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/116/Finance-Your-Business',
);
$faqs[] = array(
    'title' => 'Filing & Paying Taxes',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/118/Filing-Paying-Taxes',
);
$faqs[] = array(
    'title' => 'Choosing Your Business Location & Equipment',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/119/Choosing-Your-Business-Location-Equipment',
);
$faqs[] = array(
    'title' => 'Hire & Retain Employees',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/121/Hire-Retain-Employees',
);
$faqs[] = array(
    'title' => 'Leading Your Company',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/124/Leading-Your-Company',
);
$faqs[] = array(
    'title' => 'Growing Your Business',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/125/Growing-Your-Business',
);
$faqs[] = array(
    'title' => 'Expanding a Business',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/10/Expanding-a-Business',
);
$faqs[] = array(
    'title' => 'Special Programs',
    'url' => 'http://help.businessusa.gov/link/portal/30027/30030/ArticleFolder/11/Special-Programs',
);








