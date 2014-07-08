<div class="build-business-plan-container" rendersource="<?php print basename(__FILE__); ?>">
    <div class="result-container result-type-sizeup">
        <div class="result-individualicon-container">
            <!-- This div is to contain an icon for this individual result when it should have one  -->
        </div>
        <div class="result-linksnippet-container">
            <div class="result-title">
                <a href="/sizeup" target="_blank">
                    Size Up - Benchmark Your Business
                </a>    
            </div>
            <div class="result-snippet">
                SizeUp will help you manage and grow your business by benchmarking it against competitors, mapping your customers, competitors and suppliers, and locating the best places to advertise...
            </div>
            <div class="result-tags">
                <div class="result-tags-inner">
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div id="conductmarketresearcharticles">
        <div class="sbarticles-header">Articles Related to Business Data and Statistics</div>
		<div class="sbarticles-content">
			<?php
                global $marketresearchspreadsheetRows;
			// Load everything from the excel spreadsheet into a variable
				$marketresearchspreadsheetRows = ya_wizard_excelToArray(__DIR__ . '/conduct-market-research-articles.xls'); // ya_wizard_excelToArray() reads a target Excel file, and returns an array of all the rows/cells in the target spreadsheet

				// Debug
				dsm("We have all rows from the sidebar-example-articles.xls spreadsheet in \$marketresearchspreadsheetRows now.");
				dsm("\$marketresearchspreadsheetRows looks like this:");
				dsm( $marketresearchspreadsheetRows );

				// Based on the information in the excel spreadsheet, render the markup for each individual results to be put into pagination
				$resultMarkupArray = array();
				foreach ( $marketresearchspreadsheetRows as $row ) {
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

