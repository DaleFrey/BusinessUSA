<?php
    
    $wizardHTML = theme(
        'yawizard_from_excel', 
        array(
            'path' => overridable('sites/all/pages/veterans/wizard-questions.xls'),
            'resultsURL' => '/veterans/wizard-results'
        )
    );
    
    if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
        global $overrideBodyMarkup;
        $overrideBodyMarkup = $wizardHTML;
    } else {
        print $wizardHTML;
    }