<?php
    
    // Page configuration
    $itemsPerPage = 25;
    
    // Verify certain that certain fields (in the database) exist
    $fieldsThatShouldExists = array('field_myusa_ownership', 'field_myusa_industry', 'field_myusa_tiles', 'field_usr_past_searches');
    foreach ( $fieldsThatShouldExists as $fieldsThatShouldExist ) {
        if ( is_null(field_info_field($fieldsThatShouldExist)) ) {
            while (@ob_end_clean());
            print "Error - The {$fieldsThatShouldExist} field does not exists in this database. Please make sure all the fields found in QA at http://qa.business.usa.reisys.com/admin/config/people/accounts/fields exist within this environment.";
            exit();
        }
    }
    
    // Load user information
    if ( empty($_GET['uid']) || intval($_GET['uid']) === 0 ) {
        while(@ob_end_clean());
        exit('Error - Missing uid parameter in URL-query');
    }
    $uid = intval($_GET['uid']);
    $userInfo = user_load(intval($_GET['uid']));
    //dsm( $userInfo );
    
    // Determine which page we are on in pagination
    if ( !empty($_GET['page']) && intval($_GET['page']) !==0 ) {
        $page = intval($_GET['page']);
    } else {
        $page = 1;
    }
    
    $lastMyUsaAuth = intval( $userInfo->field_myusa_last_auth['und'][0]['value'] );
    // Note: The getUserPastSearches() function is defined in UserDashboard-PastSearchesSupport.php
    $userPastSearches = getUserPastSearches($uid, $lastMyUsaAuth, ($page - 1) * $itemsPerPage, $itemsPerPage);
    //dsm( $userPastSearches );
    
    // Bug killer - Do not show wild-card searches, and replace %20 with spaces
    foreach ( $userPastSearches as $index => $userPastSearch ) {
        $userPastSearches[$index]['search-term'] = str_replace('%20', ' ', $userPastSearches[$index]['search-term']);
        if ( $userPastSearch['search-term'] === '%2A' || $userPastSearch['search-term'] === '*' ) {
            unset($userPastSearches[$index]);
        }
    }
    
    // Determine pager status
    $currentPage = $page;
    $maxPageCount = ceil( count($userInfo->field_usr_past_searches['und']) / $itemsPerPage );
    
?>

<h1 class="welcome-header">
    <span>Hello <?php print $userInfo->field_myusa_firstname['und'][0]['value']; ?>!</span> Welcome back to your own personal domain!
</h1>

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
    <div class="userdashboard-section-body" rendersource="<?php print basename(__FILE__); ?>">

        <!-- /* Coder Bookmark: CB-YJ67Y4D-BC */ -->
        <div class="pastsearches-container" rendersource="<?php print basename(__FILE__); ?>">
            <ul class="pastsearches-list">
                <?php foreach ( $userPastSearches as $userPastSearch ): ?>
                    <li class="pastsearches-listitem">
                        <span class="pastsearches-searchterm">
                            <a class="pastsearches-searchterm-link" href="<?php print $userPastSearch['search-url']; ?>">
                                <?php print $userPastSearch['search-term']; ?>
                            </a>
                        </span>
                        <span class="pastsearches-newcount">
                            <?php print ( intval($userPastSearch['new-count']) > 99 ? '+' : $userPastSearch['new-count'] ); ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- /* Coder Bookmark: CB-PLL9TLT-BC */ -->
        <?php if ( $maxPageCount > 1 ): ?>
            <div class="item-list" rendersource="<?php print basename(__FILE__); ?>">
                <ul class="pager">
                
                    <?php if ( $currentPage > 1 ): ?>
                        <li class="pager-first first">
                            <a title="Go to first page" href="?uid=<?php print $_GET['uid']; ?>&page=1">&#171; first</a>
                        </li>
                        <li class="pager-previous">
                            <a title="Go to previous page" href="?uid=<?php print $_GET['uid']; ?>&page=<?php print $page - 1; ?>">‹ previous</a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for ( $p = 1 ; $p < $currentPage ; $p++ ): ?>
                        <li class="pager-item">
                            <a title="Go to page <?php print $p; ?>" href="?uid=<?php print $_GET['uid']; ?>&page=<?php print $p; ?>">
                                <?php print $p; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="pager-current first">
                        <?php print $currentPage; ?>
                    </li>
                    <?php for ( $p = $currentPage+1 ; $p < $maxPageCount ; $p++ ): ?>
                        <li class="pager-item">
                            <a title="Go to page <?php print $p; ?>" href="?uid=<?php print $_GET['uid']; ?>&page=<?php print $p; ?>">
                                <?php print $p; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    
                    <?php if ( $currentPage != $maxPageCount ): ?>
                        <li class="pager-next">
                            <a title="Go to next page" href="?uid=<?php print $_GET['uid']; ?>&page=<?php print $page + 1; ?>">next ›</a>
                        </li>
                        <li class="pager-last last">
                            <a title="Go to last page" href="?uid=<?php print $_GET['uid']; ?>&page=<?php print $maxPageCount; ?>">last &#187;</a>
                        </li>
                    <?php endif; ?>
                    
                </ul>
            </div>
        <?php endif; ?>
    
    </div>
</div>
<script>
    jQuery( document ).ready(function() {
        setTimeout(function(){

            var pagerWidth = jQuery('.pager').width();
            jQuery('.pager').css({
               width : pagerWidth,
               margin : '0px auto',
               float: 'none'
            });

        }, 100);

    });
</script>
