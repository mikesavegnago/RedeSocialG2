<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Application\Form\Usuario as Form;
use Zend\View\Model\ViewModel;
use Core\Model\EntityException as EntityException;

/**
* Controller Usuarios
*
* @category Application
* @package  Controller
* @author   Mike Savegnago <mikesavegnago@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class UsuariosController extends ActionController
{
    /**
    *Função para criar a view
    *
    *@return void
    */
    public function indexAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $usuarios = $em->getRepository('\Application\Entity\Usuario')->findAll();
        
         return new ViewModel(array(
             'usuarios' => $usuarios
         ));
    }
    
    /**
    *Função para criar o layout
    *
    *@return void
    */
    public function layoutAction()
    {
        var_dump($expression);exit;
         return new ViewModel();
    }

    /**
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new Form($this->getObjectManager());
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $valores = $request->getPost();
            $usuario = new \Application\Entity\Usuario();
            $filtros = $usuario->getInputFilter();
            $form->setInputFilter($filtros);
            $form->setData($valores);
            
            
            if (!$form->isValid()) {
                $values = $form->getData();
                
                try{
                    $usuario = $this->getService('Application\Service\Usuario')
                            ->saveUsuario($values);
                    if(!$usuario){
                        $this->flashMessenger()->addErrorMessage('Você deve ser maior de 16 anos!');
                        return $this->redirect()->toUrl('/');
                    }
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                $this->getService('Application\Service\Auth')
                            ->authenticate($values);
                return $this->redirect()->toUrl('/application/index/layout');    
            }                    
        }
        
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if ($id > 0) {
            $usuario = $this->getService('Application\Service\Usuario')
                    ->findUsuario($id);
            $form->bind($usuario);
        }

        return new ViewModel(array('form' => $form));
    }

    /**
    *Função delete 
    *
    *@return void
    */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        try {
            $this->getService('Application\Service\Usuario')->removerUsuario($id);
        } catch(\Exception $e) {
            echo $e->getMessage(); exit;
        }

        return $this->redirect()->toUrl('/application/usuarios');
    }
    
    public function getPhotoAction()
    {
        header('Content-Type: image');
        $id = (int) $this->params()->fromRoute('id', 0);
        $photo = $this->getServiceUser()->getFoto($id);
        $view = new ViewModel(array('photo' => $photo));
        $view->setTerminal(true);

        return $view;
    }

    /**
     * @return object
     */
    private function getServiceUser()
    {
        return $this->getServiceLocator()->get('Application\Service\Usuario');
    }
}