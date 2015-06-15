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
class Deslike extends Service {

    public function saveDeslike($values) {
        
        $session = $this->getServiceManager()->get('Session');
         $usuario = $session->offsetGet('user');
         $em = $this->getObjectManager();
         
         $deslike = new \Application\Entity\Deslike();
        
        $this->getObjectManager()->persist($deslike);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar deslike' . $e);
            exit;
        }

        return $deslike;
    }
    
    public function deleteDeslike($id)
    {
        $deslike = $this->find($id);
        if(!$deslike)
           throw new EntityException('Registro não encontrado');
        $this->getObjectManager()->remove($deslike);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao deletar deslike');
        }
    }

}
