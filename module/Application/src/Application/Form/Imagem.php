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
class Imagem extends Form
{
    public function __construct($em)
    {
        parent::__construct('imagem');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));
        $this->add(array(
            'type' => 'hidden',
            'name' => 'album'
        ));

           $this->add(array(
            'name' => 'imagem',
            'type' => 'file',
            'options' => array(
                'label' => 'imagem*'),
            'attributes' => array(
                'id' => 'imagem',
                'enctype' => 'multipart/form-data',)
        ));
        
        
    }
}
