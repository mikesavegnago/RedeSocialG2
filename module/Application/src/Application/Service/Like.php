<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;

/**
 * Service Save Entityes
 *
 * @category Application
 * @package  Service
 * @author   Paulo José Cella <paulocella@unochapeco.edu.br> 
 * @link     localhost 
 */
class Like extends Service {

    public function saveLike($values) {
        
        $session = $this->getServiceManager()->get('Session');
         $usuario = $session->offsetGet('user');
         $em = $this->getObjectManager();
         
         $like = new \Application\Entity\Like();
        
         
         
        $this->getObjectManager()->persist($like);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar like' . $e);
            exit;
        }

        return $like;
    }
  
    public function deleteLike($id)
    {
        $like = $this->find($id);
        if(!$like)
           throw new EntityException('Registro não encontrado');
        $this->getObjectManager()->remove($like);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao deletar like');
        }
    }

}
