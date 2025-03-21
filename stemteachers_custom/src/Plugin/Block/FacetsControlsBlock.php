<?php

namespace Drupal\stemteachers_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides buttons and links to apply and reset facets.
 *
 * @Block(
 *   id = "facets_controls_block",
 *   admin_label = @Translation("Facets controls"),
 * )
 */
class FacetsControlsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#attributes' => [
        'class' => ['facets-controls'],
      ],
      'apply' => [
        '#type' => 'button',
        '#value' => $this->t('Apply Filters'),
        '#attributes' => [
          'class' => [
            'facets-controls-apply',
            'btn',
            'btn-maroon',
          ],
          'type' => 'button',
        ],
      ],
      'reset' => [
        '#type' => 'link',
        '#url' => Url::fromUserInput('/stem-lesson-plans', [
          'attributes' => [
            'class' => [
              'facets-controls-reset',
            ],
          ],
        ]),
        '#title' => $this->t('Clear all filters'),
      ],
    ];
  }

}
