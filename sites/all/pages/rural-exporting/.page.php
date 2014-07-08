<?php ob_start(); /* Start capturing the splashextension div into an output buffer */ ?>
    <div class="splashextension">
        <div class="splashextension-section">
            <h2>
                Announcements & Resources
            </h2>
            <div class="splashextension-sectionbody">
                <ul class="splashextension-featinfo-list splashextension-featinfo-visiblelist">
                    <?php print views_embed_view('fact_sheets_and_announcements', 'default'); ?>
                </ul>
            </div>
        </div>

        <div class="splashextension-section">
            <h2>
                UPCOMING EVENTS
            </h2>
            <div class="splashextension-sectionbody">
                <ul>
                    <?php print views_embed_view('exporting_events', 'block_2'); ?>
                </ul>
            </div>
        </div>

        <div class="splashextension-section lastsection">
            <h2>
                LATEST NEWS FOR RURAL EXPORTERS
            </h2>
            <div class="splashextension-sectionbody">
                <ul>
                    <li>
                        <a href="/subscribe?subscribeEmail=Receive+email+updates" target="_blank">Subscribe to BusinessUSA Newsletters</a>
                    </li>
                    <?php print views_embed_view('rural_export_initiatives_news', 'default'); ?>
                </ul>
            </div>
        </div>

        <div class="splashextension-sectionfooter">
            <h2>Partner Organizations</h2>
            <div>
                <a href="http://www.whitehouse.gov/" title="White House" target="_blank"><img src="/sites/all/themes/bizusa/images/wizard-images/rural/whitehouse.png"></a>
                <a href="http://www.commerce.gov/" title="United States Department of Commerce" target="_blank"><img src="/sites/all/themes/bizusa/images/wizard-images/rural/doc.png"></a>
                <a href="http://www.usda.gov/" title="United States Department of Agriculture" target="_blank"><img src="/sites/all/themes/bizusa/images/wizard-images/rural/usda.png"></a>
                <a href="http://www.sba.gov/" title="The U.S. Small Business Administration" target="_blank"><img src="/sites/all/themes/bizusa/images/wizard-images/rural/sba.png"></a>
                <a href="http://www.exim.gov/" title="Export-Import Bank of the United States" target="_blank"><img src="/sites/all/themes/bizusa/images/wizard-images/rural/export_import_bank.png"></a>
                <a href="http://www.ustr.gov/" title="Office of the United States Trade Representative" target="_blank"><img src="/sites/all/themes/bizusa/images/wizard-images/rural/ustr.png"></a>
            </div>
        </div>

        <div class="splashextension-extra">
            To locate closest resource centers <a href="/request-appointment-and-closest-resource-centers">please click here</a>
        </div>


    </div>
<?php
// Place the captured splashextension div into $splashExtensionHTML
$splashExtensionHTML = ob_get_contents();
ob_end_clean();
?>

<?php

$wizardQuestions = ya_wizard_WizardFromExcel(overridable('sites/all/pages/rural-exporting/wizard-questions.xls'));
dsm($wizardQuestions);

// The last slide of this wizard shall load its content from an [AJAX] path
$lastSlideId = count( $wizardQuestions['slides'] ) - 1;
$wizardQuestions['slides'][$lastSlideId]['ajaxLoad'] = '/rural-exporting/wizard-results';

// Inject the splashextension div into the end of the first (splash) slide of this wizard
$wizardQuestions['slides'][0]['questions'][] = array(
    'widgetType' => 'html',
    'label' => '',
    'wizardTag' => 'custom-html',
    'options' => $splashExtensionHTML,
    'containerClass' => '',
    'inputClass' => '',
    'inputAttrs ' => '',
    'dependencyLogic' => array(),
);

$wizardHTML = theme('yawizard', $wizardQuestions);

// Based on the mode, determine what to do with the wizard HTML
if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
    global $overrideBodyMarkup; // This is a special variable used by html.tpl.php
    $overrideBodyMarkup = $wizardHTML;
} else {
    print $wizardHTML;
}

?>

<script>
    $(document).ready(function(){
        if ( jQuery(window).width() < 768 && document.location.hash.indexOf('wizard-step-id-') == -1) {
            $('div.mobile-slide-seeker').hide();
        }

        var news = $('div.view-rural-export-initiatives-news span.field-content a');
        news.each(function(){
            $(this).attr('target', '_blank');
        });

        var resources = $('div.view-fact-sheets-and-announcements span.field-content a');
        resources.each(function(){
            $(this).attr('target', '_blank');
        });

    });

</script>
