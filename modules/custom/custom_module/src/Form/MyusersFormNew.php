<?php

namespace Drupal\custom_module\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Form\FormStateInterface;
use Drupal\custom_module\Entity\LogImuko;
use Drupal\custom_module\Entity\Myusers;
use Entity;
use PhpParser\Node\Stmt\Return_;

/**
 * Class MyusersFormNew.
 */
class MyusersFormNew extends FormBase {

  protected $existe;
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'myusers_form_new';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->existe = false;
    $form['nombre'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nombre'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => true,
      '#ajax' => [
        'callback' => '::controlUsers',
        'wrapper' => 'conten-user-control',
        'disable-refocus' => TRUE,
      ],    
    ];

    $form['controlajax'] = [
      '#type' => 'textfield',
      '#title' => $this->t('control'),
      '#required' => true,
      '#prefix' => "<div id='conten-user-control'>",
      '#suffix' => "</div>"
    ];



    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $query = \Drupal::entityQuery('myusers');
    $query->condition('nombre',$form_state->getValue('nombre'),"=");
    $entity_ids = $query->execute();
    if( !empty($entity_ids))
      $form_state->setError($form['nombre'], "El usuario ya existe");

    parent::validateForm($form, $form_state);
    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
   
    $url = Url::fromRoute('custom_module.myusers_list');
    $form_state->setRedirectUrl($url);

    $data = [
      "nombre" => $form_state->getValue("nombre")
    ];
    $entity = Myusers::create($data);
    $entity->save();
    $id = $entity->id();

    $datalog = [
      "tipo_log" => "Registro { id: ". $id .", Nombre: ". $form_state->getValue("nombre")." }",
      "fecha" => strtotime(date("d-m-Y H:i:s"))
    ];
    $entity =  LogImuko::create($datalog);
    $entity->save();

    \Drupal::messenger()->addMessage("Usuario creado: " . $id);

  }


  public function controlUsers(array &$form, FormStateInterface $form_state) {
    
    $query = \Drupal::entityQuery('myusers');
    $query->condition('nombre',$form_state->getValue('nombre'),"=");
    $entity_ids = $query->execute();
    if( !empty($entity_ids))
      $form['controlajax']["#value"] = 1;
    else 
      $form['controlajax']["#value"] = 'abc123';

    return $form['controlajax'];
  }


}
