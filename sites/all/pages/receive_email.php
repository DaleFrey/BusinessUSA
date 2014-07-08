<?php

/**
 * Checks if an email already exists.
 *
 * @param $email
 * @return mixed
 */
function checkExistenceOfEmail($email){
  $count = 0;

  //Read the subscriber information from Gov Delivery API
  $ch = curl_init();
  emailSubscription();
  if ( function_exists('version_awareness_environment_isproduction') && version_awareness_environment_isproduction() !== true ) {
    $url = "https://stage-api.govdelivery.com/api/account/USBUSUSASTAGE/subscribers/".base64_encode($email);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, "sgade@reisystems.com:Bizusa1!");
  }
  else {
    $url = "https://api.govdelivery.com/api/account/USBUSUSA/subscribers/".base64_encode($email);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERPWD, "amin.mehr@businessusa.gov:BusinessUSA@1234");
  }
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
  $user_response = curl_exec($ch); // execute curl request
  // var_dump(curl_error($ch)); var_dump($url); var_dump($user_response); var_dump($ch); var_dump(base64_encode('naga.tejaswini@reisystems.com')); exit;
  curl_close($ch);

  //Update the subscriber info with no of attempts = 0 if the subscriber is not found on the API

  $response = json_decode(json_encode((array) simplexml_load_string($user_response)),1);
  if($response['error'] == 'Subscriber not found'){
    $update_query = "UPDATE field_data_field_no_attempts flag
                         LEFT JOIN node n ON flag.entity_id = n.nid
                         LEFT JOIN field_data_field_subscribe_email e ON n.nid = e.entity_id
                         SET flag.field_no_attempts_value = 0
                         WHERE e.field_subscribe_email_value = :email";

    $result = db_query($update_query, array(':email' => $email));

    return $count;
  }

  //Check the database if the subscriber is already existing
  $countSQL = "SELECT COUNT(*) AS record_count FROM node n
                 LEFT JOIN field_data_field_subscribe_email e ON n.nid = e.entity_id
                 LEFT JOIN field_data_field_no_attempts a ON n.nid = a.entity_id
                 WHERE n.type = 'receive_email' AND e.field_subscribe_email_value = :email ";

  $result = db_query($countSQL, array(':email' => $email));

  foreach ($result as $result) {
    $count = $result->record_count;
  }
  return $count;
}

/**
 * Saves email if not already in both the database and in the mailling list.
 *
 * @param $email
 * @return string
 */
function save_email($email){
  $count = checkExistenceOfEmail($email);

  //Save the subscriber if not existing in the database
  if($count == 0){
    $newNode = (object) array();
    $newNode->type = "receive_email";
    $newNode->title = $email;
    $newNode->field_subscribe_email['und'][0]['value'] = $email;
    $newNode->field_sent_email_flag['und'][0]['value'] = 0;
    $newNode->field_no_attempts['und'][0]['value'] = 0;
    node_save($newNode);
    emailSubscription();
    return 'You have successfully subscribed to receive BusinessUSA updates.';
  }

  return "You are already subscribed to receive BusinessUSA updates.";
}

/**
 * Forces push to remote sever.
 *
 * @return array
 */
function emailSubscription() {
  // Always send emails. Requested by admins.
  govdelivery_splash_update_all();
}
