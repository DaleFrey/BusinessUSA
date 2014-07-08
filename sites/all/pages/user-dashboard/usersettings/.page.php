<?php /*

    [!!] WARNING [!!]
    
    Due to Akamai caching, we should always append uid=<DrupalUserId> to the request for this page, 
    and may want to add an additional URL query parameter, something like 
    ?bypassAkamaiCache=<RandomString> to bypass the Akamai cache for this page reuqest.

    [--] FILES [--]
    
    usersettings.page.inc - Executed FIRST, variable declarations and processing is done in here
    usersettings.page.php - Executed SECOND, renders the HTML for this page
    usersettings.page.less - Used by the browser for theming purposes.

    [--] IMPLEMENTATION [--]
    
    Every user that can authenticate with MyUSA and log into our Drupal application should have 
    their own Drupal user account. We still store information about users in Drupal user fields.
    
    Fields for Drupal users can be mamanged from the URL of: <site>/admin/config/people/accounts/fields
    
*/
?>
<div class="messages error selectwizarderror" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
    <h2 class="element-invisible">Error message</h2>
    Please select at least one option from the Wizards section (section 3)
</div>
<form class="dashboardsettings-mastercontainer" method="post" style="clear: both;" rendersource="<?php print basename(__FILE__); ?>">
    
    <!-- DO NOT REMOVE the following hidden input, this is used to inform the target script this form is submitting -->
    <input type="hidden" name="form_submit" value="yes" />
    
    <!-- The .less file that themes this page depends on this class-name being in the body tag -->
    <script rendersource="<?php print basename(__FILE__); ?>">
        jQuery('body').addClass('userdashboard-settings-page');
    </script>
    
    <div class="dashboardsettings-section dashboardsettings-section-welcomemessage">
        <h1 class="dashboardsettings-section-head dashboardsettings-section-head-welcomemessage">
            Welcome to MyBusinessUSA.
        </h1>
        <div class="dashboardsettings-subtitle">
            There are a number of exciting new features that might be useful to your business.
            To help us further personalize your experience, please answer the following questions.
        </div>
    </div>
    
    <div class="dashboardsettings-section dashboardsettings-section-ownership">
        <h2 class="dashboardsettings-section-head dashboardsettings-section-head-ownership expanded">
            <span class="dashboardsettings-section-number dashboardsettings-section-number-ownership">
                1
            </span>
            <span class="dashboardsettings-section-subtitle dashboardsettings-section-number-ownership">
                What best describes the ownership of your business?
            </span>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </h2>
        <div class="collapsable-container">
            <?php for ( $x = 0 ; $x < count($ownershipQuestions) ; $x+=3 ): ?>
                <ul class="dashboardsettings-checkboxlist">
                    <?php foreach ( array_slice($ownershipQuestions, $x, 3) as $ownershipQuestion ): ?>
                        <li class="dashboardsettings-checkboxlist-li">
                            <input type="checkbox" name="<?php print cssFriendlyString($ownershipQuestion['label']); ?>" id="<?php print cssFriendlyString($ownershipQuestion); ?>" class="dashboardsettings-checkbox" <?php print ( $ownershipQuestion['checked'] ? 'checked="checked"' : '' ); ?> />
                            <label for="<?php print cssFriendlyString($ownershipQuestion['label']); ?>" class="dashboardsettings-checkboxlabel">
                                <?php print $ownershipQuestion['label']; ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endfor; ?>
        </div>
    </div>
    
    <div class="dashboardsettings-section dashboardsettings-section-industry">
        <h2 class="dashboardsettings-section-head dashboardsettings-section-head-industry expanded">
            <span class="dashboardsettings-section-number dashboardsettings-section-number-industry">
                2
            </span>
            <span class="dashboardsettings-section-subtitle dashboardsettings-section-number-industry">
                What industries are you most interested in?
            </span>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </h2>
        <div class="collapsable-container">
            <?php for ( $x = 0 ; $x < count($industryQuestions) ; $x+=3 ): ?>
                <ul class="dashboardsettings-checkboxlist">
                    <?php foreach ( array_slice($industryQuestions, $x, 3) as $industryQuestion ): ?>
                        <li class="dashboardsettings-checkboxlist-li">
                            <input type="checkbox" name="<?php print cssFriendlyString($industryQuestion['label']); ?>" id="<?php print cssFriendlyString($industryQuestion); ?>" class="dashboardsettings-checkbox" <?php print ( $industryQuestion['checked'] ? 'checked="checked"' : '' ); ?> />
                            <label for="<?php print cssFriendlyString($industryQuestion['label']); ?>" class="dashboardsettings-checkboxlabel">
                                <?php print $industryQuestion['label']; ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endfor; ?>
            <div class="dashboardsettings-section-controles-container">
                <input type="submit" value="Apply" />
            </div>
        </div>
    </div>
    
    <div class="dashboardsettings-section dashboardsettings-section-wizards">
        <h2 class="dashboardsettings-section-head dashboardsettings-section-head-wizards expanded">
            <span class="dashboardsettings-section-number dashboardsettings-section-number-wizards">
                3
            </span>
            <span class="dashboardsettings-section-subtitle dashboardsettings-section-number-wizards mobile-never-important">
                Using a streamlined tool, called a "wizard" (which uses a series of relevant prompts, 
                such as business location, size, etc), you can quickly discover what programs, services, 
                etc. are available to you. Please select preferred tile(s) for your home page.
            </span>
            <span class="dashboardsettings-section-subtitle dashboardsettings-section-number-wizards mobile-only-inportant">
                Select your prefered resources and tool tiles.
            </span>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </h2>
        <div class="collapsable-container">
            <div class="mobile-only-inportant">
                Using a streamlined tool, called a "wizard" (which uses a series of relevant prompts, 
                such as business location, size, etc), you can quickly discover what programs, services, 
                etc. are available to you. Please select preferred tile(s) for your home page.
            </div>
            <ul class="dashboardsettings-checkboxlist">
                <?php foreach ( $wizards as $wizard ): ?>
                    <li class="dashboardsettings-checkboxlist-li wizard-selected-<?php print ( $wizard['checked'] ? 'true' : 'false' ); ?> wizard-name-<?php print cssFriendlyString($wizard['title']); ?>">
                        <div class="wizard-icon wizard-iconof-<?php print cssFriendlyString($wizard['title']); ?>">
                            <!-- Use CSS to place the appropriate icon for this wizard here. Refer the the class name in the LI for the checked-value status. /* Coder Bookmark: CB-E1MRU66-BC */ -->
                        </div>
                        <span for="<?php print cssFriendlyString($wizard['field_swimlane_wizurl_value']); ?>" class="dashboardsettings-checkboxlabel">
                            <?php print $wizard['title']; ?>
                        </span>
                        <div class="myusawiz-checkbox-wrapper never-show-ever">
                            <!-- DO NOT REMOVE this checkbox, it is needed for form submission and 508 compliance -->
                            <input type="checkbox" name="<?php print cssFriendlyString($wizard['field_swimlane_wizurl_value']); ?>" id="<?php print cssFriendlyString($wizard['field_swimlane_wizurl_value']); ?>" class="dashboardsettings-checkbox" <?php print ( $wizard['checked'] ? 'checked="checked"' : '' ); ?> />
                        </div>
                        <div class="fake-checked">
                            <!-- This is just a space that looks like a checkbox -->
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="dashboardsettings-section-controles-container">
                <input type="button" value="Reset" onclick="jQuery('.dashboardsettings-mastercontainer input[type=checkbox]:checked').click();" />
                <input type="submit" value="Continue" />
            </div>
        </div>
    </div>
    
</form>