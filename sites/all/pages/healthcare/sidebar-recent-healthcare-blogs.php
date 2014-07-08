<!-- The following markup is generated from <?php print basename(__FILE__); ?> -->
<div class="wizard-sidebarresults wizard-sidebarresults-healthcare wizard-sidebarresults-recenthealthcareblogs" rendersource="<?php print basename(__FILE__); ?>">
    <div class="wizard-health-sidebar-top-section">
        <div class="wizard-health-sidebar-markericon-container">
            <img src="/sites/all/themes/bizusa/images/wizard-images/lenders-icon.png" alt=""  />
        </div>
        <div class="wizard-health-sidebar-title" >
            Blogs
        </div>
    </div>
    <div class="wizard-sidebarresults-results-container" style="text-align: center;">
        <?php
            /* Pull all "Health Care Business Pulse" articles ( http://www.sba.gov/community/blogs/community-blogs/health-care-business-pulse ) 
            from SBA's RSS feed for these articles */
            $secondsInOneDay = 86400;
            $rssString = call_user_func_cache($secondsInOneDay, 'file_get_contents', 'http://www.sba.gov/community/blog/rss/20371/feed'); // Note: call_user_func_cache defined in FunctionResultCachingSupport.php
            $articles = simplexml_load_string($rssString);
            $articles = json_decode(json_encode($articles), TRUE); // Ensure that all elements (recursively) within $articles are arrays and strings
            $articles = $articles['channel']['item']; // Set $articles to be the array of articles 
        ?>
        <ul>
            <?php foreach ( $articles as $index => $article ) { ?>
                <?php if ( $index > 4 ) { break; } ?>
                <li><a target="_blank" href="<?php print $article['link'] ?>"><?php print $article['title'] ?></a></lI>
            <?php } ?>
        </ul>
        <div class="wizard-sidebarresults-healthcare-viewmoreblogs">
            <div class="wizard-sidebarresults-healthcare-viewmoreblogs">
                <a target="_blank" class="ext" href="http://www.sba.gov/community/blogs/community-blogs/health-care-business-pulse">View More</a>
            </div>
        </div>
    </div>
</div>