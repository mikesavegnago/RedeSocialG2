<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "evento")
 *
 * @category Application
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Evento extends Entity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;
    
    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $capa;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", cascade={"persist"})
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     *
     * @var \Admin\Entity\Usuario
     */
    protected $perfil;    
    
    
    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

   
    /**
     * @return string
     */
    public function getCapa(){
        return $this->capa;
    }
    
    /**
     * @param $capa
     */
    public function setCapa($capa){
        $this->capa = $capa;
    }

    /**
     * @param string $perfil
     */
    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
    
    /**
     * @return perfil
     * 
     */
    public function getPerfil(){
        return $this->perfil;
    }
   

}

