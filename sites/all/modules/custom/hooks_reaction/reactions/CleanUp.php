<?php

/**
 * Implements hook_cron().
 * Hook to periodically trigger cleanup function(s)
 */
hooks_reaction_add("cron",
	function () {
        cleanup();
    }
);

/**
 * void cleanup()
 * Triggers functions to be fired on "clean up" cycle.
 */
function cleanup() {
    
    error_log("Cleanup cycle has startted (CleanUp.php)");
    cleanup_ExcelExportDir();
    cleanup_DeleteDuplicateEvents();
    cleanup_UnpublishPastEvents();
}


/**
 * void cleanup_UnpublishPastEvents()
 * 
 * Events which have ending dates that have pased shall be unpublished.
 */
function cleanup_UnpublishPastEvents() {

    $toReturn = array();
    error_log(basename(__FILE__) . '::' . __FUNCTION__ . ' has startted.');

    // Find nodes in the database which are Events, Published, and with a past ending date
    $results = db_query("
        SELECT nid, field_event_date_value2
        FROM node n 
        LEFT JOIN field_data_field_event_date ed ON (ed.entity_id = n.nid)
        WHERE 
            n.type='event' 
            AND n.status=1
            AND ed.field_event_date_value2 IS NOT NULL 
            AND DateDiff(ed.field_event_date_value2, NOW()) < 0
    ");
    
    // Unpublish these Events
    foreach ($results as $result) {
        if ( intval($result->nid) > 0 ) {
            set_time_limit(900); // Keep resetting the PHP's-death-timer so this script dosnt time out
            db_query("UPDATE node n SET n.status=0 WHERE n.nid=" . intval($result->nid));
            $toReturn[] = $result->nid;
            apachesolr_mark_node($result->nid); // Mark this node as needing to be indexed into Solr
        }
    }
    
    // Return the array of Node-IDs updated
    error_log(basename(__FILE__) . '::' . __FUNCTION__ . ' has finnished, ' . count($toReturn) . ' event nodes have been unpublished.');
    return $toReturn;
    
}

/**
 * void cleanup_ExcelExportDir()
 * Deletes old and uneeded files: sites/default/files/wizard-excel-exports/*.xls
 */
function cleanup_ExcelExportDir() {

    if ( is_dir('sites/default/files/wizard-excel-exports') ) {
    
        // Get a list of all files in this directory
        $files = scandir('sites/default/files/wizard-excel-exports');
        
        foreach ( $files as $file ) {
            if ( strpos($file, 'BusinessUSA-Wizard-Results-') === 0 ) {
            
                // Get the [unix] timestamp from the filename
                $timeStamp = str_replace('BusinessUSA-Wizard-Results-', '', $file);
                $timeStamp = str_replace('.xls', '', $timeStamp);
                $timeStamp = intval($timeStamp);
                
                // If the file (unix timestamp) is more than 12 hours old, delete the file
                $secondsIn12Hours = 43200;
                if ( $timeStamp + $secondsIn12Hours < time() ) {
                    unlink('sites/default/files/wizard-excel-exports/' . $file);
                    error_log("CleanUp.php::cleanup_ExcelExportDir() - Deleted {$file}");
                } else {
                    error_log("CleanUp.php::cleanup_ExcelExportDir() - Did not delete {$file}");
                }
            }
        }
        
    }
    
}

/**
 * array cleanup_DeleteDuplicateEvents()
 * Deletes duplicate Events - Detects duplicate events based on looking to a duplicate-combination of 
 * NodeTitle+EventStartDate+EventEndDate
 *
 * Returns an array of node IDs in which were delete.
 */
function cleanup_DeleteDuplicateEvents($printDebugReport = false) {
    
    $ret = array();
    
    $query= "
        SELECT 
            n1.title as 'Title', 
            field_event_date_value as 'StartDate', 
            field_event_date_value2 as 'EndDate',
            count(n1.title) as 'Count',
            GROUP_CONCAT(n1.nid) as 'nodeIds'
        FROM  node n1
        LEFT JOIN field_data_field_event_date d1 ON d1.entity_id = n1.nid
        WHERE n1.type='event' AND n1.status=1
        GROUP BY n1.title, field_event_date_value, field_event_date_value2
        HAVING count(n1.title) > 1
    ";
    
    $results = db_query($query);
    foreach ( $results as $result ) {
        $duplicateNids = explode(',', $result->nodeIds);
        foreach ( $duplicateNids as $index => $dupNodeId ) {
            if ( $index === 0 ) {
                // This is the first Event-Node of its kind, dont delete this one
                $firstEventOfItsKind = $dupNodeId;
            } else {
                // This is not the first Event-Node of its kind, delete this one
                $ret[] = $dupNodeId;
                node_delete($dupNodeId);
                $msg = __FILE__ . '::' . __FUNCTION__ . " - Deleted Event node {$dupNodeId} because it is a duplicate of node {$firstEventOfItsKind}. StartDate={$result->StartDate},EndDate={$result->EndDate},Title={$result->Title}";
                error_log($msg);
                if ( $printDebugReport ) {
                    drupal_set_message($msg, 'warning');
                }
            }
        }
    }
    
    return $ret;
}