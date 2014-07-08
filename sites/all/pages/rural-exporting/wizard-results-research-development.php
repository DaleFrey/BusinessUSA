<div class="articles-recommended-container">
    <?php

    global $wizardResults;
    $resultMarkups = array();
    $html = '';

    // Enabel debug message if the current user is the administrator
    $enabelDebug = true;
    $verbose = array(
        'sorting_phases' => array()
    );
    if ( strpos(request_uri(), '-DEBUG-WIZARD-') === false ) {
        $enabelDebug = true;
    }

    // Get the list of tags used by this wizard
    $allWizTags = array_keys($_REQUEST['allTags']);
    $tagIsSelected = $_REQUEST['allTags'];

    // Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'article' => array(),
    );

    // Load potential results from excel
    $potentialResults = ya_wizard_excelToArray('sites/all/pages/rural-exporting/wizard-results.xls');

    // Run through the excels and determin what should be in the result set
    foreach ( $potentialResults as $key => $potentialResult ) {

        $tagIsOfInterset = array();

        // initalize this array-variable
        $tagIsOfIntAndSelected = array();
        foreach ( $allWizTags as $wizTag ) {
            $tagIsOfIntAndSelected[$wizTag] = 0;
        }

        //This variable is used to determine if the result should be included in the final result set when the and_operator is set to 1.
        //When the and_operator is set to 1, it means that the tags of interest have to be all selected by the users.
        $include_in_result = false;

        // Set tagIsOfIntAndSelected[BLAH] to 1 if $tagIsOfInterset[BLAH] == 1, and $tagIsSelected[BLAH] == 1
        if (intval($potentialResult['assoc']['and_operator']) === 0){
            foreach ( $potentialResult['assoc'] as $tagName => $tagVal) {
                $tagIsOfIntAndSelected[$tagName] = 0;
                if ( !empty($tagIsSelected[$tagName]) && intval($tagIsSelected[$tagName]) === 1 ) {
                    if ( intval( $potentialResult['assoc'][$tagName] ) === 1) {
                        $tagIsOfIntAndSelected[$tagName] = 1;
                    }
                }
            }
        }
        else{
            $tagIsOfInterest = array_keys($potentialResult['assoc'], '1');
            //Remove the 'promoted', 'not_tagged', 'and_operator' from the array since they are not used for user selections.
            $exclude_items = array('promoted','not_tagged','and_operator');
            $new_tagIsOfInterest = array_diff($tagIsOfInterest, $exclude_items);
            $selected_tags = array_keys($tagIsSelected, '1');
            //get the array keys that exist in both selected tags array and the new_tagIsOfInterest.
            $compare_result = array_intersect($selected_tags, $new_tagIsOfInterest);
            //if the count of the compare_result array equals the count of the new_tagIsOfInterest array, it means all conditions are satisfied and the result should be included.
            if (count($compare_result) === count($new_tagIsOfInterest)){
                $include_in_result = true;
            }
        }

        // Run logic code to determine if this potential result should be in the final result set
        extract( $tagIsOfIntAndSelected );
        ob_start();

        $anyFromLastSectionIsBothOfInterestAndSelected = intval(
            $dairy || $livestock || $meat_poultry || $transportation || $foreign_markets || $manufacturing || $trade_show || $production_distribution
        );
        $articleSetToAlwaysShow = intval( $potentialResult['assoc']['not_tagged'] );
        print "
				anyFromLastSectionIsBothOfInterestAndSelected is $anyFromLastSectionIsBothOfInterestAndSelected
			";
        $logicResult =  (
            $articleSetToAlwaysShow || $anyFromLastSectionIsBothOfInterestAndSelected || $include_in_result
        );

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

            // Get selected tags associated with this result
            $assocTagsToShow = array();
            foreach ( $tagIsOfIntAndSelected as $tagName => $thisTagIsSelected ) {
                if ( $thisTagIsSelected ) {
                    $assocTagsToShow[] = $tagName;
                }
            }

            $rowAssoc = $potentialResult['assoc'];
            $resultMarkups[]= '
						<div class="start-a-business-article-result" rendersource="' . basename(__FILE__) . '" style="display:block;" >
							<div class="wizard-result-title">
								<a target="_blank" href="' . $rowAssoc['link'] . '">
									' . $rowAssoc['title'] . '
								</a>
							</div>
							<div class="wizard-result-snippet">
								' . $rowAssoc['snippet'] . '
							</div>
						</div><br/>
					';

        }
    }

    if (count($resultMarkups) > 0){
        print theme(
            'yawizard_pagedresults',
            array(
                'resultsPerPage' => 5,
                'resultMarkups' => $resultMarkups
            )
        );
    }
    else{
        print '<div><b>No results matched based on your criteria.</b></div><br/>';
    }
    ?>
</div>

