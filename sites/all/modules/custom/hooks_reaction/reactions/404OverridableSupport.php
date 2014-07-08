<?php


    drupal_register_shutdown_function(
        function () {
            
            if ( !empty($GLOBALS['drupal_output_buffering_start_time']) ) {

                $status = drupal_get_http_header("status");
                if ( $status == "404 Not Found" ) {
            
                    $testPath = strtok($_SERVER['REQUEST_URI'], '?');
                    $testPath = ltrim($testPath, '/');
                    $testPath = overridable($testPath);
                    if ( file_exists($testPath) ) {
                        
                        @ob_end_clean();
                        @ob_end_clean();
                        @ob_end_clean();
                        
                        // Determin what kind of file this is based on the extension
                        $ctype = false;
                        $fINfo = pathinfo($testPath);
                        switch ( strtolower($fINfo['extension']) ) { 
                            case "htm": 
                            case "html": 
                            case "php": 
                                $ctype="text/html"; 
                                break; 
                            case "jpeg": 
                            case "jpg": 
                                $ctype="image/jpg"; 
                                break; 
                            case "pdf": $ctype="application/pdf"; break; 
                            case "exe": $ctype="application/octet-stream"; break; 
                            case "zip": $ctype="application/zip"; break; 
                            case "doc": $ctype="application/msword"; break; 
                            case "xls": $ctype="application/vnd.ms-excel"; break; 
                            case "ppt": $ctype="application/vnd.ms-powerpoint"; break; 
                            case "gif": $ctype="image/gif"; break; 
                            case "png": $ctype="image/png"; break; 
                        }
                        
                        // Set the HTTP-Content-Type in the HTTP-Responce header if we have a general idea what kind of content this is
                        if ( $ctype !== false ) {
                            header("Content-Type: $ctype");
                        }
                        
                        readfile($testPath);
                        exit();
                    }
                }
            } else {
                error_log(
                    'WARNING: You do not appear to have the drupal_output_buffering module enabeled.' . 
                    'Without this the 404OverridableSupport.php script cannot handel a false-positive on a 404 error ( due to new file created via overridable() )'
                );
            }
        }
    );