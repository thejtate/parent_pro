<?php
/**
 * Created by PhpStorm.
 * User: Sergey Grigorenko (svipsa@gmail.com)
 * Date: 19.01.15
 * Time: 13:44
 */


define("PARENTPRO_MOBILE_SERVICES_NID", 51);

define("PARENTPRO_MOBILE_ELIGIBLE_NID", 10);

define("PARENTPRO_MOBILE_CONTACT_US_NID", 8);

define("PARENTPRO_MOBILE_RESOURCES_NID", 11);
define("PARENTPRO_MOBILE_ACTIVITIES_NID", 757);

define("PARENTPRO_MOBILE_CALENDAR_PAGE", "calendar");


/**
 * Override or insert variables into the html template.
 */
function parentpro_mobile_preprocess_html(&$vars) {
  $vars['classes_array'][] = 'page';
  if ($node = menu_get_object()) {
    switch ($node->type) {
      case 'services':
        $vars['classes_array'][] = 'page-services';
        break;
      case 'about':
        $vars['classes_array'][] = 'page-about-us';
        break;
      case 'parenting':
        $vars['classes_array'][] = 'page-parenting-a';
        $vars['classes_array'][] = 'with-content-offset';
        break;
      case 'activity':
        $vars['classes_array'][] = 'page-parenting';
        break;
      case 'resources':
        $vars['classes_array'][] = 'page-resources';
        $vars['classes_array'][] = 'with-content-offset';
        break;
    }

    if ($node->nid == PARENTPRO_MOBILE_CONTACT_US_NID) {
      $vars['classes_array'][] = 'page-contact';
    }
  }

  if (in_array('html__counties', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services';
    $vars['classes_array'][] = 'with-content-offset';
  }
  if (in_array('html__counties_new', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services';
    $vars['classes_array'][] = 'with-content-offset';
  }

  if (in_array('html__states', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-services-c';
    $vars['classes_array'][] = 'with-content-offset';
  }


  if (in_array('html__calendar_mobile', $vars['theme_hook_suggestions'])) {
    $vars['classes_array'][] = 'page-calendar';
  }


}


/**
 * Implements hook_preprocess_page().
 */
function parentpro_mobile_preprocess_page(&$variables) {
  // Render menu
  $tree = menu_tree_all_data('menu-mobile-main-menu');
  //menu_tree_add_active_path($tree); // menu block module
  $variables['mobile_menu'] = menu_tree_output($tree);
}

/**
 * Implements hook_preprocess_node();
 */
function parentpro_mobile_preprocess_node(&$variables) {
  global $base_url;
  $node = $variables['node'];
  switch ($variables['type']) {
    case 'services':
      $variables['map'] = views_embed_view('services', 'block_1');
      break;
    case 'about':
      $eligible_node = node_load(PARENTPRO_MOBILE_ELIGIBLE_NID);
      $variables['eligible_node_view'] = node_view($eligible_node);
      $variables['services_link'] = l(t("FIND SERVICES NOW"), "node/" . PARENTPRO_MOBILE_SERVICES_NID, array("attributes" => array("class" => array("link"))));
      if (isset($variables['content']['field_about_video_upload'][0]['#player_dimensions'])) {
        $variables['content']['field_about_video_upload'][0]['#player_dimensions'] = "320x172"; //540x291
      }
      break;
    case 'webform':
      $variables['theme_hook_suggestions'][] = 'node__webform__' . $node->nid;
      break;
    case 'resources':
      $variables['resources_view'] = views_embed_view("resources");
      break;
    case 'activity':
      $img_uri = '';
      if (!empty($node->body)) {
        $text = strip_tags($node->body[LANGUAGE_NONE][0]['value']) . '%0A';
      }
      else {
        $text = '';
      }
      $vars['header_block'] = views_embed_view('activities', $display_id = 'block_2');
      $share_url = $base_url . $variables['node_url'];
      $variables['mail'] = l('', 'mailto:', array(
        'query' => array(
          'subject' => $node->title,
          'body' => $text . $share_url
        ),
        'external' => TRUE
      ));
      $variables['print'] = l(t(''), '', array(
        'external' => TRUE,
        'attributes' => array('class' => array('link-print-inline'))
      ));
      if (!empty($node->field_activity_image)) {
        $img_uri = file_create_url($node->field_activity_image[LANGUAGE_NONE][0]['uri']);
      }
      $variables['pin'] = l('', 'http://pinterest.com/pin/create/button', array(
        'absolute' => TRUE,
        'query' => array('url' => $share_url, 'media' => $img_uri)
      ));
      $variables['google'] = l('', 'https://m.google.com/app/plus/x', array(
        'absolute' => TRUE,
        'query' => array(
          'v' => 'compose',
          'content' => $text . '%20' . $share_url
        )
      ));
      $variables['fb'] = l('', 'http://www.facebook.com/dialog/feed', array(
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
//      $variables['tw'] = urlencode(url('http://sciencemuseumok.com/', array('absolute' => TRUE, 'query' => array($vars['url'] => 'http://ssco.funnelstaging.com/'))));


      $variables['activities_link'] = l(t("Back"), "node/" . PARENTPRO_MOBILE_ACTIVITIES_NID, array("attributes" => array("class" => array("link"))));
      break;
    case 'parenting':
      //$variables['parenting_activities'] = views_embed_view('activities', 'block_1');
      break;
    case 'activities':
      $variables['activities_view'] = views_embed_view("activities", 'block_2');
      break;
  }
}


/**
 * Implements hook_form_alter().
 */
function parentpro_mobile_form_alter(&$form, &$form_state, $form_id) {
  switch ($form_id) {
    case 'webform_client_form_' . PARENTPRO_MOBILE_CONTACT_US_NID:
      $form['actions']['submit']['#prefix'] = '<div class="submit-wrapper">';
      $form['actions']['submit']['#suffix'] = '</div>';

      $form['#node']->webform['confirmation'] = t("Thank you, your submission has been received.");
      $form['#node']->webform['redirect_url'] = "<none>";
      break;
  }
}

/**
 * Implements hook_preprocess_field().
 */
function parentpro_mobile_preprocess_field(&$vars) {
  switch ($vars['element']['#field_name']) {
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
 * template_preprocess_views_view()
 */
function parentpro_mobile_preprocess_views_view(&$vars) {
  if (isset($vars['view']->name)) {
    switch ($vars['view']->name) {
      case 'counties':
        $args = arg();
        $vars['region_title'] = $args['1'] ? $args['1'] : '';
        $result = $vars['view']->result;
        $filter_options = array();
        foreach ($result as $key => $value) {
          $filter_options[$value->field_field_county_type[0]['raw']['tid']] = $value->field_field_county_type[0]['rendered']['#markup'];
        }
        $vars['filter_options'] = $filter_options;
        $vars['services_link'] = l(t("CHOOSE ANOTHER COUNTY"), "node/" . PARENTPRO_MOBILE_SERVICES_NID, array("attributes" => array("class" => array("link"))));
        break;
      case 'states':
        $filter_options = array();
        $result = $vars['view']->result;
        foreach ($result as $key => $value) {
          $nid = $value->nid;
          $node = node_load($nid);
          if (isset($node->title)) {
            $filter_options[$node->nid] = $node->title;
          }
        }
        $vars['filter_options'] = $filter_options;
        $vars['services_link'] = l(t("FIND LOCAL SERVICES"), "node/" . PARENTPRO_MOBILE_SERVICES_NID, array("attributes" => array("class" => array("link"))));
        break;
      case 'resources':
        $result = $vars['view']->result;
        $filter_options = array();
        foreach ($result as $key => $value) {
          $nid = $value->nid;
          $node = node_load($nid);
          if (isset($node->title)) {
            $image = field_view_field("node", $node, "field_resources_items_icon");
            $filter_options[$node->nid] = render($image);
          }
        }
        $vars['filter_options'] = $filter_options;
        break;
      case 'events_calendar':
        $month_list = _parentpro_mobile_calendar_month_list();
        $arg = $vars['view']->args[0];
        $month = substr($arg, 5, 2);
        $vars['month_name'] = date('F', mktime(0, 0, 0, $month, 10)); // March
        $vars['month_list'] = $month_list;

        $query = drupal_get_query_parameters();
        $vars['month_all'] = _parentpro_custom_check_months_all();
        $vars['month_name'] = ($vars['month_all']) ? t('All months') : $vars['month_name'];

        $vocabulary = taxonomy_vocabulary_machine_name_load('cities');
        $terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));
        $location_list = _parentpro_mobile_calendar_get_location_list($terms, $arg, $query);
        $vars['location_list'] = $location_list['list'];

        $month_link_title = (arg(1)) ? $vars['month_name'] : t('Select month');
        $location_link_title = isset($location_list['selected']) ? $location_list['selected'] : t('Select location');

        $vars['month_link'] = l($month_link_title, "", array(
          "attributes" => array(
            "class" => array(
              "link",
              "style-a",
              "link-calendar"
            )
          )
        ));
        $vars['location_link'] = l($location_link_title, "", array(
          "attributes" => array(
            "class" => array(
              "link",
              "style-a",
              "link-location"
            )
          )
        ));

        break;
    }

  }
}

/**
 * Get months for calendar.
 *
 * @return array
 */
function _parentpro_mobile_calendar_month_list() {
  $year_month = array();
  $i = 0;
  $month_ago = 5;
  $month_next = 12 - $month_ago;
  $year_month['all'] = l(t('All months'), PARENTPRO_MOBILE_CALENDAR_PAGE, array('query' => array('month' => 'All')));
  while ($month_ago) {
    $month = date("F", strtotime("-" . $month_ago . "month", strtotime(date("F") . "1")));
    $key = date("Y-m", strtotime("-" . $month_ago . "month", strtotime(date("F") . "1")));
    $url = url(PARENTPRO_MOBILE_CALENDAR_PAGE . '/' . $key);
    $year_month[$key] = '<a href="' . $url . '">' . $month . '</a>';
    $month_ago--;
  }
  while ($i < $month_next) {
    $month = date("F", strtotime($i . "month", strtotime(date("F") . "1")));
    $key = date("Y-m", strtotime($i . "month", strtotime(date("F") . "1")));
    $url = url(PARENTPRO_MOBILE_CALENDAR_PAGE . '/' . $key);
    $year_month[$key] = '<a href="' . $url . '">' . $month . '</a>';
    $i++;
  }

  return $year_month;
}


/**
 * Implements theme_file_link().
 */
function parentpro_mobile_file_link($variables) {
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
 * Get location list for calendar.
 *
 * @param $locations
 * @param $date
 * @param $query
 * @return string
 */
function _parentpro_mobile_calendar_get_location_list($locations, $date, $query) {
  $year_month = date('Y-m', strtotime($date));
  $month_all = _parentpro_custom_check_months_all();
  if ($month_all) {
    $url = PARENTPRO_MOBILE_CALENDAR_PAGE;
    $location_list['list'] = array(
      'all' => l(t('All locations'), $url, array(
        'query' => array(
          'month' => 'All',
          'field_event_city_tid' => 'All'
        )
      ))
    );
  }
  else {
    $url = PARENTPRO_MOBILE_CALENDAR_PAGE . '/' . $year_month;
    $location_list['list'] = array(
      'all' => l(t('All locations'), $url, array('query' => array('field_event_city_tid' => 'All')))
    );
  }

  foreach ($locations as $location) {
    $tid = isset($location->tid) ? $location->tid : '';
    $name = isset($location->name) ? $location->name : '';
    $location_list['list'][$tid] = l($name, $url, array('query' => array('field_event_city_tid' => $tid)));
    if ((isset($query['field_event_city_tid'])) && ($query['field_event_city_tid'] == $location->tid)) {
      $location_list['selected'] = $name;
    }
  }

  if (isset($query['field_event_city_tid']) && ($query['field_event_city_tid'] == 'All')) {
    $location_list['selected'] = t('All locations');
  }

  return $location_list;
}