<?php
/**
 * @file
 * myusa_user_dashboard.features.field.inc
 */

/**
 * Implements hook_field_default_fields().
 */
function myusa_user_dashboard_field_default_fields() {
  $fields = array();

  // Exported field: 'user-user-field_usr_industries'.
  $fields['user-user-field_usr_industries'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '-1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_usr_industries',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(
        'format' => array(
          'columns' => array(
            'format' => 'format',
          ),
          'table' => 'filter_format',
        ),
      ),
      'indexes' => array(
        'format' => array(
          0 => 'format',
        ),
      ),
      'locked' => '0',
      'module' => 'text',
      'settings' => array(
        'max_length' => '1024',
      ),
      'translatable' => '0',
      'type' => 'text',
    ),
    'field_instance' => array(
      'bundle' => 'user',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'This field is used to store a given user\'s answer to the "What industries are you interested most interested in?" question supplied to them in the questionnaire given to them (when they authenticate with MyUSA for the first time). This is [unlimited] multi-value field - there can be more than one value for this field for each user at the same time. Each value for this field should be an exact text-match with an option/(answer) supplied for that question on the questionnaire.',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'text',
          'settings' => array(),
          'type' => 'text_default',
          'weight' => 6,
        ),
        'ical' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'user',
      'field_name' => 'field_usr_industries',
      'label' => 'Questionnaire - User Industries',
      'required' => 0,
      'settings' => array(
        'text_processing' => '0',
        'user_register_form' => 0,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'text',
        'settings' => array(
          'size' => '100',
        ),
        'type' => 'text_textfield',
        'weight' => '11',
      ),
    ),
  );

  // Exported field: 'user-user-field_usr_ownership'.
  $fields['user-user-field_usr_ownership'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '-1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_usr_ownership',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(
        'format' => array(
          'columns' => array(
            'format' => 'format',
          ),
          'table' => 'filter_format',
        ),
      ),
      'indexes' => array(
        'format' => array(
          0 => 'format',
        ),
      ),
      'locked' => '0',
      'module' => 'text',
      'settings' => array(
        'max_length' => '1024',
      ),
      'translatable' => '0',
      'type' => 'text',
    ),
    'field_instance' => array(
      'bundle' => 'user',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'This field is used to store a given user\'s answer to the "What best describes the ownership of your business?" question supplied to them in the questionnaire given to them (when they authenticate with MyUSA for the first time). This is [unlimited] multi-value field - there can be more than one value for this field for each user at the same time. Each value for this field should be an exact text-match with an option/(answer) supplied for that question on the questionnaire. ',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'text',
          'settings' => array(),
          'type' => 'text_default',
          'weight' => 5,
        ),
        'ical' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'user',
      'field_name' => 'field_usr_ownership',
      'label' => 'Questionnaire - User Ownership',
      'required' => 0,
      'settings' => array(
        'text_processing' => '0',
        'user_register_form' => 0,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'text',
        'settings' => array(
          'size' => '100',
        ),
        'type' => 'text_textfield',
        'weight' => '10',
      ),
    ),
  );

  // Exported field: 'user-user-field_usr_past_searches'.
  $fields['user-user-field_usr_past_searches'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '-1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_usr_past_searches',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(
        'format' => array(
          'columns' => array(
            'format' => 'format',
          ),
          'table' => 'filter_format',
        ),
      ),
      'indexes' => array(
        'format' => array(
          0 => 'format',
        ),
      ),
      'locked' => '0',
      'module' => 'text',
      'settings' => array(
        'max_length' => '1024',
      ),
      'translatable' => '0',
      'type' => 'text',
    ),
    'field_instance' => array(
      'bundle' => 'user',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'This field is used to store a given user\'s past searches (search queries/terms).
While this is a text field, each field value should be the result of the PHP serialize function, while serializing an array (see the example for the structure of the expected array).
For example, one (text) value for this field could be:
serialize(
  array(
    \'search-term\' => \'Start a Business\',
    \'facet-array\' => array(
      \'bundle:program\',
      \'sm_field_program_industry:Manufacturing\'
    ),
    \'search-url\' => \'/search/site/Start%20a%20Business?f[0]=bundle%3Aprogram&f[1]=sm_field_program_industry%3AManufacturing\'
  )
);',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'text',
          'settings' => array(),
          'type' => 'text_default',
          'weight' => 0,
        ),
        'ical' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'user',
      'field_name' => 'field_usr_past_searches',
      'label' => 'Past Searches',
      'required' => 0,
      'settings' => array(
        'text_processing' => '0',
        'user_register_form' => 0,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'text',
        'settings' => array(
          'size' => '60',
        ),
        'type' => 'text_textfield',
        'weight' => '5',
      ),
    ),
  );

  // Exported field: 'user-user-field_usr_psrchs_lastupdate'.
  $fields['user-user-field_usr_psrchs_lastupdate'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_usr_psrchs_lastupdate',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(),
      'indexes' => array(),
      'locked' => '0',
      'module' => 'number',
      'settings' => array(),
      'translatable' => '0',
      'type' => 'number_integer',
    ),
    'field_instance' => array(
      'bundle' => 'user',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'This field shall hold the unix-timestamp of the last time the "Past Searches" (field_usr_past_searches) field was updated (or added to). Any time that field is written to, this field should be updated with the return of the time() PHP function.',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'number',
          'settings' => array(
            'decimal_separator' => '.',
            'prefix_suffix' => TRUE,
            'scale' => 0,
            'thousand_separator' => ' ',
          ),
          'type' => 'number_integer',
          'weight' => 2,
        ),
        'ical' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'user',
      'field_name' => 'field_usr_psrchs_lastupdate',
      'label' => 'Past Searches - Last Update',
      'required' => 0,
      'settings' => array(
        'max' => '',
        'min' => '',
        'prefix' => '',
        'suffix' => '',
        'user_register_form' => 0,
      ),
      'widget' => array(
        'active' => 0,
        'module' => 'number',
        'settings' => array(),
        'type' => 'number',
        'weight' => '6',
      ),
    ),
  );

  // Exported field: 'user-user-field_usr_tiles_lastupdate'.
  $fields['user-user-field_usr_tiles_lastupdate'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_usr_tiles_lastupdate',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(),
      'indexes' => array(),
      'locked' => '0',
      'module' => 'number',
      'settings' => array(),
      'translatable' => '0',
      'type' => 'number_integer',
    ),
    'field_instance' => array(
      'bundle' => 'user',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'This field shall hold the unix-timestamp of the last time the "User Tiles" (field_usr_tiles_nids) field was updated (or added to). Any time that field is written to, this field should be updated with the return of the time() PHP function.',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'number',
          'settings' => array(
            'decimal_separator' => '.',
            'prefix_suffix' => TRUE,
            'scale' => 0,
            'thousand_separator' => ' ',
          ),
          'type' => 'number_integer',
          'weight' => 3,
        ),
        'ical' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'user',
      'field_name' => 'field_usr_tiles_lastupdate',
      'label' => 'User Tiles - Last Update',
      'required' => 0,
      'settings' => array(
        'max' => '',
        'min' => '',
        'prefix' => '',
        'suffix' => '',
        'user_register_form' => 0,
      ),
      'widget' => array(
        'active' => 0,
        'module' => 'number',
        'settings' => array(),
        'type' => 'number',
        'weight' => '8',
      ),
    ),
  );

  // Exported field: 'user-user-field_usr_tiles_nids'.
  $fields['user-user-field_usr_tiles_nids'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '-1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_usr_tiles_nids',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(),
      'indexes' => array(),
      'locked' => '0',
      'module' => 'number',
      'settings' => array(),
      'translatable' => '0',
      'type' => 'number_integer',
    ),
    'field_instance' => array(
      'bundle' => 'user',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'This is a list of swimlane/tiles this user has user has on their user-dashboard (represented by the swimlane/tile node-id).',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'number',
          'settings' => array(
            'decimal_separator' => '.',
            'prefix_suffix' => TRUE,
            'scale' => 0,
            'thousand_separator' => ' ',
          ),
          'type' => 'number_integer',
          'weight' => 1,
        ),
        'ical' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'user',
      'field_name' => 'field_usr_tiles_nids',
      'label' => 'User Tiles (nids)',
      'required' => 0,
      'settings' => array(
        'max' => '',
        'min' => '',
        'prefix' => '',
        'suffix' => '',
        'user_register_form' => 0,
      ),
      'widget' => array(
        'active' => 0,
        'module' => 'number',
        'settings' => array(),
        'type' => 'number',
        'weight' => '7',
      ),
    ),
  );

  // Exported field: 'user-user-field_usr_zipcode'.
  $fields['user-user-field_usr_zipcode'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_usr_zipcode',
      'field_permissions' => array(
        'type' => '0',
      ),
      'foreign keys' => array(),
      'indexes' => array(),
      'locked' => '0',
      'module' => 'number',
      'settings' => array(),
      'translatable' => '0',
      'type' => 'number_integer',
    ),
    'field_instance' => array(
      'bundle' => 'user',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => 'This filed shall store the ZipCode the user shall be associated/interested with. The Map and Events section on the User Dashboard shall center on the latitude/longitude of this ZipCode.',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'number',
          'settings' => array(
            'decimal_separator' => '.',
            'prefix_suffix' => TRUE,
            'scale' => 0,
            'thousand_separator' => ' ',
          ),
          'type' => 'number_integer',
          'weight' => 4,
        ),
        'ical' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'user',
      'field_name' => 'field_usr_zipcode',
      'label' => 'User ZipCode',
      'required' => 0,
      'settings' => array(
        'max' => '',
        'min' => '',
        'prefix' => '',
        'suffix' => '',
        'user_register_form' => 0,
      ),
      'widget' => array(
        'active' => 0,
        'module' => 'number',
        'settings' => array(),
        'type' => 'number',
        'weight' => '9',
      ),
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Past Searches');
  t('Past Searches - Last Update');
  t('Questionnaire - User Industries');
  t('Questionnaire - User Ownership');
  t('This field is used to store a given user\'s answer to the "What best describes the ownership of your business?" question supplied to them in the questionnaire given to them (when they authenticate with MyUSA for the first time). This is [unlimited] multi-value field - there can be more than one value for this field for each user at the same time. Each value for this field should be an exact text-match with an option/(answer) supplied for that question on the questionnaire. ');
  t('This field is used to store a given user\'s answer to the "What industries are you interested most interested in?" question supplied to them in the questionnaire given to them (when they authenticate with MyUSA for the first time). This is [unlimited] multi-value field - there can be more than one value for this field for each user at the same time. Each value for this field should be an exact text-match with an option/(answer) supplied for that question on the questionnaire.');
  t('This field is used to store a given user\'s past searches (search queries/terms).
While this is a text field, each field value should be the result of the PHP serialize function, while serializing an array (see the example for the structure of the expected array).
For example, one (text) value for this field could be:
serialize(
  array(
    \'search-term\' => \'Start a Business\',
    \'facet-array\' => array(
      \'bundle:program\',
      \'sm_field_program_industry:Manufacturing\'
    ),
    \'search-url\' => \'/search/site/Start%20a%20Business?f[0]=bundle%3Aprogram&f[1]=sm_field_program_industry%3AManufacturing\'
  )
);');
  t('This field shall hold the unix-timestamp of the last time the "Past Searches" (field_usr_past_searches) field was updated (or added to). Any time that field is written to, this field should be updated with the return of the time() PHP function.');
  t('This field shall hold the unix-timestamp of the last time the "User Tiles" (field_usr_tiles_nids) field was updated (or added to). Any time that field is written to, this field should be updated with the return of the time() PHP function.');
  t('This filed shall store the ZipCode the user shall be associated/interested with. The Map and Events section on the User Dashboard shall center on the latitude/longitude of this ZipCode.');
  t('This is a list of swimlane/tiles this user has user has on their user-dashboard (represented by the swimlane/tile node-id).');
  t('User Tiles (nids)');
  t('User Tiles - Last Update');
  t('User ZipCode');

  return $fields;
}
