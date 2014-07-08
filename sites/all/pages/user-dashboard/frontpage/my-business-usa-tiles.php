
<!-- /* Coder Bookmark: CB-HZC6MZC-BC */ -->
<div class="tiles-and-leftright-navigation-container <?php print ( count($myBusinessUsaTiles_page2) > 0 ? 'tiles-paged' : 'tiles-not-paged' ); ?>" rendersource="<?php print basename(__FILE__); ?>">

    <a class="tiles-pagesnavigation tiles-pagesnavigation-left mobile-never-important" href="javascript: void(0);">
        <img src="/sites/all/themes/bizusa/images/myUSAimgs/myUSApngs-arrowleft.png" alt="Show first page of BusinessUSA tiles" />
    </a>
    
    <div class="tiles-pages-container">
        <ul class="tiles-pages-page tiles-pages-page-1 mobile-forceshow-important">
            <?php foreach ( $myBusinessUsaTiles_page1 as $index => $tileWizardInfo ): /* Data generated from Coder Bookmark: CB-01ZDZB2-BC */ ?>
                <li class="tiles-tile tiles-tile-index-<?php print $index; ?> tiles-tile-tilename-<?php print cssFriendlyString($tileWizardInfo['title']); ?>">
                    <div class="wizard-icon wizard-iconof-<?php print cssFriendlyString($tileWizardInfo['title']); ?>">
                        <!-- Use CSS to place the appropriate icon for this wizard here. Refer the the class name in the LI for the checked-value status. /* Coder Bookmark: CB-E1MRU66-BC */ -->
                    </div>
                    <a class="tile-wizardtitle" href="<?php print $tileWizardInfo['field_swimlane_wizurl_value']; ?>">
                        <?php print $tileWizardInfo['title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ( count($myBusinessUsaTiles_page2) > 0 ): ?>
            <ul class="tiles-pages-page tiles-pages-page-2 mobile-forceshow-important" style="display: none;">
                <?php foreach ( $myBusinessUsaTiles_page2 as $index => $tileWizardInfo ): /* Data generated from Coder Bookmark: CB-01ZDZB2-BC */ ?>
                    <li class="tiles-tile tiles-tile-index-<?php print $index; ?> tiles-tile-tilename-<?php print cssFriendlyString($tileWizardInfo['title']); ?>">
                        <div class="wizard-icon wizard-iconof-<?php print cssFriendlyString($tileWizardInfo['title']); ?>">
                            <!-- Use CSS to place the appropriate icon for this wizard here. Refer the the class name in the LI for the checked-value status. /* Coder Bookmark: CB-E1MRU66-BC */ -->
                        </div>
                        <a class="tile-wizardtitle" href="<?php print $tileWizardInfo['field_swimlane_wizurl_value']; ?>">
                            <?php print $tileWizardInfo['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    
    <a class="tiles-pagesnavigation tiles-pagesnavigation-right mobile-never-important" href="javascript: void(0);">
        <img src="/sites/all/themes/bizusa/images/myUSAimgs/myUSApngs-arrowright.png" alt="Show second page of BusinessUSA tiles" />
    </a>
    
</div>

<!-- /* Coder Bookmark: CB-3DF8IA9-BC */ -->
<?php if ( count($myBusinessUsaTiles_page2) > 0 ): ?>
    <div class="bottom-dot-navigation-container mobile-never-important" rendersource="<?php print basename(__FILE__); ?>">
        <a class="dot-nav-anchor dot-nav-anchor-page1 active" href="javascript: void(0);">
            pager
        </a>
        <a class="dot-nav-anchor dot-nav-anchor-page2" href="javascript: void(0);">
            pager
        </a>
    </div>
<?php endif; ?>

<!-- /* Coder Bookmark: CB-A4JVCG9-BC */ -->
<a href="/user-dashboard/usersettings?uid=<?php print $userInfo->uid; ?>" class="progsserv-addtile mobile-only mobile-only" rendersource="<?php print basename(__FILE__); ?>">
    Add a Tile
</a>