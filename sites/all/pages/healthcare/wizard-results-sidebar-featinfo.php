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
            'title' => 'ACA Tax Provisions Q&A',
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
            'title' => 'What is the timeline for implementation of key features of the ACA?',
            'link' => 'http://www.hhs.gov/healthcare/facts/timeline/index.html',
            'snippet' => 'The Affordable Care Act health insurance reforms will roll out in phases, many of which will occur in 2013 and 2014. This interactive timeline contains details on key provisions.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'Click here for glossary of key healthcare terms',
            'link' => 'https://www.healthcare.gov/glossary/',
            'snippet' => 'For definitions of key health care reform terms, consult this glossary of key terms provided by the U.S. Department of Health and Human Services.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'ACA Fact Sheet for Small Business',
            'link' => '/sites/default/files/SBA%20ACA%20Fact%20Sheet%20for%20Small%20Business%20-%203%20pager%20(April%202014).pdf',
            'snippet' => 'ACA Fact Sheet for Small Business ',
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
            'title' => 'SBA ACA Fact Sheet Myth vs. Fact',
            'link' => '/sites/default/files/SBA%20ACA%20Fact%20Sheet_Myth%20vs%20Fact%20(April%202014).pdf',
            'snippet' => 'SBA ACA Fact Sheet Myth vs. Fact ',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'SBA ACA Fact sheet Strengthening Health Care for Small Business ',
            'link' => 'http://business.usa.gov/sites/default/files/SBA%20ACA%20Fact%20Sheet_Strengthening%20Health%20Care%20for%20Small%20Businesses%20(March%202014).pdf',
            'snippet' => 'SBA ACA Fact sheet Strengthening Health Care for Small Business ',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'ACA Fact Sheet Strengthening Health Care for the Self-Employed',
            'link' => '/sites/default/files/SBA%20ACA%20Fact%20Sheet_Strengthening%20Health%20Care%20for%20Self-Employed%20(April%202014).pdf',
            'snippet' => 'Under the Affordable Care Act, self-employed individuals will have more opportunities than ever to access quality, affordable health care.',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => ''
        ),
        array(
            'title' => 'ACA Fact Sheet - Milestones for Small Businesses',
            'link' => 'http://business.usa.gov/sites/default/files/SBA%20ACA%20Fact%20Sheet_%20Timeline%20for%20Small%20Businesses%20(March%202014).pdf',
            'snippet' => '',
            'additionalHTML' => ' target="_blank"',
            'additionalDivClass' => 'never-hide'
        )
    );
?>
    <h2 class="sidebar-featinfo-title collapsed" onclick="jQuery('.sidebar-featinfo-body').slideToggle(); jQuery('.sidebar-featinfo-title').toggleClass('expanded'); jQuery('.sidebar-featinfo-title').toggleClass('collapsed');">
        Featured Information
        <img class="downarrow" src="/sites/all/themes/bizusa/images/downarrow.png" />
        <img class="uparrow" src="/sites/all/themes/bizusa/images/uparrow.png" />
    </h2>
    <div class="sidebar-featinfo-body sidebar-body collapsed" style="display: none;">
            <ul class="sidebar-featinfo-list">
                <?php foreach ( array_slice($featuredInformation, 0, 3) as $info ): ?>
                    <li class="sidebar-featinfo-li <?php print $info['additionalDivClass']; ?>">
                        <a class="no-ext-frame" href="<?php print $info['link']; ?>" <?php print $info['additionalHTML']; ?>>
                            <?php print $info['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="sidebar-featinfo-list-sliding" style="display: none;">
                <?php foreach ( array_slice($featuredInformation, 3) as $info ): ?>
                    <li class="sidebar-featinfo-li <?php print $info['additionalDivClass']; ?>">
                        <a href="<?php print $info['link']; ?>" <?php print $info['additionalHTML']; ?>>
                            <?php print $info['title']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a class="viewmoreless" href="javascript: jQuery('.sidebar-featinfo-list-sliding').slideToggle(); jQuery('.sidebar-featinfo-body').toggleClass('expanded'); jQuery('.sidebar-featinfo-body').toggleClass('collapsed'); void(0);">
                View
                <span class="more">More</span>
                <span class="less">Less</span>
            </a>
    </div>

