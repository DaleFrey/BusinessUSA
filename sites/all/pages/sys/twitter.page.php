<?php 
    
    global $user;
    if ( empty($user) ) {
        print "<b>In order to run this functionality, you must be signed in</b>";
        return;
    } else {
        if ( empty($user->roles) || !is_array($user->roles) || count($user->roles) === 0 ) {
            print "<b>In order to run this functionality, you must be signed in</b>";
            return;
        } else {
            foreach ( $user->roles as $userRole ) {
                if ( strpos($userRole, 'anonymous') !== false ) {
                    print "<b>In order to run this functionality, you must be signed in</b>";
                    return;
                }
            }
        }
    }
    
    if ( !empty($_GET['forceTriggerTwitterCycle']) && intval($_GET['forceTriggerTwitterCycle']) === 1  ) {
        twitter_cron();
        drupal_set_message('The twitter_cron() function was triggered.', 'status');
        drupal_goto('sys/twitter');
    }
    
?>

<style>
    .view-id-sba_tweets.view-display-id-sys_all_tweets li {
        float: none !important;
        clear: both !important;
        width: 100% !important;
        list-style: circle !important;
    }
    .view-id-sba_tweets.view-display-id-sys_all_tweets .views-field.views-field-created-time {
        margin: 0px !important !important;
        padding-bottom: 10px !important;
    }
</style>

This is an administration interface to manage Tweets in the BusinessUSA system. This interface is only available to administrators and editors.<br/>
<br/>
Every night during the system-maintenance cycle (cron), Drupal triggers the Twitter-Consumption process. This process consumes the latest 
Tweets from BizUSA's twitter profile into the BusinessUSA website. <i>Please note this does not include "re-tweets" nor "mentions"</i>.<br/>
<br/>
This process <i>should</i> fire every night, but if for some reason it did not, you can <a href="?forceTriggerTwitterCycle=1">
force trigger this process by clicking here</a><br/>
<br/>
Or you can manually add a Tweet-message into the BusinessUSA website's database <a href="/sys/twitter/add">from here</a>.<br/>
<br/>
<hr/>
<br/>
The following is a list of the latest Tweets consumed into the BusinessUSA database - these Tweets show on the front-page.<br/>
<br/>
<?php print views_embed_view('sba_tweets', 'sys_all_tweets'); ?>
