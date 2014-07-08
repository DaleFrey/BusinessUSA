<?php

    if ( !empty($_GET['invoke']) && intval($_GET['invoke']) === 1 ) {

        @ob_end_clean();
        while (@ob_end_clean());
        
        register_shutdown_function(
            function () {
            
                @ob_end_clean();
                while (@ob_end_clean());
                
                // Download the QA database to this environment
                print 'Downloading all non-content tables from the QA environment. This actually wont take too long, please wait... '; 
                flush(); sleep(1); ob_start(); print ' '; ob_flush(); @ob_end_flush(); flush(); sleep(2); flush(); ob_start(); print ' '; ob_flush();
                $dlResult = downloadQaDb();
                if ( $dlResult === false ) {
                    print 'Error - Could not download QA database. Please make sure you are on the REI network, or VPNed in.<br/>';
                    return;
                } else {
                    print 'done<br/>';
                }
                
                // Synch the database-dump supplied from the QA environment into this environment's MySQL database
                print 'Merging into MySQL database, <b>please do not interrupt this process...</b> ';
                consumeSqlFile('sites/default/files/synch-db.sql');
                print ' complete.<br/>';
                
                // Synch the database-dump supplied from the QA environment into this environment's MySQL database
                print 'Flushing Drupal caches, please wait... ';
                cache_clear_all();
                drupal_flush_all_caches();
                print ' done.<br/>';
                
                // We are now done
                print '<br/>';
                print 'Synch complete. All Drupal settings, blocks, Views, Feeds, Contexts, configuration, etc., has been migrated from QA into this environment<br/>';
                print 'Please note, that this process has most likely invalidated your session cookies, thus you will no longer be logged in on this environment.<br/>';
                print '<input type="button" value="Click here to goto the homepage" onclick="document.location=\'/user\'" />';
                print '<input type="button" value="Click here to log back in" onclick="document.location=\'/user\'" />';
            }
        );
        
        exit(); // Triggers the function directly above

    }

    function downloadQaDb() {
        if ( tryToDownloadQaDb('qa.business.usa.reisys.com', 80) === false ) {
            if ( tryToDownloadQaDb('qa.business.usa.reisys.com', 7100) === false ) {
                return false;
            }
        }
        return true;
    }

    function tryToDownloadQaDb($host = 'qa.business.usa.reisys.com', $port = 80, $urlPath = '/dev/db-synch/get-qa-database-drupal-settings') {
        $savePath = 'sites/default/files/synch-db.sql';
        @unlink($savePath);
        file_put_contents($savePath, @fopen("http://{$host}:{$port}{$urlPath}", 'r'));
        $fileHandel = fopen($savePath, 'r');
        $fileFirstLine = fread($fileHandel, 100);
        if ( strpos($fileFirstLine, 'MySQL dump') === false ) {
            return false;
        } else {
            return true;
        }
    }
    
    function consumeSqlFile($file, $delimiter = ';') {
        
        $ret = array();
        
        set_time_limit(0);
        
        // MySQL connect - bypass db_query()
        $dbAuth = $GLOBALS["databases"]["default"]["default"];
        $host = $dbAuth["host"];
        $user = $dbAuth["username"];
        $pass = $dbAuth["password"];
        $port = $dbAuth["port"];
        $db = $dbAuth["database"];
        if ( !empty($port) ) {
            $host .= ":" . $port;
        }
        $mysqlLink = mysql_connect($host, $user, $pass);
        mysql_select_db($db, $mysqlLink);
        
        if ( is_file($file) === true ) {
            $file = fopen($file, 'r');

            if ( is_resource($file) === true ) {
                $query = array();

                while ( feof($file) === false ) {
                    $query[] = fgets($file);

                    if ( preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1 ) {
                        $query = trim(implode('', $query));

                        if ( mysql_query($query, $mysqlLink) === false ) {
                            $ret[] = 'ERROR: ' . $query;
                        }

                        while ( ob_get_level() > 0 ) {
                            ob_end_flush();
                        }

                        flush();
                    }

                    if ( is_string($query) === true ) {
                        $query = array();
                    }
                }

                return fclose($file);
            }
        }

        return false;
    }


?>

<h2>[!!] NOTICE [!!]</h2>
This synch process will replace all Drupal-database (MySQL) <b>non-content tables</b> in your local environment, with the tables that 
currently exist from the BusinessUSA QA environment. Please remember that while this process will transfer all   
Drupal settings, blocks, Views, Feeds, Contexts, configuration, etc, into your local environment from QA - it is a table-<b>replacement
</b> sequence. So if you have any unsaved work that does not exists in QA (database-wise), it will be lost in this process unless you 
make said changes in QA first.</b><br/>
<br/>
<input type="button" onclick="jQuery('.continuebtn').removeAttr('disabled').show(); jQuery(this).attr('disabled', 'disabled')" value="I have the latest/updated SVN repository, and I have no work (in the database) to loose by replacing my database with QA's" /><br/>
<br/>
<input disabled style="display: none;" class="continuebtn" type="button" value="Continue with fast QA database-synch" onclick="document.write('Please wait, this process should not take any more than 5 minutes...'); document.location = '?invoke=1';" />