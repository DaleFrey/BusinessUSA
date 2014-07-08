<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">

  <?php print render($title_prefix); ?>

  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php print $user_picture; ?>

  <?php if ($display_submitted): ?>
    <span class="submitted"><?php print $date; ?> — <?php print $name; ?></span>
  <?php endif; ?>

    <?php
        $imgUrlPath = false;
        $fid = db_query("SELECT field_ss_photo_fid FROM field_data_field_ss_photo where entity_id=" . $node->nid)->fetchField();
        if ( $fid !== false ) {
            $fileDrupalPath = db_query("SELECT filename FROM file_managed where fid=" . $fid)->fetchField();
            if ( $fileDrupalPath !== false ) {
                $imgUrlPath = '/sites/default/files/' . $fileDrupalPath;
            }
        }
    ?>
    <?php if ( $imgUrlPath !== false ): ?>
        <div class="field field-name-field-ss-photo field-type-image field-label-hidden">
            <div class="field-items">
                <div class="field-item even">
                    <img typeof="foaf:Image" src="<?php print $imgUrlPath; ?>" style="max-width: 50%;" />
                </div>
            </div>
        </div>
    <?php endif; ?>
  
  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    print render($content);
  ?>

  <?php if (!empty($content['links']['terms'])): ?>
    <?php print render($content['links']['terms']); ?>
  <?php endif;?>

  <?php if (!empty($content['links'])): ?>
    <?php print render($content['links']); ?>
  <?php endif; ?>

</div> <!-- /node-->

<?php print render($content['comments']); ?>
