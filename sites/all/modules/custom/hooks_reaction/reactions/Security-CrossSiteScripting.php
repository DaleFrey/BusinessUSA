<?php

$ruri = strtolower( $_SERVER['REQUEST_URI'] );

$checkRURIs = array();
$checkRURIs[] = $ruri;
$checkRURIs[] = urldecode($ruri);
$checkRURIs[] = urldecode( str_replace( ' ', '', $ruri ) );

foreach ( $checkRURIs as $checkRURI ) {
    if ( 
        strpos($checkRURI, '<script>') !== false || 
        strpos($checkRURI, '</script>') !== false
    ) {
        ob_end_clean();
        ob_end_clean();
        ob_end_clean();
        header("HTTP/1.0 403 Forbidden - XSS Detected");
        file_put_contents(
            'sites/default/files/debugXSS.log',
            
            "========== XSS ATTACK BLOCKED ==========\n" . 
            "URL: " . $ruri . "\n" . 
            "POST: " . print_r($_POST, true) . "\n" ,
            
            FILE_APPEND
        );
        exit('Exiting - Cross-site-scripting or injection attempt detected.');
    }
}