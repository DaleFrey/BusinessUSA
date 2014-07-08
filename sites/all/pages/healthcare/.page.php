<?php
    $featuredInformation = array(
        array(
            'title' => 'Share Your Business Health Care Story',
            'link' => 'http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic&healthcare=true',
            'snippet' => '',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'Affordable Care Act Tax Provisions Q&A',
            'link' => "http://www.irs.gov/uac/Newsroom/Affordable-Care-Act-Tax-Provisions-Questions-and-Answers",
            'snippet' => '',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'What are some of the key things an employer needs to know about the new healthcare law?',
            'link' => "http://business.usa.gov/sites/default/files/ACA%20101%20Deck%20-%20May%207%202014%20(FINAL).pdf",
            'snippet' => 'The key things an employer needs to know about the new healthcare law.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'What is the timeline for implementation of key features of the Affordable Care Act?',
            'link' => 'http://www.hhs.gov/healthcare/facts/timeline/index.html',
            'snippet' => 'The Affordable Care Act health insurance reforms will roll out in phases, many of which will occur in 2013 and 2014. This interactive timeline contains details on key provisions.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'Glossary of key Health Care terms',
            'link' => 'https://www.healthcare.gov/glossary/',
            'snippet' => 'For definitions of key health care reform terms, consult this glossary of key terms provided by the U.S. Department of Health and Human Services.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'Affordable Care Act Fact Sheet for Small Business',
            'link' => '/sites/default/files/SBA%20ACA%20Fact%20Sheet%20for%20Small%20Business%20-%203%20pager%20(April%202014).pdf',
            'snippet' => 'Affordable Care Act Fact Sheet for Small Business ',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'Where can I find detailed information for businesses with 50 or more full-time equivalent employees?',
            'link' => 'http://business.usa.gov/sites/default/files/SBA%20ACA%20201%20Deck%20-%20Updated%20July%202013.pdf',
            'snippet' => 'This comprehensive slide deck provides more advanced information for businesses, especially those affected by employer shared responsibility.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => 'healthcare-50ormore-only'
        ),
        array(
            'title' => 'US Small Business Administration Affordable Care Act Fact Sheet Myth vs. Fact',
            'link' => '/sites/default/files/SBA%20ACA%20Fact%20Sheet_Myth%20vs%20Fact%20(April%202014).pdf',
            'snippet' => 'US Small Business Administration Affordable Care Act Fact Sheet Myth vs. Fact ',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'US Small Business Administration Affordable Care Act Fact sheet Strengthening Health Care for Small Business ',
            'link' => 'http://business.usa.gov/sites/default/files/SBA%20ACA%20Fact%20Sheet_Strengthening%20Health%20Care%20for%20Small%20Businesses%20(March%202014).pdf',
            'snippet' => 'US Small Business Administration Affordable Care Act Fact sheet Strengthening Health Care for Small Business ',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'Affordable Care Act Fact Sheet Strengthening Health Care for the Self-Employed',
            'link' => '/sites/default/files/SBA%20ACA%20Fact%20Sheet_Strengthening%20Health%20Care%20for%20Self-Employed%20(April%202014).pdf',
            'snippet' => 'Under the Affordable Care Act, self-employed individuals will have more opportunities than ever to access quality, affordable health care.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'Affordable Care Act Fact Sheet - Milestones for Small Businesses',
            'link' => 'http://business.usa.gov/sites/default/files/SBA%20ACA%20Fact%20Sheet_%20Timeline%20for%20Small%20Businesses%20(March%202014).pdf',
            'snippet' => '',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => 'never-hide'
        )
    );
?>

<?php ob_start(); /* Start capturing the splashextension div into an output buffer */ ?>
    <div class="splashextension">
        
        <div class="splashextension-section splashextension-featinfo">
            <h2 class="splashextension-featinfo-titlebar">
                Featured Information
            </h2>
            <div class="splashextension-featinfo-body">
            
                <ul class="splashextension-featinfo-list splashextension-featinfo-visiblelist">
                    <?php foreach ( array_slice($featuredInformation, 0, 4) as $featInfo ): ?>
                        <li class="splashextension-featinfo-li <?php print $featInfo['additionalDivClass']; ?>">
                            <a href="<?php print $featInfo['link']; ?>" <?php print $featInfo['additionalHTML']; ?>>
                                <?php print $featInfo['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                
                <ul class="splashextension-featinfo-list splashextension-featinfo-slidinglist" style="display: none;">
                    <?php foreach ( array_slice($featuredInformation, 4) as $featInfo ): ?>
                        <li class="splashextension-featinfo-li <?php print $featInfo['additionalDivClass']; ?>">
                            <a href="<?php print $featInfo['link']; ?>" <?php print $featInfo['additionalHTML']; ?>>
                                <?php print $featInfo['title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                
                <a class="view" href="javascript: jQuery('.splashextension-featinfo-slidinglist').slideToggle(); jQuery('.splashextension-featinfo-body').toggleClass('viewing-more'); void(0);">
                    View 
                    <span class="viewmore">More</span>
                    <span class="viewless">Less</span>
                </a>
                
            </div>
        </div>
        
        <div class="splashextension-section splashextension-toolsres">
            <h2 class="splashextension-toolsres-titlebar">
                Health Care Tools for Businesses
            </h2>
            <div class="splashextension-toolsres-body">
                <ul class="splashextension-toolsres-list">
                    <li class="splashextension-toolsres-li">
                        <a href="/full-time-employee-calculator">
                            Full-time Equivalent (FTE) Employee Calculator 
                        </a>
                    </li>
                    <li class="splashextension-toolsres-li">
                        <a href="https://www.healthcare.gov/shop-calculators-taxcredit/">
                            Small Business Health Options Tax Credit Estimator
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="splashextension-section splashextension-connect">
            <h2 class="splashextension-connect-titlebar">
                Connect With Us
            </h2>
            <div class="splashextension-connect-body">
                <ul class="splashextension-connect-list">
                    <li class="splashextension-connect-li splashextension-connect-li-story">
                        <a href="http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic&healthcare=true">
                            <img src="/sites/all/themes/bizusa/images/icons/tellyourstory.png" />
                            <span class="splashextension-connect-li-text">
                                Tell Us Your Health Care Story
                            </span>
                        </a>
                    </li>
                    <li class="splashextension-connect-li splashextension-connect-li-video">
                        <a href="/training-materials/video/">
                            <img src="/sites/all/themes/bizusa/images/icons/watchvideos.png" />
                            <span class="splashextension-connect-li-text">
                                Watch Health Care Success Videos
                            </span>
                        </a>
                    </li>
                    <li class="splashextension-connect-li splashextension-connect-li-question">
                        <a href="javascript: void(0); // Call 1-800-318-2596">
                            <img src="/sites/all/themes/bizusa/images/icons/questions.png" />
                            <div class="splashextension-connect-li-text splashextension-connect-li-text-questionshop">
                                <div>Questions about Small Business Health Options?</div>
                                <div>Call 1-800-706-7893</div>
                                <div>(TTY: 1-800-706-7915)</div>
                                <div>Monday - Friday, 9 a.m. - 7 p.m. EST</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="splashextension-connect-socialicons" rendersource="<?php print basename(__FILE__); ?>">
                    <a class="no-ext-frame" target="_blank" href="https://www.facebook.com/Healthcare.gov">
                        <img src="/sites/all/themes/bizusa/images/share-btn/facebook_clicked.png" rendersource="<?php print basename(__FILE__); ?>" />
                    </a>
                    <a class="no-ext-frame" target="_blank" href="https://twitter.com/HealthCareGov">
                        <img src="/sites/all/themes/bizusa/images/share-btn/twitter_clicked.png" rendersource="<?php print basename(__FILE__); ?>" />
                    </a>
                    <a class="no-ext-frame" target="_blank" href="https://www.youtube.com/user/HealthCareGov">
                        <img src="/sites/all/themes/bizusa/images/youtubelogo.png" rendersource="<?php print basename(__FILE__); ?>" />
                    </a>
                </div>
            </div>
        </div>
        
    </div>
<?php 
    // Place the captured splashextension div into $splashExtensionHTML
    $splashExtensionHTML = ob_get_contents();
    ob_end_clean();
?>

<?php
    
    $wizardQuestions = ya_wizard_WizardFromExcel(overridable('sites/all/pages/healthcare/wizard-questions.xls'));
    dsm($wizardQuestions);
    
    // The last slide of this wizard shall load its content from an [AJAX] path
    $lastSlideId = count( $wizardQuestions['slides'] ) - 1;
    $wizardQuestions['slides'][$lastSlideId]['ajaxLoad'] = '/healthcare/wizard-results';
    
    // Inject the splashextension div into the end of the first (splash) slide of this wizard
    $wizardQuestions['slides'][0]['questions'][] = array(
        'widgetType' => 'html',
        'label' => '',
        'wizardTag' => 'custom-html',
        'options' => $splashExtensionHTML,
        'containerClass' => '',
        'inputClass' => '',
        'inputAttrs ' => '',
        'dependencyLogic' => array(),
    );
    
    // Render the wizard
    $yawizardVariables = array(
        'sideBars' => array(
            'connectwithus' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-connectwithus.php'),
            'upcomingevents' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-upcomingevents.php'),
            'featinfo' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-featinfo.php'),
            'recenthealthblog' => overridable('sites/all/pages/healthcare/wizard-results-sidebar-recenthealthblog.php'),
        )
    );
    $wizardHTML = theme('yawizard', array_merge($yawizardVariables, $wizardQuestions));
        
    // Based on the mode, determine what to do with the wizard HTML
    if ( !empty($_GET['widget']) && intval($_GET['widget']) === 1 ) {
        global $overrideBodyMarkup; // This is a special variable used by html.tpl.php
        $overrideBodyMarkup = $wizardHTML;
    } else {
        print $wizardHTML;
    }
    
?>