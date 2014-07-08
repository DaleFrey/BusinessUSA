<?php
/*

    [--] PURPOSE [--]
    
    TODO
    
    [--] IMPLEMENTATION [--]
    
    TODO
    
    [!!] WARNING [!!]
    
    TODO

*/
?>

<!-- The following div is stored in site-analysis-socialmedia.tpl.php /* Coder Bookmark: CB-HJB6C8O-BC */ -->
<div class="cifsiteanalysis-section-container cifsiteanalysis-section-container-socialmedia">

    <div class="cifsiteanalysis-section-title cifsiteanalysis-section-title-socialmedia">
        Social Media
    </div>

    <div class="cifsiteanalysis-subsection-container cifsiteanalysis-subsection-container-socialmedia">
        
        <div class="cifsiteanalysis-subsection-description cifsiteanalysis-subsection-description-0">

            <div class="socialcrawler-start-ui" style="display: none;">
                Target URL to search: <input type="textbox" id="urlInput" /> <input type="button" class="socialcrawler-start-btn" value="search"/>
            </div>
            <div class="socialcrawler-working-ui" style="display: none; text-align: center;">
                <img src="http://business.usa.gov/sites/all/themes/bususa/images/ajax-loader-64-64.gif" style="width: 25px;"/>
            </div>
            <div class="socialcrawler-results-ui" style="display: none;">
                <div class="socialcrawler-results-results">
                    <!-- Markup here to be populated by jQuery /* Coder Bookmark: CB-K6KU07Z-BC */ -->
                </div>
            </div>

            <div>
                <script>
                    
                    jQuery(document).ready( function () {
                        
                        var targetSite = '<?php print ( empty($_GET['site']) ? '' : $_GET['site'] );  ?>';
                        targetSite = jQuery.trim(targetSite);
                        if ( targetSite != '' ) {
                            jQuery('#urlInput').val('http://' + targetSite);
                            crawlForSocialMediaLinks();
                        } else {
                            jQuery('#urlInput').focus();
                            setTimeout( function () {
                                jQuery('#urlInput').focus();
                            }, 1000);
                        }
                        
                        jQuery('.socialcrawler-start-btn').bind('click', function () {
                            crawlForSocialMediaLinks();
                        });
                        
                        function crawlForSocialMediaLinks() {
                            
                            foundMainResults = [];
                            foundResults = [];
                            targetUrl = jQuery('#urlInput').val();
                            jQuery('.socialcrawler-working-ui').show();
                            jQuery('.socialcrawler-results-ui').hide();
                            
                            targetUrl = '/dev/get-html-source?url=' + escape(targetUrl);
                            consoleLog('Pulling HTML from ' + targetUrl);
                            jQuery.get(targetUrl, function (data) {
                                
                                consoleLog('Get HTML from ' + targetUrl);
                                
                                // For each link on the target page
                                jQuery(data).find('a').each( function () {
                                    var jqThis = jQuery(this);
                                    var thisHref = String(jqThis.attr('href'));
                                    
                                    if ( thisHref.indexOf('twitter') != -1 && thisHref.indexOf('javascript:') == -1 && thisHref.indexOf('?status=') == -1 ) {
                                        if ( thisHref.indexOf('intent') == -1 && thisHref.indexOf('search') == -1 ) {
                                            consoleLog('Found twitter PROFILE link: ' + thisHref);
                                            foundResults.push('Found twitter PROFILE link: ' + thisHref);
                                            foundMainResults.push('Found twitter PROFILE link: ' + thisHref);
                                        } else {
                                            consoleLog('Found twitter link on page: ' + thisHref);
                                            foundResults.push('Found twitter link on page: ' + thisHref);
                                        }
                                        
                                    }
                                    
                                    if ( thisHref.indexOf('facebook') != -1 && thisHref.indexOf('javascript:') == -1 ) {
                                        if ( thisHref.indexOf('share') == -1 && thisHref.indexOf('search') == -1 ) {
                                            consoleLog('Found facebook PROFILE link: ' + thisHref);
                                            foundResults.push('Found facebook PROFILE link: ' + thisHref);
                                            foundMainResults.push('Found facebook PROFILE link: ' + thisHref);
                                        } else {
                                            consoleLog('Found facebook link on page: ' + thisHref);
                                            foundResults.push('Found facebook link on page: ' + thisHref);
                                        }
                                    }
                                    
                                    if ( thisHref.indexOf('linkedin.com') != -1 && thisHref.indexOf('javascript:') == -1 ) {
                                        if ( thisHref.indexOf('company') != -1 ) {
                                            consoleLog('Found LinkedIn COMPANY link: ' + thisHref);
                                            foundResults.push('Found LinkedIn COMPANY link: ' + thisHref);
                                            foundMainResults.push('Found LinkedIn COMPANY link: ' + thisHref);
                                        } else if ( thisHref.indexOf('groups') != -1 ) {
                                            consoleLog('Found LinkedIn GROUP link: ' + thisHref);
                                            foundResults.push('Found LinkedIn GROUP link: ' + thisHref);
                                            foundMainResults.push('Found LinkedIn GROUP link: ' + thisHref);
                                        } else {
                                            consoleLog('Found LinkedIn link on page: ' + thisHref);
                                            foundResults.push('Found LinkedIn link on page: ' + thisHref);
                                        }
                                    }
                                    
                                });
                                
                                if ( jQuery('body.ie').length = 0 ) {
                                    foundResults = foundResults.filter(function(elem, pos) {
                                        return foundResults.indexOf(elem) == pos;
                                    });
                                    foundMainResults = foundMainResults.filter(function(elem, pos) {
                                        return foundMainResults.indexOf(elem) == pos;
                                    });
                                }
                                
                                jQuery('.socialcrawler-working-ui').hide();
                                jQuery('.socialcrawler-results-results').html( "PROFILE(S) FOUND:<br/>" + foundMainResults.join("<br/>") + "<br/><br/>" + "ALL SOCIAL LINKS FOUND:<br/>" + foundResults.join("<br/>") );
                                jQuery('.socialcrawler-results-ui').fadeIn();
                            });
                            
                        }
                    });
                    
                </script>
            </div>
        
        </div>
        
    </div>
    
</div>

