<?php 
    
    if ( !empty($_GET['invoke']) && intval($_GET['invoke']) > 0 ) {
        
        /*
         * resource connectMySQL()
         * Connects to the MySQL database that this Drupal instance is/will-be using
         * This is meant to create a connection to the database that bypasses Drupal's db_query() and query alter hooks
         * This is also meant to be used in situations where a connection to the database is needed when Drupal is not fully boot-strapped
         */
        if ( function_exists('connectMySQL') == false ) {
            function connectMySQL() {
                $dbAuth = $GLOBALS["databases"]["default"]["default"];
                $host = $dbAuth["host"];
                $user = $dbAuth["username"];
                $pass = $dbAuth["password"];
                $port = $dbAuth["port"];
                $db = $dbAuth["database"];
                if ( !empty($port) ) {
                    $host .= ":" . $port;
                }
                $link = mysql_connect($host, $user, $pass);
                mysql_select_db($db, $link);
                return $link;
            }
        }
        
        $mySqlConnection = connectMySQL();
        
        /* START: Ensure the user is signed in as an admin */
        global $user;
        if ( empty($user) ) {
            $msg =  "<b>You must be signed in as an administrator in order to run this functionality</b>";
            print $msg;
            return $msg;
        } else {
            $arrUser = (array) $user;
            if ( empty($arrUser['name']) || $arrUser['name'] !== 'reisysbizuser' ) {
                $msg = "<b>You must be signed in as an administrator in order to run this functionality</b>";
                print $msg;
                return $msg;
            }
        }
        /* END: Ensure the user is signed in as an admin */
        
        if ( intval($_GET['invoke']) === 2 ) {
            
            // Update the Latitude field on content of the vendors content-type - set latitude to be the latitude of the associated zipcode from the zipcodes table
            $sql = "
                UPDATE field_data_field_vend_address_zip_lat vendlat
                LEFT JOIN field_data_field_vend_address_zip vendzip ON ( vendzip.entity_id = vendlat.entity_id )
                LEFT JOIN zipcodes zc ON ( zc.zipcode = vendzip.field_vend_address_zip_value )
                SET field_vend_address_zip_lat_value = zc.latitude
                WHERE 
                    field_vend_address_zip_lat_value = 0
                    OR field_vend_address_zip_lat_value IS NULL
            ";
            mysql_query($sql, $mySqlConnection);
            
            print "
                Executed SQL query:<br/>
                <pre>$sql</pre><br/>
                <br/>
            ";
            
            // Update the Langitude field on content of the vendors content-type - set langitude to be the langitude of the associated zipcode from the zipcodes table
            $sql = "
                UPDATE field_data_field_vend_address_zip_lng vendlng
                LEFT JOIN field_data_field_vend_address_zip vendzip ON ( vendzip.entity_id = vendlng.entity_id )
                LEFT JOIN zipcodes zc ON ( zc.zipcode = vendzip.field_vend_address_zip_value )
                SET field_vend_address_zip_lng_value = zc.longitude
                WHERE 
                    field_vend_address_zip_lng_value = 0
                    OR field_vend_address_zip_lng_value IS NULL
            ";
            mysql_query($sql, $mySqlConnection);
            
            print "
                Executed SQL query:<br/>
                <pre>$sql</pre><br/>
                <br/>
            ";
            
        }
        
        if ( intval($_GET['invoke']) > 0 ) {
            
            print "<br/>";
            
            // Count how many vendors do not have latitude information
            $result = db_query("
                SELECT COUNT(entity_id) AS 'vcount'
                FROM field_data_field_vend_address_zip_lat vlat
                WHERE 
                    field_vend_address_zip_lat_value = 0 
                    OR field_vend_address_zip_lat_value IS NULL
            ");
            foreach ( $result as $record ) {
                $vcount = $record->vcount;
            }
            print "There are currently <b>$vcount</b> vendors (nodes) that do not have latitude information<br/>";

            // Count how many vendors do not have latitude information but can get latitude information based on looking up the latitude of their associated ZpCode
            $result = db_query("
                SELECT 
                    COUNT(vlat.entity_id) AS 'vlat_count',
                    COUNT(vzip.entity_id) AS 'vzip_count',
                    COUNT(zc.zipcode) AS 'vzip_count'
                FROM field_data_field_vend_address_zip_lat vlat
                LEFT JOIN field_data_field_vend_address_zip vzip on ( vzip.entity_id = vlat.entity_id )
                LEFT JOIN zipcodes zc on  ( zc.zipcode = vzip.field_vend_address_zip_value )
                WHERE 
                    field_vend_address_zip_lat_value = 0 
                    OR field_vend_address_zip_lat_value IS NULL
            ");
            foreach ( $result as $record ) {
                $vzip_count = $record->vzip_count;
            }
            print "There are currently <b>$vzip_count</b> vendors (nodes) that do not have latitude information but can get latitude information based on looking up the latitude of their associated ZpCode<br/>";
            
            print "<br/>Click <a href=\"?invoke=2\">here</a> to update the Latitude/Longitude fields on content (of the vendors content-type) - set latitude to be the latitude of the associated zipcode from the zipcodes table<br/>";
            
        }
        
        return 1;
        
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