<?php

/**
* @file
* Contains \Drupal\media_entity_usage\Plugin\Field\FieldWidget\MediaUsageWidget.
*/

namespace Drupal\media_entity_usage\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Plugin implementation of the 'field_media_usage' widget.
*
* @FieldWidget (
*   id = "field_media_usage_widget",
*   label = @Translation("Media usage widget"),
*   field_types = {
*     "field_media_usage"
*   }
* )
*/
class MediaUsageWidget extends WidgetBase {
  /**
  * {@inheritdoc}
  */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['entity_type'] = array(
      '#title' => t('Entity type'),
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->entity_type) ? $items[$delta]->entity_type : NULL,
    );
    
    $element['entity_id'] = array(
      '#title' => t('Entity id'),
      '#type' => 'number',
      '#default_value' => isset($items[$delta]->entity_id) ? $items[$delta]->entity_id : 0,
      '#size' => 3,
    );

    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
        '#attributes' => array('class' => array('container-inline')),
      );
    }

    return $element;
  }
}