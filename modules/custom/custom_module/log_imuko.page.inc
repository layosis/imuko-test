<?php

/**
 * @file
 * Contains log_imuko.page.inc.
 *
 * Page callback for Log imuko entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Log imuko templates.
 *
 * Default template: log_imuko.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_log_imuko(array &$variables) {
  // Fetch LogImuko Entity Object.
  $log_imuko = $variables['elements']['#log_imuko'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
