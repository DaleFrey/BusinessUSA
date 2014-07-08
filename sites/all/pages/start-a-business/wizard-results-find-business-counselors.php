<div class="sbdcscore-offices-container-container" rendersource="<?php print basename(__FILE__); ?>">

    <div class="sbdcscore-offices-container sbdcscore-offices-container-women" style="display: none;">
        <span class="sbdc-view-defacto-title">Women's Business Center[<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-women');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-women" style="display: none;">
            Women's Business Centers (WBCs) represent a national network of nearly 100 educational centers designed to assist women start and grow small businesses.<br />
            WBCs operate with the mission to "level the playing field" for women entrepreneurs, who still face unique obstacles in the world of business.
            <br />
        </div>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Women\'s Business Center', $_POST['allTags']['enteredzip']); ?>
    </div>
    <div class="sbdcscore-offices-container sbdcscore-offices-container-veteran" style="display: none;">
        <span class="sbdc-view-defacto-title">Veteran's Business Outreach Center[<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-veteran');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-veteran" style="display: none;">
            The Veterans Business Outreach Program (VBOP) is designed to provide entrepreneurial development services such as business training; counseling and mentoring; and referrals for eligible veterans owning or considering starting a small business.<br/>
            SBA has 16 organizations participating in this cooperative agreement and serving as Veterans Business Outreach Centers (VBOC).<br />
        </div>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Veteran\'s Business Outreach Center', $_POST['allTags']['enteredzip']); ?>
    </div>
    <div class="sbdcscore-offices-container sbdcscore-offices-container-mbda" style="display: none;">
        <span class="sbdc-view-defacto-title">MBDA Business Center[<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-mbda');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-veteran" style="display: none;">
            Minority-owned firms seeking to penetrate new markets — domestic & global — and growing in size and scale, can access business experts at a MBDA Business Center. Whether it’s securing capital, competing for a contract, identifying a strategic partner or becoming export-ready, your success is our priority.<br />
        </div>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'MBDA Business Center', $_POST['allTags']['enteredzip']); ?>
    </div>
    <div class="sbdcscore-offices-container sbdcscore-offices-container-sbdc">
        <span class="sbdc-view-defacto-title">Small Business Development Centers [<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-sbdc');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-sbdc" style="display: none;">
            Small Business Development Centers (SBDC's) are organizations set up around the U.S. to assist small 
            business owners by providing management and technical resources to help start and run their businesses.<br />
            SBDC offices shown below are based on locations found within a 50-mile radius of zip code provided in "Location" section of this wizard. To find SBDC offices in other locations, change zip code in "Location" section of wizard.<br />
        </div>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Small Business Development Center', $_POST['allTags']['enteredzip']); ?>
    </div>
    <div class="sbdcscore-offices-container sbdcscore-offices-container-score">
        <span class="sbdc-view-defacto-title">SCORE Chapters [<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-score');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-score" style="display: none;">
            SCORE is a nonprofit association dedicated to helping small businesses get off the ground, grow and achieve their goals through education and mentorship.<br />
            SCORE offices shown below are based on locations found within a 50-mile radius of zip code provided in "Location" section of this wizard. To find SCORE offices in other locations, change zip code in "Location" section of wizard.<br />
        </div>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'SCORE Office', $_POST['allTags']['enteredzip']); ?>
    </div>

    <div class="sbdcscore-offices-container sbdcscore-offices-container-sbdc-score" style="display: none;">
        <span class="sbdc-view-defacto-title">SBDC/SCORE Chapters [<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-sbdc');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-sbdc-score" style="display: none;">
            Small Business Development Centers (SBDC's) are organizations set up around the U.S. to assist small
            business owners by providing management and technical resources to help start and run their businesses.<br />
            SBDC offices shown below are based on locations found within a 50-mile radius of zip code provided in "Location" section of this wizard. To find SBDC offices in other locations, change zip code in "Location" section of wizard.<br />
            SCORE is a nonprofit association dedicated to helping small businesses get off the ground, grow and achieve their goals through education and mentorship.<br />
            SCORE offices shown below are based on locations found within a 50-mile radius of zip code provided in "Location" section of this wizard. To find SCORE offices in other locations, change zip code in "Location" section of wizard.
        </div>
        <?php
          print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Small Business Development Center', $_POST['allTags']['enteredzip']);
          print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'SCORE Office', $_POST['allTags']['enteredzip']);
        ?>
    </div>

    <div class="sbdcscore-offices-container sbdcscore-offices-container-women-veteran" style="display: none;">
        <span class="sbdc-view-defacto-title">Women's/Veteran's Business Center[<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-women-veteran');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-women-veteran" style="display: none;">
            Women's Business Centers (WBCs) represent a national network of nearly 100 educational centers designed to assist women start and grow small businesses.<br />
            WBCs operate with the mission to "level the playing field" for women entrepreneurs, who still face unique obstacles in the world of business.
            <br />
            The Veterans Business Outreach Program (VBOP) is designed to provide entrepreneurial development services such as business training; counseling and mentoring; and referrals for eligible veterans owning or considering starting a small business.<br/>
            SBA has 16 organizations participating in this cooperative agreement and serving as Veterans Business Outreach Centers (VBOC).
        </div>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Women\'s Business Center', $_POST['allTags']['enteredzip']); ?>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Veteran\'s Business Outreach Center', $_POST['allTags']['enteredzip']); ?>
    </div>

    <div class="sbdcscore-offices-container sbdcscore-offices-container-women-veteran-mbda" style="display: none;">
        <span class="sbdc-view-defacto-title">Women's/Veteran's/MBDA Business Center[<a href="javascript: sbdcscore_toggileDisplay('sbdcscore-helptext-women-veteran-mbda');">?</a>]</span>
        <div class="sbdcscore-helptext sbdcscore-helptext-women-veteran" style="display: none;">
            Women's Business Centers (WBCs) represent a national network of nearly 100 educational centers designed to assist women start and grow small businesses.<br />
            WBCs operate with the mission to "level the playing field" for women entrepreneurs, who still face unique obstacles in the world of business.
            <br />
            The Veterans Business Outreach Program (VBOP) is designed to provide entrepreneurial development services such as business training; counseling and mentoring; and referrals for eligible veterans owning or considering starting a small business.<br/>
            SBA has 16 organizations participating in this cooperative agreement and serving as Veterans Business Outreach Centers (VBOC).
        </div>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Women\'s Business Center', $_POST['allTags']['enteredzip']); ?>
        <?php print views_embed_view('sbdcs', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'Veteran\'s Business Outreach Center', $_POST['allTags']['enteredzip']); ?>
        <?php print views_embed_view('mbda', 'default', $locInfo['lat'], $locInfo['lng'], '150', 'MBDA Business Center', $_POST['allTags']['enteredzip']); ?>
    </div>


    <a style="cursor: pointer;" class="btn-back-to-top">
		<div class="topLink">Back to top</div>
	</a> 
</div>
<script>
    function sbdcscore_toggileDisplay(classTarget) {
        var targ = jQuery('.' + classTarget);
        if ( targ.css('display') == 'none' ) {
            targ.css('display', 'block');
        } else {
            targ.css('display', 'none');
        }
    }

    $(document).ready(function(){

        if ($('.sbdcscore-offices-container-sbdc').length > 0)
        {
           var elem =  $('.sbdcscore-offices-container-sbdc a.sabw-sbdc-viewall');
           var href =  elem.attr('href');
           elem.attr('href', href + '&wiz=sbdc');
        }

        if ($('.sbdcscore-offices-container-score').length > 0)
        {
            var elem =  $('.sbdcscore-offices-container-score a.sabw-sbdc-viewall');
            var href =  elem.attr('href');
            elem.attr('href', href + '&wiz=score');
        }

        if ($('.sbdcscore-offices-container-women').length > 0)
        {
            var elem =  $('.sbdcscore-offices-container-women a.sabw-sbdc-viewall');
            var href =  elem.attr('href');
            elem.attr('href', href + '&wiz=women');
        }

        if ($('.sbdcscore-offices-container-veteran').length > 0)
        {
            var elem =  $('.sbdcscore-offices-container-veteran a.sabw-sbdc-viewall');
            var href =  elem.attr('href');
            elem.attr('href', href + '&wiz=veteran');
        }

        if($('.wrapper').length > 0)
        {
            if(($('.selected-tag-women_owned').length > 0 && $('.selected-tag-veteran_owned').length > 0) && ($('.selected-tag-minority_owned').length > 0 || $('.selected-tag-disabled').length > 0))
            {
                $('.sbdcscore-offices-container-score').hide();
                $('.sbdcscore-offices-container-sbdc').hide();
                $('.sbdcscore-offices-container-sbdc-score').show();
                $('.sbdcscore-offices-container-women-veteran-mbda').show();
            }else if($('.selected-tag-women_owned').length > 0 && $('.selected-tag-veteran_owned').length > 0)
            {
                $('.sbdcscore-offices-container-score').hide();
                $('.sbdcscore-offices-container-sbdc').hide();
                $('.sbdcscore-offices-container-sbdc-score').show();
                $('.sbdcscore-offices-container-women-veteran').show();
            }
            else if($('.selected-tag-women_owned').length > 0)
            {
                $('.sbdcscore-offices-container-sbdc').hide();
                $('.sbdcscore-offices-container-score').hide();
                $('.sbdcscore-offices-container-sbdc-score').show();
                $('.sbdcscore-offices-container-women').show();
            }
            else if($('.selected-tag-veteran_owned').length > 0)
            {
                $('.sbdcscore-offices-container-sbdc').hide();
                $('.sbdcscore-offices-container-score').hide();
                $('.sbdcscore-offices-container-sbdc-score').show();
                $('.sbdcscore-offices-container-veteran').show();
            }
            else if($('.selected-tag-minority_owned').length > 0 || $('.selected-tag-disabled').length > 0)
            {
                $('.sbdcscore-offices-container-sbdc').hide();
                $('.sbdcscore-offices-container-score').hide();
                $('.sbdcscore-offices-container-sbdc-score').show();
                $('.sbdcscore-offices-container-mbda').show();
            }else
            {
                $('.sbdcscore-offices-container-sbdc').show();
                $('.sbdcscore-offices-container-score').show();
            }
           // alert(hasTagWomen);  //selected-tag-veteran_owned
        }

        if ($('.sbdcscore-offices-container-sbdc-score').length > 0){
            var containerItems = $('div.sbdcscore-offices-container-sbdc-score div.view-content');
            if (containerItems.length > 0){
                var itemArray = [];
                var otherItems = [];
                if (containerItems.length > 1){
                    containerItems.each(function(index, value){
                        itemArray.push($(this).children().first());
                        otherItems.push($(this).children().first().next());
                    });

                    $($('div.sbdcscore-offices-container-sbdc-score div.view-content')[1]).parent().remove();
                    $($('div.sbdcscore-offices-container-sbdc-score div.view-content')[0]).children().remove();

                    $(itemArray).each(function(index, value){
                        $($('div.sbdcscore-offices-container-sbdc-score div.view-content')[0]).append(value);
                    });

                    if (otherItems.length > 1){
                        var mileage;
                        for ( var i = 0; i < $(otherItems).length; i++ ){
                            if (i == 0){
                                mileage = parseInt($($(otherItems)[i]).find('div.office-dist').text().match(/[\d\.]+/g).toString());
                            }
                            else{
                                if (parseInt($($(otherItems)[i]).find('div.office-dist').text().match(/[\d\.]+/g).toString()) < mileage){
                                    $($('div.sbdcscore-offices-container-sbdc-score div.view-content')[0]).append(otherItems[i]);
                                }
                                else{
                                    $($('div.sbdcscore-offices-container-sbdc-score div.view-content')[0]).append(otherItems[0]);
                                }
                            }
                        }
                    }
                    else{
                        $($('div.sbdcscore-offices-container-sbdc-score div.view-content')[0]).append(otherItems[0]);
                    }
                }
                else{
                    var emptyEle = $('div.sbdcscore-offices-container-sbdc-score div.view-empty');
                    if (emptyEle != null && emptyEle.length > 0){
                        $($('div.sbdcscore-offices-container-sbdc-score div.view-empty')[0]).parent().remove();
                    }
                }

                var elem =  $('.sbdcscore-offices-container-sbdc-score a.sabw-sbdc-viewall');
                var href =  elem.attr('href');
                elem.attr('href', href + '&wiz=sbdc,score');
            }
            else{
                var emptyEle = $('div.sbdcscore-offices-container-sbdc-score div.view-empty');
                if (emptyEle != null && emptyEle.length > 1){
                    $($('div.sbdcscore-offices-container-sbdc-score div.view-empty')[1]).parent().remove();
                }
            }
        }

        if ($('.sbdcscore-offices-container-women-veteran').length > 0){
            var containerItems = $('div.sbdcscore-offices-container-women-veteran div.view-content');
            if (containerItems.length > 0){
                var itemArray = [];
                var otherItems = [];
                if (containerItems.length > 1){
                    containerItems.each(function(index, value){
                        itemArray.push($(this).children().first());
                        otherItems.push($(this).children().first().next());
                    });

                    $($('div.sbdcscore-offices-container-women-veteran div.view-content')[1]).parent().remove();
                    $($('div.sbdcscore-offices-container-women-veteran div.view-content')[0]).children().remove();

                    $(itemArray).each(function(index, value){
                        $($('div.sbdcscore-offices-container-women-veteran div.view-content')[0]).append(value);
                    });

                    if (otherItems.length > 1){
                        var mileage;
                        for ( var i = 0; i < $(otherItems).length; i++ ){
                            if (i == 0){
                                mileage = parseInt($($(otherItems)[i]).find('div.office-dist').text().match(/[\d\.]+/g).toString());
                            }
                            else{
                                if (parseInt($($(otherItems)[i]).find('div.office-dist').text().match(/[\d\.]+/g).toString()) < mileage){
                                    $($('div.sbdcscore-offices-container-women-veteran div.view-content')[0]).append(otherItems[i]);
                                }
                                else{
                                    $($('div.sbdcscore-offices-container-women-veteran div.view-content')[0]).append(otherItems[0]);
                                }
                            }
                        }
                    }
                    else{
                        $($('div.sbdcscore-offices-container-women-veteran div.view-content')[0]).append(otherItems[0]);
                    }
                }
                else{
                    var emptyEle = $('div.sbdcscore-offices-container-women-veteran div.view-empty');
                    if (emptyEle != null && emptyEle.length > 0){
                        $($('div.sbdcscore-offices-container-women-veteran div.view-empty')[0]).parent().remove();
                    }
                }

                var elem =  $('.sbdcscore-offices-container-women-veteran a.sabw-sbdc-viewall');
                var href =  elem.attr('href');
                elem.attr('href', href + '&wiz=women,veteran');
            }
            else{
                var emptyEle = $('div.sbdcscore-offices-container-women-veteran div.view-empty');
                if (emptyEle != null && emptyEle.length > 1){
                    $($('div.sbdcscore-offices-container-women-veteran div.view-empty')[1]).parent().remove();
                }
            }
        }

        if ($('.sbdcscore-offices-container-women-veteran-mbda').length > 0){
            var containerItems = $('div.sbdcscore-offices-container-women-veteran-mbda div.view-content');
            if (containerItems.length > 0){
                //var itemArray = containerItems.children();
                var itemArray = [];
                var otherItems = [];
                if (containerItems.length > 1){
                    containerItems.each(function(index, value){
                        itemArray.push($(this).children().first());
                        if (containerItems.length < 3){
                            otherItems.push($(this).children().first().next());
                        }
                    });
                    if (containerItems.length > 2){
                        $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-content')[2]).parent().remove();
                    }
                    $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-content')[1]).parent().remove();
                    $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-content')[0]).children().remove();
                    $(itemArray).each(function(index, value){
                        $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-content')[0]).append(value);
                    });

                    if (otherItems.length > 1){
                        var mileage;
                        for ( var i = 0; i < $(otherItems).length; i++ ){
                            if (i == 0){
                                mileage = parseInt($($(otherItems)[i]).find('div.office-dist').text().match(/[\d\.]+/g).toString());
                            }
                            else{
                                if (parseInt($($(otherItems)[i]).find('div.office-dist').text().match(/[\d\.]+/g).toString()) < mileage){
                                    $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-content')[0]).append(otherItems[i]);
                                }
                                else{
                                    $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-content')[0]).append(otherItems[0]);
                                }
                            }
                        }
                    }
                    else{
                        $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-content')[0]).append(otherItems[0]);
                    }
                }
                else{
                    var emptyEle = $('div.sbdcscore-offices-container-women-veteran-mbda div.view-empty');
                    if (emptyEle != null && emptyEle.length > 0){
                        $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-empty')[0]).parent().remove();
                    }
                }

                var elem =  $('.sbdcscore-offices-container-women-veteran-mbda a.sabw-sbdc-viewall');
                var href =  elem.attr('href');
                elem.attr('href', href + '&wiz=women,veteran,mbda');
            }
            else{
                var emptyEle = $('div.sbdcscore-offices-container-women-veteran-mbda div.view-empty');
                if (emptyEle != null && emptyEle.length > 1){
                    if (emptyEle.length > 2){
                        $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-empty')[2]).parent().remove();
                    }
                    $($('div.sbdcscore-offices-container-women-veteran-mbda div.view-empty')[1]).parent().remove();
                }
            }
        }
    });


</script>