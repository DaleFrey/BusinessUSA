<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
    <?php
    dsm( $node );

    ?>
    <?php if ( !empty($node->field_newslink['und'][0]['url']) ):
        drupal_goto($node->field_newslink['und'][0]['url']);
     endif; ?>

</div>
