<?php /*

    The purpose of this script is to define certain settings/constants that are used with 
    the MyUSA implementation.

*/

if ( !function_exists('defineMyUsaSettings') ) {
    function defineMyUsaSettings() {
        
        $myUsaDomain = 'https://staging.my.usa.gov';
        $clientId = '122mzlvh6d57x0ux0y3xnd5uh';
        $redirectURL = 'http://qa.business.usa.reisys.com/user-dashboard/my-usa-callback';
        
        $scopes_array = array(
            'profile.email',
            'profile.first_name', 
            'profile.zip', 
            'profile.gender', 
            'profile.is_veteran', 
            'profile.city', 
            'profile.state'
        );
        $scopes = implode(' ', $scopes_array);
        
        $beginAuthURL = 
            $myUsaDomain . "/oauth/authorize?" 
            . "client_id={$clientId}"
            . "&response_type=code"
            . "&scope={$scopes}"
            . "&redirect_uri={$redirectURL}";
        
        $GLOBALS['myusa_settings'] = array(
            'clientId' => $clientId,
            'redirectURL' => $redirectURL,
            'beginAuthURL' => $beginAuthURL,
            'tokenExchange' => "{$myUsaDomain}/oauth/authorize?client_id={$clientId}",
            'clientSecret' => 'b6orn004a0g92r1r4awij299v'
        );
    }
}

defineMyUsaSettings();