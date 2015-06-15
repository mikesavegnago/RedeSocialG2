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
class Album extends Service {

    public function saveAlbum($values){
        
         $session = $this->getServiceManager()->get('Session');
         $usuario = $session->offsetGet('usuario');
        
         $perfil = $this->getService('Application\Service\Perfil')->find($usuario->getId());
        
        if(!isset($perfil)){
            var_dump("voce deve cadastrar um perfil");
        }
        
        if ((int) $values['id'] > 0){
            $album = $em->find($values['id']);
        }
        else{
            $album = new \Application\Entity\Album();             
        }
        
         $album->setPerfil($perfil);
         $album->setDescricao($values['descricao']);
         if($values['imagem'] != ''){
            $album->setImagem($values['imagem']);
         }                  
         
        $this->getObjectManager()->persist($album);
        
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar album' . $e);
            exit;
        }

        return $album;
    }

    public function removerAlbum($values)
    {
        
        $em = $this->getObjectManager();
        
        if ($values > 0) {
            $album = $em->find('\Application\Entity\Album',$values);
            $em->remove($album);

            try {
                $em->flush();
            } catch (\Exception $e) {
            }
        }
    }


    

}
