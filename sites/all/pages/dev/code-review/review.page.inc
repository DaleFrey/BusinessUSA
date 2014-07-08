<?php

    function codereview_getCompiledDiffForFileAcrossTicket($jiraTicketNumber, $filePath, $svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/') {
        
        $commits = codereview_getCommitsForTicket($jiraTicketNumber);
        return codereview_getCompiledDiffForFileAcrossCommits($commits, $filePath, $svnPath);
    }

    function codereview_getCompiledDiffForFileAcrossCommits($commits, $filePath, $svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/') {
        
        $tmpDir = 'sites/default/files/tmp/compdiff' . time();
        mkdir($tmpDir, 0777, true);
        $tmpName = $tmpDir . '/' . basename($filePath);
        
        // Catch missing data
        if ( count($commits) === 0 ) {
            return 'Error - Could not find any commits for the file ' . $filePath;
        }
        
        // Checkout the file from its original status
        error_log( print_r($commits, true) );
        asort($commits);
        $commits = array_values($commits);
        $firstCommit = $commits[0];
        $minus1FirstCommit = $firstCommit - 1;
        $fileContent = svn("blame -r {$minus1FirstCommit} '{$svnPath}{$filePath}' ");
        $orignalFilePath = $tmpName . '.commit-' . $minus1FirstCommit;
        file_put_contents($orignalFilePath, strval($fileContent));
        error_log('Saved blame to ' . $orignalFilePath);
        
        // Checkout the file from after the last commit
        $lastCommit = end($commits);
        $plus1LastCommit = $lastCommit + 1;
        $fileContent = svn("blame -r {$plus1LastCommit} '{$svnPath}{$filePath}' ");
        $afterFilePath = $tmpName . '.commit-' . $plus1LastCommit;
        file_put_contents($afterFilePath, strval($fileContent));
        error_log('Saved blame to ' . $afterFilePath);
        
        // Get a diff between $tmpName and $tmpName.original
        return diff(" -b -B -U 2048 {$orignalFilePath} {$afterFilePath}");
        
    }

    function codereview_getDiffForFileInCommit($svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/', $filePath, $commit) {
        
        $minus1Commit = $commit - 1;
        return svn("diff -r {$minus1Commit}:{$commit} '{$svnPath}{$filePath}' ");
        
    }

    function codereview_getFilesChangedForTicket($jiraTicketNumber) {
        $commits = codereview_getCommitsForTicket($jiraTicketNumber);
        return codereview_getFilesChangedInCommits($commits);
    }

    function codereview_getFilesChangedInCommits($commitNumbers, $svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/') {
        
        error_log('codereview_getFilesChangedInCommits(' . print_r($commitNumbers, true) . ')');
        $ret = array();
        
        foreach ( $commitNumbers as $commitNumber ) {
            $files = array_merge($ret, codereview_getFilesChangedInCommit($commitNumber));
            foreach ( $files as $file ) {
                $ret[$file] = $file;
            }
        }
        
        //error_log(print_r($ret, true));
        
        return array_values($ret);
    }

    function codereview_getFilesChangedInCommit($commitNumber, $svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/') {
        
        error_log("codereview_getFilesChangedInCommit({$commitNumber})");
        
        $ret = array();
        
        $commitNumberMinus1 = $commitNumber - 1;
        $changedFiles = svn("diff --summarize -r{$commitNumber}:{$commitNumberMinus1} '$svnPath' ", true);
        $changedFiles = explode("\n", $changedFiles);
        
        foreach ( $changedFiles as $changedFile ) {
            if ( strlen(trim($changedFile)) !== 0 ) {
                $changedFile = trim(substr($changedFile, 1));
                $changedFile = str_replace($svnPath, '', $changedFile);
                $ret[] = $changedFile;
            }
        }
        
        //error_log(print_r($ret, true));
        return $ret;
    }
    
    function svn($arguments, $cache = true) {
        if ( intval($cache) > 0 ) {
            $secondsIn1Week = 604800;
            $cacheTime = ( is_numeric($cache) ? intval($cache) : $secondsIn1Week );
            return call_user_func_cache($cacheTime, '_svn', $arguments);
        } else {
            return _svn($arguments);
        }
    }
    
    function _svn($arguments) {
        $svnPath = 'svn';
        $cmd = $svnPath . ' ' . $arguments;
        error_log($cmd);
        return shell_exec($cmd);
    }
    
    function diff($arguments) {
        $diffPath = 'diff';
        $cmd = $diffPath . ' ' . $arguments;
        error_log($cmd);
        $ret = shell_exec($cmd);
        error_log('diff complete');
        return $ret;
    }
    
    function codereview_getCommitsForTicket($jiraTicketNumber) {
        $ticketCommits = call_user_func_cache(180, 'codereview_getTicketNumberToCommitArray');
        
        if ( !empty($ticketCommits[$jiraTicketNumber]) ) {
            return $ticketCommits[$jiraTicketNumber];
        } else {
            return array();
        }
    }
    
    function codereview_getTicketNumberToCommitArray($ofTheLastNumberOfCommits = 800, $svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/') {
        
        error_log("codereview_getTicketNumberToCommitArray({$ofTheLastNumberOfCommits})");
        
        $ret = array();

        // Get the latest commit number
        $latestRevision = svn("log -l 1 -v '{$svnPath}'", false);
        foreach ( explode("\n", $latestRevision) as $line ) {
            if ( substr($line, 0, 1) === 'r' && ( strpos($line, ' 2014-') !== false || strpos($line, ' 2015-') !== false ) ) {
                $latestRevision = intval ( substr( array_shift( explode(' ', $line) ), 1 ) );
                break;
            }
        }
        
        $ret = _codereview_getTicketNumberToCommitArray(2335, 2619, 7100, $svnPath);
        
        //error_log(print_r($ret, true));
        return $ret;
    }
    
    function _codereview_getTicketNumberToCommitArray($fromCommit, $toCommit, $cache = false, $svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/') {
        
        $ret = array();
        
        $svnLog = svn("log -r {$fromCommit}:{$toCommit} '$svnPath' ", $cache);
        $svnLog = explode("\n", $svnLog);
        $svnLog = array_filter($svnLog, function ($var) {
            return ( 
                strpos($var, 'BUSUSA-') !== false 
                || strpos($var, '2014-') !== false 
                || strpos($var, '2015-') !== false 
            );
        });
        $svnLog = array_values($svnLog); // Reset the keys in the array to incrementing integers by +1 for each element 
        
        for ( $x = 0 ; $x < count($svnLog) ; $x++) {
        
            if ( substr($svnLog[$x], 0, 5) === 'BUSUS' ) {
                $ticketNumb = explode(' ', $svnLog[$x]);
                $ticketNumb = $ticketNumb[0];
                $ticketNumb = str_replace('.', '', $ticketNumb);
                $ticketNumb = str_replace(':', '', $ticketNumb);
                $ticketNumb = str_replace(';', '', $ticketNumb);
                $ticketNumb = str_replace(',', '', $ticketNumb);
                
                $commitId = explode(' ', $svnLog[$x-1]);
                $commitId = $commitId[0];
                $commitId = str_replace('r', '', $commitId);
                
                if ( !isset($ret[$ticketNumb]) ) {
                    $ret[$ticketNumb] = array();
                }
                if ( intval($commitId) > 0 ) {
                    $ret[$ticketNumb][] = intval($commitId);
                }
            }
        }
        
        return $ret;
    }

    
    function codereview_getSvnLog($svnPath = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/') {
        
        $ret = '';
        
        // Get the latest commit number
        $latestRevision = svn("log -l 1 -v '{$svnPath}'", false);
        foreach ( explode("\n", $latestRevision) as $line ) {
            if ( substr($line, 0, 1) === 'r' && ( strpos($line, ' 2014-') !== false || strpos($line, ' 2015-') !== false ) ) {
                $latestRevision = intval ( substr( array_shift( explode(' ', $line) ), 1 ) );
                break;
            }
        }
        
        $getRevisionsSince = floor(($latestRevision - 800)/100) * 100;
        $step = 25;
        for ( $x = $getRevisionsSince ; $x < $latestRevision ; $x += $step ) {
            $secondsIn1Month = 2592000;
            $endRev = $x + $step - 1;
            $ret .= svn("log -r {$x}:{$endRev} -v {$svnPath}\n", $secondsIn1Month);
        }
        
        print $ret;
        exit();
        return $ret;
    }
    
    function codereview_getJiraComments($jiraTicketNumber, $jiraUsername, $jiraPassword) {
        
        $url = 'https://tracker.reisys.com/rest/api/latest/issue/' . $jiraTicketNumber . '/comment';
        $json = `curl -u '$jiraUsername:$jiraPassword' '$url' `;
        return json_decode($json, true);
        
    }
    
    function codereview_getCodeReviewComments($jiraTicketNumber, $jiraUsername, $jiraPassword, $onlyForFile = -1, $indexByLine = false) {
        
        $ret = array();
        
        $jiraComments = codereview_getJiraComments($jiraTicketNumber, $jiraUsername, $jiraPassword);
        $jiraComments = $jiraComments['comments'];
        foreach ( $jiraComments as $commentData ) {
            
            $commentBody = $commentData['body'];
            $commentBodyLines = explode("\n", $commentBody);
            
            $commentFile = false;
            $commentLine = false;
            $commentText = false;
            
            foreach ( $commentBodyLines as $line ) {
                if ( stripos($line, 'file: ') !== false ) {
                    $commentFile = trim(substr($line, 5));
                } elseif ( stripos($line, 'line: ') !== false ) {
                    $commentLine = intval( trim(substr($line, 5)) );
                } elseif ( stripos($line, 'comment: ') !== false ) {
                    $commentText = trim(substr($line, 8));
                }
            }
            
            if ( $commentFile !== false && $commentLine !== false && $commentText !== false ) {
                if ( $onlyForFile === -1 || strtolower($onlyForFile) === strtolower($commentFile) ) {
                    if ( $indexByLine === false ) {
                        $ret[] = array(
                            'file' => $commentFile,
                            'line' => $commentLine,
                            'text' => $commentText,
                            'author' => $commentData['author']['displayName'],
                            'avatar' => $commentData['author']['avatarUrls']['48x48'],
                            'date' => $commentData['created'],
                        );
                    } else {
                        if ( empty($ret[$commentLine]) ) {
                            $ret[$commentLine] = array();
                        }
                        $ret[$commentLine][] = array(
                            'file' => $commentFile,
                            'line' => $commentLine,
                            'text' => $commentText,
                            'author' => $commentData['author']['displayName'],
                            'avatar' => $commentData['author']['avatarUrls']['48x48'],
                            'date' => $commentData['created'],
                        );
                    }
                }
            }
            
        }
        
        return $ret;
    }
    
    function codereview_getTicketTitle($jiraTicketNumber, $jiraUsername, $jiraPassword) {
        $url = 'https://tracker.reisys.com/rest/api/latest/issue/' . $jiraTicketNumber;
        $json = `curl -u '$jiraUsername:$jiraPassword' '$url' `;
        $ticketData = json_decode($json, true);
        return $ticketData['fields']['summary'];
    }
    
    
    
    
    
    
    
    
    
    