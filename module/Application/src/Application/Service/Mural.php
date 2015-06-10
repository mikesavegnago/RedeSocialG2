<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;

/**
* Service Save Entityes
*
* @category Admin
* @package  Service
* @author   Paulo José Cella <paulocella@unochapeco.edu.br> 
* @link     localhost 
 */
class Mural extends Service
{

    public function saveMural($values)
    {
        if( (int) $values['id'] > 0)
            $mural = $this->find($values['id']);
        else
            $mural = new \Application\Entity\Mural();
        
        $mural->setDescricao($values['descricao']);

        $foto = $this->getService('Application\Service\UpLoadImagem')->uploadPhoto($values['foto']);

        $usuario->setFoto($foto);
        
        $this->getObjectManager()->persist($usuario);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados'.$e);
        }

        return $usuario;        
    }



}
