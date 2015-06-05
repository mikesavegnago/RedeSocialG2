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
         return new ViewModel();
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
            $perfil = new \Application\Entity\Peril();
            $filtros = $usuario->getInputFilter();
            $form->setInputFilter($filtros);
            $form->setData($valores);
            
            var_dump($form->isValid());exit;
            
            if ($form->isValid()) {
                $values = $form->getData();
                
                try{
                    $usuario = $this->getService('Admin\Service\Usuario')->save($values);
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                return $this->redirect()->toUrl('/');    
            }                    
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $usuario = $this->getService('Admin\Service\Usuario')->find($id);
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
        $id = (int) $this->params()->fromRoute('id', 0);
        try {
            $this->getService('Admin\Service\Usuario')->delete($id);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }

        return $this->redirect()->toUrl('/admin/usuarios');
    }
}