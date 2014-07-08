<?php if ( time() < mktime(14, 0, 0, 5, 29, 2014) ) { ?>
    <!-- The following markup is generated from <?php print __FILE__; ?> -->
    <div class="wizard-sidebarresults wizard-sidebarresults-healthcare wizard-sidebarresults-healthcare-upcomingevents" rendersource="<?php print basename(__FILE__); ?>">
        <div class="wizard-health-sidebar-top-section">
            <div class="wizard-health-sidebar-markericon-container">
                <img src="/sites/all/themes/bizusa/images/wizard-images/lenders-icon.png" alt=""  />
            </div>
            <div class="wizard-health-sidebar-title" >
                Upcoming Events
            </div>
        </div>
        <div class="wizard-sidebarresults-results-container" style="text-align: center;">
            <ul>
                <li>
                    <a target="_blank" href="https://www.youtube.com/watch?v=FKMrBY--kSE&list=PLrwM1ZVcvDha2z8kvYx_wuW3uQxy58BEZ">
                        ACA Audio Webinar
                    </a>
                </li>
                
                <?php
                    $webinars = array(
                        mktime(14, 0, 0, 3, 13, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=sp3isdia8bh7',
                        mktime(14, 0, 0, 3, 20, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=31v2fjflsi54',
                        mktime(14, 0, 0, 3, 27, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=s8ny7a63qbz8',
                        mktime(14, 0, 0, 4, 3, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=czrsz4tt68ic',
                        mktime(14, 0, 0, 4, 10, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=m14d2xolejzy',
                        mktime(14, 0, 0, 4, 17, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=68q7rdn9pc7g',
                        mktime(14, 0, 0, 4, 24, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=tsbleoektflf',
                        mktime(14, 0, 0, 5, 1, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=punmxu0616lk',
                        mktime(14, 0, 0, 5, 8, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=v3xb04h0uqm4',
                        mktime(14, 0, 0, 5, 15, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=f1q4aa7tyvy5',
                        mktime(14, 0, 0, 5, 22, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=4udpyzo6nf3s',
                        mktime(14, 0, 0, 5, 29, 2014) => 'https://cc.readytalk.com/cc/s/registrations/new?cid=iw4z24ep9qj4'
                    );
                ?>
                <?php if ( time() < mktime(14, 0, 0, 5, 29, 2014) ) { ?>
                
                    <?php $forCounter = 0; ?>
                    <?php foreach ( $webinars as $webinarUnixTime => $webinarLink ) { ?>
                    
                        <?php if ( time() < $webinarUnixTime ) { ?>

                            <li class="<?php if ( $forCounter > 2 ) { print 'hidemoreresults'; } ?>">
                                <a href="<?php print $webinarLink; ?>">
                                    Affordable Care Act 101 Webinar - <?php print date('M jS', $webinarUnixTime); ?>
                                </a>
                            </li>
                            
                            <?php $forCounter++; ?>
                            
                        <?php } ?>
                        
                    <?php } ?>
                    
                    <li class="viewmore-healthcare"><a href='javascript:void(0)'><span>View More</span></a></li>
                    
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>

<script>
$(".viewmore-healthcare").click(function(){
	$(this).siblings().toggleClass("hidemoreresults showmoreresults");
	var span = jQuery(this).find('span').text();
		if(span == "View More"){
			jQuery(this).find('span').text("View Less");
		}
		else{
			jQuery(this).find('span').text("View More");
		}
	});

</script>