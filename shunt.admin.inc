<?php

/**
 * @file
 * Admin page callback file for the Shunt module.
 */

/**
 * Page callback: Form constructor for the admin settings form.
 *
 * @see shunt_menu()
 * @see shunt_admin_settings_form_submit()
 *
 * @ingroup forms
 */
function shunt_admin_settings_form() {
  $shunts = shunt_get_shunt_definitions();

  // Define table header.
  $header = array(
    'name' => t('Name'),
    'description' => t('Description'),
  );

  // Build table rows.
  $options = array();
  $default_values = array();
  foreach ($shunts as $name => $description) {
    $options[$name] = array(
      'name' => "<strong><label for=\"edit-shunts-{$name}\">{$name}</label></strong>",
      'description' => $description,
    );
    $default_values[$name] = shunt_is_enabled($name);
  }

  // Compile table.
  $form['shunts'] = array(
    '#type' => 'tableselect',
    '#header' => $header,
    '#options' => $options,
    '#default_value' => $default_values,
  );

  $form['messages'] = array(
    '#type' => 'fieldset',
  );
  $form['messages']['shunt_message_forms'] = array(
    '#type' => 'textfield',
    '#title' => t('Disabled form'),
    '#default_value' => variable_get('shunt_message_forms', t("We're sorry, this form is currently unavailable.")),
    '#description' => t('When a form is disabled by a shunt, this message will be displayed.'),
  );
  $form['messages']['shunt_message_views'] = array(
    '#type' => 'textfield',
    '#title' => t('Disabled view'),
    '#default_value' => variable_get('shunt_message_views', t("We're sorry, the data for this page is currently unavailable.")),
    '#description' => t('When a view is disabled by a shunt, this message will be displayed.'),
  );
  $form['messages']['shunt_message_services'] = array(
    '#type' => 'textfield',
    '#title' => t('Disabled services resource'),
    '#default_value' => variable_get('shunt_message_services', t("We're sorry. this service is currently unavailable.")),
    '#description' => t('When a services resource is disabled by a shunt, this message will be displayed.'),
  );

  // Add submit button and handler.
  $form['actions']['#type'] = 'actions';
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save configuration'),
  );
  $form['#submit'][] = 'shunt_admin_settings_form_submit';

  return $form;
}

/**
 * Form submission handler for shunt_admin_settings_form().
 */
function shunt_admin_settings_form_submit($form, &$form_state) {

  _shunt_set_status_multiple($form_state['values']['shunts'], FALSE);

  // Create array of form values to set as variables.
  $variables = array(
    'shunt_message_forms',
    'shunt_message_views',
    'shunt_message_services',
  );

  // Exclude unnecessary elements.
  form_state_values_clean($form_state);

  foreach ($variables as $key) {
    $value = $form_state['values'][$key];
    if (is_array($value) && isset($form_state['values']['array_filter'])) {
      $value = array_keys(array_filter($value));
    }
    variable_set($key, $value);
  }
}
