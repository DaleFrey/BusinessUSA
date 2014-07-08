<?php

    @ob_end_clean();
    @ob_end_clean();
    @ob_end_clean();

    passthru("mysqldump -ubizusa -pbizusa bizusa_drupal `echo block_node_type ; echo search_node_links ; echo node_type ; echo field_group ; echo field_config ; echo field_config_instance ; echo show tables | mysql -ubizusa -pbizusa bizusa_drupal | egrep -v 'field|Tables_in_bizusa_drupal|cache|node|watchdog|zipcodes'`");
    exit();
    
?>