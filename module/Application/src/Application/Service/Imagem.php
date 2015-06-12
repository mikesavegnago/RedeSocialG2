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
class Imagem extends Service
{
   public function findImagem($values ,$em){
       
       $em = $this->getObjectManager();
       $imagem = $em->find('\Application\Entity\Imagem',$values);
       
       return $imagem;
   }
    
   public function saveImagem($values)
    {
       
        $imagem = new \Application\Entity\Imagem();
        $imagem->setImagem($values['imagem']);
        $imagem->setIdAlbum($values['idAlbum']);
        
        $this->getObjectManager()->persist($imagem);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar imagem'.$e);
        }

        return $imagem;        
    }

    
    public function removerImagem($values ,$em)
    {
        
        
        if ($values > 0) {
            $imagem = $em->find('\Application\Entity\Imagem',$values);
            $em->remove($imagem);

            try {
                $em->flush();
            } catch (\Exception $e) {
            }
        }
    }


}
