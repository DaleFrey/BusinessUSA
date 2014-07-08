<div class="jobcenter-mostpopulararticles">
    <div class="wizard-health-sidebar-title" >
        Most Popular Articles
    </div>
    <div class="wizard-health-sidebar-desc">
    <?php

    /**
     * Created by PhpStorm.
     * User: naga.tejaswini
     * Date: 4/17/14
     * Time: 2:09 PM
     */
    // Load everything from the excel spreadsheet into a variable
    $spreadsheetRows = ya_wizard_excelToArray(__DIR__ . '/HiringEmployees-Articles.xls'); // ya_wizard_excelToArray() reads a target Excel file, and returns an array of all the rows/cells in the target spreadsheet

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
                <a target="_blank" href="' . $rowAssoc['URL'] . '">
                    ' . $rowAssoc['Title'] . '
                </a>
            </div>
            <div class="wizard-result-snippet">
                '. truncate_utf8($rowAssoc['Description'], 100, true, true) . '<br/>' . '<a class="readmore" target="_blank" href="' . $rowAssoc['URL'] . '"> read more </a>
            </div>

        </div>
    ';
    }
    // Using the Drupal theme system, trigger the correct yawizard_pagedresults.tpl.php file with the given variables
    print theme(
        'yawizard_pagedresults',
        array(
            'resultsPerPage' => 4,
            'resultMarkups' => $resultMarkupArray
        )
    );
    ?>

</div>