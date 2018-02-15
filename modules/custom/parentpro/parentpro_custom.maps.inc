<?php
/**
 * @file Social maps
 */

/**
 * Social map.
 *
 * @return array
 */
function _parentpro_custom_admin_settings_map() {
  $module_path = drupal_get_path('module', 'parentpro_custom');

  return array(
    'parentpro_custom_social_settings_facebook' => array(
      'title' => t('Facebook'),
      'class' => 'social-1',
      'img' => $module_path . '/img/facebookparentpro.png',
    ),
  );
}