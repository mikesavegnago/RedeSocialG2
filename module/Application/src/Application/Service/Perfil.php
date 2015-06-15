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
            if(!isset($perfil)){
               $perfil = new \Application\Entity\Perfil();
            }
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
        if ($values['senha'] != '' && $values['senha']) {
            $perfil->setSenha($values['senha']);
        }else{
            $perfil->setSenha($usuario->getSenha());
        }
        $perfil->setDataNascimento($values['data_nasc']);
        $perfil->setSexo($values['sexo']);
        if ($values['foto_perfil']) {
            $perfil->setFoto($values['foto_perfil']);
        }
        if ($values['foto_capa']) {
            $perfil->setCapa($values['foto_capa']);
        }
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

   public function fetchAllByNome($nome)
    {
        $nome = mb_strtoupper($nome, 'UTF-8');
        $select = $this->getObjectManager()->createQueryBuilder()
            ->select('Perfil.nome as label', 'Perfil.id')
            ->from('Application\Entity\Perfil', 'Perfil')
            ->where("Perfil.nome like ?1")
            ->setParameter(1, "%$nome%");

        return $select->getQuery()->getArrayResult();
    }

    public function fetchAllAmigos($id)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getObjectManager();
        $select = $em->createQueryBuilder()
            ->select('p,a')
            ->from('Application\Entity\Usuario', 'p')
            ->innerJoin('p.amigos', 'a')
            ->where("p.id = ?1")
            ->setParameter(1, $id);
        if ($select->getQuery()->getResult()) {
            $resultado = $select->getQuery()->getSingleResult();
            return $resultado->getAmigos();
        } else {
            return;
        }
    }

    public function findAmigo($id)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getObjectManager();
        $select = $em->createQueryBuilder()
            ->select('p,a')
            ->from('Application\Entity\Usuario', 'p')
            ->innerJoin('p.amigos', 'a')
            ->where("a.id = ?1")
            ->setParameter(1, $id);
        if ($select->getQuery()->getResult()) {
            $resultado = $select->getQuery()->getSingleResult();
            return $resultado->getAmigos();
        } else {
            return;
        }
    }
}
