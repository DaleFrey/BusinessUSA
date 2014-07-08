<?php
/*
    [--] PURPOSE [--]
    
    This is the template that will be used when viewing the 'Site Analysis' in the 'Content Integration Framework' implementation.
    
    [--] IMPLEMENTATION [--]
    
    This template does NOT expect any variables to be pre-defined before the execution/rendering of this script except for $_GET['site']
    All the (non-standard Drupal) functions used in this template are stored in ContentIntegrationFramework.tpl.php
    
*/

    if ( empty($_GET['site']) ) {
        $msg = 'Error - no site parameter given in URL query';
        print $msg;
        return $msg; // Stop rendering and execution of this script 
    }

    $analysisDatas = call_user_func_cache(604800, 'buildWithApiCall', $_GET['site']); // Note: call_user_func_cache() is defined in FunctionResultCachingSupport.php, buildWithApiCall() is defined in ContentIntegrationFramework.php
    
    if ( !is_array($analysisDatas) ) {
        $msg = 'Error - buildWithApiCall() did not return an array. The return statement was: <br/>';
        print $msg;
        var_dump($analysisDatas);
        return $msg; // Stop rendering and execution of this script 
    }
?>

<!-- The following div is stored in site-analysis.tpl.php /* Coder Bookmark: CB-7O3NUNM-BC */ -->
<div class="cifsiteanalysis-mastercontainer">

    <script>
        var titleText = jQuery('#page-title').text();
        titleText = titleText + ' - <?php print $_GET['site'] ?>';
        jQuery('#page-title').text(titleText);
    </script>

    <!-- We are hard-coding the SiteMap section in from site-analysis-sitemap.php, the other sections are generated from site-analysis.tpl.php based on data returned from ContentIntegrationFramework.php::buildWithApiCall() -->
    <?php include('sites/all/pages/CIFramework/site-analysis-sitemap.php') ?>

    <!-- We are hard-coding the Social Media section in from site-analysis-socialmedia.tpl.php, the other sections are generated from site-analysis.tpl.php based on data returned from ContentIntegrationFramework.php::buildWithApiCall() -->
    <?php include('sites/all/pages/CIFramework/site-analysis-socialmedia.page.php') ?>

    <?php foreach ( $analysisDatas as $secTagName => $analysisData ) { ?>
        <div class="cifsiteanalysis-section-container cifsiteanalysis-section-container-<?php print str_replace(' ', '_', strtolower($secTagName)); ?>">
            
            <!-- Section Title /* Coder Bookmark: CB-UNMBT5W-BC */ -->
            <div class="cifsiteanalysis-section-title cifsiteanalysis-section-title-<?php print str_replace(' ', '_', strtolower($secTagName)); ?>">
                <?php print ucwords( str_replace('_', '', $secTagName) ); ?>
            </div>
            
            <?php foreach ( $analysisData as $sseIndex => $sectSubElement ) { ?>
                <div class="cifsiteanalysis-subsection-container cifsiteanalysis-subsection-container-<?php print $sseIndex; ?>">
                    
                    <div class="cifsiteanalysis-subsection-title cifsiteanalysis-subsection-title-<?php print $sseIndex; ?>">
                        <a href="<?php print $sectSubElement['Link']; ?>">
                            <?php print $sectSubElement['Name']; ?>
                        </a>
                    </div>
                    
                    <div class="cifsiteanalysis-subsection-description cifsiteanalysis-subsection-description-<?php print $sseIndex; ?>">
                        <?php print $sectSubElement['Description']; ?>
                    </div>
                    
                    <?php if ( $sectSubElement['FirstDetected'] != $sectSubElement['LastDetected'] ) { ?>
                        <div class="cifsiteanalysis-subsection-useddates cifsiteanalysis-subsection-useddates-<?php print $sseIndex; ?>">
                            Used from <?php print $sectSubElement['FirstDetected'] ?> to <?php print $sectSubElement['LastDetected'] ?>
                        </div>
                    <?php } ?>
                    
                </div>
            <?php } ?>
            
        </div>
    <?php } ?>
</div>