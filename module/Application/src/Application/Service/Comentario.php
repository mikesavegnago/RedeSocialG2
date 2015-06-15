<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;
use Core\Controller\ActionController as ActionController;

/**
* Service Save Entityes
*
* @category Admin
* @package  Service
* @author   Paulo José Cella <paulocella@unochapeco.edu.br>
* @link     localhost
 */
class Comentario extends Service
{
   public function findComentario($values){
       $em = $this->getObjectManager();
       $comentario = $em->find ('\Application\Entity\Comentario',$values);

       return $comentario;
   }

   public function saveComentario($values)
    {
        $session = $this->getServiceManager()->get('Session');
        $usuario = $session->offsetGet('usuario');

        $perfil = $this->getService('Application\Service\Perfil')->find($usuario->getId());
        $mural = $this->getService('Application\Service\Mural')->find((int)$values['id']);
        $em = $this->getObjectManager();
        $comentario = new \Application\Entity\Comentario();

        $comentario->setComentario($values['comentario']);
        $comentario->setPerfil($perfil);
        $comentario->setMural($mural);
        $comentario->setData();

        $this->getObjectManager()->persist($comentario);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados'.$e);
        }

        return $comentario;
    }


    public function removerComentario($values)
    {

        $em = $this->getObjectManager();

        if ($values > 0) {
            $comentario = $em->find('\Application\Entity\Comentario',$values);
            $em->remove($comentario);

            try {
                $em->flush();
            } catch (\Exception $e) {
            }
        }
    }


}
