<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Application\Form\Uf as Form;
use Zend\View\Model\ViewModel;

/**
* Controller Ufs
*
* @category Application
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
        $ufs = $this->getService('Application\Service\Uf')->fetchAll();

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
            $form->setInputFilter(\Application\Model\Uf::getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $values = $form->getData();
                try{
                    $uf = $this->getService('Application\Service\Uf')->save($values);
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                return $this->redirect()->toUrl('/admin/ufs');    
            }                    
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $uf = $this->getService('Application\Service\Uf')->find($id);
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
            $this->getService('Application\Service\Uf')->delete($id);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }

        return $this->redirect()->toUrl('/admin/ufs');
    }