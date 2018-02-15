<?php

/**
 * @file
 * Module common helpers.
 */

/**
 * Get clean rendered view rows values.
 */
function parentpro_services_views_retrieve($view_name, $display_id = 'default', $filters = array(),  $args = array(), $offset = 0, $limit = -1, $return_type = FALSE) {
  $result = array();
  $view = views_get_view($view_name);

  // Put all arguments and filters and then execute.
  $view->set_arguments($args, FALSE);
  $view->set_exposed_input($filters);
  $view->set_offset($offset);

  // Support for Views 2
  if (method_exists($view, 'set_use_pager')) {
    // If offset is set we can't have a user pager.
    if (empty($offset)) {
      $view->set_use_pager(TRUE);
      if ($limit >= 0) {
        $view->set_items_per_page($limit);
      }
    }
    else {
      // Disable the user pager.
      $view->set_use_pager(FALSE);
    }
  }
  elseif ($limit >= 0) {
    $view->set_items_per_page($limit);
  }

  // If we display values and not themed view output.
  if (empty($return_type)) {
    $view->set_display($display_id);
    $view->pre_execute();
    $view->execute();
    $result = $view->result;

    $row_plugin = $view->display_handler->get_option('row_plugin');
    // If row plugin is node, then we should load each node
    if ($row_plugin == 'node') {
      $nodes = array();
      foreach ($view->result as $row) {
        $nodes[] = node_load($row->nid);
      }
      $result = $nodes;
    }
    elseif ($row_plugin == 'fields') {
      $items = array();
      foreach ($view->result as $count => $row) {
        $item = new stdClass();
        foreach ($view->field as $field_id => $field) {
          if (!empty($field->options['label'])) {
            $field_label = strtolower($field->options['label']);
          }
          elseif ($field->field_alias) {
            $field_label = $field->field_alias;
          }
          else {
            $field_label = $field_id;
          }

          $field->pre_render($view->result);
          $field->view->row_index = $count;
          $item->$field_label = $field->theme($row);
        }
        $items[] = $item;
      }
      if ($items) {
        $result = $items;
      }
    }
  }
  elseif ($return_type == 'view') {
    $view->set_display($display_id);
    $view->execute();
    return $view;
  }
  else {
    // We want to keep the result an array.
    $result[] = $view->preview($display_id);
  }
  return $result;
//  if(!empty($field->field_entity_type) && empty($field->entity_type)) {
//    $field->entity_type = $field->field_entity_type;
//  }
}