<div class="ptac-top-section" rendersource="<?php print __FILE__; ?>">
    
    <div class="ptac-title">
        PTACS Near You
        <a href="javascript: void(0);" title="Click here to learn more" onclick="jQuery.colorbox({html: jQuery('.ptac-colorbox-container').html()});">
            [?]
        </a>
    </div>
    <div class="ptac-colorbox-container" style="display: none;">
		<div class="colorbox-logo">
			<div class="wizard-email-kill-colorbox" onclick="jQuery.colorbox.close();">
				Close
			</div>
			<div class="colorbox-logo-innerwrapper">
				<img src="/sites/all/themes/bizusa/images/logo.png">
			</div>
		</div>
        <div class="ptac-colorbox-content">
            <br/>
            Procurement Technical Assistance Centers (PTAC) provide assistance to business firms <br/> 
            in marketing products and services to the Federal, state and local governments.<br/>
            <br/>
            <a href="/program/procurement-technical-assistance-centers">
                Learn More.
            </a>
            <br/>
            <br/>
        </div>
    </div>
</div>
<?php
    $zip = $_REQUEST['allTags']['zip_location'];
    $locInfo = getLatLongFromZipCode($zip); // DevNote: This function is defined in ZipCodeGeolocation.php
    print "<!-- DEBUG INFO: locInfo = " . print_r($locInfo, true) . " -->";
    print "<!-- Executing View procurement_and_ta_offices / default with parameter {$locInfo['state']} -->";
    print views_embed_view('procurement_and_ta_offices', 'default', $locInfo['state']);
?>