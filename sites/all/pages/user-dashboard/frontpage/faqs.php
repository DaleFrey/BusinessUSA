
<div class="userdashboard-faqs-container" rendersource="<?php print basename(__FILE__); ?>">
    <?php for ( $x = 0 ; $x < count($faqs) ; $x+=4 ): ?>
        <ul class="userdashboard-faqs-row" rendersource="<?php print basename(__FILE__); ?>">
            <?php foreach ( array_slice($faqs, $x, 4) as $faq ): ?>
                <li class="userdashboard-faqs-item">
                    <a class="userdashboard-faqs-item-link" href="<?php print $faq['url']; ?>">
                        <?php print $faq['title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endfor; ?>
</div>

<a class="userdashboard-faqs-viewall" href="http://help.businessusa.gov/ics/support/KBSplash.asp" rendersource="<?php print basename(__FILE__); ?>">
    View All
</a>