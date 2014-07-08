<?php

/**
 * SHOP Claculator Form
 */

/**
 *
 * Form for new SHOP Tax Credit Calculator
 * @param $form
 *   Standard Drupal $form
 * @param $form_submit
 *   Standard Drupal $form_state
 *
 * @return array
 *   Drupal form array.
 */
function stc_calculator_form($form, $form_submit) {


  $form['pre-submit-form'] = array(
    '#prefix' => "<div class='pre-submit-form'>",
    '#suffix' => "</div>",
  );

  $tax_exempt_status = array(
     1 => t("Yes, I'm a tax-exempt employer"),
     0 => t("No, I'm not a tax-exempt employer"),
   );
  $form['pre-submit-form']['tax-exempt-status'] = array(
    '#type' => 'radios',
    '#title' => t('Tell us if you’re a tax-exempt employer.'),
    '#default_value' => 1,
    '#options' => $tax_exempt_status,
    '#prefix' => "<div class='field-pair-wrapper'>",
    '#suffix' => "<div class='field-explanation'>The credit is refundable for tax-exempt employers, but is limited to the amount of the tax-exempt employer’s payroll taxes withheld during the calendar year.</div></div>",
  );

  $part_time_hours_description  = t("You can use !worksheet to calculate the total payroll tax paid by you and your employees..", array('!worksheet' => l('this worksheet', '', array('fragment' => 'stc-payroll-worksheet-form', 'attributes' => array('class' => array('ajax-worksheet'))))));
  $form['pre-submit-form']['tax-exempt-payroll-taxes'] = array(
    '#type' => 'textfield',
    '#title' => t('Enter the amount of your payroll taxes for the applicable tax year.'),
    '#default_value' => 0,
    '#description' => '<span class="additional-error-message">You must enter a positive whole number.<br/><br/></span>' . $part_time_hours_description,
    '#prefix' => "<div class='field-pair-wrapper tax-exempt-payroll-taxes-wrapper'>",
    '#suffix' => "<div class='field-explanation'>The credit for tax-exempt small employers cannot exceed the amount of certain payroll taxes. For purposes of this credit, payroll taxes include federal income taxes required to be withheld, Medicare taxes required to be withheld, and Medicare taxes required to be paid by the employer.</div></div>",
  );

  $form['pre-submit-form']['fte-total'] = array(
    '#type' => 'textfield',
    '#title' => t('Enter the number of full-time employees for the applicable tax year.'),
    '#default_value' => 0,
    '#description' => '<span class="additional-error-message">You must enter a positive whole number or leave this blank.<br/></span>',
    '#prefix' => "<div class='field-pair-wrapper'>",
    '#suffix' => "<div class='field-explanation'>Full-time employees are employees who worked or who you expect to work the equivalent of 40 hours a week for 52 weeks (for a total of 2,080 hours each). If the total number of employees isn’t a whole number, round it down to the nearest whole number.</div></div>",
  );

  $part_time_hours_description  = t("If you’re unsure of the number of part-time employee hours, use !worksheet to enter hours for each individual employee.", array('!worksheet' => l('this worksheet', '', array('fragment' => 'stc-parttime-worksheet-form', 'attributes' => array('class' => array('ajax-worksheet'))))));
  $form['pre-submit-form']['pte-hours-total'] = array(
    '#type' => 'textfield',
    '#title' => t('Enter the part-time employee hours for the applicable tax year.'),
    '#default_value' => 0,
    '#description' => '<span class="additional-error-message">You must enter a positive whole number or leave this blank.<br/><br/></span>' . $part_time_hours_description,
    '#prefix' => "<div class='field-pair-wrapper'>",
    '#suffix' => "<div class='field-explanation'>Hours for part-time employees who worked or you expect to work less than 40 hours per week, but more than 120 days per year.<br/><br/>If the total number of hours isn’t a whole number, round it down to the nearest whole number.</div></div>",
  );

  $form['pre-submit-form']['wages-paid'] = array(
    '#type' => 'textfield',
    '#title' => t('Enter the total employee wages for the applicable tax year.'),
    '#default_value' => 0,
    '#description' => '<span class="additional-error-message">You must enter a positive whole number or leave this blank.<br/></span>',
    '#prefix' => "<div class='field-pair-wrapper'>",
    '#suffix' => "<div class='field-explanation'>The total wages you paid or expect to pay for both full-time and part-time employees should include all wages subject to Social Security and Medicare tax withholding (even if an employee’s yearly wages are more than the wage base limit).</div></div>",
  );

  $over_half_premiums_covered_options = array(
    1 => t("Yes, I pay at least 50%"),
    0 => t("No, I do not pay 50% or do not currently provide health insurance"),
  );
  $form['pre-submit-form']['over-half-premiums-covered'] = array(
    '#type' => 'radios',
    '#title' => t("Do you pay or plan to pay 50% or more of your employees’ premiums?"),
    '#default_value' => 1,
    '#options' => $over_half_premiums_covered_options,
    '#prefix' => "<div class='field-pair-wrapper'>",
    '#suffix' => "<div class='field-explanation'>To qualify for the tax credit, generally, you must pay at least 50% of your employees’ medical premium cost and meet other requirements to claim the credit.</div></div>",
  );

  $form['pre-submit-form']['premiums-paid-by-employer'] = array(
    '#type' => 'textfield',
    '#title' => t("Enter the total employee premiums for the applicable tax year."),
    '#default_value' => 0,
    '#description' => '<span class="additional-error-message">You must enter a positive whole number and premiums paid cannot be 0. <br/><br/></span> Important: To qualify for the tax credit, generally, you must pay at least 50% of your employees’ medical premium cost and meet other requirements to claim the credit.',
    '#prefix' => "<div class='field-pair-wrapper'>",
    '#suffix' => "<div class='field-explanation'>Only include the portion of premiums you paid or you expect to pay, not what your employees paid or what you expect they’ll pay. You can include premiums paid for seasonal employees’ coverage. Also include any contributions you made toward dependent coverage and dental plans.</div></div>",
  );

  $form['actions'] = array();
  $form['actions']['pre-submit'] = array(
    '#prefix' => "<div class='pre-submit-form actions'>",
    '#suffix' => "</div>",
  );

  $form['actions']['pre-submit']['show-results'] = array(
    '#type' => 'button',
    '#button_type' => 'button',
    '#value' => t('Show Results'),
  );
  $form['actions']['pre-submit']['reset-form'] = array(
    '#type' => 'button',
    '#button_type' => 'button',
    '#value' => t('Start Over'),
  );

  $result_header = array('Steps', 'Data entered');
  $result_rows = array();
  $result_rows[] = array(array('data' => 'Tax-exempt status', 'class' => 'step-col'), array('data' => '', 'id' => 'result-tax-exempt'));
  $result_rows[] = array(array('data' => 'Number of full-time employees', 'class' => 'step-col'), array('data' => '', 'id' => 'result-fte-number'));
  $result_rows[] = array(array('data' => 'Part-time hours entry method', 'class' => 'step-col'), array('data' => '', 'id' => 'result-pte-hours-method'));
  $result_rows[] = array(array('data' => 'Total part-time hours', 'class' => 'step-col'), array('data' => '', 'id' => 'result-pte-hours'));
  $result_rows[] = array(array('data' => 'Total FTE employees <span class="step-by-line">(calculated for you)</span>', 'class' => 'step-col'), array('data' => '', 'id' => 'result-fte-total'));
  $result_rows[] = array(array('data' => 'Total wages paid', 'class' => 'step-col'), array('data' => '$<span class="dollar-value"></span>', 'id' => 'result-total-wages-paid'));
  $result_rows[] = array(array('data' => 'Average wage <span class="step-by-line">(calculated for you)</span>', 'class' => 'step-col'), array('data' => '$<span class="dollar-value"></span>', 'id' => 'result-average-wage'));
  $result_rows[] = array(array('data' => 'Total premiums paid', 'class' => 'step-col'), array('data' => '$<span class="dollar-value"></span>', 'id' => 'total-premiums-paid'));
  $form['post-submit-form'] = array(
    '#prefix' => "<div class='post-submit-form' style='display: none;'>",
    '#markup' => theme('table', array('header' => $result_header, 'rows' => $result_rows)),
    '#suffix' => "</div>",
  );

  $form['post-submit-form-deductions-denied'] = array(
    '#prefix' => "<div class='deduction-result denied denied-denied' style='display: none;'>",
    '#markup' => "You’re not eligible for the tax credit based on the information you entered. You should talk with a licensed tax specialist to help you determine how the tax credit applies to your business.",
    '#suffix' => "</div>",
  );
  $form['post-submit-form-deductions-denied-wages'] = array(
    '#prefix' => "<div class='deduction-result denied denied-wages' style='display: none;'>",
    '#markup' => "You’re not eligible for the tax credit because the average wage paid exceeds $50,000 per employee. You should talk with a licensed tax specialist to help you determine how the tax credit applies to your business.",
    '#suffix' => "</div>",
  );
  $form['post-submit-form-deductions-denied-withholding'] = array(
    '#prefix' => "<div class='deduction-result denied denied-withholding'  style='display: none;'>",
    '#markup' => "You’re not eligible for the tax credit because you’re not withholding any payroll taxes. You should talk with a licensed tax specialist to help you determine how the tax credit applies to your business.",
    '#suffix' => "</div>",
  );
  $form['post-submit-form-deductions-denied-insufficient-premiums'] = array(
    '#prefix' => "<div class='deduction-result denied denied-insufficient-premiums'  style='display: none;'>",
    '#markup' => "You’re not eligible for the tax credit because you do not pay at least 50% of your employees’ health insurance premiums. You should browse health and dental plan information before using the tax credit estimator.This will help you enter more accurate information into the estimator.",
    '#suffix' => "</div>",
  );
  $form['post-submit-form-deductions-approved'] = array(
    '#prefix' => "<div class='deduction-result approved'  style='display: none;'>",
    '#markup' => "Your eligibility results and the amount you qualify for are only estimates. You may be eligible for the following tax credit based on the information you entered: $<span class='dollar-value'></span>",
    '#suffix' => "</div>",
  );
  $form['post-submit']['update-answers'] = array(
    '#prefix' => "<div class='post-submit-form' style='display: none;'>",
    '#type' => 'button',
    '#button_type' => 'button',
    '#value' => t('Edit'),
    '#suffix' => "</div>",
  );

  return $form;
}

/**
 * Validation handler for stc_calculator_form.
 */
function stc_calculator_form_validate($form, $form_submit) {
  /* Placeholder not used */
}

/**
 * Submit handler for stc_calculator_form.
 */
function stc_calculator_form_submit($form, $form_submit) {
  /* Placeholder not used */
}

/**
 *
 * Form for new SHOP Tax Credit Calculator
 * @param $form
 *   Standard Drupal $form
 * @param $form_submit
 *   Standard Drupal $form_state
 *
 * @return array
 *   Drupal form array.
 */
function stc_payroll_worksheet($form, $form_submit) {


  $form['federal-tax-withholding'] = array(
    '#type' => 'textfield',
    '#title' => t('Employee Federal Income Tax Withholding'),
    '#default_value' => 0,
  );

  $form['medicare-tax-withholding'] = array(
    '#type' => 'textfield',
    '#title' => t('Medicare Tax Withholding'),
    '#default_value' => 0,
  );

  $form['medicare-taxes-paid'] = array(
    '#type' => 'textfield',
    '#title' => t('Medicare taxes your business pays'),
    '#default_value' => 0,
  );

  $form['actions'] = array(
    '#prefix' => "<div class='payroll-worksheet-actions actions'>",
    '#suffix' => "</div>",
  );

  $form['actions']['complete-payroll-worksheet'] = array(
    '#type' => 'button',
    '#button_type' => 'button',
    '#value' => t('Continue'),
  );

  return $form;
}

/**
 *
 * Form for new SHOP Tax Credit Calculator
 * @param $form
 *   Standard Drupal $form
 * @param $form_submit
 *   Standard Drupal $form_state
 *
 * @return array
 *   Drupal form array.
 */
function stc_parttime_employee_worksheet($form, $form_submit) {


  $form['parttime-employees'] = array(
    '#type' => 'textfield',
    '#title' => t('Enter number of part-time employees'),
    '#default_value' => 1,
  );
  $form['updated-parttime-employees-rows'] = array(
    '#type' => 'button',
    '#value' => t('Enter'),
  );

  $method_for_entering_hours = array();
  $method_for_entering_hours['weekly'] = t('Weekly');
  $method_for_entering_hours['monthly'] = t('Monthly');
  $method_for_entering_hours['yearly'] = t('Yearly');

  $form['hour-entering-method'] = array(
    '#type' => 'radios',
    '#title' => t('Medicare Tax Withholding'),
    '#default_value' => 'yearly',
    '#options' => $method_for_entering_hours,
  );

  /* Default parttime employee worksheet table. */
  $headers = array('Employee Name', 'Hours', '');
  $default_employee_name_field = array(
    '#type'=> 'textfield',
    '#attributes' => array('class' => array('employee-name'), 'placeholder' => ' '),
  );
  $default_employee_hours_field = array('#type'=> 'textfield', '#value' => 0, '#attributes' => array('id' => 'employee-hours-value', 'class' => array('employee-hours')));
  $default_remove_employee_row_button = array('#type'=> 'button', '#value' => 'remove', '#attributes' => array('id' => array('remove-parttime-employees-row')));

  /* Totals Row. */
  $default_employee_total_hours_field = array('#type'=> 'textfield', '#value' => 0,  '#attributes' => array('id' => array('total-employee-hours'), 'readonly' => 'readonly'));

  /* Add Employee Row. */
  $default_add_employee_row_button = array('#type'=> 'button', '#value' => 'Add another employee', '#attributes' => array('id' => array('add-parttime-employees-row')));

  $default_employee_hours_field_rendered = drupal_render($default_employee_hours_field) . "<span class='error-message over-weekly'>Over Weekly</span><span class='error-message over-monthly'>Over Monthly</span><span class='error-message over-yearly'>Over Yearly</span>";
  $rows = array();
  $rows[] = array(
    'class' => array('parttime-employee-row-default'),
    'style' => 'display: none',
    'data' => array(
      0 => drupal_render($default_employee_name_field),
      1 => $default_employee_hours_field_rendered,
      2 => drupal_render($default_remove_employee_row_button),
    ),
  );
  $default_employee_name_field['#printed'] = $default_employee_hours_field['#printed'] = $default_remove_employee_row_button['#printed'] = FALSE;
  $rows[] = array(
    'class' => array('parttime-employee-row'),
    'data' => array(
      0 => drupal_render($default_employee_name_field),
      1 => $default_employee_hours_field_rendered,
      2 => drupal_render($default_remove_employee_row_button),
    ),
  );
  $rows[] = array(
    'class' => array('parttime-employee-row-total'),
    'data' => array(
      0 => 'Total part-time hours',
      1 => drupal_render($default_employee_total_hours_field),
      2 => '',
    )
  );
  $rows[] = array(
    'data' => array(array('data' => drupal_render($default_add_employee_row_button), 'colspan' => 3)),
  );


  $form['employee-table-worksheet'] = array(
    '#markup' =>  theme('table', array('header' => $headers, 'rows' => $rows)) ,
  );

  $form['actions'] = array(
    '#prefix' => "<div class='parttime-worksheet-actions actions'>",
    '#suffix' => "</div>",
  );

  $form['actions']['complete-parttime-worksheet'] = array(
    '#type' => 'button',
    '#button_type' => 'button',
    '#value' => t('Continue'),
  );

  return $form;
}

/**
 *
 * Calculator Reset Form.
 *
 * @param $form
 *   Standard Drupal $form
 * @param $form_submit
 *   Standard Drupal $form_state
 *
 * @return array
 *   Drupal form array.
 */
function stc_calculator_reset_form($form, $form_submit) {
  $form['confirm_calculator_form_reset'] = array(
    '#type' => 'button',
    '#button_type' => 'button',
    '#value' => t('Start Over'),
  );
  $form['cancel_calculator_form_reset'] = array(
    '#type' => 'button',
    '#button_type' => 'button',
    '#value' => t('Close'),
  );
  return $form;
}
