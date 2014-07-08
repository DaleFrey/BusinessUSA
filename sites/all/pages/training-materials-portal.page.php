<?php
$items= array(
    array(
        "href"=>"/training-materials/online training/",
        "img"=>"/sites/all/themes/bizusa/images/training/portal-onlinetraining.png",
        "text"=>"Online Training"
    ),
    array(
        "href"=>"/training-materials/video/",
        "img"=>"/sites/all/themes/bizusa/images/training/portal-video.png",
        "text"=>"Videos"
    ),
    array(
        "href"=>"/training-materials/chat/",
        "img"=>"/sites/all/themes/bizusa/images/training/portal-chat.png",
        "text"=>"Chat Sessions"
    ),
);
?>

<div id="training-materials-portal-page">
    <p class="training-materials-message">BusinessUSA's Training Portal provides nearly 200 online classes, videos, and chat transcripts from Federal resources to guide emerging entrepreneurs and exporters through the basics of starting and managing a business.  The content spans all phases of starting and managing a business from registration to financing to tax compliance.  Below, there are more ways to seek out assistance online, on the phone, or in-person.</p>
    <div class="training-materials-main-links-container">
        <?php foreach($items as $item): ?>
            <a href="<?php echo $item['href'];?>" class="main-links-item">
                <img src="<?php echo $item['img'];?>" alt="<?php echo $item['text'];?>">
                <p><?php echo $item['text'];?></p>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="view-all"><a href="/training-materials/">View All</a></div>
</div>
<div class="training-materials-portal-dualarea">
    <div class="dualarea-left">
        <div class="dualarea-title">
            <img src="/sites/all/themes/bizusa/images/training/portal-gethelp.png" alt="">
            <p>Get Help Now</p>
        </div>
        <ul>
            <li><a href="http://help.business.usa.gov/ics/support/ticketnewwizard.asp?style=classic&deptID=30030&">Ask A Question</a></li>
            <li><a href="http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic&feedback=true">Give Feedback</a></li>
            <li><a href="javascript: // 1-800-333-4636">1-800-FED-INFO</a></li>
            <li><a href="http://help.business.usa.gov/ics/support/kbsplash.asp?deptID=30030&task=knowledge">Browse Knowledgebase</a></li>
        </ul>
    </div>
    <div class="dualarea-right">
        <div class="right-message">
            Please enter your zip code to locate the closest resource centers near you and connect with them
        </div>
        <h2 class="resevents-titlebar-title">
            Locate Closest Resources &amp; Events
        </h2>
        <form action="request-appointment-and-closest-resource-centers" class="training-zipSearch">
            <input type="textbox" placeholder="Enter your Zipcode" value="" name="zip" class="training-zip-input auto-fill-zip-code resevents-titlebar-controle resevents-titlebar-controle-zipcode">
            <input type="submit" value="Go" class="resevents-titlebar-controle resevents-titlebar-controle-go">
            <a class="toggleControl" id="mapView" href="#map-canvas">view map</a>
            <a class="toggleControl" id="listView" href="#locationsList" style="display: none;">view list</a>
        </form>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery(document).on("submit",".training-zipSearch",function(e){
            var submit_val = jQuery(this).children(".training-zip-input").val();
            if(submit_val){
                return true;
            }
            return false;
        });
    });
</script>
