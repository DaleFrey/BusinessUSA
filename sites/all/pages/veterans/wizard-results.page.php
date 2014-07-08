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
    //kprint_r( $tagIsSelected );

// Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'verification' => array(),
        'expanding' => array(),
        'training' => array(),
    );
    
    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray(overridable('sites/all/pages/veterans/wizard-results.xls'));
    
    // Run through the excels and determin what should be in the result set
    foreach ( $potentialResults as $excelRow => $potentialResult ) {
        
        // Run logic code to determin if this potental result should be in the final result set
        extract( $tagIsOfIntAndSelected );
        ob_start();
		$emptyQuery = intval(
			!$tagIsSelected['veteran_owned'] && !$tagIsSelected['veteran_assistance'] && !$tagIsSelected['education_training'] && !$tagIsSelected['mentoring'] && !$tagIsSelected['financing'] && !$tagIsSelected['technical_assistance'] && !$tagIsSelected['federal_contracting'] && !$tagIsSelected['other'] && !$tagIsSelected['national'] && !$tagIsSelected['newyork'] && !$tagIsSelected['oklahoma'] && !$tagIsSelected['active_duty'] && !$tagIsSelected['veteran'] && !$tagIsSelected['veteran_family_member'] && !$tagIsSelected['service_disabled'] && !$tagIsSelected['woman'] && !$tagIsSelected['other_disadvantaged']
		);
        
        $logicResult = eval( $potentialResult['assoc']['phplogic'] );
        
        if ( $enabelDebug === true ) { $html .= '<div class="debug-info debug-info-wizard-logic" style="display: none;">' . ob_get_contents() . '</div>'; }
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
							$api_results[$excelRow] = $potentialResult;
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
                    $assocTagsToShow[] = $tagName;
                }
            }
            
            $wizardResults->results[ $potentialResult['assoc']['type'] ][] = array(
                'title' => $potentialResult['assoc']['title'],
                'link' => $potentialResult['assoc']['url'],
                'snippet' => $potentialResult['assoc']['snippet'],
                'tags' => $assocTagsToShow,
                'tag_count' => count($assocTagsToShow),
                'all_tags' => $assocTagsToShow,
                'type' => $potentialResult['assoc']['type'],
                'promoted' => 100
            );
        }
    }
    
// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
    /*foreach ( $wizardResults->results as &$result ) {
        $result = sortResultsArrayByFields($result, 'promoted', 'tag_count');
    }*/
    
// Welcome messages for this wizard
$welcomeMessages = array();
$welcomeMessages['disclaimer'] = '
    <div class="note-veteran-container">
        <div id="note-veteran">
            <div>
              <b>TIP:</b> For your business to qualify as an official Veteran-Owned Business, you must:
              <p>1) <a href="/start-a-business" target="_blank">Start a Business</a> </p>
              <p>2) Complete the <a href="http://www.sba.gov/offices/headquarter/obd/resources/4210" target="_blank">SBA small business certification</a> then</p>
              <p>3) Complete the <a href="http://www.va.gov/osdbu/verification/instructions.asp" target="_blank"> VA veteran business verification</a> process for either a Service-Disabled Veteran-Owned Small Business (SDVOSB)
                or a Veteran-Owned Small Business (VOSB). To get started, explore the topics below.</p>
            </div>
            <div class="btn-close" style= "background:url(/sites/all/themes/bizusa/images/sbir-images/controls.png) 0px 0px no-repeat"> </div>
        </div>
    </div>
';
$welcomeMessages['wizard-startabiz'] = '
    <div class="wizard-startabiz">
        <div class="wizard-startabiz-icon">
            <img src="/sites/all/themes/bizusa/images/icon-sm-fs1-color.png" style="height: 30px;"/>
        </div>
        <div class="wizard-startabiz-right">
            <div class="wizard-startabiz-title">
              <a href="/start-a-business" target="_blank"> Start a Business</a>
            </div>
            <div class="wizard-startabiz-snippet">
                The Start a Business wizard will guide you through aspects of starting a business and finding information you need to succeed. Some useful resources available in this wizard include information on Licenses and Permits,
                creating a Business Plan, conducting Market Research and connecting with Local Business Counselors.
            </div>
        </div>
    </div>
';
$welcomeMessages['wizard-growbiz'] = '
    <div class="wizard-growbiz">
        <div class="wizard-growbiz-icon">
            <img src="/sites/all/themes/bizusa/images/icon-sm-fs2-color.png" style="height: 30px;" />
        </div>
        <div class="wizard-growbiz-right">
            <div class="wizard-growbiz-title">
               <a href="/resource/grow-your-business" target="_blank"> Grow Your Business</a>
            </div>
            <div class="wizard-growbiz-snippet">
                Grow your Business helps users to find information and guidance that will help you manage and grow your business effectively.
            </div>
        </div>
    </div>
';
$welcomeMessages['wizard-franchise'] = '
    <div class="wizard-franchise-right">
        <div class="wizard-franchise-title">
           <a href="http://www.va.gov/osdbu/entrepreneur/franchising.asp" target="_blank">Franchise</a>
        </div>
        <div class="wizard-franchise-snippet">
             To speed and improve the franchise ownership process, the International Franchise Association (IFA) serves
             as a conduit between Veterans and the participating franchise systems, but does not engage in negotiations,
             nor does IFA provide financing or financial guidance.
        </div>
    </div>
';

// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'showTop5Label' => false,
        'showSectionIcons' => false,
        'numberEachSection' => true,
        'collapsibleSections' => true,
        'welcomeMessage' => $welcomeMessages,
        'titles' => array(
            'verification' => 'Verification of Veterans Status',
            'expanding' => 'Expanding Your Business',
            'training' => 'Assistance and Training',
        ),
        'legend' => array(
            'verification' => array(
                'title' => 'Verification of Veterans Status',
                'img' => '/sites/all/themes/bizusa/images/content-types-icons/20X20/program.png'
            ),
            'expanding' => array(
                'title' => 'Expanding Your Business',
                'img' => '/sites/all/themes/bizusa/images/content-types-icons/20X20/program.png'
            ),
            'training' => array(
                'title' => 'Assistance and Training',
                'img' => '/sites/all/themes/bizusa/images/content-types-icons/20X20/program.png'
            ),
        ),
        'sideBars' => array(
            'further-assistance' => overridable('sites/all/pages/veterans/further-assistance.php'),
        )
    );
    
// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;

// Render results HTML
   // print kprint_r( $wizardResultsRenderableArray );
    print theme('yawizard_sections', $wizardResultsRenderableArray);
    
?>
<script>
    jQuery(document).ready(function() {
        jQuery( ".wizard-result-sections-container" ).prepend(jQuery( ".wizard-results-header-container"));
        jQuery( ".wizard-sidebars-container" ).prepend(jQuery( ".share-export-email-container"));
        jQuery(".btn-close").click(function(){
            jQuery('#note-veteran').hide();
        });
        frameExternalLinks();
    });
</script>

