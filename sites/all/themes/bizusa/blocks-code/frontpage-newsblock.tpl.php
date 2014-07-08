<?php
    /*
        Despite this files extension, it is involved from within a block. 
        This file contains the HTML/PHP code for the "front_page_news_block" block
    */
?>

<!-- The following div is generated from frontpage-newsblock.tpl.php -->
<div id="carousel" rendersource="frontpage-newsblock.tpl.php" xmlns="http://www.w3.org/1999/html">
    <ul class="slider">
    
        <li class="item slide1 frontpagenews-container-featured-item">
            <h2 class="block-title frontpagenews-titles-title frontpagenews-titles-title-featured-item">
                Featured Item
            </h2>

            <?php print views_embed_view('front_page_news_views', 'featured_item'); ?>
        </li>
    
        <li class="item slide2 frontpagenews-container-businessnews">
            <h2 class="block-title frontpagenews-titles-title frontpagenews-titles-title-businessnews">
                <a href="/business-news">Business News</a>
            </h2>

            <?php print views_embed_view('front_page_news_views', 'business_news'); ?>
        </li>

        <li class="item slide3 frontpagenews-container-whats-new">
            <h2 class="block-title frontpagenews-titles-title frontpagenews-titles-title-whats-new">
                <a href="/whats-new">What&#39;s New</a>
            </h2>

            <?php print views_embed_view('front_page_news_views', 'whats_new'); ?>
        </li>
        
        <li class="item slide4 frontpagenews-container-quick-facts">
            <h2 class="block-title frontpagenews-titles-title frontpagenews-titles-title-quick-facts">
                <a href="/quick-facts">Quick Facts</a>
            </h2>

            <?php print views_embed_view('front_page_news_views', 'quick_facts'); ?>
        </li>

    </ul>   
</div>
