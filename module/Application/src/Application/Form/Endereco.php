<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
* Form Endereco
*
* @category Prime
* @package  Form
* @author   Paulo Cella <paulocella@unochapeco.edu.br>
*/
class Endereco extends Form
{
    public function __construct($em)
    {
        parent::__construct('endereco');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));
        
         $this->add(array(
            'name' => 'rua',
            'type' => 'text',
            'options' => array(
                'label' => 'Rua*'
            ),
            'attributes' => array(
                'placeholder' => 'Informe a rua',
                'id' => 'rua',
                'class' => 'form-control'
            )
        ));
        
        
        
        $this->add(array(
            'name' => 'numero',
            'type' => 'text',
            'options' => array(
                'label' => 'numero*'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o numero',
                'id' => 'numero',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'bairro',
            'type' => 'text',
            'options' => array(
                'label' => 'Bairro*'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o bairro',
                'id' => 'bairro',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));
        
    }
}
