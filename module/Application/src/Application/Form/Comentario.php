<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
* Form Usuario
*
* @category Prime
* @package  Form
* @author   Paulo Cella <paulocella@unochapeco.edu.br>
*/
class Comentario extends Form
{
    public function __construct($em)
    {
        parent::__construct('comentario');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));
        
//         $this->add(array(
//            'name' => 'perfil',
//            'type' => 'text',
//            'options' => array(
//                'label' => 'Peril*'
//            ),
//            'attributes' => array(
//                'placeholder' => 'Informe o perfil',
//                'id' => 'perfil',
//                'class' => 'form-control'
//            )
//        ));
        
        
        
        $this->add(array(
            'name' => 'comentario',
            'type' => 'text',
            'options' => array(
                'label' => 'Comentario*'
            ),
            'attributes' => array(
                'placeholder' => 'Informe o comentario',
                'id' => 'comentario',
                'class' => 'form-control'
            )
        ));
        
    }
}


