<?php


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Core\Controller\ActionController as ActionController;

class EnderecosController extends ActionController {

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
        
        if ($request->isPost())
        {
            $valores = $request->getPost();
            $endereco = new \Application\Entity\Endereco();
            $cidade = new \Application\Entity\Cidade();
            $ufs = new \Application\Entity\Uf();
            $filtrosEndereco = $endereco->getInputFilter();
            $filtrosCidade = $cidade->getInputFilter();
            $filtrosUfs = $ufs->getInputFilter();
            $formEndereco->setInputFilter($filtrosEndereco);
            $formEndereco->setData($valores);
            $formCidade->setInputFilter($filtrosCidade);
            $formCidade->setData($valores);
            $formUfs->setInputFilter($filtrosUfs);
            $formUfs->setData($valores);
            $formCidade->isValid();
            $formUfs->isValid();
            
            if (!($formEndereco->isValid() && $formCidade->isValid() && $formUfs->isValid()))
            {
                
                $valuesEndereco = $formEndereco->getData();
                $valuesCidade = $formCidade->getData();
                $valuesUfs = $formUfs->getData();
                
                try{
                    $ufs = $this->getService('Application\Service\Uf')->saveUfs($valuesUfs);
//                    $cidade = $this->getService('Application\Service\Cidade')
//                            ->saveUfs($valuesCidade);
//                    $endereco = $this->getService('Application\Service\Endereco')
//                            ->saveEndereco($valuesEndereco);
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
