<?php

/**
 * Implements HOOK_preprocess_HOOK 's implementation of HOOK_preprocess_html()
 * Adds a "javascript-is-disabled" class onto the <BODY> tag (redered HTML output from the server)
 */
hooks_reaction_add("preprocess_html",
	function (&$variables) {
        // Add a class onto the html and body tag called "not-yet-ready"
        $variables['classes_array'][] = 'javascript-is-disabled';
    }
);

$nameOfThisScript = basename(__FILE__);
drupal_add_js(
    "
        /* The following is added from the {$nameOfThisScript} file */
        jQuery(document).ready( function () {
            jQuery('body').removeClass('javascript-is-disabled');
        });
    ", 
    array(
        'type' => 'inline',
        'group' => JS_LIBRARY,
        'weight' => -19.5, /* This should place this script to load directly after jQuery core is loaded */
    )
);

drupal_add_css(
    "
        /* 
            The following is added from the {$nameOfThisScript} file.
            
            These styles are designed to hide everything within the 
            body of all pages, but allow the <noscript> tag to show.
            These styles should be disabeled by JavaScript
            (thus forcing users to enabel JavaScript for the site)
        */
        body.not-logged-in.javascript-is-disabled #navigation,
        body.not-logged-in.javascript-is-disabled .helpArea,
        body.not-logged-in.javascript-is-disabled .wrapper,
        body.not-logged-in.javascript-is-disabled .region,
        body.not-logged-in.javascript-is-disabled #bottom-bizusa-footer,
        body.not-logged-in.javascript-is-disabled #admin-menu {
                opacity: 0;
                -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';
        }
    ", 
    "inline"
);