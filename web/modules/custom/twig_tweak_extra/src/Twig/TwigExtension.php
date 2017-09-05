<?php

namespace Drupal\twig_tweak_extra\Twig;

use Drupal\Core\Render\Renderer;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Class TwigExtension.
 *
 * @package Drupal\twig_tweak_extra
 */
class TwigExtension extends \Twig_Extension {
        
  /**
  * {@inheritdoc}
  */
  public function getFunctions(){
    return array(
      new \Twig_SimpleFunction('drupal_form', [$this, 'drupalForm']),
      new \Twig_SimpleFunction('drupal_block_plugin', [$this, 'drupalBlockPlugin']),
      new \Twig_SimpleFunction('render_image_with_attributes', [$this, 'renderImageWithAttributes']),
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getFilters() {
    $filters = [
      new \Twig_SimpleFilter('add_classes', [$this, 'addClasses']),
    ];
    
    return $filters;
  }

  /**
  * Render form programmatically using form namespace
  */
  public function drupalForm($form_namespace) {
    $form = \Drupal::formBuilder()->getForm($form_namespace);
    return $form;
  }


  /**
  * Render block plugin programmatically
  */
  public function drupalBlockPlugin($block_id) {
    $block_manager = \Drupal::service('plugin.manager.block');
    $block = $block_manager->createInstance($block_id);
    return $block->build();
  }

  /**
   * Add extra classes to render array of image object
  */
  public function addClasses($image_object, $classes) {
    $image_object['#item_attributes']['class'][] = $classes;
    return $image_object;
  }

  /**
   * Unset default size of image
  */
  public function renderImageWithAttributes($image_object, $attributes) {
    foreach($attributes as $attribute => $value) {
      if($attribute == 'class') {
        $image_object['#item_attributes']['class'][] = $value;
      } else {
        $image_object['#item_attributes'][$attribute] = $value;
      }
    }
    return $image_object;
  }

 /**
  * {@inheritdoc}
  */
  public function getName() {
    return 'lemonade_day.twig.extension';
  }
}
