<?php
/**
 * @file
 * myusa_user_dashboard.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function myusa_user_dashboard_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'user_dashboard';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'User Dashboard';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '2';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['pager']['options']['tags']['first'] = '';
  $handler->display->display_options['pager']['options']['tags']['previous'] = '<';
  $handler->display->display_options['pager']['options']['tags']['next'] = '>';
  $handler->display->display_options['pager']['options']['tags']['last'] = '';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Address Line 1 */
  $handler->display->display_options['fields']['field_address_line_1']['id'] = 'field_address_line_1';
  $handler->display->display_options['fields']['field_address_line_1']['table'] = 'field_data_field_address_line_1';
  $handler->display->display_options['fields']['field_address_line_1']['field'] = 'field_address_line_1';
  /* Field: Content: City */
  $handler->display->display_options['fields']['field_appoffice_city']['id'] = 'field_appoffice_city';
  $handler->display->display_options['fields']['field_appoffice_city']['table'] = 'field_data_field_appoffice_city';
  $handler->display->display_options['fields']['field_appoffice_city']['field'] = 'field_appoffice_city';
  /* Field: Content: Location Name */
  $handler->display->display_options['fields']['field_appoffice_loc_name']['id'] = 'field_appoffice_loc_name';
  $handler->display->display_options['fields']['field_appoffice_loc_name']['table'] = 'field_data_field_appoffice_loc_name';
  $handler->display->display_options['fields']['field_appoffice_loc_name']['field'] = 'field_appoffice_loc_name';
  /* Field: Content: Postal code */
  $handler->display->display_options['fields']['field_appoffice_postal_code']['id'] = 'field_appoffice_postal_code';
  $handler->display->display_options['fields']['field_appoffice_postal_code']['table'] = 'field_data_field_appoffice_postal_code';
  $handler->display->display_options['fields']['field_appoffice_postal_code']['field'] = 'field_appoffice_postal_code';
  /* Field: Content: State */
  $handler->display->display_options['fields']['field_appoffice_state']['id'] = 'field_appoffice_state';
  $handler->display->display_options['fields']['field_appoffice_state']['table'] = 'field_data_field_appoffice_state';
  $handler->display->display_options['fields']['field_appoffice_state']['field'] = 'field_appoffice_state';
  /* Field: Content: Street Address */
  $handler->display->display_options['fields']['field_appoffice_address']['id'] = 'field_appoffice_address';
  $handler->display->display_options['fields']['field_appoffice_address']['table'] = 'field_data_field_appoffice_address';
  $handler->display->display_options['fields']['field_appoffice_address']['field'] = 'field_appoffice_address';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;

  /* Display: Events */
  $handler = $view->new_display('block', 'Events', 'events');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['pager'] = FALSE;
  $handler->display->display_options['pager']['type'] = 'mini';
  $handler->display->display_options['pager']['options']['items_per_page'] = '3';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['pager']['options']['tags']['first'] = '';
  $handler->display->display_options['pager']['options']['tags']['previous'] = '<';
  $handler->display->display_options['pager']['options']['tags']['next'] = '>';
  $handler->display->display_options['pager']['options']['tags']['last'] = '';
  $handler->display->display_options['defaults']['header'] = FALSE;
  /* Header: Global: Text area */
  $handler->display->display_options['header']['area']['id'] = 'area';
  $handler->display->display_options['header']['area']['table'] = 'views';
  $handler->display->display_options['header']['area']['field'] = 'area';
  $handler->display->display_options['header']['area']['content'] = '<!-- The following markup is stored inside this Views header -->
<div class="userdashboard-events-header">
    <img class="userdashboard-events-eventmagnifyingglass" src="/sites/all/themes/bususa/images/event-magnifyingglass.png" />
    <div class="userdashboard-events-my-events-and-resources">
        My Events & Resources
    </div>
</div>';
  $handler->display->display_options['header']['area']['format'] = 'php_code';
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Footer: Global: Text area */
  $handler->display->display_options['footer']['area']['id'] = 'area';
  $handler->display->display_options['footer']['area']['table'] = 'views';
  $handler->display->display_options['footer']['area']['field'] = 'area';
  $handler->display->display_options['footer']['area']['content'] = '<script>
    jQuery(document).ready( function () {
        setTimeout( function () {
            jQuery(\'.counter-img-container.inject-image-in-me\').each( function () {
                var jqThis = jQuery(this);
                var thisCharCode = parseInt(jqThis.attr(\'counterval\'));
                if ( thisCharCode < 26) { 
                    thisCharCode = thisCharCode + 64; // Capital letter
                } else { 
                    thisCharCode = (thisCharCode - 26) + 97; // Lower case letter                    
                }
                var thisCharLetter = String.fromCharCode(thisCharCode);
                jqThis.html(\'<img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=\' + thisCharLetter + \'|F58819">\');
                jqThis.removeClass(\'inject-image-in-me\');
            });
        }, 100);
    });
</script>';
  $handler->display->display_options['footer']['area']['format'] = 'php_code';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Global: View result counter */
  $handler->display->display_options['fields']['counter']['id'] = 'counter';
  $handler->display->display_options['fields']['counter']['table'] = 'views';
  $handler->display->display_options['fields']['counter']['field'] = 'counter';
  $handler->display->display_options['fields']['counter']['label'] = '';
  $handler->display->display_options['fields']['counter']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['counter']['alter']['text'] = '<!-- We will expect jQuery run from the header/footer of this View to inject an image for this counter value -->
<span class="counter-img-container inject-image-in-me" counterval="[counter]"></span>';
  $handler->display->display_options['fields']['counter']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['counter']['counter_start'] = '1';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Event Date */
  $handler->display->display_options['fields']['field_event_date']['id'] = 'field_event_date';
  $handler->display->display_options['fields']['field_event_date']['table'] = 'field_data_field_event_date';
  $handler->display->display_options['fields']['field_event_date']['field'] = 'field_event_date';
  $handler->display->display_options['fields']['field_event_date']['label'] = '';
  $handler->display->display_options['fields']['field_event_date']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_date']['settings'] = array(
    'format_type' => 'shortter',
    'fromto' => 'both',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
  );
  /* Field: Content: Address Line 1 */
  $handler->display->display_options['fields']['field_event_address_1']['id'] = 'field_event_address_1';
  $handler->display->display_options['fields']['field_event_address_1']['table'] = 'field_data_field_event_address_1';
  $handler->display->display_options['fields']['field_event_address_1']['field'] = 'field_event_address_1';
  $handler->display->display_options['fields']['field_event_address_1']['label'] = '';
  $handler->display->display_options['fields']['field_event_address_1']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['field_event_address_1']['alter']['text'] = '[field_event_address_1-value], ';
  $handler->display->display_options['fields']['field_event_address_1']['element_label_colon'] = FALSE;
  /* Field: Content: City */
  $handler->display->display_options['fields']['field_event_city']['id'] = 'field_event_city';
  $handler->display->display_options['fields']['field_event_city']['table'] = 'field_data_field_event_city';
  $handler->display->display_options['fields']['field_event_city']['field'] = 'field_event_city';
  $handler->display->display_options['fields']['field_event_city']['label'] = '';
  $handler->display->display_options['fields']['field_event_city']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['field_event_city']['alter']['text'] = '[field_event_city-value], ';
  $handler->display->display_options['fields']['field_event_city']['element_label_colon'] = FALSE;
  /* Field: Content: State */
  $handler->display->display_options['fields']['field_event_state']['id'] = 'field_event_state';
  $handler->display->display_options['fields']['field_event_state']['table'] = 'field_data_field_event_state';
  $handler->display->display_options['fields']['field_event_state']['field'] = 'field_event_state';
  $handler->display->display_options['fields']['field_event_state']['label'] = '';
  $handler->display->display_options['fields']['field_event_state']['element_label_colon'] = FALSE;
  /* Field: Global: PHP */
  $handler->display->display_options['fields']['php']['id'] = 'php';
  $handler->display->display_options['fields']['php']['table'] = 'views';
  $handler->display->display_options['fields']['php']['field'] = 'php';
  $handler->display->display_options['fields']['php']['label'] = '';
  $handler->display->display_options['fields']['php']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['php']['use_php_setup'] = 0;
  $handler->display->display_options['fields']['php']['php_output'] = '<br/><br/>
<a href="/ical/<?php print $data->nid; ?>/calendar.ics" title="Export Event to Outlook format">
<img src="/sites/all/themes/bususa/images/outlook_cal.png" alt="Export Event to Outlook format" />
</a> &nbsp;&nbsp;

<?php
/*
	global $gcal_url, $ycal_url;

	//base calendar url
	$gcal_url = "https://www.google.com/calendar/render?action=TEMPLATE";
	$ycal_url = "http://calendar.yahoo.com/?v=60";

	//title parameter
	$gcal_url .= "&text=" . str_replace("\\"", "", $row->title);
	$ycal_url .= "&TITLE=" . str_replace("\\"", "", $row->title);

	//date parameter
	$sdate = $data->field_field_event_date_1[0][\'raw\'][\'value\'];
	$edate = $data->field_field_event_date_1[0][\'raw\'][\'value2\'];

	$content = $data->field_field_event_date_2[0][\'rendered\'][\'#markup\']; 
	preg_match("/<span\\b[^>]*>(.*?)<\\/span>/i", $content, $matches);
	$ysdate = date(\'Ymd\\THis\', strtotime($matches[1]));
		
	$content = $data->field_field_event_date_3[0][\'rendered\'][\'#markup\']; 
	preg_match("/<span\\b[^>]*>(.*?)<\\/span>/i", $content, $matches);
	$yedate = date(\'Ymd\\THis\', strtotime($matches[1]));
		
	$gcal_url .= "&dates=" . date(\'Ymd\\THis\\Z\', strtotime($sdate)) . \'/\' . date(\'Ymd\\THis\\Z\', strtotime($edate)); 
	$ycal_url .= "&ST=" . $ysdate . "&ET=" . $yedate;

	//website url
	$url = $GLOBALS[\'base_url\'] . \'/\' . drupal_lookup_path(\'alias\',"node/".$data->nid);
	$gcal_url .= "&sprop=website:". $url;
	$ycal_url .= "&URL=" . $url;

	//location
	if(!empty($data->field_field_event_address_1[0][\'raw\'][\'value\'])):
	  $location = $data->field_field_event_address_1[0][\'raw\'][\'value\'];
	endif;

	if(!empty($data->field_field_event_address_2[0][\'raw\'][\'value\'])):
	  $location .=  ", " . $data->field_field_event_address_2[0][\'raw\'][\'value\'];
	endif;

	if(!empty($data->field_field_event_city[0][\'raw\'][\'value\'])):
	  $location .=  ", " . $data->field_field_event_city[0][\'raw\'][\'value\'];
	endif;

	if(!empty($data->field_field_event_state[0][\'raw\'][\'value\'])):
	  $location .=  ", " . $data->field_field_event_state[0][\'raw\'][\'value\'];
	endif;

	if(!empty($data->field_field_event_zip[0][\'raw\'][\'value\'])):
	  $location .=  " - " . $data->field_field_event_zip[0][\'raw\'][\'value\'];
	endif;

	if(!empty($location)):
	   $gcal_url .= "&location=". trim($location);
	   $ycal_url .= "&in_loc=". trim($location);
	endif;

	//detail description
	if(!empty($data->field_field_event_detail_desc[0][\'raw\'][\'value\'])):
	    $desc = strip_tags(trim($data->field_field_event_detail_desc[0][\'raw\'][\'value\']));
		$pos = strpos($desc, \' \', 450);
		if ($pos !== false) {
			$desc = substr($desc, 0, $pos) . \'...\';
		}
		
		$gcal_url .= "&details=" . $desc;
		$ycal_url .= "&DESC=" . $desc;
	endif;
*/
?>


<a href="<?php  /* print $GLOBALS[\'gcal_url\']; */ ?>" title="Export Event to Google Calendar"><img src="/sites/all/themes/bususa/images/gcal.png" alt="Export Event to Google Calendar" /></a>
&nbsp;&nbsp;
<a href="<?php  /* print $GLOBALS[\'ycal_url\']; */ ?>" title="Export Event to Yahoo Calendar"><img src="/sites/all/themes/bususa/images/ycal.png" alt="Export Event to Yahoo Calendar" /></a>';
  $handler->display->display_options['fields']['php']['use_php_click_sortable'] = '0';
  $handler->display->display_options['fields']['php']['php_click_sortable'] = '';
  /* Field: Content: Latitude */
  $handler->display->display_options['fields']['field_event_latitude']['id'] = 'field_event_latitude';
  $handler->display->display_options['fields']['field_event_latitude']['table'] = 'field_data_field_event_latitude';
  $handler->display->display_options['fields']['field_event_latitude']['field'] = 'field_event_latitude';
  $handler->display->display_options['fields']['field_event_latitude']['label'] = '';
  $handler->display->display_options['fields']['field_event_latitude']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_event_latitude']['element_label_colon'] = FALSE;
  /* Field: Content: Longitude */
  $handler->display->display_options['fields']['field_event_longitude']['id'] = 'field_event_longitude';
  $handler->display->display_options['fields']['field_event_longitude']['table'] = 'field_data_field_event_longitude';
  $handler->display->display_options['fields']['field_event_longitude']['field'] = 'field_event_longitude';
  $handler->display->display_options['fields']['field_event_longitude']['label'] = '';
  $handler->display->display_options['fields']['field_event_longitude']['exclude'] = TRUE;
  $handler->display->display_options['fields']['field_event_longitude']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['sorts'] = FALSE;
  /* Sort criterion: Content: Event Date -  start date (field_event_date) */
  $handler->display->display_options['sorts']['field_event_date_value']['id'] = 'field_event_date_value';
  $handler->display->display_options['sorts']['field_event_date_value']['table'] = 'field_data_field_event_date';
  $handler->display->display_options['sorts']['field_event_date_value']['field'] = 'field_event_date_value';
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'event' => 'event',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Event Date -  start date (field_event_date) */
  $handler->display->display_options['filters']['field_event_date_value']['id'] = 'field_event_date_value';
  $handler->display->display_options['filters']['field_event_date_value']['table'] = 'field_data_field_event_date';
  $handler->display->display_options['filters']['field_event_date_value']['field'] = 'field_event_date_value';
  $handler->display->display_options['filters']['field_event_date_value']['operator'] = '>';
  $handler->display->display_options['filters']['field_event_date_value']['default_date'] = 'now';
  $handler->display->display_options['filters']['field_event_date_value']['year_range'] = '-0:+0';

  /* Display: Resource Centers */
  $handler = $view->new_display('block', 'Resource Centers', 'resource_centers');
  $handler->display->display_options['defaults']['hide_admin_links'] = FALSE;
  $handler->display->display_options['defaults']['header'] = FALSE;
  /* Header: Global: Text area */
  $handler->display->display_options['header']['area']['id'] = 'area';
  $handler->display->display_options['header']['area']['table'] = 'views';
  $handler->display->display_options['header']['area']['field'] = 'area';
  $handler->display->display_options['header']['area']['content'] = '<!-- The following markup is stored inside this Views header -->
<div class="userdashboard-resourceheader">
    <div class="userdashboard-resource-centers-near-you">
        Resource Centers Near You
    </div>
    <div class="userdashboard-within-50-miles-of-zip-code">
        (within 50 miles of zip code 20171)
    </div>
</div>';
  $handler->display->display_options['header']['area']['format'] = 'php_code';
  $handler->display->display_options['defaults']['footer'] = FALSE;
  /* Footer: Global: Text area */
  $handler->display->display_options['footer']['area']['id'] = 'area';
  $handler->display->display_options['footer']['area']['table'] = 'views';
  $handler->display->display_options['footer']['area']['field'] = 'area';
  $handler->display->display_options['footer']['area']['content'] = '<a href="http://business.usa.gov/geostrap-resource-centers-near-you">View All</a>';
  $handler->display->display_options['footer']['area']['format'] = 'full_html';
  $handler->display->display_options['defaults']['fields'] = FALSE;
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Street Address */
  $handler->display->display_options['fields']['field_appoffice_address']['id'] = 'field_appoffice_address';
  $handler->display->display_options['fields']['field_appoffice_address']['table'] = 'field_data_field_appoffice_address';
  $handler->display->display_options['fields']['field_appoffice_address']['field'] = 'field_appoffice_address';
  $handler->display->display_options['fields']['field_appoffice_address']['label'] = '';
  $handler->display->display_options['fields']['field_appoffice_address']['element_label_colon'] = FALSE;
  /* Field: Content: City */
  $handler->display->display_options['fields']['field_appoffice_city']['id'] = 'field_appoffice_city';
  $handler->display->display_options['fields']['field_appoffice_city']['table'] = 'field_data_field_appoffice_city';
  $handler->display->display_options['fields']['field_appoffice_city']['field'] = 'field_appoffice_city';
  $handler->display->display_options['fields']['field_appoffice_city']['label'] = '';
  $handler->display->display_options['fields']['field_appoffice_city']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['field_appoffice_city']['alter']['text'] = '[field_appoffice_city-value], ';
  $handler->display->display_options['fields']['field_appoffice_city']['element_label_colon'] = FALSE;
  /* Field: Content: State */
  $handler->display->display_options['fields']['field_appoffice_state']['id'] = 'field_appoffice_state';
  $handler->display->display_options['fields']['field_appoffice_state']['table'] = 'field_data_field_appoffice_state';
  $handler->display->display_options['fields']['field_appoffice_state']['field'] = 'field_appoffice_state';
  $handler->display->display_options['fields']['field_appoffice_state']['label'] = '';
  $handler->display->display_options['fields']['field_appoffice_state']['element_label_colon'] = FALSE;
  /* Field: Content: Postal code */
  $handler->display->display_options['fields']['field_appoffice_postal_code']['id'] = 'field_appoffice_postal_code';
  $handler->display->display_options['fields']['field_appoffice_postal_code']['table'] = 'field_data_field_appoffice_postal_code';
  $handler->display->display_options['fields']['field_appoffice_postal_code']['field'] = 'field_appoffice_postal_code';
  $handler->display->display_options['fields']['field_appoffice_postal_code']['label'] = '';
  $handler->display->display_options['fields']['field_appoffice_postal_code']['element_label_colon'] = FALSE;
  $handler->display->display_options['defaults']['filter_groups'] = FALSE;
  $handler->display->display_options['defaults']['filters'] = FALSE;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'appointment_office' => 'appointment_office',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  $export['user_dashboard'] = $view;

  return $export;
}
