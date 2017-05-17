<?php

/**
 * @file
 * Contains \Drupal\media_entity_usage\Plugin\Field\FieldFormatter\MediaUsageFormatter.
 */

namespace Drupal\media_entity_usage\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'field_media_usage' formatter.
 *
 * @FieldFormatter (
 *   id = "field_media_usage_edit_formatter",
 *   label = @Translation("Media usage edit formatter"),
 *   field_types = {
 *     "field_media_usage"
 *   }
 * )
 */
class MediaUsageEditFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode = NULL) {
    $elements = array();

    foreach ($items as $delta => $item) {
      if (isset($item->entity_id) && isset($item->entity_type)) {
        $entity = \Drupal::entityTypeManager()->getStorage($item->entity_type)->load($item->entity_id);
        $markup = '<a href="/' . $item->entity_type . '/' . $item->entity_id . '/edit">Edit</a>';
      }
      else {
        $markup = 'No reference';
      }

      $elements[$delta] = array(
        '#type' => 'markup',
        '#markup' => $markup,
      );
    }

    return $elements;
  }
}