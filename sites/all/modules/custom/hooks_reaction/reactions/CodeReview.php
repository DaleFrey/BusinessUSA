<?php

    function codereview_postCodeReviewComment($jiraTicketNumber, $jiraUsername, $jiraPassword, $filePath, $lineNumber, $commentText) {
        $msg = '';
        $msg .= "CODE REVIEW COMMENT: A user has commented on a code-change in the code review related to this Jira ticket.\n";
        $msg .= "Please click here to view this review: http://qa.business.usa.reisys.com/dev/code-review/review?ticket={$jiraTicketNumber}&file={$filePath}  \n";
        $msg .= "\n";
        $msg .= "File: {$filePath}\n";
        $msg .= "Line: {$lineNumber}\n";
        $msg .= "Comment: {$commentText}\n";
        
        return codereview_postJiraComment($msg, $jiraTicketNumber, $jiraUsername, $jiraPassword);
    }
    
    function codereview_postJiraComment($commentBody, $jiraTicketNumber, $jiraUsername, $jiraPassword) {
    
        $postData = json_encode(
            array(
                'body' => $commentBody
            )
        );
        
        $apiUrl = 'https://tracker.reisys.com/rest/api/2/issue/' . $jiraTicketNumber . '/comment';
        
        $requestReturn = drupal_http_request(
            $apiUrl,
            array(
                'method' => 'POST',
                'headers' => array(
                    'Content-type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($jiraUsername . ':' . $jiraPassword),
                ),
                'data' => $postData
            )
        );
        
        $requestReturn = (array) $requestReturn;
        return $requestReturn['data'];
        
    }