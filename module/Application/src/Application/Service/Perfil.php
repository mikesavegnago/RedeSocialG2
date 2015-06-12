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
class Perfil extends Service {

    public function savePerfil($values) {
        $session = $this->getServiceManager()->get('Session');
         $usuario = $session->offsetGet('user');
         $em = $this->getObjectManager();
         
        if ((int) $values['id'] > 0)
            $perfil = $em->find($values['id']);
        else
            $perfil = new \Application\Entity\Perfil();
        
        
         $perfil->setStatusRelacionamento($values['statusRelacionamento']);
         $perfil->setOndeTrabalha($values['ondeTrabalha']);
         $perfil->setFormacao($values['formacao']);
         $perfil->setProfissao($values['profissao']);
         $perfil->setPermissao($values['permissao']);
         $perfil->setNome($usuario->getNome());
         $perfil->setSobrenome($usuario->getSobrenome());
         $perfil->setEmail($usuario->getEmail());
         $perfil->setCelular($usuario->getCelular());
         $perfil->setSenha($usuario->getSenha());
         $perfil->setDataNascimento($usuario->getDataNascimento());
         $perfil->setSexo($usuario->getSexo());
         $perfil->setAutenticacao(true);
         
        //$endereco = $em->getRepository('\Application\Entity\Endereco')->findAll();
//
//        $perfil->setNome($values['nome']);
//        $perfil->setSobrenome($values['sobrenome']);
//        $perfil->setEmail($values['email']);
//        $perfil->setCelular($values['celular']);
//        $perfil->setSenha($values['senha']);
//        $perfil->setDataNascimento(new \DateTime($values['dataNascimento']));
//        $perfil->setSexo($values['sexo']);
//        $perfil->setAutenticacao(true);
//        $perfil->setRole($values['role']);

        $this->getObjectManager()->persist($perfil);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar dados' . $e);
            exit;
        }

        return $perfil;
    }

}
