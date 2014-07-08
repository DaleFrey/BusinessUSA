<?php

    include(overridable('sites/all/pages/jobcenter-wizard/wizard-results-engine-jobcenter-careeronestop-api-helper.php'));

    if ( !empty($_GET['search']) ) {
        
        $apiReturn = careerOneStopAPI_findOccupationCodesByKeyword($_GET['search']);
        
        if ( strpos(request_uri(), '-DEBUG-') !== false ) {
            dsm($apiReturn);
        }
        
        if ( $apiReturn === false ) {
        
            print 'An error has occured while processing this request';
            
        } else {
            
            ob_end_clean();
            ob_end_clean();
            ob_end_clean();
            
            header('Content-Type: application/json');
            print json_encode($apiReturn);
            
            flush();
            exit();
        }
    } else {
        
        print 'Error - No search parameter given in URL query';
        
    }

?>