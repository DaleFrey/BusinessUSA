<?php

    print theme(
        'legacy_swimlane_page',
        array(
            'sections' => array(
                array(
                    'title' => 'Are you searching for a Federal grant?',
                    'url' => '/search/site/grants/?f[0]=sm_field_program_wizard_type:Contracting',
                    'blocks' => array(
                        array(
                            'title' => 'Grants.gov',
                            'url' => '/tools/grantsgov',
                            'snippet' => 'Grants.gov offers help with finding and applying for federal grants.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/grantsgov.jpg'
                        ),
                        array(
                            'title' => 'SBIR / STTR Grants',
                            'url' => '/program/small-business-innovation-research-and-small-business-technology-transfer-programs',
                            'snippet' => 'Small business and non-profit research institution grants for technology research and development.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/sbirsttr.jpg'
                        ),
                    ),
                ),
                array(
                    'title' => 'Do you need help with Federal contracting?',
                    'url' => '/search/site/opportunities%20contract%20ccr/?f[0]=sm_field_program_wizard_type:Contracting',
                    'blocks' => array(
                        array(
                            'title' => 'System for Award Management',
                            'url' => '/service/system-award-management-sam',
                            'snippet' => 'Vendors must register here to be awarded contracts and grants by the federal government.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/peons.jpg'
                        ),
                        array(
                            'title' => 'GSA Schedules Program',
                            'url' => '/program/gsa-schedules-program',
                            'snippet' => 'The GSA Schedules Program aids vendors in being successful in the government marketplace. Particularly, the GSA Schedules program has a strong record of small business achievement.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/gsa.jpg'
                        ),
                        array(
                            'title' => 'Minority/Disadvantaged Business Certification and Development Program',
                            'url' => '/program/minoritydisadvantaged-business-certification-and-development-program',
                            'snippet' => 'Government contracting certification and business development assistance program.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/handshake-columns.jpg'
                        ),
                        array(
                            'title' => 'Offices of Small and Disadvantaged Business Utilization',
                            'url' => '/program/department-commerce-office-small-and-disadvantaged-business-utilization',
                            'snippet' => 'Government advocacy designed to increase awards to small and disadvantaged businesses.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/prof-woman.jpg'
                        ),
                        array(
                            'title' => 'Procurement Tech. Assistance Centers',
                            'url' => '/program/procurement-technical-assistance-centers',
                            'snippet' => 'A nationwide network of professionals helping local businesses compete in the government marketplace.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/aptac.jpg'
                        ),
                        array(
                            'title' => 'Federal Business Opportunities',
                            'url' => '/tools/federal-business-opportunities-fedbizoppsgov',
                            'snippet' => 'A webportal that allows vendors to search, monitor and review Federal business opportunities.',
                            'img' => '/sites/all/themes/bizusa/images/swimlane-related/fbo.jpg'
                        ),
                    ),
                ),
            ),
            'foot' => array(
                'title' => 'Customize results based on your situation',
                'blocks' => array(
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Find_opportunites_1.jpg',
                        'url' => '/search/site/*?f[0]=sm_field_program_wizard_type:Contracting&f[1]=sm_field_program_loc:Rural&f[2]=bundle%3Aprogram',
                        'title' => 'Show Programs for rural businesses',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Find_opportunites_2.jpg',
                        'url' => '/search/site/*?f[0]=sm_field_program_wizard_type%3AContracting&f%5B1%5D=sm_field_program_owner_share%3AVeteran&f[2]=bundle%3Aprogram',
                        'title' => 'Show Programs for Veterans',
                    ),
                    array(
                        'img' => '/sites/all/themes/bizusa/images/swim_lane_images/Find_opportunites_3.jpg',
                        'url' => '/search/site/*?f[0]=bundle:program&f[1]=sm_field_program_owner_share:Minority&f[2]=sm_field_program_owner_share:Woman&f[3]=bundle%3Aprogram',
                        'title' => 'Show Programs for Women and Minority business owners',
                    ),
                )
            ),
            'subnav_header_links'=>array(
                array(
                    "text"=>"Green Opportunities",
                    "link"=>"/find-green-opportunities",
                ),
                array(
                    "text"=>"Training Portal",
                    "link"=>"/training-materials-portal",
                ),
                array(
                    "text"=>"Access Financing",
                    "link"=>"/access-financing",
                ),
            )
        )
    );