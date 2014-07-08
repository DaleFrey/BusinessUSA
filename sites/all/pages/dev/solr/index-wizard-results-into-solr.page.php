<?php

if ( function_exists('associateWizardTagsWithNodesInDrupalDatabaseForAllWizards') ) {
    kprint_r( associateWizardTagsWithNodesInDrupalDatabaseForAllWizards() );
} else {
    print '
        <h2>
            Error - associateWizardTagsWithNodesInDrupalDatabaseForAllWizards() is not defined
        </h2>
    ';
}