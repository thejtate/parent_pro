<?php

/**
 * @file
 * template.php
 *
 * Contains theme override functions and preprocess functions for the theme.
 */
define('PARENTPRO_CALENDAR_PAGE', 'calendar');
define('SERVICES_VID', 2);
define('PARENTPRO_WEBFORM_SERVICES_COUNTY_CID', 16);
define('PARENTPRO_WEBFORM_SERVICES_NAMES_CID', 12);


/**
 * Override or insert variables into the html template.
 */
function parentpro_preprocess_html(&$vars) {
  $html5 = array(
    '#tag' => 'script',
    '#attributes' => array(
      'src' => base_path() . drupal_get_path('theme', 'parentpro') . '/js/lib/html5.js',
    ),
    '#prefix' => '<!--[if (lt IE 9) & (!IEMobile)]>',
    '#suffix' => '</script><![endif]-->',
  );
  drupal_add_html_head($html5, 'parentpro_html5');

  $vars['classes_array'][] = 'page';
  if ($node = menu_get_object()) {
    switch ($node->type) {
      case 'home_page':
        $vars['classes_array'][] = 'page-home';
        $vars['classes_array'][] = 'page-bg-gray';
        break;
      case 'resources':
        $vars['classes_array'][] = 'page-resources';
        $vars['classes_array'][] = 'page-bg-gray';
        break;
      case 'about':
        $vars['classes_array'][] = 'page-about-us';
        $vars['classes_array'][] = 'page-bg-gray';
        break;
      case 'services':
        $vars['classes_array'][] = 'page-services';
        $vars['classes_array'][] = 'page-bg-gray';
        break;
      case 'calendar':
        break;
      case 'activity':
        $vars['classes_array'][] = 'page-activities';
        break;
      case 'activities':
        $vars['classes_array'][] = 'page-activities';
        $vars['classes_array'][] = 'page-bg-white';
        break;
      case 'webform':
        $vars['classes_array'][] = 'page-services';
        break;
      case 'parenting':
        $vars['classes_array'][] = 'page-parenting';
        $vars['classes_array'][] = 'page-bg-white';
        break;
    }
    switch ($node->nid) {
      case SERVICES_QUESTIONAIRE_WEBFORM_NID:
      case SERVICES_QUESTIONAIRE_NEW_WEBFORM_NID:
        $vars['classes_array'][] = 'page-services-questionaire';
        break;
    }
  }
  if ($term = menu_get_object('taxonomy_term', 2)) {
    if ($term->vid == SERVICES_VID) {
      $vars['classes_array'][] = 'page-bg-gray';
      $vars['classes_array'][] = 'page-services';
    }
  }

  if (in_array('html__counties', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services';
  }
  if (in_array('html__counties_new', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services';
  }
  if (in_array('html__states', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services';
  }
  if (in_array('html__node__' . SERVICES_QUESTIONAIRE_WEBFORM_NID, $vars['theme_hook_suggestions'])
  && in_array('html__node__done', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services-questionaire';
  }
  if (in_array('html__node__' . SERVICES_QUESTIONAIRE_NEW_WEBFORM_NID, $vars['theme_hook_suggestions'])
  && in_array('html__node__done', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services-questionaire';
  }

  if (in_array('html__calendar', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-calendar';
  }


}


/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function parentpro_preprocess_node(&$vars) {
  $node = $vars['node'];
  global $base_url;

  //add view mode theme_hook_suggestions
  $node_type_suggestion_key = array_search('node__' . $vars['type'], $vars['theme_hook_suggestions']);
  if ($node_type_suggestion_key !== FALSE) {
    $node_view_mode_suggestion = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
    array_splice($vars['theme_hook_suggestions'], $node_type_suggestion_key + 1, 0, array($node_view_mode_suggestion));
  }


  switch ($node->type) {
    case 'activity':
      $img_uri = '';
      if (!empty($node->body)) {
        $text = strip_tags($node->body[LANGUAGE_NONE][0]['value']) . '%0A';
      }
      else {
        $text = '';
      }
      $vars['header_block'] = views_embed_view('activities', $display_id = 'block_2');
      $share_url = $base_url . $vars['node_url'];
      $vars['mail'] = l('', 'mailto:', array(
        'query' => array(
          'subject' => $node->title,
          'body' => $text . $share_url
        ),
        'external' => TRUE
      ));
      $vars['print'] = l(t(''), '', array(
        'external' => TRUE,
        'attributes' => array('class' => array('link-print-inline'))
      ));
      if (!empty($node->field_activity_image)) {
        $img_uri = file_create_url($node->field_activity_image[LANGUAGE_NONE][0]['uri']);
      }
      $vars['pin'] = l('', 'http://pinterest.com/pin/create/button', array(
        'absolute' => TRUE,
        'query' => array('url' => $share_url, 'media' => $img_uri)
      ));
      $vars['google'] = l('', 'https://m.google.com/app/plus/x', array(
        'absolute' => TRUE,
        'query' => array(
          'v' => 'compose',
          'content' => $text . '%20' . $share_url
        )
      ));
      $vars['fb'] = l('', 'http://www.facebook.com/dialog/feed', array(
        'absolute' => TRUE,
        'query' => array(
          'app_id' => '348267475298227',
          'link' => $share_url,
          'caption' => $node->title,
          'description=' => $text,
          'redirect_uri' => $share_url,
          'display' => 'popup',
          'picture' => $img_uri
        )
      ));
//      $vars['tw'] = urlencode(url('http://sciencemuseumok.com/', array('absolute' => TRUE, 'query' => array($vars['url'] => 'http://ssco.funnelstaging.com/'))));

      break;
    case 'services':
      $vars['map'] = views_embed_view('services', 'block_1');
      break;
    case 'webform':
    case 'webform_services':
      $vars['region_image'] = '';
      if (!empty($vars['field_webform_region'])) {
        if (!empty($vars['field_webform_region']['0']['taxonomy_term']->field_services_image)) {
          $region_image_path = $vars['field_webform_region']['0']['taxonomy_term']->field_services_image[LANGUAGE_NONE]['0']['uri'];
          $vars['region_image'] = l(theme('image', array('path' => $region_image_path)), '', array(
            'attributes' => array('class' => array('btn')),
            'html' => TRUE
          ));
        }
      }
      $vars['theme_hook_suggestions'][] = 'node__webform__' . $node->nid;

//      $vars['theme_hook_suggestions'][] = 'node__webform__services';
//      $vars['map'] = views_embed_view('services', 'block');
//      if ($vars['view_mode'] == "full") {
//        drupal_goto("<front>");
//      }
      if($node->nid == SERVICES_QUESTIONAIRE_WEBFORM_NID || $node->nid == SERVICES_QUESTIONAIRE_NEW_WEBFORM_NID) {

        $vars['theme_hook_suggestions'][] = 'node__webform__services_questionaire';
        if(!empty($_GET['county'])) {
          $vars['back_link'] = l('Back to your county', SERVICES_QUESTIONAIRE_PATH . '/' . $_GET['county'], array('attributes' => array('class' => array('btn'))));
        }
      }
      break;
    case 'parenting':
      $vars['parenting_activities'] = views_embed_view('activities', 'block_1');
      break;
  }

}

/**
 * Theme preprocess function for theme_field() and field.tpl.php.
 *
 * @see theme_field()
 * @see field.tpl.php
 */
function parentpro_preprocess_field(&$vars, $hook) {
  switch ($vars['element']['#field_name']) {
    case 'field_homesubpark_blocks' :
      $field_obj = $vars['items'];
      foreach ($field_obj as $key => $value) {
        $vars['items'][$key]['links']['#access'] = FALSE;
      }
      break;
    case 'field_parenting_downloads' :
      foreach ($vars['items'] as $key => $el) {
        $vars['items'][$key]['#file']->no_icon = TRUE;
      }
      break;

    default:
      break;
  }
}

/**
 * theme_item_list()
 */
function parentpro_item_list($variables) {
  $attributes = array();
  $items = $variables['items'];
  $title = $variables['title'];
  $type = $variables['type'];
  $attributes = $variables['attributes'];
  $output = '';
  // Only output the list container and title, if there are any list items.
  // Check to see whether the block title exists before adding a header.
  // Empty headers are not semantic and present accessibility challenges.

  if (isset($title) && $title !== '') {
    $output .= '<h3>' . $title . '</h3>';
  }

  if (!empty($items)) {
    $output .= "<$type" . drupal_attributes($attributes) . '>';
    $num_items = count($items);
    $i = 0;
    foreach ($items as $item) {
      $attributes = array();
      $children = array();
      $data = '';
      $i++;
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        // Render nested list.
        $data .= theme_item_list(array(
          'items' => $children,
          'title' => NULL,
          'type' => $type,
          'attributes' => $attributes
        ));
      }
      if ($i == 1) {
        $attributes['class'][] = 'first';
      }
      if ($i == $num_items) {
        $attributes['class'][] = 'last';
      }
      $output .= '<li' . drupal_attributes($attributes) . '>' . $data . "</li>\n";
    }
    $output .= "</$type>";
  }

  return $output;
}

/**
 * Implements template_preprocess_date_views_pager().
 * Events Calendar
 */
function parentpro_preprocess_date_views_pager(&$vars) {

  if (!empty($vars['plugin']->view->name) && $vars['plugin']->view->name == 'calendar') {
    $view = $vars['plugin']->view;
    $date_info = $view->date_info;
    $vars['nav_title'] = date_format_date($date_info->min_date, 'custom', 'F');
  }

  if (!empty($vars['plugin']->view->name) && $vars['plugin']->view->name == 'calendar_new') {
    $view = $vars['plugin']->view;
    $date_info = $view->date_info;
    $vars['nav_title'] = date_format_date($date_info->min_date, 'custom', 'F');
  }
}

/**
 * template_preprocess_views_view()
 */
function parentpro_preprocess_views_view(&$vars) {
//  $vars['map'] = 'sss';
  if (isset($vars['view']->name)) {
    switch ($vars['view']->name) {
      case 'counties':
        $args = arg();
        $vars['region_title'] = $args['1'] ? $args['1'] : '';


        $services_tid = _parentpro_get_services_tid($vars);

        $vars['map'] = views_embed_view('services', 'block', $services_tid);
        $vars['map_header'] = views_embed_view('region_form', 'block', $vars['region_title']);
        $term_name = isset($vars['view']->args[0]) ? $vars['view']->args[0] : NULL;

        $options = array();
        if($term_name) {
          $options['query']['county'] = $term_name;
        }
        $vars['form_link'] = l('clicking here', 'node/' . SERVICES_QUESTIONAIRE_NEW_WEBFORM_NID, $options);
        break;
      case 'states':
        $args = arg();
        $vars['region_title'] = '';
        $vars['map'] = views_embed_view('services', 'block');
        $vars['map_header'] = views_embed_view('region_form', 'block', '');
        break;
      case 'events_calendar':
//        $vars['month_link'] = l(t("SELECT MONTH"), "", array(
//          "attributes" => array(
//            "class" => array(
//              "link",
//              "style-a",
//              "link-calendar"
//            )
//          )
//        ));
        $query = drupal_get_query_parameters();
        _parentpro_check_right_path($query);
        if (!empty($query) && isset($query['mini'])) {
          $month = substr($query['mini'], 5, 2);
          $year_month = $query['mini'];
        }
        elseif (!empty($vars['view']->args)) {
          $arg = $vars['view']->args[0];
          $month = substr($arg, 5, 2);
          $year_month = $arg;
        }
        if (!isset($month)) {
          $time = time();
          $month = date("m", $time);
        }
        if (!isset($year_month)) {
          $time = time();
          $year_month = date("Y-m", $time);
        }

        $vars['month_name'] = date('F', mktime(0, 0, 0, $month, 10)); // March
        $vars['calendar_block'] = views_embed_view('calendar_new', $display_id = 'block_1');

        $month_list = _parentpro_calendar_month_list($month);
        $vars['month_list'] = $month_list;
        $vars['month_all'] = _parentpro_custom_check_months_all();
        $vars['month_name'] = ($vars['month_all']) ? t('All months') : $vars['month_name'];

        $vocabulary = taxonomy_vocabulary_machine_name_load('cities');
        $terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));
        $location_list = _parentpro_calendar_get_location_list($terms, $year_month, $query);
        $vars['location_list'] = $location_list;
        break;
    }
  }
}


/**
 * Get months for calendar.
 *
 * @return array
 */
function _parentpro_calendar_month_list($month_number) {
  $year_month = '<select name="month" class="form-select parentpro-calendar-month">';
  $i = 0;
  $month_ago = 5;
  $month_next = 12 - $month_ago;
  $url_all = url(PARENTPRO_CALENDAR_PAGE, array('query' => array('month' => 'All')));
  $url_query = drupal_get_query_parameters($_GET, array());
  $url_query['month'] = isset($url_query['month']) ? $url_query['month'] : '';
  $all_selected = FALSE;
  if (!empty($url_query['month'])) {
    $all_selected = 'selected="selected"';
  }
  $year_month .= '<option value="' . $url_all . '" ' . $all_selected . '" > ' . t('All months') . '</option>';
  while ($month_ago) {
    $month = date("F", strtotime("-" . $month_ago . "month", strtotime(date("F") . "1")));
    $key = date("Y-m", strtotime("-" . $month_ago . "month", strtotime(date("F") . "1")));
    $url = url(PARENTPRO_CALENDAR_PAGE . '/' . $key, array('query' => array('mini' => $key)));
    $month_key = date("m", strtotime("-" . $month_ago . "month", strtotime(date("F") . "1")));
    $selected = (($month_key == $month_number) && !$all_selected) ? 'selected="selected"' : '';
    $year_month .= '<option value="' . $url . '" ' . $selected . '>' . $month . '</option>';
    $month_ago--;
  }
  while ($i < $month_next) {
    $month = date("F", strtotime($i . "month", strtotime(date("F") . "1")));
    $key = date("Y-m", strtotime($i . "month", strtotime(date("F") . "1")));
    $url = url(PARENTPRO_CALENDAR_PAGE . '/' . $key, array('query' => array('mini' => $key)));
    $month_key = date("m", strtotime($i . "month", strtotime(date("F") . "1")));
    $selected = (($month_key == $month_number) && !$all_selected) ? 'selected="selected"' : '';
    $year_month .= '<option value="' . $url . '" ' . $selected . '>' . $month . '</option>';
    $i++;
  }

  $year_month .= "</select>";

  return $year_month;
}


/**
 * Implements template_preprocess_calendar_datebox().
 */
function parentpro_preprocess_calendar_datebox(&$vars) {

  if (!empty($vars['view']->name)
    && $vars['view']->name == 'calendar'
    && !empty($vars['view']->current_display)
    && $vars['view']->current_display == 'page_1'
  ) {
    $vars['theme_hook_suggestions'][] = 'calendar_datebox__calendar__page_1';
  }
}


/**
 * Implements theme_file_link().
 */
function parentpro_file_link($variables) {
  $file = $variables['file'];
  $icon_directory = $variables['icon_directory'];

  $url = file_create_url($file->uri);
  $icon = theme('file_icon', array(
    'file' => $file,
    'icon_directory' => $icon_directory
  ));

  // Set options as per anchor format described at
  // http://microformats.org/wiki/file-format-examples
  $options = array(
    'attributes' => array(
      'type' => $file->filemime . '; length=' . $file->filesize,
    ),
  );

  // Use the description as the link text if available.
  if (empty($file->description)) {
    $link_text = $file->filename;
  }
  else {
    $link_text = $file->description;
    $options['attributes']['title'] = check_plain($file->filename);
  }

  if (isset($file->no_icon) && $file->no_icon) {
    $icon = "";
  }


  return '<span class="file">' . $icon . ' ' . l($link_text, $url, $options) . '</span>';
}


/**
 * Get services tid By counties.
 * @param $vars
 * @return mixed|null
 */
function _parentpro_get_services_tid($vars) {
  $term_name = isset($vars['view']->args[0]) ? $vars['view']->args[0] : NULL;

  if (empty($term_name)) {
    return NULL;
  }

  $term = taxonomy_get_term_by_name($term_name);
  $tid = key($term);

  if (empty($tid)) {
    return NULL;
  }

  $parents = taxonomy_get_parents($tid);
  $parents_tid = key($parents);

  return $parents_tid;
}

/**
 * Redirect when day selected in calendar new.
 *
 * @return array
 */
function _parentpro_check_right_path($query) {
  $arg_year = arg(1);
  $arg_year = (!empty($arg_year)) ? date('Y-m', strtotime($arg_year)) : $arg_year;
  $day = _parentpro_custom_check_day();

  if ($day && isset($query['field_event_city_tid'])) {
    drupal_goto(current_path());
  }

  //Calendar new block
  if (!empty($query)) {
    if (!isset($query['mini'])) {
      $_GET['mini'] = (!empty($arg_year)) ? $arg_year : date("Y-m", time());
    }
  }
  else {
    $_GET['mini'] = (!empty($arg_year)) ? $arg_year : date("Y-m", time());
  }
}

/**
 * Get location list for calendar.
 *
 * @param $locations
 * @param $date
 * @param $query
 * @return string
 */
function _parentpro_calendar_get_location_list($locations, $date, $query) {
  $year_month = date('Y-m', strtotime($date));
  $month_all = _parentpro_custom_check_months_all();
  if ($month_all) {
    $url = PARENTPRO_CALENDAR_PAGE;
  }
  else {
    $url = PARENTPRO_CALENDAR_PAGE . '/' . $year_month;
  }

  $location_list = '<select name="month" class="form-select parentpro-calendar-month">';
  if ($month_all) {
    $option_url = url($url, array('query' => array('month' => 'All', 'field_event_city_tid' => 'All')));
  }
  else {
    $option_url = url($url, array('query' => array('field_event_city_tid' => 'All')));
  }
  $location_list .= '<option value="' . $option_url . '">' . t('All locations') . '</option>';

  foreach ($locations as $location) {
    if ($month_all) {
      $option_url = url($url, array('query' => array('month' => 'All', 'field_event_city_tid' => $location->tid)));
    }
    else {
      $option_url = url($url, array('query' => array('field_event_city_tid' => $location->tid)));
    }

    $selected = ((isset($query['field_event_city_tid'])) && ($query['field_event_city_tid'] == $location->tid)) ? 'selected="selected"' : '';
    $location_list .= '<option value="' . $option_url . '" ' . $selected . '>' . $location->name . '</option>';
  }

  $location_list .= "</select>";

  return $location_list;
}

/**
 * Implements hook_form_alter().
 */
function parentpro_form_alter(&$form, &$form_state, $form_id) {

  switch($form_id) {
    case 'webform_client_form_' . SERVICES_QUESTIONAIRE_WEBFORM_NID:
    case 'webform_client_form_' . SERVICES_QUESTIONAIRE_NEW_WEBFORM_NID:

      $form['#attributes']['class'][] = 'form';
      $form['#attributes']['class'][] = 'form-services';

      parentpro_wrap_item($form['actions']['submit'], 'btn-wrap');
      parentpro_wrap_item($form['submitted']['name']['first_name'], 'form-type-textfield');
      parentpro_wrap_item($form['submitted']['name']['last_name'], 'form-type-textfield');
      parentpro_wrap_item($form['submitted']['user_info']['what_is_your_phone_number'], 'form-type-textfield');
      parentpro_wrap_item($form['submitted']['user_info']['what_is_your_e_mail_address'], 'form-type-textfield');

      $wrap_fields_keys = array(
        'what_services_are_you_most_interested_in_for_your_family_select_all_that_apply',
        'tell_us_about_your_family_choose_the_one_that_best_describes_your_family',
        'are_you_eligible_for_wic_and_or_medicaid',
        'rank_the_level_of_stress_in_your_home',
        'rank_the_level_of_stress_in_your_home2',
        'language_preference_for_services',
        'please_check_any_of_the_following_questions_if_true'
      );
      foreach ($wrap_fields_keys as $key) {
        if(!empty($form['submitted'][$key])) {
          parentpro_wrap_item($form['submitted'][$key], '', 'fieldset');
        }

      }
      break;
  }
}

/**
 * Implements hook_preprocess().
 */
function parentpro_preprocess(&$vars, $hook) {
  //dsm($hook);
}
