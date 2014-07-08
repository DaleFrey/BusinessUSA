<?php
    
    global $wizardResults;

    include_once('sites/all/libraries/PHPExcelHelper/phpexcel-helper-functions.php');
    
    // Determine what state the user is in based on entered zip-code
    $locInfo = getLatLongFromZipCode($_POST['allTags']['enteredzip']);
    $stateTarg = $locInfo['state'];
    $countyTarg = getGeoCounty($locInfo['city'] . ', ' . $locInfo['state']);

    /* START: Create Excel file (for exporting data) */

        /* START : Conduct Market Research Articles */
            $marketresearcharticles = array();
            foreach ( $marketresearchspreadsheetRows as $row ) {
                $marketresearcharticles[] = array(
                    'Title' => $row['assoc']['title'],
                    'Description' => $row['assoc']['snippet'],
                    'Link' =>  $row['assoc']['link']
                );
            }
        /* END : Conduct Market Research Articles */
    
        /* START : Business Licenses and Permits */
            $blp = array();
            $blp[] = array(
                'License/Permit Type' => 'Federal Licenses and Permits',
                'Title' => 'Employer Identification Number (EIN)',
                'Description' => 'Employers with employees, business partnerships, and corporations, must obtain an Employer Identification Number (EIN) from the U.S. Internal Revenue Service. The EIN is also known as an Employer Tax ID and Form SS-4. U.S. Internal Revenue ServicePhone: 1-800-829-4933',
                'Link' => 'Guide to the Employer Identification Number: http://www.irs.gov/businesses/small/article/0,,id=98350,00.html',
                'Link2' => 'Apply Online: http://www.irs.gov/businesses/small/article/0,,id=102767,00.html'
            );
            
            // Business Tax Registration
            $data = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem_ullink', '1', $stateTarg, 'all', 'Business Tax Registration');
            dsm( array('Business Tax Registration' => $data) );
            $blp[] = array(
                'License/Permit Type' => 'Federal Licenses and Permits',
                'Title' => acronymToStateName($stateTarg) . ' Tax Registration',
                'Description' => 'Business Tax Registration',
                'Link' => $data[0]->field_field_lap_url[0]['raw']['value'],
                'Link2' => ''
            );
            
            // General Tax Information and Forms
            $data = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem_ullink', '2', $stateTarg, 'all', 'General Tax Information and Forms');
            dsm( array('General Tax Information and Forms' => $data) );
            $blp[] = array(
                'License/Permit Type' => 'State Licenses and Permits - ' . $stateTarg . ' Tax Registration',
                'Title' => acronymToStateName($stateTarg) . ' General Tax Information and Forms',
                'Description' => 'General Tax Information and Forms',
                'Link' => $data[0]->field_field_lap_url[0]['raw']['value'],
                'Link2' => ''
            );
            
            if ( $_POST['allTags']['general_business_licenses'] === '1' ) {
                $data = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', 'all', $stateTarg, 'General Business Licenses');
                dsm( array('general_business_licenses' => $data) );
                $blp[] = array(
                    'License/Permit Type' => 'State Licenses and Permits - ' . $stateTarg . ' Tax Registration',
                    'Title' => $data[0]->node_title ,
                    'Description' => $data[0]->field_field_lap_groupdesc[0]['raw']['value'],
                    'Link' => $data[0]->field_field_lap_url[0]['raw']['value'],
                    'Link2' => ''
                );
            }
            
            /* START Business tags */
            $businessTags = array(
                'auto_dealership' => 'Auto Dealership',
                'barber_shop' => 'Barber Shop',
                'beauty_salon' => 'Beauty Salon',
                'child_care_services' => 'Child Care Services',
                'construction_contractor' => 'Construction Contractor',
                'debt_collection_agency' => 'Debt Collection Agency',
                'electrician' => 'Electrician',
                'massage_therapist' => 'Massage Therapist',
                'plumber' => 'Plumber',
                'restaurant' => 'Restaurant',
                'home_yes' => 'Home Health Care',
                'hiring_yes' => 'New Hire Reporting Requirements',
            );
            
            foreach ( $businessTags as $inputName => $businessTag ) {
                if ( $_POST['allTags'][$inputName] === "1" ) {
                
                    $rslts = views_get_view_result("start_a_biz_wiz_licenses_and_permits", "start_a_biz_wiz_lap_oneitem", "all", $stateTarg, $businessTag);
                    dsm( array($businessTag => $rslts) );
                    foreach ( $rslts as $rslt ) {
                    
                        $thisTitle = $rslt->_field_data['nid']['entity']->title;
                        $url = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                        $descr = $rslt->_field_data['nid']['entity']->field_lap_desc['und'][0]['value'];
                        $grpdescr = $rslt->_field_data['nid']['entity']->field_lap_groupdesc['und'][0]['value'];
                        
                        $thisLinkIs404Error = call_user_func_cache(604800, 'linkIs404Error', $url);
                        if ( $thisLinkIs404Error !== true && !is_null($thisTitle) && strlen(trim($thisTitle)) > 1 ) {
                            $blp[] = array(
                                'License/Permit Type' => 'State Licenses and Permits - Business Licenses',
                                'Title' => $thisTitle ,
                                'Description' => $descr . $grpdescr,
                                'Link' => $url,
                                'Link2' => ''
                            );
                        }
                        
                    }
                }
            }
            /* END Business tags */
            
            // Business Entity Registration
            $data = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '3', $stateTarg);
            if ( is_array($data) && count($data) > 0 ) {
                $blp[] = array(
                    'License/Permit Type' => 'State Licenses and Permits - Business Licenses',
                    'Title' => $data[0]->node_title ,
                    'Description' => $data[0]->field_field_lap_groupdesc[0]['raw']['value'],
                    'Link' => $data[0]->field_field_lap_url[0]['raw']['value'],
                    'Link2' => ''
                );
            }
            
            // Disability Insurance
            $data = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '4', $stateTarg);
            if ( is_array($data) && count($data) > 0 ) {
                $blp[] = array(
                    'License/Permit Type' => 'State Licenses and Permits - Disability Insurance',
                    'Title' => $data[0]->node_title ,
                    'Description' => $data[0]->field_field_lap_groupdesc[0]['raw']['value'],
                    'Link' => $data[0]->field_field_lap_url[0]['raw']['value'],
                    'Link2' => ''
                );
            }
            
            // Workers Compensation Insurance
            $data = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '5', $stateTarg);
            if ( is_array($data) && count($data) > 0 ) {
                $blp[] = array(
                    'License/Permit Type' => 'State Licenses and Permits - Workers Compensation Insurance',
                    'Title' => $data[0]->node_title ,
                    'Description' => $data[0]->field_field_lap_groupdesc[0]['raw']['value'],
                    'Link' => $data[0]->field_field_lap_url[0]['raw']['value'],
                    'Link2' => ''
                );
            }
            
            // Unemployment Insurance
            $data = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '7', $stateTarg);
            if ( is_array($data) && count($data) > 0 ) {
                $blp[] = array(
                    'License/Permit Type' => 'State Licenses and Permits - Unemployment Insurance',
                    'Title' => $data[0]->node_title ,
                    'Description' => $data[0]->field_field_lap_groupdesc[0]['raw']['value'],
                    'Link' => $data[0]->field_field_lap_url[0]['raw']['value'],
                    'Link2' => ''
                );
            }
            
            // City
            $rslts = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_allitems', '37', $stateTarg, 'all', $locInfo['city']); 
            foreach ( $rslts as $rslt ) {
                $thisTitle = $rslt->_field_data['nid']['entity']->title;
                $thisLink = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                $blp[] = array(
                    'License/Permit Type' => 'Local Permits',
                    'Title' => $thisTitle ,
                    'Description' => $thisTitle,
                    'Link' => $thisLink,
                    'Link2' => ''
                );
                break;
            }
            // County
            $rslts = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_allitems', '37', $stateTarg, 'all', 'all', 'NOTAPPLICABLE'); 
            foreach ( $rslts as $rslt ) {
                $thisTitle = $rslt->_field_data['nid']['entity']->title;
                $thisLink = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                if ( strpos(strtolower($thisTitle), strtolower($countyTarg)) !== false ) {
                    $blp[] = array(
                        'License/Permit Type' => 'Local Permits',
                        'Title' => $thisTitle ,
                        'Description' => $thisTitle,
                        'Link' => $thisLink,
                        'Link2' => ''
                    );
                    break;
                }
            }

            //Articles Related to Business Licenses and Permits
            foreach ( $businesslicensesandpermitsspreadsheetRows as $row ) {
                $blp[] = array(
                    'License/Permit Type' => 'Article',
                    'Title' =>  $row['assoc']['title'] ,
                    'Description' =>  $row['assoc']['snippet'],
                    'Link' =>  $row['assoc']['link'],
                );
            }

        /* END: Business Licenses and Permits */

        /* START: Build Your Business Plan */
            $businessarticles = array();
            foreach ( $businessplanspreadsheetRows as $row ) {
                $businessarticles[] = array(
                    'Title' => $row['assoc']['title'],
                    'Description' => $row['assoc']['snippet'],
                    'Link' =>  $row['assoc']['link']
                );
            }

        /* END: Build Your Business Plan */
        
        /* START: Articles Recommended for You */
            $ary = array();
            foreach ( $wizardResults->results['article'] as $result ) {
                $ary[] = array(
                    'Title' => $result['title'],
                    'Description' => $result['snippet'],
                    'Link' => ( !empty($result['link']) ? $result['link'] : drupal_lookup_path('alias', 'node/' . $result['nid']) )
                );
            }
        /* END: Articles Recommended for You */
        
        /* START: Local Business Counselors - SBDCs */
            $sbdc = array();
            $datas = views_get_view_result('sbdcs', 'sbdc_all_items', $locInfo['lat'], $locInfo['lng'], '200', 'Small Business Development Center', $_POST['allTags']['enteredzip']);
            foreach ( $datas as $data ) {
            
                // Get the distance and title
                $theTitle = $data->node_title;
                $theTitle = explode(' ', $theTitle);
                $lastWordOfTitle = $theTitle[count($theTitle) - 1];
                $dist = false;
                if ( is_numeric($lastWordOfTitle) ) { // Check if the dist away has been injected as the last word in the title
                    array_pop($theTitle);
                    $dist = $lastWordOfTitle;
                }
                $theTitle = implode(' ', $theTitle);
                
                // Get the address of the target
                $adrs = '';
                $adrsAdd = $data->field_field_appoffice_additional[0]['raw']['value'];
                $adrs .= ( trim($adrsAdd) === '' ? '' : $adrsAdd . ', ' );
                $adrsStrt = $data->field_field_appoffice_address[0]['raw']['value'];
                $adrs .= ( trim($adrsStrt) === '' ? '' : $adrsStrt . ', ' );
                $adrsCity = $data->field_field_appoffice_city[0]['raw']['value'];
                $adrs .= ( trim($adrsCity) === '' ? '' : $adrsCity . ', ' );
                $adrsState = $data->field_field_appoffice_state[0]['raw']['value'];
                $adrs .= ( trim($adrsCity) === '' ? '' : $adrsCity );
                
                $newSBDC = array();
                $newSBDC['Title'] = $theTitle;
                $newSBDC['Distance Away (miles)'] = $dist;
                $newSBDC['Address'] = $adrs;
                $newSBDC['Link'] = 'http://business.usa.gov/' . drupal_lookup_path('alias', 'node/' . $data->nid);
                
                $sbdc[] = $newSBDC;
            }
        /* END: Local Business Counselors - SBDCs */
        
        /* START: Local Business Counselors - SBDCs */
            $score = array();
            $datas = views_get_view_result('sbdcs', 'sbdc_all_items', $locInfo['lat'], $locInfo['lng'], '200', 'SCORE Office', $_POST['allTags']['enteredzip']);
            
            foreach ( $datas as $data ) {
            
                // Get the distance and title
                $theTitle = $data->node_title;
                $theTitle = explode(' ', $theTitle);
                $lastWordOfTitle = $theTitle[count($theTitle) - 1];
                $dist = false;
                if ( is_numeric($lastWordOfTitle) ) { // Check if the dist away has been injected as the last word in the title
                    array_pop($theTitle);
                    $dist = $lastWordOfTitle;
                }
                $theTitle = implode(' ', $theTitle);
                
                // Get the address of the target
                $adrs = '';
                $adrsAdd = $data->field_field_appoffice_additional[0]['raw']['value'];
                $adrs .= ( trim($adrsAdd) === '' ? '' : $adrsAdd . ', ' );
                $adrsStrt = $data->field_field_appoffice_address[0]['raw']['value'];
                $adrs .= ( trim($adrsStrt) === '' ? '' : $adrsStrt . ', ' );
                $adrsCity = $data->field_field_appoffice_city[0]['raw']['value'];
                $adrs .= ( trim($adrsCity) === '' ? '' : $adrsCity . ', ' );
                $adrsState = $data->field_field_appoffice_state[0]['raw']['value'];
                $adrs .= ( trim($adrsCity) === '' ? '' : $adrsCity );
                
                $newSCORE = array();
                $newSCORE['Title'] = $theTitle;
                $newSCORE['Distance Away (miles)'] = $dist;
                $newSCORE['Address'] = $adrs;
                $newSCORE['Link'] = 'http://business.usa.gov/' . drupal_lookup_path('alias', 'node/' . $data->nid);
                
                $score[] = $newSCORE;
            }
        /* END: Local Business Counselors - SBDCs */
        
        // Debug
        dsm(
            array(
                'blp' => $blp,
                'ary' => $ary,
                'sbdc' => $sbdc,
                'score' => $score,
            )
        );

        $objPHPExcel = null;
        $objPHPExcel = arrayToExcel($objPHPExcel, $marketresearcharticles, true, 1, 0, 'Conduct Market Research');
        $objPHPExcel = arrayToExcel($objPHPExcel, $blp, true, 1, 1, 'Business Licenses and Permits');
        $objPHPExcel = arrayToExcel($objPHPExcel, $businessarticles, true, 1, 2, 'Build Your Business Plan');
        $objPHPExcel = arrayToExcel($objPHPExcel, $ary, true, 1, 3, 'Articles Recommended for You');
        $objPHPExcel = arrayToExcel($objPHPExcel, $sbdc, true, 1, 4, 'Local SBDCs');
        $objPHPExcel = arrayToExcel($objPHPExcel, $score, true, 1, 5, 'Local SCORE Offices');
        $objPHPExcel->setActiveSheetIndex(0);
        $spreadsheet = $objPHPExcel;
        
    /* END: Create Excel file (for exporting data) */
    
    /* Save spreadsheet */
    $saveDirectory = 'sites/default/files/wizard-results-export/';
    if ( !is_dir($saveDirectory) ) { mkdir($saveDirectory); }
    $objWriter = PHPExcel_IOFactory::createWriter($spreadsheet, 'Excel5');
    global $excelSavePath;
    $objWriter->save($excelSavePath);
    
    //print $saveDirectory . $fileName;
    return $saveDirectory . $fileName;
    
