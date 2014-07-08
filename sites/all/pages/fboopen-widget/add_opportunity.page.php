
<head>
    <link rel="stylesheet" href="../sites/all/themes/bizusa/scripts/Datepicker/jquery-ui.css">
    <script src="../sites/all/themes/bizusa/scripts/Datepicker/jquery-1.10.2.js"></script>
    <script src="../sites/all/themes/bizusa/scripts/Datepicker/jquery.ui.js"></script>
    <script src="../sites/all/modules/custom/apachesolr_autocomplete/jquery-autocomplete/jquery.autocomplete.js"></script>
    <script src="../sites/all/themes/bizusa/scripts/plugins/jquery.colorbox.js"></script>
    <script src="../sites/all/themes/bizusa/scripts/plugins/jquery.colorbox-min.js"></script>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: sanjay.gupta
 * Date: 6/10/14
 * Time: 2:43 PM
 */
?>
<div class="welcomemessage">
    Welcome to the HUD Construction Opportunity Form. Please fill in the relevant information to post the opportunity on BusinessUSA.
</div>
<div id="opportunity-content-container">
<div class="required-description">Fields marked with <span title="This field is required." class="form-required">*</span> are required</div>

    <form action="/fboopen-widget/confirm_opportunity" method="POST" id='opportunityforms' >
        <div class="row-container">
            <span  class="leftcol">
                <label id="lblOpportunityTitle" value="Opportunity Title">
                    Opportunity Title
                    <span title="This field is required." class="form-required">*</span>
                </label>
            </span>
            <span class="rightcol">
                <input name="opportunitytitle" type="text" id="txtopportunitytitle" />
            </span>

        </div>

         <div class="row-container">
             <span  class="leftcol">
                <label id="lblAgencyName" value="Name of Agency/Organization">
                    Name of Agency/Organization
                    <span title="This field is required." class="form-required">*</span>
                </label>
             </span>
             <span  class="rightcol">
                 <input name="AgencyName" type="text" id="txtAgencyName" />
             </span>
         </div>

         <div class="row-container">
             <span  class="leftcol">
                <label id="lblnaicscode" value="NAICS code">
                 NAICS (North American Industry Classification System) code
                 <span title="This field is required." class="form-required">*</span></label>
             </span>
              <span class="rightcol">
                <input name="NAICSCode" type="text" id="txtNAICSCode" />
                <span class="help-text"><a href="http://www.census.gov/eos/www/naics/" target="_blank">NAICS lookup code reference</a></span>
              </span>
         </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblresponsedeadline" value="Response Deadline">Response Deadline</label>
            </span>
            <span class="rightcol">
                 <input  name="Deadline" type="text" id="dtpdeadline" />
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblawarddate" value="Contract Award Date">Contract Award Date</label>
            </span>
             <span class="rightcol">
                <input  name="AwardDate" type="text" id="dtpawarddate" />
             </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                <label id="lblperfstate" value="Place of Performance State">Place of Performance State</label>
            </span>
            <span class="rightcol">
               <!-- <input  name="County" type="text" />-->

                    <select name="statelist" id="sltStatelist" form="opportunityforms">
                        <option value="0">Select a state or Territory</option>
                        <option value="Alabama">Alabama</option>
                        <option value="Alaska">Alaska</option>
                        <option value="America Samoa">America Samoa</option>
                        <option value="Arizona">Arizona</option>
                        <option value="Arkansas">Arkansas</option>
                        <option value="California">California</option>
                        <option value="Colorado">Colorado</option>
                        <option value="Connecticut">Connecticut</option>
                        <option value="Delaware">Delaware</option>
                        <option value="District of Columbia">District of Columbia</option>
                        <option value="Florida">Florida</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Guam">Guam</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Idaho">Idaho</option>
                        <option value="Illinois">Illinois</option>
                        <option value="Indiana">Indiana</option>
                        <option value="Iowa">Iowa</option>
                        <option value="Kansas">Kansas</option>
                        <option value="Kentucky">Kentucky</option>
                        <option value="Louisiana">Louisiana</option>
                        <option value="Maine">Maine</option>
                        <option value="Maryland">Maryland</option>
                        <option value="Massachusetts">Massachusetts</option>
                        <option value="Michigan">Michigan</option>
                        <option value="Minnesota">Minnesota</option>
                        <option value="Mississippi">Mississippi</option>
                        <option value="Missouri">Missouri</option>
                        <option value="Montana">Montana</option>
                        <option value="Nebraska">Nebraska</option>
                        <option value="Nevada">Nevada</option>
                        <option value="New Hampshire">New Hampshire</option>
                        <option value="New Jersey">New Jersey</option>
                        <option value="New Mexico">New Mexico</option>
                        <option value="New York">New York</option>
                        <option value="North Carolina">North Carolina</option>
                        <option value="North Dakota">North Dakota</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Ohio">Ohio</option>
                        <option value="Oklahoma">Oklahoma</option>
                        <option value="Oregon">Oregon</option>
                        <option value="Pennsylvania">Pennsylvania</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Rhode Island">Rhode Island</option>
                        <option value="South Carolina">South Carolina</option>
                        <option value="South Dakota">South Dakota</option>
                        <option value="Tennessee">Tennessee</option>
                        <option value="Texas">Texas</option>
                        <option value="Utah">Utah</option>
                        <option value="Vermont">Vermont</option>
                        <option value="Virgin Island">Virgin Island</option>
                        <option value="Virginia">Virginia</option>
                        <option value="Washington">Washington</option>
                        <option value="West Virginia">West Virginia</option>
                        <option value="Wisconsin">Wisconsin</option>
                        <option value="Wyoming">Wyoming</option>
                    </select>

            </span>

        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblperfcity" value="Place of Performance City">Place of Performance City</label>
           </span>
            <span class="rightcol">
                <input  name="City" type="text" id="txtCity"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                <label id="lblperfcounty" value="Place of Performance County">Place of Performance County</label>
            </span>
            <span class="rightcol">
                <input  name="County" type="text" id="txtCounty" />
            </span>

        </div>

        <div class="row-container">
            <span  class="leftcol">
            <label id="lblperfzio" value="Place of Performance Zip Code">Place of Performance Zip Code</label>
           </span><span class="rightcol"> <input  name="Zipcode" type="text" id="txtZipcode" maxlength="5" /></span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
            <label id="lblorgaddress" value="Contracting Agency/Organization Address">Contracting Agency/Organization Address</label>
          </span> <span class="rightcol"> <input  name="Address" type="text" id="txtAddress"/></span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                <label id="lblsynopsis" value="Synopsis">Synopsis</label>
            </span>
            <span class="rightcol">
                <textarea  name="Synopsis" id="txtSynopsis" rows ="5"></textarea>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
              <label id="lbldescriptionproject" value="Description of Project">Description of Project</label>
           </span>
            <span class="rightcol">
                <!--<input  name="Description" type="text" id="txtDescription"  />-->
                <textarea name="Description"  id="txtDescription" rows ="5"></textarea>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblcontactperson" value="Primary Contact Person">Primary Contact Person</label>
            </span>
            <span class="rightcol">
                <input  name="ContactPerson" type="text" id="txtContactPerson"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                <label id="lblcontactphonenumber" value="Primary Contact Phone Number ">Primary Contact Phone Number </label>
            </span>
            <span class="rightcol">
                <input  name="PhoneNumber" type="text" id="txtPhoneNumber" maxlength="10"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                <label id="lbl" value="Primary Contact Email">Primary Contact Email</label>
             </span>
            <span class="rightcol">
                <input  name="Email" type="text" id="txtEmail"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblorgurl" value="Website URL of Agency/Organization">Website URL of Agency/Organization</label>
            </span>
            <span class="rightcol">
                <input  name="AgencyURL" type="text" id="txtAgencyURL"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblreporting_requirements" value="Reporting Requirements">Reporting Requirements</label>
            </span>
            <span class="rightcol">
                <input  name="Requirements" type="text" id="txtRequirements"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblspecialsiteconditions" value="Special Site Conditions">Special Site Conditions (e.g. Environmental concerns)</label>
            </span>
            <span class="rightcol">
                <input  name="SpecialConditions" type="text" id="txtSpecialConditions"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblnotice_type" value="Notice Type">Notice Type</label>
            </span>
            <span class="rightcol">
                <input  name="NoticeType" type="text" id="txtNoticeType"/>
            </span>
        </div>

        <div class="row-container">
            <span  class="leftcol">
                 <label id="lbltrades_required " value="Trades Required">Trades Required</label>
            </span>
             <span class="rightcol">
                 <input  name="TradeRequired" type="text" id="txtTradeRequired" />
             </span>
        </div>

        <div id="section3" class="row-container">
            <span  class="leftcol">
                  <label id="lblsection3" value="Do Section 3 Requirements Apply?">Do Section 3 Requirements Apply?</label>
                <a class="officetype-tooltip-area">
                    <img class="officetype-tooltip-icon" src="/sites/all/themes/bizusa/images/icons/informationicon.png">
                    <div class="officetype-tooltip-desc">
                        Section 3 is a provision of the Housing and Urban Development (HUD) Act of 1968 that helps foster local economic development, neighborhood economic improvement, and individual self-sufficiency. The Section 3 program requires that recipients of certain HUD financial assistance, to the greatest extent feasible, provide job training, employment, and contracting opportunities for low- or very-low income residents in connection with projects and activities in their neighborhoods.
                    </div>
                </a>
            </span>
             <span class="rightcol">
                  <input  name="section3" type="radio" value="section3" onclick="ShowTextbox(this)" id="rdbsection3yes">
                  <label class="labelforradio" for="rdbsection3yes">Yes</label>
                  <input  name="section3" type="radio" value="section3_no" onclick="ShowTextbox(this)" id="rdbsection3no">
                  <label class="labelforradio" for="rdbsection3no">No</label>
                  <input id="txtsection3yes" name="section3yestext" type="text"/>
            </span>
        </div>
        <div class="row-container">
            <span  class="leftcol">
                 <label id="lblminoritywomen" value="M/W/DBE">Do Minority, Women and Disadvantaged Business Enterprise (M/W/DBE) Requirements Apply?</label>
            </span>
            <span class="rightcol">

                <input  name="minoritywomen" type="radio" value="minoritywomen" onclick="ShowTextbox(this)" id="rdbminorityyes">
                <label class="labelforradio" for="rdbminorityyes">Yes</label>
                <input  name="minoritywomen" type="radio" value="minoritywomen_no" onclick="ShowTextbox(this)" id="rdbminorityno">
                <label class="labelforradio" for="rdbminorityno">No</label>
                <input id="txtminorityyes" name="minorityyestext" type="text"/>

            </span>
        </div>
        <div id="lbl_Disclaimer">
            Disclaimer:
            The information contained pertaining to solicitations and other notices is the sole responsibility of the
            business entity posting the solicitation or notice. Users should communicate directly with the business entity
            where verification or further clarification is desired.
        </div>

        <div id="actionButtons">
            <input type="submit" value="Submit" style="width: 100px; margin-right: 10px;" />
            <input type="button" value="Reset" id="btnreset" style="width: 100px; margin-right: 10px;" />
        </div>

    </form>

</div>

<script>

    $(document).ready(function(){

        $('#txtminorityyes').hide();
        $('#txtsection3yes').hide();

        $( "#dtpawarddate" ).datepicker();
        $( "#dtpdeadline" ).datepicker();

    });

    $("#btnreset").click(function(){



        $('#opportunityforms').get(0).reset();

        if ($('#rdbsection3yes').attr('checked') != null)
        {
            $('#rdbsection3yes').next().removeAttr('class');
            $('#txtsection3yes').hide();
        }
        else
        {
            $('#rdbsection3no').next().removeAttr('class');
        }

        if ($('#rdbminorityyes').attr('checked') != null)
        {
            $('#rdbminorityyes').next().removeAttr('class');
            $('#txtminorityyes').hide();
        }
        else
        {
            $('#rdbminorityno').next().removeAttr('class');
        }

    });




    $("#opportunityforms").submit(function(){

        //Title validations
        if ($('#txtopportunitytitle').val().length == 0)
        {
            alert('Please provide Title');
            $('#txtopportunitytitle').focus();
            return false;
        }

        //Agency Name validations
        if ($('#txtAgencyName').val().length == 0)
        {
            alert('Please provide Agency Name');
            $('#txtAgencyName').focus();
            return false;
        }


        //NAICS code validation
        if ($('#txtNAICSCode').val().length > 1 && $('#txtNAICSCode').val().length < 7 )
        {
                var naicscode = $('#txtNAICSCode').val();
                if  (!($.isNumeric(naicscode)))
                {
                    alert('Please provide valid numeric NAICS code');
                    $('#txtNAICSCode').focus();
                    return false;
                }

        }

        else if (($('#txtNAICSCode').val().length <= 1) || ($('#txtNAICSCode').val().length > 7))
        {
            alert('Please provide numeric valid  NAICS code');
            $('#txtNAICSCode').focus();
            return false;
        }







        //Date validation


        //Deadline date
       if ($('#dtpdeadline').val().length > 1)
       {
           var deadline = new Date($('#dtpdeadline').val());

           var deadlineday = deadline.getDate();
           var deadlinemonth = deadline.getMonth();
           var deadlineyear = deadline.getYear();



           var currdate = new Date();
           var currday = currdate.getDate();
           var currmonth = currdate.getMonth();
           var curryear = currdate.getYear();

           if ((deadlineyear < curryear) || (deadlineyear == curryear) )
           {
               if ((deadlinemonth < currmonth) || (deadlinemonth == currmonth) )
               {
                   if ((deadlineday < currday) || (deadlineday == currday) )
                   {
                       alert('Response Deadline should be greater than current date');
                       return false;
                   }
               }

           }


       }

        //Award Date

        if ($('#dtpawarddate').val().length > 1)
        {
            var awarddate = new Date($('#dtpawarddate').val());

            var awarddateday = awarddate.getDate();
            var awarddatemonth = awarddate.getMonth();
            var awarddateyear = awarddate.getYear();



            var currdate = new Date();
            var currday = currdate.getDate();
            var currmonth = currdate.getMonth();
            var curryear = currdate.getYear();

            if ((awarddateyear < curryear) || (awarddateyear == curryear) )
            {
                if ((awarddatemonth < currmonth) || (awarddatemonth == currmonth) )
                {
                    if ((awarddateday < currday) || (awarddateday == currday) )
                    {
                        alert('Contract Award Date should be greater than current date');
                        return false;
                    }
                }

            }


        }

        //Award date and Deadline
        if (($('#dtpawarddate').val().length > 1) && ($('#dtpdeadline').val().length > 1))
        {

            var deadline = new Date($('#dtpdeadline').val());

            var deadlineday = deadline.getDate();
            var deadlinemonth = deadline.getMonth();
            var deadlineyear = deadline.getYear();


            var awarddate = new Date($('#dtpawarddate').val());

            var awarddateday = awarddate.getDate();
            var awarddatemonth = awarddate.getMonth();
            var awarddateyear = awarddate.getYear();


            if ((awarddateyear < deadlineyear) || (awarddateyear == deadlineyear) )
            {
                if ((awarddatemonth < deadlinemonth) || (awarddatemonth == deadlinemonth) )
                {
                    if ((awarddateday < deadlineday) || (awarddateday == deadlineday) )
                    {
                        alert('Contract Award Date should be greater than Response Deadline Date');
                        return false;

                    }
                }

            }



        }

        //Email Validation
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test( $('#txtEmail').val() ) ) {
            alert('Please provide valid email address');
            $('#txtEmail').focus();
            return false;
        }




        //Zip code validation
        if ($('#txtZipcode').val().length > 0)
        {
            if ($('#txtZipcode').val().length == 5)
            {
                var zipcode = $('#txtZipcode').val();
                if  (!($.isNumeric(zipcode)))
                {
                    alert('Please provide valid numeric zip code');
                    return false;
                }
            }
            else
            {
                alert('Please provide valid zip code');
                return false;
            }
        }




        //Phone number validation

        if ($('#txtPhoneNumber').val().length > 0)
        {
           if ($('#txtPhoneNumber').val().length == 10)
           {
               var phonenum = $('#txtPhoneNumber').val();
               if  (!($.isNumeric(phonenum)))
               {
                   alert('Please provide valid numeric phone number');
                   return false;
               }
           }
           else if ($('#txtPhoneNumber').val().length < 10)
           {
               alert('Please provide phone number with area code');
               return false;
           }
           else
           {
               alert('Please provide valid phone number');
               return false;
           }
        }







       /* if ($('#rdbsection3yes').attr('checked') == null  && $('#rdbsection3no').attr('checked') == null)
        {
            alert('Please select an option for Section 3');
            $('#section3').focus();
            return false;
        }
        if ($('#rdbsection3yes').attr('checked') == 'checked' && $('#txtsection3yes').val().length < 1 )
        {
            alert('Please provide Section 3 details');
            $('#txtsection3yes').focus();
            return false;
        }

        else if ($('#rdbminorityyes').attr('checked') == 'checked' && $('#txtminorityyes').val().length < 1 )
        {
            alert('Please provide M/W/DBE details');
            $('#txtminorityyes').focus();
            return false;
        }

        else*/
        {
            $.post($(this).attr("action"), $(this).serialize(), function(data) {
                    $.colorbox({html:data});
                },
                'html');
            return false;

        }
    });




    function ShowTextbox(param)
    {
        var radioval = param.value;

        if (radioval == 'section3')
        {
            $('#txtsection3yes').show();
            $('#rdbsection3yes').attr('checked', 'checked');
            $('#rdbsection3no').removeAttr('checked');

        }
        else if (radioval == 'minoritywomen')
        {
            $('#txtminorityyes').show();
            $('#rdbminorityyes').attr('checked', 'checked');
            $('#rdbminorityno').removeAttr('checked');
        }
        else if (radioval == 'section3_no')
        {
            $('#txtsection3yes').hide();
            $('#rdbsection3yes').removeAttr('checked');
            $('#rdbsection3no').attr('checked', 'checked');
        }
        else if (radioval == 'minoritywomen_no')
        {
            $('#txtminorityyes').hide();
            $('#rdbminorityyes').removeAttr('checked');
            $('#rdbminorityno').attr('checked', 'checked');
        }
    }
</script>

