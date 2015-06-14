<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;
use Zend\Session\Container;

/**
* Service Save Entityes
*
* @category Admin
* @package  Service
* @author   Paulo José Cella <paulocella@unochapeco.edu.br> 
* @link     localhost 
 */
class Mural extends Service
{

    public function saveMural($values)
    {
        
        $session = $this->getServiceManager()->get('Session');
        $usuario = $session->offsetGet('usuario');
        
        $perfil = $this->getService('Application\Service\Perfil')->find((int)$usuario->getId());
        
        
        if((int) $values['id'] > 0){
            $mural = $this->getObjectManager()
                    ->getRepository('Application\Entity\Mural')
                    ->find($values['id']);
        }
        else
            $mural = new \Application\Entity\Mural();
        
        $mural->setDescricao($values['descricao']);
        $mural->setFoto($values['foto']);
        $mural->setPerfil($perfil);
        $mural->setData(new \DateTime());
        
        $this->getObjectManager()->persist($mural);
        try{
            $this->getObjectManager()->flush();
        }catch(\Exception $e){
            throw new EntityException('Erro ao salvar dados'.$e);
        }

        return $mural;        
    }

      public function removerMural($values )
    {
        
        $em = $this->getObjectManager();
        
        if ($values > 0) {
            $mural = $em->find('\Application\Entity\Mural',$values);
            $em->remove($mural);

            try {
                $em->flush();
            } catch (\Exception $e) {
            }
        }
    }

}
