
<?php /* dsm($progsAndServices); */ ?>
<?php for ( $x = 0 ; $x < count($progsAndServices) ; $x+=3 ): ?>
    <ul class="progsserv-list progsserv-list-less" rendersource="<?php print basename(__FILE__); ?>">
        <?php foreach ( array_slice($progsAndServices, $x, 3) as $index => $entryInfo ): /* Data generated from Coder Bookmark: CB-PED6TKA-BC */ ?>
            <li class="progsserv-listitem progsserv-listitem-index-<?php print $index; ?>">
                <img class="progsserv-icon" src="<?php print $entryInfo['iconurl']; ?>" />
                <div class="progsserv-titleandsnippet">
                    <a class="progsserv-title" href="<?php print $entryInfo['link']; ?>">
                        <?php print $entryInfo['title']; ?>
                    </a>
                    <span class="progsserv-snippet-container">
                        <span class="progsserv-snippet-snippet">
                            <?php print $entryInfo['snippet']; ?>
                        </span>
                        <span class="progsserv-snippet-spacer">
                            &nbsp;
                        </span>
                        <a class="progsserv-snippet-readmore" href="<?php print $entryInfo['link']; ?>">
                            Read More
                        </a>
                    </span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endfor; ?>

<a href="<?php print $progsAndServicesViewAllURL; ?>" class="progsserv-all">
    View All
</a>