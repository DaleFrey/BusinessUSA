<div class="exporterdashboard-mastercontainer exporterdashboard-chosencategory-<?php print $variables['sectionClassFriendlyName']; ?>">

    <?php
        print theme(
            'devnote', 
            array(
                'welcomeMsg' => '',
                'message' => '
                    Dev Note: The following markup is generated from the ' .  __FILE__ . ' file.<br/>
                    And the $variables function within this file is processed from the hook_preprocess_HOOK implementation: 
                    exporter_dashboard.module :: exporter_dashboard_preprocess_exporter_dashboard_choose_subcategory()
                ',
                'showControles' => 'hover'
            )
        );
    ?>

    <div class="admin-only" style="background-color: rgb(255, 255, 168); border: 1px solid gray; padding: 10px; margin-bottom: 15px;">
        Dev Note: The HTML below is generated from the exporter-dashboard-choose-subcategory.tpl.php file.<br/>
        This notice message is only visible to the administrator.
    </div>

    <div class="export-container export-container-<?php print $variables['sectionClassFriendlyName']; ?>">
    
        <div class="export-stage export-stage-<?php print $variables['sectionClassFriendlyName']; ?>">
            <div class="export-stage-mobilemessage mobile-only">
                <?php print $variables['sectionMessage']; ?>
            </div>
            <?php foreach ( $variables['subSectionOptions'] as $subSectionOption ) { ?>
					<div class="export-learn-stage-image" id="<?php print $variables['sectionClassFriendlyName']; ?>-<?php print strtolower( str_replace(' ', '', $subSectionOption['title']) ); ?>">
						<a href="javascript:void(0);" onclick="loadExportPage('<?php print $subSectionOption['div']; ?>');">
                            <span class="export-section-topmenu-innerfield">
                                <?php print $subSectionOption['title']; ?>
                            </span>
                            <img class="mobile-only" alt="" src="/sites/all/themes/bizusa/images/downarrow.png" />
                        </a>
					</div>
            <?php } ?>
            <div class="export-stage-message mobile-never">
                <?php print $variables['sectionMessage']; ?>
            </div>
        </div>

    </div>
    
    <script>
        jQuery("#div_mobile_menu").click(function() {
            jQuery(".export-menu-links").slideToggle( "slow" );
        });
    </script>

    <!-- The following script-tag holds event handlers for the "Quick Links" drop-down area -->
    <script>
        jQuery('.quicklinkoptions').hover(
            function () {
                // Event handler for hovering the mouse over the "Quick Links"-children follows...
                ignoreQickLinksHiding = true;
                setTimeout( function () {
                    ignoreQickLinksHiding = false;
                }, 100);
            },
            function() {
                // Event handler for the mouse-leave the mouse over "Quick Links" follows...
                setTimeout( function () {
                    if ( typeof ignoreQickLinksHiding == 'undefined' || ignoreQickLinksHiding != true ) {
                        jQuery(".quicklinks").removeClass("quicklinkshovered");
                        jQuery(".quicklinkoptions").hide();
                    }
                }, 50);
            }
        );
        jQuery(".quicklinks").hover(
            function() {
                // Event handler for hovering the mouse over "Quick Links" follows...
                jQuery(".quicklinks").addClass("quicklinkshovered");
                jQuery(".quicklinkoptions").show();
            },
            function() {
                // Event handler for the mouse-leave the mouse over "Quick Links" follows...
                setTimeout( function () {
                    if ( typeof ignoreQickLinksHiding == 'undefined' || ignoreQickLinksHiding != true ) {
                        jQuery(".quicklinks").removeClass("quicklinkshovered");
                        jQuery(".quicklinkoptions").hide();
                    }
                }, 50);
            }
        );
    </script>
    
</div>