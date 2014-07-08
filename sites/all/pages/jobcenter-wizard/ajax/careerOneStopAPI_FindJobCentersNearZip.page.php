<?php

    overridable_include('sites/all/pages/jobcenter-wizard/wizard-results-engine-jobcenter-careeronestop-api-helper.php');

    if ( !empty($_GET['zip']) && !empty($_GET['range']) ) {
        
        $apiReturn = careerOneStopAPI_FindJobCentersNearZip($_GET['zip'], $_GET['range']);
        
        if ( strpos(request_uri(), '-DEBUG-') !== false ) {
            dsm($apiReturn);
        }
        
        if ( $apiReturn === false ) {
            print 'An error has occured while processing this request';
        } else {
            
            ob_end_clean();
            ob_end_clean();
            ob_end_clean();
            
            print '<!-- The following markup is gerenated from ' . basename(__FILE__) . ' /* Coder Bookmark: CB-YHZGL62-BC */ -->';
            print '<div class="jobcenteroffice-results-container">';
            $resultCountPrintedSoFar = 0;
            foreach ( $apiReturn['Details']['Detail'] as $result ) {
                
                if ( strpos($result['WEB_SITE_URL'], 'http://') === false ) {
                    $result['WEB_SITE_URL'] = 'http://' . $result['WEB_SITE_URL'];
                }
                
                if ( $resultCountPrintedSoFar > 2 ) {
                    break;
                }
                
                ?>
                    
                    <div class="jobcenteroffice-result">
                        <div class="jobcenteroffice-result-name">
                            <a href="<?php print $result['WEB_SITE_URL']; ?>"><?php print $result['NAME']; ?></a>
                        </div>
                        <div class="jobcenteroffice-result-address1">
                            <?php print $result['ADDRESS_1']; ?>
                        </div>
                        <div class="jobcenteroffice-result-address2">
                            <?php $add2 = "";
                                  foreach($result['ADDRESS_2'] as $key => $value){
                                        if($value){
                                            $add2 = $add2 .",";
                                        }
                                  }
                                  if($add2 != "")
                                    print substr($add2, 0, -1);
                            ?>
                        </div>
                        <div class="jobcenteroffice-result-city">
                            <?php print $result['CITY'].', &nbsp;';?>
                        </div>
                        <div class="jobcenteroffice-result-state">
                            <?php print $result['STATE']; ?>
                        </div>
                        <div class="jobcenteroffice-result-hours">
                            <div class="jobcenteroffice-result-hours-label">
                                Hours:
                            </div>
                            <div class="jobcenteroffice-result-hours-data">
                                <?php print $result['OFFICE_HOURS']; ?>
                            </div>
                        </div>
                        <div class="jobcenteroffice-result-phone">
                            <div class="jobcenteroffice-result-phone-label">
                                Phone:
                            </div>
                            <div class="jobcenteroffice-result-phone-data">
                                <?php print $result['PHONE']; ?>
                            </div>
                        </div>
                        <div class="jobcenteroffice-result-description">
                            <div class="jobcenteroffice-result-description-label">
                                Details:
                            </div>
                            <div class="jobcenteroffice-result-description-data">
                                <?php print $result['BRIEF_DESCRIPTION']; ?>
                            </div>
                        </div>
                    </div>
                    
                <?php
                $resultCountPrintedSoFar++;
            }
            
            print '
                <div class="jobcenteroffice-results-viewmore-outter">
                    <div class="jobcenteroffice-results-viewmore-inner">
                        <a href="http://www.careeronestop.org/ReEmployment/COS_FindOneStopCenter.aspx?zip=' . $_GET['zip'] . '&city=&state=%20&proximity=100&search=Search">View More</a>
                    </div>
                </div>
            ';
            
            print '</div>';
            
            flush();
            exit();
        }
    } else {
        
        print 'Error - No zip or range parameter given in URL query';
        
    }

?>