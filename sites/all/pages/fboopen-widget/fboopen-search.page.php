
<script>
    $(document).ready(function(){

        function detectIE() {
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf('MSIE ');
            var trident = ua.indexOf('Trident/');

            if (msie > 0) {
                // IE 10 or older => return version number
                return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
            }

            if (trident > 0) {
                // IE 11 (or newer) => return version number
                var rv = ua.indexOf('rv:');
                return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
            }

            // other browser
            return false;
        }
        if (detectIE() == 8 || detectIE() == 9)
        {
           window.location="/fboopen-widget/compatibilitycheckfbopen";

        }



    });
</script>

<?php

$noheaderfooter= $_GET['header'];
print $noheaderfooter;


if ($noheaderfooter === 'no')
{

    ob_end_clean();
    ob_end_flush();
}

?>


<!--<html lang="en">
<head>-->

    <link href="/<?php print overridable('sites/all/themes/bizusa/css/fbopen-css/bootstrap-1600.css'); ?>" rel="stylesheet">


    <link href="/<?php print overridable('sites/all/themes/bizusa/css/fbopen-css/fbopen.css'); ?>" rel="stylesheet">

    <!--[if lte IE 9]>
    <!--<style>#outer-container { display: none !important; }</style>
    <script type="text/javascript">
        window.location.href = '/index-oldie.html';
    </script>


    <![endif]-->
<!--</head>
<body>-->

<div>
<div class="container" id="outer-container">
<div>
    <div id="intro">

       <!-- <div class="titleWrapper">
            <h1>FBO Open Opportunities</h1>
        </div>-->

        <p class="landing-copy">
           FBOpen helps small businesses search for opportunities to work with the U.S. government.
        </p>


    </div>
<div class="brand" id="FBOOpen">
            <h1>Powered By <img src= '../sites/all/themes/bizusa/images/fboopen2.jpg'></h1>
            <!--<span>pilot</span>-->
        </div>
    <div id="main" class="row" >
        

        <div id="sidebar" class="fbohomesplash col-sm-4 col-md-4">

            <!--<div class="container brand">
                <h1>FBO Open Opportunities</h1>
                <!--<span>pilot</span>
            </div>-->

            <form name="fbopen-search-form" id="fbopen-search-form" role="form" class="form" method="get" action="">

                <div class="form-group">
                    <input id="q" name="input" type="search" class="form-control" />
                    <button type="submit" id="q-search">Search</button>
                </div>

                <a id="form-advanced-label" data-toggle="collapse" href="javascript:void(0);" data-target="#form-advanced-options">
                    <span class="filter-category-title advanced">ADVANCED</span>
                    <button id="advanced-toggle" type="button" class="btn">+/-</button>
                </a>

                <div id="form-advanced-options" class="">

                    <div class="checkbox">
                        <label class="filter-text">
                            <input id="show_closed" name="show_closed" type="checkbox" /> Show closed listings
                        </label>
                    </div>

                    <div class="checkbox form-group-more">
                        <label class="filter-text">
                            <input id="show_noncompeted" name="show_noncompeted" type="checkbox" /> Show non-competed listings (sole source)
                        </label>
                    </div>
                    <div class="form-group form-group-more">
                        <label for="data_source" class="filter-text">Data Source:</label>
                        <select id="data_source" name="data_source" type="search" class="form-control">
                            <option value="">All</option>
                            <option value="FBO">FedBizOpps (fbo.gov)</option>
                            <option value="grants.gov">grants.gov</option>
                            <option value="construction">BUSA</option>
                        </select>

                    </div>

                    <div class="form-group form-group-more collapse">
                        <label for="naics">NAICS code:</label>
                        <input id="naics" name="naics" type="search" class="form-control" />
                        <button type="button" class="close" data-close="naics" aria-hidden="true">&times;</button>
                    </div>

                    <button id="go" type="submit" class="btn btn-primary btn-block">Search</button>

                </div>

                <input id="parent_only" name="parent_only" type="hidden" value="" />
                <input id="p" name="p" type="hidden" value="" />
            </form>


            <div id="naics-facets" class="list-group naics-facets">
                <p class="list-group-item list-group-header">Top FedBizOpps results by industry:</p>
            </div>

            <div id="naics-facets-more" class="list-group naics-facets collapse">
            </div>

        </div>

        <div class="col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-4">

            <div id="results-container">

                <div id="results-list">
                </div>

            </div><!-- results-container -->

            <div id="results-raw-outer">
                <h5 data-toggle="collapse" data-target="#results-raw">Raw result (click to show/hide)</h5>
                <div id="results-raw"></div>
            </div>

        </div><!-- results column -->

    </div><!-- row -->



</div><!-- outer-container -->

</div>

<!-- core scripts -->
<script src="../sites/all/themes/bizusa/scripts/fbo-open/jquery-1.10.2.js"></script>
<script src="../sites/all/themes/bizusa/scripts/fbo-open/underscore-1.5.2.min.js"></script>
<script src="../sites/all/themes/bizusa/scripts/fbo-open/backbone-1.1.0.min.js"></script>

<script src="../sites/all/themes/bizusa/scripts/fbo-open/dust-full-2.1.0.js"></script>
<script src="../sites/all/themes/bizusa/scripts/fbo-open/dust-helpers-1.1.2.js"></script>

<!-- load after dust-full and dust-helpers -->
<script src="../sites/all/themes/bizusa/scripts/fbo-open/result.js"></script>

<!-- misc helper libraries -->
<!--<script src="sites/all/themes/bususa/js/fbo-open/URI.min.js"></script>-->
<script src="../sites/all/themes/bizusa/scripts/fbo-open/string.min.js"></script>
<script src="../sites/all/themes/bizusa/scripts/fbo-open/moment.min.js"></script>
<script src="../sites/all/themes/bizusa/scripts/fbo-open/bootstrap.min.js"></script>

<!-- our code -->

<script src="../sites/all/themes/bizusa/scripts/fbo-open/config.js"></script>
<script src="../sites/all/themes/bizusa/scripts/fbo-open/fbopen.js"></script>
<script src="../sites/all/modules/custom/apachesolr_autocomplete/jquery-autocomplete/jquery.autocomplete.js"></script>



<!-- Colorbox files -->

<script src="../sites/all/themes/bizusa/scripts/fbo-open/jquery.colorbox.js"></script>
<script src="../sites/all/themes/bizusa/scripts/fbo-open/jquery.colorbox-min.js"></script>


<!--</body>
</html>-->
<script>

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
$(document).ready(function(){
    var first = getUrlVars()["input"];
    if (first !== null)
    {
        var notsplashpage = $('#sidebar').attr('class');
        notsplashpage = notsplashpage.replace('fbohomesplash ','' );
        $('#sidebar').attr('class', notsplashpage);

    }

});


/*
 * ScrollToFixed
 * https://github.com/bigspotteddog/ScrollToFixed
 * 
 * Copyright (c) 2011 Joseph Cava-Lynch
 * MIT license
 */
(function($) {
    $.isScrollToFixed = function(el) {
        return !!$(el).data('ScrollToFixed');
    };

    $.ScrollToFixed = function(el, options) {
        // To avoid scope issues, use 'base' instead of 'this' to reference this
        // class from internal events and functions.
        var base = this;

        // Access to jQuery and DOM versions of element.
        base.$el = $(el);
        base.el = el;

        // Add a reverse reference to the DOM object.
        base.$el.data('ScrollToFixed', base);

        // A flag so we know if the scroll has been reset.
        var isReset = false;

        // The element that was given to us to fix if scrolled above the top of
        // the page.
        var target = base.$el;

        var position;
        var originalPosition;

        var originalOffsetTop;

        // The offset top of the element when resetScroll was called. This is
        // used to determine if we have scrolled past the top of the element.
        var offsetTop = 0;

        // The offset left of the element when resetScroll was called. This is
        // used to move the element left or right relative to the horizontal
        // scroll.
        var offsetLeft = 0;
        var originalOffsetLeft = -1;

        // This last offset used to move the element horizontally. This is used
        // to determine if we need to move the element because we would not want
        // to do that for no reason.
        var lastOffsetLeft = -1;

        // This is the element used to fill the void left by the target element
        // when it goes fixed; otherwise, everything below it moves up the page.
        var spacer = null;

        var spacerClass;

        var className;

        // Capture the original offsets for the target element. This needs to be
        // called whenever the page size changes or when the page is first
        // scrolled. For some reason, calling this before the page is first
        // scrolled causes the element to become fixed too late.
        function resetScroll() {
            // Set the element to it original positioning.
            target.trigger('preUnfixed.ScrollToFixed');
            setUnfixed();
            target.trigger('unfixed.ScrollToFixed');

            // Reset the last offset used to determine if the page has moved
            // horizontally.
            lastOffsetLeft = -1;

            // Capture the offset top of the target element.
            offsetTop = target.offset().top;

            // Capture the offset left of the target element.
            offsetLeft = target.offset().left;

            // If the offsets option is on, alter the left offset.
            if (base.options.offsets) {
                offsetLeft += (target.offset().left - target.position().left);
            }

            if (originalOffsetLeft == -1) {
                originalOffsetLeft = offsetLeft;
            }

            position = target.css('position');

            // Set that this has been called at least once.
            isReset = true;

            if (base.options.bottom != -1) {
                target.trigger('preFixed.ScrollToFixed');
                setFixed();
                target.trigger('fixed.ScrollToFixed');
            }
        }

        function getLimit() {
            var limit = base.options.limit;
            if (!limit) return 0;

            if (typeof(limit) === 'function') {
                return limit.apply(target);
            }
            return limit;
        }

        // Returns whether the target element is fixed or not.
        function isFixed() {
            return position === 'fixed';
        }

        // Returns whether the target element is absolute or not.
        function isAbsolute() {
            return position === 'absolute';
        }

        function isUnfixed() {
            return !(isFixed() || isAbsolute());
        }

        // Sets the target element to fixed. Also, sets the spacer to fill the
        // void left by the target element.
        function setFixed() {
            // Only fix the target element and the spacer if we need to.
            if (!isFixed()) {
                // Set the spacer to fill the height and width of the target
                // element, then display it.
                spacer.css({
                    'display' : target.css('display'),
                    'width' : target.outerWidth(true),
                    'height' : target.outerHeight(true),
                    'float' : target.css('float')
                });
				console.log(target.outerWidth());
                // Set the target element to fixed and set its width so it does
                // not fill the rest of the page horizontally. Also, set its top
                // to the margin top specified in the options.

                cssOptions={
                    'position' : 'fixed',
                    'top' : base.options.bottom == -1?getMarginTop():'',
                    'bottom' : base.options.bottom == -1?'':base.options.bottom,
                    'margin-left' : '0px'
                }
                if (!base.options.dontSetWidth){ cssOptions['width']=target.width(); };

                target.css(cssOptions);
                
                target.addClass(base.options.baseClassName);
                
                if (base.options.className) {
                    target.addClass(base.options.className);
                }

                position = 'fixed';
            }
        }

        function setAbsolute() {

            var top = getLimit();
            var left = offsetLeft;

            if (base.options.removeOffsets) {
                left = '';
                top = top - offsetTop;
            }

            cssOptions={
              'position' : 'absolute',
              'top' : top,
              'left' : left,
              'margin-left' : '0px',
              'bottom' : ''
            }
            if (!base.options.dontSetWidth){ cssOptions['width']=target.width(); };

            target.css(cssOptions);

            position = 'absolute';
        }

        // Sets the target element back to unfixed. Also, hides the spacer.
        function setUnfixed() {
            // Only unfix the target element and the spacer if we need to.
            if (!isUnfixed()) {
                lastOffsetLeft = -1;

                // Hide the spacer now that the target element will fill the
                // space.
                spacer.css('display', 'none');

                // Remove the style attributes that were added to the target.
                // This will reverse the target back to the its original style.
                target.css({
                    'width' : '',
                    'position' : originalPosition,
                    'left' : '',
                    'top' : originalOffsetTop,
                    'margin-left' : ''
                });

                target.removeClass('scroll-to-fixed-fixed');

                if (base.options.className) {
                    target.removeClass(base.options.className);
                }

                position = null;
            }
        }

        // Moves the target element left or right relative to the horizontal
        // scroll position.
        function setLeft(x) {
            // Only if the scroll is not what it was last time we did this.
            if (x != lastOffsetLeft) {
                // Move the target element horizontally relative to its original
                // horizontal position.
                target.css('left', offsetLeft - x);

                // Hold the last horizontal position set.
                lastOffsetLeft = x;
            }
        }

        function getMarginTop() {
            var marginTop = base.options.marginTop;
            if (!marginTop) return 0;

            if (typeof(marginTop) === 'function') {
                return marginTop.apply(target);
            }
            return marginTop;
        }

        // Checks to see if we need to do something based on new scroll position
        // of the page.
        function checkScroll() {
            if (!$.isScrollToFixed(target)) return;
            var wasReset = isReset;

            // If resetScroll has not yet been called, call it. This only
            // happens once.
            if (!isReset) {
                resetScroll();
            }

            // Grab the current horizontal scroll position.
            var x = $(window).scrollLeft();

            // Grab the current vertical scroll position.
            var y = $(window).scrollTop();

            // Get the limit, if there is one.
            var limit = getLimit();
		
            // If the vertical scroll position, plus the optional margin, would
            // put the target element at the specified limit, set the target
            // element to absolute.
            if (base.options.minWidth && $(window).width() < base.options.minWidth) {
                if (!isUnfixed() || !wasReset) {
                    postPosition();
                    target.trigger('preUnfixed.ScrollToFixed');
                    setUnfixed();
                    target.trigger('unfixed.ScrollToFixed');
                }
            } else if (base.options.maxWidth && $(window).width() > base.options.maxWidth) {
                if (!isUnfixed() || !wasReset) {
                    postPosition();
                    target.trigger('preUnfixed.ScrollToFixed');
                    setUnfixed();
                    target.trigger('unfixed.ScrollToFixed');
                }
            } else if (base.options.bottom == -1) {
                // If the vertical scroll position, plus the optional margin, would
                // put the target element at the specified limit, set the target
                // element to absolute.
                if (limit > 0 && y >= limit - getMarginTop()) {
                    if (!isAbsolute() || !wasReset) {
                        postPosition();
                        target.trigger('preAbsolute.ScrollToFixed');
                        setAbsolute();
                        target.trigger('unfixed.ScrollToFixed');
                    }
                // If the vertical scroll position, plus the optional margin, would
                // put the target element above the top of the page, set the target
                // element to fixed.
                } else if (y >= offsetTop - getMarginTop()) {
                    if (!isFixed() || !wasReset) {
                        postPosition();
                        target.trigger('preFixed.ScrollToFixed');

                        // Set the target element to fixed.
                        setFixed();

                        // Reset the last offset left because we just went fixed.
                        lastOffsetLeft = -1;

                        target.trigger('fixed.ScrollToFixed');
                    }
                    // If the page has been scrolled horizontally as well, move the
                    // target element accordingly.
                    setLeft(x);
                } else {
                    // Set the target element to unfixed, placing it where it was
                    // before.
                    if (!isUnfixed() || !wasReset) {
                        postPosition();
                        target.trigger('preUnfixed.ScrollToFixed');
                        setUnfixed();
                        target.trigger('unfixed.ScrollToFixed');
                    }
                }
            } else {
                if (limit > 0) {
                    if (y + $(window).height() - target.outerHeight(true) >= limit - (getMarginTop() || -getBottom())) {
                        if (isFixed()) {
                            postPosition();
                            target.trigger('preUnfixed.ScrollToFixed');

                            if (originalPosition === 'absolute') {
                                setAbsolute();
                            } else {
                                setUnfixed();
                            }

                            target.trigger('unfixed.ScrollToFixed');
                        }
                    } else {
                        if (!isFixed()) {
                            postPosition();
                            target.trigger('preFixed.ScrollToFixed');
                            setFixed();
                        }
                        setLeft(x);
                        target.trigger('fixed.ScrollToFixed');
                    }
                } else {
                    setLeft(x);
                }
            }
        }

        function getBottom() {
            if (!base.options.bottom) return 0;
            return base.options.bottom;
        }

        function postPosition() {
            var position = target.css('position');

            if (position == 'absolute') {
                target.trigger('postAbsolute.ScrollToFixed');
            } else if (position == 'fixed') {
                target.trigger('postFixed.ScrollToFixed');
            } else {
                target.trigger('postUnfixed.ScrollToFixed');
            }
        }

        var windowResize = function(event) {
            // Check if the element is visible before updating it's position, which
            // improves behavior with responsive designs where this element is hidden.
            if(target.is(':visible')) {
                isReset = false;
                checkScroll();
            }
        }

        var windowScroll = function(event) {
            checkScroll();
        }

        // From: http://kangax.github.com/cft/#IS_POSITION_FIXED_SUPPORTED
        var isPositionFixedSupported = function() {
            var container = document.body;

            if (document.createElement && container && container.appendChild && container.removeChild) {
                var el = document.createElement('div');

                if (!el.getBoundingClientRect) return null;

                el.innerHTML = 'x';
                el.style.cssText = 'position:fixed;top:100px;';
                container.appendChild(el);

                var originalHeight = container.style.height,
                originalScrollTop = container.scrollTop;

                container.style.height = '3000px';
                container.scrollTop = 500;

                var elementTop = el.getBoundingClientRect().top;
                container.style.height = originalHeight;

                var isSupported = (elementTop === 100);
                container.removeChild(el);
                container.scrollTop = originalScrollTop;

                return isSupported;
            }

            return null;
        }

        var preventDefault = function(e) {
            e = e || window.event;
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.returnValue = false;
        }

        // Initializes this plugin. Captures the options passed in, turns this
        // off for devices that do not support fixed position, adds the spacer,
        // and binds to the window scroll and resize events.
        base.init = function() {
            // Capture the options for this plugin.
            base.options = $
                    .extend({}, $.ScrollToFixed.defaultOptions, options);

            // Turn off this functionality for devices that do not support it.
            // if (!(base.options && base.options.dontCheckForPositionFixedSupport)) {
            //     var fixedSupported = isPositionFixedSupported();
            //     if (!fixedSupported) return;
            // }

            // Put the target element on top of everything that could be below
            // it. This reduces flicker when the target element is transitioning
            // to fixed.
            base.$el.css('z-index', base.options.zIndex);

            // Create a spacer element to fill the void left by the target
            // element when it goes fixed.
            spacer = $('<div />');

            position = target.css('position');
            originalPosition = target.css('position');

            originalOffsetTop = target.css('top');

            // Place the spacer right after the target element.
            if (isUnfixed()) base.$el.after(spacer);

            // Reset the target element offsets when the window is resized, then
            // check to see if we need to fix or unfix the target element.
            $(window).bind('resize.ScrollToFixed', windowResize);

            // When the window scrolls, check to see if we need to fix or unfix
            // the target element.
            $(window).bind('scroll.ScrollToFixed', windowScroll);

            if (base.options.preFixed) {
                target.bind('preFixed.ScrollToFixed', base.options.preFixed);
            }
            if (base.options.postFixed) {
                target.bind('postFixed.ScrollToFixed', base.options.postFixed);
            }
            if (base.options.preUnfixed) {
                target.bind('preUnfixed.ScrollToFixed', base.options.preUnfixed);
            }
            if (base.options.postUnfixed) {
                target.bind('postUnfixed.ScrollToFixed', base.options.postUnfixed);
            }
            if (base.options.preAbsolute) {
                target.bind('preAbsolute.ScrollToFixed', base.options.preAbsolute);
            }
            if (base.options.postAbsolute) {
                target.bind('postAbsolute.ScrollToFixed', base.options.postAbsolute);
            }
            if (base.options.fixed) {
                target.bind('fixed.ScrollToFixed', base.options.fixed);
            }
            if (base.options.unfixed) {
                target.bind('unfixed.ScrollToFixed', base.options.unfixed);
            }

            if (base.options.spacerClass) {
                spacer.addClass(base.options.spacerClass);
            }

            target.bind('resize.ScrollToFixed', function() {
                spacer.height(target.height());
            });

            target.bind('scroll.ScrollToFixed', function() {
                target.trigger('preUnfixed.ScrollToFixed');
                setUnfixed();
                target.trigger('unfixed.ScrollToFixed');
                checkScroll();
            });

            target.bind('detach.ScrollToFixed', function(ev) {
                preventDefault(ev);

                target.trigger('preUnfixed.ScrollToFixed');
                setUnfixed();
                target.trigger('unfixed.ScrollToFixed');

                $(window).unbind('resize.ScrollToFixed', windowResize);
                $(window).unbind('scroll.ScrollToFixed', windowScroll);

                target.unbind('.ScrollToFixed');

                //remove spacer from dom
                spacer.remove();

                base.$el.removeData('ScrollToFixed');
            });

            // Reset everything.
            windowResize();
        };

        // Initialize the plugin.
        base.init();
    };

    // Sets the option defaults.
    $.ScrollToFixed.defaultOptions = {
        marginTop : 0,
        limit : 0,
        bottom : -1,
        zIndex : 1000,
        baseClassName: 'scroll-to-fixed-fixed'
    };

    // Returns enhanced elements that will fix to the top of the page when the
    // page is scrolled.
    $.fn.scrollToFixed = function(options) {
        return this.each(function() {
            (new $.ScrollToFixed(this, options));
        });
    };
})(jQuery);



$(document).ready(function(){
var summary = $('#sidebar');
    summary.scrollToFixed({
        marginTop: $('#FBOOpen').outerHeight(true) + 20,
        limit: function(){
			var limit = $('#outer-container').outerHeight();
			return limit;
		},
		dontSetWidth:true,
        zIndex: 999
    });
});
</script>



