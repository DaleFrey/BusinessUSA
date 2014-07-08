<!DOCTYPE html>
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" class="<?php print $classes; ?>" <?php print $rdf_namespaces; ?>>

    <head profile="<?php print $grddl_profile; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <?php print $head; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php print $head_title; ?>
        </title>
        <?php print $styles; ?>
        <?php print $scripts; ?>

        <!--[if lte IE 9]>
            <link rel="stylesheet" type="text/css" href="<?php print base_path() . path_to_theme() ?>/css/ie9.css" />
        <![endif]-->

        <!--[if lte IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php print base_path() . path_to_theme() ?>/css/desktop-ie8.css" />
            <link rel="stylesheet" type="text/css" href="<?php print base_path() . path_to_theme() ?>/css/ie8.css" />
        <![endif]-->
    </head>

    <body class="<?php print $classes; ?>" <?php print $attributes;?>>
        <noscript class="noscript-message" style="background-color: white; padding: 15px; margin: 15px; border: 1px solid gray;">
            JavaScript is currently disabled by the browser. Please enable JavaScript to access full functionality. 
            JavaScript is required on this web application. 
        </noscript>
        <a href="#contentArea" id="skipToContent" >Skip to Content</a>
            <?php if ( !empty($GLOBALS['overrideBodyMarkup']) ):  ?>
                <?php print $GLOBALS['overrideBodyMarkup']; ?>
            <?php else: ?>
                <?php print $page_top; ?>
                <?php print $page; ?>
                <?php print $page_bottom; ?>
            <?php endif; ?>
    </body>

</html>