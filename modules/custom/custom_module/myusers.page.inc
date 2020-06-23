<?php

/**
 * @file
 * Contains myusers.page.inc.
 *
 * Page callback for My Users entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for My Users templates.
 *
 * Default template: myusers.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_myusers(array &$variables) {
  // Fetch Myusers Entity Object.
  $myusers = $variables['elements']['#myusers'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
