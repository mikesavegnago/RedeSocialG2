<?php

namespace Prime\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "like")
 *
 * @category Prime
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Like extends Entity
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
     * @ORM\OneToOne(targetEntity="Perfil")
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     *
     * @var \Admin\Entity\Perfil
     */
    protected $perfil;
    
    /**
     * @ORM\ManyToOne(targetEntity="Imagem", cascade={"persist"})
     * @ORM\JoinColumn(name="id_imagem", referencedColumnName="id")
     *
     * @var \Admin\Entity\Imagem
     */
    protected $idImagem;
    

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
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
    
    /**
     * @param integer $idImagem
     */
    public function setIdImagem($idImagem){
        $this->idImagem = $idImagem;
    }
    
    /**
     * @return integer
     */
    public function getIdImagem(){
        return $this->idImagem;
    }

}

?>