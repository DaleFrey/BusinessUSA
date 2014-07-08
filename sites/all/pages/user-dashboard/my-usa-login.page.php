<?php
    // This variable is defined in MyUSA-Settings.php
    $beginAuthURL = $GLOBALS['myusa_settings']['beginAuthURL']; 
    
    drupal_goto( $beginAuthURL ); 
?>
<script>
    document.location = '<?php print $beginAuthURL; ?>';
</script>