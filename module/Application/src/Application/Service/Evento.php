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

    public function saveEvento($values ,$valores) {
        
        $session = $this->getServiceManager()->get('Session');
         $perfil = $session->offsetGet('user');
         $em = $this->getObjectManager();
         
        if ((int) $values['id'] > 0)
            $evento = $em->find($values['id']);
        else
            $evento = new \Application\Entity\Evento();             
    
         $evento->setPerfil($perfil);
         $evento->setDescricao($values['descricao']);
         $evento->setDataEvento($values['dataEvento']);    
         var_dump($evento);exit;   
         
         
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
