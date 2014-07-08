<?php
/**
 * Created by PhpStorm.
 * User: sanjay.gupta
 * Date: 6/12/14
 * Time: 10:53 AM
 */


$newnode = (object) array();
$newnode->type = "opportunity";




$newnode->title = strval($_POST['opportunitytitle']);


$newnode->field_agency_name = array(
    'und' => array(
        0 => array(
            'value' => $_POST['AgencyName'],
            'format' => null,
            'safe_value' => strval($_POST['AgencyName'])
        )
    )
);


$newnode->body = array(
    'und' => array(
        0 => array(
            'value' => $_POST['Synopsis'],
            'format' => null,
            'safe_value' => strval($_POST['Synopsis'])
        )
    )
);


$newnode->field_naics_code = array(
    'und' => array(
        0 => array(
            'value' => $_POST['NAICSCode'],
            'format' => null,
            'safe_value' => strval($_POST['NAICSCode'])//intval()
        )
    )
);


$newnode->field_response_deadline = array(
    'und' => array(
        0 => array(
            'value' => date('Y-m-d H:i:s', strtotime($_POST['Deadline'])),
            'timezone' => 'UTC',
            'timezone_db' => 'UTC',
            'safe_value' => strtotime($_POST['Deadline'])
        )
    )
);


$newnode->field_contract_award_date = array(
    'und' => array(
        0 => array(
            'value' => date('Y-m-d H:i:s', strtotime($_POST['AwardDate'])),
            'timezone' => 'UTC',
            'timezone_db' => 'UTC',
            'safe_value' => strtotime($_POST['AwardDate'])
        )
    )
);

$newnode->field_performance_state = array(
    'und' => array(
        0 => array(
            'value' => $_POST['statelist'],
            'format' => null,
            'safe_value' => strval($_POST['statelist'])
        )
    )
);
$newnode->field_performance_city = array(
    'und' => array(
        0 => array(
            'value' => $_POST['City'],
            'format' => null,
            'safe_value' => strval($_POST['City'])
        )
    )
);


$newnode->field_performance_county = array(
    'und' => array(
        0 => array(
            'value' => $_POST['County'],
            'format' => null,
            'safe_value' => strval($_POST['County'])
        )
    )
);
$newnode->field_performance_zip_code = array(
    'und' => array(
        0 => array(
            'value' => $_POST['Zipcode'],
            'format' => null,
            'safe_value' => strval($_POST['Zipcode'])
        )
    )
);

$newnode->field_agency_address = array(
    'und' => array(
        0 => array(
            'value' => $_POST['Address'],
            'format' => null,
            'safe_value' => strval($_POST['Address'])
        )
    )
);
$newnode->field_project_description = array(
    'und' => array(
        0 => array(
            'value' => $_POST['Description'],
            'format' => null,
            'safe_value' => strval($_POST['Description'])
        )
    )
);


$newnode->field_contact_person = array(
    'und' => array(
        0 => array(
            'value' => $_POST['ContactPerson'],
            'format' => null,
            'safe_value' => strval($_POST['ContactPerson'])
        )
    )
);
$newnode->field_contact_phone_number = array(
    'und' => array(
        0 => array(
            'value' => $_POST['PhoneNumber'],
            'format' => null,
            'safe_value' => strval($_POST['PhoneNumber'])
        )
    )
);

$newnode->field_contact_email = array(
    'und' => array(
        0 => array(
            'value' => $_POST['Email'],
            'format' => null,
            'safe_value' => strval($_POST['Email'])
        )
    )
);
$newnode->field_url_of_agency = array(
    'und' => array(
        0 => array(
            'value' => $_POST['AgencyURL'],
            'format' => null,
            'safe_value' => strval($_POST['AgencyURL'])
        )
    )
);

$newnode->field_reporting_requirements = array(
    'und' => array(
        0 => array(
            'value' => $_POST['Requirements'],
            'format' => null,
            'safe_value' => strval($_POST['Requirements'])
        )
    )
);
$newnode->field_special_site_conditions = array(
    'und' => array(
        0 => array(
            'value' => $_POST['SpecialConditions'],
            'format' => null,
            'safe_value' => strval($_POST['SpecialConditions'])
        )
    )
);

$newnode->field_notice_type = array(
    'und' => array(
        0 => array(
            'value' => $_POST['NoticeType'],
            'format' => null,
            'safe_value' => strval($_POST['NoticeType'])
        )
    )
);
$newnode->field_trades_required = array(
    'und' => array(
        0 => array(
            'value' => $_POST['TradeRequired'],
            'format' => null,
            'safe_value' => strval($_POST['TradeRequired'])
        )
    )
);

    if ($_POST['section3'] == 'section3')
        {
            $newnode->field_section_3_requirements = array(
                'und' => array(
                    0 => array(
                        'value' => 1,

                    )
                )
            );
            $newnode->field_specify_section_3_certific = array(
                'und' => array(
                    0 => array(
                        'value' => $_POST['section3yestext'],
                        'format' => null,
                        'safe_value' => strval($_POST['section3yestext'])
                    )
                )
            );
        }
    else
        {
            $newnode->field_section_3_requirements = array(
                'und' => array(
                    0 => array(
                        'value' => 0

                    )
                )
            );
        }


    if (($_POST['minoritywomen'] == 'minoritywomen'))
        {
            $newnode->field_m_w_dbe_requirements_apply = array(
                'und' => array(
                    0 => array(
                        'value' => 1

                    )
                )
            );
            $newnode->field_specify_m_w_dbe_certificat = array(
                'und' => array(
                    0 => array(
                        'value' => $_POST['minorityyestext'],
                        'format' => null,
                        'safe_value' => strval($_POST['minorityyestext'])
                    )
                )
            );
        }
    else
        {
            $newnode->field_m_w_dbe_requirements_apply = array(
                'und' => array(
                    0 => array(
                        'value' => 0,

                    )
                )
            );
        }


$node_id = '';

if (isset($newnode->title))
{
    node_save( $newnode );
    $node_id = $newnode->nid;
}





if (isset($node_id))
{
    $serverprotocol = ($is_https ? 'https://' : 'http://'). $_SERVER['SERVER_NAME']. "/fboopen-widget/fboopen-search?input=&data_source=&naics=&parent_only=&p=";

    $anchorurl = "<a href=\"$serverprotocol\". target=\"_self\"".">FBO Open</a>";

    print "Your form has been successfully submitted! You should be able to see your posting within 24 hours.
    You can see the opportunity posted at ". $anchorurl ." on BusinessUSA.";
}
else
{
    print "Error while creating opportunity, please try again.";
}

?>
