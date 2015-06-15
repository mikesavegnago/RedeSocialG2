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
class EventosController extends ActionController
{
    /**
    *Função index
    *
    *@return void
    */
    public function indexAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $perfil = (int) $this->params()->fromRoute('perfil', 0);
        if ($perfil > 0) {
            $perfil = $em->getRepository('\Application\Entity\Usuario')->find($perfil);
        }
        
        $eventos = $em->getRepository('\Application\Entity\Evento')->findAll();
        
        
        return new ViewModel(
            array(
                'perfil' => $perfil,
                'eventos' => $eventos
            )
        );
    }
    
    /**
    *Função index
    *
    *@return void
    */
    public function eventoAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $evento = (int) $this->params()->fromRoute('id', 0);
        if ($evento > 0) {
            $evento = $em->getRepository('\Application\Entity\Evento')->find($evento);
        }
       
        return new ViewModel(
            array(
                'evento' => $evento
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
        $form = new \Application\Form\Evento($em);
        $request = $this->getRequest();

         if($request->isPost()) {
            $valores = $request->getPost();
            $file = $request->getFiles('capa');
            $valores['capa'] = $this->getService('Application\Service\UpLoadImagem')->uploadPhoto($file);
            $evento = new \Application\Entity\Evento();
            $filtros = $evento->getInputFilter();
            $form->setInputFilter($filtros);
            $form->setData($valores);

           if (!$form->isValid()){
                $values = $form->getData();
                
                try{
                    $evento = $this->getService('Application\Service\Evento')->saveEvento($values);
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