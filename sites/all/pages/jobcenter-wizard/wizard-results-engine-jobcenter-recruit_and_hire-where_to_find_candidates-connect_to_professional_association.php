<?php
    
    global $rtn;
    global $html;
    global $wizard;
    global $wizardResults;
    global $tagIsSelected;
    global $allWizTags;
    
    $apiReturn = careerOneStopAPI_FindProfessionalAssociations(
        $_POST['inputs']['ctpa_search'],
        $_POST['inputs']['user_zip']
    );
    
    if ( isset( $_POST['template'] ) ) {
        $wizardResults->template = $_POST['template'];
    }
    
    $wizardResults->results = array(
        'program' => array()
    );
    
    // Run through the excels and determin what should be in the result set
    
    foreach ( $apiReturn as $potentialResult ) {
    
        // Get and organize the data a the $wizardResults variable
        $wizardResults->results['program'][] = array(
            'title' => $potentialResult['assoc']['Association Name'],
            'link' => $potentialResult['assoc']['URL'],
            'snippet' => '',
            'tags' => 0,
            'tag_count' => count(),
            'all_tags' => array(),
            'type' => 'program',
            'promoted' => 0,
            'html_comment' => 'see wizard-results-engine-jobcenter-recruit_and_hire-where_to_find_candidates-connect_to_professional_association.php'
        );
    }

// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'program' => 'Recommended Professional Associations based on your answers',
        ),
        'legend' => array(
            'program' => array(
                'title' => 'Associations',
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

