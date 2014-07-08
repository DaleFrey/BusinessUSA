<?php
/**
 * Created by PhpStorm.
 * User: sanjay.gupta
 * Date: 6/16/14
 * Time: 10:19 AM
 */


if ($_GET['api_key'] != 'SkanASpxmKMSNmjtWRK4AQLtdnmk1088xLSdkk4')
{
    print "<b>Please provide a valid API Key</b>";
    exit;
}


$queryParam = $_GET['param'];
$andorbool = '';
$conditiondesc = '';
$conditiontitle = '';
$emptyval = '';



$stringlength = strlen (trim($queryParam));

if ($stringlength == 0)
{
    $andorbool = '';
}
else
{


        if (strpos(strtolower(trim($queryParam)), 'and ') !== false)
        {

        $andorbool = 'and';
        $param = explode("and",strtolower(trim($queryParam)));
        //print_r($param);
        foreach($param as $par)
        {
            $vartitle = "(node.title like '%" . $par. "%') and ";
            $varbody = "(field_data_body.body_value like '%" .$par. "%') and ";
            $conditiontitle .= $vartitle;
            $conditiondesc .= $varbody;
        }
        $conditiontitle = substr($conditiontitle, 0, -4);
        $conditiondesc = substr($conditiondesc, 0, -4);
            $emptyval = ' AND ';
    }
    else
    {
        $andorbool = 'or';
        $param = explode(" ",strtolower(trim($queryParam)));

        if (sizeof($param) < 1)
        {
            $param = $queryParam;

        }

        foreach($param as $par)
        {
            $vartitle = "(node.title like '%" . $par. "%') or ";
            $varbody = "(field_data_body.body_value like '%" .$par. "%') or ";
            $conditiontitle .= $vartitle;
            $conditiondesc .= $varbody;
        }
        $conditiontitle = substr($conditiontitle, 0, -3);
        $conditiondesc = substr($conditiondesc, 0, -3);
        $emptyval = ' AND ';

    }
}






//One conditional part of the query as this is being used in 2 places
$QueryCondition = "FROM
{node} node
inner join field_data_field_agency_name on node.nid = field_data_field_agency_name.entity_id
inner join field_data_field_performance_zip_code on node.nid = field_data_field_performance_zip_code.entity_id
inner join field_data_body on node.nid = field_data_body.entity_id
inner join field_data_field_response_deadline on node.nid = field_data_field_response_deadline.entity_id
inner join field_data_field_url_of_agency on node.nid = field_data_field_url_of_agency.entity_id
inner join field_data_field_contact_email on node.nid = field_data_field_contact_email.entity_id
inner join field_data_field_performance_state on node.nid = field_data_field_performance_state.entity_id
inner join field_data_field_performance_city on node.nid = field_data_field_performance_city.entity_id
inner join field_data_field_agency_address on node.nid = field_data_field_agency_address.entity_id
inner join field_data_field_contact_person on node.nid = field_data_field_contact_person.entity_id
inner join field_data_field_contact_phone_number on node.nid = field_data_field_contact_phone_number.entity_id
inner join field_data_field_performance_county on node.nid = field_data_field_performance_county.entity_id
inner join field_data_field_section_3_requirements on node.nid = field_data_field_section_3_requirements.entity_id
left join field_data_field_specify_section_3_certific on node.nid = field_data_field_specify_section_3_certific.entity_id
inner join field_data_field_m_w_dbe_requirements_apply on node.nid = field_data_field_m_w_dbe_requirements_apply.entity_id
left join field_data_field_specify_m_w_dbe_certificat on node.nid = field_data_field_specify_m_w_dbe_certificat.entity_id
inner join field_data_field_trades_required on node.nid = field_data_field_trades_required.entity_id
inner join field_data_field_project_description on node.nid = field_data_field_project_description.entity_id
inner join field_data_field_naics_code on node.nid = field_data_field_naics_code.entity_id
inner join field_data_field_notice_type on node.nid = field_data_field_notice_type.entity_id
inner join field_data_field_reporting_requirements on node.nid = field_data_field_reporting_requirements.entity_id
inner join field_data_field_special_site_conditions on node.nid = field_data_field_special_site_conditions.entity_id
WHERE (( (node.status = '1') AND (node.type IN  ('opportunity'))"
.$emptyval
.$conditiontitle . " " .$andorbool. " " . $conditiondesc.

"))";


//dsm($QueryCondition);



    $offset = $_GET['page'];

    if (isset($offset))
    {
        if ($offset == 0 or $offset == 1)
        {
            $offset = 0;
        }
        else
        {
            $offset = (intval($offset) - 1 ) ."0";
        }
    }
    else
    {
        $offset = 0;
    }



$result = db_query("SELECT node.title AS node_title, node.nid AS nid, node.created AS node_created,
field_data_field_agency_name.field_agency_name_value AS field_data_field_agency_name_node_entity_type, field_data_body.body_value AS field_data_body_node_entity_type,
'node' AS field_data_field_contract_award_date_node_entity_type, field_data_field_response_deadline.field_response_deadline_value AS field_data_field_response_deadline_node_entity_type,
field_data_field_url_of_agency.field_url_of_agency_value AS field_data_field_url_of_agency_node_entity_type,
'HUDS' AS field_data_field_source_node_entity_type,
field_data_field_contact_email.field_contact_email_value as field_data_field_contact_email,
field_data_field_performance_zip_code.field_performance_zip_code_value AS field_data_field_performance_zip_code_node_entity_type,
field_data_field_performance_state.field_performance_state_value AS field_data_field_performance_state_node_entity_type,
field_data_field_performance_city.field_performance_city_value AS field_data_field_performance_city_node_entity_type,
field_data_field_agency_address.field_agency_address_value AS field_data_field_agency_address_node_entity_type,
field_data_field_contact_person.field_contact_person_value AS field_data_field_contact_person_node_entity_type,
field_data_field_contact_phone_number.field_contact_phone_number_value AS field_data_field_contact_phone_number_node_entity_type,
field_data_field_performance_county.field_performance_county_value as field_data_field_performance_county_node_entity_type,
field_data_field_section_3_requirements.field_section_3_requirements_value as field_data_field_section_3_requirements_node_entity_type,
field_data_field_specify_section_3_certific.field_specify_section_3_certific_value as
field_data_field_specify_section_3_certific_node_entity_type,
field_data_field_m_w_dbe_requirements_apply.field_m_w_dbe_requirements_apply_value as
field_data_field_m_w_dbe_requirements_apply_node_entity_type,
field_data_field_specify_m_w_dbe_certificat.field_specify_m_w_dbe_certificat_value as
field_data_field_specify_m_w_dbe_certificat_node_entity_type,
field_data_field_trades_required.field_trades_required_value as field_data_field_trades_required_node_entity_type,
field_data_field_project_description.field_project_description_value as
field_data_field_project_description_node_entity_type,
field_data_field_naics_code.field_naics_code_value as field_data_field_naics_code_node_entity_type,
field_data_field_notice_type.field_notice_type_value as field_data_field_notice_type_node_entity_type,
field_data_field_reporting_requirements.field_reporting_requirements_value as
field_data_field_reporting_requirements_node_entity_type,
field_data_field_special_site_conditions.field_special_site_conditions_value as
field_data_field_special_site_conditions_node_entity_type
".$QueryCondition.
"ORDER BY node_created DESC
LIMIT 10 OFFSET ".$offset);

dsm($result);

$oppObj = array();
$emptyarr = array();

$myobj = array();
            foreach ($result as $record) {
                    // Perform operations on $record->title, etc. here.
                    // in this example the available data would be mapped to object properties:
                    // $record->nid, $record->title, $record->created

                    $myobj['data_type'] = 'opp';
                    $myobj['data_source'] = 'BUSA';
                    $myobj['notice_type'] = '';
                    $myobj['solnbr'] = $record->nid;
                    $myobj['solnbr_ci'] = $record->nid;
                    $myobj['id'] = $record->nid;
                    $myobj['posted_dt'] = date('Y-m-d H:i:s', $record->node_created);
                    $myobj['agency'] =  $record->field_data_field_agency_name_node_entity_type;
                    $myobj['office'] = '';
                    $myobj['zipcode'] = $record -> field_data_field_performance_zip_code_node_entity_type;
                    $myobj['title'] = $record->node_title;
                    $myobj['close_dt'] = $record->field_data_field_response_deadline_node_entity_type;
                    $myobj['description'] = $record->field_data_body_node_entity_type;
                    //$myobj['listing_url'] = $record->field_data_field_url_of_agency_node_entity_type;
                    $myobj['listing_url'] = "../node/".$record->nid;
                    $myobj['highlights'] = $emptyarr;
                    $myobj['contact'] = $record->field_data_field_contact_email;
                    $myobj['performance_state'] = $record->field_data_field_performance_state_node_entity_type;
                    $myobj['performance_city'] = $record->field_data_field_performance_city_node_entity_type;
                    $myobj['performance_county'] = $record->field_data_field_performance_county_node_entity_type;
                    $myobj['agency_address'] = $record->field_data_field_agency_address_node_entity_type;
                    $myobj['entity_source'] = $record->field_data_field_source_node_entity_type;
                    $myobj['contact_person'] = $record->field_data_field_contact_person_node_entity_type;
                    $myobj['phone_number'] = $record->field_data_field_contact_phone_number_node_entity_type;
                    $myobj['trades_required'] = $record->field_data_field_trades_required_node_entity_type;
                    $myobj['project_description'] = $record->field_data_field_project_description_node_entity_type;
                    $myobj['naics_code'] = $record->field_data_field_naics_code_node_entity_type;
                    $myobj['reporting_requirement'] = $record->field_data_field_reporting_requirements_node_entity_type;
                    $myobj['special_site_conditions'] = $record->field_data_field_special_site_conditions_node_entity_type;
                    $myobj['notice_type'] = $record->field_data_field_notice_type_node_entity_type;

                    if (intval($record->field_data_field_section_3_requirements_node_entity_type) == 0)
                    {
                        $myobj['section3_requirement'] = 'No';
                    }
                    else
                    {
                        $myobj['section3_requirement'] = 'Yes';
                        $myobj['section3_certifications'] = str_replace("\0", "",
                            $record->field_data_field_specify_section_3_certific_node_entity_type);
                    }


                    if (intval($record->field_data_field_m_w_dbe_requirements_apply_node_entity_type) == 0)
                    {
                        $myobj['minority_women_requirement'] = 'No';
                    }
                    else
                    {
                        $myobj['minority_women_requirement'] = 'Yes';
                        $myobj['minority_women_requirement_certifications'] = str_replace("\0", "",
                            $record->field_data_field_specify_m_w_dbe_certificat_node_entity_type);
                    }

                    if ($andorbool == 'or' )
                    {
                        $myobj['score'] = rand(20, 50);
                    }
                    else if ($andorbool == 'and')
                    {
                        $myobj['score'] = rand(40, 100);
                    }
                    else
                    {
                        $myobj['score'] = 100;
                    }

                    array_push($oppObj, $myobj);

            }

//Main JSON formation
$myjsonarray  = array();


            //to add the count to the JSON object
            $resultCount = db_query("SELECT count(*) as Count
            ".$QueryCondition);

            foreach($resultCount as $count)
            {
                $myjsonarray['numFound'] = intval($count->Count);

            }

$myjsonarray['start'] = intval($offset);
$myjsonarray['maxScore'] = 1;
$myjsonarray['docs']  = $oppObj;

$myfacets = array();

$myfbonaics = array();

/*$myfbonaics['111130'] = 0;
$myfbonaics['111421'] = 0;*/

/*$myfbonaics = array(
'111130' => 0,
 '111421' => 0
);*/



$mysource = array(

'BUSA' => $myjsonarray['numFound']);

$myfacets['data_source'] = $mysource;




$myjsonarray['facets'] = $myfacets;







print_r(drupal_json_encode($myjsonarray));
//return $myjsonarray;
exit;
?>