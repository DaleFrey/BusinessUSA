<?php
    
    $slideshows = array();
    
    $slideshows[] = array(
        array(
            "left-title" => "What's BusinessUSA?",
            "description" => "BusinessUSA makes it easier for small businesses and exporters to discover opportunities, connect with the right resources, and help them grow and hire.",
            "slide-title" => "Visiting the Site",
            "snippet" => "Get familiar with BusinessUSA's front page",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/1a.jpg"
        ),
        array(
            "left-title" => "What's BusinessUSA?",
            "description" => "BusinessUSA makes it easier for small businesses and exporters to discover opportunities, connect with the right resources, and help them grow and hire.",
            "slide-title" => "Search for Resources",
            "snippet" => "Use our search to find resources across all levels of government.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/1b.jpg"
        ),
        array(
            "left-title" => "What's BusinessUSA?",
            "description" => "BusinessUSA makes it easier for small businesses and exporters to discover opportunities, connect with the right resources, and help them grow and hire.",
            "slide-title" => "Get Immediate Help!",
            "snippet" => "Find further assistance using the icons at the right... Call, Email, or Chat.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/1c.jpg"
        ),
        array(
            "left-title" => "What's BusinessUSA?",
            "description" => "BusinessUSA makes it easier for small businesses and exporters to discover opportunities, connect with the right resources, and help them grow and hire.",
            "slide-title" => "Browse Your Needs",
            "snippet" => "Get your needs answered.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/1d.jpg"
        )
    );
    $slideshows[] = array(
        array(
            "left-title" => "Built For Your Business Needs",
            "description" => "The tiles on the front page are designed to give the most relevant results based on a few simple questions.  Each tile is designed around  a specific business need.",
            "slide-title" => "Pick a Tile",
            "snippet" => "Find the tiles most similar to your business need.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/2a.jpg"
        ),
        array(
            "left-title" => "Built For Your Business Needs",
            "description" => "The tiles on the front page are designed to give the most relevant results based on a few simple questions.  Each tile is designed around  a specific business need.",
            "slide-title" => "Answer Questions",
            "snippet" => "We'll ask you a few simple questions about your business.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/2b.jpg"
        ),
        array(
            "left-title" => "Built For Your Business Needs",
            "description" => "The tiles on the front page are designed to give the most relevant results based on a few simple questions.  Each tile is designed around  a specific business need.",
            "slide-title" => "Get Results",
            "snippet" => "Get relevant results for you and your business.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/2c.jpg"
        ),
        array(
            "left-title" => "Built For Your Business Needs",
            "description" => "The tiles on the front page are designed to give the most relevant results based on a few simple questions.  Each tile is designed around  a specific business need.",
            "slide-title" => "Save Results for Later.",
            "snippet" => "Try the <a href=\"/healthcare\">Healthcare Wizard</a>, now!",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/2d.jpg"
        )
    );
    $slideshows[] = array(
        array(
            "left-title" => "Find Resources in Your Area",
            "description" => "Search, track, and register for resource centers, events, and programs in your area.",
            "slide-title" => "Plug in Your Zip Code",
            "snippet" => "Zoom in on resources in your area.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/3a.jpg"
        ),
        array(
            "left-title" => "Find Resources in Your Area",
            "description" => "Search, track, and register for resource centers, events, and programs in your area.",
            "slide-title" => "Find Resources ",
            "snippet" => "Look for resource centers, events, and programs around you.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/3b.jpg"
        ),
        array(
            "left-title" => "Find Resources in Your Area",
            "description" => "Search, track, and register for resource centers, events, and programs in your area.",
            "slide-title" => "Request an Appointment",
            "snippet" => "Email the location nearest you to schedule an in-person meeting.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/3c.jpg"
        ),
        array(
            "left-title" => "Find Resources in Your Area",
            "description" => "Search, track, and register for resource centers, events, and programs in your area.",
            "slide-title" => "Attend Local Events",
            "snippet" => "Register for events targeted for your business needs near you.",
            "slide-img-src" => "/sites/all/themes/bizusa/images/tourImgs/3d.jpg"
        )
    );
    
    /* Expose the php-variable tourSlides to a JavaScript variable */
    $jsonSlideshows = json_encode($slideshows);
    print "<script> jsonSlideshows = " . $jsonSlideshows . "; </script>";
    
    if ( strpos(request_uri(), '-DEBUG-') !== false ) {
        dsm(
            array(
                'slideshows' => $slideshows,
                'jsonSlideshows' => $jsonSlideshows
            )
        );
    }
?>

<style>
    /* START: BUSA Tour */
    h1#page-title{display:none;}
        .busaalltours-mastercontainer{
            background: #fff url("/sites/all/themes/bizusa/images/tourLineLeftBg.png") repeat-y scroll 58px 12px;
            float:left;
            clear:both;
            width:880px;
            padding:40px;
        }
        .busatour-mastercontainer {
            background: url("/sites/all/themes/bizusa/images/tourLineLeft.png") no-repeat scroll 18px 12px;
            float:left;
            clear:both;
            width:100%;
        }
        .busatour-mastercontainer:first-child{
            background: #fff url("/sites/all/themes/bizusa/images/tourLineLeft.png") no-repeat scroll 18px 12px;
        }
        .busatour-leftarea-title{
            font: 25px 'Bitter-Bold',Times,serif;
            margin-bottom:20px;
        }
        .busatour-leftarea {
            width: 33%;
            float: left;
            
        }
        .busatour-leftarea-title,
        .busatour-leftarea-text{
            padding:0px 50px 0px 55px;
        }
        .busatour-leftarea-text{line-height:25px;}
        .busatour-slideshowarea {
            width: 66%;
            float: right;
            background-color: #ebebeb;
            border:1px solid #cfcfcf;
        }
        .busatour-slideshowarea-steps-container{
            width:80%;
            margin:0px auto 25px auto;
        }

        .busatour-slideshowarea-slide-container {
            display: none;
        }
        .busatour-slideshowarea-slide-container.active {
            display: block;
        }
        .busatour-slideshowarea-steps-container {

        }
        .busatour-slideshowarea-step-container {
            float: left;
            width: 25%;
        }
        .busatour-slideshowarea-step-text {
            text-align: center;
            cursor: pointer;
        }
        .busatour-slideshowarea-step-text input {
            background: none;
            background-color: #bbbbbb;
            text-shadow: none;
            color: white;
            border: none;
            width: 100%;
            height:72px;
            border-left:1px solid #ebebeb;
            font-size:12px;
            white-space:normal;
        }
        .busatour-slideshowarea-step-container-0 .busatour-slideshowarea-step-text input{
            border:none;
            white-space:normal;
        }
        .active .busatour-slideshowarea-step-text input {background-color:#0c5679;}
        
        /* START: Middle area (slides, images) */
            .busatour-slideshowarea-slide-container img {
                border:1px solid #cfcfcf;
                width:73%;
            }
            .busatour-slideshowarea-slide-container {
                text-align: center;
            }
        /* END: Middle area (slides, images) */
        
        /* START: Controle area (prev/next buttons, and subtitle-text in center) */
            .busatour-slideshowarea-controles-container {
                background-color: #bcbcbc;
                height:60px;
                margin-top:32px;
            }
            .busatour-slideshowarea-controles-back, 
            .busatour-slideshowarea-controles-next {
                float: left;
                width: 22%;
            }
            .busatour-slideshowarea-controles-text{
                float:left;
                width:56%;
                padding-top:20px;
                color:#0C5679;
            }
            .busatour-slideshowarea-controles-text {
                text-align: center;
            }
            .busatour-slideshowarea-controles-text a{
                text-decoration:underline;
            }
            .busatour-slideshowarea-controles-next-btn {
                float: right;
                padding-right: 25%;
            }
            .busatour-slideshowarea-controles-back-btn {
                float: left;
                padding-left: 25%;
            }
            .busatour-slideshowarea-controles-back input {
                background: none;
                background-image: url('/sites/all/themes/bizusa/images/tour-back-button.png');
                background-size: 100%;
                height: 50px;
                background-repeat: no-repeat;
                width: 50px;
                border: none;
                margin-top:5px;
            }
            .currentslide-id-0 .busatour-slideshowarea-controles-back input{visibility: hidden;}
            .busatour-slideshowarea-controles-next-btn input {
                background: none;
                background-image: url('/sites/all/themes/bizusa/images/tour-back-next.png');
                background-size: 100%;
                height: 50px;
                background-repeat: no-repeat;
                width: 50px;
                border: none;
                margin-top:5px;
            }
            .currentslide-id-3  .busatour-slideshowarea-controles-next-btn input{visibility: hidden;}
        /* END: Controle area (prev/next buttons, and subtitle-text in center) */
        
        .busatour-postmastercontainer-spacer {
            height: 100px;
            float:left;
            clear:both;
            width:100%;
        }
        
    /* END: BUSA Tour */
</style>

<div class="busaalltours-mastercontainer">
    <?php foreach ( $slideshows as $slideshowIndex => $slideshow ) { ?>
        <div class="busatour-mastercontainer busatour-mastercontainer-<?php print $slideshowIndex; ?>">
            
            <!-- LEFT AREA -->
            <div class="busatour-leftarea">
                <div class="busatour-leftarea-title">
                    <!-- This area gets erased and populated by JavaScript -->
                </div>
                <div class="busatour-leftarea-text">
                    <!-- This area gets erased and populated by JavaScript -->
                </div>
            </div>
            
            <!-- SLIDESHOW AREA -->
            <div class="busatour-slideshowarea">
                <div class="busatour-slideshowarea-steps-container">
                    <?php foreach ( $slideshow as $slideIndex => $tourSlide ) { ?>
                        <div class="busatour-slideshowarea-step-container busatour-slideshowarea-step-container-<?php print $slideIndex; ?>">
                            <div class="busatour-slideshowarea-step-textcontainer">
                                <div class="busatour-slideshowarea-step-text">
                                    <input type="button" value="<?php print $tourSlide['slide-title']; ?>" onclick="tourSetActiveSlide(<?php print $slideshowIndex; ?>, <?php print $slideIndex; ?>);" />
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="busatour-slideshowarea-slides-container">
                    <?php foreach ( $slideshow as $tourSlide ) { ?>
                        <div class="busatour-slideshowarea-slide-container">
                            <img alt="" src="<?php print $tourSlide['slide-img-src']; ?>" />
                        </div>
                    <?php } ?>
                </div>
                <div class="busatour-slideshowarea-controles-container">
                    <div class="busatour-slideshowarea-controles-back">
                        <div class="busatour-slideshowarea-controles-back-btn">
                            <input type="button" alt="Back" onclick="tourSetActiveSlide(<?php print $slideshowIndex; ?>, currentSlide[<?php print $slideshowIndex; ?>] - 1);" />
                        </div>
                    </div>
                    <div class="busatour-slideshowarea-controles-text">
                        <!-- This area gets erased and populated by JavaScript -->
                    </div>
                    <div class="busatour-slideshowarea-controles-next">
                        <div class="busatour-slideshowarea-controles-next-btn">
                            <input type="button" alt="Next" onclick="tourSetActiveSlide(<?php print $slideshowIndex; ?>, currentSlide[<?php print $slideshowIndex; ?>] + 1);" />
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="busatour-postmastercontainer-spacer busatour-postmastercontainer-spacer-<?php print $slideshowIndex; ?>">
        
        </div>
    <?php } ?>
</div>

<script>
    
    // Global JavaScript variable to keep track what slide we are on
    currentSlide = [0, 0, 0];

    /* JavaScript to intialize the Tour page */
    jQuery(document).ready( function () {
    
        // Set all 3 fo the slideshows to the first slide to active
        tourSetActiveSlide(0, 0);
        tourSetActiveSlide(1, 0);
        tourSetActiveSlide(2, 0);
        
    });
    
    /* Misc */
    function tourSetActiveSlide(slideshowIndex, slideId) {
        
        // Validation
        if ( slideId < 0 ) {
            slideId = 0;
        }
        
        // Set all slides as inactive
        jQuery('.busatour-mastercontainer-' + slideshowIndex + ' .busatour-slideshowarea-step-container').removeClass('active');
        jQuery('.busatour-mastercontainer-' + slideshowIndex + ' .busatour-slideshowarea-slide-container').removeClass('active');
        
        // Set target step and slide as active
        jQuery('.busatour-mastercontainer-' + slideshowIndex + ' .busatour-slideshowarea-step-container').eq(slideId).addClass('active');
        jQuery('.busatour-mastercontainer-' + slideshowIndex + ' .busatour-slideshowarea-slide-container').eq(slideId).addClass('active');
        
        // Update the description
        jQuery('.busatour-mastercontainer-' + slideshowIndex + ' .busatour-leftarea-text').text(jsonSlideshows[slideshowIndex][slideId]['description']);
        
        // Update title text
        var newTitle = jsonSlideshows[slideshowIndex][slideId]['left-title'];
        jQuery('.busatour-mastercontainer-' + slideshowIndex + ' .busatour-leftarea-title').text(newTitle);
        
        // Update suibtitle text
        var newSubtitle = jsonSlideshows[slideshowIndex][slideId]['snippet'];
        jQuery('.busatour-mastercontainer-' + slideshowIndex + ' .busatour-slideshowarea-controles-text').html(newSubtitle);
        
        // Update the class-marker on the master-container
        jQuery('.busatour-mastercontainer-' + slideshowIndex).removeClass('currentslide-id-0');
        jQuery('.busatour-mastercontainer-' + slideshowIndex).removeClass('currentslide-id-1');
        jQuery('.busatour-mastercontainer-' + slideshowIndex).removeClass('currentslide-id-2');
        jQuery('.busatour-mastercontainer-' + slideshowIndex).removeClass('currentslide-id-3');
        jQuery('.busatour-mastercontainer-' + slideshowIndex).removeClass('currentslide-id-4');
        jQuery('.busatour-mastercontainer-' + slideshowIndex).addClass('currentslide-id-' + slideId);
        
        // Note what slide we are showing in the global JavaScript variable, currentSlide
        currentSlide[slideshowIndex] = slideId;
        
    }
    
</script>









