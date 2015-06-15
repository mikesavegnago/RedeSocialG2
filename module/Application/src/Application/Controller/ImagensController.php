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
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
       
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