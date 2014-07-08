<?php

/**
 * Implements block_view_alter().
 * Adds events search filters, javascript to create array string, and manages showing previously selected elements
 * This is a bit tricky because we're using the apachesolr module to display the results and the url has to be
 * constructed in a particular way, so we have to hack the url slightly
 */
//forgive me, this was displaying twice and it was the only way I could get it to display once
//#hackadocious
global $count;
$count = 0;
hooks_reaction_add("block_view_alter",
	function (&$data, $block) {
        global $count;

        if($block->title === 'Events Filters'){
            $data['content'] = '';
            if($count){

                drupal_add_js('
                  <!-- rendersource - this is coming from /sites/all/modules/custom/hooks_reaction/reactions/Events-Search.php  -->
                  function createEventSearchString(skipFilters){
                        var search_string = "";
                        if(jQuery("#solr-search-events").val() == "Search Events"){
                            //jQuery("#event-search-error").text("Please enter a search term");
                            //jQuery("#solr-search-events").val("").focus();
                            search_string =  "";
                            //return;
                        }
                        else {
                          search_string =  encodeURIComponent(jQuery("#solr-search-events").val());
                        }

                        if (skipFilters) {
                          event_search_string = "/events/" + search_string + "?" + "f[0]=bundle%3Aevent&";
                        }
                        else {
                          if (jQuery("#edit-date-filter-min-date").val()) {
                            var start_date = new Date(jQuery("#edit-date-filter-min-date").val()),
                            month = start_date.getMonth() + 1;
                            full_start_date = start_date.getFullYear() + "-" + month + "-" + start_date.getDate() + "T00%3A00%3A00Z";

                            // Set a default end date
                            if (jQuery("#edit-date-filter-max-date").val()) {
                              var end_date = new Date(jQuery("#edit-date-filter-max-date").val());
                              month = parseInt(end_date.getMonth()) + 1;
                            }
                            else {
                              var end_date = new Date(jQuery("#edit-date-filter-min-date").val());
                              month = parseInt(end_date.getMonth()) + 2;
                            }
                            full_end_date = end_date.getFullYear() + "-" + month + "-" + end_date.getDate() +"T23%3A59%3A59Z";

                            if(end_date < start_date){
                                jQuery("#event-search-error").text("Please enter a start date that comes before the end date.");
                                return;
                            }

                            //This will keep track of the number of variables in the search string - f[0], f[1], etc
                            //we start at 2 because we are hardcoding the bundle to be event and the date range
                            var field_num = 2;
                            event_search_string = "/events/" + search_string + "?" + "f[0]=bundle%3Aevent&" +
                                "f[1]=dm_field_event_date%3A[" + full_start_date + " TO " + full_end_date + "]&";
                          }
                          else {
                            //This will keep track of the number of variables in the search string - f[0], f[1], etc
                            //we start at 1 because we are not hardcoding the bundle to be event and the date range
                            var field_num = 1;
                            event_search_string = "/events/" + search_string + "?" + "f[0]=bundle%3Aevent&";
                          }


                          fields_for_url = {"field_program_org_tht_owns_prog_value":"sm_field_program_org_tht_owns_pr",
                                "field_program_industry_value":"sm_field_program_industry",
                                "field_event_state_value":"sm_field_event_state",
                                "field_event_type_value":"ts_field_event_type"};
                          checked_boxes = "";
                          for(var field_name in fields_for_url){
                            checked_boxes = "#edit-field-" + field_name.replace(/_/g, "-") + ":checked";
                            jQuery(checked_boxes).each(function(){
                                event_search_string += "f[" + field_num + "]=" + fields_for_url[field_name] + "%3A" +
                                    encodeURIComponent(jQuery(this).val()) + "&";
                                field_num++;

                            });
                          }
                        }
                        consoleLog(event_search_string);
                        window.location.href = event_search_string;
                  }//end function createEventSearchString
                  jQuery("document").ready(function() {
                      jQuery(".bef-datepicker").datepicker().attr("readonly","readonly");
                      // I can\'t find the collapse call.
                      jQuery("#edit-date-filter-wrapper a")[0].click();
                  });
                ', array('weight' => 100, 'type' => 'inline', 'group' => JS_THEME));
               $search_string = str_replace("/events/", "", $_SERVER['REDIRECT_URL']);
               $data['content'] = create_event_search_filters($_SERVER['REDIRECT_QUERY_STRING'], $search_string);
           }//end if !data->content
           $count++;
        }//end if($count)
  }//end hooks reaction function
);//end hooks reaction add
hooks_reaction_add("apachesolr_query_prepare",
    function ($query) {
        if(current_path() == 'events'){
          $detect_filter = $query->getFilters('dm_field_event_date');
          if (empty($detect_filter)) {
            $query->addFilter('ds_field_event_date','[NOW TO *]');
          }
          $query->setSolrsort('ds_field_event_date', 'asc');
          $query->setAvailableSort('ds_field_event_date', array(
            'title' => t('Event Date Sort'),
            'default' => 'asc',
          ));
        }
    }
);//end hooks reaction add

function create_event_search_filters($url, $search_string){

    if(!$search_string || $search_string == '/events') $search_string = 'Search Events';
    /************************************************************************************************************************************/
    //This is all necessary because the solr module needs the url string in a specific way:
    //i.e. /events/forum?f[0]=bundle%3Aevent&f[1]=dm_field_event_date%3A[2014-5-22T00%3A00%3A00Z%20TO%202015-5-22T00%3A00%3A00Z]...***/
    //So, we have to take the url and parse it accordingly to get the values the user selected, then construct the filters
    //with those values properly selected - if I had to do this again, I would just do an ajax call to solr directly,
    //I ran out of time, so this is what we're stuck with for now
    /************************************************************************************************************************************/
    $selected_filters = explode('&', rtrim($url, '&'));
    //if the first thing is the page number, remove it from the array, this does not concern us
    if (strpos($selected_filters[0],'page') !== false) array_shift($selected_filters);
    //remove bundle from the array as we are hard coding this onto the url with javascript
    array_shift($selected_filters);

    $next_piece = array_shift($selected_filters);
    if (stripos($next_piece, 'TO%20') !== FALSE) {
      //the next element is the date range, remove some text, explode it, then get the dates
      $date_replacements = array( 'f[1]=', 'T00%3A00%3A00Z%20', 'T00%3A00%3A00Z', 'dm_field_event_date', ']', '%3A%5B', '%5D', '%3A['  );
      $date_string = explode('TO%20', str_replace($date_replacements, '', $next_piece));
      $start_date = $date_string[0];
      $end_date = preg_replace('/T.*Z/', '', $date_string[1]);
    }
    else {
      array_unshift($selected_filters, $next_piece);
    }

    if (!$start_date) {
      // Black default start.
      $start_date = '';
    }
    else {
        $start_date = new DateTime($start_date);
        $start_date = $start_date->format('m/d/Y');
    }
    if (!$end_date) {
      // Black default date.
      $end_date =  '';
    }
    else {
        $end_date = new DateTime($end_date);
        $end_date = $end_date->format('m/d/Y');
    }
    //for the remaining items that the user selected for their search, construct an array where each key is the field name
    //i.e. 'sm_field_program_org_tht_owns_pr', and the value of that key is an array of the terms that user selected.
    //This will allow us to properly select the items the user chose while constructing our filters
    foreach($selected_filters as $filter){
        $filter = preg_replace('/^f.*=/', '', $filter);
        $filter = explode('%3A', $filter);
        $field_name = $filter[0];
        $value = urldecode($filter[1]);
        $filters_to_select[$field_name][] = $value;
    }
    drupal_add_js("sites/all/modules/contrib/jquery_update/replace/ui/ui/minified/jquery-ui.min.js", 'file');
    echo "<form action='/events' method='get' id='form-events-listings-and-filters' accept-charset='UTF-8'>";
    echo "<div id='event-search-error'></div>";
    echo "<div id='event-search-filters'>";
    echo "<div id='events-text-search'>
             <input type='text' id='solr-search-events' name='search-events' value='$search_string' onfocus='jQuery(\"#solr-search-events\").val(\"\");'>
             <input type='button' value='Search' onclick='createEventSearchString(true);'>
             <script>
             jQuery('#events-text-search input[type=\"text\"]').keyup(function(event){
                  if(event.keyCode == 13){
                      jQuery('#events-text-search input[type=\"button\"]').click();
                  }
              });
             </script>
          </div>";

    echo "<div id='edit-date-filter-wrapper' class='filter-date_filter'>
             <a href='#' class='accordion-header'>Event Date</a>
             <div id='date-filter'>
                 <div id='clear-event-dates'>
                    <a href='#' onClick='jQuery(\"#edit-date-filter-min-date\").val(\"\"); jQuery(\"#edit-date-filter-max-date\").val(\"\"); return false;'>Clear Dates</a>
                 </div>
                 <div id='edit-date-filter-min'>
                    <label for='edit-date-filter-min'>Start date </label>
                    <div id='edit-date-filter-min' class='date-padding'>
                       <div class='date-date'>
                            <input class='bef-datepicker form-text' type='text' id='edit-date-filter-min-date' name='date_filter[min][date]' value='$start_date' size='60' maxlength='128' /><br />
                       </div>
                    </div>
                 </div>
                 <div id='edit-date-filter-max'>
                    <label for='edit-date-filter-max'>End date </label>
                    <div id='edit-date-filter-max'  class='date-padding'>
                       <div class='date-date'>
                          <input class='bef-datepicker form-text'  type='text' id='edit-date-filter-max-date' name='date_filter[max][date]' value='$end_date' size='60' maxlength='128' />
                       </div>
                    </div>
                 </div>
             </div>
          </div>";
    $filters = array("Event Type" => "field_event_type", "Industry" => "field_program_industry",
                     "Organization" => "field_program_org_tht_owns_prog", "State" => "field_event_state");
    //todo: use this array to construct the jQuery object used in the createEventSearchString javascript function in the block override at the
    //top of this file
    $solr_field_mapping = array("field_program_org_tht_owns_prog" => "sm_field_program_org_tht_owns_pr",
                                "field_program_industry"=>"sm_field_program_industry",
                                "field_event_state"=>"sm_field_event_state",
                                "field_event_type"=>"ts_field_event_type");
    foreach($filters as $label => $filter){
        //this gives us a unique list of filter items that have corresponding event data
        //in other words, we have events that have a filter selected - i.e. Event Type - we only want to show
        //Event Types that actually contain corresponding events in our system
        //This prevents displaying event filters that will return an empty result
        //It also doesn't make sense to make a filter available unless it could return a result
        //**************** IMPORTANT ************************
        //We are getting event data from a feed from SBA.gov, their event types, organizations, etc don't match ours exactly
        //there is a tamper on the import events feed to do some of this mapping. but, the default is to populate
        //our field with their data - i.e. they have bad data, so some of our organizations will have a phone number.
        //In order to avoid showing this bad data as an option for the user, I only show options that are in the list
        //of allowed values in our content type for that field
        $field = field_info_field($filter);
        $allowed_values = list_allowed_values($field);
        $filter_db_column = $filter . '_value';
        $filter_db_table = 'field_data_' . $filter;
        $query = "SELECT DISTINCT($filter_db_column)
                  FROM $filter_db_table
                  WHERE bundle = 'event'
                  ORDER BY $filter_db_column";

        $events_with_filter = db_query($query);
        $events_with_filter = $events_with_filter->fetchAllKeyed();
        if(!count($events_with_filter)) continue;
        echo "<div class='filter-type-wrapper' id='$filter-wrapper'><a href='#' class='accordion-header'>$label</a><div class='filter-options-wrapper' id='$filter-filter'>";
        $solr_field_name = $solr_field_mapping[$filter];
        $has_any_filters = FALSE;
        foreach($events_with_filter as $filter_name => $nothing){
            //if the data contained in the database doesn't match our list of allowed values, do not show the filter
            //this will prevent the users from performing a search that returns no results
            if(!array_key_exists($filter_name, $allowed_values)) continue;
            $has_any_filters = TRUE;
            $value = str_replace("'", "\\'", $value);
            $checkboxID = str_replace('_', '-', $filter);
            echo "<div class='selection-wrapper'><input type='checkbox' name='$filter" . "[]" . "' value='$filter_name' id='edit-field-$checkboxID-value'";
            if(in_array($filter_name, $filters_to_select[$solr_field_name])) echo " checked";
            if($filter == 'field_event_state' || $filter == 'field_event_type') $filter_name = $allowed_values[$filter_name];
            echo ">";
            echo "<label class='option' for='edit-field-$checkboxID-label'>" . ucwords($filter_name) . "</label></div>";
        }
        echo "</div></div>";
        if(!$has_any_filters) print "<script type='text/javascript'>jQuery('#$filter-wrapper').hide();</script>";
    }
    echo "<div id='events-text-search'>
                 <br />
                 <input type='button' value='Apply' onclick='createEventSearchString();'>
              </div>";
    echo "</form>";
    echo "</div>";

}
