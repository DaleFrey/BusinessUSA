<?php

$html = '';

// Enabel debug message if the current user is the administrator
global $user;

$enabelDebug = false;
if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) {
    $enabelDebug = true;
}

// Get the tags selected from the wizard UI (tags of quiestions selected by the user)
$allTags = array_keys($_REQUEST['allTags']);
$tagSelected = $_REQUEST['allTags'];

$tagIsSelected = array();
foreach ( $tagSelected as $key => $value ) {
    $key = trim($key);
    $value = trim($value);
    $tagIsSelected[$key] = $value;
}

// Generate results
global $wizardResults;
$wizardResults =  new stdClass;
$wizardResults->results = array(
    'program' => array(),
    'tools' => array(),
    'training_materials' => array()
);

// Load potential results from excel
$potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/taxes-and-credits/wizard-results.xls'));

// Run through the excels and determin what should be in the result set
foreach ( $potentialResults as $key => $potentialResult ) {

    $tagIsOfInterset = array();

    // initalize this array-variable
    $tagIsOfIntAndSelected = array();
    $allWizTags = array();
    foreach ( $allTags as $wizTag => $value ) {
        $wizTag = trim($wizTag);
        $allWizTags[$wizTag] = trim($value);
        $tagIsOfIntAndSelected[trim($value)] = 0;
    }

    // Set tagIsOfIntAndSelected[BLAH] to 1 if $tagIsOfInterset[BLAH] == 1, and $tagIsSelected[BLAH] == 1
    foreach ( $potentialResult['assoc'] as $tagName => $tagVal) {
        $tagName = trim($tagName);
        $tagIsOfInterset[$tagName] = 0;
        if ( !empty($tagIsSelected[$tagName]) && intval($tagIsSelected[$tagName]) === 1 ) {
            $tagIsOfInterset[$tagName] = intval( $potentialResult['assoc'][$tagName] );
            if ( $tagIsOfInterset[$tagName] === 1 ) {
                $tagIsOfIntAndSelected[$tagName] = 1;
            } else {
                $tagIsOfIntAndSelected[$tagName] = 0;
            }
        }
    }

    // Run logic code to determin if this potental result should be in the final result set
    extract( $tagIsOfIntAndSelected );
    ob_start();
    $emptySearch = intval(
        !$tagIsSelected['small_business'] && !$tagIsSelected['independently_owned'] && !$tagIsSelected['US_Based'] && !$tagIsSelected['empowerment_zone'] &&  !$tagIsSelected['low_income'] && !$tagIsSelected['few_than_25'] &&
        !$tagIsSelected['electric_car'] && !$tagIsSelected['car_in_business'] && !$tagIsSelected['home_for_business'] && !$tagIsSelected['Tax_Benefits'] && !$tagIsSelected['Disaster_Assistance'] && !$tagIsSelected['Taxable_Assets'] &&
        !$tagIsSelected['Food_Beverages'] && !$tagIsSelected['energy_for_business'] && !$tagIsSelected['selling_energy_resources'] && !$tagIsSelected['bio_fuels'] && !$tagIsSelected['research_development'] &&
        !$tagIsSelected['energy_efficient_property'] && !$tagIsSelected['energy_efficient_appliances'] && !$tagIsSelected['mining'] && !$tagIsSelected['pharmaceuticals'] && !$tagIsSelected['railroad_maintenance'] &&
        !$tagIsSelected['alcohol_distribution'] && !$tagIsSelected['veteran'] && !$tagIsSelected['public_assistance'] && !$tagIsSelected['indian_reservation'] && !$tagIsSelected['ex_felon'] && !$tagIsSelected['disabilities'] &&
        !$tagIsSelected['new_hires'] && !$tagIsSelected['retirement_pension'] && !$tagIsSelected['childcare_services'] && !$tagIsSelected['healthcare'] && !$tagIsSelected['selected_community'] &&
        !$tagIsSelected['qualified_equity_investments']
    );
    $isNotStateResource = intval(
        !$tagIsOfInterset['Alabama'] && !$tagIsOfInterset['Alaska'] && !$tagIsOfInterset['American_Samoa'] && !$tagIsOfInterset['Arizona'] && !$tagIsOfInterset['Arkansas'] && !$tagIsOfInterset['California'] &&
        !$tagIsOfInterset['Colorado'] && !$tagIsOfInterset['Connecticut'] && !$tagIsOfInterset['Delaware'] && !$tagIsOfInterset['District_of_Columbia'] && !$tagIsOfInterset['Florida'] && !$tagIsOfInterset['Georgia'] &&
        !$tagIsOfInterset['Guam'] && !$tagIsOfInterset['Hawaii'] && !$tagIsOfInterset['Idaho'] && !$tagIsOfInterset['Illinois'] && !$tagIsOfInterset['Indiana'] && !$tagIsOfInterset['Iowa'] && !$tagIsOfInterset['Kansas'] &&
        !$tagIsOfInterset['Kentucky'] && !$tagIsOfInterset['Louisiana'] && !$tagIsOfInterset['Maine'] && !$tagIsOfInterset['Maryland'] && !$tagIsOfInterset['Massachusetts'] && !$tagIsOfInterset['Michigan'] &&
        !$tagIsOfInterset['Minnesota'] && !$tagIsOfInterset['Mississippi'] && !$tagIsOfInterset['Missouri'] && !$tagIsOfInterset['Montana'] && !$tagIsOfInterset['Nebraska'] && !$tagIsOfInterset['Nevada'] &&
        !$tagIsOfInterset['New_Hampshire'] && !$tagIsOfInterset['New_Jersey'] && !$tagIsOfInterset['New_Mexico'] && !$tagIsOfInterset['New_York'] && !$tagIsOfInterset['North_Carolina'] && !$tagIsOfInterset['North_Dakota'] &&
        !$tagIsOfInterset['Northern_Marianas_Islands'] && !$tagIsOfInterset['Ohio'] && !$tagIsOfInterset['Oklahoma'] && !$tagIsOfInterset['Oregon'] && !$tagIsOfInterset['Pennsylvania'] && !$tagIsOfInterset['Puerto_Rico'] &&
        !$tagIsOfInterset['Rhode_Island'] && !$tagIsOfInterset['South_Carolina'] && !$tagIsOfInterset['South_Dakota'] && !$tagIsOfInterset['Tennessee'] && !$tagIsOfInterset['Texas'] && !$tagIsOfInterset['Utah'] &&
        !$tagIsOfInterset['Vermont'] && !$tagIsOfInterset['Virginia'] && !$tagIsOfInterset['Virgin_Islands'] && !$tagIsOfInterset['Washington'] && !$tagIsOfInterset['West_Virginia'] && !$tagIsOfInterset['Wisconsin'] &&
        !$tagIsOfInterset['Wyoming']
    );
    $oneTagSelected = intval(
        $tagIsSelected['small_business'] + $tagIsSelected['independently_owned'] + $tagIsSelected['US_Based'] + $tagIsSelected['empowerment_zone'] + $tagIsSelected['low_income'] + $tagIsSelected['few_than_25'] +
        $tagIsSelected['electric_car'] + $tagIsSelected['car_in_business'] + $tagIsSelected['home_for_business'] + $tagIsSelected['Tax_Benefits'] + $tagIsSelected['Disaster_Assistance'] + $tagIsSelected['Taxable_Assets'] +
        $tagIsSelected['Food_Beverages'] + $tagIsSelected['energy_for_business'] + $tagIsSelected['selling_energy_resources'] + $tagIsSelected['bio_fuels'] + $tagIsSelected['research_development'] +
        $tagIsSelected['energy_efficient_property'] + $tagIsSelected['energy_efficient_appliances'] + $tagIsSelected['mining'] + $tagIsSelected['pharmaceuticals'] + $tagIsSelected['railroad_maintenance'] +
        $tagIsSelected['alcohol_distribution'] + $tagIsSelected['veteran'] + $tagIsSelected['public_assistance'] + $tagIsSelected['indian_reservation'] + $tagIsSelected['ex_felon'] + $tagIsSelected['disabilities'] +
        $tagIsSelected['new_hires'] + $tagIsSelected['retirement_pension'] + $tagIsSelected['childcare_services'] + $tagIsSelected['healthcare'] + $tagIsSelected['selected_community'] +
        $tagIsSelected['qualified_equity_investments'] === 1
    );
    $taggedWithAtLeastOneInterestedTag = intval(
        $small_business || $independently_owned || $US_Based || $empowerment_zone || $low_income || $few_than_25 || $electric_car || $car_in_business || $home_for_business || $Tax_Benefits || $Disaster_Assistance || $Taxable_Assets ||
        $Food_Beverages || $energy_for_business || $selling_energy_resources || $bio_fuels || $research_development || $energy_efficient_property || $energy_efficient_appliances || $mining || $pharmaceuticals ||
        $railroad_maintenance || $alcohol_distribution || $public_assistance || $veteran || $indian_reservation || $ex_felon || $disabilities || $new_hires || $retirement_pension || $childcare_services || $healthcare ||
        $selected_community || $qualified_equity_investments
    );
    $isOfSelectedState = intval( $tagIsSelected['US_Based'] &&
        ($Alabama || $Alaska || $American_Samoa || $Arizona || $Arkansas || $California || $Colorado || $Connecticut || $Delaware || $District_of_Columbia || $Florida || $Georgia || $Guam || $Hawaii || $Idaho || $Illinois || $Indiana || $Iowa || $Kansas || $Kentucky || $Louisiana || $Maine || $Maryland || $Massachusetts || $Michigan || $Minnesota || $Mississippi || $Missouri || $Montana || $Nebraska || $Nevada || $New_Hampshire || $New_Jersey || $New_Mexico || $New_York || $North_Carolina || $North_Dakota || $Northern_Marianas_Islands || $Ohio || $Oklahoma || $Oregon || $Pennsylvania || $Puerto_Rico || $Rhode_Island || $South_Carolina || $South_Dakota || $Tennessee || $Texas || $Utah || $Vermont || $Virginia || $Virgin_Islands || $Washington || $West_Virginia || $Wisconsin || $Wyoming)
    );
    $oneInEachSection = intval(
        ( $small_business || $independently_owned )
        && ( $electric_car || $car_in_business || $home_for_business || $Tax_Benefits || $Disaster_Assistance || $Taxable_Assets || $Food_Beverages )
        && ( $energy_for_business || $bio_fuels || $research_development || $energy_efficient_property || $energy_efficient_appliances || $selling_energy_resources )
        && ( $mining || $pharmaceuticals || $railroad_maintenance || $alcohol_distribution )
        && ( $veteran || $public_assistance || $indian_reservation || $ex_felon || $disabilities || $new_hires )
        && ( $retirement_pension || $childcare_services || $healthcare || $few_than_25)
        && ( $selected_community || $qualified_equity_investments )
    );
    $contentHasNoInterestedTag = intval(
        $potentialResult['assoc']['not_tagged']
    );
    print "
            emptySearch is $emptySearch
            isNotStateResource is $isNotStateResource
            oneTagSelected is $oneTagSelected
            taggedWithAtLeastOneInterestedTag is $taggedWithAtLeastOneInterestedTag
            isOfSelectedState is $isOfSelectedState
            contentHasNoInterestedTag is $contentHasNoInterestedTag
        ";

    if ($emptySearch){
        $logicResult = ($contentHasNoInterestedTag);
    }
    else{
        $logicResult = (
            $isOfSelectedState
            || ( $taggedWithAtLeastOneInterestedTag && $isNotStateResource )
            || $contentHasNoInterestedTag
        );
    }

    if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . ob_get_contents() . '</div>'; }
    ob_end_clean();

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

        // Search MySQL for this node based on the title
        $targetTitle = $potentialResult['assoc']['title'];

        // Get selected tags associated with this result
        $assocTagsToShow = array();

        if (intval($potentialResult['assoc']['National']) == 1){
            $assocTagsToShow[] = 'National';
        }

        foreach ( $tagIsOfIntAndSelected as $tagName => $thisTagIsSelected ) {
            if ( $thisTagIsSelected ) {
                if ($tagName != 'National'){
                    $assocTagsToShow[] = $tagName;
                }
            }
        }

        if (empty($potentialResult['assoc']['content_type'])){
            $q = "
                    SELECT
                        nid AS nid,
                        n.title AS node_title,
                        n.type AS node_type,
                        usr.name AS uname,
                        CONCAT_WS ('', field_program_purpose_value, field_services_purpose_value, field_tools_detail_text_value) AS snippet
                    FROM node n
                    LEFT JOIN field_data_field_program_purpose progexec ON ( progexec.entity_id = n.nid )
                    LEFT JOIN field_data_field_services_purpose servexec ON ( servexec.entity_id = n.nid )
                    LEFT JOIN field_data_field_tools_detail_text tooldesc ON ( tooldesc.entity_id = n.nid )
                    LEFT JOIN users usr ON ( usr.uid = n.uid )
                    WHERE
                        n.type IN ('program', 'tools')
                        AND title='$targetTitle';
                ";
            $result = db_query($q);

            foreach ($result as $record) {
                $wizardResults->resultCount++;
                $newWizardResult = array(
                    'nid' => $record->nid,
                    'title' => $record->node_title,
                    'snippet' => $record->snippet,
                    'tags' => $assocTagsToShow,
                    'tag_count' => count($assocTagsToShow),
                    'all_tags' => $allWizTags,
                    'type' => $record->node_type,
                    'user' => $record->uname,
                    'promoted' => $promoted
                );

                if ( intval($promoted) > 0 ) {
                    // Push this result to the beginning of the result set
                    array_unshift($wizardResults->results[$record->node_type], $newWizardResult);
                } else {
                    // Add this result to the end of the result set
                    $wizardResults->results[$record->node_type][] = $newWizardResult;
                }

            }
        }
        else{
            $wizardResults->resultCount++;
            $newWizardResult = array(
                'title' => $potentialResult['assoc']['title'],
                'snippet' => $potentialResult['assoc']['content_type'] == 'training_materials' ? $potentialResult['assoc']['snippet'] : 'Form: <a href="' . $potentialResult['assoc']['form_url'] . '" target="_blank">' . $potentialResult['assoc']['form_url'] .'</a><br/>' . $potentialResult['assoc']['snippet'],
                'url' => $potentialResult['assoc']['link'],
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => $potentialResult['assoc']['content_type'],
                'promoted' => $promoted
            );

            if ( intval($promoted) > 0 ) {
                // Push this result to the beginning of the result set
                array_unshift($wizardResults->results[$potentialResult['assoc']['content_type']], $newWizardResult);
            } else {
                // Add this result to the end of the result set
                $wizardResults->results[$potentialResult['assoc']['content_type']][] = $newWizardResult;
            }
        }
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
        'program' => 'Recommended Programs based on your answers',
        'tools' => 'Recommended Tools based on your answers',
        'training_materials' => 'Recommended Videos based on your answers'
    ),
    'legend' => array(
        'program' => array(
            'title' => 'Programs',
            'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
        ),
        'tools' => array(
            'title' => 'Tools',
            'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/tools.png'
        ),
        'training_materials' => array(
            'title' => 'Video',
            'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/video.png'
        ),
    ),
    'sideBars' => array(
        'sidebar-articles' => overridable('sites/all/pages/taxes-and-credits/sidebar-articles.php'),
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
