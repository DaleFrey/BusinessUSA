<?php
    print theme(
        'legacy_swimlane_page',
        array(
            'sections' => array(
                array(
                    'title' => 'Looking for help preparing your loan package?',
                    'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Finance&f[1]=sm_field_program_owner:NGO%20and%20Non-profits&f[2]=sm_field_program_owner_share:For%20Profit&f[3]=sm_field_program_owner_share:Independent%20Ownership&f[4]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'Small Business Development Centers',
                            'url' => '/program/small-business-development-centers',
                            'snippet' => 'Interactive small business training including online courses, workshops, calculators, and business-readiness assessments.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/prof-asian-woman.jpg'
                        ),
                        array(
                            'title' => 'SCORE Mentors',
                            'url' => '/program/score-small-business-mentors',
                            'snippet' => 'SCORE is a network of business leaders who volunteer as mentors to small businesses.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/study-square.jpg'
                        ),
                    ),
                ),
                array(
                    'title' => 'Looking for a special type of loan?',
                    'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Finance&f[1]=sm_field_program_owner:NGO%20and%20Non-profits&f[2]=sm_field_program_owner_share:For%20Profit&f[3]=sm_field_program_owner_share:Independent%20Ownership&f[4]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'CAPLines Working Capital Loan',
                            'url' => '/program/caplines-working-capital-loan',
                            'snippet' => 'CAPLines loans help meet short-term and cyclical working-capital needs.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/pen-and-paper.jpg'
                        ),
                        array(
                            'title' => 'Fixed Assets CDC/504 Loan',
                            'url' => '/program/fixed-assets-cdc504-loan',
                            'snippet' => 'Provides small businesses with long-term, fixed-rate financing for major fixed assets, such as land and buildings.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/money-writing.jpg'
                        ),
                    ),
                ),
                array(
                    'title' => 'Looking for a general loan?',
                    'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Finance&f[1]=sm_field_program_needs:Financing&f[2]=sm_field_program_needs:Sales&f[3]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'General Small Business Loan',
                            'url' => '/program/general-small-business-loan',
                            'snippet' => 'The general small business, or 7(a) Loan program, helps start-up and existing businesses with financing for a variety of purposes.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/discuss.jpg'
                        ),
                        array(
                            'title' => 'SBA Express Loan',
                            'url' => '/program/sba-express-loan',
                            'snippet' => 'SBA Express gives eligible small business borrowers an accelerated turnaround time for review.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/dudes.jpg'
                        ),
                    ),
                ),
            ),
            'foot' => array(
                'title' => 'Customize results based on your situation',
                'blocks' => array(
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Access_financing_1.jpg',
                        'url' => '/search/site/export%20finance/?f%5B0%5D=sm_field_program_wizard_type%3AFinance',
                        'title' => 'Show Financing Programs for exporters',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Access_financing_2.jpg',
                        'url' => '/search/site/finance%20disaster%20recovery/?f%5B0%5D=sm_field_program_wizard_type%3AFinance',
                        'title' => 'Show Financing Programs for businesses recovering from a disaster',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Access_financing_3.jpg',
                        'url' => '/search/site/finance%20growth%20industry/?f%5B0%5D=sm_field_program_wizard_type%3AFinance',
                        'title' => 'Show Financing Programs for high-growth and technology companies',
                    ),
                )
            ),
            'subnav_header_links'=>array(
                array(
                    "text"=>"Starting A Business",
                    "link"=>"/start-a-business",
                ),
                array(
                    "text"=>"Expand Exporting",
                    "link"=>"/expand-exporting",
                ),
                array(
                    "text"=>"Grow Your Business",
                    "link"=>"/resource/grow-your-business",
                ),
            )
        )
    );
 ?>