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
class Endereco extends Service
{
//   public function findUsuario($values ,$em){
//       
//       $usuario = $em->find('\Application\Entity\Usuario',$values);
//       
//       return $usuario;
//   }
    
   public function saveEndereco($values)
    {
//        if( (int) $values['id'] > 0)
//            $usuario = $this->find($values['id']);
//        else
//            $usuario = new \Application\Entity\Usuario();
//        
//        $usuario->setNome($values['nome']);
//        $usuario->setEmail($values['email']);
//        $usuario->setSenha($values['senha']);
//        $usuario->setSobrenome($values['sobrenome']);
//        $usuario->setCelular($values['celular']);
//        $usuario->setDataNascimento( new \DateTime($values['dataNascimento']));
//        $idade =  (new \DateTime())->format('Y') -  ($usuario->getDataNascimento()->format('Y')) ;
//        
//        if($idade < 16){
//            die('usuario não pode se cadastrar pois sua idade é menor que 16 anos');
//        }
//        
//        $usuario->setSexo($values['sexo']);
//        $usuario->setAutenticacao($values['autenticado']);
//        $usuario->setRole($values['role']);
//        
//        $this->getObjectManager()->persist($usuario);
//        try{
//            $this->getObjectManager()->flush();
//        }catch(\Exception $e){
//            throw new EntityException('Erro ao salvar dados'.$e);
//        }

//        return $usuario;        
    }

    
//    public function removerUsuario($values ,$em)
//    {
//        
//        
//        if ($values > 0) {
//            $usuario = $em->find('\Application\Entity\Usuario',$values);
//            $em->remove($usuario);
//
//            try {
//                $em->flush();
//            } catch (\Exception $e) {
//            }
//        }
//    }


}
