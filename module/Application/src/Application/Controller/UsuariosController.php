<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Application\Form\Usuario as Form;
use Zend\View\Model\ViewModel;

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
                    $usuario = $this->getService('Application\Service\Usuario')->saveUsuario($values);
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                return $this->redirect()->toUrl('/');    
            }                    
        }
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $usuario = $this->getService('Application\Service\Usuario')->find($id);
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
            $this->getService('Application\Service\Usuario')->removerUsuario($id, $em);
        } catch(\Exception $e) {
            echo $e->getMessage(); exit;
        }

        return $this->redirect()->toUrl('/application/usuarios');
    }
}