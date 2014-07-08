

<?php

    $html = '';
    
// Enabel debug message if the current user is the administrator
    $enabelDebug = false;
    if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) {
        $enabelDebug = true;
    }
    
// Get the tags selected from the wizard UI (tags of quiestions selected by the user)
    $allWizTags = array_keys($_REQUEST['allTags']);
    $tagIsSelected = $_REQUEST['allTags'];
    
// Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'federal' => array(),
        'financing' => array(),
        'other' => array(),
    );
    
    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/access-financing/wizard-results.xls'));
    
    // Determin the target state based on given ZipCode
    $zip = $_POST['inputs']['zip_location'];
    $locInfo = getLatLongFromZipCode($zip);
    $targState = $locInfo['state'];
    $targState = acronymToStateName($targState);
    $targState = str_replace(' ', '_', $targState);
    $targState = strtolower($targState);
    
    // From this point on we should assume the user has checked the tag for the $targState
    $tagIsSelected[$targState] = 1;
    
    // Logic override - If the user has not ticked any checkbox under the Industry slide, assume all checkboxes are ticked
    if ( intval($tagIsSelected['is_agriculture']) === 0  && intval($tagIsSelected['is_child_care']) === 0  && intval($tagIsSelected['is_environment']) === 0  && intval($tagIsSelected['is_health_care']) === 0  && intval($tagIsSelected['is_technology']) === 0  && intval($tagIsSelected['is_tourism']) === 0  && intval($tagIsSelected['is_manufacturing']) === 0  && intval($tagIsSelected['is_contractor']) === 0 ) {
        $tagIsSelected['is_agriculture'] = 1;
        $tagIsSelected['is_child_care'] = 1;
        $tagIsSelected['is_environment'] = 1;
        $tagIsSelected['is_health_care'] = 1;
        $tagIsSelected['is_technology'] = 1;
        $tagIsSelected['is_tourism'] = 1;
        $tagIsSelected['is_manufacturing'] = 1;
        $tagIsSelected['is_contractor'] = 1;
    }
    
    // Run through the excels and determin what should be in the result set
    foreach ( $potentialResults as $potentialRsltRow => $potentialResult ) {
        
        error_log('ping');
        ob_start();
        $tagIsOfInterset = array();
        
        // initalize this array-variable
        $tagIsOfIntAndSelected = array();
        foreach ( $allWizTags as $wizTag ) { 
            $tagIsOfIntAndSelected[$wizTag] = 0;
        }
        
        /* Bug Killer - Make sure that only the state referenced by the user-given ZIP Code is the sate-tag that is selected */
        // First set all state-tags to 0 (unselected)
        $alabama = 0; $alaska = 0; $american_samoa = 0; $arizona = 0; $arkansas = 0; $california = 0; $colorado = 0; $connecticut = 0; $delaware = 0; $district_of_columbia = 0; $florida = 0; $georgia = 0; $guam = 0; $hawaii = 0; $idaho = 0; $illinois = 0; $indiana = 0; $iowa = 0; $kansas = 0; $kentucky = 0; $louisiana = 0; $maine = 0; $maryland = 0; $massachusetts = 0; $michigan = 0; $minnesota = 0; $mississippi = 0; $missouri = 0; $montana = 0; $nebraska = 0; $nevada = 0; $new_hampshire = 0; $new_jersey = 0; $new_mexico = 0; $new_york = 0; $north_carolina = 0; $north_dakota = 0; $northern_marianas_islands = 0; $ohio = 0; $oklahoma = 0; $oregon = 0; $pennsylvania = 0; $puerto_rico = 0; $rhode_island = 0; $south_carolina = 0; $south_dakota = 0; $tennessee = 0; $texas = 0; $utah = 0; $vermont = 0; $virginia = 0; $virgin_islands = 0; $washington = 0; $west_virginia = 0; $wisconsin = 0; $wyoming = 0;
        // Now set the selected state-tag (referenced by ZIP Code) to 1
        $tagIsSelected[$targState] = 1;
        print "Assuming tag $targState to be selected based on ZIP Code ($zip) ";
        
        // Set tagIsOfIntAndSelected[BLAH] to 1 if $tagIsOfInterset[BLAH] == 1, and $tagIsSelected[BLAH] == 1 
        foreach ( $potentialResult['assoc'] as $tagName => $tagVal) {
            if ( !empty($tagIsSelected[$tagName]) && intval($tagIsSelected[$tagName]) === 1 ) {
                if ( intval( $potentialResult['assoc'][$tagName] ) === 1 ) {
                    $tagIsOfIntAndSelected[$tagName] = 1;
                }
            }
        }
        
        $promoted = 0;
        if ( isset($potentialResult['assoc']['promoted']) ) {
            $promoted = $potentialResult['assoc']['promoted'];
        }
        
        // Run logic code to determin if this potental result should be in the final result set
        extract( $tagIsOfIntAndSelected );
        $isFirstSectionStatic = intval(
            strtolower(trim($potentialResult['assoc']['section'])) === 'firstsection'
        );
        $isBlankSearch = intval(
            !$tagIsSelected['is_general_purpose'] && !$tagIsSelected['is_development'] && !$tagIsSelected['is_exporting'] && !$tagIsSelected['is_green'] && !$tagIsSelected['is_military'] && !$tagIsSelected['is_minority'] && !$tagIsSelected['is_woman'] && !$tagIsSelected['is_disabled'] && !$tagIsSelected['is_disaster'] && !$tagIsSelected['is_agriculture'] && !$tagIsSelected['is_child_care'] && !$tagIsSelected['is_environment'] && !$tagIsSelected['is_health_care'] && !$tagIsSelected['is_technology'] && !$tagIsSelected['is_tourism'] && !$tagIsSelected['is_manufacturing'] && !$tagIsSelected['is_contractor'] && !$tagIsSelected['is_training']
        );
        $anyTagSelectedAndOfInt = intval(
            $is_general_purpose || $is_development || $is_exporting || $is_green || $is_military || $is_minority || $is_woman || $is_disabled || $is_disaster || $is_agriculture || $is_child_care || $is_environment || $is_health_care || $is_technology || $is_tourism || $is_manufacturing || $is_contractor || $is_training
        );
        $potentialResultIsInTargetState = intval(
            str_replace(' ', '_', strtoupper(trim($potentialResult['assoc']['State_Name']))) === str_replace(' ', '_', strtoupper($targState))
        );
        $potentialResultIsNational = intval(
            strtoupper(trim($potentialResult['assoc']['State_Name'])) === 'ALL'
        );
        $potentialResultHasAnInterestedIndustry = intval(
            ( intval($potentialResult['assoc']['is_agriculture']) !== 0 ) || ( intval($potentialResult['assoc']['is_child_care']) !== 0 ) || ( intval($potentialResult['assoc']['is_environment']) !== 0 ) || ( intval($potentialResult['assoc']['is_health_care']) !== 0 ) || ( intval($potentialResult['assoc']['is_technology']) !== 0 ) || ( intval($potentialResult['assoc']['is_tourism']) !== 0 ) || ( intval($potentialResult['assoc']['is_manufacturing']) !== 0 ) || ( intval($potentialResult['assoc']['is_contractor']) !== 0 )
        );
        $userHasSelectedAState = intval(
            $tagIsSelected['alabama'] || $tagIsSelected['alaska'] || $tagIsSelected['american_samoa'] || $tagIsSelected['arizona'] || $tagIsSelected['arkansas'] || $tagIsSelected['california'] || $tagIsSelected['colorado'] || $tagIsSelected['connecticut'] || $tagIsSelected['delaware'] || $tagIsSelected['district_of_columbia'] || $tagIsSelected['florida'] || $tagIsSelected['georgia'] || $tagIsSelected['guam'] || $tagIsSelected['hawaii'] || $tagIsSelected['idaho'] || $tagIsSelected['illinois'] || $tagIsSelected['indiana'] || $tagIsSelected['iowa'] || $tagIsSelected['kansas'] || $tagIsSelected['kentucky'] || $tagIsSelected['louisiana'] || $tagIsSelected['maine'] || $tagIsSelected['maryland'] || $tagIsSelected['massachusetts'] || $tagIsSelected['michigan'] || $tagIsSelected['minnesota'] || $tagIsSelected['mississippi'] || $tagIsSelected['missouri'] || $tagIsSelected['montana'] || $tagIsSelected['nebraska'] || $tagIsSelected['nevada'] || $tagIsSelected['new_hampshire'] || $tagIsSelected['new_jersey'] || $tagIsSelected['new_mexico'] || $tagIsSelected['new_york'] || $tagIsSelected['north_carolina'] || $tagIsSelected['north_dakota'] || $tagIsSelected['northern_marianas_islands'] || $tagIsSelected['ohio'] || $tagIsSelected['oklahoma'] || $tagIsSelected['oregon'] || $tagIsSelected['pennsylvania'] || $tagIsSelected['puerto_rico'] || $tagIsSelected['rhode_island'] || $tagIsSelected['south_carolina'] || $tagIsSelected['south_dakota'] || $tagIsSelected['tennessee'] || $tagIsSelected['texas'] || $tagIsSelected['utah'] || $tagIsSelected['vermont'] || $tagIsSelected['virginia'] || $tagIsSelected['virgin_islands'] || $tagIsSelected['washington'] || $tagIsSelected['west_virginia'] || $tagIsSelected['wisconsin'] || $tagIsSelected['wyoming']
        );
        
        /* Determin if this potential-result (from the spreadsheet) should show up in thye result-set, and if so, in which section */
        if ( $isBlankSearch ) {
        
            $logicResult = intval(false); // Assume this result should not be included in the result set by default
            
            // First section logic (blank search)
            if ( $isFirstSectionStatic ) {
                $logicResult = intval(true); // show this result...
                $descidedSection = 'federal'; // ...in section 1
            }
            
            // Second section logic (blank search)
            if (
                $logicResult === intval(false)
                && (
                    ( $userHasSelectedAState && $potentialResultIsInTargetState )
                    || ( $potentialResultIsNational )
                ) && !$potentialResultHasAnInterestedIndustry
            ) {
                $logicResult = intval(true); // show this result...
                $descidedSection = 'financing'; // ...in section 2
            }
            
            // Third section logic (blank search)
            if (
                $logicResult === intval(false)
                && (
                    ( $userHasSelectedAState && $potentialResultIsInTargetState )
                    || ( $potentialResultIsNational )
                ) && $potentialResultHasAnInterestedIndustry
            ) {
                $logicResult = intval(true); // show this result...
                $descidedSection = 'other'; // ...in section 3
            }
            
        } else {
        
            $logicResult = intval(false); // Assume this result should not be included in the result set by default
            
            // First section logic (NON-blank search)
            if ( $isFirstSectionStatic ) {
                $logicResult = intval(true); // show this result...
                $descidedSection = 'federal'; // ...in section 1
            }
            
            // Second section logic (NON-blank search)
            if (
                $logicResult === intval(false)
                && (
                    ( $anyTagSelectedAndOfInt && $userHasSelectedAState && $potentialResultIsInTargetState )
                    || ( $anyTagSelectedAndOfInt && $potentialResultIsNational )
                )
            ) {
                $logicResult = intval(true); // show this result...
                $descidedSection = 'financing'; // ...in section 2
            }
            
            // Third section logic (NON-blank search)
            if (
                $logicResult === intval(false)
                && 
                (
                    (
                        ( $userHasSelectedAState && $potentialResultIsInTargetState )
                        || ( $potentialResultIsNational )
                    )
                    && !$potentialResultHasAnInterestedIndustry
                )
            ) {
                $logicResult = intval(true); // show this result...
                $descidedSection = 'other'; // ...in section 3
            }
        }

        
        print "
            Logic debug code here.
            
            isFirstSectionStatic is $isFirstSectionStatic
            isBlankSearch is $isBlankSearch
            anyTagSelectedAndOfInt is $anyTagSelectedAndOfInt
            potentialResultIsInTargetState is $potentialResultIsInTargetState
            potentialResultIsNational is $potentialResultIsNational
            potentialResultHasAnInterestedIndustry is $potentialResultHasAnInterestedIndustry
            descidedSection is $descidedSection
            userHasSelectedAState is $userHasSelectedAState
            logicResult is $logicResult
        ";
        
        $debugLogicInfo = ob_get_contents();
        $debugLogicInfo .= "\n\npotentialRsltRow = $potentialRsltRow";
        if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . $debugLogicInfo . '</div>'; }
        ob_end_clean();
        
        if ( ! $logicResult ) {
            
            if ( $enabelDebug === true ) {
                $html .= "
                    <div class=\"debug-info\" style=\"display: none;\">
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
							$api_results[$potentialRsltRow] = $potentialResult;
						}
        
            if ( $enabelDebug === true ) {
                $html .= "
                    <div class=\"debug-info\" style=\"display: none;\">
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
                    $assocTagsToShow[] = $tagName;
                }
            }
            
            // Override, force-add loan_type and gov_type column values as tags
            $assocTagsToShow[] = $potentialResult['assoc']['loan_type'];
            $assocTagsToShow[] = $potentialResult['assoc']['gov_type'];

            // Get Industry Type for Excel
            $assocIndustries = '';
            if ( $is_agriculture ) {
                $assocIndustries .= 'Agriculture, ';
            }
            if($is_child_care){
                $assocIndustries .= "Child Care, ";
            }
            if($is_environment){
                $assocIndustries .= "Environmental Management, ";
            }
            if($is_health_care){
                $assocIndustries .= "Healthcare, ";
            }
            if($is_technology){
                $assocIndustries .= "Technology, ";
            }
            if($is_manufacturing){
                $assocIndustries .= "Manufacturing, ";
            }
            if($is_tourism){
                $assocIndustries .= "Tourism, ";
            }
            if($is_contractor){
                $assocIndustries .= "Government Contracting, ";
            }

            $assocIndustries = (strlen($assocIndustries) > 0) ? substr($assocIndustries, 0, -2) : "";

            // Get and organize the data returned into a $newWizardResult variable
            $newWizardResult = array(
                'nid' => -1,
                'title' => $potentialResult['assoc']['title'],
                'url' => $potentialResult['assoc']['link'],
                'link' => $potentialResult['assoc']['link'],
                'snippet' => $potentialResult['assoc']['snippet'],
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => $descidedSection,
                'promoted' => $promoted,
                'learn_more' => $potentialResult['assoc']['link'],
                'industry' => $assocIndustries,
                'html_comment' => $q . "\n\n" . $debugLogicInfo
            );
            
            $wizardResults->results[$descidedSection][] = $newWizardResult;
        }

    }
    
// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
    ob_start();
    foreach ( $wizardResults->results as &$result ) {
        $result = sortResultsArrayByFields($result, 'promoted', 'tag_count');
    }
    
// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'federal' => 'Primary Federal Loan Programs For Small Businesses',
            'financing' => 'Financing Resources based on your answers',
            'other' => 'More Resources For Your Consideration',
        ),
        'legend' => array(
            'federal' => array(
                'title' => 'Loan Programs',
                'img' => 'sites/all/themes/bizusa/images/content-types-icons/20X20/program.png'
            ),
            'financing' => array(
                'title' => 'Financing Resources',
                'img' => 'sites/all/themes/bizusa/images/content-types-icons/20X20/program.png'
            ),
            'other' => array(
                'title' => 'Related Resources',
                'img' => 'sites/all/themes/bizusa/images/content-types-icons/20X20/program.png'
            ),
        ),
        'sideBars' => array(
            'sidebar-lenders' => overridable('sites/all/pages/access-financing/sidebar-lenders.php'),
            'sidebar-Articles' => overridable('sites/all/pages/access-financing/sidebar-Articles.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Print disclaimer 
    print '
    <div class="note-access-financing-container">
        <div id="note-access-financing">
                <div>
                    BusinessUSA does NOT provide grants for starting and expanding a business.<a target="_blank" href="http://business.usa.gov/article/facts-about-government-grants-0"> Read More</a>
                </div>
                <div class="btn-close" style= "background:url(/sites/all/themes/bizusa/images/sbir-images/controls.png) 0px 0px no-repeat"></div>

        </div>
    </div>

    ';

    // Render results HTML
    print theme('yawizard_sections',$wizardResultsRenderableArray);
  ?>

    <script>

        $(document).ready(function()
        {
			$( ".wizard-results-header-container" ).prepend($( ".note-access-financing-container"));
			$( ".wizard-result-sections-container" ).prepend($( ".wizard-results-header-container"));
			$( ".wizard-sidebars-container" ).prepend($( ".share-export-email-container"));
            $('#txtmsglong').hide();
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



          //  *********** view more ******* view less **********************

            $(".viewmore").click(function(){
                var span = jQuery(this).find('span').text();
                if(span == "View More"){
                   $('#txtmsgshort').hide();
                     $('#txtmsglong').show();

                }
                else{
                    $('#txtmsgshort').show();
                    $('#txtmsglong').hide();
                }
            });

            $(".btn-close").click(function(){

                $('#note-access-financing').hide();
            });


        });
</script>
