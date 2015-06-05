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
class Usuario extends Service
{

    public function saveUsuario($values)
    {
        if( (int) $values['id'] > 0)
            $usuario = $this->find($values['id']);
        else
            $usuario = new \Application\Entity\Usuario();
        
        var_dump($usuario);exit;
        $cidade->setDescricao($values['descricao']);
        $uf = $this->getService('Admin\Service\Uf')->find($values['uf']);
        $cidade->setUf($uf);
        $this->getObjectManager()->persist($cidade);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados');
        }

        return $cidade;        
    }



}
