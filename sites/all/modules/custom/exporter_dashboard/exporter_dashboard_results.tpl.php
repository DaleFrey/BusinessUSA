<!-- The following markup is stored in exporter-dashboard-results.tpl.php -->

<div class="exporterdashboard-mastercontainer exporterdashboard-chosencategory-<?php print cssFriendlyString($variables['category']);?> exporterdashboard-chosensubcategory-<?php print $variables['subcategory']; ?>">
    
    <?php
        print theme(
            'devnote', 
            array(
                'welcomeMsg' => '',
                'message' => '
                    Dev Note: The following markup is generated from the ' .  __FILE__ . ' file.
                ',
                'showControles' => 'hover'
            )
        );
    ?>
    
    <?php
        /* @TODO */
        $resultsForSubSectionId = 0;
        foreach ( $variables['subSectionOptions'] as $index => $subSection ) {
            if ( $subSection['div'] === cssFriendlyString($variables['category']) . '-' . cssFriendlyString($variables['subcategory']) ) {
                $resultsForSubSectionId = $index + 1;
                break;
            }
        }
    ?>
    
    
    <style>
        .export-information-section-links-link-haserrro a {
            background-color: yellow;
            color: red !important;
            font-weight: bold;
        }
    </style>
    
    <div class="export-container export-container-<?php print cssFriendlyString($variables['category']);?>">

        <div class="export-mobileresilts-welcomemsg mobile-only">
            <?php print $variables['sectionMessage']; ?>
        </div>
        
        <div class="export-mobilesection-topcontainer mobile-only">
            <?php for ( $x = 0 ; $x < $resultsForSubSectionId ; $x++ ): ?>
                
                <?php
                    if ( $x == $resultsForSubSectionId - 1 ) {
                        $onClickMarkup = "loadExportPage('" . cssFriendlyString($variables['category']) . "');";
                        $arrowImageSource = '/sites/all/themes/bizusa/images/uparrow.png';
                    } else {
                        $onClickMarkup = "loadExportPage('{$variables['subSectionOptions'][$x]['div']}');";
                        $arrowImageSource = '/sites/all/themes/bizusa/images/downarrow.png';
                    }
                ?>
                
                <div class="export-learn-stage-image" id="<?php print $variables['sectionClassFriendlyName']; ?>-<?php print strtolower( str_replace(' ', '', $subSectionOption['title']) ); ?>">
                    <a href="javascript:void(0);" onclick="<?php print $onClickMarkup; ?>">
                        <span class="export-section-topmenu-innerfield">
                            <?php print $variables['subSectionOptions'][$x]['title']; ?>
                        </span>
                        <img alt="" src="<?php print $arrowImageSource ?>" />
                    </a>
                </div>
                
            <?php endfor; ?>
        </div>
        
        <div class="export-section-container mobile-never">
			
            <div class="export-section-topmenu">
                <?php if ( $variables['category'] === 'teach tell me about exporting' ) { ?>
                    
                    <h3>Teach/Tell me about exporting</h3>
                    
                <?php } else { ?>
                
                    <?php foreach ( $variables['subSectionOptions'] as $subSectionOption ) { ?>
                        <div class="export-learn-stage-image" id="<?php print $variables['sectionClassFriendlyName']; ?>-<?php print strtolower( str_replace(' ', '', $subSectionOption['title']) ); ?>">
                            <a href="javascript:void(0);" onclick="loadExportPage('<?php print $subSectionOption['div']; ?>');">
                                <div class="export-section-topmenu-innerfield">
                                    <?php print $subSectionOption['title']; ?>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    
                <?php }  ?>
            </div>
        </div>
        
		<div class="export-information-sections-mastercontainer export-content-<?php print strtolower( str_replace(' ', '', $subSectionOption['title']) );?>">
            
            <?php foreach ( $variables['exportDashboardSectionsAndLinks'] as $exportDashboardSectionTitle => $exportDashboardLinks ) { ?>
                        
                <div class="export-information-section-container">
                
                    <div class="export-information-section-title">
                        <a href="javascript:void(0);" >
                            <?php print $exportDashboardSectionTitle; ?>
                        </a>
                        <img class="mobile-only" alt="" src="/sites/all/themes/bizusa/images/carrot-right.png" />
                    </div>
                                
                    <div class="export-information-section-links-mastercontainer export-information-section-colgroup">
                        <ul class="export-information-links">
                            <li class="export-information-section-links-link-container">
                                <img class="mobile-only" alt="" src="/sites/all/themes/bizusa/images/carrot-left.png" />
                                <a class="export-information-section-links-link-anchor mobile-only" href="javascript: loadExportPage('<?php print cssFriendlyString($variables['category']) . '-' . cssFriendlyString($variables['subcategory']); ?>'); void(0);">
                                    Back
                                </a>
                            </li>
                            <?php foreach ( $exportDashboardLinks as $exportDashboardLinkInfo ) { ?>
								<li class="export-information-section-links-link-container <?php if ( $exportDashboardLinkInfo['warning'] ) { print ' export-information-section-links-link-haserrro'; } ?>">
									<a class="export-information-section-links-link-anchor ext" href="<?php print $exportDashboardLinkInfo['url']; ?>">
										<?php print $exportDashboardLinkInfo['title']; ?>
									</a>
                                </li>
                             <?php } ?>
                        </ul>
                    </div>
                                
                </div>
                            
            <?php } ?>
            
        </div>
        
        <div class="export-mobilesection-bottomcontainer mobile-only">
            <?php for ( $x = $resultsForSubSectionId ; $x < count($variables['subSectionOptions']) ; $x++ ): ?>
                <div class="export-learn-stage-image" id="<?php print $variables['sectionClassFriendlyName']; ?>-<?php print strtolower( str_replace(' ', '', $subSectionOption['title']) ); ?>">
                    <a href="javascript:void(0);" onclick="loadExportPage('<?php print $variables['subSectionOptions'][$x]['div']; ?>');">
                        <span class="export-section-topmenu-innerfield">
                            <?php print $variables['subSectionOptions'][$x]['title']; ?>
                        </span>
                        <img alt="" src="/sites/all/themes/bizusa/images/downarrow.png" />
                    </a>
                </div>
            <?php endfor; ?>
        </div>
        
    </div>

    <!-- The following script-tag holds event handlers for the showing/hiding the information section links area -->
	<script>
        /* The following script-tag holds event handlers for the showing/hiding the information section links area */
		var clicked = 0;
        jQuery(".export-information-section-title").click( function() {
            if ( jQuery(".export-information-section-title").hasClass("sectiontitlehovered") ) {
                jQuery(".export-information-section-title").removeClass("sectiontitlehovered");
                jQuery(this).parents('.export-information-sections-mastercontainer').removeClass('showing-popup-results');
                jQuery(".export-information-section-title").siblings(".export-information-section-colgroup").hide();
            }
            jQuery(this).toggleClass("sectiontitlehovered");
            jQuery(this).parents('.export-information-sections-mastercontainer').toggleClass('showing-popup-results');
            jQuery(this).siblings(".export-information-section-colgroup").toggle();
            
        });
        jQuery(document).click( function(e) {
            if ( jQuery(window).width()  > 768 ) { /* If we are not in mobile layout... */
                if (! jQuery(e.target).closest(".export-information-section-title").length && !jQuery(e.target).closest(".export-information-section-colgroup").length ) {
                    jQuery(".export-information-section-title").removeClass("sectiontitlehovered");
                    jQuery(".export-information-section-title").siblings(".export-information-section-colgroup").hide();
                    clicked = 0;
                }
            }
        });

        <!-- The following script-tag holds 'view-more' functionality for subcategory results-->
        /*jQuery( ".export-information-section-links-mastercontainer ul.export-information-links" ).each(function(){
            if(jQuery(this).children("li").length > 7){
            // show the first seven items
                jQuery(this).children("li").filter(':gt(6)').hide();
                var last = jQuery(this).children("li")[jQuery(this).children("li").length-1];
                if(last.className == 'export-information-section-links-link-container');
                    jQuery(this).append('<li class="viewmore"><a href=#"><span>+ View More ...</span></a></li>')
            }
        });
        jQuery('.viewmore').click(function(){
            jQuery(this).siblings(':gt(6)').toggle();
            var span = jQuery(this).find('span').text();
            if(span == "+ View More ..."){
                jQuery(this).find('span').text("- View Less");
            }else{
                jQuery(this).find('span').text("+ View More ...");
            }
        });*/

        jQuery( "#div_mobile_menu" ).click(function() {
            jQuery( ".export-menu-links" ).slideToggle( "slow" );
        });
    </script>
</div>
