<?php
/*
    [--] PURPOSE [--]
    
    The purpose of this script is to declare the necessary functions for the Content Integration Framework
    
    [!!] NOTICE [!!]
    
    The functionality in this script replaces the functionality supplied in the content_migration_framework module
*/

/* array buildWithApiCall()
 * 
 * This function will make an API call to builtwith.com and pull information from that site 
 */
function buildWithApiCall($website_url, $force_refresh=false) {

    // Authentication
    $builtwith_api_key = variable_get('builtwith_api_key', '4ece5139-df07-4279-b93a-071ea044f4ed');
    $builtwith_api_endpoint_url = variable_get('builtwith_api_endpoint_url', 'http://api.builtwith.com/v2/api.xml');
    
    error_log('Note: The BuiltWith API will be hit as ContentIntegrationFramework.php::buildWithApiCall() has been called. The API key in use is: ' . $builtwith_api_key);
    
    $data = array(
        'KEY' => $builtwith_api_key,
        'LOOKUP' => $website_url,
    );
    $full_url = url($builtwith_api_endpoint_url, array('query' => $data));
    $xml_response = drupal_http_request($full_url);
    $response = simplexml_load_string($xml_response->data);
    
    if ( strval($response) === 'You have used up your API allocation' ) {
        return strval($response);
    }
    
    $sorted_output = array();
    foreach ( $response->Paths->Path as $output ) {
        $output = (array) $output->Technologies;
        foreach ($output['Technology'] as $element) {
            $element = (array) $element;
            if ( !isset($sorted_output[$element['Tag']]) ) {
                $sorted_output[$element['Tag']] = array();
            }
            $sorted_output[$element['Tag']][] = $element;
        }
    }
    
    // Ensure that all elements (recursively) within $sorted_output are arrays and strings
    $sorted_output = json_decode(json_encode($sorted_output), TRUE);
    
    return $sorted_output;
}

/* array buildWithCategories()
 * 
 * Returns an array of values from http://api.builtwith.com/categoriesV2.xml
 */
function buildWithCategories() {
    $builtwith_categories_raw = drupal_http_request('http://api.builtwith.com/categoriesV2.xml');
    $categories = simplexml_load_string($builtwith_categories_raw->data);
    $categories_new = array();
    foreach($categories as $category){
        $temp = (array) $category;
        $categories_new[$temp['id']] = $temp['name'];
    }
    return $categories_new;
}