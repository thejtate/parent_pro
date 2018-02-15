<?php

/**
 * @file
 * Settings forms
 */

/**
 * Create settings form in drupal configuration settings section for module.
 */
function parentpro_custom_admin_settings() {
  // Links to social sites
  $form['parentpro_custom_social_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Settings'),
    '#collapsible' => TRUE,
  );

  $socials = _parentpro_custom_admin_settings_map();

  foreach($socials as $key => $data){
    $form['parentpro_custom_social_settings'][$key] = array(
      '#type' => 'textfield',
      '#size' => 50,
      '#title' => $data['title'],
      '#default_value' => variable_get($key, ""),
    );
  }

  return system_settings_form($form);
}
