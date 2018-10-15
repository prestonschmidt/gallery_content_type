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
        
        $display_option = array(
            'yes' => t('Yes'),
            'no' => t('No'),
        );
        
        $form['gallery_content_type_heading'] = [
            '#type' => 'item',
            '#markup' => t('<h2>Available Configuration Options</h2>'),
        ];
        
        $form['gallery_content_type_user_wrapper'] = array(
            '#type' => 'fieldset',
            '#weight' => 1,
            '#attributes' => array(
                'class' => array(
                    'gallery-content-type-form-wrapper',
                ),
            ),
        );
                
        $form['gallery_content_type_user_wrapper']['show_user'] = array(
            '#type' => 'radios',
            '#title' => t('Show node author?'),
            '#required' => true,
            '#options' => $display_option,
            '#description' => t('Choose whether to show the author picture and name. '),
            '#default_value' => $config->get('show_user') ? : 'yes',
        );
        
        $form['gallery_content_type_details_wrapper'] = array(
            '#type' => 'fieldset',
            '#weight' => 1,
            '#attributes' => array(
                'class' => array(
                    'gallery-content-type-form-wrapper',
                ),
            ),
        );
                
        $form['gallery_content_type_details_wrapper']['show_details'] = array(
            '#type' => 'radios',
            '#title' => t('Show node details?'),
            '#required' => true,
            '#options' => $display_option,
            '#description' => t('Choose whether to show the node details. This includes publish date, views count. '),
            '#default_value' => $config->get('show_details') ? : 'yes',
        );
        
        return parent::buildForm($form, $form_state);
    }

  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        
        $values = $form_state->getValues();
        
        $this->config('gallery_content_type.gallery_content_type_settings')->set('show_user', $values['show_user']);
        $this->config('gallery_content_type.gallery_content_type_settings')->set('show_details', $values['show_details'])->save();
        
        parent::submitForm($form, $form_state);
        
    }

}