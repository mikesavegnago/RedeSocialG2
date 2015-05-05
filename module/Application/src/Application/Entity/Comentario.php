<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "comentario")
 *
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * #categoy Admin
 * @package Entity
 */
class Comentario {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;

   /**
     * @ORM\ManyToOne(targetEntity="Imagem", cascade={"persist"})
     * @ORM\JoinColumn(name="id_imagem", referencedColumnName="id")
     *
     * @var \Admin\Entity\Imagem
     */
    protected $idImagem;
    
    /**
     * @ORM\ManyToOne(targetEntity="Perfil", cascade={"persist"})
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     *
     * @var \Admin\Entity\Perfil
     */
    protected $perfil;

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $idImagem
     */
    public function setIdImagem($idImagem) {
        $this->idImagem = $idImagem;
    }

    /**
     * @return integer
     * 
     */
    
    public function getIdImagem(){
        return $this->idImagem;
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

?>