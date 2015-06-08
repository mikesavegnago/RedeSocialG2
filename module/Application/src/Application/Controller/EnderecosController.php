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

    public function indexAction() 
    {
        
    }

    public function saveAction() 
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $formEndereco = new \Application\Form\Endereco($em);
        $formCidade = new \Application\Form\Cidade($em);
        $formUfs = new \Application\Form\Uf();

        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $valores = $request->getPost();
            var_dump($valores);exit;
            $usuario = new \Application\Entity\Usuario();
            $filtros = $usuario->getInputFilter();
            $formEndereco->setInputFilter($filtros);
            $formEndereco->setData($valores);
            $formCidade->setInputFilter($filtros);
            $formCidade->setData($valores);
            $formUfs->setInputFilter($filtros);
            $formUfs->setData($valores);
            
            
            if (!$formEndereco->isValid()) {
                $valuesEndereco = $formEndereco->getData();
                $valuesCidade = $formCidade->getData();
                $valuesUfs = $formUfs->getData();
                
                try{
                    $ufs = $this->getService('Application\Service\Ufs')
                            ->saveUfs($valuesUfs);
                    $cidade = $this->getService('Application\Service\Cidade')
                            ->saveUfs($valuesCidade);
                    $endereco = $this->getService('Application\Service\Endereco')
                            ->saveEndereco($valuesEndereco);
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                return $this->redirect()->toUrl('/application/enderecos/save');    
            }                    
        }
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $usuario = $this->getService('Application\Service\Usuario')
                    ->findUsuario($id ,$em);
            $form->bind($usuario);
        }

        return new ViewModel(array(
            'formEndereco' => $formEndereco,
            'formUfs' => $formUfs,
            'formCidade' => $formCidade
        ));
    }
        
        
        
    

    public function deleteAction() {
        
    }

}
