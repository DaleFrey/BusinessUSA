<?php ob_start(); ?>

<?php
    print theme(
            'yawizard_from_excel', 
            array(
                'path' => overridable('sites/all/pages/taxes-and-credits/wizard-questions.xls'),
                'resultsURL' => '/taxes-and-credits/wizard-results'
            )
    );
?>

<?php
    if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
        global $overrideBodyMarkup;
        $overrideBodyMarkup = ob_get_contents();
        ob_end_clean();
    } else {
        ob_end_flush();
    }
?>