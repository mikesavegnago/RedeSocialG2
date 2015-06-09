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

    public function saveAction($values)
    {
        var_dump($values);exit;
        if( (int) $values['id'] > 0)
            $usuario = $this->find($values['id']);
        else
            $usuario = new \Application\Entity\Usuario();
        
        $usuario->setNome($values['nome']);
        $usuario->setEmail($values['email']);
        $usuario->setSenha($values['senha']);
        $usuario->setSobrenome($values['sobrenome']);
        $usuario->setCelular($values['celular']);
        $usuario->setDataNascimento( new \DateTime($values['dataNascimento']));
        $usuario->setSexo($values['sexo']);
        $usuario->setAutenticacao($values['autenticado']);
        $usuario->setRole($values['role']);
        
        $this->getObjectManager()->persist($usuario);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados'.$e);
        }

        return $usuario;        
    }



}
