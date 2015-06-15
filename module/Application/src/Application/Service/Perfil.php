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
class Perfil extends Service 
{
    /**
     * @var string
     */
    protected $entity = '\Application\Entity\Perfil';

    public function savePerfil($values) {
        
        $session = $this->getServiceManager()->get('Session');
        $usuario = $session->offsetGet('usuario');
        $em = $this->getObjectManager();
        
        if ($values['id'] > 0 ) {
        $perfil = $this->find($values['id']);
        } else { 
            $perfil = new \Application\Entity\Perfil();
        }
        if ($values['cidade']) {
            $cidade = $this->getService('Application\Service\Cidade')->findWithDesc($values);
        }
        if ($values['endereco']) {
            $endereco = $this->getService('Application\Service\Endereco')->saveEndereco($values['endereco']);
        }
        $idade = $values['data_nasc'];
        $compara = explode("/", $idade);
        $compara = (new \DateTime())->format('Y') - $compara[2];
        
        if($compara < 16){
            return false;
        }
        
        $perfil->setAutenticacao(true);
        $perfil->setStatusRelacionamento($values['statusRelacionamento']);
        $perfil->setOndeTrabalha($values['ondeTrabalha']);
        $perfil->setFormacao($values['formacao']);
        $perfil->setProfissao($values['profissao']);
        $perfil->setPermissao($values['permissao']);
        $perfil->setNome($values['nome']);
        $perfil->setEmail($values['email']);
        $perfil->setCelular($values['celular']);
        if ($values['senha']) {
            $perfil->setSenha($values['senha']);
        }
        $perfil->setDataNascimento($values['data_nasc']);
        $perfil->setSexo($values['sexo']);
        $perfil->setFoto($values['foto_perfil']);
        $perfil->setCapa($values['foto_capa']);
        $perfil->setEndereco($endereco);
         
         
        $this->getObjectManager()->persist($perfil);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar dados' . $e);
            exit;
        }

        return $perfil;
    }
    
    public function find($values){
       $em = $this->getObjectManager();
       $perfil = $this->getEm()->find($this->entity, (int) $values);
       
       return $perfil;
   }


    
}
