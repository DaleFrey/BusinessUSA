<?php /*

    [!!] WARNING [!!]
    
    Due to Akamai caching, we should always append uid=<DrupalUserId> to the request for this page, 
    and may want to add an additional URL query parameter, something like 
    ?bypassAkamaiCache=<RandomString> to bypass the Akamai cache for this page reuqest.

    [--] FILES [--]
    
    frontpage.page.inc - Executed FIRST, variable and processing is done in here
    frontpage.page.php - Rendered SECOND, renders the HTML for this page
    frontpage.page.less - Used by the browser for theming purposes. I will hack this .less file to also be used by the front page 

    [--] IMPLEMENTATION [--]
    
    When this is ready, the actual front page of BusinessUSA will load the contents of 
    this page (from the URL of <site>/user-dashboard/frontpage?uid=1 ) though AJAX
    and inject the HTML this file generates into the front page.
    
    Every user that can authenticate with MyUSA and log into our Drupal application should have 
    their own Drupal user account. We still store information about users in Drupal user fields.
    Fields for Drupal users can be mamanged from the URL of: <site>/admin/config/people/accounts/fields
    
    
    [--] EXPECTATIONS [--]
    
    The URL of <site>/user-dashboard/frontpage expects to be given a [Drupal] user-id
    in the URL query, like this: ?uid=1 

*/

?>

<div class="userdashboard-mastercontainer drupal-usder-id-<?php print $userInfo->uid; ?>" rendersource="<?php print basename(__FILE__); ?>">

    <h1 class="welcome-header">
        <span>Hello <?php print $userInfo->field_myusa_firstname['und'][0]['value']; ?>!</span> Welcome back to your own personal domain!
    </h1>

    <!-- START - [Non-Mobile] Tiles Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-tiles synch-height synch-height-butnotinmobile mobile-never" synchheightgroup="1">
        <div class="userdashboard-section-titlebar">
            <h2 class="userdashboard-section-titlebar-title">
                Saved Resources & Tools
            </h2>
            <div class="userdashboard-section-titlebar-widget">
                <a href="/user-dashboard/usersettings?uid=<?php print $_GET['uid']; ?>">
                    Add a Tile
                </a>
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" rendersource="<?php print basename(__FILE__); ?>">
            <?php include(overridable('sites/all/pages/user-dashboard/frontpage/my-business-usa-tiles.php')); ?>
        </div>
    </div>
    
    <!-- START - Support (Parature) Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-support synch-height synch-height-butnotinmobile" synchheightgroup="1">
        <div class="userdashboard-section-titlebar expanded">
            <h2 class="userdashboard-section-titlebar-title">
                Support
            </h2>
            <div class="userdashboard-section-titlebar-widget notificationsbell-container mobile-never" style="display: none;">
                <a href="javascript: jQuery('.userdashboard-section-subbody-notifications').fadeToggle(); void(0);" class="notificationsbell-bell">
                    Notifications
                    <span class="notificationsbell-count">
                        7
                    </span>
                </a>
            </div>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" rendersource="<?php print basename(__FILE__); ?>">
            <div class="userdashboard-section-subbody userdashboard-section-subbody-notifications" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
                <?php include(overridable('sites/all/pages/user-dashboard/frontpage/notifications.php')); ?>
            </div>
            <div class="userdashboard-section-subbody userdashboard-section-subbody-support" rendersource="<?php print basename(__FILE__); ?>">
                <?php include(overridable('sites/all/pages/user-dashboard/frontpage/support.php')); ?>
            </div>
        </div>
    </div>
    
    <!-- START - [Mobile Only] Notifications Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-notifications mobile-only">
        <div class="userdashboard-section-titlebar expanded">
            <h2 class="userdashboard-section-titlebar-title">
                Notifications
            </h2>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" rendersource="<?php print basename(__FILE__); ?>">
            <div class="userdashboard-section-subbody userdashboard-section-subbody-notifications" rendersource="<?php print basename(__FILE__); ?>">
                <?php include(overridable('sites/all/pages/user-dashboard/frontpage/notifications.php')); ?>
            </div>
        </div>
    </div>
    
    <!-- START - [Mobile Only] Tiles Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-tiles mobile-only">
        <div class="userdashboard-section-titlebar expanded">
            <h2 class="userdashboard-section-titlebar-title">
                Saved Resources & Tools
            </h2>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" rendersource="<?php print basename(__FILE__); ?>">
            <?php include(overridable('sites/all/pages/user-dashboard/frontpage/my-business-usa-tiles.php')); ?>
        </div>
    </div>
    
    <!-- START - Programs and Services Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-progserv synch-height synch-height-butnotinmobile" synchheightgroup="2">
        <div class="userdashboard-section-titlebar collapsed">
            <h2 class="userdashboard-section-titlebar-title">
                Programs and Services
            </h2>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
            <?php include(overridable('sites/all/pages/user-dashboard/frontpage/programs-and-services.php')); ?>
        </div>
    </div>

    <!-- START - Recent Searches Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-searches synch-height synch-height-butnotinmobile" synchheightgroup="2">
        <div class="userdashboard-section-titlebar collapsed">
            <h2 class="userdashboard-section-titlebar-title">
                Recent Searches
            </h2>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
            <?php include(overridable('sites/all/pages/user-dashboard/frontpage/recent-searches.php')); ?>
        </div>
    </div>
    
    <!-- START - Resources and Events Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-resevents synch-height synch-height-butnotinmobile" synchheightgroup="3">
        <div class="userdashboard-section-titlebar collapsed">
            <h2 class="userdashboard-section-titlebar-title">
                Resources and Events in your Area
            </h2>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
            <div class="zipSearch mobile-never" rendersource="<?php print basename(__FILE__); ?>">
                <a class="toggleControl" id="mapView" href="#map-canvas">view map</a>
                <a class="toggleControl" id="listView" href="#locationsList">view list</a>

                <input type="textbox" value="<?php print strval($userZipCode); ?>" class="<?php print ( intval($userZipCode) !== 0 ? '' : 'auto-fill-zip-code ' ); ?>resevents-titlebar-controle resevents-titlebar-controle-zipcode" />
                <input type="button" value="Go" class="resevents-titlebar-controle resevents-titlebar-controle-go" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
            <?php include(overridable('sites/all/pages/user-dashboard/frontpage/resources-and-events.php')); ?>
        </div>
    </div>
    
    <!-- START - Blog Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-blog synch-height synch-height-butnotinmobile" synchheightgroup="3">
        <div class="userdashboard-section-titlebar collapsed">
            <h2 class="userdashboard-section-titlebar-title">
                Blog
            </h2>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
            <?php include(overridable('sites/all/pages/user-dashboard/frontpage/blogs.php')); ?>
        </div>
    </div>
    
    <!-- START - FAQ Area  -->
    <div class="userdashboard-section-container userdashboard-section-container-faq">
        <div class="userdashboard-section-titlebar collapsed">
            <h2 class="userdashboard-section-titlebar-title">
                FAQ's
            </h2>
            <div class="expandcollapse-container mobile-only">
                <img class="expanded-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-expanded.png" />
                <img class="collapsed-icon" src="http://business.usa.gov/sites/all/themes/bizusa/images/icons/block-collapsed.png" />
            </div>
        </div>
        <div class="userdashboard-section-body nonmobile-forceshow-important" style="display: none;" rendersource="<?php print basename(__FILE__); ?>">
            <?php include(overridable('sites/all/pages/user-dashboard/frontpage/faqs.php')); ?>
        </div>
    </div>
    
</div>