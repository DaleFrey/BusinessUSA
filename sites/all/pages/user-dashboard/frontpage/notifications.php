
<div class="notifications-container" rendersource="<?php print basename(__FILE__); ?>">

    <!-- /* Coder Bookmark: CB-7LFP491-BC */ -->
    <div class="notifications-header" rendersource="<?php print basename(__FILE__); ?>">
        <a class="notifications-closeicon" href="javascript: jQuery('.userdashboard-section-subbody-notifications').fadeOut(); void(0);">
            X
        </a>
        <h3>
            <span class="notifications-notecount">
                <?php print count( $notifications ); ?>
            </span>
            <span class="notifications-headingtitle">
                New Notifications
            </span>
        </h3>
    </div>

    <!-- /* Coder Bookmark: CB-KS9RAD6-BC */ -->
    <ul class="notifications-list" rendersource="<?php print basename(__FILE__); ?>">
        <?php foreach ( $notifications as $notification ): ?>
            <li class="notifications-listitem">
                <a class="notifications-listitem-title" href="<?php print $notification['link']; ?>">
                    <?php print $notification['title']; ?>
                </a>
                <div class="notifications-listitem-snippetreadmore">
                    <span class="notifications-listitem-snippet">
                        <?php print $notification['snippet']; ?>
                    </span>
                    <span class="notifications-listitem-readmore">
                        <a class="notifications-listitem-readmore-anchor" href="<?php print $notification['link']; ?>">
                            Read More
                        </a>
                    </span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>