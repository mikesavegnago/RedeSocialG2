<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Eventos
*
* @category Application
* @package  Controller
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class AlbunsController extends ActionController
{
    /**
    *Função index
    *
    *@return void
    */
    public function indexAction()
    {
        $perfil = (int) $this->params()->fromRoute('perfil', 0);
        if ($perfil > 0) {            
            $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $perfil = $em->getRepository('\Application\Entity\Usuario')->find($perfil);
        }

        return new ViewModel(
            array(
                'perfil' => $perfil
            )
        );
    }
    
    /**
    *Função index
    *
    *@return void
    */
    public function albumAction()
    {
        $perfil = (int) $this->params()->fromRoute('perfil', 0);
        if ($perfil > 0) {            
            $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $perfil = $em->getRepository('\Application\Entity\Usuario')->find($perfil);
            
        }

        return new ViewModel(
            array(
                'perfil' => $perfil
            )
        );
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

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new \Application\Form\Album($em);
        $request = $this->getRequest();

        var_dump($request);exit;
         if($request->isPost()) {
            $valores = $request->getPost();
            $file = $request->getFiles('imagem');
            $valores['imagem'] = $this->getService('Application\Service\UpLoadImagem')->uploadPhoto($file);
            $album = new \Application\Entity\Album();
            $filtros = $album->getInputFilter();
            $form->setInputFilter($filtros);
            $form->setData($valores);

           if (!$form->isValid()){
                $values = $form->getData();
                
                try{
                    $album = $this->getService('Application\Service\Album')->saveAlbum($values);
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                
                return $this->redirect()->toUrl('/application/index/layout');    
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

    $id = $this->params()->fromRoute('id', 0);
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        try {
            $this->getService('Application\Service\Album')->removerAlbum($id);
        } catch(\Exception $e) {
            echo $e->getMessage(); exit;
        }

        return $this->redirect()->toUrl('/application/index/layout');
    }
    }
    
}