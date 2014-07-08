<?php
$form_owner_indus = drupal_get_form('myusa_user_dashboard_ownership_industry_form');
$form_wizard = drupal_get_form('myusa_user_dashboard_wizards_form');


?>
<div class="userdashboard-setup-mastercontainer">
    <div class="userdashboard-setup-container">
        <div class="userdashboard-setup-titlebar">
            <h1>Welcome to MyBusinessUSA.</h1>
            <p>There are a number of exciting new features that might be useful to your business. To help us further personalize your user experience, please answer the following questions.</p>
        </div>
        <div class="userdashboard-questionaire-content">
            <div class="userdashboard-questionare-ownership userdashboard-questionare-header">
                <span>1</span>
                What best describes the ownership of your business?
            </div>
            <?php print render($form_owner_indus['questionaire_ownership']);?>
            <div class="userdashboard-questionare-ownership userdashboard-questionare-header">
                <span>2</span>
                What industries are you most interested in?
            </div>
            <?php print render($form_owner_indus['questionaire_industry']);?>
        </div>
        <div class="userdashboard-questionaire-submission">
            <a href="#">Apply</a>
            <?php print render($form_owner_indus['questionare_submit']);?>
        </div>
        <div class="poll-results">ddd</div>
    </div>
    <div class="userdashboard-setup-container">
        <div class="userdashboard-questionaire-content">
            <div class="userdashboard-questionare-ownership userdashboard-questionare-header">
                <span>3</span>
                Using a streamlineed tool called a "wizard", which uses a series of relevant prompts (such as business location, size, etc.) you cna quickly discover what programs, services, events, etc. are available to you. Select preferred "wizard" tile(s) for your home page?
            </div>
            <?php print render($form_wizard['questionaire_tiles']);?>
        </div>
        <div class="userdashboard-questionaire-submission">
            <a href="#">Reset</a>
            <input type="submit" value="Continue" />
        </div>
    </div>
</div>