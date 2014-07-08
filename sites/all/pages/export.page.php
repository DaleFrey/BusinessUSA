<?php

    $urlArguments = arg();
    if ( count($urlArguments) === 3 ) {
        return export_page(); // This function is defined in export_portal.module
    }

    $exportCategories = array(
        'Learn' => array(
            'Information',
            'Research',
            'Consulting'
        ),
        'Comply' => array(
            'Certify',
            'Ship',
            'Document'
        ),
        'Assistance and Opportunities' => array(
            'Contacts',
            'Export Finance',
            'Trade Problems'
        )
    );
?>

<div class="exporterdashboard-mastermastercontainer">
    <div class="export-menu" style="opacity: 0; z-index: -100; -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';">
        <div class="export-menu-table">

            <div class="export-menu-item-container export-menu-item-container-learn">
                <a class="export-menu-item" href="javascript:void(0);" onclick="loadExportPage('learn');">
                    <div id="export-learn-backimage">
                        <div class="selectedcategoryarrow"></div>
                    </div>
                    Learn More...
                </a>
            </div>

            <div class="export-menu-item-container export-menu-item-container-comply">
                <a class="export-menu-item" href="javascript:void(0);" onclick="loadExportPage('comply');">
                    <div id="export-comply-backimage">
                        <div class="selectedcategoryarrow"></div>
                    </div>
                    Compliance Resources
                </a>
            </div>

            <div class="export-menu-item-container export-menu-item-container-assistanceandopportunities">
                <a class="export-menu-item" href="javascript:void(0);" onclick="loadExportPage('assistanceandopportunities');">
                    <div id="export-assistance-backimage">
                        <div class="selectedcategoryarrow"></div>
                    </div>
                    Seek Assistance
                </a>
            </div>

        </div>
    </div>
    <div class="exporterdashboard-premastercontainer exporterdashboard-premastercontainer-maincontent">
        <?php print theme('exporter_dashboard_splash', array()); ?>
    </div>
    <div style="display:none;" class="exporterdashboard-premastercontainer exporterdashboard-premastercontainer-teachtellmeaboutexporting">
        <?php
            print theme('exporter_dashboard_results',
                array(
                    'category' => 'teach tell me about exporting',
                    'subcategory' => 'teach tell me about exporting'
                )
            );
        ?>
    </div>
    <?php foreach ( $exportCategories as $exportCategory => $subCategories ): ?>
        <div style="display: none;" class="exporterdashboard-premastercontainer exporterdashboard-premastercontainer-<?php print cssFriendlyString($exportCategory); ?>">
            <?php print theme( 'exporter_dashboard_choose_subcategory', array('chosenSection' => $exportCategory) ); ?>
        </div>
    <?php endforeach; ?>
    
    <?php foreach ( $exportCategories as $exportCategory => $subCategories ): ?>
        
        <?php foreach ( $subCategories as $subCategory ): ?>
                
                <div style="display: none;" class="exporterdashboard-premastercontainer exporterdashboard-premastercontainer-<?php print cssFriendlyString($exportCategory); ?>-<?php print cssFriendlyString($subCategory); ?>">
                
                    <?php 
                        print theme(
                            'exporter_dashboard_results', 
                            array(
                                'category' => $exportCategory,
                                'subcategory' => $subCategory
                            )
                        );
                    ?>
                    
                </div>
            
        <?php endforeach; ?>
        
    <?php endforeach; ?>
</div>
    
<script>

    function loadExportPage(page) {

        jQuery('.exporterdashboard-premastercontainer').hide();
        jQuery('.export-menu-item-container').removeClass('active');
        jQuery('.export-menu-item-container-' + page).addClass('active');
        if ( String(page).indexOf('-') != -1 ) {
            parentPage = String(page).split('-');
            parentPage = parentPage[0];
            jQuery('.export-menu-item-container-' + parentPage).addClass('active');
        }

        if ( jQuery(window).width()  < 768 ) {
            jQuery('.exporterdashboard-premastercontainer.exporterdashboard-premastercontainer-' + page).show();
        } else {
            jQuery('.exporterdashboard-premastercontainer.exporterdashboard-premastercontainer-' + page).fadeIn();
        }

        // Ensure the pinned navigation is visible
        jQuery('.exporterdashboard-mastermastercontainer>.export-menu').css('opacity', '');
        jQuery('.exporterdashboard-mastermastercontainer>.export-menu').css('z-index', '');

        // Ensure that only the correct right-pointing carrot is showing from the navigation menu (in non-mobile layout)
        var targetMainCategory = String(page);
        if ( targetMainCategory.indexOf('-') != -1 ) {
            targetMainCategory = targetMainCategory.split('-');
            targetMainCategory = targetMainCategory[0];
        }
        jQuery('.selectedcategoryarrow').hide();
        jQuery('.export-menu-item-container-' + targetMainCategory + ' .selectedcategoryarrow').show();

        // Clear an results-popups that may be trying to show
        jQuery('.export-information-section-title').removeClass('sectiontitlehovered');
        jQuery('.export-information-sections-mastercontainer').removeClass('showing-popup-results');
        jQuery('.export-information-section-title').siblings('.export-information-section-colgroup').hide();

        // Update the hash (this will get caught by and registered in Google Analytics)
        document.location.hash = page;

        if (page == 'teachtellmeaboutexporting'){
            breadcrumb = {teachtellmeaboutexporting:"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » Learn About Exporting Basics"};
        }
        else{
            breadcrumb = {learn:"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » Learn More",
                'learn-information':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"learn\");'>Learn More</a> » Basic Information",
                'learn-research':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"learn\");'>Learn More</a> » Research Tools",
                'learn-consulting':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"learn\");'>Learn More</a> » Consulting Support",
                comply:"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » Comply with the law",
                'comply-certify':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"comply\");'>Comply with the law</a> » Certification",
                'comply-ship':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"comply\");'>Comply with the law</a> » Shipping",
                'comply-document':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"comply\");'>Comply with the law</a> » Documentation",
                assistanceandopportunities:"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » Seek Assistance",
                'assistanceandopportunities-contacts':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"assistanceandopportunities\");'>Seek Assistance</a> » For Basic Assistance",
                'assistanceandopportunities-exportfinance':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"assistanceandopportunities\");'>Seek Assistance</a> » For Financing",
                'assistanceandopportunities-tradeproblems':"<a href='/'>Home</a> » <a href='/export'>Explore Exporting</a> » <a href='javascript:void(0);' onclick='loadExportPage(\"assistanceandopportunities\");'>Seek Assistance</a> » For Trade Problems"};
        }


        if(page.length > 0)
            document.getElementsByClassName('breadcrumb')[0].innerHTML = breadcrumb[page];
    }

    // If the hash is already populated with something, we shall show the target div
    if ( document.location.hash !== '' ) {
        var toLoad = String(document.location.hash).replace('#', '');
        loadExportPage(toLoad);
    }
    
</script>