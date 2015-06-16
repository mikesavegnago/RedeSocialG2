<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Imagens
*
* @category Application
* @package  Controller
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class ImagensController extends ActionController
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
        $album = (int) $this->params()->fromRoute('album', 0);
        $fotos = $em->getRepository('\Application\Entity\Imagem')->findBy(array('idAlbum' => $album));

        return new ViewModel(
            array(
                'perfil' => $perfil,
                'fotos' => $fotos,
                'album' => $album
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
        $perfil = (int) $this->params()->fromRoute('perfil', 0);
        
        if ($perfil > 0) {            
            $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $perfil = $em->getRepository('\Application\Entity\Usuario')->find($perfil);
            
        }
        
        $albuns = $em->getRepository('\Application\Entity\Album')->findBy(array('perfil' => $perfil->getId()));

        return new ViewModel(
            array(
                'perfil' => $perfil,
                'albuns' => $albuns
            )
        );
        
        
    }
    
    /**
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new \Application\Form\Imagem($em);
        $request = $this->getRequest();
        $album = (int) $this->params()->fromRoute('album', 0);
        
         if($request->isPost()){
            $valores = $request->getPost();
            $foto = $request->getFiles('imagem');
            if ($foto['name'] != '') {
                $valores['imagem'] = $this->getService('Application\Service\UpLoadImagem')
                        ->uploadPhoto($foto);
            }
           $valores['album'] = $album;
            $imagem = new \Application\Entity\Imagem();
            $filtros = $imagem->getInputFilter();
            $form->setInputFilter($filtros);
            $form->setData($valores);

           if ($form->isValid()){
                $values = $form->getData();
                try{
                    $imagem = $this->getService('Application\Service\Imagem')->saveImagem($values);
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
    
    }
    
}