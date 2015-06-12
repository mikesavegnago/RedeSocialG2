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

    public function savePerfil($values ,$valores) {
        $session = $this->getServiceManager()->get('Session');
         $usuario = $session->offsetGet('user');
         $em = $this->getObjectManager();
         
        if ((int) $values['id'] > 0)
            $perfil = $em->find($values['id']);
        else
            $perfil = new \Application\Entity\Perfil();
        
         $valuesCidade['id'] = null;
         $valuesCidade['uf'] = $valores['uf'];
         $valuesCidade['cidade'] = $valores['cidade'];
         
         $cidade = $this->getService('Application\Service\Cidade')->findWithDesc($valuesCidade);
         $valuesEndereco['cidade'] = $cidade;
         $valuesEndereco['id'] = null;
         $valuesEndereco['numero'] = $valores['numero'];
         $valuesEndereco['rua'] = $valores['rua'];
         $valuesEndereco['bairro'] = $valores['bairro'];
         $valuesEndereco['uf'] = $valores['uf'];
         
         $endereco = $this->getService('Application\Service\Endereco')->saveEndereco($valuesEndereco);
    
         
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
         $perfil->setEndereco($endereco);
         $perfil->setAutenticacao(true);
         
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
