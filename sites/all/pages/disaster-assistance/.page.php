<?php ob_start(); ?>

<?php

    print theme(
            'yawizard_from_excel', 
            array(
                'path' => overridable('sites/all/pages/disaster-assistance/wizard-questions.xls'),
                'resultsURL' => '/disaster-assistance/wizard-results/'
            )
    );


?>

<!-- The following script tag is stored in <?php print __FILE__; ?> -->
<script rendersource="<?php print basename(__FILE__); ?>">
    // Making the "Seek Disaster Recovery Information" the default value for this wziard
    jQuery(document).ready( function(){
        // Set the check value in the actual input-checkbox
        jQuery('#wiztag-disaster_recovery').get(0).checked = true; 
        // Force-update the anchor inserted by the PrettyCheckable lib
        jQuery('#wiztag-disaster_recovery').parent().find('a').addClass('checked');
    });
</script>
    
<?php
    if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
        global $overrideBodyMarkup;
        $overrideBodyMarkup = ob_get_contents();
        ob_end_clean();
    } else {
        ob_end_flush();
    }
?>