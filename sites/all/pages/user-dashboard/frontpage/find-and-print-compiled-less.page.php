<?php

$filePath = 'sites/all/pages/user-dashboard/frontpage/.page.less';
$dirPath = $pthInfo['dirname'];
$hash = _less_get_dir();

$cssResidesWithinPath = "sites/default/files/less/{$hash}/sites/all/pages/user-dashboard/frontpage/";

foreach ( scandir($cssResidesWithinPath) as $file ) {
    if ( substr($file, 0, 5) === 'page.' && substr($file, -4) === '.css' ) {
        while(@ob_end_clean());
        header("Content-type: text/css");
        header("X-Content-Type-Options: nosniff");
        readfile($cssResidesWithinPath . $file);
        exit();
    }
}

//print 'NOT FOUND';
error_log('frontpage/.page.less WORKAROUND - REFACTOR ME! - Coder Bookmark: CB-KJGUZO1-BC');
file_get_contents("http://{$_SERVER['HTTP_HOST']}/user-dashboard/frontpage?uid=1");
drupal_goto( 'user-dashboard/frontpage/find-and-print-compiled-less?retryTime=' . time() );