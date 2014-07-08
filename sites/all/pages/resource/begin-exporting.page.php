<?php

    print theme(
        'legacy_swimlane_page',
        array(
            'sections' => array(
                array(
                    'title' => 'How do I know if my company is ready to export?',
                    'url' => '/search/site/exporting%20readiness/?f[0]=sm_field_program_wizard_type:Begin%20Exporting&f[1]=sm_field_program_needs:Connect%20to%20foreign%20buyers&f[2]=sm_field_program_needs:Training%20or%20Mentoring&f[3]=sm_field_program_exporting_matur:Thinking%20About&f[4]=sm_field_program_exporting_matur:Begin%20Exporting',
                    'blocks' => array(
                        array(
                            'title' => 'Export Business Planner',
                            'url' => '/tools/export-business-planner',
                            'snippet' => 'An export readiness and planning tool.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/pen-writing-on-paper.jpg'
                        ),
                        array(
                            'title' => 'Exporting Questionnaire',
                            'url' => '/tools/export-questionnaire',
                            'snippet' => 'Self assessment questionnaire and assistance guide.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/pen-and-paper.jpg'
                        )
                    ),
                ),
                array(
                    'title' => 'How do I find export training and counseling services?',
                    'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Begin%20Exporting&f[1]=sm_field_program_needs:Counseling&f[2]=sm_field_program_needs:Training%20or%20Mentoring&f[3]=sm_field_program_exporting_matur:Thinking%20About&f[4]=sm_field_program_exporting_matur:Begin%20Exporting&f[5]=bundle%3Aprogram',
                    'blocks' => array(
                        array(
                            'title' => 'Automated Export System',
                            'url' => '/tools/automated-export-system',
                            'snippet' => 'Electronic service for mandatory reporting of items exported from the United States.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/boxes.jpg'
                        ),
                        array(
                            'title' => 'Basic Guide to Exporting',
                            'url' => '/tools/basic-guide-exporting',
                            'snippet' => 'Answers to questions about how to establish and grow overseas markets.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/handshake-joes.jpg'
                        ),
                        array(
                            'title' => 'Small Business Development Centers',
                            'url' => '/program/small-business-development-centers',
                            'snippet' => 'SBDCs offer free business advice and low-cost training to existing and future entrepreneurs.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/monies.jpg'
                        ),
                        array(
                            'title' => 'SCORE Mentors',
                            'url' => '/program/score-small-business-mentors',
                            'snippet' => 'SCORE is a network of business leaders who volunteer as mentors to small businesses.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/warehouse.jpg'
                        )
                    ),
                ),
            ),
            'foot' => array(
                'title' => 'Customize results based on your situation',
                'blocks' => array(
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Begin_exporting_1.jpg',
                        'url' => '/search/site/agriculture/?f[0]=sm_field_program_wizard_type:Begin%20Exporting',
                        'title' => 'Show Programs for Agricultural Business Owners',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Begin_exporting_2.jpg',
                        'url' => '/search/site/%22trade%20lead%22%20partner%20%22Market%20Research%22/?f%5B0%5D=sm_field_program_wizard_type%3ABegin%20Exporting&f%5B1%5D=sm_field_program_exporting_matur%3AThinking%20About&f%5B2%5D=sm_field_program_exporting_matur%3ABegin%20Exporting',
                        'title' => 'Show Programs for Trade Leads',
                    ),
                )
            ),
            'subnav_header_links'=>array(
                array(
                    "text"=>"Expand exporting",
                    "link"=>"/expand-exporting",
                ),
                array(
                    "text"=>"Starting a business",
                    "link"=>"/start-a-business",
                ),
                array(
                    "text"=>"Access financing",
                    "link"=>"/access-financing",
                ),
            )
        )
    );