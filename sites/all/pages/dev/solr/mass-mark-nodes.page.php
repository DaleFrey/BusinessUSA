<?php
    
    /* START: Ensure the user is signed in as an admin */
    global $user;
    if ( empty($user) ) {
        print "<b>You must be signed in as an administrator in order to run this functionality</b>";
        return;
    } else {
        $arrUser = (array) $user;
        if ( empty($arrUser['name']) || $arrUser['name'] !== 'reisysbizuser' ) {
            print "<b>You must be signed in as an administrator in order to run this functionality</b>";
            return;
        }
    }
    /* END: Ensure the user is signed in as an admin */
    
    if ( !empty($_GET['ctype']) && !empty($_GET['limit']) ) {
        
        $ctype = $_GET['ctype'];
        $limit = intval($_GET['limit']);
        if ( $limit < 1 ) {
            $limit = 25;
        }
        
        $nodesMarked = array();
        $results = db_query("
            SELECT
                nid AS 'nid', 
                title AS 'title'
            FROM node 
            WHERE 
                type='{$ctype}' 
                AND status > 0
            LIMIT {$limit}
        ");
        foreach ( $results as $record ) {
            $nid = $record->nid;
            apachesolr_mark_node($nid);
            $nodesMarked[$nid] = $record->title;
        }
        
        print "The following nodes have been marked for re-indexing into the Solr search-index (shown by NodeID => Title):<br/>";
        kprint_r($nodesMarked);
        print '
            <br/>Note that these nores are <b>only marked</b> for re-indexing. 
            To re-index them now, run the <i>Index all queued content</i> task from the 
            <a target="_blank" href="/admin/config/search/apachesolr">Apache Solr search [index]</a> page.<br/>
            <br/>
            <hr/>
        ';
    }
    
?>
<form method="GET" action="<?php print request_uri(); ?>">
    This is a tool that is used to mark [all] nodes under a selected content-type to be reindexed into Solr.<br/>
    <br/>
    Mark nodes under this content-type for indexing into Solr:<br/>
    <select name="ctype">
        <?php 
            $cTypes = (array) node_type_get_types();
            ksort($cTypes);
            foreach ( $cTypes as $typeMacName => $typeInfo ) {
                print "<option>$typeMacName</option>";
            }
        ?>
    </select>
    <br/>
    <br/>
    Only mark up to # nodes:<br/>
    <input type="text" name="limit" id="limit" value="25" />

    <input type="submit" value="Mark Nodes" />
</form>
