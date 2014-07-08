<?php

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

?>

<?php if ( empty($_GET['type']) ) { ?>
    <style>
        .dk_label {
            display: none !important;
        }
    </style>
    <form method="GET" action="<?php print request_uri(); ?>">
        Delete all content within the cotent-type:<br/>
        <select name="type" style="position: inherit; top: initial; visibility: visible">
            <?php
                foreach ( (array) node_type_get_types() as $typeMacName => $typeInfo ) {
                    print "<option>$typeMacName</option>";
                }
            ?>
        </select><br/>
        <br/>
        <input type="submit" value="Wipe" />
    </form>
<?php } else { ?>

        <?php if ( empty($_GET['sqlok']) || intval($_GET['sqlok']) !== 1 ) { ?>

            Are you sure you want to continue? <b>This action cannot be undone.</b> The following SQL code will get run for this process:<br/>
            <br/>
            <textarea disabled style="min-height: 250px; background-color: white; color: black;"><?php print determinWipeSql($_GET['type']); ?></textarea>
            <input type="button" value="Run this SQL code" onclick="document.location.search += '&sqlok=1'"/>

        <?php } else {?>

            <?php
                $mySqlLink = connectMySQL();
                $sqlQueries = explode("\n", determinWipeSql($_GET['type']) );
                foreach ( $sqlQueries as $sqlQuery ) {
                    mysql_query( $sqlQuery, $mySqlLink );
                    dsm("Executed SQL: $sqlQuery");
                }
            ?>

            SQL has been executed. <b>You may need to <a href="/admin/config/development/performance">flush Drupal-cache now</a><b/> for all parts of the system to be aware of the recent changes.

        <?php } ?>

<?php } ?>

<?php

function determinWipeSql($cType) {

    $ret = "DELETE FROM node WHERE type = '$cType'; \n";

    foreach ( getFiledsOfContentType($cType) as $fieldMacName => $fieldInfo ) {
        if ( !empty($fieldInfo['storage_sql_table']) ) {
            if ( $fieldMacName === 'body' ) {
                $ret .= "DELETE FROM field_data_body WHERE bundle = '$cType'; \n";
            } else {
                $ret .= "TRUNCATE TABLE {$fieldInfo['storage_sql_table']}; \n";
            }
        }
    }

    return $ret;
}

/**
 * array getFiledsOfContentType(string).
 *
 * Returns a list of Drupal fields of a given content-type's machine-name, and information on what tables
 * and fields in the database the given Drupal fields are stored in.
 *
 * Returns an array with the structure of...
 * An example return:
 *
 *      return array(

            'field_program_city' => array(
                'label' => 'City',
                'storage_sql_table' => 'field_data_field_program_city',
                'storage_sql_fields' => array(
                    'value' => 'field_data_field_program_city',
                    'format' => 'field_program_city_format'
                )
            ),

            'field_frontpage_daterange' => array(
                'label' => 'Front Page Date Range',
                'storage_sql_table' => 'field_data_field_frontpage_daterange',
                'storage_sql_fields' => array(
                    'value' => 'field_frontpage_daterange_value',
                    'value2' => 'field_frontpage_daterange_value2'
                )
            ),

            [...]

        );
 */
function getFiledsOfContentType($cType) {

    // $rtn will be our return buffer
    $rtn = array();

    // Get a mapping of all fields associated [with all] content-types
    $map = field_info_instances();
    $map = $map['node'];

    // Get details of all fields
    $fieldReadFields = field_read_fields();

    // Get a mapping of all fields associated [with THIS] content-type
    if ( !empty($map[$cType]) ) {
        $mappedFields = $map[$cType];
    } else {
        return false;
    }

    // Foreach field in this content-type...
    foreach ( $mappedFields as $fieldMachineName => $fieldInfoInstance ) {

        // Assume table-name is "field_data_" & the machine-name of this Drupal-field
        $tblName = 'field_data_' . $fieldMachineName;

        $thisFieldData = array(
            'label' => $fieldInfoInstance['label'],
            'storage_sql_table' => $tblName,
            'storage_sql_fields' => array()
        );

        // Get the details of THIS field as returned by field_read_fields()
        $fieldReadField = $fieldReadFields[$fieldMachineName];

        // Add the field-names that hold the values, in the MySQL tables, to the result
        foreach ( $fieldReadField['storage']['details']['sql']['FIELD_LOAD_CURRENT'][$tblName] as $databaseFieldLabel => $databaseFieldName ) {
            $thisFieldData['storage_sql_fields'][$databaseFieldLabel] = $databaseFieldName;
        }

        // If we did not find any fields-names for MySQL...
        if ( count($thisFieldData['storage_sql_fields']) === 0 ) {

            // If it exists, add the field of: machine-name  & '_value'
            if ( db_field_exists($tblName, $fieldMachineName . '_value') ) {
                $thisFieldData['storage_sql_fields']['value'] = $fieldMachineName . '_value';
            }

            // If it exists, add the field of: machine-name  & '_tid'
            if ( db_field_exists($tblName, $fieldMachineName . '_tid') ) {
                $thisFieldData['storage_sql_fields']['tid'] = $fieldMachineName . '_tid';
            }
        }

        // Some validation before we add to the return buffer (double check some attributes of this result)
        if ( !db_table_exists($tblName) || count($thisFieldData['storage_sql_fields']) < 1 ) {
            // Validation failed
        } else {
            // Ok, add this result to the result-set
            $rtn[$fieldMachineName] = $thisFieldData;
        }
    }

    return $rtn;
}

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