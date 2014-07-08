<?php
    /*
        [!!] PURPOSE [!!]
        
        This script should be called through an AJAX session from the "Contact Us" slide in the "Invest in the USA" Wizard.
        This script is used to read the values placed in this form's elements and dispatch an email to info@selectusa.gov
        This script expects the form's elements to exist in $_POST as if a form was submitted to the URL that executes this script.
        
        [!!] NOTICE [!!]
        
        This script is meant to be triggered with an AJAX call. This script expects Drupal to already be boot-strapped.
        
    */

    // Collect debug info
    ob_start();
    print '<!-- The following markup is stored in ' . __FILE__ . '.php -->';
    print '<!-- DEBUG INFO: $_POST IS: ';
    var_dump($_POST);
    print ' --->';
    $debugInfo_post = ob_get_contents();

    // Determin the email message to be dispatched based on the input-values aupplied in the form ($_POST)
    $msg = "
        This message is being dispatched from a user who has completed the Contact-Us form from the BusinessUSA, <a href=\"http://business.usa.gov/select-usa\">Invest in the USA Wizard</a>:<br/>
        <br/>
    ";
    if ( !empty($_POST['contact_name']) ) {
        $msg .= "<b>Name</b>: " . $_POST['contact_name'] . " <br/>\n";
    }
    if ( !empty($_POST['company_name']) ) {
        $msg .= "<b>Company Name</b>: " . $_POST['company_name'] . " <br/>\n";
    }
    if ( !empty($_POST['contact_email']) ) {
        $msg .= "<b>E-Mail Address</b>: " . $_POST['contact_email'] . " <br/>\n";
    }
    if ( !empty($_POST['contact_phone']) ) {
        $msg .= "<b>Phone</b>: " . $_POST['contact_phone'] . " <br/>\n";
    }
    if ( !empty($_POST['typeofclient']) ) {
        if ( $_POST['typeofclient'] !== 'Select One' ) {
            $msg .= "<b>Type of Client</b>: " . $_POST['typeofclient'] . " <br/>\n";
        }
    }
    if ( !empty($_POST['noofemployees']) ) {
        if ( $_POST['noofemployees'] !== 'Select One' ) {
            $_POST['noofemployees'] = str_replace('_contact_noemp_', '', $_POST['noofemployees']);
            $_POST['noofemployees'] = str_replace('_', ' ', $_POST['noofemployees']);
            $msg .= "<b>Number of Employees</b>: " . $_POST['noofemployees'] . " <br/>\n";
        }
    }
    if ( !empty($_POST['contact_sub']) ) {
        $msg .= "<b>Subject</b>: " . $_POST['contact_sub'] . " <br/>\n";
    }
    if ( !empty($_POST['contact_msg']) ) {
        $msg .= "<b>Message</b>: " . $_POST['contact_msg'] . " <br/>\n";
    }
    $msg .= "<br/>\n";
    
    // Inject hidden debug information into email message
    $msg .= $debugInfo_post;
    
    // Form (back-end) validation 
    $formValidationPasses = true;
    if ( empty($_POST['contact_name']) ) {
        $formValidationPasses = false;
        print '
            Error - You must supply a value in the name field of the form.<br/>
            <br/>
            <a href="javascript: jQuery.colorbox.close(); void(0);">
                Click here to go back
            </a>
        ';
        return 1;
    }

    if ( empty($_POST['company_name']) ) {
        $formValidationPasses = false;
        print '
            Error - You must supply a value in the company field of the form.<br/>
            <br/>
            <a href="javascript: jQuery.colorbox.close(); void(0);">
                Click here to go back
            </a>
            ';
        return 1;
    }
    if ( empty($_POST['contact_email']) ) {
        $formValidationPasses = false;
        print '
            Error - You must supply a value in the contact email field of the form.<br/>
            <br/>
            <a href="javascript: jQuery.colorbox.close(); void(0);">
                Click here to go back
            </a>
                ';
        return 1;
    }
    if ( empty($_POST['contact_sub']) ) {
        $formValidationPasses = false;
        print '
            Error - You must supply a value in the subject field of the form.<br/>
            <br/>
            <a href="javascript: jQuery.colorbox.close(); void(0);">
                Click here to go back
            </a>
        ';
        return 1;
    }
    if ( empty($_POST['contact_msg']) ) {
        $formValidationPasses = false;
        print '
            Error - You must supply a value in the message field of the form.<br/>
            <br/>
            <a href="javascript: jQuery.colorbox.close(); void(0);">
                Click here to go back
            </a>
        ';
        return 1;
    }
    
    // Send a BUSA debug message if the form is invalid
    if ( $formValidationPasses === false ) {

        $emailAddresses = array(
            'dfrey@reisystems.com',
            'sjhawar@reisystems.com',
        );
        
        // We do not want to send an email to info@selectusa.gov if we are running this script on Dev, nor do we sent to send the email if the form is invalidated.
        if ( intval(version_awareness_environment_isproduction()) === 1 ) { // If we are running on production...
            if ( $formValidationPasses ) { // If the form passes validation
                $emailAddresses[] = 'info@selectusa.gov';
            } else {
                $msg .= "This email was <b>NOT</b> dispatched to info@selectusa.gov since the form did not pass validation.<br/>\n";
            }
        } else {
            $strEmailAddresses = implode(', ', $emailAddresses);
            print "
                <script>
                    alert('Not dispatching email to info@selectusa.gov since this is not the production environment. Will dispatch an email(s) to: $strEmailAddresses');
                </script>
            ";
        }
        
        // Send email(s) - the dispatchEmails() function is defined in dispatchEmail.php
        $deRet = dispatchEmails(
            $emailAddresses,
            'no-reply@businessusa.gov', 
            'Business USA - Invest in the USA - Contact Form Submission - ' . $_POST['contact_sub'], 
            $msg
        );
        
        // Print debug info to the client-browser (though the AJAX call)
        print "<!-- dispatchEmails() return was \n $deRet -->";
        print "<div style=\"display: none;\"> Message dispatched was \n <textarea>$msg</textarea> </div>";
        print "<!-- Target emailAddresses were: \n " . print_r($emailAddresses, true) . " -->";
    
    }
    
?>

Your message has been sent.
<script>
    
    setTimeout( function () {
        jQuery('.wiztag-email_filled input').get(0).checked = true;
        yawizard.validateDependencyOnSlides();
        jQuery.colorbox.close();
        yawizard.next();
    }, 1500);
    
</script>