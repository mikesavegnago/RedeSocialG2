<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Index
*
* @category Application
* @package  Controller
* @author   Mike Savegnago <mikesavegnago@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class IndexController extends ActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function layoutAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $session = $this->getServiceLocator()->get('Session');
        
        $murais = $em->getRepository('\Application\Entity\Mural')
                    ->findAll();
        $comentarios = $em->getRepository('\Application\Entity\Comentario')
                    ->findAll();
         
        return new ViewModel(
                array(
                    'murais' => $murais,
                    'comentarios' =>$comentarios
                )
        );
        
        //return new ViewModel();
    }
    
    public function sobreAction()
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
}
