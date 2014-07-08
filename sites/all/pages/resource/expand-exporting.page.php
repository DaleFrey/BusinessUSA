<?php

    print theme(
        'legacy_swimlane_page',
        array(
            'sections' => array(
                array(
                    'title' => 'What if I run into a challenge?',
                    'url' => '/search/site/foreign%20buyers?f[0]=sm_field_program_wizard_type:Expand%20Exporting&f[1]=sm_field_program_needs:Financing&f[2]=sm_field_program_comp_maturity:Established&f[3]=sm_field_program_exporting_matur:Already%20Exporting',
                    'blocks' => array(
                        array(
                            'title' => 'Export Assistance Centers',
                            'url' => '/program/us-export-assistance-centers',
                            'snippet' => 'Provide frontline outreach and service operations for U.S. exporters.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/discuss.jpg'
                        ),
                        array(
                            'title' => 'Trade Compliance Center',
                            'url' => '/program/trade-compliance-center',
                            'snippet' => 'A one-stop shop for getting U.S. government assistance in resolving trade barriers or unfair situations encountered in foreign markets.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/prof-asian-woman.jpg'
                        )
                    ),
                ),
                array(
                    'title' => 'How do I finance exports?',
                    'url' => '/search/site/export/?f[0]=sm_field_program_wizard_type:Expand%20Exporting&f[1]=sm_field_program_needs:Financing&f[2]=sm_field_program_comp_maturity:Established&f[3]=sm_field_program_exporting_matur:Already%20Exporting',
                    'blocks' => array(
                        array(
                            'title' => 'Export Express Loan Program',
                            'url' => '/program/export-express-loan',
                            'snippet' => 'Loan guarantees ($500,000 or less) related to international trade.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/monies.jpg'
                        ),
                        array(
                            'title' => 'Export Credit Insurance',
                            'url' => '/program/export-credit-insurance',
                            'snippet' => 'Export credit insurance limits international risk, offers credit to international buyers, and enables access to working capital funds.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/business-plan.jpg'
                        )
                    ),
                ),
                array(
                    'title' => 'How do I find foreign buyers?',
                    'url' => '/search/site/connect%20to%20foreign%20buyers/?f[0]=sm_field_program_wizard_type:Expand%20Exporting&f[1]=sm_field_program_comp_maturity:Established&f[2]=sm_field_program_exporting_matur:Already%20Exporting',
                    'blocks' => array(
                        array(
                            'title' => 'International Markets Research',
                            'url' => '/service/international-markets-research',
                            'snippet' => 'Help to determine the potential for a product or service in an international market.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/flags.jpg'
                        ),
                        array(
                            'title' => 'International Business Matchmaking',
                            'url' => '/program/international-business-matchmaking',
                            'snippet' => 'Help businesses to identify, meet, and screen potential partners, agents, distributors, and customers.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/warehouse.jpg'
                        )
                    ),
                ),
                array(
                    'title' => 'How can I help international buyers get financing?',
                    'url' => '',
                    'blocks' => array(
                        array(
                            'title' => 'Loan Guarantees for International Buyers',
                            'url' => '/program/loan-guarantees-international-buyers',
                            'snippet' => 'Guaranteed term financing is available for creditworthy international buyers.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/study-square.jpg'
                        ),
                        array(
                            'title' => 'Export Credit Guarantee Programs',
                            'url' => '/program/export-credit-guarantee-programs',
                            'snippet' => 'Credit protection for U.S. agriculture exporters and U.S. banks from default by foreign banks.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/big-building.jpg'
                        )
                    ),
                ),
            ),
            'foot' => array(
                'title' => 'Customize results based on your situation',
                'blocks' => array(
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Expand_Exporting_1.jpg',
                        'url' => '/search/site/%22market%20research%22%20%20%22trade%20advocacy%22%20directory/?f%5B0%5D=sm_field_program_wizard_type%3AExpand%20Exporting&f%5B1%5D=sm_field_program_comp_maturity%3AEstablished&f%5B2%5D=sm_field_program_exporting_matur%3AAlready%20Exporting',
                        'title' => 'Show Programs for Market Research',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Expand_Exporting_2.jpg',
                        'url' => '/search/site/%22trade%20agreement%22%20zone/?f%5B0%5D=sm_field_program_wizard_type%3AExpand%20Exporting&f%5B1%5D=sm_field_program_comp_maturity%3AEstablished&f%5B2%5D=sm_field_program_exporting_matur%3AAlready%20Exporting',
                        'title' => 'Show Programs for Trade Agreements',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Expand_Exporting_3.jpg',
                        'url' => '/search/site/dairy%20food%20farmer/?f%5B0%5D=sm_field_program_wizard_type%3AExpand%20Exporting&f%5B1%5D=sm_field_program_comp_maturity%3AEstablished&f%5B2%5D=sm_field_program_exporting_matur%3AAlready%20Exporting',
                        'title' => 'Show Programs for Export Agriculture',
                    ),
                )
            ),
            'subnav_header_links'=>array(
                array(
                    "text"=>"Begin Exporting",
                    "link"=>"/begin-exporting",
                ),
                array(
                    "text"=>"Starting A Business",
                    "link"=>"/start-a-business",
                ),
                array(
                    "text"=>"Access Financing",
                    "link"=>"/access-financing",
                ),
            )
        )
    );