<?php /* 

    This is the code for the page:
        https://business.usa.gov/user-dashboard/my-usa-callback
    
    
    [--] THE AUTHENTICATION PROCESS [--]
    
    When a user wants to authenticate through MyUSA, they get directed to 
    https://staging.my.usa.gov/oauth/authorize?client_id=122mzlvh6d57x0ux0y3xnd5uh&response_type=code&redirect_uri=http://business.usa.gov/user-dashboard/my-usa-callback
    
    Upon successful authentication on the MyUSA site, the user gets redirected back to 
    https://business.usa.gov/user-dashboard/my-usa-callback?code=<CODE>
    
    The given <CODE> here, can be given to myUsaAuth_getTokenFromCode() , which will return an access-token
*/

// Verify certain that certain fields exist in the database 
$fieldsThatShouldExists = array(
    'field_myusa_ownership', 
    'field_myusa_industry', 
    'field_myusa_tiles', 
    'field_usr_past_searches',
    'field_myusa_firstname',
    'field_myusa_zipcode',
    'field_myusa_last_auth'
);
foreach ( $fieldsThatShouldExists as $fieldsThatShouldExist ) {
    if ( is_null(field_info_field($fieldsThatShouldExist)) ) {
        while (@ob_end_clean());
        print "Error - The {$fieldsThatShouldExist} field does not exists in this database. Please make sure all the fields found in QA at http://qa.business.usa.reisys.com/admin/config/people/accounts/fields exist within this environment.";
        exit();
    }
}

// Obtain this user's access token based on the "CODE" given to us by MyUSA Oath2 server
$token = false;
$redirectTo = '/';
if ( !empty($_GET['code']) && trim($_GET['code']) !== '' ) {
    
    $token = myUsaAuth_getTokenFromCode($_GET['code']);
    
    if ( $token !== false ) {
    
        $profileInfo = myUsaAuth_getProfileInfo($token);
        
        $drupalUserId = false;
        foreach ( db_query("SELECT uid FROM users WHERE mail='{$profileInfo['email']}' ") as $result ) {
            if ( $drupalUserId !== false ) {
                error_log(
                    "Error - It appears the email address {$profileInfo['email']} is assigned to more than one Drupal user."
                    . " Coder Bookmark: CB-T77JTBG-BC"
                );
            }
            $drupalUserId = $result->uid;
        }
        
        // Check if this MyUSA user already has a Drupal account in the BusinessUSA CMS
        if ( $drupalUserId !== false ) {
        
            // If this user has no wizards selected to show on their dashboard (frot-page), direct them to their settings page
            $drupalUserProfile = user_load($drupalUserId);
            if ( empty($drupalUserProfile->field_myusa_tiles) || !is_array($drupalUserProfile->field_myusa_tiles) || count($drupalUserProfile->field_myusa_tiles) == 0 ) {
                $redirectTo = '/user-dashboard/usersettings?uid=' . $drupalUserId . '&t=' . time() . '&mustSelectMsg=1';
            }
            
        } else {
            // Then this MyUSA has never signed into BusinessUSA before (this is the first-time login)
            $drupalUserId = myUsaUsers_CreateUser($profileInfo['first_name'], $profileInfo['email'], $profileInfo['zip']);
            $redirectTo = '/user-dashboard/usersettings?uid=' . $drupalUserId . '&t=' . time();
            // If the user has stated they are a Veteran, pass this information along to the settings form
            if ( intval($profileInfo['is_veteran']) === 1 ) {
                $redirectTo .= '&is_veteran=1';
            }
            // If the user has stated they are a Woman, pass this information along to the settings form
            if ( strtolower($profileInfo['gender']) === 'female' ) {
                $redirectTo .= '&is_woman=1';
            }
        }
        
        // Update the FirstName field (assuming it changed in the MyUSA profile)
        if ( !empty($profileInfo['first_name']) ) {
            $drupalUserProfile->field_myusa_firstname = array(
                'und' => array(
                    0 => array(
                        'value' => $profileInfo['first_name'],
                        'safe_value' => $profileInfo['first_name']
                    )
                )
            );
        }
        
        // Note that this [Drupal] user has most recently authenticated through MyUSA now
        $drupalUserProfile = user_load($drupalUserId);
        $drupalUserProfile->field_myusa_last_auth  = array(
            'und' => array(
                0 => array(
                    'value' => time()
                )
            )
        );
        user_save($drupalUserProfile);
        
    }
}

/** string myUsaAuth_getTokenFromCode_hit(string $code)
  * Using the Oauth2 protocol, obtains an Access-Token based on the given Access-Code.
  * If this function is called for the same Access-Code more than once, this translation will 
  * still work since the respince from the OAuth2 server will be cached.
  */
function myUsaAuth_getTokenFromCode($code) {
    
    // Ensure we have FunctionResultCachingSupport.php functionality
    if ( !function_exists('call_user_func_cache') ) {
        while (@ob_end_clean());
        exit(
            'Error - The call_user_func_cache() function is not defined, and requiered for function ' .
            __FUNCTION__ . ". Coder Bookmark: CB-JU00VI1-BC"
        );
    }
    
    // Use cache, or create cache, and return from the myUsaAuth_getTokenFromCode_hit() function
    $secondsIn30Mins = 1800;
    return call_user_func_cache($secondsIn30Mins, 'myUsaAuth_getTokenFromCode_hit', $code);
}

/** string myUsaAuth_getTokenFromCode_hit(string $code)
  * Using the Oauth2 protocol, obtains an Access-Token based on the given Access-Code.
  *
  * WARNING: This function may only be abel to be called ONCE per each given 
  * Access-Code. This is a restriction created by the OAuth2 server.
  */
function myUsaAuth_getTokenFromCode_hit($code) {
    
    $postdata = http_build_query(
        array(
            'client_id' => $GLOBALS['myusa_settings']['clientId'], /* This variable is defined in MyUSA-Settings.php */
            'code' => $code,
            'redirect_uri' => $GLOBALS['myusa_settings']['redirectURL'], /* This variable is defined in MyUSA-Settings.php */
            'grant_type' => 'authorization_code',
            'client_secret' => $GLOBALS['myusa_settings']['clientSecret'] /* This variable is defined in MyUSA-Settings.php */
        )
    );
    $opts = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context  = stream_context_create($opts);
    $tokenExchangeURL = $GLOBALS['myusa_settings']['tokenExchange']; // This variable is defined in MyUSA-Settings.php
    $strResponce = file_get_contents($tokenExchangeURL, false, $context);
    $jsonResponce = json_decode($strResponce, true);
    
    if ( $jsonResponce !== false && !is_null($jsonResponce) ) {
        if ( !empty($jsonResponce['access_token']) ) {
            return $jsonResponce['access_token'];
        }
    }
    
    return false;
}

/** string myUsaAuth_getProfileInfo(string $accessToken)
  *
  * Using the Oauth2 protocol, obtains profile information for the 
  * user associated with the given Access-Token.
  *
  * On failure, returns false. On success, returns an array like: 
        Array (
            [city] => 
            [first_name] => Dale
            [gender] => 
            [is_veteran] => 
            [state] => 
            [zip] => 20171
            [email] => bizusa@reisys.com
            [uid] => 6e9bba15-db66-4362-8038-8896fec35941
            [id] => 6e9bba15-db66-4362-8038-8896fec35941
        )
  */
function myUsaAuth_getProfileInfo($accessToken) {

    $context  = stream_context_create(
        array(
            'http' => array(
                'method'  => 'GET',
                'header'  => 'Authorization: Bearer ' . $accessToken,
            )
        )
    );
    $strResponce = file_get_contents('https://staging.my.usa.gov/api/profile', false, $context);
    
    if ( $strResponce !== false ) {
        $jsonResponce = json_decode($strResponce, true);
        if ( $jsonResponce !== false ) {
            return $jsonResponce;
        }
    }
    
    return false;
}

/** int myUsaUsers_CreateUser(string $firstName, string $email, string $zipCode)
  *  
  */
function myUsaUsers_CreateUser($firstName, $email, $zipCode) {
    $newUser = new stdClass();
    $newUser->name = substr($firstName . '_' . str_replace(array('@', '.'), '_', $email), 0, 50);
    $newUser->pass = 'NO DIRECT LOGIN ALLOWED! MYUSA LOGIN ONLY!';
    $newUser->mail = $email;
    $newUser->theme = '';
    $newUser->signature = '';
    $newUser->signature_format  = 'filtered_html';
    $newUser->status = 1;
    $newUser->timezone = 'America/New_York';
    $newUser->language = '';
    $newUser->picture = null;
    $newUser->init = $email;
    $newUser->data = array('contact' => 0, 'overlay' => 0);
    $newUser->roles = array();
    $newUser->field_myusa_ownership = array();
    $newUser->field_myusa_industry = array();
    $newUser->field_myusa_tiles = array();
    $newUser->field_usr_past_searches = array();
    $newUser->field_usr_past_searches = array();
    $newUser->field_myusa_firstname = array(
        'und' => array(
            0 => array(
                'value' => strval($firstName)
            )
        )
    );
    $newUser->field_myusa_zipcode = array(
        'und' => array(
            0 => array(
                'value' => strval($zipCode)
            )
        )
    );
    user_save($newUser);
    return $newUser->uid;
}









