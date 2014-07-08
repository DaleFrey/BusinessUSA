<?php

    $users = db_query("
        SELECT 
            u.uid AS 'uid', 
            u.name AS 'name', 
            u.mail AS 'email', 
            la.field_myusa_last_auth_value AS 'last_auth'
        FROM users u
        LEFT JOIN field_data_field_myusa_last_auth la ON (la.entity_id = u.uid)
        WHERE 
            la.field_myusa_last_auth_value IS NOT NULL
            AND la.field_myusa_last_auth_value > 0
    ");

?>
<style>
    div.region.region-content {
        width: 100%
    }
</style>
<table width="100%">
    <tr>
        <th>User ID</th>
        <th>User Name</th>
        <th>EMail</th>
        <th>Last MyUSA Auth</th>
        <th>Actions</th>
    </tr>
    <?php foreach ( $users as $user ): ?>
        <tr>
            <td>
                <?php print $user->uid; ?>
            </td>
            <td>
                <?php print $user->name; ?>
            </td>
            <td>
                <?php print $user->email; ?>
            </td>
            <td>
                <?php 
                    if ( intval($user->last_auth) === 0 ) {
                        print '<i>Never</i>';
                    } else {
                        print date('Y / m / d H:a ', intval($user->last_auth)); 
                    }
                ?>
            </td>
            <td>
                [<a target="_blank" href="/user/<?php print $user->uid; ?>/edit">Edit</a>]
                <?php if ( intval($user->uid) > 1 ): ?>
                    [<a href="javascript: alert('Be sure to click on \'Delete the account and its content.\' on the next screen!'); document.location = '/user/<?php print $user->uid; ?>/cancel'; ">Delete</a>]
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
