<!-- The following markup is rendered from <?php print __FILE__; ?> -->
<?php
    // Get a list of all [distinct] Countries [values] assigned to USEACs (a sub-type to the Resource-Centers conten-type)
    $results = db_query("
        SELECT DISTINCT field_appoffice_country_value AS 'country_name'
        FROM field_data_field_appoffice_country c
        LEFT JOIN field_data_field_appoffice_type t ON  ( c.entity_id = t.entity_id )
        WHERE
            field_appoffice_type_value  = 'U.S. Export Assistance Center'
        ORDER BY field_appoffice_country_value
    ");
    $countries = array();
    foreach ( $results as $record ) {
        if ( strtolower($record->country_name) !== 'us' && strtolower($record->country_name) !== 'united states of america' ) {
            $countryName = acronymToCountryName($record->country_name, $record->country_name);
            if ( strpos($countryName, 'Unknown') === false ) {
                // countryNameToAcronym() is defined in ZipCodeGeolocation.php
                $countryAcronym = countryNameToAcronym($countryName, $countryName);
                $countries[$countryAcronym] = $countryName;
            }
        }
    }
?>

<p>
    <a href="http://trade.gov/cs/index.asp">The U.S. Commercial Service</a> of the 
    <a href="http://commerce.gov/">U.S. Department of Commerce</a> 
    is a federal government agency dedicated 
    to helping small-to-medium sized U.S. companies develop international markets. It is part of a global network of 
    trade specialists dedicated to support U.S. commercial interests overseas and to help U.S. companies identify 
    international partners around the world.
</p>
<p>
    It is the largest U.S. Government agency entirely devoted to promoting American commercial interests abroad. 
    Our office is part of a global network of trade specialists dedicated to assisting U.S. companies enter markets 
    worldwide and serves as the primary contact for U.S. exporters. It offers invaluable assistance to companies seeking 
    to export U.S. products and services and expand their business in the market. Our 
    <a href="http://export.gov/westbank/contactus/index.asp">
        Commercial Specialists
    </a> 
    have developed excellent contacts with private sector representatives, and are able to provide U.S. companies with 
    necessary introductions, market reports and guidance to facilitate doing business.
</p>
<p>
    Every year, the U.S. Commercial Service helps thousands of companies export goods and services worth billions of 
    dollars. Our global network of trade professionals is located throughout the United States and in U.S. Embassies and 
    Consulates in nearly 80 countries and it connects U.S. companies with international buyers.
</p>

<!-- The following markup is rendered from <?php print __FILE__; ?> /* Coder Bookmark: CB-0NKG1ST-BC */ -->
<ul class="countrylist-mastercontainer" rendersource="<?php print basename(__FILE__); ?>">
    <?php foreach ( $countries as $countryAcronym => $countryName ): ?>
        <li class="countrylist-country">
            <a class="countrylist-countrylink" href="#<?php print $countryAcronym; ?>">
                <?php print $countryName; ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<!-- The following markup is rendered from <?php print __FILE__; ?> /* Coder Bookmark: CB-HJRFI0L-BC */ -->
<div class="countryuseac-mastercontainer" rendersource="<?php print basename(__FILE__); ?>">
    <?php $counter = 0; ?>
    <?php foreach ( $countries as $countryAcronym => $countryName ): ?>
        <div class="countryuseac-country countryuseac-country-<?php print $countryAcronym; ?> countryuseac-country-<?php print $counter++; ?>">
            <a name="<?php print $countryAcronym; ?>" />
            <h2 class="countryuseac-title">
                <?php print $countryName; ?>
            </h2>
            <ul class="useac-container" rendersource="<?php print basename(__FILE__); ?>">
                <?php foreach ( views_get_view_result('useac_location_exporting_wizards', 'exporterdash_useacs', 'all', $countryName) as $data ): ?>
                    <?php $n = $data->_field_data['nid']['entity']; ?>
                    <li class="useac-item">
                        
                        <div class="useac-fieldlabelvalue useac-title">
                            <a href="<?php print drupal_get_path_alias('node/' . $n->nid); ?>">
                                <?php print $n->title; ?>
                            </a>
                        </div>
                        
                        <?php if ( !empty($n->field_appoffice_email['und'][0]['value']) ): ?>
                            <div class="useac-fieldlabelvalue useac-email">
                                <span class="useac-fieldlabel">
                                    Email Address: 
                                </span>
                                <span class="useac-fieldvalue">
                                    <a href="mailto: <?php print $n->field_appoffice_email['und'][0]['value']; ?>">
                                        <?php print $n->field_appoffice_email['und'][0]['value']; ?>
                                    </a>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( !empty($n->field_appoffice_city['und'][0]['value']) ): ?>
                            <div class="useac-fieldlabelvalue useac-city">
                                <span class="useac-fieldlabel">
                                    Location: 
                                </span>
                                <span class="useac-fieldvalue">
                                    <?php 
                                        $address = '';
                                        if ( !empty($n->field_address_line_1['und'][0]['value']) ) {
                                            $address .= $n->field_address_line_1['und'][0]['value'];
                                        }
                                        if ( !empty($n->field_appoffice_city['und'][0]['value']) ) {
                                            if ( $address !== '' ) {
                                                $address .= ', ';
                                            }
                                            $address .= $n->field_appoffice_city['und'][0]['value'];
                                        }
                                        if ( !empty($n->field_appoffice_state['und'][0]['value']) ) {
                                            if ( $address !== '' ) {
                                                $address .= ', ';
                                            }
                                            $address .= $n->field_appoffice_state['und'][0]['value'];
                                        }
                                        if ( !empty($n->field_appoffice_country ['und'][0]['value']) ) {
                                            if ( $address !== '' ) {
                                                $address .= ', ';
                                            }
                                            $address .= $n->field_appoffice_country ['und'][0]['value'];
                                        }
                                        print $address;
                                    ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( !empty($n->field_appoffice_phone['und'][0]['value']) ): ?>
                            <div class="useac-fieldlabelvalue useac-phone">
                                <span class="useac-fieldlabel">
                                    Phone Number: 
                                </span>
                                <span class="useac-fieldvalue">
                                    <?php print $n->field_appoffice_phone['und'][0]['value']; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>








