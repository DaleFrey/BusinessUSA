<?php

global $rtn;
global $html;
global $wizard;
global $wizardResults;
global $tagIsSelected;
global $allWizTags;

// Determin the user's location
    $userZip = $_POST['inputs']['user_zip'];
    $locInfo = getLatLongFromZipCode($userZip);
    $stateAbv = $locInfo['state'];

// Generate results - from excel
    
    $wizardResults->results = array(
        'program' => array(),
        'articles' => array(),
    );
    
    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/jobcenter-wizard/wizard-results.xls'));
    
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
        $isInterestedAndSelectedArticle = intval(
            $partner_with_local_businesses || $work_opportunity_tax_credit_wotc || $competency_module_clearinghouse || $certifications || $internships || $contract_temp_workers || $know_your_hiring_needs || $select_and_prescreen || $inteview_that_get_results || $effective_interview_questions || $illegal_interview_questions || $assessments || $decide_on_a_candidate || $negotiate_and_offer || $onboarding || $legal_hiring_issues || $healthcare_and_insurance || $employment_law || $employee_handbook || $retention_strategies || $succession_planning || $layoff_resources || $develop_your_own_training || $literacy_educations || $soft_skills || $research_salaries || $on_the_job_training || $apprenticeship || $hire_a_vet 
        );
        $salgIsTargetState = intval(
            $stateAbv == $potentialResult['assoc']['state']
        );
        $salgShowResult = intval( $salgIsTargetState && $state_and_local_grants );
        $logicResult = (
            $isInterestedAndSelectedArticle || 
            $salgShowResult
        );
        print "
            Debug info here:

            PotentialResult Title: " . $potentialResult['assoc']['title'] . "
            
            partner_with_local_businesses is $partner_with_local_businesses
            work_opportunity_tax_credit_wotc is $work_opportunity_tax_credit_wotc
            competency_module_clearinghouse is $competency_module_clearinghouse
            certifications is $certifications
            internships is $internships
            contract_temp_workers is $contract_temp_workers
            know_your_hiring_needs is $know_your_hiring_needs
            select_and_prescreen is $select_and_prescreen
            inteview_that_get_results is $inteview_that_get_results
            effective_interview_questions is $effective_interview_questions
            illegal_interview_questions is $illegal_interview_questions
            assessments is $assessments
            decide_on_a_candidate is $decide_on_a_candidate
            negotiate_and_offer is $negotiate_and_offer
            onboarding is $onboarding
            legal_hiring_issues is $legal_hiring_issues
            healthcare_and_insurance is $healthcare_and_insurance
            employment_law is $employment_law
            employee_handbook is $employee_handbook
            retention_strategies is $retention_strategies
            succession_planning is $succession_planning
            layoff_resources is $layoff_resources
            develop_your_own_training is $develop_your_own_training
            literacy_educations is $literacy_educations
            soft_skills is $soft_skills
            research_salaries is $research_salaries
            stateAbv is $stateAbv
            potentialResult['assoc']['state'] is " . $potentialResult['assoc']['state'] . "
            salgIsTargetState is $salgIsTargetState
            state_and_local_grants is $state_and_local_grants
            salgShowResult is $salgShowResult
            on_the_job_training is $on_the_job_training
            apprenticeship is $apprenticeship
            
            isInterestedAndSelectedArticle is $isInterestedAndSelectedArticle
            
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
            
            $promoted = 0;
            if ( isset($potentialResult['assoc']['promoted']) ) {
                $promoted = $potentialResult['assoc']['promoted'];
            }
            
            // Search MySQL for this node based on the title (if this results is not entirley on the spreadsheet)
            if ( strval($potentialResult['assoc']['link']) === '' ) {
                $targetTitle = $potentialResult['assoc']['title'];
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
                        (
                            n.type = 'article'
                            OR n.type = 'program'
                        ) AND title='$targetTitle';
                ";
                $result = db_query($q);
                
                // Get selected tags associated with this result
                $assocTagsToShow = array();
                foreach ( $tagIsOfIntAndSelected as $tagName => $thisTagIsSelected ) {
                    if ( $thisTagIsSelected ) {
                        $assocTagsToShow[] = $tagName;
                    }
                }
                
                foreach ($result as $record) {
                    // Get and organize the data a the $wizardResults variable
                    $resultCategory = $potentialResult['assoc']['ctype'];
                    $wizardResults->results[$resultCategory][] = array(
                        'nid' => $record->nid,
                        'title' => $record->node_title,
                        'snippet' => truncate_utf8($potentialResult['assoc']['snippet'], 350, true, true),
                        'tags' => $assocTagsToShow,
                        'tag_count' => count($assocTagsToShow),
                        'all_tags' => $allWizTags,
                        'type' => $resultCategory,
                        'user' => $record->uname,
                        'promoted' => intval($promoted),
                        'html_comment' => $thisResultHtmlComment
                    );
                }
            } else {
                
                $resultCategory = $potentialResult['assoc']['ctype'];
                $wizardResults->results[$resultCategory][] = array(
                    'title' => $potentialResult['assoc']['title'],
                    'link' => $potentialResult['assoc']['link'],
                    'snippet' => truncate_utf8($potentialResult['assoc']['snippet'], 350, true, true),
                    'tags' => $assocTagsToShow,
                    'tag_count' => count($assocTagsToShow),
                    'all_tags' => $allWizTags,
                    'type' => $resultCategory,
                    'promoted' => intval($promoted),
                    'html_comment' => $thisResultHtmlComment
                );
                
            }
            
        }
    }
    
// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
//    $wizardResults->results = sortResultsArrayByFields($wizardResults->results, 'promoted', 'tag_count');
    
// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'program' => 'Recommended Programs based on your answers',
            'articles' => 'Recommended Articles based on your answers',
        ),
        'legend' => array(
            'program' => array(
                'title' => 'Programs',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
            ),
            'articles' => array(
                'title' => 'Articles',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/article.png'
            ),
        ),
        'sideBars' => array(
            'sidebar-jobcenters' => overridable('sites/all/pages/jobcenter-wizard/sidebar-jobcenters.php'),
            'sidebar-articles' => overridable('sites/all/pages/jobcenter-wizard/sidebar-articles.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;
    
// Render results HTML
    print theme('yawizard_sections', $wizardResultsRenderableArray);
