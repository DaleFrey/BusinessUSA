<?php
    
    if ( !empty($_GET['view']) ) {
        @ob_end_clean();
        while (@ob_end_clean());
        header('Content-type: text');
        print file_get_contents( $_GET['view'] );
        exit();
    }
    
    $exportCachePath = false;
    if ( !empty($_GET['exportCachePath']) ) {
        $exportCachePath = $_GET['exportCachePath'];
    }
    if ( !empty($_POST['exportCachePath']) ) {
        $exportCachePath = $_POST['exportCachePath'];
    }
    if ( $exportCachePath === false ) {
        print 'Error - you must specify a file-path to edit';
        return; // Cease rendering this file 
    }
    if ( !file_exists($exportCachePath) ) {
        print 'Error - The target filepath does not exist';
        return; // Cease rendering this file 
    }
    
    if ( !empty($_POST['newContent']) ) {
        $newContent = $_POST['newContent'];
    }
    
    if ( !empty($newContent) ) {
    
        // Backup/archive the target cache-file before writing to it
        mkdir($exportCachePath . '.archive');
        if ( !copy($exportCachePath, $exportCachePath . '.archive/' . 'retiered-on-' . date('Y-m-d_h.ia')) ) {
            
            print 'Error - The target filepath could not be archived';
            return; // Cease rendering this file 
            
        } else {
            
            $bytesWritten = file_put_contents($exportCachePath, $newContent);
            if ( $bytesWritten === false || $bytesWritten < 3 ) {
                print "Error - Failed to write the new content to $exportCachePath";
                return; // Cease rendering this file 
            } else {
                drupal_set_message("You changes have been saved to the export.gov cache-file on this server: $exportCachePath", 'status');
            }
            
        }
        
    }
    
?>

<style>
    textarea {
        width: 100%;
        min-height: 250px;
    }
    input {
        width: 100% !important;
    }
</style>

<div class="admin-only">

    <div>
        You are currently editing the filepath: <?php print $exportCachePath; ?>
    </div>
    <form method="post" action="">
        <textarea name="newContent" id="newContent"><?php print file_get_contents($exportCachePath); ?></textarea>
        <input type="hidden" name="exportCachePath" id="exportCachePath" value="<?php print $exportCachePath; ?>" />
        <input type="submit" value="Save" />
    </form>
    <br/>
    <br/>
    
    <?php if ( is_dir($exportCachePath . '.archive') ) { ?>
        Note, this cache-file has been edited before. The previous revisions of this file are:<br/>
        <?php foreach ( scandir($exportCachePath . '.archive') as $file ) { ?>
            <?php if ( strlen($file) > 2 ) { ?>
                <a target="_blank" href="?view=<?php print $exportCachePath . '.archive/' . $file; ?>"><?php print $file; ?></a><br/>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    
</div>