<?php

    print theme(
        'legacy_swimlane_page',
        array(
            'sections' => array(
                array(
                    'title' => 'Do you need help finding veteran-specific small business loans?',
                    'url' => '/search/site/*?f[0]=sm_field_program_hq_usa:1&f[1]=sm_field_program_company_size:Small/Medium%20(1-500%20employees)&f[2]=sm_field_program_comp_maturity:Pre-Startup&f[3]=sm_field_program_comp_maturity:Startup&f[4]=sm_field_program_owner_share:Veteran&f[5]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'Express and Pilot Programs',
                            'url' => '/program/express-and-pilot-programs',
                            'snippet' => 'Express and Pilot Programs',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/laptop-mil.jpg'
                        ),
                        array(
                            'title' => 'Military Reservist Economic Injury Disaster Loan Program (MREIDL)',
                            'url' => '/program/military-reservist-economic-injury-disaster-loan-mreidl-program',
                            'snippet' => 'Military Reservist Economic Injury Disaster Loan Program (MREIDL)',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/us-flags.jpg'
                        ),
                    ),
                ),
                array(
                    'title' => 'Do you need help with starting your business?',
                    'url' => '/search/site/*?f[0]=sm_field_program_company_size:Small/Medium%20(1-500%20employees)&f[1]=sm_field_program_comp_maturity:Pre-Startup&f[2]=sm_field_program_comp_maturity:Startup&f[3]=sm_field_program_owner_share:Veteran&f[4]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'Veteranscorp',
                            'url' => '/program/veteranscorp',
                            'snippet' => 'Veteranscorp',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/us-flag-man.jpg'
                        ),
                        array(
                            'title' => 'Veterans Business Outreach Program (VBOP)',
                            'url' => '/program/veterans-business-outreach-program-vbop',
                            'snippet' => 'Veterans Business Outreach Program (VBOP)',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/shake-mil.jpg'
                        ),
                    ),
                ),
                array(
                    'title' => 'Do you need help finding resources that assist veterans in doing business with Federal Agencies?',
                    'url' => '/search/site/government/?f[0]=sm_field_program_owner_share:Veteran',
                    'blocks' => array(
                        array(
                            'title' => 'Veteran-Owned Businesses',
                            'url' => '/program/veteran-owned-businesses',
                            'snippet' => 'Veteran-Owned Businesses',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/us-flag-photobombs-man.jpg'
                        ),
                        array(
                            'title' => 'Center for Veterans Enterprise (CVE)',
                            'url' => '/program/center-veterans-enterprise-cve',
                            'snippet' => 'Center for Veterans Enterprise (CVE)',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/us-flag-skyscraper.jpg'
                        ),
                    ),
                ),
            ),
            'foot' => array(
                'title' => 'Customize results based on your situation',
                'blocks' => array(
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/vetrans_1.jpg',
                        'url' => '/search/site/*?f[0]=sm_field_program_loc:Rural&f[1]=sm_field_program_owner_share:Veteran&f[2]=bundle%3Aprogram',
                        'title' => 'Show Programs for rural businesses',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/vetrans_2.jpg',
                        'url' => '/search/site/*?f%5B0%5D=sm_field_program_owner_share%3AMinority&f%5B1%5D=sm_field_program_owner_share%3AVeteran&f%5B2%5D=sm_field_program_owner_share%3AWoman&f[3]=bundle%3Aprogram',
                        'title' => 'Show Programs for Women and Minority business owners',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/vetrans_3.jpg',
                        'url' => '/search/site/*?f%5B0%5D=sm_field_program_owner_share%3AVeteran&f[1]=bundle%3Aprogram',
                        'title' => 'Show Programs for Veterans',
                    ),
                )
            ),
            'subnav_header_links'=>array(
                array(
                    "text"=>"Hiring Wizard",
                    "link"=>"/jobcenter-wizard",
                ),
                array(
                    "text"=>"Find Opportunities",
                    "link"=>"/find-opportunities",
                ),
                array(
                    "text"=>"Starting A Business",
                    "link"=>"/start-a-business",
                ),
            )
        )
    );