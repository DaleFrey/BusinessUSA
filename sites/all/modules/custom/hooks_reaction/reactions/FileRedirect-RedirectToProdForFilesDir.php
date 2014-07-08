<?php

drupal_register_shutdown_function(
    function () {
        
        if ( !empty($GLOBALS['drupal_output_buffering_start_time']) ) {

            $status = drupal_get_http_header("status");
            
            // If this [page] request is about to return in 404-Not-Found, and the request is for something within the /sites/default/files/ directory...
            if ( $status == "404 Not Found" && substr($_SERVER['REQUEST_URI'], 0, 21) === '/sites/default/files/') {
                
                $testProdURL = 'http://business.usa.gov' . $_SERVER['REQUEST_URI'];
                
                if ( function_exists('call_user_func_cache') ) {
                    $secondsIn1Week = 604800;
                    $secondsIn4Weeks = $secondsIn1Week * 4;
                    $testResponceHeaders = call_user_func_cache($secondsIn4Weeks, 'get_headers', $testProdURL);
                } else {
                    $testResponceHeaders = get_headers($testProdURL);
                }
                
                // If the target file exists on production...
                if ( strpos($testResponceHeaders[0], '200 OK') !== false ) {
                    header('Location: ' . $testProdURL);
                }
            }
        } else {
            error_log(
                'WARNING: You do not appear to have the drupal_output_buffering module enabeled.' . 
                'Without this the ' . __FILE__ . ' script cannot function as expected. '
            );
        }
    }
);
