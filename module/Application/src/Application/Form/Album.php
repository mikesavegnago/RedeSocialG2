<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
* Form Album
*
* @category Prime
* @package  Form
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
*/
class Album extends Form
{
    public function __construct($em)
    {
        parent::__construct('album');
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
            'name' => 'imagem',
            'type' => 'file',
            'options' => array(
                'label' => 'imagem*'),
            'attributes' => array(
               // 'placeholder' => 'Informe o nome',
                'id' => 'imagem',
                'enctype' => 'multipart/form-data',)
        ));
        
        
    }
}
