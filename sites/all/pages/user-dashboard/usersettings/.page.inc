<?php

    // Make sure a [Drupal] user-id was given for us to load information from
    if ( empty($_GET['uid']) || intval($_GET['uid']) === 0 ) {
        while (@ob_end_clean());
        print "Error - Missing the uid URL-query parameter in this page request.";
        exit();
    }

    // Load user information
    $userInfo = user_load(intval($_GET['uid']));
    //dsm( $userInfo );
    
    // Verify certain that certain fields exist in the database 
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
    
    // If the mustSelectMsg parameter was passed, then inform the user they must make a selection
    if ( !empty($_GET['mustSelectMsg']) && intval($_GET['mustSelectMsg']) === 1 ) {
        drupal_add_css(
            '
                /* This CSS is added from usersettings/.page.inc */
                /* Coder Bookmark: CB-WZQ655J-BC */
                .selectwizarderror {
                    display: block !important;
                }
                .dashboardsettings-section-wizards{
                    outline: 2px solid red;
                }
            ',
            array('type' => 'inline')
        );
        
    }
    
    // Pull information from the "Allowed Values" lists form the field_myusa_ownership field, and decide which checkboxes should be ticked/checked
    $ownershipQuestions = list_allowed_values(field_info_field('field_myusa_ownership'));
    foreach ( $ownershipQuestions as $ownershipQuestion => &$ownership ) {
        $questionCheckedValue = false;
        foreach ( $userInfo->field_myusa_ownership['und'] as $ownershipValueContainer ) {
            if ( $ownershipQuestion === $ownershipValueContainer['value'] ) {
                $questionCheckedValue = true;
                break;
            }
        }
        $ownership = array(
            'label' => $ownership,
            'checked' => $questionCheckedValue,
        );
        // If this MyUSA user is femail, we shall check this box
        if ( stripos($ownership['label'], 'Woman') !== false && !empty($_GET['is_woman']) && intval($_GET['is_woman']) === 1 ) {
            $ownership['checked'] = true;
        }
    }
    //dsm( $ownershipQuestions );
    
    // Pull information from the "Allowed Values" lists form the field_myusa_industry field, and decide which checkboxes should be ticked/checked
    $industryQuestions = list_allowed_values(field_info_field('field_myusa_industry'));
    foreach ( $industryQuestions as $industryQuestion => &$industry ) {
        $questionCheckedValue = false;
        foreach ( $userInfo->field_myusa_industry['und'] as $industryValueContainer ) {
            if ( $industryQuestion === $industryValueContainer['value'] ) {
                $questionCheckedValue = true;
                break;
            }
        }
        $industry = array(
            'label' => $industryQuestion,
            'checked' => $questionCheckedValue,
        );
    }
    //dsm( $industryQuestions );
    
    // Get a list of all wizards registered in our system, and determine which tile/wizard checkboxes should be ticked/checked when presenting this form
    $wizards = array();
    foreach ( getAllWizards() as $index => $wizard ) { // Note: The getAllWizards() function is defied in WizardLoader.php
        
        $addWizards = $wizard;
        
        $checkBoxTick = false;
        foreach ( $userInfo->field_myusa_tiles['und'] as $userTile ) {
            if ( $addWizards['field_swimlane_wizurl_value'] === $userTile['value'] ) {
                $checkBoxTick = true;
                break;
            }
        }
        $addWizards['checked'] = $checkBoxTick;
        
        // If this MyUSA user is a Veteran, we shall check the Veteran wizard
        if ( strpos($addWizards['title'], 'Veterans') !== false && !empty($_GET['is_veteran']) && intval($_GET['is_veteran']) === 1 ) {
            $addWizards['checked'] = true;
        }
        
        // Alter wizard names as per the mockup attached to https://tracker.reisys.com/browse/BUSUSA-2449
        if ( strpos($addWizards['title'], 'Veterans') !== false ) {
            $addWizards['title'] = 'Resources For Veterans';
        }
        if ( strpos($addWizards['title'], 'Health') !== false ) {
            $addWizards['title'] = 'Learn about new Healthcare';
        }
        if ( strpos($addWizards['title'], 'Hiring') !== false ) {
            $addWizards['title'] = 'Help with Hiring';
        }
        if ( strpos($addWizards['title'], 'Green') !== false ) {
            $addWizards['title'] = 'Green Opportunities';
        }
        if ( strpos($addWizards['title'], 'Regulations') !== false ) {
            $addWizards['title'] = 'Regulations';
        }
        if ( strpos($addWizards['title'], 'Training') !== false ) {
            $addWizards['title'] = 'Education Portal';
        }
        if ( 
            strpos($addWizards['title'], 'Browse All Resources') === false 
            && strpos($addWizards['title'], 'Tour') === false 
            && strpos($addWizards['title'], 'Certification') === false 
        ) {
            $wizards[] = $addWizards;
        }
    }
    //dsm( $wizards );
    
    /* HANDEL FORM SUBMISSION FROM THE USER-DASHBOARD SETTINGS PAGE */
    if ( !empty($_POST['form_submit']) && strtoupper($_POST['form_submit']) === 'YES' ) { // form_submit is a hidden input within the form, we can use this as a flag in order to tell if there really is a form submission occurring
        
        //dsm("FORM SUBMISSION HAS OCCURRED Coder Bookmark: CB-MJFMW3I-BC ");
        //dsm($_POST);
        
        $userAccountHasChanged = 0;
        
        // Loop through all wizard registered in our system, see if any of these wizards were sent within the form request
        foreach ( $wizards as $wizard ) {
            
            // This would be the id of the checkboxes submitted in the form
            $wizardIdInForm = cssFriendlyString($wizard['field_swimlane_wizurl_value']);
            
            // This would the be value to be stored in the field_myusa_tiles filed in the database
            $wizardIdForUserField = $wizard['field_swimlane_wizurl_value'];
            
            if ( !empty($_POST[$wizardIdInForm]) && $_POST[$wizardIdInForm] === 'on' ) {
                //dsm("The {$wizardIdInForm} wizard is selected, {$wizardIdForUserField} shall be ADDED into the field_myusa_tiles field for this user in the database.");
                $userAccountHasChanged += addValueToUserField('field_myusa_tiles', $userInfo, $wizardIdForUserField);
            } else {
                //dsm("The {$wizardIdInForm} wizard is NOT selected, {$wizardIdForUserField} shall be REMOVED into the field_myusa_tiles field for this user in the database.");
                $userAccountHasChanged += removeValueToUserField('field_myusa_tiles', $userInfo, $wizardIdForUserField);
            }
        }
        
        // Loop through all allowed values in the Ownership section, see if any of these values were sent within the form request
        foreach ( $ownershipQuestions as $ownershipQuestion ) {
            
            // This would be the id of the checkboxes submitted in the form
            $valueInForm = cssFriendlyString($ownershipQuestion['label']);
            
            // This would the be value to be stored in the field_myusa_ownership filed in the database
            $valueForUserField = $ownershipQuestion['label'];
            
            if ( !empty($_POST[$valueInForm]) && $_POST[$valueInForm] === 'on' ) {
                $userAccountHasChanged += addValueToUserField('field_myusa_ownership', $userInfo, $valueForUserField);
            } else {
                $userAccountHasChanged += removeValueToUserField('field_myusa_ownership', $userInfo, $valueForUserField);
            }
        }
        
        // Loop through all allowed values in the Industry section, see if any of these values were sent within the form request
        foreach ( $industryQuestions as $industryQuestion ) {
            
            // This would be the id of the checkboxes submitted in the form
            $valueInForm = cssFriendlyString($industryQuestion['label']);
            
            // This would the be value to be stored in the field_myusa_ownership filed in the database
            $valueForUserField = $industryQuestion['label'];
            
            if ( !empty($_POST[$valueInForm]) && $_POST[$valueInForm] === 'on' ) {
                $userAccountHasChanged += addValueToUserField('field_myusa_industry', $userInfo, $valueForUserField);
            } else {
                $userAccountHasChanged += removeValueToUserField('field_myusa_industry', $userInfo, $valueForUserField);
            }
        }
        
        if ( $userAccountHasChanged > 0 ) {
            user_save($userInfo);
        }
        
        // If this user has no wizards selected, fail validation for this form
        $userInfo = user_load( $userInfo->uid );
        if ( empty($userInfo->field_myusa_tiles) || !is_array($userInfo->field_myusa_tiles) || count($userInfo->field_myusa_tiles) == 0 ) {
            drupal_goto(
                '/user-dashboard/usersettings', 
                array(
                    'query' => array(
                        'uid' => $userInfo->uid,
                        't' => time(), /* only used to bypass Akamai cache */
                        'mustSelectMsg' => 1
                    )
                )
            );
            return 1;
        }
        
        // After form submission is complete, redirect the user back to the user-dashboard (front page)
        drupal_goto('');
    }
    
    /**
     * int addTileToUsersDashboard(int &$user, string $newValue)
     *
     * Adds a value into the field_myusa_tiles field to the given user. If the user 
     * already has this value associated with him, then no action is taken.
     * Returns an integer stating weather or not user-account information was changed
     */
    function addValueToUserField($filedName, $objUser, $newValue) {
        
        // Make sure this user dosnt already have this value under the field_myusa_tiles field
        foreach ( $objUser->{$filedName}['und'] as $fieldValueContainer ) {
            if ( $fieldValueContainer['value'] === $newValue ) {
                return 0;
            }
        }
        
        // Add new value under the field_myusa_tiles field
        $field = &$objUser->{$filedName}['und'];
        $field[] = array(
            'value' => $newValue
        );
        
        return 1;
    }
    
    /**
     * int removeTileFromUsersDashboard(int &$user, string $newValue)
     *
     * Removes a value from the field_myusa_tiles field for the given user. If the user 
     * does not have this value associated with him, then no action is taken.
     * Returns an integer stating weather or not user-account information was changed
     */
    function removeValueToUserField($filedName, $objUser, $newValue) {
        
        // Make sure this user dosnt already have this value under the field_myusa_tiles field
        foreach ( $objUser->{$filedName}['und'] as $index => $fieldValueContainer ) {
        
            // If we have found this value...
            if ( $fieldValueContainer['value'] === $newValue ) {
                
                // Remove value
                unset($objUser->{$filedName}['und'][$index]); 
                // Then reset the keys in this array such that they increment, startting from 0
                $objUser->{$filedName}['und'] = array_values($objUser->{$filedName}['und']);
                
                return 1;
                
            }
        }
        
        return 0;
    }
    
    
    
    
    
    
    
    
    
    