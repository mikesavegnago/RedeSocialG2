<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Perfis
*
* @category Application
* @package  Controller
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class PerfisController extends ActionController
{
    /**
    *Função index
    *
    *@return void
    */
    public function indexAction()
    {
        
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $perfil= $em->getRepository('\Application\Entity\Perfil')->findAll();
        
        return new ViewModel();
    }
    
    /**
    *Função para criar o layout
    *
    *@return void
    */
    public function layoutAction()
    {
        return new ViewModel();
    }
    
    /**
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
        // fazer com que o form /na parte de usuarios ja venha preechido quando clicado em cadsatrar perfiol
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new \Application\Form\Perfil($em);
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $valores = $request->getPost();
            $file = $request->getFiles('foto');
            $valores['foto'] = $this->getService('Application\Service\UpLoadImagem')->uploadPhoto($file);
            $valoresRequest=$valores;
            $perfil = new \Application\Entity\Perfil();
  
            
            $filtros = $perfil->getInputFilter();
            $form->setInputFilter($filtros);
            $filtros = $perfil->getInputFilter();
            $form->setData($valores);
            
            if (!$form->isValid()) {
                $values = $form->getData();
                try{
                    $perfil = $this->getService('Application\Service\Perfil')->savePerfil($values,$valoresRequest);
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                $id = (int) $this->params()->fromRoute('id', 0);
                return $this->redirect()->toUrl('/application/index/sobre/id/'.$id);    
            }  
            
        }
        

    }


    /**
    *Função delete
    *
    *@return void
    */
    public function deleteAction()
    {
    
    }
    
}