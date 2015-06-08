<?php
namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
*
*@category Admin
*@package Form
*@author Cristiano Luiz Salvagni <cristiano.salvagni@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class Cidade extends Form
{
    public function __construct($em = null)
    {
        parent::__construct('cidade');
        $this->setName('cidade');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(
            array(
                    'type' => 'text',
                    'name' => 'cidade',
                    'options' => array(
                        'label' => 'Cidade'
                    ),
                ));

         $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'uf',
            'options' => array(                
                'label' => 'UF',
                'object_manager' => $em,
                'target_class' => 'Application\Entity\Uf',
                'empty_option' => 'SELECIONE UM ESTADO',
                'property' => 'descricao',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('descricao' => 'ASC'),
                    ),
                ),
            ),            
        ));

                
    }
}

?>