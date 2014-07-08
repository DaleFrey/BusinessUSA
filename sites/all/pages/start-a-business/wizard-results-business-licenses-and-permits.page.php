<div class="business-licenses-and-permits-container" rendersource="<?php print basename(__FILE__); ?>">
    <div class="business-licenses-and-permits-welcometext">
        In order to start and operate your business, one must comply with a wide range of local, state and federal rules.
    </div>
    
    <!-- FEDERAL LICENSES AND PERMITS -->
    <div class="sbwiz-lap-branchtitle">Federal Licenses and Permits</div>
    <div class="sbwiz-lap-rootsection">
        <!-- The following dev.sbwiz-lap-staticcontainer is a static results that is stored in <?php print basename(__FILE__); ?> -->
        <div class="sbwiz-lap-container sbwiz-lap-staticcontainer">
            <div class="sbwiz-lap-title">
                Employer Identification Number (EIN)
            </div>
            <div class="sbwiz-lap-desc">
               <p>Employers with employees, business partnerships, and corporations, must obtain an Employer Identification Number (EIN) from the U.S. Internal Revenue Service. The EIN is also known as an Employer Tax ID and Form SS-4.
			   </p>
                <p>U.S. Internal Revenue ServicePhone: 1-800-829-4933</p>
            </div>
            <div class="sbwiz-lap-links">
                <ul>
                    <li>
                        <a href="http://www.irs.gov/pub/irs-pdf/p1635.pdf">
                            Guide to the Employer Identification Number
                        </a>
                    </li>
                    <li>
                        <a href="http://www.irs.gov/businesses/small/article/0,,id=102767,00.html">
                            Apply Online
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- STATE LICENSES AND PERMITS -->
    <div class="sbwiz-lap-branchtitle">State Licenses and Permits</div>
    <div class="sbwiz-lap-rootsection">
    
        <div class="sbwiz-lap-title"><?php print acronymToStateName($stateTarg); ?> Tax Registration</div>
        <div class="sbwiz-lap-branchcontents">
            <div class="sbwiz-lap-container sbwiz-lap-staticcontainer">
                <div class="sbwiz-lap-desc">
                    <p>Businesses that operate within <?php print $stateTarg; ?> are required to register for one or more tax-specific identification 
                    numbers, licenses or permits, including income tax withholding, sales and use tax (sellers permit), and unemployment
                    insurance tax. Contact the following agency for more information about business registration and your tax obligations:</p>
                </div>
                <div class="sbwiz-lap-links">
                    <!-- //General Tax Information and Forms || Category = Tax Registration AND Sub-Category = State Tax Registration -->
                    <?php print views_embed_view('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem_ullink', '1', $stateTarg, 'all', 'Business Tax Registration'); ?>
                    <!-- //Business and Occupational Licenses || Category = State Licenses and Permits	AND Sub-Category = General Business Licenses -->
                    <?php print views_embed_view('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem_ullink', '2', $stateTarg, 'all', 'General Tax Information and Forms'); ?>
                </div>
            </div>
        </div>

        <div class="sbwiz-lap-title">General Business Licenses</div>
        <div class="sbwiz-lap-branchcontents">
            <?php if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) { ?>
                <div style="display: none;" class="debug-info debug-businesslicenses">
                    <!--
                        <?php print_r($_POST); ?>
                    -->
                </div>
            <?php } ?>
            <div class="sbwiz-lap-sectcontainer">
            
                <div class="sbwiz-lap-firstarea" style="display: none;">
                    Information about how to obtain business and occupational licenses and permits
                    <div class="sbwiz-lap-firstarea-links">
                        <ul>
                            <?php
                                $rslts = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_allitems', 'all', $stateTarg, 'General Business Licenses', $countyTarg); 
                                $printedLinks = array();
                                foreach ( $rslts as $rslt ) {
                                    $thisTitle = $rslt->_field_data['nid']['entity']->title;
                                    $thisLink = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                                    if ( in_array($thisLink, $printedLinks) === false ) {
                                        print '<li><a href="' . $thisLink . '">' . $thisTitle . '</a></li>';
                                        $printedLinks[] = $thisLink;
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                
                <?php
                
                    $wizard_selected_tags = json_decode($wizard_selected_tags, true);
                    
                    if ( $_POST["allTags"]["general_business_licenses"] === "1" ) {
                        $rslts = views_get_view_result("start_a_biz_wiz_licenses_and_permits", "start_a_biz_wiz_lap_oneitem", "all", $stateTarg, "General Business Licenses");
                        //print "<!-- general_business_licenses / $stateTarg / General Business Licenses -->";
                        //print '<div style="display: none;">' . views_embed_view("start_a_biz_wiz_licenses_and_permits", "start_a_biz_wiz_lap_oneitem", "all", $stateTarg, "General Business Licenses") . '</div>';
                        foreach ( $rslts as $rslt ) {
                            $thisTitle = $rslt->_field_data['nid']['entity']->title;
                            $url = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                            $descr = $rslt->_field_data['nid']['entity']->field_lap_desc['und'][0]['value'];
                            $grpdescr = $rslt->_field_data['nid']['entity']->field_lap_groupdesc['und'][0]['value'];

                            print "
                                    <div class=\"views-field views-field-nothing$result404class$inDebugClass\">
                                        <span class=\"field-content\">
                                            <div class=\"sbwiz-lap-container\">
                                                <div class=\"sbwiz-lap-groupdesc\">
                                                    <p>$grpdescr</p>
                                                </div>
                                                 <div class=\"sbwiz-lap-title\">
                                                    <ul>
                                                        <li>
                                                            <a href=\"$url\">$thisTitle</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                ";
                        }
                    }
                    
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
                        if ( $_POST["allTags"][$inputName] === "1" ) {
                        
                            print '<div class="sbwiz-lap-title">' . $businessTag . '</div>';
                            $rslts = views_get_view_result("start_a_biz_wiz_licenses_and_permits", "start_a_biz_wiz_lap_oneitem", "all", $stateTarg, $businessTag);
                            foreach ( $rslts as $rslt ) {
                            
                                $thisTitle = $rslt->_field_data['nid']['entity']->title;
                                $url = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                                $descr = $rslt->_field_data['nid']['entity']->field_lap_desc['und'][0]['value'];
                                $grpdescr = $rslt->_field_data['nid']['entity']->field_lap_groupdesc['und'][0]['value'];
                                
                                $result404class = '';
                                if ( call_user_func_cache(604800, 'linkIs404Error', $url) === true ) {
                                    $result404class = ' result-is-404-link';
                                } 
                                
                                $inDebugClass = '';
                                if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) {
                                    $inDebugClass = ' result-isin-debugmode';
                                    print '
                                        <div style="display: none;" class="debug-info debug-businesstag">
                                            <!--
                                                ' . print_r($rslt->_field_data['nid']['entity'], true) . '
                                            -->
                                        </div>
                                    ';
                                }
                                
                                print "
                                    <div class=\"views-field views-field-nothing$result404class$inDebugClass\">
                                        <span class=\"field-content\">
                                            <div class=\"sbwiz-lap-container\">
                                                <div class=\"sbwiz-lap-groupdesc\">
                                                    <p>$grpdescr</p>
                                                </div>";
                                if ($thisTitle != ''){
                                    print "
                                                <div class=\"sbwiz-lap-title\">
                                                    <ul>
                                                        <li>
                                                            <a href=\"$url\">$thisTitle</a>
                                                        </li>
                                                    </ul>
                                                </div>";
                                };

                                print "
                                                <!--<div class=\"sbwiz-lap-desc\">
                                                    <p>$descr</p>
                                                </div>
                                                <div class=\"sbwiz-lap-tag\">
                                                    $businessTag
                                                </div>-->
                                            </div>
                                        </span>
                                    </div>
                                ";

                            }
                            //print views_embed_view("start_a_biz_wiz_licenses_and_permits", "start_a_biz_wiz_lap_oneitem", "all", $stateTarg, $businessTag);
                        }
                    }
                ?>
            </div>
            
            <div class="sbwiz-lap-sectcontainer">
                <!-- //Business Entity Registration - Forms and Applications || Category = Business Entity Filing -->
                <?php print views_embed_view('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '3', $stateTarg); ?>
            </div>
        </div>

        <?php 
            $rslts = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '4', $stateTarg);
            if ( count($rslts) > 0 ) {
        ?>
            <div class="sbwiz-lap-branchtitle sbwiz-lap-title">Disability Insurance</div>
            <div class="sbwiz-lap-branchcontents">
                <div class="sbwiz-lap-sectcontainer">
                    <!-- //Disability Insurance URL || Sub-Category = Insurance Requirements AND Section Name = Disability Insurance -->
                    <?php print views_embed_view('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '4', $stateTarg); ?>
                </div>
            </div>
        <?php } ?>
        
        <?php 
            $rslts = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '5', $stateTarg);
            if ( count($rslts) > 0 ) {
        ?>
            <div class="sbwiz-lap-title">Workers Compensation Insurance</div>
            <div class="sbwiz-lap-branchcontents">
                <div class="sbwiz-lap-sectcontainer">
                    <!-- //Workers Compensation Insurance || Sub-Category = Insurance Requirements AND Section Name = Workers Compensation Insurance -->
                    <?php print views_embed_view('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '5', $stateTarg); ?>
                </div>
            </div>
        <?php } ?>

        <div class="sbwiz-lap-title">Unemployment Insurance</div>
        <div class="sbwiz-lap-branchcontents">
            <div class="sbwiz-lap-sectcontainer">
                <!-- //Unemployment Insurance || Sub-Category = Insurance Requirements AND Section Name = Unemployment Insurance Tax -->
                <?php print views_embed_view('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_oneitem', '7', $stateTarg); ?>
            </div>
        </div>
    </div>
    
    <div class="sbwiz-lap-branchtitle sbwiz-lap-title">Local Permits</div>
    <div class="sbwiz-lap-rootsection-last">
        <div class="sbwiz-lap-container">
            <div class="sbwiz-lap-desc">
                You may be required to apply for permits and licenses from your local government (e.g., city or county). Every 
                place has different requirements. The following are common types of local permits and licenses. 
                <ul>
                    <li>Business Licenses / Tax Permits - from your city or county clerk or revenue department. Many jurisdictions require a trader's license or tax certificate in order to operate. </li>
                    <li>Building Permit - from your city or county building and planning department. This permit is generally required if you are constructing or modifying your place of business. </li>
                    <li>Health Permit - from your city or county health department. </li>
                    <li>Occupational Permit - from your city or county building and planning development department. This permit is required for home-based business in some jurisdictions. </li>
                    <li>Signage Permit - from your city or county building and planning department. Some jurisdictions require a permit before you can erect a sign for your business. </li>
                    <li>Alarm Permit - from you city or county police or fire department. If you have installed a burglar or fire alarm, you will likely need an alarm permit. </li>
                    <li>Zoning Permit - from your city or county building and planning department. This permit is generally required if you are developing land for specific commercial use. </li>
                    <li>Depending on the nature of your business, you may need other types of licenses specific to your business. Check with the following local government(s) for more </li>
                </ul>
            </div>
            <!-- //Local Permits -->
            <div class="sbwiz-lap-links">
                <ul>
                    <?php
                        /* Print LI element for City */
                        $rslts = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_allitems', '37', $stateTarg, 'all', $locInfo['city']); 
                        foreach ( $rslts as $rslt ) {
                            $thisTitle = $rslt->_field_data['nid']['entity']->title;
                            $thisLink = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                            if ( strpos(strtolower($thisTitle), strtolower($locInfo['city'])) !== false ) {
                                print '<li><a href="' . $thisLink . '">' . $thisTitle . '</a></li>';
                                $printedLinks[] = $thisLink;
                            }
                        }
                    ?>
                    <?php
                        /* Print LI element for County */
                        $rslts = views_get_view_result('start_a_biz_wiz_licenses_and_permits', 'start_a_biz_wiz_lap_allitems', '37', $stateTarg, 'all', 'all', 'NOTAPPLICABLE'); 
                        foreach ( $rslts as $rslt ) {
                            $thisTitle = $rslt->_field_data['nid']['entity']->title;
                            $thisLink = $rslt->_field_data['nid']['entity']->field_lap_url['und'][0]['value'];
                            if ( strpos(strtolower($thisTitle), strtolower($countyTarg)) !== false ) {
                                print '<li><a href="' . $thisLink . '">' . str_replace(', ', ' - ', $thisTitle) . '</a></li>';
                                $printedLinks[] = $thisLink;
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <br/>
    <div id="businesslicensesandpermitsarticles">
        <div class="sbarticles-header">Articles Related to Business Licenses and Permits</div>
		<div class="sbarticles-content">
			<?php
            global $businesslicensesandpermitsspreadsheetRows;
			// Load everything from the excel spreadsheet into a variable
			$businesslicensesandpermitsspreadsheetRows = ya_wizard_excelToArray(__DIR__ . '/business-licenses-and-permits-articles.xls'); // ya_wizard_excelToArray() reads a target Excel file, and returns an array of all the rows/cells in the target spreadsheet

			// Debug
			dsm("We have all rows from the sidebar-example-articles.xls spreadsheet in \$businesslicensesandpermitsspreadsheetRows now.");
			dsm("\$businesslicensesandpermitsspreadsheetRows looks like this:");
			dsm( $spreadsheetRows );

			// Based on the information in the excel spreadsheet, render the markup for each individual results to be put into pagination
			$resultMarkupArray = array();
			foreach ( $businesslicensesandpermitsspreadsheetRows as $row ) {
				$rowAssoc = $row['assoc'];
				$resultMarkupArray[]= '
						<div class="start-a-business-article-result" rendersource="' . basename(__FILE__) . '" style="display:none;" >
							<div class="wizard-result-title">
								<a target="_blank" href="' . $rowAssoc['link'] . '">
									' . $rowAssoc['title'] . '
								</a>
							</div>
							<div class="wizard-result-snippet">
								' . $rowAssoc['snippet'] . '
							</div>
						</div>
					';
			}

			foreach($resultMarkupArray as $result){
				print $result;
			}
			?>
		
			<input type="button" value="View All" class="collapsed btnviewallarticles"/>
		</div>
    </div>
    <a style="cursor: pointer;" class="btn-back-to-top">
		<div class="topLink">Back to top</div>
	</a>
</div>