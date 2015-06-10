<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
* Form Usuario
*
* @category Prime
* @package  Form
* @author  Paulo Cella <paulocella@unochapeco.edu.br>
*/
class Mural extends Form
{
    public function __construct($em)
    {
        parent::__construct('mural');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));
        
        
       $this->add(array( 
            'name' => 'foto', 
            'type' => 'file', 
            'options' => array( 
                'label' => 'foto*' ), 
            'attributes' => array(
             'placeholder' => 'Informe o nome', 
             'id' => 'foto', 
             'enctype' => 'multipart/form-data', )
              ));



          $this->add(array(
            'name' => 'descricao',
            'type' => 'text',
            'options' => array(
                'label' => 'descricao*'
            ),
            'attributes' => array(
                'placeholder' => 'Informe a descricao',
                'id' => 'descricao',
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
