<?php
    
    /* Inject JavaScript into the search-results page that will call trackNewUserSearch() through AJAX
        We want to do this through JavaScript since CDN?Akamai-Cache is a factor*/
    if ( substr($_SERVER['REQUEST_URI'], 0, 13) === '/search/site/' ) {
        $uriWithoutQueryString = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
        $searchQueryString = array_pop(explode('/', $uriWithoutQueryString));
        $searchFacetsArrayJson = json_encode( ( empty($_GET['f']) ? array() : $_GET['f'] ) );
        $thisFileName = basename(__FILE__);
        drupal_add_js(
            "
                /* The following script is injected from {$thisFileName} */
                var uid = readCookie('myusa_drupal_userid');
                if ( uid != null ) {
                    consoleLog('As per JavaScript in $thisFileName, this search will be tracked by trackNewUserSearch() for MyUSA integration, Coder Bookmark: CB-FMSJ3RE-BC');
                    var searchFacetsArray = {$searchFacetsArrayJson};
                    phpFunction('trackNewUserSearch', [uid, '{$searchQueryString}', searchFacetsArray, '{$_SERVER['REQUEST_URI']}'], {'return': ''}, function (functionRet) {
                        consoleLog('Return of {PHP}trackNewUserSearch() function was:');
                        consoleLog(functionRet);
                    });
                }
            ", 
            array(
                'type' => 'inline',
                'group' => JS_THEME,
            )
        );
    }
    
    /** int trackNewUserSearch(integer $uid, string $strSearchTerm, array $arrFacets, string $searchPageURL)
     *
     *  This function records a search query to be shown in the "My Recent Searches" section of the (MyUSA) User Dashboard.
     *
     *  In Drupal all "Past Searches" for a user are stored in the "Past Searches" (field_usr_past_searches) field which is attached to each user. See https://dev.business.usa.reisys.com/admin/config/people/accounts/fields/field_usr_past_searches for the field.
     *  Each file value is stored as text in the database, but is really a PHP serialize()ed array containing the following information (keys): search-term, facet-array, search-url
     *  This function:
     *      - adds a new text value under this field (the PHP serialize()ed array)
     *      - will not create duplicate search-records (where a record is considered a duplicate based on the search term/phrase, and not checking the facets in the search-query)
     *      - will ensure there are only a max of 10 values under this field at most (deleting older search-records)
     *
     *  Return codes:
     *      -1 = FAILURE: Invalid Drupal User ID given in the 1st parameter
     *      0 = FAILURE: Could not save Drupal user profile
     *      1 = SUCCESS
     */
    function trackNewUserSearch($uid, $strSearchTerm, $arrFacets, $searchPageURL) {
        
        // If the user is not authenticated with MyUSA, then bail
        if ( empty($uid) || intval($uid) === 0 ) {
            return -1;
        }
        
        // Load the target user profile
        $targetUser = user_load($uid);
        if ( $targetUser === false ) {
            return -1;
        }
        
        if ( !isset($targetUser->field_usr_past_searches) ) {
            return 0;
        }
        
        // Assume empty array for this user
        $userPastSearches = array();
        
        // Pull the past searches for this user, if there are any /* Coder Bookmark: CB-NT91BB4-BC */
        if ( !empty($targetUser->field_usr_past_searches) && !empty($targetUser->field_usr_past_searches['und']) ) {
            $userPastSearches = $targetUser->field_usr_past_searches['und'];
        }
        
        // Since we are going to add a new search-record for this user, we need to keep in mind that we dont want to create duplicates (when a user searches for the same phrase/query twice, changes the search-facets, or goest to the 2nd page of the search-result-set). So we shall remove all $userPastSearches records with this same search query/term/phrase 
        foreach ( $userPastSearches as $key => $userPastSearch ) {
            $searchRecordData = unserialize($userPastSearch['value']); // Each "Past Searches" field's value is stored as text in the database, but is PHP serialize()ed text. Refer to the help text at https://dev.business.usa.reisys.com/admin/config/people/accounts/fields/field_usr_past_searches for more information 
            if ( trim(strtolower($searchRecordData['search-term'])) == trim(strtolower($strSearchTerm)) ) {
                // Then is seems like this past search-record is a search with the same search-query/phrase (this comparison does not check the facets, only the search term(s))
                // We shall delete this [old] search record so we don't create a duplicate later in this function.
                unset( $userPastSearches[$key] );
            }
        }
        
        // Note that each "Past Searches" field's value is stored as text in the database, but is PHP serialize()ed text. Refer to the help text at https://dev.business.usa.reisys.com/admin/config/people/accounts/fields/field_usr_past_searches for more information 
        // Determine the new (text) value to store in the "Past Searches" field for this user (for this new search record)
        $newPastSearchTextValue = serialize(
            array(
                'search-term' => $strSearchTerm,
                'facet-array' => $arrFacets,
                'search-url' => $searchPageURL
            )
        );
        
        // Add the new "Past Searches" field to the user profile
        $userPastSearches[] = array(
            'value' => $newPastSearchTextValue,
            'format' => null,
            'safe_value' => $newPastSearchTextValue
        );
        
        // Clean Up - we shall only store up to 100 past searches for users, if there are more, delete the records of the older searches. Keep up to the 10 newest searches.
        if ( count($userPastSearches) > 100 ) {
            $userPastSearches = array_slice($userPastSearches, -100);
        }
        
        // Since the code above may have removed some elements in the $userPastSearches array, ensure the [numeric] array keys start at 0, incrementally increase, and don't skip a number.
        $userPastSearches = array_values($userPastSearches); // Reset the keys in this array
        
        // Since we have pulled out the PastSearches from the $targetUser profile at CB-NT91BB4-BC (and have probably altered it), place this data back into the $targetUser profile
        $targetUser->field_usr_past_searches['und'] = $userPastSearches;
        
        // Since the we have changed the "Past Searches" (field_usr_past_searches) field, we shall update the field_usr_psrchs_lastupdate  filed with the current timestamp - refer to help text in https://dev.business.usa.reisys.com/admin/config/people/accounts/fields/field_usr_psrchs_lastupdate for more information
        $targetUser->field_usr_psrchs_lastupdate = array(
            'und' => array(
                0 => time()
            )
        );
        
        // Save the user profile
        if ( user_save($targetUser) === false ) {
            return 0;
        } else {
            return 1;
        }
        
    }
    
    /** array getUserPastSearches(integer $uid, integer $countNewFromTime)
     *
     *  This function returns the record of search queries the given user has made, and how many new results there are for each search query.
     *  This function was built for the backend implementation of the "My Recent Searches" section on the (MyUSA) User Dashboard.
     *
     *  In Drupal all "Past Searches" for a user are stored in the "Past Searches" field which is attached to each user. See https://dev.business.usa.reisys.com/admin/config/people/accounts/fields/field_usr_past_searches for the field.
     *  Each file value is stored as text in the database, but is really a PHP serialize()ed array containing the following information (keys): search-term, facet-array, search-url
     *  This function:
     *      - pulls all the values stored under the "Past Searches" (field_usr_past_searches) field for the given user(-id)
     *      - Hits Solr to see how many items in the search-result-set are "new" (where "new" means results that reference nodes that were created after $countNewFromTime)
     *
     *  Returns:
     *      - FALSE on failure / invalid user.
     *      - Empty array ( return array(); ) when there are no search-records for the given user.
     *      - Array (search records) of arrays (search-record information) on success (see example-return below for array structure)
     *
     *  Example Return:
                Array (
                    [0] => Array (
                            [search-term] => Business
                            [facet-array] => Array (
                                    [0] => sm_field_program_industry:Manufacturing
                                    [1] => bundle:program
                                )
                            [search-url] => /search/site/Business?f[0]=bundle%3Aprogram&f[1]=sm_field_program_industry%3AManufacturing
                            [solr-ping-url] => http://solr42-dev.reisys.com:8080/solr/bizusa-dev/select?q=Business&fq=sm_field_program_industry%3AManufacturing+bundle%3Aprogram+ds_created%3A%5B2013-11-21T00%3A00%3A00Z+TO+%2A%5D&sort=ds_created+asc&rows=0&wt=json&indent=true
                            [solr-ping-rawresponce] => {"response":{"numFound":0,"start":0,"docs":[]}
                            [new-count] => 0
                        )
                    [1] => Array (
                            [search-term] => Health Care
                            [facet-array] => Array (
                                    [0] => sm_field_program_industry:Manufacturing
                                    [1] => bundle:program
                                )
                            [search-url] => /search/site/Business?f[0]=bundle%3Aprogram&f[1]=sm_field_program_industry%3AManufacturing
                            [solr-ping-url] => http://solr42-dev.reisys.com:8080/solr/bizusa-dev/select?q=Health Care&fq=sm_field_program_industry%3AManufacturing+bundle%3Aprogram+ds_created%3A%5B2013-11-21T00%3A00%3A00Z+TO+%2A%5D&sort=ds_created+asc&rows=0&wt=json&indent=true
                            [solr-ping-rawresponce] => {"response":{"numFound":0,"start":0,"docs":[]}
                            [new-count] => 0
                        )
                )
     */
    function getUserPastSearches($uid, $countNewFromTime, $seek = 0, $returnMaxCount = null) {
        
        // The return buffer, this function shall return what is in this buffer on success
        $ret = array();
        
        // If the user is not authenticated with MyUSA, then bail
        if ( empty($uid) || intval($uid) === 0 ) {
            return false;
        }
        
        // Load the target user profile
        $targetUser = user_load($uid);
        if ( $targetUser === false ) {
            return false;
        }
        
        // Return an empty array if there are no search-records for the given user.
        if ( empty($targetUser->field_usr_past_searches) || empty($targetUser->field_usr_past_searches['und']) || !is_array($targetUser->field_usr_past_searches['und']) || count($targetUser->field_usr_past_searches['und']) === 0 ) {
            return array();
        }
        
        // Get the year, month, and day of $countNewFromTime ( $countNewFromTime is expected to be a unix-timestamp / like what is returned in PHP by the time() function )
        $countNewFromYear = date('Y', $countNewFromTime);
        $countNewFromMonth = date('m', $countNewFromTime);
        $countNewFromDay = date('d', $countNewFromTime);
        
        // Get the URL to the Solr server (which is saved in settings within the Drupal database)
        $solrURL = false;
        $results = db_query("SELECT url FROM apachesolr_environment");
        foreach ($results as $result) {
            $solrURL = $result->url;
            break;
        }
        if ( $solrURL === false ) {
            return false;
        }
        
        // Foreach value in the "Past Searches" (field_usr_past_searches) field 
        $searchRecords = $targetUser->field_usr_past_searches['und'];
        $searchRecords = array_reverse($searchRecords); // We want to return the LAST $returnMaxCount records, not the first
        $searchRecords = array_slice($searchRecords, $seek, $returnMaxCount); // Seek and only return $returnMaxCount records
        foreach ( $searchRecords as $searchRecord ) { 
        
            $searchRecordData = unserialize($searchRecord['value']); // Each "Past Searches" field's value is stored as text in the database, but is PHP serialize()ed text. Refer to the help text at https://dev.business.usa.reisys.com/admin/config/people/accounts/fields/field_usr_past_searches for more information 
            
            // Compile the Solr query that will be used to see if there are any new search results for the query since $countNewFromTime
            $solrSearchTerms = $searchRecordData['search-term'];
            $solrFilterQuery = $searchRecordData['facet-array'];
            $solrFilterQuery[] = "ds_created:%5B{$countNewFromYear}-{$countNewFromMonth}-{$countNewFromDay}T00:00:00Z+TO+%2A%5D"; // Add this filter query to tell Solr only to find nodes index from the Drupal database that were created from <time-stamp> and on
            $solrFilterQuery = implode('+', $solrFilterQuery);
            $solrFilterQuery = str_replace(':', '%3A', $solrFilterQuery);
            $solrUrlWithQuery = $solrURL . "/select?q=$solrSearchTerms&fq=$solrFilterQuery&sort=ds_created+asc&rows=0&wt=json&indent=true";
            
            // Query Solr
            $respJson =  file_get_contents( $solrUrlWithQuery );
            $respObj = json_decode($respJson, true);
            
            // Note how many search results are new in the search result-set
            $searchRecordData['solr-ping-url'] = $solrUrlWithQuery;
            $searchRecordData['solr-ping-rawresponce'] = $respJson;
            $searchRecordData['new-count'] = $respObj['response']['numFound'];
            
            // Add this $searchRecordData to the array to be returned by this function
            if ( $solrSearchTerms !== '*' ) { // Dont show records of blank searches
                if ( stripos($solrSearchTerms, 'Start Searching') === false ) { // Dont show records of a "Start Searching..." searches
                    $ret[] = $searchRecordData;
                }
            }
            
        }
        
        // Return the $ret buffer 
        return $ret;
        
    }
    