<?php

namespace Drupal\stemteachers_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an event search proxy form.
 *
 * @Block(
 *   id = "event_search_proxy_block",
 *   admin_label = @Translation("Event Search proxy"),
 * )
 */
class EventSearchProxyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Render array that returns button.
    return [
      '#attributes' => [
        'class' => [
          'align-items--center',
          'display--flex',
          'gap--30px',
          'layout--flex-row',
        ],
      ],
      'sq' => [
        '#type' => 'search',
        '#title' => $this->t('Search events'),
        '#attributes' => [
          'form' => 'views-exposed-form-search-api-vertical-1',
          'name' => 'sq',
        ],
      ],
      'form-actions' => [
        '#type' => 'submit',
        '#value' => $this->t('Search Events'),
        '#attributes' => [
          'form' => 'views-exposed-form-search-api-vertical-1'
        ],
      ],
    ];
  }

}
