<!-- The following div is stored in full-time-employee-calculator.tpl.php -->
<div class="empcalculator-mastercontainer">

<style>
    #page-title {
        display: none;
    }
    .empcalculator-title {
        font-size: 25px;
        background-image: url('/sites/all/themes/bizusa/images/calc.png');
        background-repeat: no-repeat;
        padding-left: 35px;
    }
    .empcalculator-disclaimer {
        padding: 10px;
        background-color: #FFF9E1;
        line-height: 22px;
        margin: 26px 0px;
    }
    
    .empcalculator-input-ui-label.empcalculator-input-ui-label-1,
    .empcalculator-input-ui-input.empcalculator-input-ui-input-1,
    .empcalculator-input-ui-label.empcalculator-input-ui-label-2,
    .empcalculator-input-ui-input-2 {
        float: left;
		display: inline-block;
    }
    .empcalculator-input-ui-input-1 input,
    .empcalculator-input-ui-input-2 input {
        border: 0px;
        padding: 10px;
        color: gray;
        font-size: 15px;
        -moz-box-sizing: content-box;
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
    }
    .empcalculator-input-ui-label.empcalculator-input-ui-label-1,
    .empcalculator-input-ui-label.empcalculator-input-ui-label-2 {
        line-height: 15px;
        font-size: 15px;
        padding-bottom: 15px;
    }

    .empcalculator-controles-ui {
        text-align: right;
    }
    .empcalculator-controles-ui input {
        padding: 15px;
        min-width: 125px;
        font-weight: bold;
        cursor: pointer;
        border: 0px;
        cursor: pointer;
    }
    .empcalculator-controle-reset {
        background: none !important;
        background-color: #EBEBEB !important;
        color: black !important;
    }
    .empcalculator-controle-calc {
        background: none !important;
        background-color: #15567B !important;
        color: white !important;
    }
    .empcalculator-specialcountingrules-btncontainer {
        margin: 10px 0px;
    }

    .empcalculator-specialcountingrules-btn {
        background: none !important;
        border: 0px !important;
        text-align: left;
        padding: 0px !important;
        margin: 0px !important;
    }
    .empcalculator-results-ui-container {
        overflow: hidden;
        padding: 20px;
        margin-top: 30px;
        background-color: #EBEBEB;
    }
    .empcalculator-results-ui-1,
    .empcalculator-results-ui-2 {
        float: left;
        width: 50%;
    }
    .empcalculator-results-ui-1-leftside {
        overflow: hidden;
        float: left;
        line-height: 75px;
    }
    .empcalculator-results-ui-1-rightside {
        float: left;
    }
    .empcalculator-giantnumber {
        float: left;
        font-size: 75px;
        font-weight: bold;
        color: #15567B;
        padding-right: 20px;
    }
    .empcalculator-results-ui-2-toptext {
        font-weight: bold;
        padding-bottom: 10px;
    }
    .empcalculator-results-ui-1-rightside-inner {
        display: table-cell;
        height: 75px;
        vertical-align: middle;
    }
    .empcalculator-results-ui-1-toplefttext {
        font-weight: bold;
    }
    .empcalculator-results-ui-2-bottomtext,
    .empcalculator-results-ui-2-bottomtext a {
        color: #828282;
    }

    /* Tablet landscare */
    body.responsive-layout-normal .empcalculator-input-ui-label {
        padding-top: 0px;
        padding-bottom: 0px;
        height: 80px;
        padding-left: 85px;
    }
    /* Mobile layout */
    body.responsive-layout-mobile .empcalculator-input-ui-input1-ui,
    body.responsive-layout-mobile .empcalculator-input-ui-input2-ui {
        float: none;
        clear: both;
        width: 100%;
        padding: 10px 0px;
        overflow: hidden;
    }
    body.responsive-layout-mobile .empcalculator-input-ui-label.empcalculator-input-ui-label-1,
    body.responsive-layout-mobile .empcalculator-input-ui-input-1,
    body.responsive-layout-mobile .empcalculator-input-ui-label.empcalculator-input-ui-label-2,
    body.responsive-layout-mobile .empcalculator-input-ui-input-2 {
        float: none;
        clear: both;
        width: 100%;
    }
    body.responsive-layout-mobile .empcalculator-input-ui-input input {
        width: 100%;
    }
    body.responsive-layout-mobile .empcalculator-controles-ui input {
        width: 45%;
        margin: 0px;
    }
    body.responsive-layout-mobile .empcalculator-controle-reset {
        float: left;
    }
    body.responsive-layout-mobile .empcalculator-results-ui-1,
    body.responsive-layout-mobile .empcalculator-results-ui-2 {
        float: none;
        clear: both;
        width: 100%;
        padding: 15px 0px;
    }
    .empcalculator-disclaimer {
        padding-top: 20px;
    }
</style>

<div class="empcalculator-title">
    <p><b>Full-Time/Full-Time Equivalent Employee Calculator for Employer Shared Responsibility</b></p>
    <p><i>(Transition relief means these rules do not take effect until 2015)</i></p>
</div>

<div class="empcalculator-disclaimer">
    This calculator is provided for informational purposes only. The results are based on the information you entered and are not guaranteed. Do not rely on this calculator as an accurate measurement of your Employer Shared Responsibility. The calculator should only be used for guidance and educational purposes. While this calculator may be helpful, it is not intended to provide tax advice or replace advice given to you by a
    legal or tax professional. You should consult your legal or tax professional(s) to determine whether you are covered by the Employer Shared Responsibility requirements based on your own individual business circumstances.
</div>

<div class="empcalculator-input-ui">

    <div class="empcalculator-input-ui-input1-ui">
        <div class="empcalculator-input-ui-label empcalculator-input-ui-label-1">
            <p><b>Enter your total number of Full-Time Employees</b></p>
            <p><i>(Full-Time Employees are those that average 30 hours per week or 130 hours per month)</i></p>
        </div>
        <div class="empcalculator-input-ui-input empcalculator-input-ui-input-1">
            <input type="text" value="Number of Employees" maxlength="6" onkeypress="return isNumberKey(event)" />
        </div>
    </div>

    <div class="empcalculator-input-ui-input2-ui">
        <div class="empcalculator-input-ui-label empcalculator-input-ui-label-2">
            <p><b>Enter the total hours of service for all Non-Full-Time Employees in a month</b></p>
            <p><i>(Do not enter more than 120 hours of service for any one employee)</i></p>
        </div>
        <div class="empcalculator-input-ui-input empcalculator-input-ui-input-2">
            <input type="text" value="Total Hours" onkeypress="return isFloatKey(event)" />
        </div>
    </div>

</div>

<div class="empcalculator-controles-ui">
    <input type="button" class="empcalculator-controle-reset" value="Reset" />
    <input type="button" class="empcalculator-controle-calc" value="Calculate" />
</div>

<div class="empcalculator-specialcountingrules-btncontainer">
    <input type="button" class="empcalculator-specialcountingrules-btn" value="Special Counting Rules" onclick="jQuery.colorbox( { html: jQuery('.empcalculator-specialcountingrules-colorboxcontents-mastercontainer').html() } )" />
    <img alt="" src="/sites/all/themes/bizusa/images/question-mark-in-circle.png" onclick="jQuery.colorbox( { html: jQuery('.empcalculator-specialcountingrules-colorboxcontents-mastercontainer').html() } )" />
</div>

<div class="empcalculator-specialcountingrules-colorboxcontents-mastercontainer" style="display: none">
    <div class="empcalculator-specialcountingrules-colorboxcontents-container">
        <!-- The contents of this div is stored in full-time-employee-calculator.tpl.php /* Coder Bookmark: CB-U2FCY4O-BC */ -->
        <b>Aggregation Rules</b><br/>
        <br/>
        It’s important to know that certain affiliated employers with common ownership or that are part of a controlled group under IRS tax rules will need to add together their total number of employees to determine whether they meet the threshold of 50 or more full-time or full-time equivalent employees and are therefore subject to Employer Shared Responsibility. <br/>
        <br/>
        <b>Seasonal Worker Exception</b><br/>
        <br/>
        If your workforce equals or exceeds 50 full-time or full-time equivalent employees (counting your seasonal workers) for no more than four calendar months (treated as the equivalent of 120 days) in a calendar year, and the number of full-time/full-time equivalent employees would be less than 50 during those months if seasonal workers were disregarded, then you are exempt from the Employer Shared Responsibility rules. <br/>
    </div>
</div>

<div class="empcalculator-results-ui-container" style="display: none;">
    <div class="empcalculator-results-ui-1">
        <div class="empcalculator-results-ui-1-leftside">
            <div class="empcalculator-giantnumber">
                99
            </div>
        </div>
        <div class="empcalculator-results-ui-1-rightside">
            <div class="empcalculator-results-ui-1-rightside-inner">
                <div class="empcalculator-results-ui-1-toplefttext">
                    Number of Full-Time/Full-Time Equivalent Employees
                </div>
                <div class="empcalculator-results-ui-1-bottomrighttext">
                    *Formula: (formula goes here)
                </div>
            </div>
        </div>
    </div>
    <div class="empcalculator-results-ui-2">
        <div class="empcalculator-results-ui-2-toptext">
            You are subject to Employer Shared Responsibility if you average 50 or more Full-Time/Full-Time Equivalent employees per month for the prior calendar year. However, for 2015 only, there is transition relief for businesses with 50 to 99 Full-Time/Full-Time Equivalent employees: Businesses of this size are not subject to the Employer Shared Responsibility rules in 2015 provided they can meet certain certification requirements, including that they did not reduce their number of employees or employees’ hours in order to qualify for the transition relief.  For more information on these requirements and the transitional relief, visit <a href="http://www.irs.gov/uac/Newsroom/Questions-and-Answers-on-Employer-Shared-Responsibility-Provisions-Under-the-Affordable-Care-Act" target="_blank">IRS.gov/aca</a> .
        </div>
        <div class="empcalculator-results-ui-2-bottomtext">
            <a style="text-decoration: underline;" href="#" onclick="javascript: window.open('https://business.usa.gov/sites/default/files/CalculatingFTEsforBusinessUSA.pdf');">For more details on how to calculate your number of Full-Time/Full-Time Equivalent employees for the Employer Shared Responsibility rules, refer to this document.</a>
        </div>
    </div>

</div>


<script>
    jQuery(document).ready( function () {

        jQuery('.empcalculator-input-ui-input-1 input, .empcalculator-input-ui-input-2 input').bind('focus', function () {
            var jqThis = jQuery(this);
            if ( jQuery.trim(jqThis.val()) == 'Number of Employees' || jQuery.trim(jqThis.val()) == 'Total Hours' ) { /* Coder Bookmark: CB-CLC1DNY-BC */
                jqThis.val('');
                jqThis.css('color', 'black');
            }
        });

        jQuery('.empcalculator-input-ui-input-1 input').bind('blur', function () { /* Coder Bookmark: CB-4GIXSBW-BC */
            var jqThis = jQuery(this);
            if ( jQuery.trim(jqThis.val()) == '') {
                jqThis.val('Number of Employees');
                jqThis.css('color', 'gray');
            }
        });
        jQuery('.empcalculator-input-ui-input-2 input').bind('blur', function () { /* Coder Bookmark: CB-YOUNT1F-BC */
            var jqThis = jQuery(this);
            if ( jQuery.trim(jqThis.val()) == '') {
                jqThis.val('Total Hours');
                jqThis.css('color', 'gray');
            }
        });

        // Event handler for when the user clicks the "Reset" button in the "Full-Time Equivalent Employee Calculator"
        jQuery('.empcalculator-controle-reset').bind('click', function () { /* Coder Bookmark: CB-HVHFV4C-BC */
            jQuery('.empcalculator-input-ui-input-1 input').val('Number of Employees');
            jQuery('.empcalculator-input-ui-input-1 input').css('color', 'gray');
            jQuery('.empcalculator-input-ui-input-2 input').val('Total Hours');
            jQuery('.empcalculator-input-ui-input-2 input').css('color', 'gray');
            jQuery('.empcalculator-results-ui-container').hide();
        });

        // Event handler for when the user clicks the "Calculate" button in the "Full-Time Equivalent Employee Calculator"
        jQuery('.empcalculator-controle-calc').bind('click', function () { /* Coder Bookmark: CB-9PCZBOO-BC */

            // Do the calculation, the formula is R = ( B / 120 ) + A
            var totalNumberOfFullTimeEmps = parseInt( jQuery('.empcalculator-input-ui-input-1 input').val() );
            var totalHoursOfService = parseInt( jQuery('.empcalculator-input-ui-input-2 input').val() );
            var calcResult = Math.floor( (totalHoursOfService/120) + totalNumberOfFullTimeEmps );

            if ( isNaN(totalNumberOfFullTimeEmps) || isNaN(totalHoursOfService) ) {
                alert('Please fill in a number for the required field(s) in this form.');
                return;
            }

            // Display the result
            jQuery('.empcalculator-giantnumber').html(calcResult);
            var formulaToShow = '';
            formulaToShow += '*Formula: <br/>';
            formulaToShow += ' = Full-Time Employees + ( Total hours of service / 120)<br/>';
            formulaToShow += ' = ' +  totalNumberOfFullTimeEmps + ' + ( ' + totalHoursOfService + ' / 120 )' + '<br/>';
            formulaToShow += ' = ' + Math.floor(totalNumberOfFullTimeEmps + ( totalHoursOfService / 120 )) + '<br/>';

            jQuery('.empcalculator-results-ui-1-bottomrighttext').html(formulaToShow);
            jQuery('.empcalculator-results-ui-container').hide();
            jQuery('.empcalculator-results-ui-container').fadeIn();
        });

        // Event handler for when the user hits the Enter button in either of the two input-boxes, trigger the click event form the "calculate button"
        jQuery('.empcalculator-input-ui-input-1, .empcalculator-input-ui-input-2').bind('keydown', function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if ( code == 13 ) {
                jQuery('.empcalculator-controle-calc').click();
            }
        });

    });

    function isNumberKey(evt) { /* Coder Bookmark: CB-SFY9YHG-BC */
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function isFloatKey(event) { /* Coder Bookmark: CB-CRQ7O6E-BC */
        var data = jQuery('.empcalculator-input-ui-input-2 input').val();
        if(data.indexOf('.') !== -1 && event.keyCode == 46)
            return false;
        if (event.keyCode > 31 && (event.keyCode < 48 || event.keyCode > 57)){
            if(event.keyCode === 46) return true;
            return false;
        }
        return true;
    }
</script>
</div>