<?php

namespace Drupal\custom_module\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Log imuko entities.
 *
 * @ingroup custom_module
 */
interface LogImukoInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Gets the Log imuko creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Log imuko.
   */
  public function getCreatedTime();

  /**
   * Sets the Log imuko creation timestamp.
   *
   * @param int $timestamp
   *   The Log imuko creation timestamp.
   *
   * @return \Drupal\custom_module\Entity\LogImukoInterface
   *   The called Log imuko entity.
   */
  public function setCreatedTime($timestamp);

}
