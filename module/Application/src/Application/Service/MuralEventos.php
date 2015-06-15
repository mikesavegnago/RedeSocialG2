<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;
use Zend\Session\Container;

/**
* Service Save Entityes
*
* @category Admin
* @package  Service
* @author   Mike Savegnago <mikesavegnago.edu.br>
* @link     localhost
 */
class MuralEventos extends Service
{

    public function saveMural($values)
    {

        $session = $this->getServiceManager()->get('Session');
        $usuario = $session->offsetGet('usuario');
        $perfil = $this->getService('Application\Service\Perfil')->find($usuario->getId());
        $evento = $this->getService('Application\Service\Evento')->find($values['id']);
        $mural = new \Application\Entity\MuralEvento();

        $mural->setTexto($values['descricao']);
        if ($values['foto']) {
            $mural->setImagem($values['foto']);
        }
        $mural->setPerfil($perfil);
        $mural->setEvento($evento);

        $this->getObjectManager()->persist($mural);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados'.$e);
        }

        return $mural;
    }

      public function removerMural($values )
    {

        $em = $this->getObjectManager();

        if ($values > 0) {
            $mural = $em->find('\Application\Entity\MuralEvento',$values);
            $em->remove($mural);

            try {
                $em->flush();
            } catch (\Exception $e) {
            }
        }
    }



    public function find($id)
    {
        $id = (int) $id;
        $mural = $this->getObjectManager()->getRepository('Application\Entity\MuralEventos')
                ->findBy(array('id' => $id));

        return $result;
    }

}
