
<div class="apis-contentContainer" rendersource="<?php print __FILE__; ?>">
	BusinessUSA connects businesses to many government services and information. The Resource Access API is a service that provides access to BusinessUSA resource abstracts including programs, services, data, events, and more, with a simple API call in XML and CSV formats. 
	<br/><br/>

	<h1 property="dc:title" datatype="">Sample API Calls</h1>
    
	<style>
		/* Styles for API documentation */
		.apidocs-bold {
			font-weight: bold;
		}
		.apidocs-feature-container {
			margin-top: 40px;
			border: 1px solid #DEDEDE;
			-moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px;
		}
		.apidocs-feature-content {
			margin-left: 20px;
			margin-right: 20px;
			line-height: 20px;
			padding-top: 1px;
		}
		.apidocs-feature-title {
			font-size: 15px;
			font-weight: bold;
			display: block;
			margin: 0;
			padding: 0 5px;
			color: #4a4a4a;
			height: 36px;
			border-bottom: 1px solid #DEDEDE;
			background: #F5F5F4 url('../../images/apis-title-bg.png') repeat-x;
			padding-left: 10px;
			line-height: 36px;
			text-shadow: #fff 0 1px 1px;
		}
		.apidocs-feature-title a {
			color: white;
		}
		.apidocs-feature-subtitle {
			margin-top: 20px;
			margin-bottom: 10px;
			color: #3F3F3F;
			font-size: 17px;
		}
		.apidocs-feature-individualcontainer {
			margin-bottom: 8px;
		}
		.apidocs-feature-emptyspace {
			height: 20px;
		}
		.apidocs-feature-subcontent {
			border-bottom: 1px dotted #C8C8C8;
			padding-bottom: 10px;
		}
		.apidocs-feature-subcontent:last-child {
			border-bottom: 0px;
		}
		.apidocs-feature-fieldsreturned-text {
			font-family: Courier;
		}
	</style>
		
	<script>
		function apiShowDetails() {
			jQuery(".apidocs-container-extendedinfo").css("display", "inline");
			jQuery(".hide-on-details").css("display", "none");
			jQuery(".show-on-details").css("display", "inline");
		}
	</script>

	<?php

		$SERVER_NAME = $_SERVER['SERVER_NAME'];
		$apiSections = array();
		
		// Key-Word
		$apiSections["1_keywords"] = array(
			"title" => "BusinessUSA - Download by keyword",
			"apiSubSections" => array(
				array(
					"title" => "BusinessUSA - Download by keyword",
					"sub_title" => "Download all entries based on key words in the content-types",
					"description" => "This method outputs all entries  in the business.usa.gov database that contain the input keyword(s). Output format may be either XML or CSV",
					"example_url" => "http://$SERVER_NAME/api/<b>[ReturnType]</b>?keyword=<b>[KeyWordToSearch]</b>",
					"return_type" => "XML, CSV",
					"fields_returned" => 'content-type, detail-description, learn-more-url, title',
					"fields_returned_nocomas" => true
				)
			)
		);
		
		// All
		$apiSections["2_ByContentType"] = array(
			"title" => "BusinessUSA - Download by Content-Type",
			"sub_title" => "Download all entries based on content-type",
			"description" => "This method outputs all entries in the business.usa.gov database of a certain content-type. Output format may be either XML or CSV",
			"example_url" => "http://$SERVER_NAME/api/<b>[ContentType]</b>/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => '',
			"fields_returned_nocomas" => true,
			"apiSubSections" => array()
		);
		
		// Program
		$apiSections["2_ByContentType"]["apiSubSections"]["Programs"] = array(
			"title" => "BusinessUSA - Programs",
			"sub_title" => "Download all Programs",
			"description" => "This method outputs all programs found in the business.usa.gov database either in XML or CSV format",
			"example_url" => "http://$SERVER_NAME/api/program/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => "title, detail_description, eligibility, learn_more_url, organization, poc_name, poc_organization, poc_email, poc_phone_no"
		);
		// Events
		$apiSections["2_ByContentType"]["apiSubSections"]["Events"] = array(
			"title" => "BusinessUSA - Events",
			"sub_title" => "Download all Events",
			"description" => "This method outputs all events found in the business.usa.gov database either in XML or CSV format",
			"example_url" => "http://$SERVER_NAME/api/event/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => "title, event_start_date, event_end_date, detail_description, link_to_register_url address_line_1 address_line_2 city state zip_code organization poc_name poc_email poc_phone_no learn_more_url "
		);
		// Services
		$apiSections["2_ByContentType"]["apiSubSections"]["Services"] = array(
			"title" => "BusinessUSA - Services",
			"sub_title" => "Download all Services",
			"description" => "This method outputs all services found in the business.usa.gov database either in XML or CSV format",
			"example_url" => "http://$SERVER_NAME/api/service/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => "title detail_description eligibility organization poc_name poc_organization poc_phone_no poc_email learn_more_url"
		);
		// Success Story
		$apiSections["2_ByContentType"]["apiSubSections"]["SuccessStory"] = array(
			"title" => "BusinessUSA - Success Stories",
			"sub_title" => "Download all Success Stories",
			"description" => "This method outputs all success stories found in the business.usa.gov database either in XML or CSV format",
			"example_url" => "http://$SERVER_NAME/api/ss/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => "title detailed_text publish_date topic learn_more_url"
		);
		// Article
		$apiSections["2_ByContentType"]["apiSubSections"]["Article"] = array(
			"title" => "BusinessUSA - Article",
			"sub_title" => "Download all Articles",
			"description" => "This method outputs all articles found in the business.usa.gov database either in XML or CSV format",
			"example_url" => "http://$SERVER_NAME/api/article/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => "title learn_more_url publish_date detailed_text topic"
		);
		// Data
		$apiSections["2_ByContentType"]["apiSubSections"]["Data"] = array(
			"title" => "BusinessUSA - Data",
			"sub_title" => "Download all Data",
			"description" => "This method outputs all data content-types in the business.usa.gov database either in XML or CSV format",
			"example_url" => "http://$SERVER_NAME/api/data/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => "title detail_description eligibility organization poc_email poc_name poc_organization poc_phone_no learn_more_url"
		);
		// Tools
		$apiSections["2_ByContentType"]["apiSubSections"]["Tools"] = array(
			"title" => "BusinessUSA - Tools",
			"sub_title" => "Download all Tools",
			"description" => "This method outputs all tool content-types in the business.usa.gov database either in XML or CSV format",
			"example_url" => "http://$SERVER_NAME/api/tools/<b>[ReturnType]</b>",
			"return_type" => "XML, CSV",
			"fields_returned" => "title organization learn_more_url detailed_text"
		);
		
		ksort($apiSections);
		
	?>

	<?php 
	foreach ($apiSections as $apiSection) { ?>

	<div class="apidocs-container">

		<div class="apidocs-feature-container">
			<div class="apidocs-feature-title">
				<?php print $apiSection['title']; ?>
			</div>
			<div class="apidocs-feature-content">
			
				<?php foreach ($apiSection['apiSubSections'] as $apiSubSection) { ?>
						
						<div class="apidocs-feature-subcontent">
						
							<div class="apidocs-bold apidocs-feature-subtitle">
									<?php print $apiSubSection['sub_title']; ?>
							</div>
							<div class="apidocs-feature-description-container">
								<div class="apidocs-feature-individualcontainer">
									<span class="apidocs-bold apidocs-feature-description-title">Description:</span>
									<span class="apidocs-feature-description-text">
										<?php print $apiSubSection['description']; ?>
									</span>
								</div>
								<div class="apidocs-feature-individualcontainer">
									<span class="apidocs-bold apidocs-feature-example-title">Example:</span>
									<span class="apidocs-feature-example-text">
										<?php print $apiSubSection['example_url']; ?>
									</span>
								</div>
								<div class="apidocs-feature-individualcontainer">
									<span class="apidocs-bold apidocs-feature-returntype-title">Return Type:</span>
									<span class="apidocs-feature-returntype-text">
										<?php print $apiSubSection['return_type']; ?>
									</span>
								</div>
								<?php if ( $apiSubSection['fields_returned'] !== '' ) {  ?>
									<div class="apidocs-feature-individualcontainer">
										<span class="apidocs-bold apidocs-feature-fieldsreturned-title">Fields returned from the API: </span>
										<span class="apidocs-feature-fieldsreturned-text">
											<?php print $apiSubSection['fields_returned']; ?>
										</span>
									</div>
								<?php }  ?>
							</div>
							
						</div>
				
				<?php } ?>
				
			</div>
		</div>
	</div>

<?php } ?>

</div>