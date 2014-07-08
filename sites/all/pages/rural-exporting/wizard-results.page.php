<?php
    global $excelSavePath;
    $excelSavePath = 'sites/default/files/wizard-results-export/BusinessUSA - Wizard Results - ' . time() . '.xls';

    // Determin what state the user is in based on entered zip-code
    $locInfo = getLatLongFromZipCode($_POST['allTags']['enteredzip']);
    $stateTarg = $locInfo['state'];
    $countyTarg = getGeoCounty($locInfo['city'] . ', ' . $locInfo['state']);
    
    $collapsibleSectionNames = array(
        1 => 'Identifying Rules and Regulations',
        2 => 'Paths for Financial Assistance in Exporting',
        3 => 'Market Research',
    );
?>
<div class="wizard-results-wrapper has-sidebar-true" rendersource="<?php print basename(__FILE__); ?>">


<div class="wizard-email-colorbox-container" style="display: none; display: none !import;">
    <div class="wizard-email-colorbox-contents">
        <!-- Logo -->
        <div class="colorbox-logo">
            <div class="wizard-email-kill-colorbox" onclick="jQuery.colorbox.close();">
                Close
            </div>
            <div class="colorbox-logo-innerwrapper">
                <img src="/sites/all/themes/bizusa/images/logo.png">
            </div>
        </div>
        <!-- Welcome message area -->
        <div class="wizard-email-colorbox-msg-area">
            <p>Please enter email address below to receive the wizard results.</p>
            <form action="javascript: submitEmail(); void(0);">
                <input type="text" id="email-input" class="email-input">
                <input type="submit" value="Submit" class="emailButton">
            </form>
            <br clear="all"><br>
            <script>
                function submitEmail() {
                    var targEmailAddress = String( jQuery('.email-input:visible').val() );
                    targEmailAddress = jQuery.trim(targEmailAddress);
                    // Validation
                    if ( targEmailAddress == '' || targEmailAddress == 'null' || targEmailAddress.indexOf('@') == -1 || targEmailAddress.indexOf('.') == -1 ) {
                        alert('Please input a valid email address.');
                        return false;
                    }
                    // Show loading message
                    jQuery('.wizard-email-colorbox-msg-area').hide();
                    jQuery('.wizard-email-colorbox-processing-area').fadeIn();
                    // Trigger the emailWizardExcelResultsSpreadsheet() function in PHP
                    phpFunction('emailWizardExcelResultsSpreadsheet', [targEmailAddress, '<?php print trim($excelSavePath, '/'); ?>'], function () {
                        jQuery('.wizard-email-colorbox-processing-area').hide();
                        jQuery('.wizard-email-colorbox-msg-area').html('<br/><br/>Your wizard results have been sent via e-mail.');
                        jQuery('.wizard-email-colorbox-msg-area').fadeIn();
                    });
                }
            </script>
        </div>
        <!-- Spinner/Loading message area -->
        <div class="wizard-email-colorbox-processing-area" style="display: none;">
            <div class="wizard-email-colorbox-processing-area-inner">
                <img src="data:image/gif;base64,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">
                <div class="processing-message">
                    Please wait while we process this request...
                </div>
            </div>
        </div>
        <!-- Final result (success/error message) area -->
        <div class="wizard-email-colorbox-final-area">
            <div class="wizard-email-colorbox-final-area-inner" style="display: none;">
                <!-- Content here to may be overridden by the javascript submitEmail() function -->
            </div>
        </div>
    </div>
</div>

<!-- ZIP code validation -->
<?php if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) { ?>
    <div style="display: none;" class="debug-info debug-zip-code-validation">
        <!-- 
            DEBUG INFO:
                $locInfo = <?php print_r($locInfo); ?>
        -->
    </div>
<?php } ?>

<?php if ($_POST['allTags']['enteredzip'] != '' && ( $locInfo === false || $locInfo === array(false, false) )) { ?>
    <script>
        alert('We are sorry, the ZIP code you have entered in is not a valid code we could find in our database');
    </script>
<?php } ?>
<br/>
    <div class="wizard-result-sections-container" rendersource="<?php print basename(__FILE__); ?>">
        <div class="note-rural-exporting-container">
            <div id="note-rural-exporting">
                <div>We have designed this wizard specifically for you, based on business's desire to export Agricultural products.</div>
                <div class="btn-close" style= "background:url(/sites/all/themes/bizusa/images/sbir-images/controls.png) 0px 0px no-repeat"></div>
            </div>
        </div>
        <br/>
        <?php if ($_POST['allTags']['export_no'] != '' && ( $_POST['allTags']['export_no'] == '1' )) { ?>
        <div>
            <img alt="" src=""/> Begin Exporting<br/>
            The Begin Exporting wizard will help your business's preparedness for exporting and will guide you to the appropriate resources regarding Company Commitment, Planning and Strategy, Product Preparedness and Export Mechanics.
        </div>
        <?php } ?>
        <br/>
        <?php foreach ( $collapsibleSectionNames as $sectionIndex => $collapsibleSectionName ) {  ?>
            <div id="<?php print cssFriendlyString($collapsibleSectionName); ?>" class="wizard-collapsible-section-container collapsed">
                <div class="wizard-collapsible-section-header">
                    <input type="button" class="wizard-collapsible-section-number-marker" value="<?php print $sectionIndex; ?>" />
                    <div class="wizard-collapsible-section-title">
                        <div class="wizard-collapsible-section-title-allllayouts">
                            <?php print $collapsibleSectionName; ?>
                        </div>
                    </div>
                    <img alt="" class="wizard-collapseexpand-arrow wizard-expand-arrow" src="/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
                    <img alt="" class="wizard-collapseexpand-arrow wizard-collapse-arrow" src="/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                </div>
                <div class="wizard-collapsible-section-contents" style="display: none;">

                    <?php /* START SECTION: Identifying Rules and Regulations */ ?>
                    <?php if ( $collapsibleSectionName === 'Identifying Rules and Regulations' ) { ?>
                        <?php include( overridable( 'sites/all/pages/rural-exporting/wizard-results-rules-regulations.php' ) ); ?>
                    <?php } ?>
                    <?php /* END SECTION: Identifying Rules and Regulations */ ?>

                    <?php /* START SECTION: Paths for Financial Assistance in Exporting */ ?>
                    <?php if ( $collapsibleSectionName === 'Paths for Financial Assistance in Exporting' ) { ?>
                        <?php include( overridable( 'sites/all/pages/rural-exporting/wizard-results-financial-assistance.php' ) ); ?>
                    <?php } ?>
                    <?php /* END SECTION: Paths for Financial Assistance in Exporting */ ?>

                    <?php /* START SECTION: Market Research */ ?>
                    <?php if ( $collapsibleSectionName === 'Market Research' ) { ?>
                        <?php include( overridable( 'sites/all/pages/rural-exporting/wizard-results-research-development.php' ) ); ?>
                    <?php } ?>
                    <?php /* END SECTION: Market Research */ ?>

                </div>
            </div>
        <?php } ?>
    </div>

    <div class="wizard-sidebars-container">
       <?php include(overridable('sites/all/pages/rural-exporting/sidebar-resource-center.php')); ?>
    </div>
</div>

<script>
    $(document).ready(function()
    {
        $(".btn-close").click(function(){

            $('#note-rural-exporting').hide();
        });



        jQuery('a').each( function () {
            var jqThis = jQuery(this);
            if (jqThis.attr('href') && typeof jqThis.attr('href') != "undefined"){
                if( jqThis.attr("href").indexOf(location.hostname)==-1 && (jqThis.attr('href').indexOf('http://') == 0||jqThis.attr('href').indexOf('https://') == 0) )
                {
                    var newHref = '/external-site?ccontent=' + jqThis.attr('href');
                    jqThis.attr('href', newHref);
                    jqThis.attr('target','_blank');
                }
            }
        });

    });
    /* Event handelers for expanding/collapsing sections in wizards-results for Start a Business Wizard */
    jQuery('.wizard-collapsible-section-header').bind('click', function() {
        var jqThis = jQuery(this);
        var jqSectionContainer = jQuery(this).parents('.wizard-collapsible-section-container');
        t = jqSectionContainer;

        if ( jqSectionContainer.hasClass('collapsed') ) {
            jqSectionContainer.find('.wizard-collapsible-section-contents').slideDown( function () {
                jqSectionContainer.removeClass('collapsed');
                jqSectionContainer.addClass('uncollapsed');
            });
        } else {
            jqSectionContainer.find('.wizard-collapsible-section-contents').slideUp( function () {
                jqSectionContainer.removeClass('uncollapsed');
                jqSectionContainer.addClass('collapsed');
            });
        }
    });

    function showEmailAddressFormForWizardResults() {
        jQuery.colorbox({
            'html': jQuery('.wizard-email-colorbox-container').html()
        });
    }
</script>



