<?php

/**
 * @file
 * Describes hooks and plugins provided by the Shunt module.
 */

use Drupal\shunt\Entity\Shunt;

/**
 * @file
 * Hooks provided by the Shunt module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Perform actions when a shunt status is being changed.
 *
 * This hook is fired immediately before a shunt is tripped or reset.
 *
 * @param \Drupal\shunt\Entity\Shunt $shunt
 *   The ID of shunt that is being acted upon.
 * @param bool $action
 *   The action being performed: either "trip" or "reset".
 */
function hook_shunt_status_change(Shunt $shunt, $action) {
  // React to a particular shunt's status being changed.
  if ($shunt->id() == 'example') {

    // React differently based on action.
    if ($action == 'trip') {
      \Drupal::messenger()->addStatus(t("You're tripping the example shunt!"));
    }
    else {
      \Drupal::messenger()->addStatus(t("You're resetting the example shunt!"));
    }
  }

  // React to ANY shunt's status being changed--whether it's defined in your
  // module or not.
  \Drupal::messenger()->addStatus(t("You're changing the status of the %id shunt!", [
    '%id' => $shunt->id(),
  ]));
}

/**
 * @} End of "addtogroup hooks".
 */
