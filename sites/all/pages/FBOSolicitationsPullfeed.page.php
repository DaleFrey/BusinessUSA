<?php
/**
 * Created by PhpStorm.
 * User: naga.tejaswini
 * Date: 4/3/14
 * Time: 11:08 AM
 */

if ( empty($_GET['invoke']) || intval($_GET['invoke']) !== 1 ) {

    print 'Use ?invoke=1 in the URL-query to execute functionality. Returns json.<br/>';
    print 'Use ?invoke=1&debug=1 in the URL-query to see what this script will output in a human-readable fassion (kprint_r).<br/>';
    print 'Use no URL-query (like you did now) to be abel to edit this Drupal-"Basic Page". Requieres you to be logged in as an admin.<br/>';
    return; // Cease rendering this script
}

/** array getAllSolicitationsFromFBOApi()
 *
 *  This function is used to grab ALL solicitations from the API, since the API
 *  seems to only return a max of 10 content-items at a time.
 *
 *  i.e. The following API call only returns 10 results despite the request limit for any number eg.5000:
 *  http://api.data.gov/gsa/fbopen/v0/opps?q=FBO_RECOVERY_ACT:N&data_source=FBO&api_key=K6zrCepxUEMeci1q6ZOZ4W5LtA8u1apq8xLqbnm8&start=0
 *
 *  This function understands this limit, and returns all content-items.
 *
 *  Returns an array in the same root-structure as the array given from the API.
 *  i.e. structure of:
return array(
'docs' => array( [all results from the API across all pages/offsets] ),
);
 */
if ( !function_exists('_getAllSolicitationsFromFBOApi') ) {
    function _getAllSolicitationsFromFBOApi() {

        $offset = 0;
        $feedSolicitations = array();
        while ( true ) { // Start an infinite loop, we will break out of this loop programmatically

            // Ensure the PHP thread does not time-out
            set_time_limit(900);

            // Try to grab solicitations from http://api.data.gov/gsa/fbopen/v0/opps?q=FBO_RECOVERY_ACT:N&data_source=FBO&api_key=K6zrCepxUEMeci1q6ZOZ4W5LtA8u1apq8xLqbnm8&start= at $offset 0
            $jsonString = file_get_contents("http://api.data.gov/gsa/fbopen/v0/opps?q=FBO_RECOVERY_ACT:N&data_source=FBO&api_key=K6zrCepxUEMeci1q6ZOZ4W5LtA8u1apq8xLqbnm8&start=$offset");
            $jsonData = json_decode($jsonString, true);

            // Check if we got (any) results from $offset
            if ( empty($jsonData['docs']) || count($jsonData['docs']) === 0 ) {
                // If we got no results, then that means there are no more solicitations to pull from api
                break;
            } else {
                // 10 (or less) articles were returned from this API call, we shall merge this result-array into $feedSolicitations
                $feedSolicitations = array_merge($feedSolicitations, $jsonData['docs']);
                $offset += 10; // Increment $offset by 10 so that we can grab the NEXT 10 articles offered by http://api.data.gov/gsa/fbopen/v0/opps
            }
        };

        // Return array('docs'), the same structure as returned from the API
        return array(
            'docs' => $feedSolicitations,
            );

    }
}

$results = _getAllSolicitationsFromFBOApi();


if ( empty($_GET['debug']) || intval($_GET['debug']) !== 1 ) {
    @ob_end_clean();
    while ( @ob_end_clean() );
    print json_encode($results);
    exit();
} else {
    kprint_r( $results );
}
