<html lang="en">
    <head>
    <link type="image/vnd.microsoft.icon" href="http://business.usa.gov/sites/default/files/favicon.ico" rel="shortcut icon">
    <title> Wizards Widget | BusinessUSA</title>
        <style>
            body {
                margin: 5px;
                font-family: Bitter-regular, Times, serif;
                overflow:hidden;
            }
            a {
                text-decoration: none;
                color: #15567b;
            }
            .busa-logo {
                padding-bottom: 10px;
            }
            .busa-widget-roundedcorners {
                border-width: 2px;
                border-color: #E5E5E5;
                vertical-align: bottom;
                width: 270px;
                background-color: #FFFFFF;
                padding: 3px 5px 5px 15px;
            }
            .busa-widget-roundedcorners {
                border-radius: 00px;
                border-style: solid;
                color: #aa1188;
                border-radius: 8px;
                behavior: url(ie-css3.htc);
                width: 90%
            }
            .search-query {
                width: 100%;
                outline: none;
                border: none;
            }
            .drop-down-btn {
                border: none;
                background-color: white;
                background-image: url('/sites/all/themes/bizusa/images/arrowdown.gif');
                background-repeat: no-repeat;
                width: 30px;
                height: 25px;
                cursor: pointer;
            }
            .searchoptions input,
            .searchoptions label {
                cursor: pointer;
            }
            .search-btn {
                border: none;
                background-color: white;
                background-image: url('/sites/all/themes/bizusa/images/searchglass.jpg');
                background-repeat: no-repeat;
                width: 40px;
                height: 25px;
                cursor: pointer;
            }
            .swimlane-list {
                list-style-image: url('');
            }
            .busa-widget-titletext {
                color: #8C763A;
                font-weight: bold;
            }
            .searchoptions {
                border-width: 2px;
                border-color: #E5E5E5;
                vertical-align: bottom;
                background-color: #FFFFFF;
                padding: 3px 5px 5px 15px;
                border-radius: 00px;
                border-style: solid;
                position: absolute;
                left: 5px;
                right: 5px;
                top: -1000px;
            }
            .subtitle-text {
                color: #8C763A;
                font-weight: bold;
                vertical-align: middle;
            }
            .swimlane-link-container {
                float: left;
                width: 170px;
                background-image: url('http://business.usa.gov/misc/bullet.gif');
                background-repeat: no-repeat;
                padding-left: 20px;
                background-position-y: 4px;
                height: 25px;
            }
        </style>
        <script type="text/javascript" src="/misc/jquery.js"></script>
        <script type="text/javascript">

                    // Variable init
                    searchOptionsAreVisible = false;
                    lastScreenHeight = 0;
                    ignoreNextBodyClick = false;

                    function submitSearch() {

                        jQuery('.search-query').focus();

                        htmlQuery = '';
                        fCount = 0;
                        jQuery('.narrow-search-container input:checked').each( function () {
                            if ( fCount > 0 ) {
                                htmlQuery += '&';
                            }
                            htmlQuery += 'f[' + fCount + ']=' + jQuery(this).attr('searchquery');
                            fCount++;
                        });

                        htmlQuery = jQuery('.search-query').val() + '?' + htmlQuery;
                        htmlQuery = 'http://business.usa.gov/search/site/' + htmlQuery;
                        window.open(htmlQuery);

                    }

                    function toggleSearchOptionsVisibility() {
                        if ( searchOptionsAreVisible == false ) {
                            showSearchOptions();
                        } else {
                            hideSearchOptions();
                        }
                    }

                    function showSearchOptions() {

                        jQuery('.searchoptions').css('top', 'auto');
                        searchOptionsAreVisible = true;

                        // Force responsiveUpdate() to run
                        lastScreenHeight = 0;
                        responsiveUpdate();
                    }

                    function hideSearchOptions() {
                        jQuery('.searchoptions').css('top', '-1000px');
                        searchOptionsAreVisible = false;
                    }

                    function responsiveUpdate() {

                        currentScreenHeight = jQuery(window).height();
                        if ( lastScreenHeight == currentScreenHeight ) {
                            return;
                        } else {
                            lastScreenHeight = currentScreenHeight;
                        }

                        // Hide swimlane items that get cut off
                        jQuery('.swimlane-link-container').show();
                        jQuery('.swimlane-link-container').each( function () {
                            var jqThis = jQuery(this);
                            var myPos = jqThis.position();
                            if ( myPos['top'] + 25 > currentScreenHeight ) {
                                jqThis.hide();
                            }
                        });

                        // Set the search options to scroll if nessesary
                        var searchOpts = jQuery('.searchoptions');
                        var searchOptsPos = searchOpts.position();
                        var searchOptsTop = searchOptsPos['top'];

                        searchOpts.css('overflow-y', '');
                        searchOpts.css('height', '');

                        if ( searchOptsTop + searchOpts.height() > currentScreenHeight ) {
                            searchOpts.css('overflow-y', 'scroll');
                            searchOpts.css('height', (currentScreenHeight - (searchOptsTop+15)) + 'px');
                        }

                    }

                    function getSwimlaneLinkColumCount() {
                        var swimlaneLinks = jQuery('.swimlane-link-container');
                        var count = 0;
                        while ( false ) {
                            count++;
                        }
                        return count;
                    }

                </script>

    </head>
    <body>

        <div class="widget-loading" style="width: 100%">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation"width="100%" height="100%">
                <tr>
                    <td align="center" valign="middle">
                        <a target="_blank" href="http://business.usa.gov/">
                            <img border=0 alt="Business USA" src="data:image/png;base64,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" />
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="widget-contents" style="display: none;" style="width: 100%">
            <input tabindex="1" type="button" id="hiddenlink" style="position: absolute; top: -1000px" value="Click here to goto BusinessUSA" onclick="window.open('http://business.usa.gov/');" />
            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                <tr align="center">
                    <td>
                        <a target="_blank" href="http://business.usa.gov/">
                            <img border=0 alt="Business USA" class="busa-logo" src="/sites/all/themes/bizusa/images/logo.png" />
                        </a>
                    </td>
                </tr>
                <tr align="left">
                    <td class="busa-widget-roundedcorners busa-widget-searchcontainer">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                            <tr>
                                <td width="98%">
                                    <form style="margin: 0px;" onsubmit="submitSearch(); return false;">
                                        <label style="display: none;" for="input-search-query">Search Query</label>
                                        <input id="input-search-query" tabindex="2" type="text" class="search-query" style="color: gray;" alt="Input your search query for Business USA here" value="Enter Keywords..." />
                                    </form>
                                </td>
                                <td width="1%">
                                    <input type="button" alt="View more search options" tabindex="3" class="drop-down-btn"  onclick="toggleSearchOptionsVisibility();" />
                                </td>
                                <td width="1%">
                                    <input tabindex="14" type="button" alt="Submit Search" class="search-btn" onclick="hideSearchOptions(); submitSearch();" onfocus="hideSearchOptions();"/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="searchoptions">
                            <div class="subtitle-text">
                                Narrow your search
                            </div>
                            <table>
                                <tr>
                                    <td>
                                        <div class="narrow-search-container">
                                            <input type="checkbox" tabindex="4" name="narrowSearch1" id="narrowSearch1" searchQuery="sm_field_program_wizard_type:Start%20a%20Business" />
                                            <label for="narrowSearch1">Start a Business</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox" tabindex="5" name="narrowSearch2" id="narrowSearch2" searchQuery="sm_field_program_wizard_type:Grow%20a%20Business" />
                                            <label for="narrowSearch2">Grow Your Business</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="6" name="narrowSearch3" id="narrowSearch3" searchQuery="sm_field_program_wizard_type:Finance" />
                                            <label for="narrowSearch3">Access Financing</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="7" name="narrowSearch4" id="narrowSearch4" searchQuery="sm_field_program_wizard_type:Begin%20Exporting" />
                                            <label for="narrowSearch4">Begin Exporting</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="8" name="narrowSearch5" id="narrowSearch5" searchQuery="sm_field_program_wizard_type:Expand%20Exporting" />
                                            <label for="narrowSearch5">Expand Exporting</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="9" name="narrowSearch0" id="narrowSearch0" searchQuery="sm_field_program_wizard_type:Contracting" />
                                            <label for="narrowSearch0">Find Opportunities</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="10" name="narrowSearch7" id="narrowSearch7" searchQuery="sm_field_program_owner_share:Veteran" />
                                            <label for="narrowSearch7">Resources for Veterans</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="11" name="narrowSearch8" id="narrowSearch8" searchQuery="" />
                                            <label for="narrowSearch8">Disaster Assistance</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="12" name="narrowSearch9" id="narrowSearch9" searchQuery="" />
                                            <label for="narrowSearch9">Hiring Employees</label>
                                        </div>
                                        <div class="narrow-search-container">
                                            <input type="checkbox"  tabindex="13" name="narrowSearch10" id="narrowSearch10" searchQuery="" />
                                            <label for="narrowSearch10">Invest in the USA</label>
                                        </div>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                            <tr>
                                <td width="15%" align="center" valign="center" class="busa-widget-titletext" nowrap>
                                    SELECT A<br/>TOPIC
                                </td>
                                <td width="85%" style="padding-left: 25px">
                                    <div class="swimlane-link-container"><a tabindex="15" target="_blank" href="http://business.usa.gov/start-a-business">Start a Business</a></div>
                                    <div class="swimlane-link-container"><a tabindex="16" target="_blank" href="http://business.usa.gov/resource/grow-your-business">Grow Your Business</a></div>
                                    <div class="swimlane-link-container"><a tabindex="17" target="_blank" href="http://business.usa.gov/access-financing">Access Financing</a></div>
                                    <div class="swimlane-link-container"><a tabindex="18" target="_blank" href="http://business.usa.gov/begin-exporting">Begin Exporting</a></div>
                                    <div class="swimlane-link-container"><a tabindex="19" target="_blank" href="http://business.usa.gov/expand-exporting">Expand Exporting</a></div>
                                    <div class="swimlane-link-container"><a tabindex="20" target="_blank" href="http://business.usa.gov/find-opportunities">Find Opportunities</a></div>
                                    <div class="swimlane-link-container"><a tabindex="21" target="_blank" href="http://business.usa.gov/veterans">Resources for Veterans</a></div>
                                    <div class="swimlane-link-container"><a tabindex="22" target="_blank" href="http://business.usa.gov/disaster-assistance">Disaster Assistance</a></div>
                                    <div class="swimlane-link-container"><a tabindex="23" target="_blank" href="http://business.usa.gov/healthcare">Health Care Changes</a></div>
                                    <div class="swimlane-link-container"><a tabindex="24" target="_blank" href="http://business.usa.gov/taxes-and-credits">Taxes and Credits</a></div>
                                    <div class="swimlane-link-container"><a tabindex="25" target="_blank" href="http://business.usa.gov/jobcenter-wizard">Hiring Employees</a></div>
                                    <div class="swimlane-link-container"><a tabindex="26" target="_blank" href="http://business.usa.gov/select-usa">Invest in the USA</a></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <script src="http://business.usa.gov/sites/all/themes/busa/js/webtrends.js" type="text/javascript"></script>
        <!-- ----------------------------------------------------------------------------------- -->
        <!-- Warning: The two script blocks below must remain inline. Moving them to an external -->
        <!-- JavaScript include file can cause serious problems with cross-domain tracking.      -->
        <!-- ----------------------------------------------------------------------------------- -->
        <script type="text/javascript">
        //<![CDATA[
        var _tag=new WebTrends();
        _tag.dcsGetId();
        //]]>
        </script>
        <script type="text/javascript">
        //<![CDATA[
        _tag.dcsCustom=function(){
        // Add custom parameters here.
        //_tag.DCSext.param_name=param_value;
        }
        _tag.dcsCollect();
        //]]>
        </script>
        <noscript>
        <div><img alt="" id="DCSIMG" width="1" height="1" src="//statse.webtrendslive.com/dcssthkz26bv0hkbbox8la5ra_8s3q/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=9.4.0&amp;dcssip=www.business.usa.gov"/></div>
        </noscript>

        <script type="text/javascript" src="http://business.usa.gov/sites/all/themes/bususa/js/federated-analytics.js?n0ui41"></script>

        <script>
              var _gaq = _gaq || [];_gaq.push(["_setAccount", "UA-19362636-19"]);_gaq.push(["_trackPageview"]);(function() {var ga = document.createElement("script");ga.type = "text/javascript";ga.async = true;ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(ga, s);})();
        </script>

        <script>
            var _gaq = _gaq || [];_gaq.push(["_setAccount", "UA-17367410-37"]);_gaq.push(["_trackPageview"]);(function() {var ga = document.createElement("script");ga.type = "text/javascript";ga.async = true;ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(ga, s);})();
        </script>
        <script type="text/javascript">

          // Variable init
          searchOptionsAreVisible = false;
          lastScreenHeight = 0;
          ignoreNextBodyClick = false;

          // On load script

          jQuery().ready( function () {

            // Hide loading message, show contents

            jQuery('.region-navigation').hide();
            jQuery('.region-footer').hide();
            jQuery('.widget-contents').show();
            jQuery('.widget-loading').hide();

            // Event handeler for checkboxes getting focus - show the search options
            jQuery('.narrow-search-container input').each( function () {
              jQuery(this).bind('focus', function () {
                showSearchOptions();
              });
            });

            // Event handeler for showing/hiding ghost text for the search-query input textbox
            jQuery('.search-query').bind('focus', function () {
              var jqThis = jQuery(this);
              if ( jqThis.val() == 'Enter Keywords...' ) {
                jqThis.val('');
                jqThis.css('color', 'black');
              }
            });
            jQuery('.search-query').bind('blur', function () {
              var jqThis = jQuery(this);
              if ( jqThis.val() == '' ) {
                jqThis.val('Enter Keywords...');
                jqThis.css('color', 'gray');
              }
            });

            // Event handeler to hide the drop-down menu when the user clicks outside the drop-down
            jQuery('.searchoptions, .drop-down-btn').bind('click', function () {
              ignoreNextBodyClick = true;
              setTimeout( function () {
                ignoreNextBodyClick = false;
              }, 50);
            });
            jQuery('body').bind('click', function () {
              if ( ignoreNextBodyClick == false ) {
                hideSearchOptions();
              }
            });

            // Constantly trigger showHideSwimlanesResponsively()
            setInterval("responsiveUpdate();", 500);

            // Set focus to the hidden BUSA link button (first in tab order)
            jQuery('#hiddenlink').focus();

          });
          </script>
    </body>
</html>
