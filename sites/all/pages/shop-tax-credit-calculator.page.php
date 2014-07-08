<style>
  /* Clear site defaults */
  .worksheet-form input[type=text],
  .worksheet-form div,
  .stc-calculator-mastercontainer input[type=text],
  .stc-calculator-mastercontainer div{
    clear: both;
  }

  .worksheet-form .error-message {
    display: none;
  }
  .worksheet-form .over-monthly .over-monthly.error-message,
  .worksheet-form .over-weekly .over-weekly.error-message,
  .worksheet-form .over-yearly .over-yearly.error-message {
    display: inline;
  }

</style>

<div class="stc-calculator-mastercontainer">
  <div id="stc-main-calculator">
    <?php print drupal_render(drupal_get_form('stc_calculator_form')); ?>
  </div>
</div>

<div id="worksheet-forms" style="display: none;">
  <div id="stc-payroll-worksheet-form" class="worksheet-form">
    <h2>Non-profit tax worksheet</h2>
    <?php print drupal_render(drupal_get_form('stc_payroll_worksheet')); ?>
  </div>
  <div id="stc-parttime-worksheet-form" class="worksheet-form">
    <h2>Part-time employee worksheet</h2>
    <?php print drupal_render(drupal_get_form('stc_parttime_employee_worksheet')); ?>
  </div>
  <div id="stc-parttime-worksheet-reset-form" class="worksheet-form">
    <h2>Are you sure you want to reset?</h2>
    <?php print drupal_render(drupal_get_form('stc_calculator_reset_form')); ?>
  </div>
  <div id="stc-overhalf-error" class="worksheet-form">
    <h2>You do not qualify.</h2>
    Important: To qualify for SHOP you have to pay 50% or more of your employees’ premiums. If you do not currently offer insurance, please browse the health and dental plan information before using the tax credit estimator. This will help you enter more accurate information into the estimator.
  </div>
  <div id="stc-overfte-error" class="worksheet-form">
    <h2>You do not qualify.</h2>
    Important: You do not qualify for the tax credit because you have entered 25 or more full-time employees.
  </div>
</div>
