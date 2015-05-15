<?php
namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;

/**
*
*@category Admin
*@package Form
*@author Cezar Junior de Souza <cezar08@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class Uf extends Form
{
    public function __construct()
    {
        parent::__construct('uf');
        $this->setName('uf');

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(
            array(
                    'type' => 'text',
                    'name' => 'descricao',
                    'options' => array(
                        'label' => 'UF'
                    ),
                ));

               
    }
}

?>