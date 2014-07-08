<?php
    if ( !empty($_GET) ) {
        ob_end_clean();
        ob_end_clean();
        ob_end_clean();
?>
<html>
<head>
        <style>
                body { min-width: auto !important; }
        </style>
        <style type="text/css" media="all">@import url("http://business.usa.gov/modules/system/system.base.css?mcq6ke");
        @import url("http://business.usa.gov/modules/system/system.menus.css?mcq6ke");
        @import url("http://business.usa.gov/modules/system/system.messages.css?mcq6ke");
        @import url("http://business.usa.gov/modules/system/system.theme.css?mcq6ke");</style>
        <style type="text/css" media="all">@import url("http://business.usa.gov/sites/all/modules/contrib/calendar/css/calendar_multiday.css?mcq6ke");
        @import url("http://business.usa.gov/modules/comment/comment.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/date/date_api/date.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/date/date_popup/themes/datepicker.1.7.css?mcq6ke");
        @import url("http://business.usa.gov/modules/field/theme/field.css?mcq6ke");
        @import url("http://business.usa.gov/modules/node/node.css?mcq6ke");
        @import url("http://business.usa.gov/modules/search/search.css?mcq6ke");
        @import url("http://business.usa.gov/modules/user/user.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/views/css/views.css?mcq6ke");
        </style>
        <style type="text/css" media="all">@import url("http://business.usa.gov/sites/all/modules/contrib/colorbox/styles/stockholmsyndrome/colorbox_stockholmsyndrome.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/ctools/css/ctools.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/dhtml_menu/dhtml_menu.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/nice_menus/nice_menus.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/nice_menus/nice_menus_default.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/rate/rate.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/libraries/superfish/css/superfish.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/libraries/superfish/css/superfish-vertical.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/libraries/superfish/css/superfish-navbar.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/views_slideshow/views_slideshow.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/custom/wizard/css/smart_wizard.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/custom/wizard/css/wizard.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/modules/contrib/extlink/extlink.css?mcq6ke");</style>
        <style type="text/css" media="all">@import url("http://business.usa.gov/sites/all/themes/omega/alpha/css/alpha-reset.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/alpha/css/alpha-mobile.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/alpha/css/alpha-alpha.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/omega/css/formalize.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/omega/css/omega-text.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/omega/css/omega-branding.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/omega/css/omega-menu.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/omega/css/omega-forms.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/omega/css/omega-visuals.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/bususa/css/global.css?mcq6ke");</style>
        <!--[if (lt IE 9)&(!IEMobile)]>
        <!-- Ensuring HTML comment is closed -->
        <style type="text/css" media="all">@import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default-normal.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/alpha/css/grid/alpha_default/normal/alpha-default-normal-12.css?mcq6ke");</style>
        <link rel="stylesheet" type="text/css" href="/FileManagement/Download/2b99703fe19a4fe58a1a24e73956d202">
        <![endif]-->
        <!--[if lt IE 9]> <script src="/FileManagement/Download/c10d4aac5d8247c6a84403df73a76c52" type="text/javascript"></script> <![endif]-->
        <!--[if gte IE 9]>
        <style type="text/css" media="all and (min-width: 740px) and (min-device-width: 740px), (max-device-width: 800px) and (min-width: 740px) and (orientation:landscape)">@import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default-narrow.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/alpha/css/grid/alpha_default/narrow/alpha-default-narrow-12.css?mcq6ke");</style>
        <!--<![endif]-->
        <!-- Ensuring HTML comment is closed -->
        <!--[if gte IE 9]>
        <!-- Ensuring HTML comment is closed -->
        <style type="text/css" media="all and (min-width: 980px) and (min-device-width: 980px), all and (max-device-width: 1024px) and (min-width: 1024px) and (orientation:landscape)">@import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default-normal.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/alpha/css/grid/alpha_default/normal/alpha-default-normal-12.css?mcq6ke");</style>
        <!--<![endif]-->
        <!-- Ensuring HTML comment is closed -->
        <!--[if gte IE 9]> 
        <!-- Ensuring HTML comment is closed -->
        <style type="text/css" media="all and (min-width: 1220px)">@import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/bususa/css/bususa-alpha-default-wide.css?mcq6ke");
        @import url("http://business.usa.gov/sites/all/themes/omega/alpha/css/grid/alpha_default/wide/alpha-default-wide-12.css?mcq6ke");
        </style>
        <!--<![endif]-->

        <style>
        body {
            margin: 0px;
        }
        @font-face {
            font-family: 'Bitter-Regular';
            src: url('/ics/support/accounts/30027/30030/Bitter-Regular-webfont.eot'); /* IE9 Compat Modes */
            src: url('/ics/support/accounts/30027/30030/Bitter-Regular-webfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                 url('/ics/support/accounts/30027/30030/Bitter-Regular-webfont.woff') format('woff'), /* Modern Browsers */
                 url('/ics/support/accounts/30027/30030/Bitter-Regular-webfont.ttf')  format('truetype'), /* Safari, Android, iOS */
                 url('/ics/support/accounts/30027/30030/Bitter-Regular-webfont.svg#svgFontName') format('svg'); /* Legacy iOS */
            }
        @font-face {
            font-family: 'Bitter-Bold';
            src: url('/ics/support/accounts/30027/30030/Bitter-Bold-webfont.eot'); /* IE9 Compat Modes */
            src: url('/ics/support/accounts/30027/30030/Bitter-Bold-webfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                 url('/ics/support/accounts/30027/30030/Bitter-Bold-webfont.woff') format('woff'), /* Modern Browsers */
                 url('/ics/support/accounts/30027/30030/Bitter-Bold-webfont.ttf')  format('truetype'), /* Safari, Android, iOS */
                 url('/ics/support/accounts/30027/30030/Bitter-Bold-webfont.svg#svgFontName') format('svg'); /* Legacy iOS */
            }
        @font-face {
            font-family: 'Bitter-Italic';
            src: url('/ics/support/accounts/30027/30030/Bitter-Italic-webfont.eot'); /* IE9 Compat Modes */
            src: url('/ics/support/accounts/30027/30030/Bitter-Italic-webfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                 url('/ics/support/accounts/30027/30030/Bitter-Italic-webfont.woff') format('woff'), /* Modern Browsers */
                 url('/ics/support/accounts/30027/30030/Bitter-Italic-webfont.ttf')  format('truetype'), /* Safari, Android, iOS */
                 url('/ics/support/accounts/30027/30030/Bitter-Italic-webfont.svg#svgFontName') format('svg'); /* Legacy iOS */
            }

        /* Changes 12-21-2012 - Adam Hong*/

        #block-search-form .form-actions input {
            right: 0 !important;
        }

        #block-search-form .form-item input {
            padding-left: 15px;
        }

        /* Changes End */
            
        li {
            margin-left: 30px;
        }

        select {
            width: 300px;
            height: 35px;
            font-family: 'Bitter-Regular', Times, serif;
            color: #8F8F8F;
            max-width: 100%;
        }

        #parature_navigation li {
            margin-left: 30px;
        }

        #parature_wrapper .forminput {
            margin-top: 1em;
            margin-bottom: 1em;
        }

        #parature_wrapper .forminput input {
            border: 0;
            padding: 0 55px 0 10px;
            height: 50px;
            width: 100%;
            background: #F3F3F3;
            font-family: 'Bitter-Regular', Times, serif;
            color: #8F8F8F;
        }

        #parature_wrapper .forminput textarea {
            border: 0;
            padding: 10px 55px 0 10px;
            background: #F3F3F3;
            font-family: 'Bitter-Regular', Times, serif;
            color: #8F8F8F;
            height: 150px;
        }

        span.colon {
            display: none;
        }

        .formlabel.notification, .forminput.notification {
            display: none;
        }

        #buttonContainer input,
        #parature_wrapper button,
        #parature_wrapper .formButton .forminput input {
            padding: 15px 35px;
            width: auto;
            height: auto;
            background: #15567B;
            font: bold 15px 'Bitter-Regular', Times, serif;
            color: white;
            display: inline-block;
            text-decoration: none;
            text-align: center;
            border-radius: 0;
        }

        #parature_wrapper .formlabel.feedbackType {
            display: block;
        }

        #parature_wrapper #parature_search {
            display: none;
        }

        .sidebar-content {
            height: 160px;
            margin: 25px 0;
            padding: 10px;
        }

        .sidebar-content h4 {
            text-align: center;
            color: #15567B;
        }

        legend {
            font-size: 1.5em;
            margin: 10px 0;
            color: #11567B;
        }
        #poweredby {
            text-align: center;
        }

        ul.splash {
            margin: 0;
        }

        #parature_wrapper ul.splash .splash_description {
            display: none;
            position: absolute;
        }

        span.titledesc {
            display: block;
            margin: 10px 0;
        }

        ol.mostpopular, ol.mostrecent {
            float: none;
            display: block;
            width: auto;
            background: #F3F3F3;
            padding-bottom: 20px;
        }

        ol li .item, ul li .item {
            float: right;
        }

        ol.mostrecent {
            float: none;
        }

        ol.mostrecent li, ol.mostpopular li, #myrecent li, ol.module_folder_list li{
            list-style : none;
            margin: 0 20px;
        }

        li.heading {
            text-transform: uppercase;
            font: 25px/35px 'Bitter-Bold', Times, serif;
            margin-bottom: 25px !important;
            padding-top: 20px !important;
            margin-left: 20px;
        }

        li.heading .item {
            font-size: .5em;
        }

        h4.treeViewRoot {
            margin-bottom: 0;
        }

        .hiddenfield {
            display: none !important;
        }

        ul.mainmenu, ul.submenu, #welcome, ul.utilitymenu {
            display: none;
        }

        .region-sidebar-second-inner {
            padding: 15px;
        }

        #kbTree {
            display: none;
        }

        body.kbanswer_asp #kbTree, body.kbsplash_asp #kbTree {
            display: block;
        }

        .customerEmailList {
            display: none !important;
        }

        textarea, select[size], select[multiple] {
            height: auto;
        }

        #breadcrumbs {
            color: #4D4D4D;
            font: italic 12px 'Bitter-Regular', Times, serif;
        }

        #parature_wrapper {
            position: relative;
        }

        .cssLink {
            -webkit-appearance: none;
            -moz-border-radius: 0;
            -webkit-border-radius: 0;
            -moz-background-clip: padding;
            -webkit-background-clip: padding;
            background-clip: padding-box;
            border-radius: 0;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0, white), color-stop(1, #DDD));
            background: -moz-linear-gradient(top center, white 0%, #DDD 100%);
            border: 1px solid;
            border-color: #DDD #BBB #999;
            cursor: pointer;
            color: #333;
            font: normal 14px/1.2 Arial, sans-serif;
            outline: 0;
            overflow: visible;
            padding: 3px 10px 4px;
            text-shadow: white 0 1px 1px;
            width: auto;
        }

        #voteBox img {
            margin: 0 3px;
        }

        #breadcrumbs {
            margin-bottom: 10px;
        }

        #breadcrumbs .spacer {
            font-size: .6em;
            margin: 0 5px;
            vertical-align: text-top;
        }

        .downloadLinkDiv input {
            margin: 15px 0;
        }

        fieldset.attachment legend {
            display: none;
        }

        body.kbresult_asp span.titledesc {
            font-family: 'Bitter-Regular', Times, serif;
            font-size: 22px;
            font-weight: bold;
            color: #444;
            letter-spacing: -1px;
            font-style: italic;
            margin-bottom: 20px;
        }

        li.searchResultItem  {
            list-style: none;
            margin-left: 0;
            padding-left: 105px;
            background: url(/FileManagement/Download/bf2db6ce65124a88a99288f648a54ab0) 15px 0 no-repeat;
            margin-bottom: 20px;
        }

        a.articleLink {
            color: #15567B;
            text-decoration: none;
            font: normal 16px 'Bitter-Bold', Times, serif;
            margin-bottom: 5px;
            display: block;
            float: left;
        }

        span.articleText {
            clear: both;
            display: block;
            margin-bottom: 10px;
        }

        span.articleLocation {
            font-weight: bold;
        }

        input#finish {
            float: right;
        }

        #topicInformation {
            margin: 10px;
            float: left;
        }

        #kbutility {
            margin: 10px;
            float: right;
        }

        ul.splash li a {
            background-repeat: no-repeat;
        }


        body.splash_asp #liveChat {
            display: none;
        }

        #kbGlance {
            margin-top: 10px;
        }

        #articleAnswer {
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #d1d1d1;
        }

        #relatedTopics {
            margin: 10px 0;
        }

            li#knowledge a {
                background-image: url(/FileManagement/Download/39bb5888d36c40d8a1d6773c85635208);
            }

            li#ticket a {
                background-image: url(/FileManagement/Download/db533f37d3f142e0bee06c5b834a80b6);
            }

            li#realtime a {
                background-image: url(/FileManagement/Download/abbd8e3f02dd41ddbce8e26649c145ec);
                cursor: default;
            }

            li#realtime.available a {
                background-image: url(/FileManagement/Download/941195a76f1c45ef96abd7f30db9778c);
                cursor: pointer;
            }
            li#phone a {
                background-image:url(/ics/support/accounts/30027/icon-fs5.png);
            }

            li#feedback a {
                background-image: url(/FileManagement/Download/96daa864de824656a26d08e067102b78);
            }
            
            #parature_wrapper ul.splash li a.splash_link {
                background-position: 20px center;
            }
            
            #parature_wrapper ul.splash li#feedback  {
                margin-right: 0px;
            }
            
        /* Toolbar */

        #contentPage {
            position: fixed;
            height: 100%;
            width: 100%;
        }

        #toolBar {
            height: 50px;
            background: white;
        }

        #toolBar li {
            float: left;
            list-style: none;
            height: 20px;
        }

        #toolbarButtons {
            float: left;
        }

        #toolbarUtility {
            float: right;
            margin-right: 10px;
        }

        #contentFrame {
            position: fixed;
            top: 50px;
            left: 0;
            height: 95%;
            width: 100%;
            border-top: 1px solid #999;
        }

        #toolBarLogo {
            margin: 10px;
            float: left;
        }

        #closeFrame {
            cursor: pointer;
        }

        #menu-1338-1 {
            display: none;
        }

        /* Toolbar End */

        @media all {
            #parature_wrapper ul.splash li {
                background: #46c0b2;
                margin-bottom: 1px;
                margin-left: 0px;
            }
            #parature_wrapper ul.splash li a {
                color: white;
                font: normal 19px 'Bitter-Regular', Times, serif;
                display: block;
                padding: 20px 0 22px 70px;
                letter-spacing: 0;
            }
            
            #region-sidebar-second {
                display: none;
            }
        }	

        @media all and (min-width: 740px) and (min-device-width: 740px), (max-device-width: 800px) and (min-width: 740px) and (orientation:landscape) {
            
            #menu-1338-1 {
                display: block;
            }
            
            li#knowledge a {
                background-image: url(/FileManagement/Download/2c93cbbf71624c1fbb935e5877137e85);
            }

            li#download a {
                background-image: url(/FileManagement/Download/8663149c1d4f4e8ab6ca7ce9a6815f73);
            }

            li#ticket a {
                background-image: url(/FileManagement/Download/c8941b8c4b0f403087f94add1cb8c3ce);
            }

            li#feedback a {
                background-image: url(/FileManagement/Download/fe0a5831de27453f9d6e1e33a6721e1c);
            }

            li#realtime a {
                background-image: url(/FileManagement/Download/6b35fbf01c6e449db9b6006678bb2249);
                cursor: default;
            }
            li#phone a {
                background-image:url(/ics/support/accounts/30027/icon-fs4.png);
            }
            li#realtime.available a {
                background-image: url(/FileManagement/Download/93f5e99cb4ce4f3890004ed1c4323602);
                cursor: pointer;
            }
            
            ol.mostpopular, ol.mostrecent {
                float: left;
                display: block;
                width: 49.5%;
            }
            
            ol.mostpopular {
                margin-right: 1%;
            }
            
            body.splash_asp #region-sidebar-second {
                width: auto;
                float: none;
                display: block;
                position: static;
                margin: 0;
            }
            
            body.splash_asp #region-content {
                margin: 0 10px;
                width: auto;
                display: block;
                float: none;
            }
            
            body.splash_asp .sidebar-content {
                min-height: 160px;
                margin: 25px 0;
                padding: 10px;
                float: left;
                width: 29%;
                margin-right: 1%;
            }
            
            #parature_wrapper ul.splash li {
                list-style: none;
                text-align: center;
                background: #46c0b2;
                display: inline-block;
                float: left;
                margin-right: 10px;
                margin-bottom: 10px;
                color: white;
            }

            #parature_wrapper ul.splash li a.splash_link {
                background-position: center 30px;
                font-family: 'Bitter-Regular', Times, serif;
                color: white;
                letter-spacing: 0;
                display: block;
                padding: 95px 10px 25px;
                width: 112px;
                height: 20px;
                font-size: 15px;
            }
            
            #region-sidebar-second {
                display: block;
            }
            
            .sidebar-content{
                text-align: center;
            }
            
            .sidebar-content img {
                margin-bottom: 10px;
            }
            
            #faqs.sidebar-content img {
                margin-top: -10px;
            }
            
            #share.sidebar-content img {
                margin-top: -10px;
            }
            
            .sidebar-content .caption {
                font-size: .9em;
                text-align: center;
            }
            
        }

        @media all and (min-width: 980px) and (min-device-width: 980px), all and (max-device-width: 1024px) and (min-width: 1024px) and (orientation:landscape) {
            
            body.splash_asp #region-sidebar-second {
                width: auto;
                float: none;
                display: block;
                position: static;
                margin: 0;
            }
            
            body.splash_asp #region-content {
                margin: 0 10px;
                width: auto;
                display: block;
                float: none;
            }
            
            body.splash_asp .sidebar-content {
                min-height: 160px;
                margin: 25px 0;
                padding: 10px;
                float: left;
                width: 30%;
                margin-right: 1%;
            }
            
            #parature_wrapper ul.splash li {
                list-style: none;
                text-align: center;
                background: #46c0b2;
                display: inline-block;
                float: left;
                margin-right: 10px;
                margin-bottom: 10px;
                color: white;
            }

            #parature_wrapper ul.splash li a.splash_link {
                background-position: center 50px;
                font-family: 'Bitter-Regular', Times, serif;
                color: white;
                letter-spacing: 0;
                display: block;
                padding: 120px 10px 15px;
                width: 160px;
                height: 50px;
                background-position: center 50px;
                font-size: 17px;
            }
            
            #region-sidebar-second {
                display: block;
            }
        } 

        @media all and (min-width: 1220px) {
            
            body.splash_asp #region-sidebar-second {
                width: 280px;
                float: left;
                display: inline;
                position: relative;
                margin: 0 10px;
            }
            
            body.splash_asp #region-content {
                width: 880px;
                display: inline;
                float: left;
                margin: 0 10px;
            }
            
            
            body.splash_asp .sidebar-content {
                margin: 25px 0;
                padding: 10px;
                float: none;
                width: auto;
            }
            
            #parature_wrapper ul.splash li {
                list-style: none;
                text-align: center;
                background: #46c0b2;
                display: inline-block;
                float: left;
                margin-right: 10px;
                margin-bottom: 10px;
                color: white;
            }

            #parature_wrapper ul.splash li a.splash_link {
                padding: 113px 10px 20px;
                width: 148px;
                height: 35px;
                background-position: center 45px;
                font-family: 'Bitter-Regular', Times, serif;
                font-size: 16px;
                color: white;
                letter-spacing: 0;
                display: block;
            }
            li#phone a {
                background-image:url(/ics/support/accounts/30027/icon-fs4.png);
            }
            
            #region-sidebar-second {
                display: block;
            }
        }
        </style>
</head>
<body>

    <div id="toolBar">
        <a target="_blank" href="http://business.usa.gov/"><img id="toolBarLogo" src="http://help.businessusa.gov/ics/support/accounts/30027/logo.png"></a>
        <ul class="clearfix" id="toolbarButtons">
            <li><a target="_blank" href="http://help.businessusa.gov/ics/support/KBSplash.asp">Browse Knowledgebase</a></li>
            <li><a target="_blank" href="http://help.business.usa.gov/ics/support/ticketnewwizard.asp?style=classic&feedback=true">Submit Feedback</a></li>
            <!-- id="toolbarChat"><a>Chat with a Specialist</a> -->
            <li><a target="_blank" href="http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic">Ask a Question</a></li>
        </ul>
        <ul class="clearfix" id="toolbarUtility">
            <li><a id="closeFrame" href="javascript: if ( confirm('Closing this frame will cause you to leave the current page that you are viewing. Continue?') ) { parent.document.location = '<?php print $_GET['closeTo']; ?>'; } ;" target="_parent">Close Frame</a></li>
        </ul>
    </div>
    

    <!-- START OF SmartSource Data Collector TAG -->
    <!-- Copyright (c) 1996-2012 Webtrends Inc.  All rights reserved. -->
    <!-- Version: 9.4.0 -->
    <!-- Tag Builder Version: 3.3  -->
    <!-- Created: 1/18/2012 6:36:56 PM -->
    <script src="/sites/all/themes/busa/js/webtrends.js" type="text/javascript"></script>
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
    <div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="//statse.webtrendslive.com/dcssthkz26bv0hkbbox8la5ra_8s3q/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=9.4.0&amp;dcssip=www.business.usa.gov"/></div>
    </noscript>
    <!-- END OF SmartSource Data Collector TAG -->
    
    <script type="text/javascript" src="http://business.usa.gov/sites/all/themes/bususa/js/federated-analytics.js"></script>
    
    <script>
          var _gaq = _gaq || [];_gaq.push(["_setAccount", "UA-19362636-19"]);_gaq.push(["_trackPageview"]);(function() {var ga = document.createElement("script");ga.type = "text/javascript";ga.async = true;ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(ga, s);})();
    </script>
    
    <script>
        var _gaq = _gaq || [];_gaq.push(["_setAccount", "UA-17367410-37"]);_gaq.push(["_trackPageview"]);(function() {var ga = document.createElement("script");ga.type = "text/javascript";ga.async = true;ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(ga, s);})();
    </script>
    
</body>
</html>

<?php
        exit();
    }
?>