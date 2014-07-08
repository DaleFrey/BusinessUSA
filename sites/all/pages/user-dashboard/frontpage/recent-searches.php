
<?php if ( count($userPastSearches) === 0 ): ?>
    <div class="pastsearches-noresults-msg" rendersource="<?php print basename(__FILE__); ?>">
        You have not made any searches while logged in yet. Please feel free to 
        <a href="/search/site/">search our site</a> for content. When you do, we 
        will track these searches for you, and notify you of any new content 
        related to past searches here.
    </div>
<?php else: ?>
    <ul class="pastsearches-list" rendersource="<?php print basename(__FILE__); ?>">
        <?php foreach( array_slice($userPastSearches, 0, 10) as $userPastSearch ): /* Data generated from Coder Bookmark: CB-05G7D8Q-BC */ ?>
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
    <?php if ( count($userPastSearches) > 4 ): ?>
        <a href="/user-dashboard/all-recent-searches?uid=<?php print $userInfo->uid; ?>" rendersource="<?php print basename(__FILE__); ?>">
            View All
        </a>
    <?php endif; ?>
<?php endif; ?>