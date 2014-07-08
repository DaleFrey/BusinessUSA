<?php

    global $rtn;
    global $html;
    global $wizard;
    global $wizardResults;
    global $tagIsSelected;
    global $allWizTags;

    // Load the library of functions used to pull information from the CareerOneStop website
    include_once('sites/all/themes/bususa/templates/wizard/wizard-results-engine-jobcenter-careeronestop-api-helper.php');

    $apiReturn = careerOneStopAPI_GetOccupationSummary(
        $_POST['inputs']['jsa_occupation'],
        $_POST['inputs']['user_zip'],
        100
    );

?>

<style>
    .gridView
    {
        width:100%;  
        padding:10px 10px 10px 10px;   
    }

    .divView
    {

        width:100%;
        padding:10px 10px 10px 10px;  
    }
    .headerStyle
    {
       font-weight:bold;
       text-align:left;
       height:30px;
    }
    .alternatingRowStyle
    {
       background-color:#f8f9fa;
       vertical-align:text-top;
       height:25px;  
    }
    .rowStyle
    {
      background-color:#ffffff;
      vertical-align:text-top;
      height:25px;
    }

    .headingStyle
    {  
      color: #1A6894;
      font-size: 20px;
      font-weight: bold;
      line-height: 40px;
      padding: 0 20px 5px 0;
      text-align: left;  
    }
    #top{width:auto !important; margin-bottom:25px !important;}
    #top p{margin-bottom:0px;}

</style>

<div class="wizard-results-master-container wizard-results-count-unknown">

    <div style="display: none;" class="debug-info">
        <?php 
            if ( strpos(request_uri(), '-DEBUG-') !== false ) {
                print_r(
                    array(
                        '_POST' => $_POST,
                        'apiReturn' => $apiReturn
                    )
                );
            }
        ?>
    </div>
    
    <div class="divView">
        <div id="top" class="results-welcome-top-message">
          <style> .readMore, .readLess{color:#15567B; text-decoration:underline; cursor:pointer;}</style>
          <p>This data comes from several sources at the U.S. Department of Labor's Bureau of Labor Statistics.<br>
          The result below will help you in finding out more about the occupation information based on your search.</p> 
        </div>
       <div class="headingStyle">Occupation Title</div>
       <?php print $apiReturn['OccupationTitle']; ?><br><br>
       <div class="headingStyle">Description</div>
       <?php print $apiReturn['OccupationDescription']; ?><br><br>
       <div class="headingStyle">Details</div>
       Currently Employed: <?php print $apiReturn['CurrentlyEmployed']; ?><br><br>
       Yearly Projected Openings: <?php print $apiReturn['OpeningsPerYear']; ?><br><br>
       Typical Hourly Wage: <?php print $apiReturn['HourlyWage']; ?><br><br>
       Typical Annual Salary: <?php print $apiReturn['AnnualWage']; ?><br><br>
       Job Count: <?php print $apiReturn['JobCount']; ?><br><br>
       <div class="headingStyle">Typical Training</div>
       <?php print $apiReturn['TrainingTitle']; ?><br><br>
    </div>
</div>
    
