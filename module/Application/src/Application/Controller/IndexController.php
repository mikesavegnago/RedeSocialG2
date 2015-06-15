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
        $usuario = $session->offsetGet('usuario');
        $amigos = $this->getService('Application\Service\Perfil')->fetchAllAmigos($usuario->getId());
        if ($amigos) {
            foreach ($amigos as $amigo) {
                $murais = $em->getRepository('\Application\Entity\Mural')
                        ->findBy(array('perfil' => array($usuario->getId(), $amigo->getId())),array('data' => 'DESC'));
            }
        } else {
            $murais = $em->getRepository('\Application\Entity\Mural')
                    ->findBy(array('perfil' => array($usuario->getId())),array('data' => 'DESC'));
        }
        $comentarios = $em->getRepository('\Application\Entity\Comentario')
                    ->findAll();

        return new ViewModel(
                array(
                    'murais' => $murais,
                    'comentarios' =>$comentarios
                )
        );
    }

    public function sobreAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $usuario = $session->offsetGet('usuario');
        $perfil = (int) $this->params()->fromRoute('perfil', 0);

        if ($perfil > 0) {
            $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $perfil = $em->getRepository('\Application\Entity\Usuario')->find($perfil);
        }
        $amigos = $this->getService('Application\Service\Perfil')->findAmigo($perfil->getId());
        $murais = $em->getRepository('\Application\Entity\Mural')
                    ->findBy(array('perfil' => $perfil->getId()));
        $comentarios = '';
        foreach ($murais as $mural) {
            $comentarios = $em->getRepository('\Application\Entity\Comentario')
                    ->findBy(array('mural' => $mural->getId()), array('data' => 'DESC'));
        }
        return new ViewModel(
            array(
                'murais' => $murais,
                'comentarios' =>$comentarios,
                'perfil' => $perfil,
                'amigo'=> $amigos
            )
        );
    }
}
