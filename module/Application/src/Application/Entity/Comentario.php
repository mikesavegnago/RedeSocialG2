<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "comentario")
 *
 * @category Application
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Comentario extends Entity
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
    *  @ORM\Column(type="string")
    * 
     * @var comentario
     */
    protected $comentario;
    
    /**
     * @ORM\ManyToOne(targetEntity="Perfil", cascade={"persist"})
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
     * @param string $comentario
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    /**
     * @return string
     * 
     */
    
    public function getComentario(){
        return $this->comentario;
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