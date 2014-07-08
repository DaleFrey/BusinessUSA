<?php
/*
    The purpose of this script is to define ParatureAPI functions in PHP.
*/

/* object createParatureArticle(string $articleTitle, string $articleBody, int $folderId, string $folderTitle)
*
* Creates an Article in the Parature system, under the given folder ID
*/
function createParatureArticle($articleTitle, $articleBody, $folderId, $folderTitle) {

    $token = 'GZTUH36TuANl/WpKHZRRhOu6/mjOkhVvh0PcRArcVHPMpadl4MnHzYaDm3Igl2GL/v3gfYMuMCqDaDHMVv5k0w==';
    $url = 'https://help.business.usa.gov/api/v1/30027/30030/Article?_token_=' . $token;
    $body = '
        <Article>
            <Question>' . $articleTitle . '</Question>
            <Answer>' . $articleBody . '</Answer>
            <Rating>0</Rating>
            <Folders>
                <ArticleFolder id="' . $folderId . '" uid="30027/30030/ArticleFolder/' . $folderId . '" href="http://help.business.usa.gov/api/v1/30027/30030/ArticleFolder/' . $folderId . '">
                    <Name display-name="Name">' . $folderTitle . '</Name>
                </ArticleFolder>
            </Folders>
            <Published>true</Published>
            <Permissions>
                <Sla id="1" uid="30027/30030/Sla/1" href="http://help.business.usa.gov/api/v1/30027/30030/Sla/1">
                    <Name display-name="Name">System Default</Name>
                </Sla>
            </Permissions>
        </Article>
    ';

    $httpReturn = drupal_http_request(
        $url, 
        array(
            'method' => 'POST',
            'data' => $body
        )
    );

    return $httpReturn;
}


/* array deleteParatureArticle(integer $articleId, boolean $permDelete)
*
* Unpublishes and deletes an Article in the Parature system
* Returns an array of objects. An array of responces from drupal_http_request()
*/
function deleteParatureArticle($articleId, $permDelete = false) {
    
    // Return buffer
    $ret = array();
    
    // Place this article into an "unpublish" status
    $token = 'GZTUH36TuANl/WpKHZRRhOu6/mjOkhVvh0PcRArcVHPMpadl4MnHzYaDm3Igl2GL/v3gfYMuMCqDaDHMVv5k0w==';
    $url = 'https://help.business.usa.gov/api/v1/30027/30030/Article/' . $articleId . '?_token_=' . $token . '&_purge_=false';
    $ret[] = drupal_http_request(
        $url, 
        array(
            'method' => 'DELETE'
        )
    );
    
    // Permanently delete this Article from the Parature system
    if ( $permDelete ) {
        $token = 'GZTUH36TuANl/WpKHZRRhOu6/mjOkhVvh0PcRArcVHPMpadl4MnHzYaDm3Igl2GL/v3gfYMuMCqDaDHMVv5k0w==';
        $url = 'https://help.business.usa.gov/api/v1/30027/30030/Article/' . $articleId . '?_token_=' . $token . '&_purge_=true';
        $ret[] = drupal_http_request(
            $url, 
            array(
                'method' => 'DELETE'
            )
        );
    }

    return $ret;
}

/* array createParatureFolder(string $articleName, string $articleDescription)
*
*  Create a new Folder in the Parature system.
*  NOTICE: After creating a Parature-folder, it may or may not be visible on help.business.usa.gov immediately, unless content is placed within the folder.  
*/
function createParatureFolder($articleName, $articleDescription) {

    $token = 'GZTUH36TuANl/WpKHZRRhOu6/mjOkhVvh0PcRArcVHPMpadl4MnHzYaDm3Igl2GL/v3gfYMuMCqDaDHMVv5k0w==';
    $url = 'https://help.business.usa.gov/api/v1/30027/30030/ArticleFolder?_token_=' . $token;
    $body = '
        <ArticleFolder>
            <Is_Private>false</Is_Private>
            <Description>' . $articleDescription . '</Description>   
            <Name>'.$articleName.'</Name>                          
            <Parent_Folder>
                <ArticleFolder id="1" />
            </Parent_Folder>
        </ArticleFolder>
    ';

    $httpReturn = drupal_http_request(
        $url,
        array(
            'method' => 'POST',
            'data' => $body
        )
    );

    return $httpReturn;
}
function getParatureUserID($email, $badChars){
    $url = PARATURE_BASE_URL . "/Customer/?_token_=" . TOKEN . "&_output_=json&Email=$email";
    $ret = drupal_http_request($url, array( 'method' => 'GET' ) );
    $user = json_decode(str_replace($badChars, '', $ret->data));
    return $user->Entities->Customer[0]->{'@id'};
}
function getParatureTickets($email, $badChars){
    $user_id = getParatureUserID($email, $badChars);
    $url = PARATURE_BASE_URL . "/Ticket/?_token_=" . TOKEN . "&_output_=json&Ticket_Customer_id_=$user_id&_fields_=26";
    $ret = drupal_http_request($url, array( 'method' => 'GET' ) );
    $tickets = json_decode(str_replace($badChars, '', $ret->data));
    return $tickets->Entities->Ticket;
}
