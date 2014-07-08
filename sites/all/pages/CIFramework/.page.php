<?php
/*

    [--] PURPOSE [--]
    
    TODO
    
    [--] IMPLEMENTATION [--]
    
    TODO
    
    [!!] WARNING [!!]
    
    TODO

*/
    
    // Get a list of (the names of) all the FeedImporters that we are now allowing the editors to execute
    $editorExposedFeedImporters = variable_get('REI_contentintegrationframework_editorExposedFeedImporters', array());
    dsm($editorExposedFeedImporters);
    
    if ( !empty($_GET['cmd']) ) {
        $name = $_GET['name'];
        if ( $_GET['cmd'] === 'makeavailable' ) {
            drupal_set_message("The FeedImporter \"$name\" is now available to editors ", "status");
            $editorExposedFeedImporters[$name] = $name;
            dsm($editorExposedFeedImporters);
            variable_set('REI_contentintegrationframework_editorExposedFeedImporters', $editorExposedFeedImporters);
            drupal_goto('/content-integration-framework');
        }
        if ( $_GET['cmd'] === 'makenotavailable' ) {
            drupal_set_message("The FeedImporter \"$name\" is no longer available to editors ", "status");
            unset($editorExposedFeedImporters[$name]);
            variable_set('REI_contentintegrationframework_editorExposedFeedImporters', $editorExposedFeedImporters);
            drupal_goto('/content-integration-framework');
        }
    }
    
    function getAllFeedsImporters() {
        $ret = array();
        $importerRslts = db_query('SELECT * FROM feeds_importer');
        foreach ( $importerRslts as $importerRslt ) {
            $ret[] = unserialize( $importerRslt->config );
        }
        return $ret;
    }
    
?>

<!-- The following div is stored in content-integration-framework.page.php /* Coder Bookmark: CB-IG2SQIT-BC */ -->
<div class="contentintegfrmwrk-mastercontainer">

    <div class="not-logged-in-only">
        You must log in to use this functionality.
    </div>

    <div class="logged-in-only">

        <div class="contentintegfrmwrk-posttitle-textarea">
            Content Integration Framework is a tool to not only provide an inventory of available content on the partner site(s) like number of pages in the 
            partner site(s), number of events, social media information such as Twitter, Linked In, etc. but also provide an automated mechanism to consume the 
            data and integrate it into BusinessUSA<br/>
            <br/>
            This tool will preform the generic tasks like - Crawling the website, Pushing/Pulling the APIs to consume the data and run-cron jobs in regular
            intervals to be in synch with the particular site.
        </div>

        <div class="contentintegfrmwrk-title">
            Find out more about the partner site
        </div>

        <div class="contentintegfrmwrk-posttitle-textarea">
            <div class="contentintegfrmwrk-findoutmore-text">
                Enter the URL of the partner site to know more details:
            </div>
            <input type="textbox" class="contentintegfrmwrk-siteinput" value="http://"/>
            <input type="button" class="contentintegfrmwrk-submitbtn" value="Look Up" onclick="gotoCifBuildItPage();" />
            <script>
            
                jQuery(document).ready( function () {
                    jQuery('.contentintegfrmwrk-siteinput').bind('keydown', function (e) {
                        if ( e.which == 13 ) {
                            gotoCifBuildItPage();
                        }
                    });
                });
                
                function gotoCifBuildItPage() {
                    var newLocation = jQuery('.contentintegfrmwrk-siteinput').val();
                    newLocation = String(newLocation).replace('http://', '');
                    newLocation = '/CIFramework/site-analysis?site=' + newLocation;
                    document.location = newLocation;
                }
            </script>
        </div>

        <div class="contentintegfrmwrk-title">
            Import and Integrate the Data from the partner site(s)
        </div>

        <div class="contentintegfrmwrk-feeds-advertised">
            <table class="contentintegfrmwrk-feedstable" border="1" width="100%">
                <tr>
                    <td>Importer Name</td>
                    <td>Description</td>
                </tr>
                <tr class="is-allowed-to-editors-true">
                    <td>
                        <a target="_blank" href="/import/exim_upcoming_event" style="color: darkgray;">
                            Exim Event Importer
                        </a>
                    </td>
                    <td style="color: darkgray;">
                        Exim upcoming events importer
                    </td>
                </tr>
                <tr class="is-allowed-to-editors-true">
                    <td>
                        <a target="_blank" href="/import/exim_program_importer" style="color: darkgray;">
                            Exim Program
                        </a>
                    </td>
                    <td style="color: darkgray;">
                        Exim program importer
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="contentintegfrmwrk-feeds-all" style="display: none;">
            <table class="contentintegfrmwrk-feedstable" border="1" width="100%">
                <tr>
                    <td>Importer Name</td>
                    <td>Description</td>
                    <td class="admin-only">Options</td>
                </tr>
                <?php foreach ( getAllFeedsImporters() as $feedImporterConfig ) { ?>
                    <?php $thisFeedIsExposedToEditors = in_array($feedImporterConfig['name'], $editorExposedFeedImporters) ?>
                    <tr class="is-allowed-to-editors-<?php print ( $thisFeedIsExposedToEditors ? 'true' : 'false' ); ?>">
                        <td>
                            <a href="/import/<?php print $feedImporterConfig['name']; ?>">
                                <?php print $feedImporterConfig['name']; ?>
                            </a>
                        </td>
                        <td>
                            <?php print $feedImporterConfig['description']; ?>
                        </td>
                        <td class="admin-only" nowrap>
                            <?php if ( $thisFeedIsExposedToEditors ) { ?>
                                [<a href="?cmd=makenotavailable&name=<?php print rawurlencode($feedImporterConfig['name']); ?>">Make this feed NOT available to editors</a>] 
                            <?php } else { ?>
                                [<a href="?cmd=makeavailable&name=<?php print rawurlencode($feedImporterConfig['name']); ?>">Make this feed available to editors</a>] 
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        
        <div class="contentintegfrmwrk-showallfeeds-container admin-only">
            <a href="javascript: jQuery('.contentintegfrmwrk-feeds-advertised').hide(); jQuery('.contentintegfrmwrk-feeds-all').fadeIn(); jQuery('.contentintegfrmwrk-showallfeeds-container a').show(); jQuery('.contentintegfrmwrk-showallfeeds-linkall').hide();" class="contentintegfrmwrk-showallfeeds-linkall">
                Show all import feeders
            </a>
            <a href="javascript: jQuery('.contentintegfrmwrk-feeds-all').hide(); jQuery('.contentintegfrmwrk-feeds-advertised').fadeIn(); jQuery('.contentintegfrmwrk-showallfeeds-container a').show(); jQuery('.contentintegfrmwrk-showallfeeds-linkselect').hide();" style="display: none;" class="contentintegfrmwrk-showallfeeds-linkselect">
                Show import feeders visible to editors
            </a>
        </div>

    </div>
</div>