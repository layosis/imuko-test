<?php

namespace Drupal\custom_module;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Log imuko entity.
 *
 * @see \Drupal\custom_module\Entity\LogImuko.
 */
class LogImukoAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\custom_module\Entity\LogImukoInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished log imuko entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published log imuko entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit log imuko entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete log imuko entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add log imuko entities');
  }


}
