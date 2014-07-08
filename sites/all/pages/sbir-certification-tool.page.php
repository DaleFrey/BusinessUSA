<!DOCTYPE html>

<html>
    <head>
        <title>SBIR Certification Tool</title>
		<style>
			.input_hidden {
				position: absolute;
				left: -9999px;
			}

			#employees label, #ownership label, #organized label, #location label {
				display: inline-block;
				cursor: pointer;
				padding-right: 10px;
			}
      .hidden {
        display: none;
      }

		</style>
    </head>
    <body>
        <div class="sbir-certification-tool-mastercontainer">
            <div class="sbir-certification-tool-headercontainer">
                <div class="sbir-certification-tool-welcomemessage">
                    Welcome to the SBIR Eligibility Wizard.  With a few questions, we will be able to help determine your tentative eligibility for apply for awards from the SBIR program.  Learn more about the program at <a href="http://sbir.gov/about/about-sbir">SBIR.gov</a>.  Please answer the following questions to the best of your ability to get started.
                </div>
            </div>
            <div class="sbir-certification-tool-contentcontainer">
				<div class="roweven row-typeoffirm rowselected">
					<div class="cell1">
						Type of Firm
						<img id="downarrow-typeoffirm" class="downarrow" src="/sites/all/themes/bizusa/images/sbir-images/downarrow.png" alt="" />
					</div>
					<div class="cell2">

						Is your business organized as a for-profit company?<br/>
						<div id="organized">
							<input type="radio" name="profit" id="organized-yes" class="input_hidden" value="yes" />
							<label for="organized-yes"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="yes" />Yes</label>
							<input type="radio" name="profit" id="organized-no" class="input_hidden" value="no" />
							<label for="organized-no"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="no" />No</label>
						</div>
                        <input type="hidden" id="profit" value=""/>
						<br/><br/>

						Is your principal place of business located in the United States?<br/>
						<div id="location">
							<input type="radio" name="location" id="location-yes" class="input_hidden" value="yes" />
							<label for="location-yes"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="yes" />Yes</label>
							<input type="radio" name="location" id="location-no" class="input_hidden" value="no" />
							<label for="location-no"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="no" />No</label>
						</div>
                        <input type="hidden" id="location" value=""/>
					</div>
					<div class="cell3">
						<div id="profit-holder">
                        <label id="lblprofit">Not yet answered</label>
						<img class="image_ok hidden" id="profit_pass" src="/sites/all/themes/bizusa/images/sbir-images/ok.png" alt=""/>
						<img class="image_notok hidden" id="profit_fail" src="/sites/all/themes/bizusa/images/sbir-images/notok.png" alt="" />

						<div id="div_profit" class="hidden" >
							<a style="cursor: pointer;" title="Click here to learn more">[why?]</a>
						</div>
						</div>
						
						<div id="location-holder">
                        <label id="lbllocation">Not yet answered</label>
						<img class="image_ok hidden" id="location_pass" src="/sites/all/themes/bizusa/images/sbir-images/ok.png" alt="" />
						<img class="image_notok hidden" id="location_fail" src="/sites/all/themes/bizusa/images/sbir-images/notok.png" alt="" />

						<div id="div_location" class="hidden" >
							<a style="cursor: pointer;" title="Click here to learn more">[why?]</a>
						</div>
						</div>
					</div>
				</div>
				<div class="rowodd row-ownershipandcontrol">
					<div class="cell1">
						Ownership and Control
						<img id="downarrow-ownershipcontrol" class="downarrow" src="/sites/all/themes/bizusa/images/sbir-images/downarrow.png" alt="" />
					</div>
					<div class="cell2">
						Is the majority (more than 50%) of your firms' equity (e.g. stock) is directly owned and controlled by one of the following?<br/><br/>

						<div id="ownership">
						<input type="radio" name="ownership" id="ownership-citizen" class="input_hidden" value="yes" />
							<label for="ownership-citizen"><img  class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="yes" />One or more individuals who are citizens or permanent resident alien of the U.S.</label>

						<input type="radio" name="ownership" id="ownership-other" class="input_hidden" value="yes"/>
							<label for="ownership-other"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="yes" />Other for-profit small business concerns (each of which is directly owned and controlled individuals who are citizens or permanent resident alien of the U.S.)</label>
						<input type="radio" name="ownership" id="ownership-combination" class="input_hidden" value="yes"/>
							<label for="ownership-combination"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="yes" />A combination of (1) and (2).</label>
						<input type="radio" name="ownership" id="ownership-multiple" class="input_hidden" value="yes_multiple"/>
							<label for="ownership-multiple"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="yes" />Multiple venture capital operating companies, hedge funds, private equity firms, or any combination of these, so long as no one such firm owns or controls more than 50% of the equity.</label>
						<input type="radio" name="ownership" id="ownership-none" class="input_hidden" value="no"/>
							<label for="ownership-none"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="no" />None of the above.</label>
					</div>
						<input type="hidden" id="ownership" value=""/>
					</div>
					<div class="cell3">
                        <label id="lblownership">Not yet answered</label>
						<img class="image_ok hidden" id="ownership_pass" src="/sites/all/themes/bizusa/images/sbir-images/ok.png" alt="" />
						<img class="image_ok hidden" id="ownership_exclaim" src="/sites/all/themes/bizusa/images/sbir-images/exclaim.png" alt="" />
						<img  class="image_notok hidden" id="ownership_fail" src="/sites/all/themes/bizusa/images/sbir-images/notok.png" alt="" />
						<div id="div_ownership" class="hidden">
							<a style="cursor: pointer;" title="Click here to learn more">[why?]</a>
						</div>
					</div>
				</div>
				<div class="roweven row-size">
                <div class="cell1">
                    Size
					<img id="downarrow-size" class="downarrow" src="/sites/all/themes/bizusa/images/sbir-images/downarrow.png" alt="" />
                </div>
                <div class="cell2">
                    Does your business have less than 500 employees?<br/>
					<!--<span class="options"><input type="image" name="employee" class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="Yes">Yes</span>
					<span class="options"><input type="image" name="employee" class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="No">No</span>-->
                    <input type="hidden" id="employee" value=""/>

					<div id="employees">
						<input type="radio" name="employee" id="employees-yes" class="input_hidden" value="yes"/>
							<label for="employees-yes"><img  class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="Yes" />Yes</label>

						<input type="radio" name="employee" id="employees-no" class="input_hidden" value="no"/>
							<label for="employees-no"><img class="radiobutton" src="/sites/all/themes/bizusa/images/sbir-images/radiobutton.png" alt="No" />No</label>
					</div>

                </div>
                <div class="cell3">
                    <label id="lblemployee">Not yet answered</label>
                    <img  class="image_ok hidden" id="employee_pass" src="/sites/all/themes/bizusa/images/sbir-images/ok.png" alt="" />
                    <img  class="image_notok hidden" id="employee_fail" src="/sites/all/themes/bizusa/images/sbir-images/notok.png" alt="" />
                    <div id="div_employee" class="hidden">
                        <a style="cursor: pointer;" title="Click here to learn more">[why?]</a>
                    </div>
                </div>
            </div>
			</div>
		</div>

        <div id="eligibility-message" class="hidden">
            <div id="success_message">
                <img src="/sites/all/themes/bizusa/images/sbir-images/greencheck.png" alt=""/>
                <p>
                    Congratulations! It seems that you are tentatively eligible to submit proposals for the SBIR program. Explore currently open SBIR opportunities that you may be interested in at <a href="http://sbir.gov/solicitations" target="_blank">SBIR.gov</a>.
                </p>
                <div class="btn-Continue"><a href="http://sbir.gov/solicitations" target="_blank">Continue to SBIR.Gov</a></div>
            </div>

            <div id="fail_message">
				<img src="/sites/all/themes/bizusa/images/sbir-images/redX.png" alt=""/>
                <p>
                    We are sorry, but it does not seem that you are eligible to submit proposals for the SBIR program.  There are other resources that you may be interested in our <a href="/access-financing" target="_blank">Access Financing Wizard</a>.
                </p>
                <div class="btn-Continue"><a href="/access-financing" target="_blank">Continue to Access Financing Wizard</a></div>
            </div>
        </div>

        <script>
            $(document).ready(function(){

				$('#employees label').click(function(){
					$(this).children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton-selected.png');
					$(this).siblings().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton.png');
				});
				$('#ownership label').click(function(){
					$(this).children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton-selected.png');
					$(this).siblings().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton.png');
				});
				$('#organized label').click(function(){
					$(this).children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton-selected.png');
					$(this).siblings().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton.png');
				});
				$('#location label').click(function(){
					$(this).children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton-selected.png');
					$(this).siblings().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton.png');
				});

                bindToggleEvent();

                $('input[type="radio"]').change(function() {
                    if($(this).is(":checked")) {

                        var inputName = $(this).attr("name");
                        var value = $(this).val();
                        var isEligible = false;
                        var hdnField = $('input[type="hidden"]' +'#' + inputName);
                        if (hdnField != null){
                            hdnField.val(value);
                        }

                        var passImage = $('#' + inputName + '_pass');
                        var failImage = $('#' + inputName + '_fail');
                        var answerLabel = $('#lbl' + inputName);
                      consoleLog('#' + inputName + '_exclaim');
						var exclaimImage = $('#' + inputName + '_exclaim');
                      consoleLog(exclaimImage);

                        answerLabel.hide();
                        if (value == 'yes' || value == 'yes_multiple'){
                            isEligible = true;
							$(this).siblings().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton.png');
							$(this).next().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton-selected.png');
                        }
                        else{
                            isEligible = false;
                        }
                        if ((value == 'yes') && !passImage.is(":visible")){
							exclaimImage.hide();
                            passImage.show();
                            failImage.hide();
                        }
						else if ((value == 'yes_multiple')){
                            exclaimImage.show();
							passImage.hide();
                            failImage.hide();
                        }
                        else if (value == 'no' && !failImage.is(":visible") ){
                            exclaimImage.hide();
                            failImage.show();
                            passImage.hide();
							$(this).siblings().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton.png');
							$(this).next().children().attr('src', '/sites/all/themes/bizusa/images/sbir-images/radiobutton-selected.png');
                        }

                        if (value == 'no' || value == 'yes_multiple'){
                            $('#div_' + inputName).show();
                            $('#div_' + inputName + ' a').bind('click', function(){
                                tooltipBox(inputName, isEligible, value);
                            });
                        }
                        else{
                            $('#div_' + inputName).hide();
                        };
                    };

                    var allQuestionsAnswered = CheckAllQuestions();

                    if (allQuestionsAnswered){
                        var eligible = CheckEligibility();
                        $('div#eligibility-message').show();
                        if (!eligible){
                            $('#fail_message').show();
                            $('#success_message').hide();
                        }
                        else{
                            $('#success_message').show();
                            $('#fail_message').hide();
                        }
                    }
                    else{
                        $('div#eligibility-message').hide();
                    }
                });
            });



            function CheckEligibility(){
                var returnBuffer = true;
                $('div.sbir-certification-tool-contentcontainer input[type="hidden"]').each(function(){
                    if ($(this).val() == 'no'){
                        returnBuffer = false;
                    }
                });
                return returnBuffer;
            }

            function CheckAllQuestions(){
                var returnBuffer = true;
                $('div.sbir-certification-tool-contentcontainer input[type="hidden"]').each(function(){
                    if ($(this).val() == ''){
                        returnBuffer = false;
                    }
                });
                return returnBuffer;
            }

            function tooltipBox(question, isEligible, value){
                // Send the data using post
                var postData = {};
                if (value == 'yes_multiple'){
                    postData[question] = value;
                }
                else{
                    postData[question] = isEligible;
                }
                jQuery.colorbox({
                    href: '/sites/all/pages/sbir-certification-tool-message.page.php',
                    data: postData
                })
                return false;
            }

            function bindToggleEvent(){
                if ($('.downarrow').length > 0){
                    $('.downarrow').each(function(){
                        if ($( document ).width() <= 767 ){
                            var parentObj = $(this).parent().parent();
                            var headerRow = parentObj.find('.cell1');
                            var secondRow = parentObj.find('.cell2');
                            var thirdRow = parentObj.find('.cell3');
                            headerRow.click(function(){
                                secondRow.toggle();
                                thirdRow.toggle();
                            });
                        }
                    });
                }
            }
        </script>
    </body>
</html>
