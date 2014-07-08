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

<!-- The following div is stored in site-analysis-sitemap.php /* Coder Bookmark: CB-HPES36I-BC */ -->
<div class="cifsiteanalysis-section-container cifsiteanalysis-section-container-sitemap">

    <div class="cifsiteanalysis-section-title cifsiteanalysis-section-title-sitemap">
        Site Map
    </div>

    <div class="cifsiteanalysis-subsection-container cifsiteanalysis-subsection-container-sitemap">
        
        <div class="cifsiteanalysis-subsection-description cifsiteanalysis-subsection-description-0">

            <script src="/sites/all/themes/bizusa/scripts/crawler-lookforsitemap.js"></script>
            <script src="/sites/all/themes/bizusa/scripts/crawler-buildsitemap.js"></script>
 
            <!-- Coder Bookmark: CB-TYA9P9M-BC -->
            <style>
                .generatedsitemap-controleui {
                    margin-bottom: 15px;
                }
                .generatedsitemap-controleui-workingui {
                    line-height: 25px;
                }
                .generatedsitemap-controleui-workingui img {
                    width: 25px;
                    margin-right: 15px;
                }
                .generatedsitemap-stopcrawlbtn {
                    float: right;
                }
                .generatedsitemap-mastercontainer {
                    border: 1px solid gray;
                    padding: 15px;
                    max-height: 350px;
                    overflow-y: scroll;
                }
                .generatedsitemap-sitemaplinkfound {
                    overflow: visible !important;
                    border: none !important;
                    padding: 0px !important;
                }
            </style>

            <!-- /* Coder Bookmark: CB-1S29ZLP-BC */ -->
            <div class="generatedsitemap-controleui">
                <div class="generatedsitemap-controleui-startui">    
                    Build sitemap from: 
                    <input type="text" value="http://new.export.gov" class="buildsitemapfrom-input" />
                    <input type="button" value="Build SiteMap" class="generatedsitemap-begincrawlbtn" />
                </div>
                <div class="generatedsitemap-controleui-workingui" style="display: none;">
                    <img src="sites/all/themes/bususa/images/ajax-loader-64-64.gif" />
                    <span class="generatedsitemap-statusmessage">
                        <!-- This is where the status message for the site-crawl shall be place. Content in this span to be updated by jQuery -->
                        Initializing...
                    </span>
                    <input type="button" class="generatedsitemap-stopcrawlbtn" value="Stop Crawling" />
                </div>
            </div>

            <div class="generatedsitemap-mastercontainer" style="display: none;">
                <!-- Content here shall be populated by jQuery -->
            </div>

            <script>
                jQuery(document).ready( function () { /* Coder Bookmark: CB-OZ3NGCJ-BC */
                    
                    // Event handler for clicking the "Build SiteMap" button
                    jQuery('.generatedsitemap-begincrawlbtn').bind('click', function () { /* Coder Bookmark: CB-I8NURDG-BC */
                    
                        // UI changes
                        jQuery('.generatedsitemap-controleui-startui').hide();
                        jQuery('.generatedsitemap-controleui-workingui').fadeIn();
                        
                        // Get the target site/page from the UI (input)
                        var targetUrl = jQuery('.buildsitemapfrom-input').val();
                        
                        // First we will look for links on the target site/page label "Site Map" - NOTE: lookForSiteMapFromUrl() is defined in crawler-lookforsitemap.js
                        lookForSiteMapFromUrl( targetUrl, function (foundSiteMapLink) {
                            
                            // NOTE: foundSiteMapLink will be a string (url) IF a SiteMap link is found, and the boolean FLASE if not found
                            
                           // if ( foundSiteMapLink !== false ) {
                                
                               /* jQuery('.generatedsitemap-controleui').hide();
                                jQuery('.generatedsitemap-mastercontainer').html('This website appears to have a Site-Map link here: <a target="_blank" href="' + foundSiteMapLink + '">' + foundSiteMapLink + '</a>');
                                jQuery('.generatedsitemap-mastercontainer').addClass('generatedsitemap-sitemaplinkfound')
                                jQuery('.generatedsitemap-mastercontainer').fadeIn();*/
                          //      urlsCrawled = [];
                           //     jQuery('.generatedsitemap-statusmessage').html('Initializing...');
                         //       terminateCrawl = false; // This is a global JavaScript variable watched by beginBuildOfHtmlSiteMapFromUrl()
                          //      beginBuildOfHtmlSiteMapFromUrl(targetUrl, jQuery('.generatedsitemap-mastercontainer'), 2); // This JavaScript function is defined in crawler-buildsitemap.js

                                // Timer to update the status message in jQuery('.generatedsitemap-statusmessage')
                        //        setInterval( function () { /* Coder Bookmark: CB-ZR6N92X-BC */
                          //          if ( urlsCrawled.length > 1 ) {
                          //              jQuery('.generatedsitemap-statusmessage').html('Processing... Crawled ' + (urlsCrawled.length - 1) + ' pages so far.');
                          //              jQuery('.generatedsitemap-mastercontainer').show();
                          //          }
                        //        }, 250);


                        //    } else {
                            
                                // Begin the crawl
                                urlsCrawled = [];
                                jQuery('.generatedsitemap-statusmessage').html('Initializing...');
                                terminateCrawl = false; // This is a global JavaScript variable watched by beginBuildOfHtmlSiteMapFromUrl()
                                beginBuildOfHtmlSiteMapFromUrl(targetUrl, jQuery('.generatedsitemap-mastercontainer'), 2); // This JavaScript function is defined in crawler-buildsitemap.js
                                
                                // Timer to update the status message in jQuery('.generatedsitemap-statusmessage')
                                setInterval( function () { /* Coder Bookmark: CB-ZR6N92X-BC */
                                    if ( urlsCrawled.length > 1 ) {
                                        jQuery('.generatedsitemap-statusmessage').html('Processing... Crawled ' + (urlsCrawled.length - 1) + ' pages so far.');
                                        jQuery('.generatedsitemap-mastercontainer').show();
                                    }
                                }, 250);
                                
                         //   }
                        
                        });
                    });
                    
                    // Event handler for clicking the "Stop Crawling" button
                    jQuery('.generatedsitemap-stopcrawlbtn').bind('click', function () { /* Coder Bookmark: CB-XU2B3BG-BC */
                        terminateCrawl = true;
                        jQuery('.generatedsitemap-controleui-startui').hide();
                        jQuery('.generatedsitemap-controleui-workingui').hide();
                    });
                    
                    /* If we are on the 'Content Integration Framework' page at a URL like https://dev.business.usa.reisys.com/content-integration-framework-site-analysis?site=gimby.org
                    then use the website-target given in the URL, and begin the crawl */
                    if ( typeof objUrlQueries['site'] != 'undefined' ) {
                        var targetUrl = String( objUrlQueries['site'] );
                        targetUrl = targetUrl.replace('https://', 'http://');
                        targetUrl = 'http://' + targetUrl;
                        targetUrl = targetUrl.replace('http://http://', 'http://');
                        jQuery('.buildsitemapfrom-input').val(targetUrl);
                        jQuery('.generatedsitemap-begincrawlbtn').click(); // This triggers the event handler defined on the Coder Bookmark of CB-I8NURDG-BC
                    }
                    
                });
                
            </script>

        </div>
        
    </div>
    
</div>


