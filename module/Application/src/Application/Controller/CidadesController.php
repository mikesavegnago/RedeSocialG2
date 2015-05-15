<?php
<<<<<<< HEAD
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Application\Form\Cidade as Form;
=======
namespace Admin\Controller;

use Core\Controller\ActionController as ActionController;
use Admin\Form\Cidade as Form;
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
use Zend\View\Model\ViewModel;

/**
* Controller Cidades
*
<<<<<<< HEAD
* @category Application
=======
* @category Admin
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
* @package  Controller
* @author   Cezar Junior de Souza <cezar08@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class CidadesController extends ActionController
{
    /**
    *Função index
    *
    *@return void
    */
    public function indexAction()
    {
<<<<<<< HEAD
        var_dump($this->getService('Application\Service\Cidade')->fetchAll());
=======
        var_dump($this->getService('Admin\Service\Cidade')->fetchAll());
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
        exit;
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
<<<<<<< HEAD
            $form->setInputFilter(\Application\Model\Cidade::getInputFilter());            
=======
            $form->setInputFilter(\Admin\Model\Cidade::getInputFilter());            
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
            $form->setData($request->getPost());            
            if ( $form->isValid() ) {                
                $values = $form->getData();
                try {
<<<<<<< HEAD
                    $uf = $this->getService('Application\Service\Cidade')->save($values);
=======
                    $uf = $this->getService('Admin\Service\Cidade')->save($values);
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
                } catch(\Exception $e) {
                    echo $e->getMessage(); 
                    exit;
                }
<<<<<<< HEAD
                return $this->redirect()->toUrl('/Application/cidades');    
=======
                return $this->redirect()->toUrl('/admin/cidades');    
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
            }                    
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
<<<<<<< HEAD
            $cidade = $this->getService('Application\Service\Cidade')->find($id);            
=======
            $cidade = $this->getService('Admin\Service\Cidade')->find($id);            
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
            $form->bind($cidade);
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
        try{
<<<<<<< HEAD
            $this->getService('Application\Service\Cidade')->delete($id);
=======
            $this->getService('Admin\Service\Cidade')->delete($id);
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
        }catch(\Exception $e){
            echo $e->getMessage();
            exit;
        }

<<<<<<< HEAD
        return $this->redirect()->toUrl('/Application/cidades');
=======
        return $this->redirect()->toUrl('/admin/cidades');
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
    }
}