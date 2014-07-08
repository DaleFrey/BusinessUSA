<?php

// Load everything from the excel spreadsheet into a variable
$spreadsheetRows = ya_wizard_excelToArray(__DIR__ . '/sidebar-example-articles.xls'); // ya_wizard_excelToArray() reads a target Excel file, and returns an array of all the rows/cells in the target spreadsheet

// Debug
dsm("We have all rows from the sidebar-example-articles.xls spreadsheet in \$spreadsheetRows now.");
dsm("\$spreadsheetRows looks like this:");
dsm( $spreadsheetRows );

// Based on the information in the excel spreadsheet, render the markup for each individual results to be put into pagination 
$resultMarkupArray = array();
foreach ( $spreadsheetRows as $row ) {
    $rowAssoc = $row['assoc'];
    $resultMarkupArray[]= '
        <div class="sidebar-article-result" rendersource="' . basename(__FILE__) . '">
            <div class="wizard-result-title">
                <a target="_blank" href="' . $rowAssoc['link'] . '">
                    ' . $rowAssoc['title'] . '
                </a>
            </div>
            <div class="wizard-result-snippet">
                ' . $rowAssoc['snippet'] . '
            </div>
        </div>
    ';
    
}

// Debug
dsm("We have markup for each individual results to be put into pagination in \$resultMarkupArray");
dsm("\$resultMarkupArray looks like this:");
dsm( $resultMarkupArray );

// Using the Drupal theme system, trigger the correct yawizard_pagedresults.tpl.php file with the given variables
print theme(
    'yawizard_pagedresults', 
    array(
        'resultsPerPage' => 5,
        'resultMarkups' => $resultMarkupArray
    )
);