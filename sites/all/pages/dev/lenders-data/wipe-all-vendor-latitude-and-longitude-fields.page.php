<?php 
    if ( !empty($_GET['invoke']) && intval($_GET['invoke']) === 1 ) {
        
        /* START: Ensure the user is signed in as an admin */
        global $user;
        if ( empty($user) ) {
            print "<b>You must be signed in as an administrator in order to run this functionality</b>";
            return;
        } else {
            $arrUser = (array) $user;
            if ( empty($arrUser['name']) || $arrUser['name'] !== 'reisysbizuser' ) {
                print "<b>You must be signed in as an administrator in order to run this functionality</b>";
                return;
            }
        }
        /* END: Ensure the user is signed in as an admin */
        
        $sql = "UPDATE field_data_field_vend_address_zip_lat SET field_vend_address_zip_lat_value = 0";
        db_query($sql);
        print "
            Executed SQL:<br/>
            <pre>$sql</pre>
        ";
        
        $sql = "UPDATE field_data_field_vend_address_zip_lng SET field_vend_address_zip_lng_value = 0";
        db_query($sql);
        print "
            Executed SQL:<br/>
            <pre>$sql</pre>
        ";
        
    }
?>

<!-- Default interface starts here  -->
<div class="not-admin-only">
    <b>Note:</b>Log in as an administrator for more functionality.<br/>
    <br/>
</div>
<div class="admin-only">
    <a href="?invoke=1">Click here</a> to invoke
</div>