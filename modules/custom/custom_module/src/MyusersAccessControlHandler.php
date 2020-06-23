<?php

namespace Drupal\custom_module;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the My Users entity.
 *
 * @see \Drupal\custom_module\Entity\Myusers.
 */
class MyusersAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\custom_module\Entity\MyusersInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished my users entities');
        }


        return AccessResult::allowedIfHasPermission($account, 'view published my users entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit my users entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete my users entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add my users entities');
  }


}
