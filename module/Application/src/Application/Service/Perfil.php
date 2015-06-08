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
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        if ((int) $values['id'] > 0)
            $perfil = $this->find($values['id']);
        else
            $perfil = new \Application\Entity\Perfil();
        $perfil->setStatusRelacionamento($values['statusRelacionamento']);
        $perfil->setProfissao($values['profissao']);
        $perfil->setFormacao($values['formacao']);
        $perfil->setOndeTrabalha($values['ondeTrabalha']);
        //campos para endereco
        //relacionamento com endereco
        $endereco = $em->getRepository('\Application\Entity\Endereco')->findAll();
        var_dump($endereco);
        exit;

        $perfil->setEndereco();

//        protected 'endereco' => null
//        protected 'perfil' => null
//        
        $perfil->setNome($values['nome']);
        $perfil->setSobrenome($values['sobrenome']);
        $perfil->setEmail($values['email']);
        $perfil->setCelular($values['celular']);
        $perfil->setSenha($values['senha']);
        $perfil->setDataNascimento(new \DateTime($values['dataNascimento']));
        $perfil->setSexo($values['sexo']);
        $perfil->setAutenticacao(true);
        $perfil->setRole($values['role']);

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
