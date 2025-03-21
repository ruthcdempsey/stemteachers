<?php

namespace Drupal\stemteachers_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an h2 that says "Related Content".
 *
 * @Block(
 *   id = "related_content_header_block",
 *   admin_label = @Translation("Related Content Header"),
 * )
 */
class RelatedContentHeaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => '<h2>' . $this->t('Related Content') . '</h2>',
    ];
  }

}
