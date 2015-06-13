<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;

/**
 * Service Save Entityes
 *
 * @category Application
 * @package  Service
 * @author   Paulo José Cella <paulocella@unochapeco.edu.br> 
 * @link     localhost 
 */
class Perfil extends Service {

    public function savePerfil($values, $valores) {
        
        $session = $this->getServiceManager()->get('Session');
         $usuario = $session->offsetGet('usuario');
         $em = $this->getObjectManager();
         
         
       if ((int) $values['id'] > 0){
            $perfil = $this->findPerfil($values['id']);
            if(!isset($perfil)){
                $perfil = new \Application\Entity\Perfil();
            }
       }else{
         $perfil = new \Application\Entity\Perfil();
       }
       
       
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
         
         $valuesImagem['id'] = null;
         $valuesImagem['idAlbun'] = null;
         $valuesImagem['imagem'] = $valores['foto'];
         
         
         $endereco = $this->getService('Application\Service\Endereco')->saveEndereco($valuesEndereco);
         $imagem = $this->getService('Application\Service\Imagem')->saveImagem($valuesImagem);
    
         
         $perfil->setId($values['id']);
         $perfil->setStatusRelacionamento($values['statusRelacionamento']);
         $perfil->setOndeTrabalha($values['ondeTrabalha']);
         $perfil->setFormacao($values['formacao']);
         $perfil->setProfissao($values['profissao']);
         $perfil->setPermissao($values['permissao']);
         $perfil->setNome($usuario->getNome());
         //$perfil->setSobrenome($usuario->getSobrenome());
         $perfil->setEmail($usuario->getEmail());
         $perfil->setCelular($values['celular']);
         $perfil->setSenha($usuario->getSenha());
         $perfil->setDataNascimento($usuario->getDataNascimento());
         $perfil->setSexo($values['sexo']);
         $perfil->setImagem($imagem);
         $perfil->setEndereco($endereco);
         $perfil->setAutenticacao(true);
         
         
         //var_dump($perfil);exit;
         
         
        $this->getObjectManager()->persist($perfil);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar dados' . $e);
            exit;
        }

        return $perfil;
    }
    
    
     public function find($id)
    {
        $id = (int) $id;
        $perfis = $this->getObjectManager()->getRepository('Application\Entity\Perfil')
                ->findAll();
        
        foreach ($perfis as $perfil){
            
            if($perfil->getId()== $id){
                $result = $perfil;
            }
        }
        
        return $result;
    }


    
}
