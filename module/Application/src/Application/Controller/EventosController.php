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
        $eventos = $this->getService('Application\Service\Evento')->fetchAllEventos($perfil->getId());
        $todos_eventos ='';
        if ($eventos) {
            foreach ($eventos as $evento) {
                $todos_eventos = $em->getRepository('\Application\Entity\Evento')
                        ->findBy(array('id' => $evento->getId()));
            }
        }

        $eventos = $em->getRepository('\Application\Entity\Evento')
                        ->findBy(array('perfil_criador' => $perfil->getId()));
        
        
        return new ViewModel(
            array(
                'perfil' => $perfil,
                'eventos' => $eventos,
                'todos_eventos' => $todos_eventos
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

        $murais = $em->getRepository('\Application\Entity\MuralEvento')
                    ->findBy(array('evento' => array($evento->getId())),array('id' => 'DESC'));

        $perfil = (int) $this->params()->fromRoute('perfil', 0);
        if ($perfil > 0) {
            $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $perfil = $em->getRepository('\Application\Entity\Usuario')->find($perfil);
        }

        $participantes = $evento->getPerfil();
        
        return new ViewModel(
            array(
                'evento' => $evento,
                'perfil' => $perfil,
                'murais' => $murais,
                'participantes' => $participantes
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
    *Função Participar
    *
    *@return void
    */
    public function participarAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $usuario = $session->offsetGet('usuario');

        $evento = (int) $this->params()->fromRoute('evento', 0);

        /* @var $em \Doctrine\ORM\EntityManager */
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $em->getConnection()->executeQuery(
                sprintf('INSERT INTO participantes_evento (evento, perfil) VALUES (%s,%s)', $evento, $usuario->getId())
                );
        return $this->redirect()->toUrl('/application/eventos/evento/id/'.$evento.'/perfil/'.$usuario->getId());
    }

}