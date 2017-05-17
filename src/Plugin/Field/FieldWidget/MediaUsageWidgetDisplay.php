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
* Plugin implementation of the 'field_media_usage' widget, display only.
*
* @FieldWidget (
*   id = "field_media_usage_widget_display",
*   label = @Translation("Media usage widget display"),
*   field_types = {
*     "field_media_usage"
*   }
* )
*/
class MediaUsageWidgetDisplay extends WidgetBase {
  /**
  * {@inheritdoc}
  */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $row_attr = $items->get($delta)->getValue();
    if (!empty($row_attr)) {
      $entity = \Drupal::entityTypeManager()->getStorage($row_attr['entity_type'])->load($row_attr['entity_id']);
      $element['entity'] = array(
        '#title' => t('Entity'),
        '#type' => 'html_tag',
        '#tag' => 'a',
        '#value' => $entity->getTitle(),
        '#attributes' => array(
          'href' => '/' . $row_attr['entity_type'] . '/' . $row_attr['entity_id'],
        ),
      );

      $element['entity_actions_wrapper']['entity_actions'] = array(
        '#type' => 'dropbutton',
        '#links' => array(
          'links' => array(
            'title' => $this->t('Edit'),
            'url' => $entity->toUrl('edit-form'),
          ),
        ),
      );
    }

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