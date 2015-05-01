<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "imagem")
 *
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * #categoy Admin
 * @package Entity
 */
class Imagem {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Album", cascade={"persist"})
     * @ORM\JoinColumn(name="id_album", referencedColumnName="id")
     *
     * @var \Admin\Entity\Album
     */
    protected $idAlbum;
    
    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $imagem;

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $imagem
     */
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    /**
     * @return strgin
     * 
     */
    public function getImagem(){
        return $this->imagem;
    }
    
    /**
     * @param string $imagem
     */
    public function setIdUsr($idUsr) {
        $this->idUsr = $idUsr;
    }

    /**
     * @return integer
     * 
     */
    public function getIdUser(){
        return $this->idUsr;
    }

}

?>