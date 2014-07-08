<?php

    print theme(
        'legacy_swimlane_page',
        array(
            'sections' => array(
                array(
                    'title' => 'Have you or your business been affected by Hurricane Sandy?',
                    'url' => '/search/site/disaster',
                    'blocks' => array(
                        array(
                            'title' => 'Hurricane Sandy Recovery',
                            'url' => '/tools/hurricane-sandy-recovery',
                            'snippet' => "The Federal Government's official page for resources for dealing with Hurricane Sandy's aftermath.",
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/crane.jpg'
                        ),
                        array(
                            'title' => 'Hurricane Recovery Assistance Information ',
                            'url' => '/article/hurricane-recovery-assistance-information',
                            'snippet' => "For small businesses, information on disaster declaration and deadlines for filing for assistance from Hurricane Sandy's aftermath.",
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/recover-chalk.jpg'
                        ),
                    ),
                ),
                array(
                    'title' => 'Have you or your business been affected by a disaster?',
                    'url' => '/search/site/disaster%20assistance',
                    'blocks' => array(
                        array(
                            'title' => 'Business Disaster Loans',
                            'url' => '/program/business-disaster-loans',
                            'snippet' => "SBA's disaster loans are the primary form of Federal assistance for the repair and rebuilding of non-farm, private sector disaster losses.",
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/flood.jpg'
                        ),
                        array(
                            'title' => 'Disaster Survivor',
                            'url' => '/tools/disaster-survivor',
                            'snippet' => 'Information for disaster survivors about disaster assistance available from the Federal government.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/flood-car.jpg'
                        ),
                    ),
                ),
                array(
                    'title' => 'Have you planned for business continuity in the event of a disaster?',
                    'url' => '/search/site/disaster',
                    'blocks' => array(
                        array(
                            'title' => 'Prepare My Business',
                            'url' => '/program/prepare-my-business',
                            'snippet' => 'Disaster planning and preparedness can be your lifeline to staying in business.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/construct.jpg'
                        ),
                        array(
                            'title' => '5 Tips on Starting Your Hurricane Season Business Continuity Plan',
                            'url' => '/article/5-tips-starting-your-hurricane-season-business-continuity-plan',
                            'snippet' => 'SBA and Agility Recovery Solutions recently hosted a free webinar giving tips on how to prepare for Hurricane season.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/emergancy-check.jpg'
                        ),
                    ),
                ),
            ),
            'subnav_header_links'=>array(
                array(
                    "text"=>"Access Financing",
                    "link"=>"/access-financing",
                ),
                array(
                    "text"=>"Taxes And Credits",
                    "link"=>"/taxes-and-credits",
                ),
                array(
                    "text"=>"Find Regulations",
                    "link"=>"/browseregulations",
                ),
            )
        )
    );