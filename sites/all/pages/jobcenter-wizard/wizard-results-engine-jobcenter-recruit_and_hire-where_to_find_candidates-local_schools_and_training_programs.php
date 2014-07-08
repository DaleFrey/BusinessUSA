<?php
    
    global $rtn;
    global $html;
    global $wizard;
    global $wizardResults;
    global $tagIsSelected;
    global $allWizTags;
    
    $apiReturn = careerOneStopAPI_localSchoolsAndTrainingPrograms(
        $_POST['inputs']['lsatp_search'], 
        $_POST['inputs']['user_zip']
    );
    
    $wizardResults->results = array(
        'program' => array()
    );
    
    foreach ( $apiReturn as $potentialResult ) {
        
        $thisLink = $potentialResult['assoc']['Web address'];
        if ( strpos($thisLink, 'http://') === false && strpos($thisLink, 'https://') === false ) {
            $thisLink = 'http://' . $thisLink;
        }
        
        // Get and organize the data a the $wizardResults variable
        $wizardResults->resultCount++;
        $wizardResults->results['program'][] = array(
            'title' => $potentialResult['assoc']['School Name/Location'] . ' - ' . $potentialResult['assoc']['Program Name'],
            'link' => $thisLink,
            'snippet' => 
                $potentialResult['assoc']['Address'] . '<br/>' . 
                $potentialResult['assoc']['City'] . ', ' . $potentialResult['assoc']['State'] . ' ' . $potentialResult['assoc']['Zip'],
            'tags' => 0,
            'tag_count' => count(),
            'all_tags' => array(),
            'type' => 'program',
            'promoted' => 0,
            'html_comment' => 'see wizard-results-engine-jobcenter-recruit_and_hire-where_to_find_candidates-local_schools_and_training_programs.php'
        );
    }
    

// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'program' => 'Recommended Schools based on your answers',
        ),
        'legend' => array(
            'program' => array(
                'title' => 'Schools',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
        ),
        'sideBars' => array(
            'sidebar-jobcenters' => overridable('sites/all/pages/jobcenter-wizard/sidebar-jobcenters.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Render results HTML
    print theme('yawizard_sections', $wizardResultsRenderableArray);
