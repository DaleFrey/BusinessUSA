<?php

    $html = '';
    $verbose = array(
        $query => array()
    );
    
// Get the URL to the Solr server (which is saved in settings within the Drupal database) - Needed later in this script
    $solrURL = false;
    $queryResults = db_query("SELECT url FROM apachesolr_environment");
    foreach ($queryResults as $result) {
        $solrURL = $result->url;
        break;
    }
    if ( $solrURL === false ) {
        header('Content-type: application/json');
        print json_encode(
            array(
                'html' => 'FATAL ERROR - Could not determin the Solr server URL - Coder Bookmark: CB-9YVR9O8-BC'
            )
        );
        return false;
    }
    
// Enabel debug message if the current user is the administrator
    $enabelDebug = false;
    if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) {
        $enabelDebug = true;
    }

// Get the list of tags used by this wizard
    $allWizTags = array_keys($_REQUEST['allTags']);
    $tagIsSelected = $_REQUEST['allTags'];
    
// Generate results - init
    global $typeofcall;
    $typeofcall = 'and';

// Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'eligibilitykiosk' => array(),
        'fbo' => array(),
        'fbo12' => array(),
        'green-opportunities' => array(),
    );
    
// Generate results - Ele.Kiosk
    
    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/find-opportunities/wizard-results.xls'));
    
    // Run through the excels and determin what should be in the result set
    foreach ( $potentialResults as $key => $potentialResult ) {
        
        error_log('ping');
        
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
        /* Seperate EK data from FBO data */
        $isFBO = intval(
            $tagIsOfInterset['is_fbo_data']
        );
        /* Return all results when no tags are selected */
        $noTagsSelected = intval(
            !$tagIsSelected['independently_owned'] 
            && !$tagIsSelected['organized_profit'] 
            && !$tagIsSelected['total_small_business'] 
            && !$tagIsSelected['small_financial_business'] 
            && !$tagIsSelected['older_than_2_years'] 
            && !$tagIsSelected['us_citizen'] 
            && !$tagIsSelected['woman_owned'] 
            && !$tagIsSelected['veteran_owned'] 
            && !$tagIsSelected['minority'] 
            && !$tagIsSelected['disadvantaged_persons'] 
            && !$tagIsSelected['hubzone'] 
            && !$tagIsSelected['US_HQ']
            && !$tagIsSelected['native_american']
        );
        /* if no tags are selected in a given section, assume all tags selected */
        if ( !$noTagsSelected ) {
            // If no tag is selected by the user in the Location section, pretend all the tags in this sections are checked
            if ( !$tagIsSelected['US_HQ'] && !$tagIsSelected['hubzone'] ) {
                $tagIsSelected['US_HQ'] = 1;
                $US_HQ = $tagIsOfInterset['US_HQ'];
                $tagIsSelected['hubzone'] = 1;
                $hubzone = $tagIsOfInterset['hubzone'];
            }
            // If no tag is selected by the user in the Size section, pretend all the tags in this sections are checked
            if ( !$tagIsSelected['independently_owned'] && !$tagIsSelected['organized_profit'] && !$tagIsSelected['total_small_business'] && !$tagIsSelected['small_financial_business'] && !$tagIsSelected['older_than_2_years'] ) {
                $tagIsSelected['independently_owned'] = 1;
                $independently_owned = $tagIsOfInterset['independently_owned'];
                $tagIsSelected['organized_profit'] = 1;
                $organized_profit = $tagIsOfInterset['organized_profit'];
                $tagIsSelected['total_small_business'] = 1;
                $total_small_business = $tagIsOfInterset['total_small_business'];
                $tagIsSelected['small_financial_business'] = 1;
                $small_financial_business = $tagIsOfInterset['small_financial_business'];
                $tagIsSelected['older_than_2_years'] = 1;
                $older_than_2_years = $tagIsOfInterset['older_than_2_years'];
            }
            // If no tag is selected by the user in the Ownership section, pretend all the tags in this sections are checked
            if ( !$tagIsSelected['us_citizen'] && !$tagIsSelected['woman_owned'] && !$tagIsSelected['veteran_owned'] && !$tagIsSelected['minority'] && !$tagIsSelected['disadvantaged_persons'] && !$tagIsSelected['native_american'] ) {
                $tagIsSelected['us_citizen'] = 1;
                $us_citizen = $tagIsOfInterset['us_citizen'];
                $tagIsSelected['woman_owned'] = 1;
                $woman_owned = $tagIsOfInterset['woman_owned'];
                $tagIsSelected['veteran_owned'] = 1;
                $veteran_owned = $tagIsOfInterset['veteran_owned'];
                $tagIsSelected['minority'] = 1;
                $minority = $tagIsOfInterset['minority'];
                $tagIsSelected['disadvantaged_persons'] = 1;
                $disadvantaged_persons = $tagIsOfInterset['disadvantaged_persons'];
                $tagIsSelected['native_american'] = 1;
                $native_american = $tagIsOfInterset['native_american'];
            }
        }
        /* Return if atleast one tag of interest is selected in each step */ 
        $atLestOneTagOfInterestAndSlected_firstSection = intval(
            $independently_owned || $organized_profit || $total_small_business || $small_financial_business || $older_than_2_years
        );
        $atLestOneTagOfInterestAndSlected_secondSection = intval(
            $us_citizen || $woman_owned || $veteran_owned || $minority || $disadvantaged_persons || $native_american
        );
        $atLestOneTagOfInterestAndSlected_thirdSection = intval(
            $hubzone || $US_HQ
        );
        $oneTagForEachStep = intval(
            $atLestOneTagOfInterestAndSlected_firstSection 
            && $atLestOneTagOfInterestAndSlected_secondSection 
            && $atLestOneTagOfInterestAndSlected_thirdSection
        );
        /* If only one tag is selected, return content that contais this tag */
        $oneTagSelected = intval(
            ( $tagIsSelected['independently_owned'] + $tagIsSelected['organized_profit'] + $tagIsSelected['total_small_business'] + $tagIsSelected['small_financial_business'] + $tagIsSelected['older_than_2_years'] + $tagIsSelected['us_citizen'] + $tagIsSelected['woman_owned'] + $tagIsSelected['veteran_owned'] + $tagIsSelected['minority'] + $tagIsSelected['disadvantaged_persons'] + $tagIsSelected['hubzone'] + $tagIsSelected['US_HQ'] + $tagIsSelected['native_american'] === 1 ) 
            && (
                $independently_owned || $organized_profit || $total_small_business || $small_financial_business || $older_than_2_years || $us_citizen || $woman_owned || $veteran_owned || $minority || $disadvantaged_persons || $hubzone || $US_HQ || $native_american
            )
        );
        
        $logicResult = ( !$isFBO && ($noTagsSelected || $oneTagForEachStep || $oneTagSelected) );
        print "
            Title: {$potentialResult['assoc']['title']}
            
            noTagsSelected is $noTagsSelected
            oneTagForEachStep is $oneTagForEachStep
            oneTagSelected is $oneTagSelected
            logicResult is $logicResult
            
            atLestOneTagOfInterestAndSlected_firstSection is $atLestOneTagOfInterestAndSlected_firstSection
            atLestOneTagOfInterestAndSlected_secondSection is $atLestOneTagOfInterestAndSlected_secondSection
            atLestOneTagOfInterestAndSlected_thirdSection is $atLestOneTagOfInterestAndSlected_thirdSection
        ";

        if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . ob_get_contents() . '</div>'; }
        $debug_html_comment = ob_get_contents();
        ob_end_clean();
        
        if ( ! $logicResult ) {
            
            $html .= "
                <div class=\"debug-info\" style=\"display: none;\">
                    <!--
                        Not showing result " . $potentialResult['assoc']['title'] . "
                        tagIsOfIntAndSelected is: " . print_r($tagIsOfIntAndSelected, true) . "
                        tagIsSelected is: " . print_r($tagIsSelected, true) . "
                    -->
                </div>
            ";
            
        } else {
        
						// NJB -- if this is being invoked from the api, remove the unneeded record from $api_records
						if (isset($api_results)) {
							$api_results[$key] = $potentialResult;
						}

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
            
            // Add this item to the wizard result-set
            $wizardResults->results['eligibilitykiosk'][] = array(
                'title' => $potentialResult['assoc']['title'],
                'snippet' => $potentialResult['assoc']['Snippet'],
                'url' => $potentialResult['assoc']['URL'],
                'link' => $potentialResult['assoc']['URL'],
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $allWizTags,
                'type' => 'eligibilitykiosk',
                'promoted' => $promoted,
                'html_comment' => $debug_html_comment
            );
        }
    }

    // Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
    $wizardResults->results['eligibilitykiosk'] = sortResultsArrayByFields($wizardResults->results['eligibilitykiosk'], 'promoted', 'tag_count');



// Generate results for Open Opportunities

// Determin the [API-]URL to pull data from
//$zipcode = $_POST['inputs']['zip_location'];

$zipcode = $_POST ['allTags']['zip_location'];


$objstateData =  getLatLongFromZipCode($zipcode);
//$industry = $_POST['inputs']['Industry'];

$industry = $_POST['allTags']['whichindustriesareyouinterestedineghealthcareagricultureetc'];


if (strlen($zipcode) == 5)
{
    $statefull = '';
    switch ($objstateData['state']) {
        case 'AL':
        {
            $statefull = 'Alabama';
            break;
        }
        case 'AK':
        {
            $statefull = 'Alaska';
            break;
        }
        case 'AS':
        {
            $statefull = 'America Samoa';
            break;
        }
        case 'AZ':
        {
            $statefull = 'Arizona';
            break;
        }
        case 'AR':
        {
            $statefull = 'Arkansas';
            break;
        }
        case 'CA':
        {
            $statefull = 'California';
            break;
        }
        case 'CO':
        {
            $statefull = 'Colorado';
            break;
        }
        case 'CT':
        {
            $statefull = 'Connecticut';
            break;
        }
        case 'DE':
        {
            $statefull = 'Delaware';
            break;
        }
        case 'DC':
        {
            $statefull = 'District of Columbia';
            break;
        }
        case 'FL':
        {
            $statefull = 'Florida';
            break;
        }
        case 'GA':
        {
            $statefull = 'Georgia';
            break;
        }

        case 'GU':
        {
            $statefull = 'Guam';
            break;
        }
        case 'HI':
        {
            $statefull = 'Hawaii';
            break;
        }
        case 'ID':
        {
            $statefull = 'Idaho';
            break;
        }
        case 'IL':
        {
            $statefull = 'Illinois';
            break;
        }
        case 'IN':
        {
            $statefull = 'Indiana';
            break;
        }
        case 'IA':
        {
            $statefull = 'Iowa';
            break;
        }
        case 'KS':
        {
            $statefull = 'Kansas';
            break;
        }
        case 'KY':
        {
            $statefull = 'Kentucky';
            break;
        }
        case 'LA':
        {
            $statefull = 'Louisiana';
            break;
        }
        case 'ME':
        {
            $statefull = 'Maine';
            break;
        }

        case 'MD':
        {
            $statefull = 'Maryland';
            break;
        }
        case 'MA':
        {
            $statefull = 'Massachusetts';
            break;
        }
        case 'MI':
        {
            $statefull = 'Michigan';
            break;
        }
        case 'MN':
        {
            $statefull = 'Minnesota';
            break;
        }
        case 'MS':
        {
            $statefull = 'Mississippi';
            break;
        }
        case 'MO':
        {
            $statefull = 'Missouri';
            break;
        }
        case 'MT':
        {
            $statefull = 'Montana';
            break;
        }
        case 'NE':
        {
            $statefull = 'Nebraska';
            break;
        }
        case 'NV':
        {
            $statefull = 'Nevada';
            break;
        }

        case 'NH':
        {
            $statefull = 'New Hampshire';
            break;
        }
        case 'NJ':
        {
            $statefull = 'New Jersey';
            break;
        }
        case 'NM':
        {
            $statefull = 'New Mexico';
            break;
        }
        case 'NY':
        {
            $statefull = 'New York';
            break;
        }
        case 'NC':
        {
            $statefull = 'North Carolina';
            break;
        }
        case 'ND':
        {
            $statefull = 'North Dakota';
            break;
        }
        case 'MP':
        {
            $statefull = 'Northern Mariana Islands';
            break;
        }
        case 'OH':
        {
            $statefull = 'Ohio';
            break;
        }
        case 'OK':
        {
            $statefull = 'Oklahoma';
            break;
        }
        case 'OR':
        {
            $statefull = 'Oregon';
            break;
        }

        case 'PA':
        {
            $statefull = 'Pennsylvania';
            break;
        }
        case 'PU':
        {
            $statefull = 'Puerto Rico';
            break;
        }
        case 'RI':
        {
            $statefull = 'Rhode Island';
            break;
        }
        case 'SC':
        {
            $statefull = 'South Carolina';
            break;
        }
        case 'SD':
        {
            $statefull = 'South Dakota';
            break;
        }
        case 'TN':
        {
            $statefull = 'Tennessee';
            break;
        }
        case 'TX':
        {
            $statefull = 'Texas';
            break;
        }
        case 'UT':
        {
            $statefull = 'Utah';
            break;
        }
        case 'VT':
        {
            $statefull = 'Vermont';
            break;
        }
        case 'VI':
        {
            $statefull = 'Virgin Island';
            break;
        }
        case 'VA':
        {
            $statefull = 'Virginia';
            break;
        }
        case 'WA':
        {
            $statefull = 'Washington';
            break;
        }
        case 'WV':
        {
            $statefull = 'West Virginia';
            break;
        }

        case 'WI':
        {
            $statefull = 'Wisconsin';
            break;
        }
        case 'WY':
        {
            $statefull = 'Wyoming';
            break;
        }
        default:
            {
            $statefull ='';
            }

    }

    //$state = '%20and%20'.$objstateData['state'];

    $state = '%20and%20'.$statefull;

    $apiQuery = $industry.$state;
}
else
{
    $apiQuery = $_POST['alltags']['whichindustriesareyouinterestedineghealthcareagricultureetc'];
}

$apiQuery = str_replace('%20', '+', $apiQuery);
$apiQuery = str_replace(' ', '+', $apiQuery);

$apiKey = 'K6zrCepxUEMeci1q6ZOZ4W5LtA8u1apq8xLqbnm8';
$apiURL = "http://api.data.gov/gsa/fbopen/v0/opps?q={$apiQuery}&api_key={$apiKey}";




// Pull data from the target data-source
$jsonData = file_get_contents($apiURL);
$objData = json_decode($jsonData, true);

if ( intval($objData['numFound']) === 0 )

{
    if (strlen($zipcode) == 5)
    {
        $apiQuery = $industry .'+' . $statefull;
        $typeofcall ='or';
    }
    else
    {
        $apiQuery = $_POST['alltags']['whichindustriesareyouinterestedineghealthcareagricultureetc'];
    }
    $apiQuery = str_replace('%20', '+', $apiQuery);

    $apiURL = "http://api.data.gov/gsa/fbopen/v0/opps?q={$apiQuery}&api_key={$apiKey}";
    $jsonData = file_get_contents($apiURL);
    $objData = json_decode($jsonData, true);

}


foreach ( $objData['docs'] as $doc ) {

    // Add results to result queue
    $wizardResults->results['fbo'][] = array(
        'title' => $doc['title'],
        'link' => $doc['listing_url'],
        'url' => $doc['listing_url'],
        'snippet' => "<b>Close Date: </b>{$doc['close_dt']}<br/><b>Agency Name: </b>{$doc['agency']}<br/><br/>". truncate_utf8(strip_tags(htmlspecialchars_decode($doc['description'])), 250, true, true),
        'tags' => array(),
        'all_tags' => array(),
        'type' => 'fbo',
        'closed_date' => strtotime($doc['close_dt']),
        'promoted' => 0

    );
    //$wizardResults->usesSideBar = false;



}

$wizardResults->fboCount = $objData['numFound'];
//Sorting function
$sorter=array();
$ret=array();
reset($wizardResults->results['fbo']);
foreach ($wizardResults->results['fbo'] as $ii => $va) {
    $sorter[$ii]=$va['closed_date'];
}
asort($sorter);
foreach ($sorter as $ii => $va) {
    $ret[$ii]=$wizardResults->results['fbo'][$ii];
}
$wizardResults->results['fbo']=$ret;






// Generate results - Grants Challenges, and Patents

    // Grants
        $query = "
            SELECT
                n.nid AS 'nid', 
                n.title AS 'title', 
                af.field_grants_awardfloor_value AS 'award_floor', 
                glink.field_grants_link_url AS 'url', 
                gbod.field_grants_body_value AS 'body'
            FROM node n 
            LEFT JOIN field_data_field_grants_awardfloor af ON ( af.entity_id = n.nid )
            LEFT JOIN field_data_field_grants_link glink ON ( glink.entity_id = n.nid )
            LEFT JOIN field_data_field_grants_body gbod ON ( gbod.entity_id = n.nid )
            WHERE 
                n.type = 'grants'
                AND n.status = 1 
            ORDER BY
                LENGTH(af.field_grants_awardfloor_value) DESC ,
                af.field_grants_awardfloor_value DESC 
            LIMIT 30;
        ";
        $result = db_query($query);
        foreach ($result as $record) {
            $resultTitle = $record->title;
            if ( !is_null($record->award_floor) ) {
                $resultTitle .= ' - ' . $record->award_floor;
            }
            $wizardResults->results['green-opportunities'][] = array(
                'title' => $resultTitle,
                'link' => $record->url,
                'url' => $record->url,
                'snippet' => truncate_utf8(strip_tags($record->body), 250, true, true),
                'tags' => array(),
                'all_tags' => array(),
                'type' => 'green-opportunities',
                'promoted' => 0
            );
        }
    // Challenges 
        $query="
            SELECT 
                n.nid AS 'nid', 
                n.title AS 'title', 
                pm.field_challenge_prize_money_value AS 'prize_money', 
                u.field_challenge_url_url AS 'url', 
                b.body_value AS 'body_value'
            FROM node n 
            LEFT JOIN field_data_field_challenge_prize_money pm ON ( pm.entity_id = n.nid )
            LEFT JOIN field_data_field_challenge_url u ON ( u.entity_id = n.nid )
            LEFT JOIN field_data_body b ON ( b.entity_id = n.nid )
            WHERE 
                n.type = 'challenges'
                AND n.status = 1
            ORDER BY 
                LENGTH(pm.field_challenge_prize_money_value) DESC, 
                pm.field_challenge_prize_money_value DESC
            LIMIT 10
        ";
        $result = db_query($query);
        foreach ($result as $record) {
            $resultTitle = $record->title;
            if ( !is_null($record->prize_money) ) {
                $resultTitle .= ' - ' . $record->prize_money;
            }
            $wizardResults->results['green-opportunities'][] = array(
                'title' => $resultTitle,
                'link' => $record->url,
                'url' => $record->url,
                'snippet' => truncate_utf8(strip_tags($record->body_value), 250, true, true),
                'tags' => array(),
                'all_tags' => array(),
                'type' => 'green-opportunities',
                'promoted' => 0
            );
        }
    // Patents
        $query="
            SELECT 
                n.nid AS 'nid', 
                n.title AS 'title', 
                pd.field_patent_date_value AS 'issue_date', 
                u.field_patent_purl_url_url AS 'url',
                d.field_patent_desc_value AS 'body'
            FROM node n 
            LEFT JOIN field_data_field_patent_date pd ON ( pd.entity_id = n.nid )
            LEFT JOIN field_data_field_patent_purl_url u ON ( u.entity_id = n.nid )
            LEFT JOIN field_data_field_patent_desc d ON ( d.entity_id = n.nid )
            WHERE 
                n.type = 'patent'
                AND n.status = 1
            ORDER BY 
                pd.field_patent_date_value DESC 
        ";
        $result = db_query($query);
        foreach ($result as $record) {
            $wizardResults->results['green-opportunities'][] = array(
                'title' => $record->title,
                'link' => $record->url,
                'url' => $record->url,
                'snippet' => truncate_utf8(trim($record->body), 250, true, true),
                'tags' => array(),
                'all_tags' => array(),
                'type' => 'green-opportunities',
                'promoted' => 0
            );
        }
    
// Generate results - FBO data

    // Determin the Solr Query (and Solr Query URL) for querying FBO data (Solicitations)
    
    $solrQuery_setAsideQuery = array();
    if ( $total_small_business || $veteran_owned || $disadvantaged_persons || $hubzone || $woman_owned ) {
        if ( $total_small_business ) {
            $solrQuery_setAsideQuery[] = "ts_field_presol_setaside:\"Small Business\"";
        }
        if ( $veteran_owned ) {
            $solrQuery_setAsideQuery[] = "ts_field_presol_setaside:\"Veteran\"";
        }
        if ( $disadvantaged_persons ) {
            $solrQuery_setAsideQuery[] = "ts_field_presol_setaside:\"Disadvantaged\"";
        }
        if ( $hubzone ) {
            $solrQuery_setAsideQuery[] = "ts_field_presol_setaside:\"Hub\"";
        }
        if ( $woman_owned ) {
            $solrQuery_setAsideQuery[] = "ts_field_presol_setaside:\"Woman\"";
        }
    }
    
    $fboTextSearch = str_replace( ',' , ' ' , $_POST['inputs']['Industry'] );
    $fboTextSearch = str_replace( '  ', ' ', $fboTextSearch);
    $fboTextSearch = str_replace( '\'', '', $fboTextSearch);
    $fboTextSearch = str_replace( "\"", '', $fboTextSearch);
    $fboTextSearch = trim($fboTextSearch);
    $fboTextSearch = explode(' ', $fboTextSearch);
    
    $skipCount = 0;
    if ( !empty($_POST['skipCount']) ) {
        $skipCount = intval( $_POST['skipCount'] );
    }
    $maxSendCount = 50;
    if ( !empty($_POST['maxSendCount']) ) {
        $maxSendCount = intval( $_POST['maxSendCount'] );
    }
    
    $solrQuery = '';
    if ( count($solrQuery_setAsideQuery) > 0 ) {
        $solrQuery = '( ' . implode(' OR ', $solrQuery_setAsideQuery) . ' ) ';
    }
    if ( trim(implode('', $fboTextSearch)) !== '' ) {
        if ( $solrQuery !== '' ) {
            $solrQuery .= ' AND ';
        }
        $solrQuery .= '( label:' . implode(' OR label:', $fboTextSearch) . ' ) ' . implode('^2 ', explode(' ', $_POST['inputs']['Industry'])) . '^2';
    }
    if ( !empty($_POST['inputs']['zip_location']) ) {
        $userZip = $_REQUEST['allTags']['zip_location'];
        $locationInfo = getLatLongFromZipCode($userZip); // getLatLongFromZipCode() is defined in ZipCodeGeolocation.php
        $solrQuery .= ' ' . acronymToStateName($locationInfo['state']) . '^3 ' . stateNameToAcronym($locationInfo['state']) . '^3';
    }
    $solrQuery = urlencode($solrQuery);
    $solrQueryURL = $solrURL . "/select?q=bundle%3Asolicitations+$solrQuery&wt=json&indent=true&start=$skipCount&rows=$maxSendCount";
    $verbose['solrQueryURL'] = $solrQueryURL;
    $solrReturn = json_decode(file_get_contents($solrQueryURL), true);
    
    $sentCount = 0;
    $atCount = count($wizardResults->results['fbo12']);
    foreach ($solrReturn['response']['docs'] as $record) {
        
        $sentCount++;
        $wizardResults->resultCount++;
        $snippet = truncate_utf8($record['teaser'], 250, true, true); // Truncate snippet
        
        // Check the 'FBO Tags' text field for tags to show in the wizard results
        $assocTagsToShow = array();
        $checkForTags = array();
        if ( $total_small_business ) {
            $checkForTags['Small Business'] = 'Small Business';
        }
        if ( $disadvantaged_persons ) {
            $checkForTags['Competitive'] = 'Competitive 8(a)';
        }
        if ( $hubzone ) {
            $checkForTags['HUBZone'] = 'HUBZone';
        }
        if ( $woman_owned ) {
            $checkForTags['Woman'] = 'Woman Owned';
        }
        if ( $veteran_owned ) {
            $checkForTags['Veteran'] = 'Veteran-Owned';
        }
        foreach( $checkForTags as $potentialTag => $tagLabel) {
            if ( stripos($record['ts_field_presol_setaside'], $potentialTag ) !== false ) {
                $assocTagsToShow[] = $tagLabel;
            }
        }
        
        // Add results to result queue
        $newWizardResult = array(
            'title' => $record['label'],
            'link' => $record['ts_field_presol_link'],
            'url' => $record['ts_field_presol_link'],
            'snippet' => $snippet,
            'tags' => $assocTagsToShow,
            'all_tags' => $allWizTags,
            'type' => 'fbo12',
            'promoted' => 0
        );

        // Add this result to the end of the result set
        $wizardResults->results['fbo12'][] = $newWizardResult;
        
        if ( $sentCount > $maxSendCount ) {
            break;
        }
    }
    
    //$wizardResults->fboCount = $solrReturn['response']['numFound'];
    
// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'eligibilitykiosk' => 'Contracting Programs You Are Eligible For based on your answers',
            'fbo' => 'Current Open Opportunities In FBO Open based on your answers',
            'green-opportunities' => 'Green Opportunities You Are Eligible For based on your answers'
        ),
        'legend' => array(
            'eligibilitykiosk' => array(
                'title' => 'Contracting Programs',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'fbo' => array(
                'title' => 'FBO Open Opportunities',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/fbo.png'
            ),
            'green-opportunities' => array(
                'title' => 'Green Opportunities',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/federal_registration.png'
            )
        ),
        'sideBars' => array(
            'sidebar-useac' => overridable('sites/all/pages/find-opportunities/sidebar-ptacs.php'),
            'sidebar-federalresources' => overridable('sites/all/pages/find-opportunities/sidebar-federalresources.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Render results HTML
    kprint_r($wizardResults);
    kprint_r($wizardResultsRenderableArray);
    print theme('yawizard_sections', $wizardResultsRenderableArray);

?>

<script>

    $(document).ready(function()
    {

        if (('#wiztag-green_acts').length > 0)
        {
            var greenattr = $('#wiztag-green_acts').next().attr('class');
            if (greenattr != 'checked')
            {
                //hiding the results count section on green opportunities (3rd child
                $('.wizard-results-header-resultcounts-container div:nth-child(3)').hide();
               $('.wizard-result-section-green-opportunities').hide();
            }
        }





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

