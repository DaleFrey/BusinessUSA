<?php

    global $rtn;
    global $html;
    global $wizard;
    global $wizardResults;
    global $tagIsSelected;
    global $allWizTags;
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
    $wizard_selected_tags = array_keys($_REQUEST['allTags'], 1);
    $tagIsSelected = $_REQUEST['allTags'];
    
// Special case - if the user does not select any of the tags in the "Manage and Retain" section, assume all of these tags to be selected
if ( $tagIsSelected['manage_and_retain_employees'] ) { // If the user is in the "Manage and Retain" section...
    if ( !$tagIsSelected['employment_law'] && !$tagIsSelected['employee_handbook'] && !$tagIsSelected['retention_strategies'] && !$tagIsSelected['succession_planning'] && !$tagIsSelected['layoff_resources'] ) {
        $tagIsSelected['employment_law'] = 1;
        $tagIsSelected['employee_handbook'] = 1;
        $tagIsSelected['retention_strategies'] = 1;
        $tagIsSelected['succession_planning'] = 1;
        $tagIsSelected['layoff_resources'] = 1;
    }
}

// Special case - if the user does not select any of the tags in the "Interview and Hire" section, assume all of these tags to be selected
if ( $tagIsSelected['interview_and_hire'] ) { // If the user is in the "Interview and Hire" section...
    if ( !$tagIsSelected['select_and_prescreen'] && !$tagIsSelected['inteview_that_get_results'] && !$tagIsSelected['effective_interview_questions'] && !$tagIsSelected['illegal_interview_questions'] && !$tagIsSelected['assessments'] && !$tagIsSelected['decide_on_a_candidate'] && !$tagIsSelected['negotiate_and_offer'] && !$tagIsSelected['onboarding'] && !$tagIsSelected['legal_hiring_issues'] ) {
        $tagIsSelected['select_and_prescreen'] = 1;
        $tagIsSelected['inteview_that_get_results'] = 1;
        $tagIsSelected['effective_interview_questions'] = 1;
        $tagIsSelected['illegal_interview_questions'] = 1;
        $tagIsSelected['assessments'] = 1;
        $tagIsSelected['decide_on_a_candidate'] = 1;
        $tagIsSelected['negotiate_and_offer'] = 1;
        $tagIsSelected['onboarding'] = 1;
        $tagIsSelected['legal_hiring_issues'] = 1;
    }
}
    
// Generate results 
    /*
        This wizard-result-engine will depend on "sub-engines" based on what tags the users has selected.
        THE SUB-ENGINE MUST DETERMIN THE HTML CODE OF THE RESULTS SECTION and set 
        the $html variable.
        
        We will be including either
        
            1) An external PHP files based on the tags selected, see wizard-results-engine-jobcenter-*.php files
                where * is the selected tags, seperated by a dash (-) 
            2) wizard-results-engine-jobcenter-excelresults.php which will assume results are stored in the 
                Excel spreadsheet, the same method the most other Wizards user (tag-matching with column 
                titles in excel) will be used.
    */
    
    include_once( overridable('sites/all/pages/jobcenter-wizard/wizard-results-engine-jobcenter-careeronestop-api-helper.php') );
    
    global $wizardResults;
    $wizardResults = new stdClass;
    
    //kprint_r( $_POST );
    
    $subEnginePath = 'sites/all/pages/jobcenter-wizard/wizard-results-engine-jobcenter-' . implode('-', $wizard_selected_tags) . '.php';
    //print "<div class=\"admin-only\">This wizard will use {$subEnginePath} as the results engine if it exists.<br/></div>";
    if ( !file_exists(overridable($subEnginePath)) ):
    
        //print "<div class=\"admin-only\">It does not, using wizard-results-engine-jobcenter-excelresults.php<br/></div>";
        $defaultEnginePath = 'sites/all/pages/jobcenter-wizard/wizard-results-engine-jobcenter-excelresults.php';
        include( overridable($defaultEnginePath) );
        
    else: ?>

        <?php if ( in_array(basename($subEnginePath), array('wizard-results-engine-jobcenter-recruit_and_hire-where_to_find_candidates-local_schools_and_training_programs.php', 'wizard-results-engine-jobcenter-recruit_and_hire-where_to_find_candidates-connect_to_professional_association.php', 'wizard-results-engine-jobcenter-train_and_retain-training_options-find_local_training_options.php')) ): ?>
            
            <?php include( overridable($subEnginePath) ); ?>
            
        <?php else: ?>
        
            <div class="wizard-results-wrapper has-sidebar-true" rendersource="<?php print basename(__FILE__); ?>">
                <div class="wizard-result-sections-container" rendersource="<?php print basename(__FILE__); ?>">
                    <?php include( overridable($subEnginePath) ); ?>
                </div>
                <div class="wizard-sidebars-container">
                    <div class="wizard-sidebar wizard-sidebar-sidebar-jobcenters">
                        <?php include( overridable('sites/all/pages/jobcenter-wizard/sidebar-jobcenters.php') )  ?>
                        <?php include( overridable('sites/all/pages/jobcenter-wizard/sidebar-articles.php') )  ?>
                    </div>
                </div>
            </div>
            
        <?php endif; ?>
        
    <?php endif; ?>
    
    