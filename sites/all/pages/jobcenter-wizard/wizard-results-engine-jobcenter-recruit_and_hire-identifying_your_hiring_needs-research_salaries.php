<?php

    global $rtn;
    global $html;
    global $wizard;
    global $wizardResults;
    global $tagIsSelected;
    global $allWizTags;

    // Load the library of functions used to pull information from the CareerOneStop website
    include_once('sites/all/themes/bususa/templates/wizard/wizard-results-engine-jobcenter-careeronestop-api-helper.php');

    $apiReturn = careerOneStopAPI_FindWagesForASelectedOccupation(
        $_POST['inputs']['research_salaries_occ_code'], 
        $_POST['inputs']['user_zip']
    );

?>

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

    <div class="wizard-results-master-container wizard-results-count-unknown">
        <table cellspacing="0" cellpadding="4" border="0" style="background-color:LightGrey;border-color:Black;border-width:2px;border-style:Solid;border-collapse:collapse; color: black;">
           <tbody>
              <tr>
                 <td rowspan="2" style="border-bottom:solid 1px #000000;border-right:solid 1px #000000;font-weight:bold;">Location</td>
                 <td rowspan="2" style="border-bottom:solid 1px #000000;border-right:solid 1px #000000;font-weight:bold;">Pay<br>Period</td>
                 <td align="center" colspan="6" style="border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['@attributes']['wageYear']; ?>
                 </td>
              </tr>
              <tr>
                 <td align="center" style="border-bottom:solid 1px #000000;font-weight:bold;">10%</td>
                 <td align="center" style="border-bottom:solid 1px #000000;font-weight:bold;">25%</td>
                 <td align="center" style="border-bottom:solid 1px #000000;font-weight:bold;">Median</td>
                 <td align="center" style="border-bottom:solid 1px #000000;font-weight:bold;">75%</td>
                 <td align="center" style="border-bottom:solid 1px #000000;font-weight:bold;">90%</td>
              </tr>
              <tr>
                 <td rowspan="2" style="background-color:White;width:150px;border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['@attributes']['Name']; ?>
                </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][0]['@attributes']['Type']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][0]['Pct10']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][0]['Pct25']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][0]['Median']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][0]['Pct75']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][0]['Pct90']; ?>
                 </td>
              </tr>
              <tr>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][1]['@attributes']['Type']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][1]['Pct10']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][1]['Pct25']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][1]['Median']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][1]['Pct75']; ?>
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][0]['Periods']['Period'][1]['Pct90']; ?>
                 </td>
              </tr>
              <tr>
                 <td rowspan="2" style="background-color:White;width:150px;border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['@attributes']['Name']; ?>
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][0]['@attributes']['Type']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][0]['Pct10']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][0]['Pct25']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][0]['Median']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][0]['Pct75']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][0]['Pct90']; ?> 
                 </td>
              </tr>
              <tr>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][1]['@attributes']['Type']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][1]['Pct10']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][1]['Pct25']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][1]['Median']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][1]['Pct75']; ?> 
                 </td>
                 <td style="border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][1]['Periods']['Period'][1]['Pct90']; ?> 
                 </td>
              </tr>
              <tr>
                 <td rowspan="2" style="background-color:White;width:150px;border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['@attributes']['Name']; ?>
                </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][0]['@attributes']['Type']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][0]['Pct10']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][0]['Pct25']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][0]['Median']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][0]['Pct75']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][0]['Pct90']; ?> 
                 </td>
              </tr>
              <tr>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;font-weight:bold;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][1]['@attributes']['Type']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][1]['Pct10']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][1]['Pct25']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][1]['Median']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][1]['Pct75']; ?> 
                 </td>
                 <td style="background-color:LightBlue;border-right:solid 1px #000000;border-bottom:solid 1px #000000;">
                    <?php print $apiReturn['Body']['GetWagesByZipResponse']['Wages']['Regions']['Region'][2]['Periods']['Period'][1]['Pct90']; ?> 
                 </td>
              </tr>
           </tbody>
        </table>
        <br/>
        <small>Occupation Code: <?php print $_POST['inputs']['research_salaries_occ_code']; ?></small>
    </div>
    