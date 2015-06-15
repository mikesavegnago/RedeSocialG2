<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;

/**
 * Service Save Entityes
 *
 * @category Application
 * @package  Service
 * @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br> 
 * @link     localhost 
 */
class Evento extends Service 
{
    public function saveEvento($values){
        
        $session = $this->getServiceManager()->get('Session');
        $usuario = $session->offsetGet('usuario');
        
        
        try {
             $perfil = $this->getService('Application\Service\Perfil')->find($usuario->getId());
        } catch (\Exception $e) {
            throw new EntityException("voce deve cadastrar um perfil");
        }
        
        if ((int) $values['id'] > 0){
            $evento = $em->find($values['id']);
        }
        else{
            $evento = new \Application\Entity\Evento();             
        }
        
         $evento->setPerfil($perfil);
         
         
         $evento->setDescricao($values['descricao']);
         $evento->setTitulo($values['titulo']);
         $evento->setCapa($values['capa']);
         $evento->setDataEvento(new \DateTime($values['dataEvento']));
         
         
         
        $this->getObjectManager()->persist($evento);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar dados' . $e);
            exit;
        }

        return $evento;
    }

}
