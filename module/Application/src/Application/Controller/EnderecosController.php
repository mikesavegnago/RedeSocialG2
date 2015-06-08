<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EnderecosController extends AbstractActionController {

    public function indexAction() {
        
    }

    public function saveAction() 
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $formEndereco = new \Application\Form\Endereco($em);
        $formCidade = new \Application\Form\Cidade($em);
        $formUfs = new \Application\Form\Uf();

        return new ViewModel(array(
            'formEndereco' => $formEndereco,
            'formUfs' => $formUfs,
            'formCidade' => $formCidade
        ));
    }

    public function deleteAction() {
        
    }

}
