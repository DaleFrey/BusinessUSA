<?php

    @ob_end_clean();
    while (@ob_end_clean());

    $tables = array();
    $results = db_query('show tables');
    foreach ( $results as $record ) {
        $tables[] = current( (array) $record );
    }
    
    $format = 'php';
    if ( !empty($_GET['format']) ) {
        $format = $_GET['format'];
    }
    
    switch ($format) {
        case 'json':
            print json_encode( $tables );
            break;
        case 'csv':
            print implode("\n", $tables);
            break;
        case 'null':
            break;
        case 'php':
            print serialize( $tables );
            break;
        default:
            print_r( $tables );
            break;
    }
    
    exit();