<?php

/**
 * Helper functions for microsites.
 */

/**
 * Returns the image tag for a state.
 *
 * @param $state
 * @return string
 */
function microsite_state_flag_image($state) {
  $attribute_array = array(
    'path' => microsite_state_flag_image_path($state),
    'attributes' => array('class' => 'state-icon'),
  );
  return theme('image', $attribute_array);
}

function microsite_state_flag_image_path($state) {
  return path_to_theme() . '/images/microsite/state-flags/stateflag-' . strtoupper($state) . '.jpg';
}

/**
 * Helper function returns states and territories.
 *
 * @param $search_term
 * @return array
 */
function findRelatedStateMicrositesToSearchTerms($search_term) {
  $results = array();
  $related_states = array();

  $states_and_territories = micrositeStatesAndTerritories();
  foreach ($states_and_territories as $related_state) {
    $needle_state_name = '/\b' . $related_state['target'] . '\b/i';
    $needle_state_code = '/\b' . $related_state['code'] . '\b/i';
    $test_result_state_name = preg_match($needle_state_name , $search_term);
    $test_result_state_code = preg_match($needle_state_code, $search_term);
    if (!empty($test_result_state_name) || !empty($test_result_state_code)) {
      $related_states[] = $related_state;
    }
  }

  foreach ($related_states as $related_state) {
    $snippet = !empty($related_state['color'])? $related_state['color'] : variable_get('microsite_related_result_default', 'Visit our microsite for more valuable resources about doing business in !state.');

    $results[] = array(
      'nid' => 'Not a Node',
      'bgcolor' => (!empty($related_state['color']) ? $related_state['color'] : '#359AB7'),
      'iconURL' => url(microsite_state_flag_image_path($related_state['code'])),
      'title' => $related_state['state'],
      'snippet' => t($snippet, array('!state' => $related_state['state'])),
      'url' => url('micro-site/state_resource_landing', array('query' => array('state' => $related_state['code']))),
    );
  }

  return $results;
}


/**
 * Helper function to get a default list of states and territories.
 */

function micrositeStatesAndTerritories() {
  $state_and_territories = array();
  $state_and_territories[] = array(
    'state' => 'Alabama',
    'target' => 'Alabama',
    'code' => 'AL',
  );
  $state_and_territories[] = array(
    'state' => 'Alaska',
    'target' => 'Alaska',
    'code' => 'AK',
  );
  $state_and_territories[] = array(
    'state' => 'American Samoa',
    'target' => 'Samoa',
    'code' => 'AS',
  );
  $state_and_territories[] = array(
    'state' => 'Arizona',
    'target' => 'Arizona',
    'code' => 'AZ',
  );
  $state_and_territories[] = array(
    'state' => 'Arkansas',
    'target' => 'Arkansas',
    'code' => 'AR',
  );
  $state_and_territories[] = array(
    'state' => 'California',
    'target' => 'California',
    'code' => 'CA',
  );
  $state_and_territories[] = array(
    'state' => 'Colorado',
    'target' => 'Colorado',
    'code' => 'CO',
  );
  $state_and_territories[] = array(
    'state' => 'Connecticut',
    'target' => 'Connecticut',
    'code' => 'CT',
  );
  $state_and_territories[] = array(
    'state' => 'Delaware',
    'target' => 'Delaware',
    'code' => 'DE',
  );
  $state_and_territories[] = array(
    'state' => 'District of Columbia',
    'target' => 'District of Columbia',
    'code' => 'DC',
  );
  $state_and_territories[] = array(
    'state' => 'Florida',
    'target' => 'Florida',
    'code' => 'FL',
  );
  $state_and_territories[] = array(
    'state' => 'Georgia',
    'target' => 'Georgia',
    'code' => 'GA',
  );
  $state_and_territories[] = array(
    'state' => 'Guam',
    'target' => 'Guam',
    'code' => 'GU',
  );
  $state_and_territories[] = array(
    'state' => 'Hawaii',
    'target' => 'Hawaii',
    'code' => 'HI',
  );
  $state_and_territories[] = array(
    'state' => 'Idaho',
    'target' => 'Idaho',
    'code' => 'ID',
  );
  $state_and_territories[] = array(
    'state' => 'Illinois',
    'target' => 'Illinois',
    'code' => 'IL',
  );
  $state_and_territories[] = array(
    'state' => 'Indiana',
    'target' => 'Indiana',
    'code' => 'IN',
  );
  $state_and_territories[] = array(
    'state' => 'Iowa',
    'target' => 'Iowa',
    'code' => 'IA',
  );
  $state_and_territories[] = array(
    'state' => 'Kansas',
    'target' => 'Kansas',
    'code' => 'KS',
  );
  $state_and_territories[] = array(
    'state' => 'Kentucky',
    'target' => 'Kentucky',
    'code' => 'KY',
  );
  $state_and_territories[] = array(
    'state' => 'Louisiana',
    'target' => 'Louisiana',
    'code' => 'LA',
  );
  $state_and_territories[] = array(
    'state' => 'Maine',
    'target' => 'Maine',
    'code' => 'ME',
  );
  $state_and_territories[] = array(
    'state' => 'Maryland',
    'target' => 'Maryland',
    'code' => 'MD',
  );
  $state_and_territories[] = array(
    'state' => 'Massachusetts',
    'target' => 'Massachusetts',
    'code' => 'MA',
  );
  $state_and_territories[] = array(
    'state' => 'Michigan',
    'target' => 'Michigan',
    'code' => 'MI',
  );
  $state_and_territories[] = array(
    'state' => 'Minnesota',
    'target' => 'Minnesota',
    'code' => 'MN',
  );
  $state_and_territories[] = array(
    'state' => 'Mississippi',
    'target' => 'Mississippi',
    'code' => 'MS',
  );
  $state_and_territories[] = array(
    'state' => 'Missouri',
    'target' => 'Missouri',
    'code' => 'MO',
  );
  $state_and_territories[] = array(
    'state' => 'Montana',
    'target' => 'Montana',
    'code' => 'MT',
  );
  $state_and_territories[] = array(
    'state' => 'Nebraska',
    'target' => 'Nebraska',
    'code' => 'NE',
  );
  $state_and_territories[] = array(
    'state' => 'Nevada',
    'target' => 'Nevada',
    'code' => 'NV',
  );
  $state_and_territories[] = array(
    'state' => 'New Hampshire',
    'target' => 'New Hampshire',
    'code' => 'NH',
  );
  $state_and_territories[] = array(
    'state' => 'New Jersey',
    'target' => 'New Jersey',
    'code' => 'NJ',
  );
  $state_and_territories[] = array(
    'state' => 'New Mexico',
    'target' => 'New Mexico',
    'code' => 'NM',
  );
  $state_and_territories[] = array(
    'state' => 'New York',
    'target' => 'New York',
    'code' => 'NY',
  );
  $state_and_territories[] = array(
    'state' => 'North Carolina',
    'target' => 'North Carolina',
    'code' => 'NC',
  );
  $state_and_territories[] = array(
    'state' => 'North Dakota',
    'target' => 'North Dakota',
    'code' => 'ND',
  );
  $state_and_territories[] = array(
    'state' => 'Northern Mariana Islands',
    'target' => 'Mariana Islands',
    'code' => 'MP',
  );
  $state_and_territories[] = array(
    'state' => 'Ohio',
    'target' => 'Ohio',
    'code' => 'OH',
  );
  $state_and_territories[] = array(
    'state' => 'Oklahoma',
    'target' => 'Oklahoma',
    'code' => 'OK',
  );
  $state_and_territories[] = array(
    'state' => 'Oregon',
    'target' => 'Oregon',
    'code' => 'OR',
  );
  $state_and_territories[] = array(
    'state' => 'Pennsylvania',
    'target' => 'Pennsylvania',
    'code' => 'PA',
  );
  $state_and_territories[] = array(
    'state' => 'Puerto Rico',
    'target' => 'Puerto Rico',
    'code' => 'PR',
  );
  $state_and_territories[] = array(
    'state' => 'Rhode Island',
    'target' => 'Rhode Island',
    'code' => 'RI',
  );
  $state_and_territories[] = array(
    'state' => 'South Carolina',
    'target' => 'South Carolina',
    'code' => 'SC',
  );
  $state_and_territories[] = array(
    'state' => 'South Dakota',
    'target' => 'South Dakota',
    'code' => 'SD',
  );
  $state_and_territories[] = array(
    'state' => 'Tennessee',
    'target' => 'Tennessee',
    'code' => 'TN',
  );
  $state_and_territories[] = array(
    'state' => 'Texas',
    'target' => 'Texas',
    'code' => 'TX',
  );
  $state_and_territories[] = array(
    'state' => 'Utah',
    'target' => 'Utah',
    'code' => 'UT',
  );
  $state_and_territories[] = array(
    'state' => 'Vermont',
    'target' => 'Vermont',
    'code' => 'VT',
  );
  $state_and_territories[] = array(
    'state' => 'Virgin Islands',
    'target' => 'Virgin Islands',
    'code' => 'VI',
  );
  $state_and_territories[] = array(
    'state' => 'Virginia',
    'target' => 'Virginia',
    'code' => 'VA',
  );
  $state_and_territories[] = array(
    'state' => 'Washington',
    'target' => 'Washington',
    'code' => 'WA',
  );
  $state_and_territories[] = array(
    'state' => 'West Virginia',
    'target' => 'West Virginia',
    'code' => 'WV',
  );
  $state_and_territories[] = array(
    'state' => 'Wisconsin',
    'target' => 'Wisconsin',
    'code' => 'WI',
  );
  $state_and_territories[] = array(
    'state' => 'Wyoming',
    'target' => 'Wyoming',
    'code' => 'WY',
  );

  return $state_and_territories;
}
