<?php

    global $rtn;
    global $html;
    global $wizard;
    global $wizardResults;
    global $tagIsSelected;
    global $allWizTags;

    $apiReturn = careerOneStopAPI_IdentifySkillAndKnowledgeGapsBetween2Occupations(
        $_POST['inputs']['previous_occupation_code'], 
        $_POST['inputs']['new_occupation_code'],
        $_POST['inputs']['user_zip'], 
        100
    );

?>

    <!-- The following styles are stored in <?php print __FILE__; ?> -->
    <style rendersource="<?php print basename(__FILE__); ?>">
        .wizard-uniqueid-jobcenter .results-slide-container {
            color: black;
        }
        .gridView
        {
            background-color:#e2e6eb;
            border: solid 1px #CCCCCC;
            width:100%;  
            padding:10px 10px 10px 10px;   
        }
        .divView
        {
            width:100%;
            padding:10px 10px 10px 10px;  
        }
        .gridViewContainer{width:100%; overflow-x:scroll;}
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
           font-weight:bold;
           text-align:left;  
           padding:0px 20px 5px 0px;
           color: #1A6894;
           font-size:20px;
           line-height:40px;  
        }
        td, th{padding:10px;}
        #top{width:auto !important; margin-bottom:25px !important;}
        .topLink{display:block;}
        #SimilarSkillsandKnowledge, #skillsAndKnowledgeGaps{margin-top:30px;}
        #top p{margin-bottom:0px;}

    </style>

    <div class="wizard-results-master-container wizard-results-count-unknown">
        <div id="ctl00_ContentPlaceHolder1_results">
           <div class="divView">
              <div id="top" class="results-welcome-top-message">
                <style> .readMore, .readLess{color:#15567B; text-decoration:underline; cursor:pointer;}</style>
                <p>The sections below are presented to help and guide you to compare occupation skill requirements: <a href="#currentOccupation">Occupation Comparison</a>, <a href="#SimilarSkillsandKnowledge">Similar Skills and Knowledge</a>, <a href="#skillsAndKnowledgeGaps">Skills and Knowledge Gaps</a>.</p> 
              </div>
              <div class="headingStyle" id="currentOccupation">Occupation Comparison</div>
              <div class="gridViewContainer">
              <table class="gridView">
                <thead>
                  <tr >
                    <th class="headerStyle"></th>
                    <th class="headerStyle"><div>Current Occupation </div></th>
                    <th class="headerStyle"><div>New Occupation</div></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr class="rowStyle">
                    <td style="font-weight:bold;">Title</td>
                    <td><?php print $apiReturn['CurrentOccupationTitle']; ?></td>
                    <td><?php print $apiReturn['TargetOccupationTitle']; ?></td>
                  </tr>
                  <tr class="alternatingRowStyle">
                    <td style="font-weight:bold;">Salary</td>
                    <td><?php print $apiReturn['CurrentOccupationWage']; ?></td>
                    <td><?php print $apiReturn['TargetOccupationWage']; ?></td>
                  </tr>
                  <tr class="rowStyle">
                    <td style="font-weight:bold;">Training</td>
                    <td><?php print $apiReturn['CurrentTrainingTitle']; ?></td>
                    <td><?php print $apiReturn['TargetTrainingTitle']; ?></td>
                  </tr>
                  <tr class="alternatingRowStyle">
                    <td style="font-weight:bold;">License(s)</td>
                    <td><?php print $apiReturn['CurrentLicenses']; ?></td>
                    <td><?php print $apiReturn['TargetLicenses']; ?></td>
                  </tr>
                  <tr class="rowStyle">
                    <td style="font-weight:bold;">Certification(s)</td>
                    <td><?php print $apiReturn['CurrentCertificates']; ?></td>
                    <td><?php print $apiReturn['TargetCertificates']; ?></td>
                  </tr>
                </tbody>
              </table>
              </div>
              <div style="text-align: right;">
                <a class="topLink" href="#top">Back to top</a>
              </div>
              <br>
              <div class="headingStyle" id="SimilarSkillsandKnowledge">Similar Skills and Knowledge</div>
              <div class="gridViewContainer">
                 <table class="gridView" cellspacing="0" align="Center" border="0" style="border-collapse:collapse;">
                    <tbody>
                       <tr>
                          <th class="headerStyle" scope="col">Title</th>
                          <th class="headerStyle" scope="col">Description</th>
                       </tr>
                       <?php foreach ( $apiReturn['OccupationSkillsMatchList']['OccupationSkill'] as $arrIndex => $occupationSkill ) {  ?>
                           <tr class="<? print ( $arrIndex % 2 == 0  ? 'rowStyle' : 'alternatingRowStyle') ?>">
                              <td><?php print $occupationSkill['Title']; ?></td>
                              <td><?php print $occupationSkill['Description']; ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                 </table>
                <div style="text-align: right;">
                  <a class="topLink" href="#top">Back to top</a>
                </div>
              </div>
              <br>
              <div class="headingStyle" id="skillsAndKnowledgeGaps">Skills and Knowledge Gaps</div>
              <div class="gridViewContainer scrolltable">
                 <table class="gridView" cellspacing="0" align="Center" border="0" style="border-collapse:collapse;">
                    <tbody>
                       <tr>
                          <th class="headerStyle" scope="col">Skill ID</th>
                          <th class="headerStyle" scope="col">Title</th>
                          <th class="headerStyle" scope="col">SkillType</th>
                          <th class="headerStyle" scope="col">SKScoreCurrent</th>
                          <th class="headerStyle" scope="col">SKScoreTarget</th>
                          <th class="headerStyle" scope="col">TrainingAvailable</th>
                       </tr>
                       <?php foreach ( $apiReturn['OccupationSkillsGapList']['OccupationSkillGap'] as $arrIndex => $occupationSkillGap ) {  ?>
                           <tr class="<? print ( $arrIndex % 2 == 0  ? 'rowStyle' : 'alternatingRowStyle') ?>">
                              <td><?php print $occupationSkillGap['SkillId']; ?></td>
                              <td><?php print $occupationSkillGap['Title']; ?></td>
                              <td><?php print $occupationSkillGap['SkillType']; ?></td>
                              <td><?php print $occupationSkillGap['SKScoreCurrent']; ?> Low</td>
                              <td><?php print $occupationSkillGap['SKScoreTarget']; ?></td>
                              <td><?php print $occupationSkillGap['AvailableTraining']; ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                 </table>
                <div style="text-align: right;">
                  <a class="topLink" href="#top">Back to top</a>
                </div>
              </div>
           </div>
       </div>
    </div>
    
    
    