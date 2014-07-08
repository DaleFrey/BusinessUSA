<?php

    $html = '';

// Enabel debug message if the current user is the administrator
    $enabelDebug = false;
    if ( strpos(request_uri(), '-DEBUG-WIZARD-') !== false ) {
        $enabelDebug = true;
    }

// Get the list of tags used by this wizard
    $allWizTags = array_keys($_REQUEST['allTags']);
    $tagIsSelected = $_REQUEST['allTags'];

// Generate results
    $wizardResults =  new stdClass;
    $wizardResults->results = array(
        'solicitations' => array(),
        'federal_register' => array(),
        'patents' => array(),
        'challenges' => array(),
        'grants' => array(),
        'sbir_topics'  => array()
    );

// Get the URL to the Solr server (which is saved in settings within the Drupal database)
    $solrURL = false;
    $queryResults = db_query("SELECT url FROM apachesolr_environment");
    foreach ($queryResults as $result) {
        $solrURL = $result->url;
        break;
    }
    if ( $solrURL === false ) {
        header('Content-type: application/json');
        print json_encode(
            array(
                'html' => 'FATAL ERROR - Could not determin the Solr server URL - Coder Bookmark: CB-055UE35-BC'
            )
        );
        return false;
    }

// Generate Results
    $selectedItems = array_keys($tagIsSelected, '1');
    $cTypes = array();

    for ($i = 0; $i < count($selectedItems); ++$i){
        switch ($selectedItems[$i]) {
            case "solic":
                $cTypes['solicitations'] = 'solicitations';
                break;
            case "challenges":
                $cTypes['challenges'] = 'challenges';
                break;
            case "fedregs":
                $cTypes['federal_register'] = 'federal_register';
                break;
            case "grants":
                $cTypes['grants'] = 'grants';
                break;
            case "patents":
                $cTypes['patent'] = 'patent';
                break;
            case "sbirtopics":
                $cTypes['green_sbir_topic'] = 'sbir_topics';
                break;
        }
    }

    /*$cTypes = array(
        'solicitations' => 'solicitations',
        'federal_register' => 'federal_register',
        'patent' => 'patents',
        'challenges' => 'challenges',
        'grants' => 'grants',
        'green_sbir_topic' => 'sbir_topics'
    ); */// A mapping of Drupal content-type-[machine-names] and what they are called in wizard-results-template-divide-by-ctype.php (at Coder Bookmark: CB-FH4IYLT-BC)

    $wizardResults->solrUrlWithQuery = array();

    if (count($cTypes) == 0){
        $cTypes['solicitations'] = 'solicitations';
        $cTypes['challenges'] = 'challenges';
        $cTypes['federal_register'] = 'federal_register';
        $cTypes['grants'] = 'grants';
        $cTypes['patent'] = 'patent';
        $cTypes['green_sbir_topic'] = 'sbir_topics';
    }

    foreach ( $cTypes as $drupalMacName => $wizardTypeName ) {

        // Compile the Solr query that will be used to see if there are any new search results for the query since $countNewFromTime
        $solrSearchTerms = urlencode($_REQUEST['allTags']['greentext']);
        $solrFilterQuery = 'bundle%3A' . $drupalMacName;
        $solrFieldsToReturn = 'label+teaser+entity_id';
        $solrUrlWithQuery = $solrURL . "/select?q={$solrSearchTerms}&fq={$solrFilterQuery}&fl={$solrFieldsToReturn}&rows=100&wt=json&indent=false";

        $wizardResults->solrUrlWithQuery[] = $solrUrlWithQuery;

        // Query Solr
        $respJson =  file_get_contents( $solrUrlWithQuery );
        $wizardResults->respJson = $respJson;
        $respObj = json_decode($respJson, true);
        $wizardResults->respObj = $respObj;

        // If there was a Solr response...
        if ( !empty($respObj['response']['docs']) ) {

            // Foreach result in the response from Solr...
            foreach ( $respObj['response']['docs'] as $solrResult ) {
                $wizardResults->results[$wizardTypeName][] = array(
                    'nid' => $solrResult['entity_id'],
                    'title' => $solrResult['label'],
                    'snippet' => $solrResult['teaser'],
                    'tags' => array(),
                    'tag_count' => 0,
                    'all_tags' => array(),
                    'type' => $wizardTypeName,
                    'promoted' => 0
                );
            }
        }
    }

// Create an renderable array for wizard results, to send into theme('yawizard_sections' <RenderableArray>)
    $wizardResultsRenderableArray = array(
        'sections' => $wizardResults->results,
        'titles' => array(
            'solicitations' => 'Recommended Solicitations',
            'federal_register' => 'Recommended Federal Register',
            'patent' => 'Recommended Patents',
            'challenges' => 'Recommended Challenges',
            'grants' => 'Recommended Grants',
            'sbir_topics'  => 'Recommended SBIR Topics'
        ),
        'legend' => array(
            'solicitations' => array(
                'title' => 'Solicitations',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/solicitations.png'
            ),
            'federal_register' => array(
                'title' => 'Federal Registers',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/federal_registration.png'
            ),
            'patent' => array(
                'title' => 'Patents',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/patent.png'
            ),
            'challenges' => array(
                'title' => 'Challenges',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/challenge.png'
            ),
            'grants' => array(
                'title' => 'Grants',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/grants.png'
            ),
            'sbir_topics' => array(
                'title' => 'SBIR Topics',
                'img' => 'sites/all/themes/bizusa/images/content-type-icons-small/resources.png'
            ),
        ),
        'sideBars' => array(
           'sidebar-articles' => overridable('sites/all/pages/find-green-opportunities/sidebar-articles.php'),
      )
    );

// Save the Wizard-Results to an Excel file (so the user can download an .xls if desired)
    // Note: saveWizardResultsToExcel() is defined in WizardResults-ExportToExcelOrEmail.php
    $excelExportedResultsFilePath = saveWizardResultsToExcel($wizardResultsRenderableArray);
    $excelExportedResultsFilePath = '/' . ltrim($excelExportedResultsFilePath, '/');
    $wizardResultsRenderableArray['excelPath'] = $excelExportedResultsFilePath;

// Render results HTML
    //kprint_r( $wizardResults );
    print theme('yawizard_sections', $wizardResultsRenderableArray);

?>
<script>
    $(document).ready(function()
    {

        jQuery('a').each( function () {
            var jqThis = jQuery(this);
            if (jqThis.attr('href') && typeof jqThis.attr('href') != "undefined"){
                if( jqThis.attr("href").indexOf(location.hostname)==-1 && (jqThis.attr('href').indexOf('http://') == 0||jqThis.attr('href').indexOf('https://') == 0) )
                {
                    var newHref = '/external-site?ccontent=' + jqThis.attr('href');
                    jqThis.attr('href', newHref);
                    jqThis.attr('target','_blank');
                }
            }
        });
    });
</script>


