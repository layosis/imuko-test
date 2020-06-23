<?php

namespace Drupal\custom_module\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining My Users entities.
 *
 * @ingroup custom_module
 */
interface MyusersInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the My Users name.
   *
   * @return string
   *   Name of the My Users.
   */
  public function getNombre();

  /**
   * Sets the My Users name.
   *
   * @param string $name
   *   The My Users name.
   *
   * @return \Drupal\custom_module\Entity\MyusersInterface
   *   The called My Users entity.
   */
  public function setNombre($name);

  /**
   * Gets the My Users creation timestamp.
   *
   * @return int
   *   Creation timestamp of the My Users.
   */
  public function getCreatedTime();

  /**
   * Sets the My Users creation timestamp.
   *
   * @param int $timestamp
   *   The My Users creation timestamp.
   *
   * @return \Drupal\custom_module\Entity\MyusersInterface
   *   The called My Users entity.
   */
  public function setCreatedTime($timestamp);

}
