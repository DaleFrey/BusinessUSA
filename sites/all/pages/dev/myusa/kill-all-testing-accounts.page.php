<?php
    
    $deleteUsersByEmail = array(
        'chandrika.sreenivasa@reisystems.com', 
        'ganna.apraxina@reisystems.com', 
        'panjaneya@reisystems.com', 
        'anjiimr@gmail.com'
    );
    $sqlDeleteUsersByEmail = chr(39) . implode(chr(39) . ', ' . chr(39), $deleteUsersByEmail) . chr(39);
    
    if ( empty($_GET['invoke']) || intval($_GET['invoke']) !== 1 ) {
        ?>
            <b><strong>WARNING:</strong> This operation will delete all <i>Drupal</i> user accounts belonging to:</b><br/>
            <?php print implode('<br/>', $deleteUsersByEmail); ?>
            <br/><br/>
            Note that this only effects the BusinessUSA system, this will NOT delete the associated account in MyUSA.<br/>
            After this operation is complete, the next time the mentioned users sign through MyUSA will be considered their first 
            time logging in.<br/>
            <br/>
            <input type="button" onclick="document.location = '?invoke=1';" value="Delete Drupal Accounts" />
        <?php 
    } else {
        $query = "
            SELECT uid, mail 
            FROM users
            WHERE mail IN ({$sqlDeleteUsersByEmail})
        ";
        foreach ( db_query($query) as $result ) {
            if ( $result->uid > 1 ) {
                user_delete($result->uid);
                print "Deleted user {$result->uid} ($result->mail) <br/>\n";
            }
        }
    }
    

?>