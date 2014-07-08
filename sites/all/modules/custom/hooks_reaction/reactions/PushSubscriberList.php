<?php

/**
 * Implements hook_cron().
 * Hook to periodically trigger cleanup function(s)
 */
hooks_reaction_add("cron",
  function () {
    watchdog('subscriber_push', "Begin pushing subscribers.");
    $results = govdelivery_splash_update_all();
    watchdog('subscriber_push', "End pushing subscribers. Result Messages: @results", array('@results' => var_export($results, TRUE)), WATCHDOG_INFO);
  }
);

/**
 * Pushes local subscriber list to remote server.
 *
 * @return array
 *   An array of result messages for subscribers pushed to the remote email server.
 */
function govdelivery_splash_update_all() {
  $gd_user = "sgade@reisystems.com";
  $gd_pass = "Bizusa1!";
  $gd_domain = "stage-admin.govdelivery.com";
  $busa_topic = "USBUSUSA_1";

  //update subscriptions with flag values between -4 and 0, not inclusive
  $subscribers_sql = "SELECT e.field_subscribe_email_value AS email FROM node n
                        LEFT JOIN field_data_field_subscribe_email e ON n.nid = e.entity_id
                        LEFT JOIN field_data_field_no_attempts flag ON flag.entity_id = n.nid
                        WHERE n.type = 'receive_email' AND flag.field_no_attempts_value < 1 AND flag.field_no_attempts_value > -4 LIMIT 0, 75";
  $subscribers = db_query($subscribers_sql);

  if(count($subscribers) > 0) {
    $batch_count = 0;
    $saved_emails = $failed_emails = array();

    foreach ($subscribers as $sub) {
      $sub_email = $sub->email;
      if (empty($sub_email)) {
        return;
      }

      $xml = "<subscriber>
                        <email>".$sub_email."</email>
                        <send-notifications type='boolean'>true</send-notifications>
                        <digest-for>0</digest-for>
                    </subscriber>";

      $ch = curl_init();
      if ( function_exists('version_awareness_environment_isproduction') && version_awareness_environment_isproduction() !== true ) {
        curl_setopt($ch, CURLOPT_URL, "https://stage-api.govdelivery.com/api/account/USBUSUSASTAGE/subscribers.xml");
        curl_setopt($ch, CURLOPT_USERPWD, "sgade@reisystems.com:Bizusa1!");
      }else{
        curl_setopt($ch, CURLOPT_URL, "https://api.govdelivery.com/api/account/USBUSUSA/subscribers.xml");
        curl_setopt($ch, CURLOPT_USERPWD, "amin.mehr@businessusa.gov:BusinessUSA@1234");
      }
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
      $user_response = curl_exec($ch);
      curl_close($ch);

      $response = json_decode(json_encode((array) simplexml_load_string($user_response)),1);

      //Update the subscriber info in the database based on the response from API
      if (isset($response['to-param']) || $response['error'] == 'Email has already been taken' ) {
        if(isset($response['to-param'])){


          $ch = curl_init();
          if ( function_exists('version_awareness_environment_isproduction') && version_awareness_environment_isproduction() !== true ) {
            curl_setopt($ch, CURLOPT_URL, "https://stage-api.govdelivery.com/api/account/USBUSUSASTAGE/subscribers/add_subscriptions");
            curl_setopt($ch, CURLOPT_USERPWD, "sgade@reisystems.com:Bizusa1!");
          }else{
            curl_setopt($ch, CURLOPT_URL, "https://api.govdelivery.com/api/account/USBUSUSA/subscribers/add_subscriptions");
            curl_setopt($ch, CURLOPT_USERPWD, "amin.mehr@businessusa.gov:BusinessUSA@1234");
          }
          $topic_xml = "<subscriber>
                                        <email>" . $sub_email . "</email>
                                        <send-notifications type='boolean'>true</send-notifications>
                                        <topics type='array'>
                                            <topic><code>".$busa_topic."</code></topic>
                                        </topics>
                                  </subscriber>";
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
          curl_setopt($ch, CURLOPT_POSTFIELDS, "$topic_xml");
          $topic_response = curl_exec($ch);
          curl_close($ch);
        }

        $update_query = "UPDATE field_data_field_no_attempts flag
                                  LEFT JOIN node n ON flag.entity_id = n.nid
                                  LEFT JOIN field_data_field_subscribe_email e ON n.nid = e.entity_id
                                  SET flag.field_no_attempts_value = 1
                                WHERE e.field_subscribe_email_value = :email";
        db_query($update_query, array(':email' => $sub_email));
        array_push($saved_emails, $sub_email);
      }
      else {
        $update_query = "UPDATE field_data_field_no_attempts flag
                                              LEFT JOIN node n ON flag.entity_id = n.nid
                                              LEFT JOIN field_data_field_subscribe_email e ON n.nid = e.entity_id
                                              SET flag.field_no_attempts_value = flag.field_no_attempts_value-1
                                            WHERE e.field_subscribe_email_value = :email";

        db_query($update_query, array(':email' => $sub_email));
        array_push($failed_emails, $sub_email);
      }
      $batch_count++;
    }
    $result = array('success' => $saved_emails, 'fail' => $failed_emails, 'total_emails' => $batch_count);
  }
  else {
    $result = array('Message' => 'There are no new emails to process.');
  }
  return $result;
}
