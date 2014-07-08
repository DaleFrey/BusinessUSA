<?php
/*

    [!!] PREREQUISITES [!!]
    
        This template files expects certain variables to be defined in scope in order to function correctly:
        
        $exportTitle - string, (optional), The title of this piece of content
        
        $exportCachePath - string, (optional), The file-path to the storage-file that contains the markup for the target page on export.gov
        
        $exportContentHTML - string, the HTML to use in the main content area in this template
        
        $category - string, (optional), The category in which this page is associated under in the Exporter-Dashboard [if applicable]
        
        $subcategory - string, (optional), The subcategory in which this page is associated under in the Exporter-Dashboard [if applicable]
        
        $exportSideBars - array, an array of blocks to display on the right side of this template. The
        keys in this array shall be the titles of the blocks, and the values (of this top level) array shall be 
        arrays of:
        Array(
            [title] => 'Anchor title goes here',
            [url] => 'http://your.target/url?address=goes#here'
            [warning] => true/false (optional boolean, when set, this template shall apply an html-"export-information-section-links-link-haserrro" class on the anchor, this can be themed to hilight issues on the site)
            [hilight] => true/false (optional boolean, when set, this template shall apply an html-"exportportal-hilight" class on the anchor, this can be themed to hilight issues on the site)
        )
    
    [--] PURPOSE [--]
    
    @TODO
    
    [--] IMPLEMENTATION [--]
    
    @TODO

*/

    extract($variables);

    // Ensure these variables are set 
    if ( empty($category) ) {
        $category = '';
    }
    if ( empty($subcategory) ) {
        $subcategory = '';
    }
    
    // Decide which sub-categories to show
    $sectionClassFriendlyName = strtolower( str_replace(' ', '', $category) );
    switch (strtolower($category)) {
        case 'learn':
            $sectionMessage = 'Learn more about exporting and assess your readiness.  Find out how exporting could benefit your business.  Get information about the steps you need to take to be in compliance with exporting regulations.';
            $subSectionOptions = array(
                array(
                    'title' => 'Basic Information',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/learn-information.png',
                    'link' => '/export#learn-information',
                    'subcat-id' => 'information'
                ),
                array(
                    'title' => 'Research Tools',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/learn-research.png',
                    'link' => '/export#learn-research',
                    'subcat-id' => 'research'
                ),
                array(
                    'title' => 'Consulting Support',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/learn-consulting.png',
                    'link' => '/export#learn-consulting',
                    'subcat-id' => 'consulting'
                )
            );
            break;
        case 'comply':
            $sectionMessage = 'Some exports require compliance before you can ship your product. Some foreign countries have standards that you should be aware of. Lastly, there are some countries that you cannot sell to. Use the information here to familiarize yourself with the licenses, standards, and legal considerations that may apply to your product(s).';
            $subSectionOptions = array(
				array(
                    'title' => 'Documentation',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/comply-document.png',
                    'link' => '/export#comply-document',
                    'subcat-id' => 'document'
                ),
                array(
                    'title' => 'Certification',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/comply-certify.png',
                    'link' => '/export#comply-certify',
                    'subcat-id' => 'certify'
                ),
                array(
                    'title' => 'Shipping',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/comply-ship.png',
                    'link' => '/export#comply-ship',
                    'subcat-id' => 'ship'
                )
                
            );
            break;
        case 'assistance and opportunities':
            $sectionMessage = 'Learn more about exporting opportunities such as Trade Leads from the State Department and other exporting opportunities from various Federal Agencies that could benefit your business.  Also learn what resources are available to you no matter where you are in the world and issues you may come across.';
            $subSectionOptions = array(
                array(
                    'title' => 'For Basic Assistance',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/assistance-contacts.png',
                    'link' => '/export#assistanceandopportunities-contacts',
                    'subcat-id' => 'contacts'
                ),
                array(
                    'title' => 'For Financing',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/assistance-finance.png',
                    'link' => '/export#assistanceandopportunities-exportfinance',
                    'subcat-id' => 'exportfinance'
                ),
                array(
                    'title' => 'For Trade Problems',
                    'imagesrc' => '/sites/all/themes/bususa/images/exporterdashboard/assistance-trade.png',
                    'link' => '/export#assistanceandopportunities-tradeproblems',
                    'subcat-id' => 'tradeproblems'
                )
            );
            break;
    }
    
?>

<!-- The following styles should be relocated into global.css -->
<style>
    .title-and-sharelink {
        margin-bottom: 5px;
    }
</style>

<!-- Debug and verbosity -->
<div class="debuginfo" style="display: none;">
    <!--
        $category = <?php print $category; ?>
        $subcategory = <?php print $subcategory; ?>
    -->
</div>

<!-- The following script tag is stored in export_portal_page.tpl.php -->
<script>
    jQuery('body').addClass('page-exportportal');
</script>

<!-- The following script tag is stored in export_portal_page.tpl.php -->
<script>
    jQuery(document).ready( function () {
        
        var thisPageBreadCrumb = jQuery('.breadcrumb a:contains("Export Content")')
        thisPageBreadCrumb.attr('href', 'javascript: void(0);');
        thisPageBreadCrumb.text('<?php print str_replace("'", "\\'", $exportTitle); ?>');
        
        jQuery('#titleWrapper h1').text('<?php print str_replace("'", "\\'", $exportTitle); ?>');
        jQuery('#titleWrapper h1').attr('note', 'Title changed by JavaScrpt. Coder Bookmark: CB-RD1JT7P-BC');
        
    });
</script>


<div class="exportdotgov-landingpage-mastercontainer exportdotgov-landingpage-mastercontainer-<?php print cssFriendlyString($exportTitle); ?> exporterdashboard-chosencategory-<?php print cssFriendlyString($category);?> exporterdashboard-chosensubcategory-<?php print cssFriendlyString($subcategory); ?>">
    
    <!-- Yellow box for administrators -->
    <div class="admin-only" style="background-color: rgb(255, 255, 168); border: 1px solid gray; padding: 10px; margin-bottom: 15px;">
        <i>This message is only visible to administrators</i><br/>
        <br/>
        <b>Dev Notes:</b>
        <ul style="padding-left: 20px;">
            <li>The template this page is rendered from is export-landing-page.tpl.php</li>
            <li>The executer of this template, and the script that pulled the information this template depends on, would weither be export-portal.tpl.php or ConsumeData-Export.govSiteRip.php</li>
            <li>Note that ripExportDotGovPage() may pull content from export.gov, but only if the target-page has not already been cached into a file somewhere in sites/default/files/export-gov-content/~</li>
            <li>By the time you are reading this message, the export.gov domain may already been shut down. By this/that point in time, we should have all pages in export.gov cached into this directory on the server (sites/default/files/export-gov-content/~).</li>
        </ul>
        
        <?php if ( !empty($exportCachePath) ) { ?>
            The target page on export.gov has been cached/stored at <i><?php print $exportCachePath; ?></i><br/>
            This is also the cache-file ripExportDotGovPage() depends on and will returned parsed information from.<br/>
            <b>
                <a href="/sys/exporter-dashboard/edit-cache?exportCachePath=<?php print $exportCachePath; ?>">
                    Click here
                </a>
            </b> to <b>edit</b> this cache file (you can edit the content shown below by editing this cache file).<br/>
        <?php } ?>
        
    </div>
    
    <!-- "Return to topics link" and "Share+" widget  -->
    <div class="export-headerandshareplus">
        <div class="export-headerandshareplus-inner">
        
            <!-- Return to topics link -->
            <div class="export-header">
                <div class="exportdotgov-landingpage-returntotopics">
                    <a href="/export">
                        <img id="img-export-landingpage-return-arrow" src="/sites/all/themes/bizusa/images/return-arrow-white.png" alt="return arrow"/>
                        Return to Topics
                    </a>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Left side-bar -->
    <div class="exportdotgov-landingpage-maincontent">
        <div class="export-portal-menu">
            <div class="export-menu-table">
                <div class="export-menu-item-container">
                    <a class="export-menu-item" href="/export#learn">
                        <div id="export-learn-backimage"><div class="selectedcategoryarrow"></div></div>
                            Learn More...
                    </a>
                </div>

                <div class="export-menu-item-container">
                    <a class="export-menu-item" href="/export#comply">
                        <div id="export-comply-backimage"><div class="selectedcategoryarrow"></div></div>
                            Compliance Resources
                    </a>
                </div>

                <div class="export-menu-item-container">
                    <a class="export-menu-item" href="/export#assistanceandopportunities">
                        <div id="export-assistance-backimage"><div class="selectedcategoryarrow"></div></div>
                            Seek Assistance
                    </a>
                </div>

            </div>
        </div>
        <!-- Exporter-Dashboard SubCategories - this is shown only when applicable -->
            <div class="export-section-container">
                <!-- /* Coder Bookmark: CB-DSFXNN9-BC */ -->
                <?php $addClasses = ''; ?>
                <?php if ( !empty($subSectionOptions) ) { ?>
                        <div class="export-section-topmenu">
                            <?php foreach ( $subSectionOptions as $index => $subSectionOption ) { ?>
                                <div class="export-learn-stage-image <?php print $addClasses ?>" id="<?php print $sectionClassFriendlyName; ?>-<?php print strtolower( str_replace(' ', '', $subSectionOption['title']) ); ?>">
                                    <a href="<?php print $subSectionOption['link']; ?>">
                                        <span class="export-section-topmenu-innerfield">
                                            <?php print $subSectionOption['title']; ?>
                                        </span>
                                        <img class="mobile-only" alt="" src="<?php print ( cssFriendlyString($subSectionOption['subcat-id']) == cssFriendlyString($subcategory)  ? '/sites/all/themes/bizusa/images/uparrow.png' : '/sites/all/themes/bizusa/images/downarrow.png' ); ?>" />
                                    </a>
                                </div>
                                <?php
                                    if ( cssFriendlyString($subSectionOption['subcat-id']) == cssFriendlyString($subcategory) ) {
                                        $addClasses .= ' mobile-never-important';
                                        $resumeMobileAcordianFromIndex = $index;
                                    }
                                ?>
                            <?php } ?>
                        </div>
                <?php } ?>
            </div>

            <!-- The export-.gov-content landing-page main content area. This is content ripped from export.gov /* Coder Bookmark: CB-50H4LWP-BC */ -->
            <div class="exportdotgov-landingpage-maincontent-inner">
                <div class="exportdotgov-landingpage-exportdotgovcontent">
                    <!-- /* Coder Bookmark: CB-A55NPHF-BC */ -->
                    <?php print $exportContentHTML; ?>
                </div>
            </div>

        <div class="export-section-bottommenu mobile-only">
            <?php for ( $x = $resumeMobileAcordianFromIndex + 1; $x < count($subSectionOptions) ; $x++ ) { ?>
                <?php $subSectionOption = $subSectionOptions[$x]; ?>
                <div class="export-learn-stage-image" id="<?php print $sectionClassFriendlyName; ?>-<?php print strtolower( str_replace(' ', '', $subSectionOption['title']) ); ?>">
                    <a href="<?php print $subSectionOption['link']; ?>">
                        <span class="export-section-topmenu-innerfield">
                            <?php print $subSectionOption['title']; ?>
                        </span>
                        <img class="mobile-only" alt="" src="<?php print ( cssFriendlyString($subSectionOption['subcat-id']) == cssFriendlyString($subcategory)  ? '/sites/all/themes/bizusa/images/uparrow.png' : '/sites/all/themes/bizusa/images/downarrow.png' ); ?>" />
                    </a>
                </div>
            <?php } ?>
        </div>
        
    </div>
    <div class="sidebars-container">
        <!-- Related topics [right] side-bar -->
        <?php if ( !empty($exportSideBars) ) { ?>
            <?php $exportSideBarIndex = 0; ?>
            <?php foreach ( $exportSideBars as $exportSideBarTitle => $exportSideBarLinks ) { ?>
                <div class="exportdotgov-landingpage-relatedcontent-container">
                    <div class="exportdotgov-landingpage-relatedcontent-titlebar">
                        <?php print ucwords($exportSideBarTitle); ?>
                    </div>
                    <div class="exportdotgov-landingpage-relatedcontent-links-container">

                        <?php /* Print each link for this sidebar */ ?>
                        <?php foreach ( $exportSideBarLinks as $linkInfo ) { ?>

                            <?php

                                // If this link is pointing to export.gov, make it point to the export-portal on BusinessUSA
                                $linkInfo['url'] = str_replace('http://export.gov/', '/export-portal?', $linkInfo['url']);
                                $linkInfo['url'] = str_replace('http://www.export.gov/', '/export-portal?', $linkInfo['url']);
                                $linkInfo['url'] = str_replace('http://tcc.export.gov/', '/export-portal?tcc/', $linkInfo['url']);

                                // Attach additional CSS classes to this anchor as needed
                                $additionalClasses = '';
                                if ( isset($linkInfo['warning']) && $linkInfo['warning'] === true ) {
                                    $additionalClasses .= ' export-information-section-links-link-haserrro'; // Add a class statng there is an issue with this link on the excel-source-spreadsheet
                                }
                                if ( isset($linkInfo['hilight']) && $linkInfo['hilight'] === true ) {
                                    $additionalClasses .= ' exportportal-hilight'; // Add a class statng there is an issue with this link on the excel-source-spreadsheet
                                }

                            ?>

                            <div class="exportdotgov-landingpage-relatedcontent-link-item <?php print trim($additionalClasses); ?>">

                                    <a href="<?php print $linkInfo['url']; ?>" class="<?php print trim($additionalClasses); ?>">
                                      <span> <?php print $linkInfo['title']; ?></span>
                                    </a>

                            </div>
                        <?php } ?>

                    </div>
                </div>

                <?php $exportSideBarIndex++; ?>
            <?php } ?>
        <?php } ?>

        <!-- "Tools" [right] side-bar, this always shows and is always static -->
        <div class="exportdotgov-landingpage-othertopics-container">
            <div class="exportdotgov-landingpage-othertopics-titlebar">
               Tools
            </div>
            <div class="exportdotgov-landingpage-othertopics-links-container">
                <ul class="exportdotgov-landingpage-othertopics-link-item">
                    <li><a href="/begin-exporting"><span>Start Exporting</span></a></li>
                    <li><a href="/expand-exporting"><span>Expand Exporting</span></a></li>
                    <li><a href="/export#teachtellmeaboutexporting"><span>Learn About Exporting Basics</span></a></li>
                    <li><a href="http://help.business.usa.gov/link/portal/30027/30030/ArticleFolder/19/Export-Answers" target="_blank"><span>Frequently Asked Questions</span></a></li>
                    <li><a href="/events?ExportAssistance=ExportAssistance"><span>Find Events Related to Exporting</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- The following style tag is stored in export-landing-page.tpl.php, the content within it comes from export-landing-page-styles-override.css - Coder Bookmark: CB-QAEZSLM-BC -->
    <style>
        <?php
            /*
                [!!] NOTICE [!!]
                This style block is placed within the body of this document in this location intentionally.
                It has been placed here, after the markup of the export.gov content, in order to override any styles or in-line styles that have been imported from the export.gov domain.
                Coder Bookmark: CB-QAEZSLM-BC
            */ 
        
            include(overridable('sites/all/modules/custom/export_portal/export-landing-page-styles-override.css'));
        ?>
    </style>
</div>
