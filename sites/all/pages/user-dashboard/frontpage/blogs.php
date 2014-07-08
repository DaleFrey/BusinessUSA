
<!-- /* Coder Bookmark: CB-30MHWEY-BC */ -->
<ul class="myusa-blogs-container" rendersource="<?php basename(__FILE__); ?>">
    <?php foreach ( $blogs as $blog ): /* information in the $blogs variable compiled from Coder Bookmark: CB-JNM5B5M-BC */ ?>
        <li class="myusa-blogs-item">
            <img class="myusa-blogs-item-icon" src="<?php print $blog['iconURL']; ?>" rendersource="<?php basename(__FILE__); ?>" srcsource="Coder Bookmark: CB-3S01W05-BC" alt="<?php print $blog['iconAlt']; ?>" />
            <div class="myusa-blogs-item-titlesnippetreadmore">
                <h3 class="myusa-blogs-item-title">
                    <a class="myusa-blogs-item-titlelink" href="<?php print $blog['link']; ?>">
                        <?php print $blog['title']; ?>
                    </a>
                </h3>
                <div class="myusa-blogs-item-snippetreadmore">
                    <span class="myusa-blogs-item-snippet">
                        <?php print $blog['snippet']; ?>
                    </span>
                    <span class="myusa-blogs-item-readmore">
                        <a href="<?php print $blog['link']; ?>">
                            Read More
                        </a>
                    </span>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<a class="myusa-blogs-viewall" href="/blog" rendersource="<?php basename(__FILE__); ?>">
    View All
</a>