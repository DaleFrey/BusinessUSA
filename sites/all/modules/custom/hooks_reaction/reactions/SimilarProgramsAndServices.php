<?php

$tracking_path = path_to_theme() . '/scripts/landing-page-tracking.js';
drupal_add_js(overridable($tracking_path));

function similar_programs_and_services($type = 'program') {
  $minimum_required_nodes = 5;
  $results = _similar_programs_and_services_by_tracking($type);
  if (count($results) < $minimum_required_nodes) {
    $results = _similar_programs_and_services_by_facet($type);
  }
  return $results ;
}

function _similar_programs_and_services_by_tracking($type = 'program') {
  $thisLandingPageNode = menu_get_object();
  $thisLandingPageNodeId = $thisLandingPageNode->nid;
  $results = db_query("
        SELECT
            L1.nodeId as 'assoc_with_nid',
            L2.nodeId as 'nid_associated',
            COUNT(L2.nodeId) as 'ranking'
        FROM {landing_page_tracking} L1
        LEFT JOIN {landing_page_tracking} L2 ON ( L1.ipaddress = L2.ipaddress )
        LEFT JOIN {node} n ON ( n.nid = L2.nodeId )
        WHERE L1.nodeId={$thisLandingPageNodeId} AND L2.nodeId<>{$thisLandingPageNodeId} AND n.type = '{$type}'
        GROUP BY L2.nodeId
        ORDER BY COUNT(L2.nodeId) DESC
        LIMIT 5
    ");

  $listCount = 0;
  $relatedNodes = array();
  foreach ( $results as $record ) {
    $nid = $record->nid_associated;
    $assocNode = node_load($nid);
    $type = $assocNode->type;
    if ( $assocNode !== false) {
      $relatedNodes[] = $assocNode;
      $listCount++;
      if ( $listCount > 4 ) {
        break;
      }
    }
  }
  return $relatedNodes;
}

function _similar_programs_and_services_by_facet( $type = 'program') {
  $thisLandingPageNode = menu_get_object();
  $node_wrapper = entity_metadata_wrapper('node', $thisLandingPageNode);
  $owner_values =    $node_wrapper->field_program_owner_share->value();
  $industry_values = $node_wrapper->field_program_industry->value();
  $program_values =  $node_wrapper->field_program_needs->value();

  $query = db_select('node', 'n');
  $query->fields('n', array('nid'));
  $query->distinct();
  $query->leftJoin('field_data_field_program_owner_share', 'fpos', 'fpos.entity_id = n.nid');
  $query->leftJoin('field_data_field_program_industry', 'fpi', 'fpi.entity_id = n.nid');
  $query->leftJoin('field_data_field_program_needs', 'fpn', 'fpn.entity_id = n.nid');
  $query->condition('n.type', $type);
  $query->condition('n.nid', $node_wrapper->nid->value(), '<>');

  $faceted_or = db_or();
  if (!empty($owner_values)) {
    $faceted_or->condition('fpos.field_program_owner_share_value', $owner_values, 'IN');
  }
  if (!empty($industry_values)) {
    $faceted_or->condition('fpi.field_program_industry_value', $industry_values, 'IN');
  }
  if (!empty($program_values)) {
    $faceted_or->condition('fpn.field_program_needs_value', $program_values, 'IN');
  }

  if (!empty($owner_values) || !empty($industry_values) || !empty($program_values) ) {
    $query->condition($faceted_or);
  }

  $query->range(0, 5);
  $results = $query->execute();

  $related_nodes = array();
  foreach ($results as $row_result) {
    $related_nodes[] = node_load($row_result->nid);
  }
  return $related_nodes;
}

