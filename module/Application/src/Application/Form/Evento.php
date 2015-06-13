<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
* Form Usuario
*
* @category Prime
* @package  Form
* @author   Mike Savegnago <mikesavegnago@unochapeco.edu.br>
*/
class Evento extends Form
{
    public function __construct($em)
    {
        parent::__construct('evento');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));
       
        $this->add(array(
            'name' => 'descricao',
            'type' => 'text',
            'options' => array(
                'label' => 'Descricao*'
            ),
            'attributes' => array(
                'placeholder' => 'Informe a descricao do Evento',
                'id' => 'descricao',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'name' => 'dataEvento',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data do Evento*'
            ),
            'attributes' => array(
                'placeholder' => 'Informe a data do evento',
                'id' => 'dataEvento',
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
