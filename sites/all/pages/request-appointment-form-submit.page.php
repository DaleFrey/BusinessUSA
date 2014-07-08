<?php

	/* Handel form submission */
    
    // Validation - Ensure the dispatchEmails() function is defined
    if ( !function_exists('dispatchEmails') ) {
        $msg = 'Error - The dispatchEmails() function was not declared.';
        print $msg;
        return $msg;
    }
    
    // Validation - Ensure we have a target Office (node) ID
    if ( empty($_GET['office']) ) {
        $msg = 'Error - office parameter was not supplied.';
        print $msg;
        return $msg;
    }
    
    // Validation - Ensure the target Office (node) has an email address associated with it
    $officeNode = node_load( intval($_GET['office']) );
    if ( empty($officeNode->field_appoffice_email['und'][0]['value']) || trim($officeNode->field_appoffice_email['und'][0]['value']) === '' ) {
        $msg = 'Error - The target office does not have an email address asscoaited with it.';
        print $msg;
        return $msg;
    }
    
    extract($_POST);
    
    $emailTargets = array();
    $emailTargets[] = 'dfrey@reisys.com';
    if ( strpos( request_uri(), "-DEBUG-REQAPPFORM-NOOFFICESEND-") === false ) {
        $emailTargets[] = 'busa@supportcenteronline.com';
        $emailTargets[] = $officeNode->field_appoffice_email['und'][0]['value'];
    }
    
    // Form validation - requiered fields
    if ( empty($_POST['reasonforvisit']) || empty($_POST['reqaptemail']) ) {
        $msg = 'You did not fill out all of the required fields in the previous form. Please click the back button on your browser, and be sure to supply an email, and a reason as to why you wish to meet with someone in this office.';
        print $msg;
        return $msg;
    }
    
    // Add this request to the Request an Appointment log
    $csvFirstname = $firstname;
    $csvReqaptemail = $reqaptemail;
    $csvPhone = $phone;
    $csvOfficeTitle = $officeTitle;
    $csvReasonforvisit = $reasonforvisit;
    $csvEntry = "";
    
    // Construct email message for Parature and the target SBA Office
    $officeRawTitle = $officeNode->title;
    $officeTitle = "\"" . $officeRawTitle . "\"";
    $officeRawStreetAdddress = trim($officeNode->field_appoffice_address['und'][0]['value']);
    if ( !empty($officeNode->field_appoffice_additional) && !empty($officeNode->field_appoffice_additional['und'][0]['value']) ) {
        $officeRawStreetAdddress .= ', ' . trim($officeNode->field_appoffice_additional['und'][0]['value']);
    }
    $officeTitle .= ' (at ' . $officeRawStreetAdddress;
    $officeRawCity = trim($officeNode->field_appoffice_city['und'][0]['value']);
    $officeTitle .= ', ' . $officeRawCity;
    $officeRawState = trim($officeNode->field_appoffice_state['und'][0]['value']);
    $officeTitle .= ', ' . $officeRawState . ')';
    
    $emailMsg = "
        Hello,<br/>
        <br/>
        This is an auto-generated message for the in response to an individual's request for an appointment. This is a system generated message. Please do not reply to this email.<br>
        <br/>
        <br/>
        <b>Name:</b> $firstname<br/>
        <b>Email:</b> $reqaptemail<br/>
        <b>Phone:</b> $phone<br/>
        <b>Location:</b> $officeTitle<br/>
        <br/>
        <b>Comments:</b><br/>
        $reasonforvisit<br/>
        <br/>
    ";
    
    if ( strpos( request_uri(), "-DEBUG-REQAPPFORM-VERBOSEANDNOSEND-") !== false ) {
        dsm(
            array(
                "Office Node" => $officeNode,
                "emailTargets" => $emailTargets,
                "_POST" => $_POST,
                "emailMsg" => $emailMsg
            )
        );
    } else {
        if ( strpos( request_uri(), "-DEBUG-DONOTSENDEMAIL-") === false ) {
            dispatchEmails($emailTargets, 'appointment@businessusa.gov', 'Appointment Request', $emailMsg);
        }
    }
    
    // Send a confirmation email to the user
    if ( strpos( request_uri(), "-DEBUG-DONOTSENDVERIFICATION-") === false ) {
        $emailMsg = "
            Dear $firstname,<br/>
            <br/>
            Your request for an appointment at the following location has been received:<br/>
            <br/>
            $officeRawTitle<br/>
            $officeRawStreetAdddress<br/>
            $officeRawCity, $officeRawState<br/>
            <br/>
            You will be contacted soon via email or by phone to schedule the appointment.<br/>
            <br/>
            Thank you,<br/>
            BusinessUSA Team<br/>
            <br/>
            <small>[This is a system generated email notification]</small>
        ";
        
        dispatchEmail($reqaptemail, 'appointment@businessusa.gov', 'Your request for an appointment', $emailMsg);
    }
    
    print 'Your message has been sent, and you will receive a confirmation message shortly. Thank you. <a href="/">Click here</a> to go back to the home page.';
