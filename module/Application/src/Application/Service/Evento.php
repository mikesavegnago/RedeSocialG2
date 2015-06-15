<?php

namespace Application\Service;

use Core\Service\Service;
use Core\Model\EntityException as EntityException;

/**
 * Service Save Entityes
 *
 * @category Application
 * @package  Service
 * @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 * @link     localhost
 */
class Evento extends Service
{
    public function saveEvento($values){

        $session = $this->getServiceManager()->get('Session');
        $usuario = $session->offsetGet('usuario');

        $perfil = $this->getService('Application\Service\Perfil')->find($usuario->getId());

        try {
             $perfil = $this->getService('Application\Service\Perfil')->find($usuario->getId());
        } catch (\Exception $e) {
            throw new EntityException("voce deve cadastrar um perfil");
        }

        if ((int) $values['id'] > 0){
            $evento = $em->find($values['id']);
        }
        else{
            $evento = new \Application\Entity\Evento();
        }

         $evento->setPerfilCriador($perfil);


         $evento->setDescricao($values['descricao']);
         $evento->setTitulo($values['titulo']);
         $evento->setCapa($values['capa']);
         $values['dataEvento'] = str_replace('/','-', $values['dataEvento']);
         $evento->setDataEvento(new \DateTime($values['dataEvento']));



        $this->getObjectManager()->persist($evento);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $e) {
            throw new EntityException('Erro ao salvar dados' . $e);
            exit;
        }

        return $evento;
    }

    public function find($id)
    {
        $em = $this->getObjectManager();
        $evento = $em->find('\Application\Entity\Evento',$id);

        return $evento;
    }

    public function fetchAllEventos($id)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getObjectManager();
        $select = $em->createQueryBuilder()
            ->select('Evento')
            ->from('Application\Entity\Evento', 'Evento')
            ->join('Evento.perfil', 'Perfil')
            ->where("Perfil.id = ?1")
            ->setParameter(1, $id);

            return $select->getQuery()->getResult();
    }

    public function fetchAllParticipantes($id)
    {
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getObjectManager();
        $select = $em->createQueryBuilder()
            ->select('Perfil.id')
            ->from('Application\Entity\Perfil', 'Perfil')
            ->join('Perfil.evento', 'Evento')
            ->where('Evento.id = ?1')
            ->setParameter(1, $id);
    echo var_dump($select->getQuery()->getArrayResult()); exit;
          return $select->getQuery()->getResult();
    }

}
