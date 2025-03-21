<?php

namespace Drupal\stemteachers_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a proxy datepicker.
 *
 * @Block(
 *   id = "date_picker_proxy_block",
 *   admin_label = @Translation("Date picker proxy"),
 * )
 */
class DatePickerProxyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Render array that returns button.
    return [
      '#attributes' => [
        'class' => ['date-picker-proxy'],
      ],
      'child' => [],
    ];
  }

}
