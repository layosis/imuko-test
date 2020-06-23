<?php

namespace Drupal\custom_module\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Log imuko entity.
 *
 * @ingroup custom_module
 *
 * @ContentEntityType(
 *   id = "log_imuko",
 *   label = @Translation("Log imuko"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\custom_module\LogImukoListBuilder",
 *     "views_data" = "Drupal\custom_module\Entity\LogImukoViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\custom_module\Form\LogImukoForm",
 *       "add" = "Drupal\custom_module\Form\LogImukoForm",
 *       "edit" = "Drupal\custom_module\Form\LogImukoForm",
 *       "delete" = "Drupal\custom_module\Form\LogImukoDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\custom_module\LogImukoHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\custom_module\LogImukoAccessControlHandler",
 *   },
 *   base_table = "log_imuko",
 *   translatable = FALSE,
 *   admin_permission = "administer log imuko entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/log_imuko/{log_imuko}",
 *     "add-form" = "/admin/structure/log_imuko/add",
 *     "edit-form" = "/admin/structure/log_imuko/{log_imuko}/edit",
 *     "delete-form" = "/admin/structure/log_imuko/{log_imuko}/delete",
 *     "collection" = "/admin/structure/log_imuko",
 *   },
 *   field_ui_base_route = "log_imuko.settings"
 * )
 */
class LogImuko extends ContentEntityBase implements LogImukoInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getFecha() {
    return $this->get('fecha')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setFecha($value) {
    $this->set('fecha', $value);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function getTipoLog() {
    return $this->get('tipo_log')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTipoLog($value) {
    $this->set('tipo_log', $value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Log imuko entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['fecha'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Fecha'))
      ->setDescription(t('Fecha de Registro'));
      
    $fields['tipo_log'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Tipo log'))
      ->setDescription(t('Tipo Log.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status']->setDescription(t('A boolean indicating whether the Log imuko is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
