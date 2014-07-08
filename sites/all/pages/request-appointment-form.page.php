<head>

    <link rel="stylesheet" href="../sites/all/themes/bizusa/scripts/Datepicker/jquery-ui.css">
   <!-- <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->

    <script src="../sites/all/themes/bizusa/scripts/Datepicker/jquery-1.10.2.js"></script>
    <script src="../sites/all/themes/bizusa/scripts/Datepicker/jquery.ui.js"></script>
    <script src="../sites/all/modules/custom/apachesolr_autocomplete/jquery-autocomplete/jquery.autocomplete.js"></script>
</head>


<?php

    // Page validation 
    if ( empty($_GET['office']) ) {
        $msg = '<b>Invalid Request</b> - No <i>office</i> parameter was given.';
        print $msg;
        return $msg;
    }
    
    $officeNid = $_GET['office'];
    $officeNode = node_load($officeNid);
    
    dsm( $officeNid );
    dsm( $officeNode );
    
    if ( empty($officeNode->field_appoffice_email['und'][0]['value']) ) {
        $msg = "<b>Invalid Office</b> - The target office/node ({$officeNid}) does not have an email address.";
        print $msg;
        return $msg;
    }
    
?>

<div class="requestform-container" rendersource="<?php print basename(__FILE__); ?>">
    <form method="post" action="" id="req-appt-form" class="req-appt-form" action="request-appointment-form-submit">
        <input type="hidden" name="sendmessage" id="sendmessage" value="1" style="display: none;" />

        <div class="office-loc">
            <div class="requestappointment-welcomemessage">
                <h4>You have selected the following office for an appointment:</h4>
            </div>
            <div class="office-address">
                <strong class="officeadd-label">Appointment Location: </strong>
                <?php print $officeNode->field_appoffice_loc_name['und'][0]['value']; ?>
                <br />
                <strong class="officeadd-label">Address: </strong>
                <?php print $officeNode->field_appoffice_address['und'][0]['value']; ?>,
                <?php print $officeNode->field_appoffice_city['und'][0]['value']; ?>,
                <?php print $officeNode->field_appoffice_state['und'][0]['value']; ?>,
                <input type="hidden" style="display: none" name="office" value="<?php print $nid; ?>" />
            </div>
            <div class="change-office">
                <input type="button" value="Change Location" class="changelocbutton" id="changelocbutton" onclick="history.back();" />
                <script>
                    document.getElementById('changelocbutton').value = "Choose Different Office"; 
                </script>
            </div>
        </div>

        <div class="appt-form">
            <div class="field-line">
                <label for="dateofvisit">Date of Visit*</label>
                <div class="dateofvisit-input-container">
                    <input type="text" name="dateofvisit" id="dateofvisit" placeholder="Pick a Day" />
                </div>

                <label for="timeofvisit">Time of Visit</label>
                <div class="timeofvisit-input-container">
                    <select id="timeofvisit" name="timeofvisit" class="timeofvisit">
                        <option value="">Pick a Time</option>
                        <option value="8:00am">8:00am</option>
                        <option value="9:00am">9:00am</option>
                        <option value="10:00am">10:00am</option>
                        <option value="11:00am">11:00am</option>
                        <option value="12:00pm">12:00pm</option>
                        <option value="1:00pm">1:00pm</option>
                        <option value="2:00pm">2:00pm</option>
                        <option value="3:00pm">3:00pm</option>
                        <option value="4:00pm">4:00pm</option>
                        <option value="5:00pm">5:00pm</option>
                        <option value="6:00pm">6:00pm</option>
                        <option value="7:00pm">7:00pm</option>
                    </select>
                </div>
            </div>
            <div class="field-line">
                <label for="firstname" style="padding-top: 15px;">First Name</label>
                <div class="firstname-input-container">
                        <input type="text" name="firstname" id="firstname" placeholder="First Name">
                </div>
                <label for="lastname">Last Name</label>
                <div class="lastname-input-container">
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name">
                </div>
            </div>
            <div class="field-line">
                <label for="reqaptemail">* Email</label>
                <div class="email-input-container">
                        <input type="text" name="reqaptemail" id="reqaptemail" placeholder="Email">
                </div>
                <label for="phone">Phone</label>
                <div class="phone-input-container">
                        <input type="text" name="phone" id="phone" placeholder="Phone Number">
                </div>
            </div>
            <div class="field-line">
                <label for="reasonforvisit">* Reason for Visit</label>
                <textarea name="reasonforvisit" id="reasonforvisit" placeholder="Reason for Visit"></textarea>
            </div>
            <div class="field-line">
                <input id="submitter" name="submitter" type="submit" value="Submit">
                <input id="cancel-button" type="button" value="Cancel" onclick="history.back();">
            </div>
        </div>

    </form>
    <script>

        //Tests if browser support placeholder attribute
        jQuery(function() {
            jQuery.support.placeholder = false;
            test = document.createElement('input');
            if('placeholder' in test) jQuery.support.placeholder = true;
        });

        jQuery(document).ready( function () {

            //If browser does NOT support placeholder attribute do this
            if(!$.support.placeholder) {

                //Adds placeholder attribute as the input value
                $("[placeholder]").focus(function() {
                    var input = $(this);
                    if (input.val() == input.attr("placeholder")) {
                        input.val("");
                    }
                }).blur(function() {
                    var input = $(this);
                    if (input.val() == "" || input.val() == input.attr("placeholder")) {
                        input.val(input.attr("placeholder"));
                    }
                }).blur();

                //Clears input values if the form its submitted with placeholder values
                $("[placeholder]").parents("form").submit(function() {
                    $(this).find("[placeholder]").each(function() {
                        var input = $(this);
                        if (input.val() == input.attr("placeholder")) {
                            input.val("");
                        }
                    })
                });

            }


            jQuery('#req-appt-form').attr('action', 'request-appointment-form-submit' + document.location.search);
            $( "#dateofvisit" ).datepicker();
        });
        jQuery('#req-appt-form').attr('action', 'request-appointment-form-submit' + document.location.search);

        

    </script>
</div>
    