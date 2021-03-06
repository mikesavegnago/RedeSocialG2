<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;

/**
* Service UF
*
* @category Admin
* @package  Service
* @author   Cezar Junior de Souza <cezar08@unochapeco.edu.br> 
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost 
*/
class Uf extends Service
{
    /**
    *Função Select All
    *
    *@return array
    */
    public function fetchAll()
    {
        $select = $this->getObjectManager()->createQueryBuilder()
            ->select('Uf')->from('Application\Entity\Uf', 'Uf')
            ->orderBy('Uf.descricao', 'ASC');

        return $select->getQuery()->getResult();
    }

    public function fetchAllByUf($nome)
    {
        $nome = mb_strtoupper($nome, 'UTF-8');
        $select = $this->getObjectManager()->createQueryBuilder()
            ->select('Uf.descricao as label', 'Uf.id')
            ->from('Application\Entity\Uf', 'Uf') 
            ->where("Uf.descricao like ?1")
            ->setParameter(1, "%$nome%");

        return $select->getQuery()->getArrayResult();
    }

    /**
    *Função de busca
    *
    *@param integer $id [Opcional]
    *
    *@return Uf
    */
    public function find($id)
    {
        $id = (int) $id;
        return $this->getObjectManager()->find('\Application\Entity\Uf', $id);
    }
    /**
    *Função de busca pordescricao
    *
    *@param integer $descricao
    *
    *@return Uf
    */
    public function findWithDesc($desc)
    {
        $uf = $this->getObjectManager()->getRepository('\Application\Entity\Uf')
                ->findOneBy(array('descricao'=>$desc));
        if(!$uf){
            $uf = $this->saveUfs($desc);
        }
        return $uf;
    }
    
    public function findByNome($nome)
    {
        mb_strtoupper($nome, 'UTF-8');

        return $this->getObjectManager()->getRepository('\Application\Entity\Uf')
            ->findOneBy(array('descricao' => $nome));
    }

    /**
    *Função de salvar
    *    
    *@param array $values [Opcional]
    *
    *@return Uf
    */
    public function save($values)
    {
        $uf = new \Admin\Model\Uf();
        $uf->setDescricao($values['descricao']);
        $this->getObjectManager()->persist($uf);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados');exit;
        }

        return $uf;        
    }
    /**
    *Função de salvar
    *    
    *@param array $values [Opcional]
    *
    *@return Uf
    */
    public function saveUfs($values)
    {
        $uf = new \Application\Entity\Uf();
        $uf->setDescricao($values);
        
        $this->getObjectManager()->persist($uf);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar Estado'.$e);
        }

        return $uf;        
    }

    /**
    *Função de deletar
    *
    *@param integer $id [Opcional]
    *
    *@return void
    */
    public function delete($id)
    {
        $uf = $this->find($id);
        if(!$uf)
           throw new EntityException('Registro não encontrado');
        $this->getObjectManager()->remove($uf);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao deletar registro');
        }
    }
}
