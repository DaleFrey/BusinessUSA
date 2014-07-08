<?php
    include_once('receive_email.php');
    $email = trim(htmlspecialchars($_REQUEST['email']));
    $subscribeEmail = trim(htmlspecialchars($_REQUEST['subscribeEmail']));
    if(!filter_var($subscribeEmail, FILTER_VALIDATE_EMAIL)) $subscribeEmail = '';
    if($email){
        $message = save_email($email);
        echo "<div id='quick_subscribe_new_instructions'>$message</div>";
    }
    else{

?>
        <div class="errorExplanation" id="errorExplanation" style="display:none;">
            <p><strong></strong>Can't save Subscriber due to the following error:</strong></p>
            <label id="errorMsg"></label>
        </div>
        <br clear="all" />
        <fieldset id='quick_subscribe_new'>
            <div id='quick_subscribe_new_instructions'>
                Please enter a valid email address for subscription to BusinessUSA.
            </div>
            <ol class='form'>
                <form action="" method="POST" id="subscribeSubmit">
                    <li class='email_fields' style='display: block'>
                        <label for="primaryEmail">
                        <img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Email Address:
                        </label>
                        <input class="long" id="primaryEmail" name="email" type="text" value="<?php echo $subscribeEmail; ?>" />
                        <br/>
                        <label for="confirmEmail">
                        <img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Confirm Email Address:
                        </label>
                        <input class="long" id="confirmEmail" name="confirmEmail" type="text" value="" />
                    </li>
                    <div class='button_panel'>
                        <input class="form_button" id="subscribe" name="commit" type="button" value="Subscribe" />
                    </div>
                </form>
            </ol>
        </fieldset>
<?php
    }
?>

<?php
    if(!$email){
?>
        <script>
            jQuery("#subscribe").click( function () {
                $('#errorExplanation').hide();
                var emailAddress =  $('#primaryEmail').val();

                if(emailAddress.length == 0){
                    $('#errorExplanation').show();
                    $("#errorMsg").html('<img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Email cannot be blank.');
                    $("#errorMsg").css('color','red');
                }else if(!isValidEmailAddress(emailAddress)){
                    $('#errorExplanation').show();
                    $("#errorMsg").html('<img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Please enter a valid email address.');
                    $("#errorMsg").css('color','red');
                }
                else if(emailAddress != $("#confirmEmail").val()){
                    $('#errorExplanation').show();
                    $("#errorMsg").html('<img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Please enter the same email in both boxes.');
                    $("#errorMsg").css('color','red');
                }
                else
                    $("#subscribeSubmit").submit();
            });

            jQuery('#confirmEmail, #primaryEmail').keyup(function(e) {
                    var $textbox = $(this);
                    if ($textbox.val().length > 0 && e.keyCode == 13) {
                        $('#errorExplanation').hide();
                        var emailAddress =  $('#primaryEmail').val();

                        if(emailAddress.length == 0){
                            $('#errorExplanation').show();
                            $("#errorMsg").html('<img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Email cannot be blank.');
                            $("#errorMsg").css('color','red');
                        }else if(!isValidEmailAddress(emailAddress)){
                            $('#errorExplanation').show();
                            $("#errorMsg").html('<img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Please enter a valid email address.');
                            $("#errorMsg").css('color','red');
                        }
                        else if(emailAddress != $("#confirmEmail").val()){
                            $('#errorExplanation').show();
                            $("#errorMsg").html('<img alt="Required" class="required" src="https://public.govdelivery.com/images/required.gif?3.5.1-30998-E2" />Please enter the same email in both boxes.');
                            $("#errorMsg").css('color','red');
                        }
                        else
                            $("#subscribeSubmit").submit();
                    }
            });
            


            //Validate email address
            function isValidEmailAddress(emailAddress) {
                var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
                // var pattern = new RegExp('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$');
                return pattern.test(emailAddress);
            }
        </script>
<?php
}
?>