<?php

    $html = '';
    
// Enabel debug message if the current user is the administrator
    global $user;
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
    
// Get the list of tags used by this wizard
    
    /* Initialize results */
    global $wizardResults;
    $wizardResults =  new stdClass;    
    $wizardResults->resultCount = 0;
    $wizardResults->results = array(
        'regulation' => array()
    );

    //Make API call based on the search parameters
    $apiKey = "xtpzlv0pk6khKK1UwOeFo5Td0naDdx5lXfHMmkQN";
    $apiURL = "http://api.data.gov/regulations/beta/documents.json?api_key={$apiKey}";

    $keywords = $_REQUEST['allTags']['keyword_textbox'];

    //$tagIsSelected array contains all associated tags from the excel. In order to find out which drop-down items are selected, we need to search the array by the value '1'.
    //the $selectedItems array should contain two elements because there are two drop-down menus in the excel sheet. The first element is 'agency'. The second element is 'posted date' option.
    $selectedItems = array_keys($tagIsSelected, '1');
    $finalItems = array();
    for ($i = 0; $i < count($selectedItems); ++$i){
        if ($selectedItems[$i] != 'none' && $selectedItems[$i] != 'all'){
            if ( is_numeric($selectedItems[$i]) ){
                $finalItems['pd'] = $selectedItems[$i];
            }
            else{
                $finalItems['a'] = $selectedItems[$i];
            }
        }
    }

    //If the value of the array element is 'all' or 'none', it means that users select 'I don't know' as their answers.
    //We need to get all data if the answer is 'I don't know' to either question. Therefore, we remove them from the final array so no parameters will be passed to API.
    foreach ($finalItems as $key => $value){
        if ($value == 'all' || $value == 'none'){
            unset($finalItems[$key]);
        }
    }

    $postedDate = '';
    $documentType = 'dct=N%20PR%20FR%20O%20SR';
    $sortBy = 'sb=postedDate';
    $sortOrder = 'so=DESC';

    if ($keywords != ''){
        $keywords = str_replace(' ', '%20', $keywords);
        $apiURL = $apiURL . '&' . 's=' . $keywords;
    }

    if (array_key_exists('a', $finalItems)){
        $apiURL = $apiURL . '&' . 'a=' . trim($finalItems['a']);
    }

    if (array_key_exists('pd', $finalItems)){
        $unixEpochTime = time(); // Gets the current unix epoch time
        $today = date('m/d/Y', $unixEpochTime);
        $secsInOneDay = 86400;
        $unixEpochTime = $unixEpochTime - ( $secsInOneDay * $finalItems['pd'] ); // Subtract passed days from this timestamp
        $pastDate = date('m/d/Y', $unixEpochTime);
        $postedDate = $pastDate . '-' . $today;
        $apiURL = $apiURL . '&' . 'pd=' . $postedDate;
    }

    $apiURL = $apiURL  . '&' . $documentType ;//. '&' . $sortBy . '&' . $sortOrder;
    // Pull data from the target data-source
    $jsonData = curl_get_contents($apiURL);
    $objData = json_decode($jsonData, true);
    
    // Debug info 
    global $user;
    if ( !empty($user) && !empty($user->name) && $user->name === 'reisysbizuser' ) {
        kprint_r(
            array(
                'apiURL' => $apiURL,
                'jsonData' => $jsonData,
                'objData' => $objData
            )
        );
    }

    // If there was an error obtaining data from $apiURL, inform the BizUSA development team
    if ( strval($jsonData) === '' || is_null($jsonData) ) {
        dispatchEmails(
            array(
                'dfrey@reisystems.com',
                'panjaneya@reisystems.com',
                'sjhawar@reisystems.com',
                'jimmy.cretney@reisystems.com',
                'clei@reisystems.com',
                'sanjay.gupta@reisystems.com',
                'jagjeet.jassal@reisystems.com',
                'chandrika.sreenivasa@reisystems.com',
            ),
            'no-reply@businessusa.gov', 
            'Possible Regulations API Issue', 
            "This is an automated message - It appears a request to pull data from the target-URL; {$apiURL} has failed. 
                Which may be resulting in unexpected behavior in the [Find] Regulations Wizard.<br/>
                This message has been triggered from " . __FILE__ . " on line " . __LINE__ . "<br/>
                <br/>
                The following is a get_defined_vars() dump of all variables in this PHP thread, in this scope:<br/>
                <hr/>
                <pre>" . print_r(get_defined_vars(), true) . "</pre>"
        );
    }
    
    // Determine results
    foreach($objData['documents'] as $document){
        $docId = $document['documentId'];
        $url = "http://www.regulations.gov/#!documentDetail;D=" . $docId;
        $status = '';
        $commentDueDate = $document['commentDueDate'];
        $docPostedDate = $document['postedDate'];

        if ((bool)$document['openForComment']){
            //Check to see if the document comment is closing in 30 days.
            if(strtotime($commentDueDate) <= strtotime('+30 days')){
                $status = 'Closing Soon';
            } else {
                $status = 'Open for Comment';
            }
        }
        //Check to see the comment closed date is within 30 days ago.
        else if(strtotime($commentDueDate) > strtotime('-30 days')){
            $status = 'Recently Closed';
        }
        else if(strtotime($docPostedDate) > strtotime('-30 days')){
            $status = 'Published Recently';
        }

        $newWizardResult = array(
            'title' => $document['title'],
            'link' => $url,
            'snippet' => '<span>' . $status . '</span>' . '<span>' . substr($document['summary'], 0, 250) . '</span>',
            'tags' => array(),
            'tag_count' => 0,
            'all_tags' => array(),
            'type' => 'regulation',
            'promoted' => 0,
            'html_comment' => ''
        );
        $wizardResults->results['regulation'][] = $newWizardResult;
    }
    
// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'regulation' => 'Recommended Results from Regulations.gov based on your search criteria: ' . strip_tags($_REQUEST['allTags']['keyword_textbox'])
        ),
        'legend' => array(
            'regulation' => array(
                'title' => 'Regulations',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/federal_registration.png'
            ),
        ),
        'sideBars' => array(
            'sidebar-articles' => overridable('sites/all/pages/browseregulations/sidebar-articles.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Render results HTML
    print theme('yawizard_sections', $wizardResultsRenderableArray);
