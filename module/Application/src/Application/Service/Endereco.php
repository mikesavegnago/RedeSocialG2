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
   public function findEndereco($values ,$em){
       
       $em = $this->getObjectManager();
       $endereco = $em->find('\Application\Entity\Endereco',$values);
       
       return $endereco;
   }
    
   public function saveEndereco($values)
    { 
       $endereco = new \Application\Entity\Endereco();
        $endereco->setRua($values['rua']);
        $endereco->setNumero($values['numero']);
        $endereco->setBairro($values['bairro']);
        $cidade = $this->getService('Application\Service\Cidade')->findWithDesc($values['cidade']);
        $endereco->setCidade($cidade);
        $uf = $this->getService('Application\Service\Uf')->findWithDesc($values['uf']);
        $endereco->setUf($uf);
        
        $this->getObjectManager()->persist($endereco);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar endereco'.$e);
        }

        return $endereco;        
    }

    
    public function removerEndereco($values ,$em)
    {
        
        
        if ($values > 0) {
            $endereco = $em->find('\Application\Entity\Endereco',$values);
            $em->remove($endereco);

            try {
                $em->flush();
            } catch (\Exception $e) {
            }
        }
    }


}
