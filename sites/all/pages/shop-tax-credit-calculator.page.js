(function($) {
  Drupal.stcWorksheetHelpers = {};

  /**
   * Helpers for checking numeric values on textfields
   */
  Drupal.stcWorksheetHelpers.checkNumeric = function(event) {
    var inputVal = $(this).val();
consoleLog($(this));
    consoleLog(inputVal);
    if (inputVal.length == 0 || (Math.floor(inputVal) == inputVal && $.isNumeric(inputVal) && inputVal >= 0)) {
      // Clear error
      $(this).parent().removeClass('error');
      $(document).trigger('validate-' + $(this).attr('id'), this);
    }
    else {
      // Add error
      $(this).parent().addClass('error');
    }
  };

  /**
   * Helpers for adding up values on parttime hours.
   */
  Drupal.stcWorksheetHelpers.tallyParttimeHours = function(event) {
    var totalHours = 0;
    $(".parttime-employee-row .employee-hours").each(function(index, employeeHours) {
      var hours= $(employeeHours).val() ;
      var hoursValue = parseInt(hours);
      if ($.isNumeric(hours) && hoursValue >= 0) {
        totalHours =  Number(totalHours) +  Number(hours);
      }
    });
    $('#total-employee-hours').val(totalHours);
  };

  /**
   * Helpers for validating range of parttime hours.
   */
  Drupal.stcWorksheetHelpers.validateParttimeEmployeeHoursAll = function(event) {
    $('.worksheet-form .parttime-employee-row input.employee-hours').change();
  };

  /**
   * Helpers for validating range of parttime hours.
   */
  Drupal.stcWorksheetHelpers.validateParttimeEmployeeHours = function(event) {
    var hours= $(this).val() ;
    var hoursValue = parseInt(hours);
    if ($.isNumeric(hours) && hoursValue > 0) {
      $(this).parent().removeClass('over-weekly over-monthly over-yearly');

      switch($('input[name="hour-entering-method"]:checked').val()) {
        case 'weekly':
          $(this).parent().parent().toggleClass('over-weekly', (hoursValue > 40));
          break;
        case 'monthly':
          $(this).parent().parent().toggleClass('over-monthly', (hoursValue > 160));
          break;
        case 'yearly':
          $(this).parent().parent().toggleClass('over-yearly', (hoursValue > 2080));
          break;
      }
    }

    Drupal.stcWorksheetHelpers.tallyParttimeHours();
  };

  /**
   * Helpers for validating range of parttime hours.
   */
  Drupal.stcWorksheetHelpers.calculateFTE = function(fteEntered, pteHoursEntered) {
    var hourEnteringMethodMultiplier = 1;
    switch($('input[name="hour-entering-method"]:checked').val()) {
      case 'weekly':
        hourEnteringMethodMultiplier = 52;
        break;
      case 'monthly':
        hourEnteringMethodMultiplier = 12;
        break;
      case 'yearly':
        hourEnteringMethodMultiplier = 1;
        break;
    }
    var pteHoursCalculated = pteHoursEntered * hourEnteringMethodMultiplier;
    var fteCalculated = Number(fteEntered) + parseInt(pteHoursCalculated / 2080);

    // Default to 1 if 0.
    if (fteCalculated ==  0) {
      fteCalculated = 1;
    }
    return fteCalculated;
  };

  /**
   * Helpers for calculating average wages.
   */
  Drupal.stcWorksheetHelpers.calculateAverageWages = function(wagesPaid, fteCalculated) {
    var calculatedAverageWageNumerator = parseInt(Number(wagesPaid) / (1000 * Number(fteCalculated)));
    var  calculatedAverageWage = calculatedAverageWageNumerator * 1000;
    consoleLog("Wages Paid: " + wagesPaid + " fteCalculated: " + fteCalculated );
    consoleLog("Calculated Wage: " + calculatedAverageWageNumerator + " x 1000 = " + calculatedAverageWage );
    return calculatedAverageWage;
  };

  /**
   * Format dollars.
   */
  Drupal.stcWorksheetHelpers.formatDollars = function(value) {
    return parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
  };

  /**
   * Helpers for validating employee premiums paid
   */
  Drupal.stcWorksheetHelpers.validateOverhalfPremiums = function(event) {
    switch($('input[name="over-half-premiums-covered"]:checked').val()) {
      case '0':
        $().colorbox({
          width:"600px",
          inline:true,
          href: $('#stc-overhalf-error'),
          onCleanup: function() {
            $('#cboxLoadedContent').children().appendTo('#worksheet-forms');
          }
        });
        break;
    }
  };

  /**
   * Helpers for validating range of parttime hours.
   */
  Drupal.stcWorksheetHelpers.toggleExemptPayroll = function(event) {
    $('.tax-exempt-payroll-taxes-wrapper').toggle(Boolean(parseInt($(this).val())));
  };

  /**
   * Helpers for calculating allowed deductions
   */
  Drupal.stcWorksheetHelpers.calculateTotalDeductionsAllowed = function (taxExempt, fullTimeCalculated, calculatedAverageWage, totalPayrollTaxesPaid, premiumsPaidByEmployer) {
    var maxAllowedPercent = (taxExempt) ? 0.35 : 0.50;
    var maxAllowedDeduction = (maxAllowedPercent) * Number(premiumsPaidByEmployer);
    var calculatedDeduction = totalPayrollTaxesPaid;
    var fullTimeEmployeeDeductions = 0;
    var averageWageDeductions = 0;

    consoleLog("MaxAllowed: " + maxAllowedDeduction + " = allowedPercent::" + maxAllowedPercent + " x premiumsPaid::" + premiumsPaidByEmployer);
    if ((fullTimeCalculated > 24 )) return -1;

    // Calculate FTE Phaseout
    if (fullTimeCalculated > 10) {
      var ftdDividendNumerator  = 1000 * ((fullTimeCalculated - 10)/15);
      ftdDividendNumerator = Math.round(ftdDividendNumerator);
      ftdDividendComponent = ftdDividendNumerator / 1000;
      fullTimeEmployeeDeductions = ftdDividendComponent * maxAllowedDeduction;
      consoleLog("FTE Phaseout");
      consoleLog("FTE Dividend Numerator:: " + ftdDividendNumerator);
      consoleLog("FTE Dividend :: " + ftdDividendComponent);
      consoleLog("FTE Phaseout :: " + fullTimeEmployeeDeductions);
    }

    // Calculate Wage Phaseout
    if (calculatedAverageWage > 25000) {
      var awdDividendNumerator = (((calculatedAverageWage - 25000)/25000) * 1000);
      awdDividendNumerator = Math.round(awdDividendNumerator);

      var awdDividendComponent = awdDividendNumerator / 1000;
      var averageWageDeductionsW1 = awdDividendComponent * maxAllowedDeduction;

      // Calculate w2
      var awdW2Descriminator = maxAllowedDeduction - fullTimeEmployeeDeductions;
      var averageWageDeductionsW2 = averageWageDeductionsW1;
      consoleLog("W1 Dividend Numerator:: " + awdDividendNumerator);
      consoleLog("W1 Deduction:: " + averageWageDeductionsW1);
      consoleLog("W2 Descriminator: " + awdW2Descriminator);

      if (averageWageDeductionsW1 > awdW2Descriminator) {
        averageWageDeductionsW2 = awdW2Descriminator;
      }
      consoleLog("W2 Deduction: " + averageWageDeductionsW2);

      averageWageDeductions = averageWageDeductionsW2;
    }

    // Calculate Credit after Phaseout.
    var creditAfterPhaseout = maxAllowedDeduction - fullTimeEmployeeDeductions - averageWageDeductions;

    consoleLog("fteDed::" + fullTimeEmployeeDeductions);
    consoleLog("wageDed::" + averageWageDeductions);
    consoleLog("maxDed::" + maxAllowedDeduction);
    consoleLog("calculatedDed::" + calculatedDeduction);
    consoleLog("creditAfterPhaseout::" + creditAfterPhaseout);

    var taxExemptPayroll = totalPayrollTaxesPaid;
    consoleLog("taxExemptPayroll:: " + taxExemptPayroll);
    if (taxExempt) {
      consoleLog("Tax Exempt Calculation");
      var taxExemptCalculationNumerator = creditAfterPhaseout;
      if (taxExemptPayroll < creditAfterPhaseout) {
        taxExemptCalculationNumerator = taxExemptPayroll;
      }

      calculatedDeduction = Math.round(taxExemptCalculationNumerator/10) * 10;
      consoleLog("taxExemptNumerator:: " + taxExemptCalculationNumerator);

    }
    else {
      consoleLog("Not Tax Exempt Calculation");
      calculatedDeduction = Math.round(creditAfterPhaseout/10) * 10;
      consoleLog("NonTaxExemptNumerator:: " + creditAfterPhaseout);
    }

    return calculatedDeduction;
  };

  /**
   * Helpers for opening and closing worksheet modals.
   */
  Drupal.behaviors.stcWorksheetToggle = {
    attach: function (context, settings) {
      $('.ajax-worksheet').once().click(function(event){
        event.preventDefault();

        var target_worksheet_href = $(this).attr('href');
        var target_worksheet = target_worksheet_href.substring(target_worksheet_href.indexOf('#'));
        $().colorbox({
          width:"600px",
          inline:true,
          href: $(target_worksheet),
          onCleanup: function() {
            $('#cboxLoadedContent').children().appendTo('#worksheet-forms');
          }
        });
      });
    }
  };

  /**
   * Attaches Textfield Change actions calculator forms.
   */
  Drupal.behaviors.stcTextfieldValidators = {
    attach: function (context, settings) {
      $('.stc-calculator-mastercontainer input[type="text"]').once('validate-keyup').keyup(Drupal.stcWorksheetHelpers.checkNumeric);;
      $('.worksheet-form input[type="text"]').not('.employee-name').once('validate-keyup').keyup(Drupal.stcWorksheetHelpers.checkNumeric);
      $('.worksheet-form input.employee-hours').once('validate-employee-hours-change').change(Drupal.stcWorksheetHelpers.validateParttimeEmployeeHours);
      $(".worksheet-form input[name='hour-entering-method']:radio").once('hour-entering-method').change(Drupal.stcWorksheetHelpers.validateParttimeEmployeeHoursAll);
      $("input[name='over-half-premiums-covered']:radio").once('over-half-premiums-covered').change(Drupal.stcWorksheetHelpers.validateOverhalfPremiums);
      $("input[name='tax-exempt-status']:radio").once('tax-exempt-status').change(Drupal.stcWorksheetHelpers.toggleExemptPayroll);
    }
  }

  /**
   * Helpers for connecting buttons clicked on any of these forms.
   */
  Drupal.behaviors.stcActionHandlers = {
    attach: function (context, settings) {
      $('.stc-calculator-mastercontainer input[type="submit"], .worksheet-form input[type="submit"]').once('submit-action').click(function (event) {
        event.preventDefault();
        var buttonId = $(this).attr('id');
        $(document).trigger(buttonId, this);
      });
    }
  };

  /**
   * Attach behaviors to the forms when colorbox loads.
   */
  $(document).bind('cbox_complete', function(){
    Drupal.attachBehaviors();
  });

  /**
   * Attach handlers to triggers for actions
   */
  $(document)
    .bind('edit-show-results', function(event, eventButton) {
      // Validate entire form
      var formIsValid = true;

      // Validate mandatory fields.
      $('input[name="premiums-paid-by-employer"]').keyup();

      formIsValid = ($('#stc-calculator-form .error').length == 0);
      if (formIsValid) {
        // Process form
        var taxExempt = ($('input[name="tax-exempt-status"]:checked').val() == 1);
        var requiredPremiumsPaid = ($('input[name="over-half-premiums-covered"]:checked').val() == 1);
        $('#result-tax-exempt').html((taxExempt) ? 'Tax Exempt' : 'Not Tax Exempt' );


        var hoursMethod = $(".worksheet-form input[name='hour-entering-method']:checked").val();
        $('#result-pte-hours-method').html(hoursMethod);

        /* Calculate Full Time Employees */
        var pteHoursEntered = parseInt($('input[name="pte-hours-total"]').val() || '0');
        var fullTimeEntered = parseInt($('input[name="fte-total"]').val() || '0');
        var fullTimeCalculated = Drupal.stcWorksheetHelpers.calculateFTE(fullTimeEntered, pteHoursEntered);
        $('#result-fte-number').html(fullTimeEntered);
        $('#result-pte-hours').html(pteHoursEntered);
        $('#result-fte-total').html(fullTimeCalculated);
        var totalWagesPaid = $('input[name="wages-paid"]').val() || 0;
        var totalPayrollTaxesPaid = $('input[name="tax-exempt-payroll-taxes"]').val() || 0;
        var calculatedAverageWage = Number(Drupal.stcWorksheetHelpers.calculateAverageWages($('input[name="wages-paid"]').val() || 0, fullTimeCalculated));
        var premiumsPaidByEmployer = $('input[name="premiums-paid-by-employer"]').val();
        $('#result-total-wages-paid .dollar-value').html(Drupal.stcWorksheetHelpers.formatDollars(totalWagesPaid));
        $('#result-average-wage .dollar-value').html(Drupal.stcWorksheetHelpers.formatDollars(calculatedAverageWage));
        $('#total-premiums-paid .dollar-value').html(Drupal.stcWorksheetHelpers.formatDollars(premiumsPaidByEmployer));

        var totalDeductionAllowed =  Drupal.stcWorksheetHelpers.calculateTotalDeductionsAllowed(taxExempt, fullTimeCalculated, calculatedAverageWage, totalPayrollTaxesPaid, premiumsPaidByEmployer);
        $(".deduction-result").hide();
        if (calculatedAverageWage >= 50000) {
          $(".deduction-result.denied-wages").show();
        }
        else if (Number(totalDeductionAllowed) < 0) {
          $(".deduction-result.denied-denied").show();
        }
        else if (Number(totalPayrollTaxesPaid) == 0 && taxExempt) {
          $(".deduction-result.denied-withholding").show();
        }
        else if (!requiredPremiumsPaid) {
          $(".deduction-result.denied-insufficient-premiums").show();
        }
        else {
          $(".deduction-result.approved .dollar-value").html(Drupal.stcWorksheetHelpers.formatDollars(totalDeductionAllowed));
          $(".deduction-result.approved").show();
        }

        // Show results.
        $('.pre-submit-form').toggle();
        $('.post-submit-form').toggle();
      }
    })
    .bind('edit-reset-form', function(event, eventButton) {
      // Show reset form
      $().colorbox({
        width:"600px",
        inline:true,
        href: $('#stc-parttime-worksheet-reset-form'),
        onCleanup: function() {
          $('#cboxLoadedContent').children().appendTo('#worksheet-forms');
        }
      });
    })
    .bind('edit-update-answers', function(event, eventButton) {
      $(".deduction-result").hide();
      // Show form again.
      $('.pre-submit-form').toggle();
      $('.post-submit-form').toggle();
    })
    .bind('edit-apply-for-healthcare', function(event, eventButton) {
      Drupal.attachBehaviors();
    })
    .bind('edit-complete-payroll-worksheet', function(event, eventButton) {
      var fedIncomeTax = parseInt($('#edit-federal-tax-withholding').val());
      var medicareTaxWithholding = parseInt($('#edit-medicare-tax-withholding').val());
      var medicareTaxPaid = parseInt($('#edit-medicare-taxes-paid').val());
      var payrollTaxesTotal = Number(fedIncomeTax) + Number(medicareTaxWithholding) + Number(medicareTaxPaid);

      $('#edit-tax-exempt-payroll-taxes').val(payrollTaxesTotal);
      $.colorbox.close();
    })
    .bind('edit-updated-parttime-employees-rows', function(event, eventButton) {
      var currentRows = $('.parttime-employee-row').length;
      var updateRowCount = $('#edit-parttime-employees').val() ;
      var updateRowCountValue = parseInt(updateRowCount);
      if ($.isNumeric(updateRowCount) && parseInt(updateRowCount) > 0 && updateRowCountValue != currentRows) {
        var rowCountChange = Math.abs(currentRows - updateRowCountValue);
        var addRows = (currentRows < updateRowCountValue);

        while (rowCountChange--) {
          if (addRows) {
            $(document).trigger('add-parttime-employees-row');
          }
          else {
            $(document).trigger('remove-parttime-employees-row', $('.parttime-employee-row').last().find('input[type="submit"]')[0]);
          }
        }

      }
    })
    .bind('remove-parttime-employees-row', function(event, eventButton) {
      if ($('.parttime-employee-row').length > 1) {
        $(eventButton).closest('.parttime-employee-row').remove();
      }

      // Recalculate Part time hours.
      Drupal.stcWorksheetHelpers.tallyParttimeHours();
    })
    .bind('add-parttime-employees-row', function(event, eventButton) {
      // Add the new row.
      var clonedRow = $('.parttime-employee-row-default')
        .first()
        .clone()
        .toggle()
        .addClass('parttime-employee-row')
        .removeClass('parttime-employee-row-default')
        .insertBefore('.parttime-employee-row-total');
      clonedRow.find('input[type="submit"]').removeClass('submit-action-processed');
      clonedRow.find('input[type="text"]').removeClass('validate-employee-hours-change-processed');

      // Attach button to action.
      Drupal.attachBehaviors();
    })
    .bind('edit-complete-parttime-worksheet', function(event, eventButton) {
      $('#edit-pte-hours-total').val($('#total-employee-hours').val());
      $(document).trigger('validate-edit-pte-hours-total', $('#edit-pte-hours-total'));
      $.colorbox.close();
    })
    .bind('edit-confirm-calculator-form-reset ', function(event, eventButton){
      location.reload();
    })
    .bind('edit-cancel-calculator-form-reset ', function(event, eventButton){
      $.colorbox.close();
    });

  /**
   * Attach handlers to triggers for validation events.
   */
  $(document)
    .bind('validate-edit-fte-total', function(event, eventField) {
      var validityCheck = (parseInt($(eventField).val()) > 24);
      $(eventField).parent().toggleClass('error', validityCheck).toggleClass('fte-over-limit', validityCheck);
      if (validityCheck) {
        $().colorbox({
          width:"600px",
          inline:true,
          href: $('#stc-overfte-error'),
          onCleanup: function() {
            $('#cboxLoadedContent').children().appendTo('#worksheet-forms');
          }
        });
      }
    })
    .bind('validate-edit-pte-hours-total', function(event, eventField) {
      var validityCheck = (parseInt($(eventField).val()) > 54079);
      $(eventField).parent().toggleClass('error', validityCheck ).toggleClass('pte-over-limit', validityCheck );
    })
    .bind('validate-edit-premiums-paid-by-employer', function(event, eventField) {
      var validityCheck = (isNaN(parseInt($(eventField).val())) || (parseInt($(eventField).val()) <= 0));
      $(eventField).parent().toggleClass('error', validityCheck ).toggleClass('invalid-premiums-paid', validityCheck );
    });

})(jQuery);
