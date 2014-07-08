<?php
    global $excelSavePath;
    $excelSavePath = 'sites/default/files/wizard-results-export/BusinessUSA - Wizard Results - ' . time() . '.xls';

    // Determin what state the user is in based on entered zip-code
    $locInfo = getLatLongFromZipCode($_POST['allTags']['enteredzip']);
    $stateTarg = $locInfo['state'];
    $countyTarg = getGeoCounty($locInfo['city'] . ', ' . $locInfo['state']);

    $collapsibleSectionNames = array(
        1 => 'Conduct Market Research',
        2 => 'Business Licenses and Permits',
        3 => 'Build Your Business Plan',
        4 => 'Articles Recommended for You',
        5 => 'Find Business Counselors That Work Within Your Area'
    );
?>

 <div class="share-export-email-container">
	<div class="exportexcelWidget">
		<a href="javascript:void(0)" id="expandexcel" onclick="expandexcel(this)" class="exportexcelWidget-toggler" title="Export Excel"></a>

		<div id="exportexcelWidget-popup">
			<div class="exportexcelWidget-popup-body">
				<a class="exportexcel-group exportexcel-download" href="<?php print $excelSavePath; ?>" value="Export To Excel" title = "Export to Excel">
					<div class="exportexcel-group-text">Download to computer</div>
				</a>
				<a href="javascript: showEmailAddressFormForWizardResults(); // DevNote: This function is defined directly after this input, in the <?php print basename(__FILE__); ?> file." value="EMail Results" title="Email Results" class="exportexcel-group exportexcel-email">
					<div class="exportexcel-group-text">Email excel file</div>
				</a>
			</div>
		</div>
	</div>
   <script>
     /* Override the default getShareURL() function, thus overriding the URL in which the Share-widget will assume */
     function getShareURL(callback) {

       if ( typeof haveWizardShareURL != 'undefined' ) {
         callback(haveWizardShareURL);
         return;
       }

       jQuery.colorbox({
         html: '<img style="height: 35px; float: left; padding-right: 15px" alt="" src="data:image/gif;base64,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" /><span style="line-height: 35px">Please wait as we generate a short-URL for this request...</span>',
         overlayClose: false,
         escKey: false,
         onLoad: function () {
           jQuery('#cboxClose').remove();
         }
       });

       phpFunction('createQuickLinkTarget', [yawizard.getShareLink()], function (hid) {
         jQuery.colorbox.close();
         haveWizardShareURL = 'http://business.usa.gov/goto-bookmark?hid=' + hid;
         callback(haveWizardShareURL);
       });

     }

   </script>

   <?php print theme('sharewidget', array()); //currently conflicts with splash share ?>

</div>

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
                <img src="data:image/gif;base64,R0lGODlhFAAQAOMAAKyurNza3MzOzLy6vPz6/LS2tOTm5NTW1LSytNTS1Ly+vPz+/Ozq7P///wAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQJCQANACwAAAAAFAAQAAAEbLDJSau9OOuqemhBpxCE+B0iMgxCk6wIqSpJI8CAwtqDEhO5Qe3mU+1eAwApOFwBgi3ij8krrlqJgkIJ1A0LAwTU1Zt6qwBj1EnS7qSAQQEL5gLA6wLgcAgYGgx8AQsEfAcMDQZ9BxuNjo8aEQAh+QQJCQAWACwAAAAAFAAQAIQMCgysrqzc2txERkTMzswcHhy8urz8+vwUEhS0trTk5uRsamzU1tQkJiS0srTU0tQkIiS8vrz8/vwUFhTs6uxsbmz///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFfSACQYtlnmhqFcNQqrDJunEMtaUQ7cexRwIL4zcrPQwGR89hiDwsBKTjRjtGlIdAxPCMXouWRyIS6Gm5UGSAapSat92mAywmv9GERJIdlt/jZHRjWGMGBGlXfGIGZVkJCV16AWAUDJYSB5YCFBYKApZ8NSpgoikACAgvpSchACH5BAkJABwALAAAAAAUABAAhAwKDIyKjMzOzERGROzq7KyurERCRGxqbCQiJOTm5NTW1Pz6/Ly6vBQSFJSSlFxaXHx6fIyOjNTS1ExOTOzu7LSytGxubCQmJNza3Pz+/Ly+vBQWFP///wAAAAAAAAAAAAWMoBM5GgchV0NxbOtOxxGYxoCsbj5ZVkQPF1yutbPMILXbQsPEcBRMTfGYpCwqDI2EI2AwKtOfEsvYdjVgng8JtBY0Za63EGaPswI5ul5dvONdDHQ8VDZWFXB5Z2kWDj9BfnBmc3yGfl6KWINGYhQZCqAEHAkYChiVN0MuAw8PhUGqLRKzCSYNDQBCqiEAIfkECQkAIgAsAAAAABQAEACFDAoMlJKUzMrMREZErK6s5ObkZGZkREJEvL68JCIkpKKk1NbUVFJUtLa09PL0fHp8FBIU1NLUbG5srKqslJaUzM7MTEpMtLK07O7sbGpsxMbEJCYkpKak3N7cXFpcvLq8/Pr8FBYU////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABp9AkVCoCRgdGMgm8RgKOZyJRkQxZBgYR2JwaDoDE86HmpEwkBuudxiAjillLGbbFS0QeLCYbEarRRUfHxdtEw18Z3N/AgiDFGFvcX51gQgEbXtwfYp1Ah8IhJCIk02BH5dRh5qJdKWfF4+ZkhhplJ+osputIgINDaG5ibVNBR0LCwEKCqqzu04aAhodVB4eFqRO2SIFERURIBgAEBBrQkEAIfkECQkAIAAsAAAAABQAEACFDAoMlJKUzMrMREZEtLK05ObkpKKkZGZkJCIk3N7c9Pb0nJqcVFJUFBIU1NLUvL68rKqsbG5s/P78lJaUzM7MTEpM9PL0pKakbGpsJCYk5OLk/Pr8nJ6cXFpcFBYUxMbE////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABpxAkHBI3ASOHxAGkWkQQZQLxKCwVA6HCSgyGCCeD+lEoWBEIlpMFyGFCEDhy6JqRivXHALhAYdcAhsWZhhpeAQQfGEQY4IRhHdeeXt9FxOBg4WREJOKAXSOmQiSiVOWjY9qkYeJYp+ohpx+ppiQCAtSiQYQnqehAhQCCZSzEQcLtWAGBrx1oU8aHwIfEhYDHR3OT0UUFA4FSg0NAEEAIfkECQkAGwAsAAAAABQAEACEREZEpKak1NbUjIqMvL68bGps9Pb0tLK0nJ6czMrMVFJUrK6s5OLklJKU/P781NLUTE5MrKqsxMLEbG5s/Pr8vLq8pKKkzM7MXFpc5ObklJaU////AAAAAAAAAAAAAAAABY7gJo5kuRFNM5gkFbzXNhQFxI6GFgWEPE0QglCweUR2FEojEOkNfopDpRKTLBYWQy5icUIXBOrGekBQtjzfJDqtLspnXfpZUIDFZLNhOYdK8W96cl5rd25wezuEbICIOl0+dQtTCWNHCAZKTIsCnRkbDAmicVyLNyJKCJBPa6cbFKIJDDIYGACuJhkXDw8hACH5BAkJABkALAAAAAAUABAAhJSSlMzKzKyurOTm5Nza3Ly+vKSipPT29NTS1LS2tJyenOTi5MTGxKyqrPz+/JSWlMzOzLSytOzq7Nze3MTCxKSmpPz6/NTW1Ly6vP///wAAAAAAAAAAAAAAAAAAAAAAAAWNYCaOZGmeKNNUFYomVQMUNJERdGFZcQNlGNYjgsH8EMXIwaKICBiZxAogKBgzEEwhYjk0n9HVsHgsCroGQYQSjVGtv+x2+YUGZcQrIrHt1sMVb3paZwdpa214ZFhaXF5OdkICGAlHCRiFCg0NbFIyFxcEAxkSoAQWDgGqC22BLicJBgYAryYTAQwBtS4hACH5BAkJABIALAAAAAAUABAAhJyanMzOzLS2tOzq7Nze3KyqrNTW1MzKzLy+vPz6/LSytJyenNTS1Ly6vOTm5KyurNza3Pz+/P///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAV6oCSOZGmeaKqWSAtJUIskifweRa40TSAxPAVth2BIEA/F4oHoSQINhDDBbBilj8XOCWw8aNVrctn0QaXg5lWh3PoYAmTaehxX39Fp+KjIup88XwlxTlJKDw0CbwJeYIw+CDkABgYQDhIDlBARCZQGAxIEB6MrpaanKiEAOw==">
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

<?php if ( $locInfo === false || $locInfo === array(false, false) ) { ?>
    <script>
        alert('We are sorry, the ZIP code you have entered in is not a valid code we could find in our database');
        jQuery('.wiztag-US_HQ input').attr('checked', 'checked');
        jQuery('.wiztag-US_HQ input').get(0).checked = true;
        jQuery('.wiztag-US_HQ label').siblings().addClass('checked');
        yawizard.seek(2);
    </script>
<?php } ?>

<div class="startbiz-result-global-message">
    <p>Below, five different sections are presented to introduce you to the mechanics and planning to launch a business:
        <a onclick="startABusiness_EnsureOpen('conductmarketresearch');" href="#marketResearch">Conduct Market Research</a>,
        <a onclick="startABusiness_EnsureOpen('businesslicensesandpermits');" href="#businessLicense">Business Licenses and Permits</a>,
        <a onclick="startABusiness_EnsureOpen('buildyourbusinessplan');" href="#buildBusiness">Build Your Business Plan</a>,
        <a onclick="startABusiness_EnsureOpen('articlesrecommendedforyou');" href="#articlesRecommended">Articles Recommended for You</a> and
        <a onclick="startABusiness_EnsureOpen('findbusinesscounselorsthatworkwithinyourarea');" href="#findBusiness">Find Business Counselors That Work Within Your Area</a>.
        Follow the steps below to take advantage of these resources.
        <a href="javascript: jQuery('.startabiz-resultsmsg-more-trigger').hide(); jQuery('.startabiz-resultsmsg-more-content').fadeIn(); void(0);" class="startabiz-resultsmsg-more-trigger">Read More</a>
    </p>
    <span class="startabiz-resultsmsg-more-content" style="display: none;">
       <p>First, the Business Licenses and Permits are itemized per your business area interests and zip code The list is currently still being developed and still updated. </p>
       <p>Second, Build Your Business Plan guides you to develop a business plan around your concept in its early stages. At SBA.gov, the Business Plan Tool has a comprehensive way to save your progress online. </p>
       <p>Third, Articles Recommended for You provides a list of articles based on your business area interests for further reading and research. </p>
       <p>
            Finally, a list of resource centers are provided, where you can take your business plan and initial thinking to a business counselor for further guidance. <br>
            <a href="javascript: jQuery('.startabiz-resultsmsg-more-content').fadeOut( function () { jQuery('.startabiz-resultsmsg-more-trigger').show(); } ); void(0);" class="startabiz-resultsmsg-less-trigger"><br/>Read Less</a>
       </p>
   </span>
</div>
<script>
    function startABusiness_EnsureOpen(sectionId) {
        if ( jQuery('#' + sectionId).hasClass('collapsed') ) {
            jQuery('#' + sectionId + ' .wizard-collapsible-section-header').click();
        }
    }
</script>

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

            <?php /* START SECTION: CONDUCT MARKET RESEARCH */ ?>
            <?php if ( $collapsibleSectionName === 'Conduct Market Research' ) { ?>
                <a name="marketResearch" />
                <?php include( overridable( 'sites/all/pages/start-a-business/wizard-results-conduct-market-research.php' ) ); ?>
            <?php } ?>
            <?php /* END SECTION: CONDUCT MARKET RESEARCH */ ?>

            <?php /* START SECTION: BUSINESS LICENSES AND PERMITS */ ?>
            <?php if ( $collapsibleSectionName === 'Business Licenses and Permits' ) { ?>
                <a name="businessLicense" />
                <?php include( overridable( 'sites/all/pages/start-a-business/wizard-results-business-licenses-and-permits.page.php' ) ); ?>
            <?php } ?>
            <?php /* END SECTION: BUSINESS LICENSES AND PERMITS */ ?>

            <?php /* START SECTION: BUILD YOUR BUSINESS PLAN */ ?>
            <?php if ( $collapsibleSectionName === 'Build Your Business Plan' ) { ?>
                <a name="buildBusiness" />
                <?php include( overridable( 'sites/all/pages/start-a-business/wizard-results-build-your-business-plan.php' ) ); ?>
            <?php } ?>
            <?php /* END SECTION: BUILD YOUR BUSINESS PLAN */ ?>

            <?php /* START SECTION: ARTICLES RECOMMENDED FOR YOU */ ?>
            <?php if ( $collapsibleSectionName === 'Articles Recommended for You' ) { ?>
                <a name="articlesRecommended" />
                <?php include( overridable( 'sites/all/pages/start-a-business/wizard-results-articles-recommended-for-you.php' ) ); ?>
            <?php } ?>
            <?php /* END SECTION: ARTICLES RECOMMENDED FOR YOU */ ?>

            <?php /* START SECTION: FIND BUSINESS COUNSELORS THAT WORK WITHIN YOUR AREA */ ?>
            <?php if ( $collapsibleSectionName === 'Find Business Counselors That Work Within Your Area' ) { ?>
                <a name="findBusiness" />
                <?php include( overridable( 'sites/all/pages/start-a-business/wizard-results-find-business-counselors.php' ) ); ?>
            <?php } ?>
            <?php /* END SECTION: FIND BUSINESS COUNSELORS THAT WORK WITHIN YOUR AREA */ ?>

        </div>
    </div>
<?php } ?>

<?php include('sites/all/pages/start-a-business/wizard-results-template-excel-startabusiness.php'); ?>

<!-- The following script it stored in <?php print basename(__FILE__); ?> -->
<script>
    $(document).ready(function(){
        if (($('#excel-email-load-toggle')).length > 0)
        {
            $('#excel-email-load-toggle').hide();
        }
    });


	//Export to Excel functionality
	function expandexcel(param)
        {
            $('#exportexcelWidget-popup').toggle();
			if(($('#exportexcelWidget-popup').is(":visible")) && ($('.sharewidget-popup').is(":visible")))
				{
					$('.sharewidget-popup').fadeOut();
				}
        }
		$(document).ready(function(){
            if (($('#exportexcelWidget-popup')).length > 0)
            {
                $('#exportexcelWidget-popup').hide();
            }

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

        // Stop the 'Build Your Business Plan' YouTube video from playing
        var iFrameHTML = jQuery('.build-business-plan-youtube').html();
        jQuery('.build-business-plan-youtube').html(iFrameHTML);

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

        PopulateArticles(jqThis);
        BindCollapsedButtonEvent(jqThis);
    });

    function PopulateArticles(object){
        var conductmarketresearch = $('div#conductmarketresearcharticles').find('div.start-a-business-article-result:lt(2)');
        conductmarketresearch.each(function(){
            $(this).attr('style', 'display:inline;');
        });

        var businesslicensesandpermits = $('div#businesslicensesandpermitsarticles').find('div.start-a-business-article-result:lt(2)');
        businesslicensesandpermits.each(function(){
            $(this).attr('style', 'display:inline;');
        });

        var articlesrecommendedforyoutoprated = $('div#articlesrecommendedforyoutopratedarticles').find('div.start-a-business-article-result:lt(2)');
        articlesrecommendedforyoutoprated.each(function(){
            $(this).attr('style', 'display:inline;');
        });

        var articlesrecommendedforyoubasedonanswers = $('div#articlesrecommendedforyoubasedonanswersarticles').find('div.start-a-business-article-result:lt(2)');
        articlesrecommendedforyoubasedonanswers.each(function(){
            $(this).attr('style', 'display:inline;');
        });

        var button = $('.btnviewallarticles');
        var viewallbutton = object.parents('.wizard-collapsible-section-container').find(button);

        viewallbutton.unbind('click');
        viewallbutton.bind('click', function(){
            var parentcontainer = $(this).parent();
            if ($(this).is('.collapsed')){
                var articles = $('div.start-a-business-article-result');
                var allArticles =  parentcontainer.find(articles);
                allArticles.each(function(){
                    $(this).attr('style', 'display:inline;');
                });
                $(this).attr('value', 'View Less');
                $(this).removeClass('collapsed');
                $(this).addClass('expanded');
            }
            else{
                var allArticles = parentcontainer.find('div.start-a-business-article-result:gt(1)');
                allArticles.each(function(){
                    $(this).attr('style', 'display:none;');
                });
                $(this).attr('value', 'View All');
                $(this).removeClass('expanded');
                $(this).addClass('collapsed');
            }
        });
    }

    function BindCollapsedButtonEvent(object){
        var button = $('.btn-back-to-top');
        var collapsedbutton = object.parents('.wizard-collapsible-section-container').find(button);
        collapsedbutton.unbind('click');
        collapsedbutton.bind('click', function(){
            var section = $(this).parent().parent().parent('.wizard-collapsible-section-container');
            section.find('.wizard-collapsible-section-contents').slideUp( function () {
                section.removeClass('uncollapsed');
                section.addClass('collapsed');
            });
        });
    }

    function showEmailAddressFormForWizardResults() {
        jQuery.colorbox({
            'html': jQuery('.wizard-email-colorbox-container').html()
        });
    }
</script>
