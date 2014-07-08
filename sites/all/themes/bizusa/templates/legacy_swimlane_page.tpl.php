
<div class="legacyswimlane-mastercontainer" rendersource="<?php print __FILE__; ?>">
    <div class="legacyswimlane-bodycontainer">

        <?php //dpm($variables["subnav_header_links"]); ?>
        <div class="subnav-container">
            <ul>
                <li class="subnav-header" style="display:fixed;">Related Wizards</li>
                <?php
                //pull link overrides from requested sites/all/pages page, else show default
                if($variables["subnav_header_links"]):
                    $count = 0;
                    foreach($variables["subnav_header_links"] as $link_arr):
                        $class="odd";
                        if($count%2==1){
                            $class="even";
                        }
                    ?>
                        <li class="<?php echo $class;?>"><a href="<?php echo $link_arr['link'];?>" title="<?php echo $link_arr['text'];?>"><?php echo $link_arr['text'];?></a></li>
                <?php
                        $count++;
                    endforeach;
                else: ?>
                <li class="odd">
                    <a href="/resource/grow-your-business">
                        Grow Business
                    </a>
                </li>
                <li class="even">
                    <a href="/access-financing">
                        Access Financing
                    </a>
                </li>
                <li class="odd">
                    <a href="/export">
                        Explore Exporting
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </div>

        <?php foreach ( $variables['sections'] as $section ): ?>
            <div class="legacyswimlane-section">
                <h2>
                    <?php print $section['title']; ?>
                </h2>
                <ul class="legacyswimlane-blocks-container">
                <?php $counter = 0; ?>
                <?php foreach ( $section['blocks'] as $block ): ?>
                <?php $oddEven = ($counter % 2) ? 'even' : 'odd'; ?>
                    <li class="legacyswimlane-block <?php echo $oddEven; ?>">
                        <div class="page-featured-top">
    						<h3 class="legacyswimlane-block-linkedtitle">
    							<a class="" href="<?php print $block['url']; ?>">
    								<?php print $block['title']; ?>
    							</a>
    						</h3>
    						<br/>
    						<span class="legacyswimlane-block-snippet">
    							<?php print $block['snippet']; ?>
    						</span>
    					</div>
                    </li>
                <?php $counter++; ?>
                <?php endforeach; ?>
                </ul>
                <?php if($section['url']): ?>
                <div class="swimlane-morelink-container">
    				<a href="<?php print $section['url']; ?>" class="swimlane-morelink-link ">
    					See More
    				</a>
    			</div>
                <?php endif;?>
            </div>
        <?php endforeach; ?>
    
    </div>

    <div class="legacyswimlane-foot-container">
        <?php if ( !empty($variables['foot']) ): ?>
            <h2>
                <?php print $variables['foot']['title']; ?>
            </h2>
            <ul class="legacyswimlane-foot-blocks-container blocks-count-<?php print count($variables['foot']['blocks']); ?>">
                <?php foreach ( $variables['foot']['blocks'] as $block ): ?>
                    <li class="legacyswimlane-foot-block">
                        <img src="<?php print $block['img']; ?>" />
                        <a href="<?php print $block['url']; ?>">
                            <?php print $block['title']; ?>
                        </a>
                   </li> 
                <?php endforeach; ?>
            <ul>
        <?php endif; ?>
    <div>

</div>