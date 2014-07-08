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
        'general-resources' => array(),
        'resources' => array(),
        'resources-about-federal-incentives' => array(),
    );

		// Load potential results from excel
		$potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/select-usa/wizard-results.xls'));

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
        $isEmptySearchQuery = intval(
            !$tagIsSelected['general_guidelines'] && !$tagIsSelected['visas'] && !$tagIsSelected['incorporation'] && !$tagIsSelected['site_location'] && !$tagIsSelected['business_financing'] && !$tagIsSelected['tax_assistance'] && !$tagIsSelected['aerospace'] && !$tagIsSelected['automotive'] && !$tagIsSelected['biotechnology'] && !$tagIsSelected['chemical'] && !$tagIsSelected['consumer_goods'] && !$tagIsSelected['energy'] && !$tagIsSelected['environmental_technology'] && !$tagIsSelected['financial_services'] && !$tagIsSelected['healthcare'] && !$tagIsSelected['logistics'] && !$tagIsSelected['machinery'] && !$tagIsSelected['media'] && !$tagIsSelected['pharmaceuticals'] && !$tagIsSelected['professional_services'] && !$tagIsSelected['retail_trade'] && !$tagIsSelected['semiconductors'] && !$tagIsSelected['software'] && !$tagIsSelected['textiles'] && !$tagIsSelected['travel'] && !$tagIsSelected['tools'] && !$tagIsSelected['funding'] && !$tagIsSelected['twofunding'] && !$tagIsSelected['information'] && !$tagIsSelected['twoinformation'] && !$tagIsSelected['tax_incentives'] && !$tagIsSelected['twotax_incentives'] && !$tagIsSelected['technical_assistance'] && !$tagIsSelected['twotechnical_assistance']
        );
        $anyTagInteresterAndSelected = intval(
            $federal_incentives_yes || $general_guidelines || $visas || $incorporation || $site_location || $business_financing || $tax_assistance || $aerospace || $automotive || $biotechnology || $chemical || $consumer_goods || $energy || $environmental_technology || $financial_services || $healthcare || $logistics || $machinery || $media || $pharmaceuticals || $professional_services || $retail_trade || $semiconductors || $software || $textiles || $travel || $tools || $funding || $twofunding || $information || $twoinformation || $tax_incentives || $twotax_incentives || $technical_assistance || $twotechnical_assistance
        );
        $stopFromShowingBecauseUserDidNotSelectForthisMarketDataToBeShown = intval(
            !$tagIsSelected['market_data_yes'] && ( intval($potentialResult['assoc']['marketdata_tag_count']) > 0 )
        );
        $logicResult = (
            $isEmptySearchQuery
            || ( !$stopFromShowingBecauseUserDidNotSelectForthisMarketDataToBeShown && $anyTagInteresterAndSelected )
        );
        print "
            general_guidelines is $general_guidelines
            visas is $visas
            incorporation is $incorporation
            site_location is $site_location
            business_financing is $business_financing
            tax_assistance is $tax_assistance
            aerospace is $aerospace
            automotive is $automotive
            biotechnology is $biotechnology
            chemical is $chemical
            consumer_goods is $consumer_goods
            energy is $energy
            environmental_technology is $environmental_technology
            financial_services is $financial_services
            healthcare is $healthcare
            logistics is $logistics
            machinery is $machinery
            media is $media
            pharmaceuticals is $pharmaceuticals
            professional_services is $professional_services
            retail_trade is $retail_trade
            semiconductors is $semiconductors
            software is $software
            textiles is $textiles
            travel is $travel
            tools is $tools
            funding is $funding
            twofunding is $twofunding
            information is $information
            twoinformation is $twoinformation
            tax_incentives is $tax_incentives
            twotax_incentives is $twotax_incentives
            technical_assistance is $technical_assistance
            twotechnical_assistance is $twotechnical_assistance

            isEmptySearchQuery is {$isEmptySearchQuery}
            anyTagInteresterAndSelected is {$anyTagInteresterAndSelected}
            logicResult is {$logicResult}
        ";
        $debugLogic = ob_get_contents();
        if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . $debugLogic . '</div>'; }
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
                    $assocTagsToShow[] = str_replace('two', '', $tagName);
                }
            }

            // Determine (and truncate) the snippet
            $snippet = truncate_utf8($potentialResult['assoc']['snippet'], 250, true, true);

            // Get and organize the data returned from MySQL into a $newWizardResult variable
            $resultCategory = $potentialResult['assoc']['result_section'];
            $wizardResults->results[$resultCategory][] = array(
                'title' => $potentialResult['assoc']['title'],
                'link' => $potentialResult['assoc']['url'],
                'snippet' => $snippet,
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => $resultCategory,
                'promoted' => intval($promoted),
                'html_comment' => $debugLogic
            );
        }
    }

// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
    foreach ( $wizardResults->results as &$result ) {
        $result = sortResultsArrayByFields($result, 'promoted', 'tag_count');
    }

// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $results,
        'titles' => array(
            'general-resources' => 'Recommended General Resources based on your answers',
            'resources' => 'Recommended Resources based on your answers',
            'resources-about-federal-incentives' => 'Recommended Resources About Federal Incentives based on your answers',
        ),
        'legend' => array(
            'general-resources' => array(
                'title' => 'General Resources',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'resources' => array(
                'title' => 'Resources',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'resources-about-federal-incentives' => array(
                'title' => 'Federal Incentives',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
        ),
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
        });
</script>
