<?php

    $html = '';
    
// Enabel debug message if the current user is the administrator
    global $user;
    $enabelDebug = false;
    if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) {
        $enabelDebug = true;
    }

// Get the ZipCode input
    $targetState = '';
    if ( !empty($_REQUEST['allTags']['zip_location']) ) {
        $zcInpt = $_REQUEST['allTags']['zip_location'];
        $locInformation = getLatLongFromZipCode($zcInpt); // getLatLongFromZipCode() is deifned in ZipCodeGeolocation.php
        $targetState = strtoupper( stateNameToAcronym($locInformation['state']) );
    }
    
// Get the list of tags used by this wizard
    $allWizTags = array_keys($_REQUEST['allTags']);
    $tagIsSelected = $_REQUEST['allTags'];
    
// Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'resources' => array()
    );
    
    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/disaster-assistance/wizard-results.xls'));
    
    // Run through the excels and determin what should be in the result set
    foreach ( $potentialResults as $key => $potentialResult ) {
    
        $tagIsOfInterset = array();
        
        // initalize this array-variable
        $tagIsOfIntAndSelected = array();
        foreach ( $allWizTags as $wizTag ) { 
            $tagIsOfIntAndSelected[$wizTag] = 0;
        }
        
        // Set tagIsOfIntAndSelected[BLAH] to 1 if $tagIsOfInterset[BLAH] == 1, and $tagIsSelected[BLAH] == 1 
        foreach ( $potentialResult['assoc'] as $tagName => $tagVal) {
            if ( !empty($tagIsSelected[$tagName]) && intval($tagIsSelected[$tagName]) === 1 ) {
                if ( intval( $potentialResult['assoc'][$tagName] ) === 1 ) {
                    $tagIsOfIntAndSelected[$tagName] = 1;
                }
            }
        }
        
        // Run logic code to determin if this potental result should be in the final result set
        extract( $tagIsOfIntAndSelected );
        ob_start();
        $isEmptyQuery = intval(
            !$tagIsSelected['drought'] && !$tagIsSelected['earthquake'] && !$tagIsSelected['flood'] && !$tagIsSelected['hurricane'] && !$tagIsSelected['hurricane_sandy'] && !$tagIsSelected['hurricane_irene'] && !$tagIsSelected['it_hacking'] && !$tagIsSelected['snowstorm'] && !$tagIsSelected['tornado'] && !$tagIsSelected['terrorism'] && !$tagIsSelected['wildfire'] && !$tagIsSelected['volcano'] && !$tagIsSelected['POSSIBLY_UNUSED_do_you_need_help_with_disaster_financing'] && !$tagIsSelected['disaster_loans'] && !$tagIsSelected['usda_loans'] && !$tagIsSelected['POSSIBLY_UNUSED_do_you_need_help_with_your_building'] && !$tagIsSelected['business_structure'] && !$tagIsSelected['personal_structure'] && !$tagIsSelected['national'] && !$tagIsSelected['texas'] && !$tagIsSelected['mississippi'] && !$tagIsSelected['newyork'] && !$tagIsSelected['POSSIBLY_UNUSED_have_you_planned_for_business_continuity'] && !$tagIsSelected['prepare_my_business'] && !$tagIsSelected['restoremyeconomy'] && !$tagIsSelected['business_continuity_planning']
        );
        $anyTagSelectAndOfInterest = intval(
            $drought || $earthquake || $flood || $hurricane || $hurricane_sandy || $hurricane_irene || $it_hacking || $snowstorm || $tornado || $terrorism || $wildfire || $volcano || $POSSIBLY_UNUSED_do_you_need_help_with_disaster_financing || $disaster_loans || $usda_loans || $POSSIBLY_UNUSED_do_you_need_help_with_your_building || $business_structure || $personal_structure || $national || $texas || $mississippi || $newyork || $POSSIBLY_UNUSED_have_you_planned_for_business_continuity || $prepare_my_business || $restoremyeconomy || $business_continuity_planning
        );
        print "
            Debug report here:
            anyTagSelectAndOfInterest is $anyTagSelectAndOfInterest
            isEmptyQuery is $isEmptyQuery
        ";
        $logicResult = (
            ( $isEmptyQuery || $anyTagSelectAndOfInterest )
        );
        // Custom logic alterations - if the given potential results is associated with a state, and that state's ZipCode was not given, filter out this result
        if ( intval($potentialResult['assoc']['texas']) !== 0 && $targetState !== 'TX' ) {
            $logicResult = false;
        }
        if ( intval($potentialResult['assoc']['mississippi']) !== 0 && $targetState !== 'MS' ) {
            $logicResult = false;
        }
        if ( intval($potentialResult['assoc']['newyork']) !== 0 && $targetState !== 'NY' ) {
            $logicResult = false;
        }

        $debugLogicInfo = ob_get_contents();
        $debugLogicInfo .= "\n\npotentialRsltRow = $potentialRsltRow";
        if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . $debugLogicInfo . '</div>'; }
        ob_end_clean();
        
        $html .= '';
        if ( ! $logicResult ) {
            
            if ( $enabelDebug === true ) {
                $html .= "
                    <div style=\"display: none;\" class=\"debug-info\">
                        <!--
                            Not showing result " . $potentialResult['assoc']['title'] . "
                            tagIsOfIntAndSelected is: " . print_r($tagIsOfIntAndSelected, true) . "
                            tagIsSelected is: " . print_r($tagIsSelected, true) . "
                        -->
                    </div>
                ";
            }
            
        } else {
        
						// NJB -- if this is being invoked from the api, remove the unneeded record from $api_records
						if (isset($api_results)) {
							$api_results[$key] = $potentialResult;
						}
        
            if ( $enabelDebug === true ) {
                $html .= "
                    <div style=\"display: none;\" class=\"debug-info\">
                        <!--   
                            
                            DEBUG
                            
                            Logic is: $logicCode
                            
                            tagIsOfIntAndSelected is: " . print_r($tagIsOfIntAndSelected, true) . "
                            
                            potentialResult is: " . print_r($potentialResult, true) . "
                        -->
                    </div>
                ";
            }
            
            $promoted = 0;
            if ( isset($potentialResult['assoc']['promoted']) ) {
                $promoted = $potentialResult['assoc']['promoted'];
            }
            
            // Get selected tags associated with this result
            $assocTagsToShow = array();
            foreach ( $tagIsOfIntAndSelected as $tagName => $thisTagIsSelected ) {
                if ( $thisTagIsSelected ) {
                    $assocTagsToShow[] = $tagName;
                }
            }
            
            // Get and organize the data returned from MySQL into a $newWizardResult variable
            $wizardResults->resultCount++;
            $wizardResults->results['resources'][] = array(
                'title' => $potentialResult['assoc']['title'],
                'snippet' => truncate_utf8($potentialResult['assoc']['snippet'], 350, true, true),
                'link' => $potentialResult['assoc']['link'],
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => 'resources',
                'user' => $record->uname,
                'promoted' => intval($promoted),
                'html_comment' => $q . "\n\n" . $debugLogicInfo
            );
            
        }
    }
    
// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
    foreach ( $wizardResults->results as &$result ) {
        $result = sortResultsArrayByFields($result, 'promoted', 'tag_count');
    }
    
// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'resources' => 'Recommended Resources based on your answers'
        ),
        'legend' => array(
            'resources' => array(
                'title' => 'Resources',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            )
        ),
        'sideBars' => array(
            'sidebar-articles' => overridable('sites/all/pages/disaster-assistance/sidebar-articles.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Render results HTML
    print theme('yawizard_sections', $wizardResultsRenderableArray);
