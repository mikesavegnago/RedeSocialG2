<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Application\Form\Cidade as Form;
use Zend\View\Model\ViewModel;

/**
* Controller Cidades
*

* @category Application
 * 
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

        var_dump($this->getService('Application\Service\Cidade')->fetchAll());
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
            $form->setInputFilter(\Application\Model\Cidade::getInputFilter());            
            $form->setData($request->getPost());            
            if ( $form->isValid() ) {                
                $values = $form->getData();
                try {
                    $uf = $this->getService('Application\Service\Cidade')->save($values);
                } catch(\Exception $e) {
                    echo $e->getMessage(); 
                    exit;
                }
                return $this->redirect()->toUrl('/Application/cidades');    
            }                    
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id > 0) {
            $cidade = $this->getService('Application\Service\Cidade')->find($id);            
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
            $this->getService('Application\Service\Cidade')->delete($id);
        }catch(\Exception $e){
            echo $e->getMessage();
            exit;
        }
        return $this->redirect()->toUrl('/Application/cidades');
    }
}