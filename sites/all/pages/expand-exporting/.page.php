<?php

    $wizardHTML = theme(
            'yawizard_from_excel', 
            array(
                'path' => overridable('sites/all/pages/expand-exporting/wizard-questions.xls'),
                'resultsURL' => '/expand-exporting/wizard-results'
            )
    );
    
    ob_start();
?>

<script>
    jQuery(document).ready( function () {
        
        // This option shall be selected by default
        jQuery('input#wiztag-not_sure').click();
        jQuery('input#wiztag-not_sure').parent().find('a').addClass('checked');
        
        // This option shall be selected by default
        jQuery('input#wiztag-personalized_assistance').click();
        jQuery('input#wiztag-personalized_assistance').parent().find('a').addClass('checked');
        
        // This label needs to show directly after the "Financial help to start an export business" radio-button
        jQuery('.question-container.wiztag-label78').insertAfter( jQuery('#wiztag-financial_help_export_business').parents('.wizard-inputlabel-container') ).next().css('clear', 'both');
        
    });
</script>

<?php

    $wizardHTML .= ob_get_contents();
    ob_end_clean();
    
    // Based on the mode, determine what to do with the wizard HTML
    if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
        global $overrideBodyMarkup;
        $overrideBodyMarkup = $wizardHTML;
    } else {
        print $wizardHTML;
    }
?>