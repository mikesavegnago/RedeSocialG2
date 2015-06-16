<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;
use Application\Entity\Imagem as ImagemModel;

/**
* Service Save Entityes
*
* @category Application
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
        $imagem = new ImagemModel();
        $imagem->setImagem($values['imagem']);
        $album = $this->getObjectManager()->find('\Application\Entity\Album',$values['album']);
        $imagem->setIdAlbum($album);

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
