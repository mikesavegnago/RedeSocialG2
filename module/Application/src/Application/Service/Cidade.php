<?php

namespace Admin\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;

/**
* Service Cidade
*
* @category Admin
* @package  Service
* @author   Cezar Junior de Souza <cezar08@unochapeco.edu.br> 
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost 
 */
class Cidade extends Service
{
    /**
    *Função Select All
    *
    *@return array
    */
    public function fetchAll()
    {
        $select = $this->getObjectManager()->createQueryBuilder()
            ->select('Cidade')->from('Admin\Model\Cidade', 'Cidade');

        return $select->getQuery()->getResult();
    }

    public function fetchAllByCidade($nome)
    {
        $nome = mb_strtoupper($nome, 'UTF-8');
        $select = $this->getObjectManager()->createQueryBuilder()
            ->select('Cidade.descricao as label', 'Cidade.id')
            ->from('Admin\Model\Cidade', 'Cidade') 
            ->where("Cidade.descricao like ?1")
            ->setParameter(1, "%$nome%");

        return $select->getQuery()->getArrayResult();
    }

    /**
    *Função busca
    *
    *@param integer $id [Opcional]
    *
    *@return Cidade
    */
    public function find($id)
    {
        $id = (int) $id;
        
        return $this->getObjectManager()->find('\Admin\Model\Cidade', $id);
    }

    public function findByNome($nome)
    {
        mb_strtoupper($nome, 'UTF-8');

        return $this->getObjectManager()->getRepository('\Admin\Model\Cidade')
            ->findOneBy(array('descricao' => $nome));
    }

    /**
    *Função salvar
    *    
    *@param array $values [Opcional]
    *
    *@return Cidade
    */
    public function save($values)
    {
        if( (int) $values['id'] > 0)
            $cidade = $this->find($values['id']);
        else
            $cidade = new \Admin\Model\Cidade();
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

    /**
    *Função delete
    *
    *@param integer $id [Opcional]
    *
    *@return void
    */
    public function delete($id)
    {
        $cidade = $this->find($id);
        if(!$cidade)
            throw new EntityException('Registro não encontrado');
        $this->getObjectManager()->remove($cidade);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao deletar registro');
        }
    }
}
