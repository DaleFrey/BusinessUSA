<?php
    /* Pull all "Health Care Business Pulse" articles ( http://www.sba.gov/community/blogs/community-blogs/health-care-business-pulse ) 
    from SBA's RSS feed for these articles */
    $secondsInOneDay = 86400;
    $rssString = call_user_func_cache($secondsInOneDay, 'file_get_contents', 'http://www.sba.gov/community/blog/rss/20371/feed'); // Note: call_user_func_cache defined in FunctionResultCachingSupport.php
    $articles = simplexml_load_string($rssString);
    $articles = json_decode(json_encode($articles), TRUE); // Ensure that all elements (recursively) within $articles are arrays and strings
    $articles = $articles['channel']['item']; // Set $articles to be the array of articles 
?>

<h2 class="sidebar-healthblog-title expanded" onclick="jQuery('.sidebar-healthblog-body').slideToggle(); jQuery('.sidebar-healthblog-title').toggleClass('expanded'); jQuery('.sidebar-healthblog-title').toggleClass('collapsed');">
    Blogs
    <img class="downarrow" src="/sites/all/themes/bizusa/images/downarrow.png" />
    <img class="uparrow" src="/sites/all/themes/bizusa/images/uparrow.png" />
</h2>
<div class="sidebar-healthblog-body">
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
