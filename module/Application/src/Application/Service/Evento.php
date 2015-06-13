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
class Evento extends Service {

    public function saveEvento($values){
        
         $session = $this->getServiceManager()->get('Session');
         $usuario = $session->offsetGet('user');
        
        $perfil = $this->getObjectManager()->getRepository('\Application\Entity\Perfil')
                ->findOneBy(array('email'=>$usuario->getEmail()));
         
        if ((int) $values['id'] > 0)
            $evento = $em->find($values['id']);
        else
            $evento = new \Application\Entity\Evento();             
    
         $evento->setPerfil($perfil);
         $evento->setDescricao($values['descricao']);
         $evento->setDataEvento($values['dataEvento']);
         
         
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
