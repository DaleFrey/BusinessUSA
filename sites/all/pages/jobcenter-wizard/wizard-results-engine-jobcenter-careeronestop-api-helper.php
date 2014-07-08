<?php

global $careerOneStopUserId;
$careerOneStopUserId = 'ZWzUTkTcUvUSesX';

/**
    array/false careerOneStopAPI_findOccupationCodesByKeyword(string)
    Example: careerOneStopAPI_findOccupationCodesByKeyword('Information Technology')
 */
function careerOneStopAPI_findOccupationCodesByKeyword($searchTerm) {
    
    global $careerOneStopUserId;
    
    // Determin the API URL to pull information from
    $searchTerm = str_replace(' ', '%20', $searchTerm);
    $url = "http://webservices.myskillsmyfuture.org/Occupation.svc/occupationsbykeyword/userid/$careerOneStopUserId/keyword/$searchTerm/limit/10";
    $xml = file_get_contents($url);
    $xmlData = simplexml_load_string($xml);
    $xmlArray = objectsIntoArray($xmlData);
    
    if ( empty($xmlArray['OccupationList']['Occupation']) ) {
        return false;
    } else {
        return $xmlArray['OccupationList']['Occupation'];
    }
}

/**
    array/false careerOneStopAPI_GetOccupationSummary($occupationCode, $zipCode)
    
    Association: Row 5
    Example: careerOneStopAPI_GetOccupationSummary(29114100, 20171, 100)
 */
function careerOneStopAPI_GetOccupationSummary($occupationCode, $zipCode, $radius = 100) {
    
    global $careerOneStopUserId;
    
    // Determin the API URL to pull information from
    $url = 'http://webservices.myskillsmyfuture.org/Occupation.svc/occupation'; // base api url
    $url .= "/userid/$careerOneStopUserId"; // api user id
    $url .= "/onetcode/$occupationCode/location/$zipCode/radius/$radius"; // parameters
    
    $xml = file_get_contents($url);
    $xmlData = simplexml_load_string($xml);
    $xmlArray = objectsIntoArray($xmlData);
    
    if ( empty($xmlArray['OccupationList']['Occupation']) ) {
        return false;
    } else {
        return $xmlArray['OccupationList']['Occupation'];
    }
}

/**
    array careerOneStopAPI_IdentifySkillAndKnowledgeGapsBetween2Occupations($currentoccupation, $targetoccupation, $location, $radius = 100)
    
    API: Identify Skill and Knowledge Gaps between 2 occupations
    Association: Row 6
    Association: Row 37
    Example: careerOneStopAPI_IdentifySkillAndKnowledgeGapsBetween2Occupations(47215202, 47211100, 20171, 100)
 */
function careerOneStopAPI_IdentifySkillAndKnowledgeGapsBetween2Occupations($currentoccupation, $targetoccupation, $location, $radius = 100) {
    
    global $careerOneStopUserId;
    
    // Determin the API URL to pull information from
    $url = 'http://webservices.myskillsmyfuture.org/SkillsGap.svc/skillsgap'; // base api url
    $url .= "/userid/$careerOneStopUserId"; // api user id
    $url .= "/currentoccupation/$currentoccupation/targetoccupation/$targetoccupation/location/$location/radius/$radius"; // parameters
    
    $xml = file_get_contents($url);
    $xmlData = simplexml_load_string($xml);
    $xmlArray = objectsIntoArray($xmlData);
    
    return $xmlArray;
}

/**
    array careerOneStopAPI_FindWagesForASelectedOccupation($occupationCode, $zipCode)
    
    API: Find wages for a selected occupation, within a selected state and metropolitan area
    Association: Row 7
    Example: careerOneStopAPI_FindWagesForASelectedOccupation(171011, 55104)
 */
function careerOneStopAPI_FindWagesForASelectedOccupation($soccode, $zip) {
    
    global $careerOneStopUserId;

    return CereerOneStopSOAP(
        'http://www.careerinfonet.org/webservices/OccWages_WebService/OccWagesService.asmx',
        'GetWagesByZip',
        'http://www.careerinfonet.org/WebServices/OccWages_WebService/OccWagesService.asmx/GetWagesByZip',
        'http://www.careerinfonet.org/WebServices/OccWages_WebService/OccWagesService.asmx',
        array(
            'soccode' => strval($soccode),
            'zip' => strval($zip),
            'userID' => $careerOneStopUserId
        )
    );
}

/**
    array/false careerOneStopAPI_FindJobCentersNearZip(int, int)
    
    API: Find an American Job Center
    Association: Row 12
    Demo URL: http://www.careeronestop.org/WebService/demo.aspx?webservice=asl&method=byCityStateDistance&city=Fairfax&state=VA&distance=15
    Example: careerOneStopAPI_FindJobCentersNearZip(20171, 25)
 */
function careerOneStopAPI_FindJobCentersNearZip($zip = 20171, $range = 25) {
    $url = "http://webservices.careeronestop.org/CareerOneStops/CareerOnestops.svc/GetByZip/$zip/$range/userid/ZWzUTkTcUvUSesX";
    $xmlString = file_get_contents($url);
    if ($xmlString === false ) {
        return false;
    }
    $xmlObject = simplexml_load_string($xmlString);
    return objectsIntoArray($xmlObject);
}

/**
    array careerOneStopAPI_localSchoolsAndTrainingPrograms($keyword, $location, $radius = 50)
    
    API: Find Local Training Programs
    Association: Row 17
    Association: Row 41
    Demo URL: http://www.careeronestop.org/businesscenter/training/findtrainingprograms.aspx
    Example: careerOneStopAPI_localSchoolsAndTrainingPrograms('Information Technology', 20171)
 */
function careerOneStopAPI_localSchoolsAndTrainingPrograms($keyword, $location, $radius = 50) {

    // Load Excel helper functions library
    include_once('sites/all/libraries/PHPExcelHelper/phpexcel-helper-functions.php');
    
    $keyword = str_replace(' ', '%20', $keyword);
    $url = "http://www.careeronestop.org/app_handlers/DownloadResultsHandler.ashx?toolName=LocalTraining&fileFormat=Excel&pageUrl=/businesscenter/training/findtrainingprograms.aspx?keyword=$keyword~location=$location~radius=$radius~post=y&toolMode=&compName=~MAIN~Training_Dynamic";

    $excelFilePath = 'sites/default/files/cos-processing-excel.xls';
    
    // Use CURL instead of file_get_contents(), because that fails for some reason? mind = blown
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
    $excelFileData = curl_exec($ch);
    
    file_put_contents($excelFilePath, $excelFileData);
    $data = excelToArray($excelFilePath, 0, 3);
    kprint_r($data);
    // Clean up
    //@unlink($excelFilePath);
    
    return $data;
}

/**
    array careerOneStopAPI_FindProfessionalAssociations($keyword, $location, $radius = 50)
    
    API: Find Professional Associations
    Association: Row 18
    Demo URL: http://www.careeronestop.org/businesscenter/ProfessionalAssociations/find-professional-associations.aspx
    Example: careerOneStopAPI_FindProfessionalAssociations('Information Security Analysts')
 */
function careerOneStopAPI_FindProfessionalAssociations($keyword) {

    // Load Excel helper functions library
    include_once('sites/all/libraries/PHPExcelHelper/phpexcel-helper-functions.php');
    
    $keyword = urlencode($keyword);
    $url = "http://www.careeronestop.org/app_handlers/DownloadResultsHandler.ashx?toolName=ProfAssoc&fileFormat=Excel&pageUrl=/businesscenter/professionalassociations/find-professional-associations.aspx?keyword=$keyword&compName=~MAIN~ProfessionalAssociations_Dynamic";

    $excelFilePath = 'sites/default/files/cos-processing-excel.xls';
    
    $excelFileData = file_get_contents($url);
    file_put_contents($excelFilePath, $excelFileData);
    $data = excelToArray($excelFilePath, 0, 3);
    
    // Clean up
    @unlink($excelFilePath);
    
    return $data;
}

/**
    array careerOneStopAPI_CertificationFinder(?)
    
    API: Certification Finder
    Association: Row 41
    Demo URL: http://www.careeronestop.org/businesscenter/Certifications/certification-finder.aspx?keyword=information%20technology&direct=0
    Example: careerOneStopAPI_CertificationFinder('information technology')
 */
function careerOneStopAPI_CertificationFinder($keyword) {

    // Load Excel helper functions library
    include_once('sites/all/libraries/PHPExcelHelper/phpexcel-helper-functions.php');
    
    $keyword = urlencode($keyword);
    $url = "http://www.careeronestop.org/app_handlers/DownloadResultsHandler.ashx?toolName=CertFinder&fileFormat=Excel&pageUrl=/businesscenter/certifications/certification-finder.aspx?keyword=$keyword~direct=0&compName=~MAIN~CertificationFinder_Dynamic";

    $excelFilePath = 'sites/default/files/cos-processing-excel.xls';
    
    $excelFileData = file_get_contents($url);
    file_put_contents($excelFilePath, $excelFileData);
    $data = excelToArray($excelFilePath);
    
    // Clean up
    @unlink($excelFilePath);
    
    return $data;
}

function CereerOneStopSOAP($url, $action, $soapAction, $xmlns, $parameters) {

    $body = trim('
        <?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <' . $action . ' xmlns="' . $xmlns . '">
    ') . "\n";
    
    foreach ( $parameters as $parameter => $value ) {
        $body .= "<$parameter>$value</$parameter>\n";
    }
    
    $body .= trim('
            </' . $action . '>
          </soap:Body>
        </soap:Envelope>
    ');

    $headers = array( 
        'Host: www.careerinfonet.org',
        'Content-Type: text/xml; charset=utf-8', 
        'Content-Length: '. strlen($body), 
        'SOAPAction: "' . $soapAction . '"'
    ); 

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, strtolower($url)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body); 

    $dataString = curl_exec($ch);
    $dataString = str_replace('soap:', '', $dataString);
    $xmlData = simplexml_load_string($dataString);
    $xmlArray = objectsIntoArray($xmlData);
    
    return $xmlArray;
}

function objectsIntoArray($arrObjData, $arrSkipIndices = array())
{
    $arrData = array();
    
    // if input is object, convert into array
    if (is_object($arrObjData)) {
        $arrObjData = get_object_vars($arrObjData);
    }
    
    if (is_array($arrObjData)) {
        foreach ($arrObjData as $index => $value) {
            if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
            }
            if (in_array($index, $arrSkipIndices)) {
                continue;
            }
            $arrData[$index] = $value;
        }
    }
    return $arrData;
}

