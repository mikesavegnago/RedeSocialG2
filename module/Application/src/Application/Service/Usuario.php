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
class Usuario extends Service
{
   public function findUsuario($values){
       $em = $this->getObjectManager();
       $usuario = $em->find ('\Application\Entity\Usuario',$values);
       
       return $usuario;
   }
    
   public function saveUsuario($values)
    {
       $em = $this->getObjectManager();
       if ((int) $values['id'] > 0) {
            $usuario = $em->find('\Application\Entity\Usuario',$values['id']);
        } else {
            $usuario = new \Application\Entity\Usuario();
        }

        $usuario->setNome($values['nome']);
        $usuario->setEmail($values['email']);
        $usuario->setSenha(md5($values['senha']));
        $idade = $values['data_nasc'];
        $compara = explode("/", $idade);
        $compara = (new \DateTime())->format('Y') - $compara[2];
        
        if($compara < 16){
            return false;
        }
        
        $usuario->setDataNascimento($values['data_nasc']);
        $usuario->setAutenticacao(true);
        
        $this->getObjectManager()->persist($usuario);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados'.$e);
        }

        return $usuario;        
    }

    
    public function removerUsuario($values )
    {
        
        $em = $this->getObjectManager();
        
        if ($values > 0) {
            $usuario = $em->find('\Application\Entity\Usuario',$values);
            $em->remove($usuario);

            try {
                $em->flush();
            } catch (\Exception $e) {
            }
        }
    }


}
