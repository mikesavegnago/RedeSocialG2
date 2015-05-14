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
class Usuario extends Form
{
    public function __construct($em)
    {
        parent::__construct('usuario');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));
        
        $this->add(
            array(
                    'type' => 'text',
                    'name' => 'nome',
                    'options' => array(
                        'label' => 'Nome*'
                    ),
                ));
        
        $this->add(
            array(
                    'type' => 'text',
                    'name' => 'email',
                    'options' => array(
                        'label' => 'Email*'
                    ),
                ));
        
        $this->add(
            array(
                    'type' => 'password',
                    'name' => 'senha',
                    'options' => array(
                        'label' => 'Senha*'
                    ),
                ));     
    }
}
