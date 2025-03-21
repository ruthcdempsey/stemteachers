<?php

namespace Drupal\stemteachers_custom\Plugin\Block;

use Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException;
use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityFormBuilder;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides either the current page's hero or the page title.
 *
 * @Block(
 *   id = "add_event_form_block",
 *   admin_label = @Translation("Add Event Form"),
 * )
 */
class AddEventFormBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The Form builder service.
   *
   * @var \Drupal\Core\Entity\EntityFormBuilder
   */
  protected EntityFormBuilder $entityFormBuilder;

  /**
   * The services for managing entities overall.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected EntityTypeManagerInterface $entityTypeManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityFormBuilder $entityFormBuilder, EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityFormBuilder = $entityFormBuilder;
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity.form_builder'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $return = [];

    // @see https://gorannikolovski.com/snippet/how-programmatically-render-entity-form
    try {
      $node = $this->entityTypeManager->getStorage('node')
        ->create(['type' => 'event']);
      $return['form'] = $this->entityFormBuilder->getForm($node, 'brief');
    } catch (InvalidPluginDefinitionException|PluginNotFoundException $e) {
      // @todo catch a possible exception.
    }

    return $return;
  }

}
