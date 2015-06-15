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
        
        $perfil = $this->getService('Application\Service\Perfil')->find($usuario->getId());
        
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
    
    
    public function getFoto($foto)
    {
//        if ((int) $id <= 0)
//            throw new \InvalidArgumentException('Parâmetros inválidos');
//        $fotoMural = $this->getEm()->find('Application\Entity\Mural', (int) $id);
//        if (!$user)
//            throw new NoResultException('Mural não existe');
//        $base = null;
        if ($foto != null) {
            $stream = stream_get_contents($foto);
            $foto = base64_decode($stream);
        }
        
        return $foto;
    }

    
    public function find($id)
    {
        $id = (int) $id;
        $mural = $this->getObjectManager()->getRepository('Application\Entity\Mural')
                ->findAll();
        
        foreach ($mural as $mural){
            
            if($mural->getId()== $id){
                $result = $mural;
            }
        }
        
        return $result;
    }

}
