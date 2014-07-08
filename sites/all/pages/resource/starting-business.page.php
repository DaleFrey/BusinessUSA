<?php

    print theme(
        'legacy_swimlane_page',
        array(
            'sections' => array(
                array(
                    'title' => 'Do you need help with financing a business?',
                    'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Start%20a%20Business&f[1]=sm_field_program_needs:Financing&f[2]=sm_field_program_company_size:Small/Medium%20(1-500%20employees)&f[3]=sm_field_program_comp_maturity:Startup&f[4]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'General Small Business Loan',
                            'url' => '/program/general-small-business-loan',
                            'snippet' => 'The general small business, or 7(a) Loan program, helps start-up and existing businesses with financing for a variety of purposes.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/discuss.jpg'
                        ),
                        array(
                            'title' => 'Microloan',
                            'url' => '/program/microloan',
                            'snippet' => 'Provides small, short-term loans to small businesses.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/prof-asian-woman.jpg'
                        )
                    ),
                ),
                array(
                    'title' => 'Do you need help with writing a business plan?',
                    'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Start%20a%20Business&f[1]=sm_field_program_needs:Training%20or%20Mentoring&f[2]=sm_field_program_company_size:Small/Medium%20(1-500%20employees)&f[3]=sm_field_program_comp_maturity:Startup&f[4]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'SBA Online Training',
                            'url' => '/program/small-business-online-training',
                            'snippet' => 'Interactive small business training including online courses, workshops, calculators, and business-readiness assessments.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/business-plan.jpg'
                        ),
                        array(
                            'title' => 'SCORE Mentors',
                            'url' => '/program/score-small-business-mentors',
                            'snippet' => 'SCORE is a network of business leaders who volunteer as mentors to small businesses.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/study-square.jpg'
                        )
                    ),
                ),
                array(
                    'title' => 'Do you need help with registering and running your business?',
                    'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Start%20a%20Business&f[1]=sm_field_program_needs:Marketing&f[2]=sm_field_program_needs:Process%20Improvements&f[3]=sm_field_program_needs:Regulations&f[4]=sm_field_program_company_size:Small/Medium%20(1-500%20employees)&f[5]=sm_field_program_comp_maturity:Startup&f[6]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'Small Business Development Centers',
                            'url' => '/program/small-business-development-centers',
                            'snippet' => 'SBDCs offer free business advice and low-cost training to existing and future entrepreneurs.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/pen-and-paper.jpg'
                        ),
                        array(
                            'title' => 'SBA Online Community',
                            'url' => '/program/small-business-administration-online-community',
                            'snippet' => 'SBA\'s online community allows small business owners to discuss information and share experiences.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/profs.jpg'
                        )
                    ),
                ),
            ),
            'foot' => array(
                'title' => 'Customize results based on your situation',
                'blocks' => array(
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/start_a_Business1.jpg',
                        'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Start%20a%20Business&f[1]=sm_field_program_company_size:Small/Medium%20(1-500%20employees)&f[2]=sm_field_program_comp_maturity:Startup&f[3]=bundle%3Aprogram',
                        'title' => 'Show Programs for web-based businesses',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/start_a_Business2.jpg',
                        'url' => '/search/site/?f[0]=bundle:program&f[1]=sm_field_program_owner_share:Minority&f[2]=sm_field_program_owner_share:Woman',
                        'title' => 'Show Programs for rural businesses',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/start_a_Business3.jpg',
                        'url' => '/search/site/*?f[0]=bundle:program&f[1]=sm_field_program_owner_share:Minority&f[2]=sm_field_program_owner_share:Woman',
                        'title' => 'Show Programs for Women and Minority business owners',
                    ),
                    /*array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/us-flag.jpg',
                        'url' => 'http://business.usa.gov/search/site/*?f[0]=bundle:program&f[1]=sm_field_program_owner_share:Veteran',
                        'title' => 'Show Programs for Veterans',
                    ),*/
                )
            ),
            'subnav_header_links'=>array(
                array(
                    "text"=>"Grow Your Business",
                    "link"=>"/resource/grow-your-business",
                ),
                array(
                    "text"=>"Hiring Wizard",
                    "link"=>"/jobcenter-wizard",
                ),
                array(
                    "text"=>"Access Financing",
                    "link"=>"/access-financing",
                ),
            )
        )
    );