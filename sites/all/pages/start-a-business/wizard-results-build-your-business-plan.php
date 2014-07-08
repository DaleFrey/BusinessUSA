<div class="build-business-plan-container">
	<div class="build-business-plan-content">
		<div class="result-title">
			STEPS TO BUILD YOUR BUSINESS PLAN.
		</div>
		<div>
			Displaying the steps that needs to be done to build your business plan <br /><br />
		</div>
		<div class="build-business-plan-youtube">
			<iframe title="Plan Business Steps" height="500" width="100%" src="http://www.youtube.com/embed/SMr_uLZV-eM?rel=0&cc_load_policy=1" frameborder="0" allowfullscreen></iframe>
		</div>
    
		<div class="build-business-plan-learnmoretext">
			<br />
			Are you interested in starting a business? One of the first things that you need to do is to work on a business plan. A Business Plan serves as a road map for the early years of the business. The business plan generally projects 3-5 years ahead and outlines the route a company intends to take to reach its yearly milestones including revenue projections. <br/>
			<br/>
			A business plan is so important because it actually serves as a compass for the direction your business will take in the future. Having a plan will also help you achieve the things you want to achieve and will help your business to find success as well. 
		</div>
	</div>
	<div id="buildyourbusinessplanarticles">
        <?php
        global $businessplanspreadsheetRows;
        // Load everything from the excel spreadsheet into a variable
        $businessplanspreadsheetRows = ya_wizard_excelToArray(__DIR__ . '/build-your-business-plan-articles.xls'); // ya_wizard_excelToArray() reads a target Excel file, and returns an array of all the rows/cells in the target spreadsheet

        // Debug
        dsm("We have all rows from the sidebar-example-articles.xls spreadsheet in \$businessplanspreadsheetRows now.");
        dsm("\$businessplanspreadsheetRows looks like this:");
        dsm( $businessplanspreadsheetRows );

        // Based on the information in the excel spreadsheet, render the markup for each individual results to be put into pagination
        $resultMarkupArray = array();
        foreach ( $businessplanspreadsheetRows as $row ) {
            $rowAssoc = $row['assoc'];
            $resultMarkupArray[]= '
                    <div class="start-a-business-article-result" rendersource="' . basename(__FILE__) . '" style="display:inline;" >
                        
						<a target="_blank" href="' . $rowAssoc['link'] . '">
							<div class="wizard-result-title">
								' . $rowAssoc['title'] . '
							</div>
						</a>
                       
                    </div>
                ';
        }

        foreach($resultMarkupArray as $result){
            print $result;
        }
        ?>
		<a href="http://www.sba.gov/business-plan/1" class="ext" target="_blank">
			<div class="getStartedButton">Get Started
			</div>
		</a>
	</div>
    <a style="cursor: pointer;" class="btn-back-to-top">
        <div class="topLink">Back to top</div>
    </a>
</div>
