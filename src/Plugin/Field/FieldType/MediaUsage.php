<?php

/**
* @file
* Contains \Drupal\media_entity_usage\Plugin\Field\FieldType\MediaUsage.
*/

namespace Drupal\media_entity_usage\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
* Plugin implementation of the 'field_media_usage' field type.
*
* @FieldType (
*   id = "field_media_usage",
*   label = @Translation("Media usage"),
*   description = @Translation("Usages of a media entity."),
*   default_widget = "field_media_usage_widget",
*   default_formatter = "field_media_usage_formatter"
* )
*/
class MediaUsage extends FieldItemBase {
  /**
  * {@inheritdoc}
  */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'entity_type' => array(
          'type' => 'varchar',
          'length' => 255,
          'not null' => TRUE,
        ),
        'entity_id' => array(
          'type' => 'int',
          'not null' => TRUE,
        ),
      ),
    );
  }

  /**
  * {@inheritdoc}
  */
  public function isEmpty() {
    $value1 = $this->get('entity_type')->getValue();
    $value2 = $this->get('entity_id')->getValue();
    return empty($value1) || empty($value2);
  }

  /**
  * {@inheritdoc}
  */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Add our properties.
    $properties['entity_type'] = DataDefinition::create('string')
      ->setLabel(t('Entity type'))
      ->setDescription(t('Referenced entity type'));

    $properties['entity_id'] = DataDefinition::create('integer')
      ->setLabel(t('Entity id'))
      ->setDescription(t('Referenenced entity id'));

    return $properties;
  }
}