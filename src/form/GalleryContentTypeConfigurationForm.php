<?php

namespace Drupal\gallery_content_type\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures size and shape settings of the gallery content type module.
 */
class GalleryContentTypeConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
    public function getFormId() {
        return 'gallery_content_type_settings';
    }

  /**
   * {@inheritdoc}
   */
    protected function getEditableConfigNames() {
        return [
            'gallery_content_type.gallery_content_type_settings',
        ];
    }

  /**
   * {@inheritdoc}
   */
    public function buildForm(array $form, FormStateInterface $form_state) {
        
        $config = $this->config('gallery_content_type.gallery_content_type_settings');
        
        $yesnoOptions = array(
            'yes' => t('Yes'),
            'no' => t('No'),
        );
        
        $form['gallery_content_type_node_heading'] = [
            '#type' => 'item',
            '#markup' => t('<h2>Available Node Configuration Options</h2>'),
        ];
        
        $form['gallery_content_type_node_wrapper'] = array(
            '#type' => 'fieldset',
            '#attributes' => array(
                'class' => array(
                    'gallery-content-type-node-wrapper',
                ),
            ),
        );
                
        $form['gallery_content_type_node_wrapper']['show_node_author'] = array(
            '#type' => 'radios',
            '#title' => t('Show node author?'),
            '#required' => true,
            '#options' => $yesnoOptions,
            '#description' => t('Choose whether to show the author picture and name. '),
            '#default_value' => $config->get('show_node_author') ? : 'yes',
        );
                                
        $form['gallery_content_type_node_wrapper']['show_node_details'] = array(
            '#type' => 'radios',
            '#title' => t('Show node details?'),
            '#required' => true,
            '#options' => $yesnoOptions,
            '#description' => t('Choose whether to show the node details. This includes publish date, views count. '),
            '#default_value' => $config->get('show_node_details') ? : 'yes',
        );
        
        $form['gallery_content_type_node_wrapper']['show_gallery_option_bar'] = array(
            '#type' => 'radios',
            '#title' => t('Show gallery option bar?'),
            '#required' => true,
            '#options' => $yesnoOptions,
            '#description' => t('Choose whether to show the gallery option bar. '),
            '#default_value' => $config->get('show_gallery_option_bar') ? : 'yes',
        );
        
        $form['gallery_content_type_node_teaser_heading'] = [
            '#type' => 'item',
            '#markup' => t('<h2>Available Node Teaser Configuration Options</h2>'),
        ];
        
        $form['gallery_content_type_node_teaser_wrapper'] = array(
            '#type' => 'fieldset',
            '#attributes' => array(
                'class' => array(
                    'gallery-content-type-node-teaser-wrapper',
                ),
            ),
        );
        
        $form['gallery_content_type_node_teaser_wrapper']['show_node_teaser_author'] = array(
            '#type' => 'radios',
            '#title' => t('Show node teaser author?'),
            '#required' => true,
            '#options' => $yesnoOptions,
            '#description' => t('Choose whether to show the author name on node teaser display. '),
            '#default_value' => $config->get('show_node_teaser_author') ? : 'yes',
        );
        
        $form['gallery_content_type_node_teaser_wrapper']['show_node_teaser_publish'] = array(
            '#type' => 'radios',
            '#title' => t('Show node teaser publish info?'),
            '#required' => true,
            '#options' => $yesnoOptions,
            '#description' => t('Choose whether to show the publish date a views count on node teaser display. '),
            '#default_value' => $config->get('show_node_teaser_publish') ? : 'yes',
        );
        
        return parent::buildForm($form, $form_state);
    }

  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        
        $values = $form_state->getValues();
        
        $this->config('gallery_content_type.gallery_content_type_settings')->set('show_node_author', $values['show_node_author']);
        $this->config('gallery_content_type.gallery_content_type_settings')->set('show_node_details', $values['show_node_details']);
        $this->config('gallery_content_type.gallery_content_type_settings')->set('show_gallery_option_bar', $values['show_gallery_option_bar']);
        $this->config('gallery_content_type.gallery_content_type_settings')->set('show_node_teaser_author', $values['show_node_teaser_author']);
        $this->config('gallery_content_type.gallery_content_type_settings')->set('show_node_teaser_publish', $values['show_node_teaser_publish'])->save();
        
        parent::submitForm($form, $form_state);
        
    }

}