<?php

namespace Drupal\stemteachers_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;

/**
 * Provides links to list and grid views of the lesson plan listing.
 *
 * @Block(
 *   id = "lesson_plan_view_select_block",
 *   admin_label = @Translation("Lesson Plan view selector"),
 * )
 */
class LessonPlanViewSelectBlock extends BlockBase implements \Drupal\Core\Block\BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\stemteachers_custom\Form\LessonPlanViewSelectForm');
    return $form;
  }

}

namespace Drupal\stemteachers_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Render\Markup;

class LessonPlanViewSelectForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'lesson_plan_view_select_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attributes']['class'][] = 'lesson-plan-select-form';

    $sort_by = \Drupal::request()->query->get('sort_by');
    $form['sort_by'] = [
      '#type' => 'select',
      '#title' => [
      '#markup' => Markup::create('<span class="visually-hidden">' . $this->t('Sort by date') . '</span>'),
      ],
      '#options' => [
      'none' => $this->t('Sort by'),
      'date' => $this->t('Date'),
      'vote' => $this->t('Popularity'),
      'featured' => $this->t('Featured'),
      ],
      '#attributes' => [
      'class' => ['lesson-plan-sort-select'],
      ],
      '#default_value' => $sort_by,
    ];
    // $form['submit'] = [
    //   '#type' => 'submit',
    //   '#value' => $this->t('Apply'),
    // ];

    $form['view_select'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => ['lesson-plan-view-select'],
      ],
    ];

    $form['view_select']['list_link'] = [
      '#type' => 'link',
      '#url' => Url::fromUserInput('/stem-lesson-plans'),
      '#title' => [
        '#markup' => Markup::create('<span class="visually-hidden">List view</span><i class="fas fa-icon fa-list-ul"></i>'),
      ],
    ];

    $form['view_select']['grid_link'] = [
      '#type' => 'link',
      '#url' => Url::fromUserInput('/stem-lesson-plans/grid'),
      '#title' => [
        '#markup' => Markup::create('<span class="visually-hidden">Grid view</span><i class="fas fa-icon fa-border-all"></i>'),
      ],
    ];


    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $selected_value = $form_state->getValue('sort');
    \Drupal::messenger()->addMessage($this->t('Selected sort order: @sort', ['@sort' => $selected_value]));

    //alter search query based on selected value
  }

}