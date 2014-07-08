<?php ob_start(); ?>

<?php

    print theme(
            'yawizard_from_excel', 
            array(
                'path' => overridable('sites/all/pages/begin-exporting/wizard-questions.xls'),
                'resultsURL' => '/begin-exporting/wizard-results'
            )
    );
    
?>

<!-- The following style tag is stored in <?php print __FILE__; ?> -->
<style rendersource="<?php print basename(__FILE__); ?>">
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-comitted_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-travel_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-intmarket_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-website_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-protectip_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-export_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-marketdemand_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-capacityexp_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-shipping_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-exportfin_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-expcontrols_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-foreignlegal_no,
    .wizard.wizard-uniqueid-beginexporting .question-container.wiztag-international_no {
        display: none !important;
    }
</style>

<?php
    if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
        global $overrideBodyMarkup;
        $overrideBodyMarkup = ob_get_contents();
        ob_end_clean();
    } else {
        ob_end_flush();
    }
?>