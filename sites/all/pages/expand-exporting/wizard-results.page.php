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

// Get the tags selected from the wizard UI (tags of quiestions selected by the user)
    $allWizTags = array_keys($_REQUEST['allTags']);
    $tagIsSelected = $_REQUEST['allTags'];
    
// Determin location information based on given ZipCode (if one has been given)
    $givenZip = $_POST['inputs']['zip_location'];
    $locationInfo = getLatLongFromZipCode($givenZip); // getLatLongFromZipCode() is defined in ZipCodeGeolocation.php
    $givenCity = $locationInfo['city'];
    $givenState = $locationInfo['state'];
    
// Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'program' => array(),
        'resources' => array(),
        'articles' => array(),
    );
    
    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/expand-exporting/wizard-results.xls'));
    
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
        
        /* Run logic code to determin if this potental result should be in the final result set */
        extract( $tagIsOfIntAndSelected );
        ob_start();
        $anyTagSelected = intval(
            $wc_smallmedbiz_yes || $wc_smallmedbiz_no || $ins_smallmedbiz_yes || $ins_smallmedbiz_no || $financing || $transportation || $agriculture || $renewable_energy || $currency_guarnatee || $overseas_project_planning || $foreign_investment || $mdbs || $ifis || $export_finance || $information_trade_finance_associations || $basics_of_trade_export_finance 
        );
        $insurance_broker_financial_institution = intval($potentialResult['assoc']['insurance_broker_financial_institution']);
        // Offices pulled from http://export.gov/eac/ - to be used when the user navigiates through the wizard through "Not sure - Need Help" > "Personalized assistance by phone or in person"
        // Offices pulled from http://www.exim.gov/about/whoweare/partners/insurance-brokers.cfm
        //     to be used when the user navigiates through the wizard through "Not sure - Need Help" > "An insurance broker [..]"
        $givenZipMatches_location_city_state_assoc = intval( strtolower($potentialResult['assoc']['location_city_state_assoc']) === strtolower($givenCity . ', ' . $givenState) );
        // Always show all articles
        $static_result_always_show = intval($potentialResult['assoc']['static_result_always_show']);
        $logicResult = intval(
            $anyTagSelected
            || ( $personalized_assistance && $givenZipMatches_location_city_state_assoc )
            || ( $insurance_broker_financial_institution && $givenZipMatches_location_city_state_assoc ) 
            || $static_result_always_show
        );
        print "
            wc_smallmedbiz_yes is $wc_smallmedbiz_yes
            wc_smallmedbiz_no is $wc_smallmedbiz_no
            ins_smallmedbiz_yes is $ins_smallmedbiz_yes
            ins_smallmedbiz_no is $ins_smallmedbiz_no
            financing is $financing
            transportation is $transportation
            agriculture is $agriculture
            renewable_energy is $renewable_energy
            currency_guarnatee is $currency_guarnatee
            overseas_project_planning is $overseas_project_planning
            foreign_investment is $foreign_investment
            mdbs is $mdbs
            ifis is $ifis
            export_basics is $export_basics
            personalized_assistance is $personalized_assistance
            export_finance is $export_finance
            trade_finance is $trade_finance
            insurance_broker_financial_institution is $insurance_broker_financial_institution
            givenZipMatches_location_city_state_assoc is $givenZipMatches_location_city_state_assoc
            static_result_always_show is $static_result_always_show

            anyTagSelected is $anyTagSelected
            
            logicResult is $logicResult
        ";
        if ( $enabelDebug === true ) {
            $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . ob_get_contents() . '</div>';
            $thisResultHtmlComment = ob_get_contents();
        }
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
            
            $promoted = 3;
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
            
            $wizardResults->resultCount++;
            $newWizardResult = array(
                'title' => $potentialResult['assoc']['title'],
                'link' => $potentialResult['assoc']['link'],
                'snippet' => $potentialResult['assoc']['snippet'],
                'tags' => array(),
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => $potentialResult['assoc']['ctype'],
                'promoted' => intval($promoted),
                'html_comment' => $thisResultHtmlComment
            );
            
            $wizardResults->results[ $potentialResult['assoc']['ctype'] ][] = $newWizardResult;
        }
    }
    
// Special case - when the user selects the basics_of_trade_export_finance tag, add the first 3 events found in the RSS Events-feed from ExIm.gov and ustda.gov
if ( intval($tagIsSelected['basics_of_trade_export_finance']) === 1 ) {
    
    $appendResultsExIm = getFirstThreeEventsFomRssFeed('http://www.exim.gov/newsandevents/index.cfm?xml=Ex-Im%20Bank%20Events,RSS2.0');
    $appendResultsUSTDA = getFirstThreeEventsFomRssFeed('http://www.ustda.gov/ustdaevents.xml');
    $appendResults = array_merge($appendResultsExIm, $appendResultsUSTDA);
    
    foreach ($appendResults as $arrIndex => $appendResult) {
        $newWizardResult = array(
            'title' => strip_tags( strval($appendResult['title']) ),
            'link' => strip_tags( strval($appendResult['link']) ),
            'snippet' => strip_tags( strval($appendResult['description']) ),
            'tags' => ( $arrIndex > 2 ? array('USTDA Event') : array('Ex-Im Event') ),
            'tag_count' => count($assocTagsToShow),
            'all_tags' => $allWizTags,
            'type' => 'program',
            'promoted' => 8,
            'html_comment' => 'Imported from templates/wizard/wizard-results-engine-internationalfinance.php::getFirstThreeEventsFomRssFeed() - http://www.exim.gov/newsandevents/index.cfm?xml=Ex-Im%20Bank%20Events,RSS2.0'
        );
        array_unshift($wizardResults->results['program'], $newWizardResult);
    }
}

// Special case - when the user selects the basics_of_trade_export_finance tag, add the first 3 events found in the RSS Events-feed from ExIm.gov and ustda.gov
if ( intval($tagIsSelected['personalized_assistance']) === 1 ) {
    
    // getClosestSBADistrictOffice() is defined below in this file
    $closestSBADistrictOfficeNode = getClosestSBADistrictOffice($locationInfo['lat'], $locationInfo['lng']);
    $sbdcAddress = 
        $closestSBADistrictOfficeNode->field_appoffice_address['und'][0]['value'] . '<br/>' . 
        $closestSBADistrictOfficeNode->field_appoffice_city['und'][0]['value'] . ', ' . 
        $closestSBADistrictOfficeNode->field_appoffice_state['und'][0]['value'];
        
    if ( $closestSBADistrictOfficeNode !== false ) {
        $newWizardResult = array(
            'title' => $closestSBADistrictOfficeNode->title,
            'link' => '/node/' . $closestSBADistrictOfficeNode->nid . '/',
            'snippet' => $sbdcAddress,
            'tags' => array(),
            'tag_count' => count($assocTagsToShow),
            'all_tags' => $allWizTags,
            'type' => 'program',
            'promoted' => 9,
            'html_comment' => 'Imported from templates/wizard/wizard-results-engine-internationalfinance.php::getClosestSBADistrictOffice()'
        );
        array_unshift($wizardResults->results['program'], $newWizardResult);
    }
}

// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
//    $wizardResults->results = sortResultsArrayByFields($wizardResults->results, 'promoted', 'tag_count');
    
// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'program' => 'Recommended programs based on your answers',
            'resources' => 'Recommended Resources based on your answers',
            'articles' => 'Recommended Articles based on your answers',
        ),
        'legend' => array(
            'program' => array(
                'title' => 'Programs',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'resources' => array(
                'title' => 'Resources',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/resources.png'
            ),
            'articles' => array(
                'title' => 'Articles',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/article.png'
            )
        ),
        'sideBars' => array(
            'sidebar-useac' => overridable('sites/all/pages/expand-exporting/sidebar-useac.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Render results HTML
    print theme('yawizard_sections', $wizardResultsRenderableArray);




    
/** array getFirstThreeEventsFomRssFeed()
  * Returns the first three elements from the RSS feed located at the given URL
  * This function is designed to be used with:
  *     http://www.exim.gov/newsandevents/index.cfm?xml=Ex-Im%20Bank%20Events,RSS2.0
  *     http://www.ustda.gov/ustdaevents.xml
  */
function getFirstThreeEventsFomRssFeed($url) {

    $toReturn  =array();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);

    $dataObj = simplexml_load_string($data);
    
    if ( !empty($dataObj->channel) ) {
        $dataObj = $dataObj->channel;
    } else {
        return false;
    }
    
    $retrieveCount = 0;
    foreach ( $dataObj->children() as $tagName => $elementData ) {
        if ($tagName === 'item') {
            if ( $retrieveCount + 1 > 3 ) { break; }
            $toReturn[] = (array) $elementData;
            $retrieveCount++;
        }
    }
    
    return $toReturn;
}


/** node-object/false getClosestSBADistrictOffice(float, float, int)
  *
  * Uses the closes_resource_center_rethemeView of thje request_appointment display to lookup the closest 
  * SBA District office to the given latitude/longitude noted in the database.
  *
  * On success. returns a node-object obtained from node_load()
  * Returns FALSE on failure
  */
function getClosestSBADistrictOffice($latitude = 38.927003, $longitude = -77.375287, $rangeInMiles = 500) {

    // We will use the Drupal View closes_resource_center_retheme of thje display request_appointment, to get the result
    // This View takes three arguments, latitude, longitude, and range
    $viewResults = views_get_view_result('closes_resource_center_retheme', 'request_appointment', $latitude, $longitude, $rangeInMiles);
    
    // We should now have what that View would return with the given input
    // Loop through the View results... 
    foreach ( $viewResults as $viewResult ) {
        
        $n = node_load($viewResult->nid);
        
        // Return the first found SBA District Office (This View may return anything of the appointment_office/"Resourde Center" content-type)
        if ( !empty($n->field_appoffice_type) ) {
            if ( !empty($n->field_appoffice_type['und']) ) {
                if ( !empty($n->field_appoffice_type['und'][0]) ) {
                    if ( !empty($n->field_appoffice_type['und'][0]['value']) ) {
                        if ( strval($n->field_appoffice_type['und'][0]['value']) === 'SBA District Office' ) {
                            return $n;
                        }
                    }
                }
            }
        }
    }
    
    return false;
}
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
})

</script>

