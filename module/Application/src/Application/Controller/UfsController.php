<?php
<<<<<<< HEAD
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Application\Form\Uf as Form;
=======
namespace Admin\Controller;

use Core\Controller\ActionController as ActionController;
use Admin\Form\Uf as Form;
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
use Zend\View\Model\ViewModel;

/**
* Controller Ufs
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
class UfsController extends ActionController
{
    /**
    *Função index
    *
    *@return void
    */
    public function indexAction()
    {
<<<<<<< HEAD
        $ufs = $this->getService('Application\Service\Uf')->fetchAll();
=======
        $ufs = $this->getService('Admin\Service\Uf')->fetchAll();
>>>>>>> parent of 456f75b... Revert "UF e Cidade"

        return new ViewModel(array('ufs' => $ufs));
    }
    
    /**
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
        $form = new Form();
        $request = $this->getRequest();
        if ($request->isPost()) {
<<<<<<< HEAD
            $form->setInputFilter(\Application\Model\Uf::getInputFilter());
=======
            $form->setInputFilter(\Admin\Model\Uf::getInputFilter());
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $values = $form->getData();
                try{
<<<<<<< HEAD
                    $uf = $this->getService('Application\Service\Uf')->save($values);
=======
                    $uf = $this->getService('Admin\Service\Uf')->save($values);
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                return $this->redirect()->toUrl('/admin/ufs');    
            }                    
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
<<<<<<< HEAD
            $uf = $this->getService('Application\Service\Uf')->find($id);
=======
            $uf = $this->getService('Admin\Service\Uf')->find($id);
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
            $form->bind($uf);
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
<<<<<<< HEAD
            $this->getService('Application\Service\Uf')->delete($id);
=======
            $this->getService('Admin\Service\Uf')->delete($id);
>>>>>>> parent of 456f75b... Revert "UF e Cidade"
        } catch(\Exception $e) {
            echo $e->getMessage();
        }

        return $this->redirect()->toUrl('/admin/ufs');
    }
}
