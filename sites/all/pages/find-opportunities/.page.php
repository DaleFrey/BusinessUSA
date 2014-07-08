<?php ob_start(); ?>

<?php
    print theme(
            'yawizard_from_excel', 
            array(
                'path' => overridable('sites/all/pages/find-opportunities/wizard-questions.xls'),
                'resultsURL' => '/find-opportunities/wizard-results'
            )
    );
?>

<style>
    .wizard-result-section.wizard-result-section-fbo12 {
        display: none;
    }
    .wizard-result-section.wizard-result-section-fbo {
        padding-bottom: 35px;
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

<script>

    jQuery(document).ready( function () {

        // When the textbox under "which industry are you interested in.." gain focus, make the "Software Technology" text dissappear.
        jQuery('.wizard-container.wizard-uniqueid-findopportunities input.wiztag-whichindustriesareyouinterestedineghealthcareagricultureetc ').bind('focus', function () {
            /* Coder Bookmark: CB-4TBNE77-BC */
            var jqThis = jQuery(this);
            if ( jqThis.val() == 'Software Technology' ) {
                jqThis.val('');
                jqThis.css('color', 'black')
            }
        });

        // When the textbox under "Please enter the location" losses focus, make the "Software Technology" text reappear when nessesary.
        jQuery('.wizard-container.wizard-uniqueid-findopportunities input.wiztag-whichindustriesareyouinterestedineghealthcareagricultureetc').bind('blur', function () {
            /* Coder Bookmark: CB-WG20JJA-BC  */
            var jqThis = jQuery(this);
            if ( jQuery.trim(jqThis.val()) == '' ) {
                jqThis.val('Software Technology')
                jqThis.css('color', '#696969')
            }
        });

    });

</script>