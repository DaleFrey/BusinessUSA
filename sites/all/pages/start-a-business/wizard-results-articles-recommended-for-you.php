<div class="articles-recommended-container">
	<?php

    global $wizardResults;
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
		$potentialResults = ya_wizard_excelToArray('sites/all/pages/start-a-business/wizard-results.xls');
		
		// Run through the excels and determin what should be in the result set
		foreach ( $potentialResults as $potentialResult ) {
		
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
			
			$anyFromLastSectionIsBothOfInterestAndSelected = intval(
				$always_show || $home_yes || $franchise_yes || $hiring_yes || $online_yes || $invent_yes || $buying_yes || $multistate_yes || $nonprofit || $native_american || $minority_owned || $veteran_owned || $women_owned || $self_employed || $green || $disabled
			);
			$articleSetToAlwaysShow = intval( $potentialResult['assoc']['always_show'] );
			print "
				anyFromLastSectionIsBothOfInterestAndSelected is $anyFromLastSectionIsBothOfInterestAndSelected
			";
			$logicResult =  ( 
				$articleSetToAlwaysShow || $anyFromLastSectionIsBothOfInterestAndSelected
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
				if (isset($api_records)) {
					unset($api_records[$key]);
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
				
				// Search MySQL for this node based on the title
				$targetTitle = $potentialResult['assoc']['title'];
				$q = "
					SELECT 
						nid AS nid,
						n.title AS node_title, 
						n.type AS node_type,
						usr.name AS uname,
						d.field_article_detail_desc_value AS snippet
					FROM node n 
					LEFT JOIN field_data_field_article_detail_desc d ON (d.entity_id = n.nid)
					LEFT JOIN users usr ON ( usr.uid = n.uid )
					WHERE 
						n.type = 'article'
						AND n.title='$targetTitle';
				";
				$result = db_query($q);
				
				// Get selected tags associated with this result
				$assocTagsToShow = array();
				foreach ( $tagIsOfIntAndSelected as $tagName => $thisTagIsSelected ) {
					if ( $thisTagIsSelected ) {
						$assocTagsToShow[] = $tagName;
					}
				}
				
				// Truncate snippet
				/*
					$snippet = strip_tags($record->snippet);
					$snippet = substr($snippet, 0, 150) . '...';
				*/
				$snippet = $potentialResult['assoc']['snippet'];
				$link = $potentialResult['assoc']['link'];
				
				// Get and organize the data returned from MySQL into a $newWizardResult variable
				foreach ($result as $record) {
					$wizardResults->resultCount++;
					$wizardResults->results['article'][] = array(
						'nid' => $record->nid,
						'title' => str_replace('.', '', $record->node_title),
						'snippet' => $snippet,
						'link' => $link,
						'toprated' => $articleSetToAlwaysShow,
						'tags' => $assocTagsToShow,
						'tag_count' => count($assocTagsToShow),
						'all_tags' => $allWizTags,
						'type' => $record->node_type,
						'user' => $record->uname,
						'promoted' => intval($promoted)
					);
				}
			}
		}
		
	// Sort the results array - The sortResultsArrayByFields() function is defined in wizard-results.ajax.overridable.php
		//$wizardResults->results = sortResultsArrayByFields($wizardResults->results, 'promoted', 'tag_count');

	// Render results HTML
		/*kprint_r($wizardResults->results['article']);
		print theme(
			'yawizard_sections', 
			array(
				'sections' => $wizardResults->results,
				'titles' => array(
					'article' => 'Articles Recommended for You'
				),
				'legend' => array(
					'article' => array(
						'title' => 'Articles',
						'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/program.png'
					),
				)
			)
		);*/

		$topresultMarkupArray = array();
		$selectedMarkupArray = array();

		foreach ( $wizardResults->results['article'] as $row ) {
			//$rowAssoc = $row['assoc'];
			if ($row['toprated'] == '1'){
				$topresultMarkupArray[]= '
							<div class="start-a-business-article-result" rendersource="' . basename(__FILE__) . '" style="display:none;" >
								<div class="wizard-result-title">
									<a target="_blank" href="' . $row['link'] . '">
										' . $row['title'] . '
									</a>
								</div>
								<div class="wizard-result-snippet">
									' . $row['snippet'] . '
								</div>
							</div>
						';
			}
			else{
				$selectedMarkupArray[]= '
							<div class="start-a-business-article-result" rendersource="' . basename(__FILE__) . '" style="display:none;" >
								<div class="wizard-result-title">
									<a target="_blank" href="' . $row['link'] . '">
										' . $row['title'] . '
									</a>
								</div>
								<div class="wizard-result-snippet">
									' . $row['snippet'] . '
								</div>
							</div>
						';
			}
		}

		if (count($selectedMarkupArray) > 0){
			print '<div id="articlesrecommendedforyoutopratedarticles" class="hastwosections"><div class="sbarticles-header">Most Popular Articles</div>';
		}
		else{
			print '<div id="articlesrecommendedforyoutopratedarticles"><div class="sbarticles-header">Most Popular Articles</div>';
		}

		print '<div class="sbarticles-content">';
		foreach($topresultMarkupArray as $result){
			print $result;
		}

		if (count($topresultMarkupArray) > 2){
			print '<input type="button" value="View All" class="collapsed btnviewallarticles"/>';
		}
		print '</div></div>';

		if (count($selectedMarkupArray) > 0){
			print '<div id="articlesrecommendedforyoubasedonanswersarticles" class="hastwosections"><div class="sbarticles-header">Articles Based on Your answers</div>';
			print '<div class="sbarticles-content">';
			foreach($selectedMarkupArray as $result){
				print $result;
			}

			if (count($selectedMarkupArray) > 2){
				print '<input type="button" value="View All" class="collapsed btnviewallarticles"/>';
			}
			print '</div></div>';
		}
	?>
    <a style="cursor: pointer;" class="btn-back-to-top">
        <div>Back to top</div>
    </a>
</div>

