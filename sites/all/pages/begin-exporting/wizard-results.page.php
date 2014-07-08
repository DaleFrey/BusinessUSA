<div class="results-welcome-top-message">
    <div class="btn-close"></div>
    <p>
        We have analyzed your responses based on four general areas: 
        <a href="#companycommitment">Company Commitment</a>, 
        <a href="#planningandstrategy">Planning and Strategy</a>, 
        <a href="#productreadiness">Product Readiness</a> and 
        <a href="#exportmechanics">Export Mechanics</a>.
    </p>
    <p>
        Results in these four sections contain useful information regarding areas of 
        exporting that may be unfamiliar to your firm or aspects for which you would 
        like to develop deeper knowledge.
    </p>
</div>

<?php
    
// Enabel debug message if the current user is the administrator
    $enabelDebug = false;
    $verbose = array(
        'sorting_phases' => array()
    );
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
    );
    
// Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/begin-exporting/wizard-results.xls'));
    
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
            if ( in_array($tagName, $allWizTags) === true ) {
                $tagIsOfInterset[$tagName] = intval( $potentialResult['assoc'][$tagName] );
                $tagIsOfIntAndSelected[$tagName] = 0;
                if ( $tagIsOfInterset[$tagName] === 1 && intval($tagIsSelected[$tagName]) === 1 ) {
                    $tagIsOfIntAndSelected[$tagName] = 1;
                }
            }
        }
        
        // Run logic code to determin if this potental result should be in the final result set
        extract( $tagIsOfIntAndSelected );
        ob_start();
        /*
            $isEmptySearchQuery = intval(
                !$tagIsSelected['comitted_yes'] && !$tagIsSelected['comitted_no'] && !$tagIsSelected['travel_yes'] && !$tagIsSelected['travel_no'] && !$tagIsSelected['international_yes'] && !$tagIsSelected['international_no'] && !$tagIsSelected['intmarket_yes'] && !$tagIsSelected['intmarket_no'] && !$tagIsSelected['website_yes'] && !$tagIsSelected['website_no'] && !$tagIsSelected['protectip_yes'] && !$tagIsSelected['protectip_no'] && !$tagIsSelected['export_yes'] && !$tagIsSelected['export_no'] && !$tagIsSelected['marketdemand_yes'] && !$tagIsSelected['marketdemand_no'] && !$tagIsSelected['capacityexp_yes'] && !$tagIsSelected['capacityexp_no'] && !$tagIsSelected['shipping_yes'] && !$tagIsSelected['shipping_no'] && !$tagIsSelected['exportfin_yes'] && !$tagIsSelected['exportfin_no'] && !$tagIsSelected['expcontrols_yes'] && !$tagIsSelected['expcontrols_no'] && !$tagIsSelected['foreignlegal_yes'] && !$tagIsSelected['foreignlegal_no']
            );
        */
        $comitted_yesNotSelected = ( intval($tagIsSelected['comitted_yes']) === 0 ? 1 : 0 );
        $travel_yesNotSelected = ( intval($tagIsSelected['travel_yes']) === 0 ? 1 : 0 );
        $international_yesNotSelected = ( intval($tagIsSelected['international_yes']) === 0 ? 1 : 0 );
        $intmarket_yesNotSelected = ( intval($tagIsSelected['intmarket_yes']) === 0 ? 1 : 0 );
        $website_yesNotSelected = ( intval($tagIsSelected['website_yes']) === 0 ? 1 : 0 );
        $protectip_yesNotSelected = ( intval($tagIsSelected['protectip_yes']) === 0 ? 1 : 0 );
        $export_yesNotSelected = ( intval($tagIsSelected['export_yes']) === 0 ? 1 : 0 );
        $marketdemand_yesNotSelected = ( intval($tagIsSelected['marketdemand_yes']) === 0 ? 1 : 0 );
        $capacityexp_yesNotSelected = ( intval($tagIsSelected['capacityexp_yes']) === 0 ? 1 : 0 );
        $shipping_yesNotSelected = ( intval($tagIsSelected['shipping_yes']) === 0 ? 1 : 0 );
        $exportfin_yesNotSelected = ( intval($tagIsSelected['exportfin_yes']) === 0 ? 1 : 0 );
        $expcontrols_yesNotSelected = ( intval($tagIsSelected['expcontrols_yes']) === 0 ? 1 : 0 );
        $foreignlegal_yesNotSelected = ( intval($tagIsSelected['foreignlegal_yes']) === 0 ? 1 : 0 );
        $comitted_no = ( intval($tagIsSelected['comitted_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['comitted_no'];
        $travel_no = ( intval($tagIsSelected['travel_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['travel_no'];
        $international_no = ( intval($tagIsSelected['international_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['international_no'];
        $intmarket_no = ( intval($tagIsSelected['intmarket_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['intmarket_no'];
        $website_no = ( intval($tagIsSelected['website_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['website_no'];
        $protectip_no = ( intval($tagIsSelected['protectip_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['protectip_no'];
        $export_no = ( intval($tagIsSelected['export_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['export_no'];
        $marketdemand_no = ( intval($tagIsSelected['marketdemand_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['marketdemand_no'];
        $capacityexp_no = ( intval($tagIsSelected['capacityexp_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['capacityexp_no'];
        $shipping_no = ( intval($tagIsSelected['shipping_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['shipping_no'];
        $exportfin_no = ( intval($tagIsSelected['exportfin_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['exportfin_no'];
        $expcontrols_no = ( intval($tagIsSelected['expcontrols_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['expcontrols_no'];
        $foreignlegal_no = ( intval($tagIsSelected['foreignlegal_yes']) === 0 ? 1 : 0 ) && $tagIsOfInterset['foreignlegal_no'];
        /*
        Old coe used for when the questions were radio-buttons and not checkboxes
            // When a user does not select YES nor NO, assume NO has been selected
            $comitted_no = intval( $tagIsOfInterset['comitted_no'] && !$tagIsSelected['comitted_yes'] && !$tagIsSelected['comitted_no'] ? 1 : $comitted_no );
            $travel_no = intval( $tagIsOfInterset['travel_no'] && !$tagIsSelected['travel_yes'] && !$tagIsSelected['travel_no'] ? 1 : $travel_no );
            $international_no = intval( $tagIsOfInterset['international_no'] && !$tagIsSelected['international_yes'] && !$tagIsSelected['international_no'] ? 1 : $international_no );
            $intmarket_no = intval( $tagIsOfInterset['intmarket_no'] && !$tagIsSelected['intmarket_yes'] && !$tagIsSelected['intmarket_no'] ? 1 : $intmarket_no );
            $website_no = intval( $tagIsOfInterset['website_no'] && !$tagIsSelected['website_yes'] && !$tagIsSelected['website_no'] ? 1 : $website_no );
            $protectip_no = intval( $tagIsOfInterset['protectip_no'] && !$tagIsSelected['protectip_yes'] && !$tagIsSelected['protectip_no'] ? 1 : $protectip_no );
            $export_no = intval( $tagIsOfInterset['export_no'] && !$tagIsSelected['export_yes'] && !$tagIsSelected['export_no'] ? 1 : $export_no );
            $marketdemand_no = intval( $tagIsOfInterset['marketdemand_no'] && !$tagIsSelected['marketdemand_yes'] && !$tagIsSelected['marketdemand_no'] ? 1 : $marketdemand_no );
            $capacityexp_no = intval( $tagIsOfInterset['capacityexp_no'] && !$tagIsSelected['capacityexp_yes'] && !$tagIsSelected['capacityexp_no'] ? 1 : $capacityexp_no );
            $shipping_no = intval( $tagIsOfInterset['shipping_no'] && !$tagIsSelected['shipping_yes'] && !$tagIsSelected['shipping_no'] ? 1 : $shipping_no );
            $exportfin_no = intval( $tagIsOfInterset['exportfin_no'] && !$tagIsSelected['exportfin_yes'] && !$tagIsSelected['exportfin_no'] ? 1 : $exportfin_no );
            $expcontrols_no = intval( $tagIsOfInterset['expcontrols_no'] && !$tagIsSelected['expcontrols_yes'] && !$tagIsSelected['expcontrols_no'] ? 1 : $expcontrols_no );
            $foreignlegal_no = intval( $tagIsOfInterset['foreignlegal_no'] && !$tagIsSelected['foreignlegal_yes'] && !$tagIsSelected['foreignlegal_no'] ? 1 : $foreignlegal_no );
        */
        $anyTagIsBothOfInterestAndSelected = intval(
            $comitted_yes || $comitted_no || $travel_yes || $travel_no || $international_yes || $international_no || $intmarket_yes || $intmarket_no || $website_yes || $website_no || $protectip_yes || $protectip_no || $export_yes || $export_no || $marketdemand_yes || $marketdemand_no || $capacityexp_yes || $capacityexp_no || $shipping_yes || $shipping_no || $exportfin_yes || $exportfin_no || $expcontrols_yes || $expcontrols_no || $foreignlegal_yes || $foreignlegal_no
        );
        print "
            comitted_yesNotSelected is $comitted_yesNotSelected
            travel_yesNotSelected is $travel_yesNotSelected
            international_yesNotSelected is $international_yesNotSelected
            intmarket_yesNotSelected is $intmarket_yesNotSelected
            website_yesNotSelected is $website_yesNotSelected
            protectip_yesNotSelected is $protectip_yesNotSelected
            export_yesNotSelected is $export_yesNotSelected
            marketdemand_yesNotSelected is $marketdemand_yesNotSelected
            capacityexp_yesNotSelected is $capacityexp_yesNotSelected
            shipping_yesNotSelected is $shipping_yesNotSelected
            exportfin_yesNotSelected is $exportfin_yesNotSelected
            expcontrols_yesNotSelected is $expcontrols_yesNotSelected
            foreignlegal_yesNotSelected is $foreignlegal_yesNotSelected

            comitted_no is $comitted_no 
            travel_no is $travel_no 
            international_no is $international_no 
            intmarket_no is $intmarket_no 
            website_no is $website_no 
            protectip_no is $protectip_no 
            export_no is $export_no 
            marketdemand_no is $marketdemand_no 
            capacityexp_no is $capacityexp_no 
            shipping_no is $shipping_no 
            exportfin_no is $exportfin_no 
            expcontrols_no is $expcontrols_no 
            foreignlegal_no is $foreignlegal_no 
            isEmptySearchQuery is $isEmptySearchQuery
            anyTagIsBothOfInterestAndSelected is $anyTagIsBothOfInterestAndSelected
        ";
        $logicResult = ( 
            $anyTagIsBothOfInterestAndSelected
        );

        if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . ob_get_contents() . '</div>'; }
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
            
            // Override the title (special for this wizard) if nessesary
            $theTitle = $potentialResult['assoc']['title'];
            if ( trim($theTitle) == 'Export Business Planner (Yes) / Representative questionnaire (No)' ) {
                if ( $international_yes ) {
                    $theTitle = 'Export Business Planner';
                }
                if ( $international_no ) {
                    $theTitle = 'Representative questionnaire';
                }
            }
            if ( trim($theTitle) == 'International Logistics (Yes) /Packing, labeling, documentation and insurance requirements (no)' ) {
                if ( $shipping_yes ) {
                    $theTitle = 'International Logistics';
                }
                if ( $shipping_no ) {
                    $theTitle = 'Packing, labeling, documentation and insurance requirements';
                }
            }
            
            // Get and organize the data returned from MySQL into a $newWizardResult variable
            $type = $potentialResult['assoc']['type'];
            $newWizardResult = array(
                'title' => $theTitle,
                'individual-icon' => array(
                    'src' => '/sites/all/themes/bizusa/images/content-types-icons/20X20/' . $potentialResult['assoc']['ctype'] . '.png',
                    'label' => ucwords(strtolower($potentialResult['assoc']['ctype']))
                ),
                'link' => $potentialResult['assoc']['url'],
                'snippet' => $potentialResult['assoc']['snippet'],
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => $type,
                'Wizard Section' => ucwords(str_replace('-', ' ', $potentialResult['assoc']['type'])),
                'ctype' => ucwords(rtrim($potentialResult['assoc']['ctype'], 's')),
                'promoted' => intval($promoted)
            );
            
            $wizardResults->results[ $type ][] = $newWizardResult;
        }
    }
    
// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
    //$wizardResults->results = sortResultsArrayByFields($wizardResults->results, 'promoted', 'tag_count');

// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'federal' => 'Federal',
            'company-commitment' => 'Company Commitment',
            'planning-and-strategy' => 'Planning and Strategy',
            'product-readiness' => 'Product Readiness',
            'export-mechanics' => 'Export Mechanics',
        ),
        'titles-subtitles' => array(
            'federal' => '',
            'company-commitment' => 'This section points you to resources to help gauge your company\'s commitment to exporting, and it also supplies tools to help entry to export markets - including events and business process suggestions.',
            'planning-and-strategy' => 'Planning & Strategy covers marketing and protecting intellectual property abroad, so you can include these items in your business\'s strategic thinking in approaching export markets.',
            'product-readiness' => 'Product Readiness asks you and your business to evaluate two key questions. First, what are the global trends for your product or service? Secondly, what strengths and weaknesses does your product or service have in relation to the global marketplace?',
            'export-mechanics' => 'International logistics requirements - shipping overseas - vary from country to country and can change unexpectedly. To stay current with the latest developments, review these resources on Export Mechanics, below.',
        ),
        'legend' => array(
            'federal' => array(
                'title' => 'Federal Loan Programs',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'company-commitment' => array(
                'title' => 'Company Commitment',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'planning-and-strategy' => array(
                'title' => 'Planning and Strategy',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'product-readiness' => array(
                'title' => 'Product Readiness',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'export-mechanics' => array(
                'title' => 'Export Mechanics',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
        ),
        'sideBars' => array(
            'sidebar-expevents' => overridable('sites/all/pages/begin-exporting/sidebar-expevents.php'),
            'sidebar-begex-useacs' => overridable('sites/all/pages/begin-exporting/sidebar-useacs.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Render results HTML
    print theme('yawizard_sections', $wizardResultsRenderableArray);

?>

<script>
    //script to close the welcome message on close button click
    $(".btn-close").click(function(){

        $(this).parent().hide();
    });

</script>
