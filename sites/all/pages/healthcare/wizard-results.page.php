<?php
    
    $html = '';
    
// Enabel debug message if the current user is the administrator
    $enabelDebug = false;
    $verbose = array(
        'sorting_phases' => array()
    );
    if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) {
        $enabelDebug = true;
    }

// Get the list of tags used by this wizard
    $allWizTags = array_keys($_REQUEST['allTags']);
    $tagIsSelected = $_REQUEST['allTags'];
    
// Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'provision' => array(),
        'advanced_provision' => array(),
    );
    
    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/healthcare/wizard-results.xls'));
    
    // Run through the excels and determin what should be in the result set
    foreach ( $potentialResults as $potResultId => $potentialResult ) {
        
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
        $isEmptySearchQuery = intval(
            !$tagIsSelected['Self_Employed'] && !$tagIsSelected['Employee_less_25'] && !$tagIsSelected['Employee_less_50'] && !$tagIsSelected['Employee_more_50'] && !$tagIsSelected['Currently_Yes'] && !$tagIsSelected['NotCurrent_Planning'] && !$tagIsSelected['NotCurrent_NotPlanned'] 
        );
        $taggedWithAtleast1Intrest = intval(
            $Self_Employed || $Employee_less_25 || $Employee_less_50 || $Employee_more_50 || $Currently_Yes || $NotCurrent_Planning || $NotCurrent_NotPlanned || $Current_Planning || $TwoCurrently_Yes || $never_TwoCurrently_Yes || $TwoNotCurrent_Planning || $never_TwoNotCurrent_Planning || $TwoNotCurrent_NotPlanned
        );
        $selectedAtLeast1TagInEachSection = intval(
            ( $tagIsSelected['Self_Employed'] || $tagIsSelected['Employee_less_25'] || $tagIsSelected['Employee_less_50'] || $tagIsSelected['Employee_more_50'])
            && ( $tagIsSelected['Currently_Yes'] || $tagIsSelected['NotCurrent_Planning'] || $tagIsSelected['NotCurrent_NotPlanned'] )
        );
        $taggedWithAtleast1IntInEachSection = intval(
            ( $Self_Employed || $Employee_less_25 || $Employee_less_50 || $Employee_more_50 )
            && ( $Currently_Yes || $NotCurrent_Planning || $NotCurrent_NotPlanned )
        );
        $contentAssocWithState = intval( 
            $potentialResult['assoc']['has_state_assoc']
        );
        $contentAssocWithNational = intval(
            $potentialResult['assoc']['National']
        );
        $taggedWithIntrestedAndSelectedState = intval( 
            $Alabama || $Alaska || $American_Samoa || $Arizona || $Arkansas || $California || $Colorado || $Connecticut || $Delaware || $District_of_Columbia || $Florida || $Georgia || $Guam || $Hawaii || $Idaho || $Illinois || $Indiana || $Iowa || $Kansas || $Kentucky || $Louisiana || $Maine || $Maryland || $Massachusetts || $Michigan || $Minnesota || $Mississippi || $Missouri || $Montana || $Nebraska || $Nevada || $New_Hampshire || $New_Jersey || $New_Mexico || $New_York || $North_Carolina || $North_Dakota || $Northern_Marianas_Islands || $Ohio || $Oklahoma || $Oregon || $Pennsylvania || $Puerto_Rico || $Rhode_Island || $South_Carolina || $South_Dakota || $Tennessee || $Texas || $Utah || $Vermont || $Virginia || $Virgin_Islands || $Washington || $West_Virginia || $Wisconsin || $Wyoming 
        );
        $userHasNotSelectedAState = intval( 
            !$tagIsSelected['Alabama'] && !$tagIsSelected['Alaska'] && !$tagIsSelected['American_Samoa'] && !$tagIsSelected['Arizona'] && !$tagIsSelected['Arkansas'] && !$tagIsSelected['California'] && !$tagIsSelected['Colorado'] && !$tagIsSelected['Connecticut'] && !$tagIsSelected['Delaware'] && !$tagIsSelected['District_of_Columbia'] && !$tagIsSelected['Florida'] && !$tagIsSelected['Georgia'] && !$tagIsSelected['Guam'] && !$tagIsSelected['Hawaii'] && !$tagIsSelected['Idaho'] && !$tagIsSelected['Illinois'] && !$tagIsSelected['Indiana'] && !$tagIsSelected['Iowa'] && !$tagIsSelected['Kansas'] && !$tagIsSelected['Kentucky'] && !$tagIsSelected['Louisiana'] && !$tagIsSelected['Maine'] && !$tagIsSelected['Maryland'] && !$tagIsSelected['Massachusetts'] && !$tagIsSelected['Michigan'] && !$tagIsSelected['Minnesota'] && !$tagIsSelected['Mississippi'] && !$tagIsSelected['Missouri'] && !$tagIsSelected['Montana'] && !$tagIsSelected['Nebraska'] && !$tagIsSelected['Nevada'] && !$tagIsSelected['New_Hampshire'] && !$tagIsSelected['New_Jersey'] && !$tagIsSelected['New_Mexico'] && !$tagIsSelected['New_York'] && !$tagIsSelected['North_Carolina'] && !$tagIsSelected['North_Dakota'] && !$tagIsSelected['Northern_Marianas_Islands'] && !$tagIsSelected['Ohio'] && !$tagIsSelected['Oklahoma'] && !$tagIsSelected['Oregon'] && !$tagIsSelected['Pennsylvania'] && !$tagIsSelected['Puerto_Rico'] && !$tagIsSelected['Rhode_Island'] && !$tagIsSelected['South_Carolina'] && !$tagIsSelected['South_Dakota'] && !$tagIsSelected['Tennessee'] && !$tagIsSelected['Texas'] && !$tagIsSelected['Utah'] && !$tagIsSelected['Vermont'] && !$tagIsSelected['Virginia'] && !$tagIsSelected['Virgin_Islands'] && !$tagIsSelected['Washington'] && !$tagIsSelected['West_Virginia'] && !$tagIsSelected['Wisconsin'] && !$tagIsSelected['Wyoming'] 
        );
        $always_show_when_state_selected = intval(
            $potentialResult['assoc']['always_show_when_state_selected']
        );
        
        $logicResult = (
            ( $taggedWithAtleast1Intrest && $taggedWithIntrestedAndSelectedState ) 
            || ( $taggedWithAtleast1Intrest && $userHasNotSelectedAState && $contentAssocWithNational )
            || ( $taggedWithAtleast1Intrest && !$contentAssocWithState && !$contentAssocWithNational )
            || ( $always_show_when_state_selected && $taggedWithIntrestedAndSelectedState )
            || ( $always_show_when_state_selected && $taggedWithAtleast1Intrest && $userHasNotSelectedAState && $contentAssocWithNational )
        );
        
        // Override - if the user has selected 'Have 50 or more employees' and the spreadsheet has a 1 in the 'never_employee_more_50' column for this potential-result, do NOT include this one in the result-set
        if ( !empty($potentialResult['assoc']['never_employee_more_50']) && intval($potentialResult['assoc']['never_employee_more_50']) === 1 && intval($tagIsSelected['Employee_more_50']) === 1 ) {
            $logicResult = intval(false);
        }
        // Override - if the user has selected 'TwoCurrently_Yes' tag and the spreadsheet has a 1 in the 'never_TwoCurrently_Yes' column for this potential-result, do NOT include this one in the result-set
        if ( !empty($potentialResult['assoc']['never_TwoCurrently_Yes']) && intval($potentialResult['assoc']['never_TwoCurrently_Yes']) === 1 && intval($tagIsSelected['TwoCurrently_Yes']) === 1 ) {
            $logicResult = intval(false);
        }
        // Override - if the user has selected 'TwoNotCurrent_Planning' tag and the spreadsheet has a 1 in the 'never_TwoNotCurrent_Planning' column for this potential-result, do NOT include this one in the result-set
        if ( !empty($potentialResult['assoc']['never_TwoNotCurrent_Planning']) && intval($potentialResult['assoc']['never_TwoNotCurrent_Planning']) === 1 && intval($tagIsSelected['TwoNotCurrent_Planning']) === 1 ) {
            $logicResult = intval(false);
        }
        // Override - if the user has selected 'TwoNotCurrent_NotPlanned' tag and the spreadsheet has a 1 in the 'never_TwoNotCurrent_NotPlanned' column for this potential-result, do NOT include this one in the result-set
        if ( !empty($potentialResult['assoc']['never_TwoNotCurrent_NotPlanned']) && intval($potentialResult['assoc']['never_TwoNotCurrent_NotPlanned']) === 1 && intval($tagIsSelected['TwoNotCurrent_NotPlanned']) === 1 ) {
            $logicResult = intval(false);
        }
        // Override - if the user has selected 'Employee_less_25' tag and the spreadsheet has a 1 in the 'never_Employee_less_25' column for this potential-result, do NOT include this one in the result-set
        if ( !empty($potentialResult['assoc']['never_Employee_less_25']) && intval($potentialResult['assoc']['never_Employee_less_25']) === 1 && intval($tagIsSelected['Employee_less_25']) === 1 ) {
            $logicResult = intval(false);
        }
        // Override - if the user has selected 'Employee_less_50' tag and the spreadsheet has a 1 in the 'never_Employee_less_50' column for this potential-result, do NOT include this one in the result-set
        if ( !empty($potentialResult['assoc']['never_Employee_less_50']) && intval($potentialResult['assoc']['never_Employee_less_50']) === 1 && intval($tagIsSelected['Employee_less_50']) === 1 ) {
            $logicResult = intval(false);
        }
        // Override - if the user has selected 'Self_Employed' tag and the spreadsheet has a 1 in the 'never_Self_Employed' column for this potential-result, do NOT include this one in the result-set
        if ( !empty($potentialResult['assoc']['never_Self_Employed']) && intval($potentialResult['assoc']['never_Self_Employed']) === 1 && intval($tagIsSelected['Self_Employed']) === 1 ) {
            $logicResult = intval(false);
        }
        
        // Default promotion (decides the order in which results show in the resultset)
        $promoted = 0;
        if ( isset($potentialResult['assoc']['promoted']) ) {
            $promoted = $potentialResult['assoc']['promoted'];
        }
        
        // Promotion override - If the tag Self_Employed is selected, then check the promoted_Self_Employed column for the value $promoted should be set to
        if ( $tagIsSelected['Self_Employed'] ) {
            print "Checking promoted_Self_Employed column for override of promotion\n";
            if ( !empty($potentialResult['assoc']['promoted_Self_Employed']) ) {
                $checkPromo = intval( $potentialResult['assoc']['promoted_Self_Employed'] );
                if ( $checkPromo > 0 ) {
                    $promoted = $checkPromo;
                }
            }
        }
        // Promotion override - If the tag Employee_less_25 is selected AND (the Currently_Yes OR the Current_Planning tag is selected), then check the promoted_Employee_less_25_yes column for the value $promoted should be set to
        if ( $tagIsSelected['Employee_less_25'] && ( $tagIsSelected['Currently_Yes'] || $tagIsSelected['Current_Planning'] ) ) {
            print "Checking promoted_Employee_less_25_yes column for override of promotion\n";
            if ( !empty($potentialResult['assoc']['promoted_Employee_less_25_yes']) ) {
                $checkPromo = intval( $potentialResult['assoc']['promoted_Employee_less_25_yes'] );
                if ( $checkPromo > 0 ) {
                    $promoted = $checkPromo;
                }
            }
        }
        // Promotion override - If the tags Employee_less_25 AND NotCurrent_NotPlanned are selected, then check the promoted_Employee_less_25_no column for the value $promoted should be set to
        if ( $tagIsSelected['Employee_less_25'] && $tagIsSelected['NotCurrent_NotPlanned'] ) {
            print "Checking promoted_Employee_less_25_no column for override of promotion\n";
            if ( !empty($potentialResult['assoc']['promoted_Employee_less_25_no']) ) {
                $checkPromo = intval( $potentialResult['assoc']['promoted_Employee_less_25_no'] );
                if ( $checkPromo > 0 ) {
                    $promoted = $checkPromo;
                }
            }
        }
        // Promotion override - If the tags Employee_less_50 AND NotCurrent_NotPlanned are selected, then check the promoted_Employee_less_25_no column for the value $promoted should be set to
        if ( $tagIsSelected['Employee_less_50'] && $tagIsSelected['NotCurrent_NotPlanned'] ) {
            print "Checking promoted_Employee_less_50_no column for override of promotion\n";
            if ( !empty($potentialResult['assoc']['promoted_Employee_less_50_no']) ) {
                $checkPromo = intval( $potentialResult['assoc']['promoted_Employee_less_50_no'] );
                if ( $checkPromo > 0 ) {
                    $promoted = $checkPromo;
                }
            }
        }
        // Promotion override - If the tags Employee_more_50 AND TwoNotCurrent_NotPlanned are selected, then check the promoted_Employee_more_50_TwoNotCurrent_NotPlanned column for the value $promoted should be set to
        if ( $tagIsSelected['Employee_more_50'] && $tagIsSelected['TwoNotCurrent_NotPlanned'] ) {
            print "Checking promoted_Employee_more_50_TwoNotCurrent_NotPlanned column for override of promotion\n";
            if ( !empty($potentialResult['assoc']['promoted_Employee_more_50_TwoNotCurrent_NotPlanned']) ) {
                $checkPromo = intval( $potentialResult['assoc']['promoted_Employee_more_50_TwoNotCurrent_NotPlanned'] );
                if ( $checkPromo > 0 ) {
                    $promoted = $checkPromo;
                }
            }
        }
        // Promotion override - If the tag Employee_less_50 is selected AND (the Current_Planning OR the Currently_Yes tag is selected) then check the promoted_Employee_less_50_yes column for the value $promoted should be set to
        if ( $tagIsSelected['Employee_less_50'] && ( $tagIsSelected['Current_Planning'] || $tagIsSelected['Currently_Yes'] ) ) {
            print "Checking promoted_Employee_less_50_yes column for override of promotion\n";
            if ( !empty($potentialResult['assoc']['promoted_Employee_less_50_yes']) ) {
                $checkPromo = intval( $potentialResult['assoc']['promoted_Employee_less_50_yes'] );
                if ( $checkPromo > 0 ) {
                    $promoted = $checkPromo;
                }
            }
        }
        // Promotion override - If the (Employee_less_25 OR Employee_less_50) tags are selected AND the Current_Planning tag is selected, then check the promoted_Employee_less_25_Employee_less_50_Current_Planning column for the value $promoted should be set to
        if ( ( $tagIsSelected['Employee_less_25'] || $tagIsSelected['Employee_less_50'] ) && $tagIsSelected['Current_Planning'] ) {
            print "Checking promoted_Employee_less_25_Employee_less_50_Current_Planning column for override of promotion\n";
            if ( !empty($potentialResult['assoc']['promoted_Employee_less_25_Employee_less_50_Current_Planning']) ) {
                $checkPromo = intval( $potentialResult['assoc']['promoted_Employee_less_25_Employee_less_50_Current_Planning'] );
                if ( $checkPromo > 0 ) {
                    $promoted = $checkPromo;
                }
            }
        }
        
        print "
            Row from Excel: $potResultId
            
            isEmptySearchQuery is $isEmptySearchQuery
            contentAssocWithState is $contentAssocWithState
            selectedAtLeast1TagInEachSection is $selectedAtLeast1TagInEachSection
            taggedWithAtleast1Intrest is $taggedWithAtleast1Intrest
            taggedWithAtleast1IntInEachSection is $taggedWithAtleast1IntInEachSection
            taggedWithIntrestedAndSelectedState is $taggedWithIntrestedAndSelectedState
            National is $National
            userHasNotSelectedAState is $userHasNotSelectedAState
            contentAssocWithNational is $contentAssocWithNational
            always_show_when_state_selected is $always_show_when_state_selected
            logicResult is $logicResult
            
            promoted is $promoted
        ";

        $thisDebugHTML = ob_get_contents();
        if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . $thisDebugHTML . '</div>'; }
        ob_end_clean();
        
        $html .= '';
        if ( ! $logicResult || trim($potentialResult['assoc']['title']) === '' ) {
            
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
							$api_results[$potResultId] = $potentialResult;
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
            
            // Get selected tags associated with this result
            $assocTagsToShow = array();
            foreach ( $tagIsOfIntAndSelected as $tagName => $thisTagIsSelected ) {
                if ( $thisTagIsSelected ) {
                    $assocTagsToShow[] = str_ireplace('two', '', $tagName);
                }
            }
            
            // Get and organize the data into a $newWizardResult variable
            $type = $potentialResult['assoc']['type'];
            $wizardResults->results[$type][] = array(
                'nid' => $nid,
                'title' => $potentialResult['assoc']['title'],
                'link' => $potentialResult['assoc']['url'],
                'url' => $potentialResult['assoc']['url'],
                'snippet' => truncate_utf8($potentialResult['assoc']['snippet'], 200, true, true),
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => $type,
                'user' => $record->uname,
                'promoted' => intval($promoted),
                'html_comment' => $thisDebugHTML
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
            'provision' => 'Health Care Insurance Options And Changes You Should Know About',
            'advanced_provision' => 'Health Care Insurance Options And Changes You Should Know About'
        ),
        'legend' => array(
            'provision' => array(
                'title' => 'Provisions',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/provision.png'
            ),
            'advanced_provision' => array(
                'title' => 'Advanced Provisions',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/provision.png'
            ),
        ),
        'sideBars' => array(
            'connectwithus' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-connectwithus.php'),
            'upcomingevents' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-upcomingevents.php'),
            'featinfo' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-featinfo.php'),
            'recenthealthblog' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-recenthealthblog.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Print disclaimer 
    print '
        <div class="note-healthcare-container">
            <div id="note-healthcare">
                    <a class="btn-close" href="javascript: jQuery(\'.note-healthcare-container\').fadeOut(); void(0);" style="background:url(/sites/all/themes/bizusa/images/sbir-images/controls.png) 0px 0px no-repeat">
                        <!-- No content -->
                    </a>
                    <div>
                        The Affordable Care Act was signed into law in March, 2010, and some 
                        of its provisions are already in effect. These provisions focus on 
                        consumer protection, improving health care coverage and giving 
                        purchasers more value for their premium dollars. More changes are taking 
                        effect in late 2013 and beyond. Starting October 1, 2013, many individuals, 
                        self-employed, and small businesses will have a new way to shop for 
                        private health insurance through the Health Insurance Marketplace and its 
                        Small Business Health Options Program (the SHOP Marketplace), and 
                        may be eligible for tax credits and financial assistance. Starting in 2015, 
                        businesses with 50 or more employees who don\'t offer insurance that 
                        meets certain minimum standards to their full-time employees could be 
                        required to make an Employer Shared Responsibility payment. 96% of 
                        businesses are below this threshold and will not be affected by the shared 
                        responsibility rules. Learn more below.
                    </div>
            </div>
        </div>
        
        <!-- This ugly hack will need to be refactored at a later time... -->
        <script>
            /* This ugly hack will need to be refactored at a later time */
            jQuery( ".wizard-sidebars-container" ).prepend(jQuery( ".share-export-email-container"));
            jQuery(".wizard-result-sections-container").prepend(jQuery(".wizard-results-header-container"));
            jQuery(".wizard-result-sections-container").prepend(jQuery(".note-healthcare-container"));
        </script>
    ';
    
// Render results HTML
    print theme('yawizard_sections', $wizardResultsRenderableArray);
?>
<script>

    $(document).ready(function()
    {

        jQuery('a').each( function () {
            var jqThis = jQuery(this);
            if (jqThis.attr('href') && typeof jqThis.attr('href') != "undefined"){
                if( jqThis.attr("href").indexOf(location.hostname)==-1 && (jqThis.attr('href').indexOf('http://') == 0||jqThis.attr('href').indexOf('https://') == 0) )
                {
                    var newHref = '/external-site?ccontent=' + jqThis.attr('href');
                    jqThis.attr('href', newHref);
                    jqThis.attr('target','_blank');
                }
            }
        });

        $( ".sharewidget-toggler").unbind( "click" );//unbind previous click events to prevent multiple firings
        jQuery(".sharewidget-toggler").bind("click",function(e){
            jQuery(this).toggleClass("sharewidget-toggler-active");
            if( ($('.sharewidget-popup').is(":visible")) && ($('#exportexcelWidget-popup').is(":visible")))
            {
                $('#exportexcelWidget-popup').fadeOut();
            }
        });
    })

</script>
