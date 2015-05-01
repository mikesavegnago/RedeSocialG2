<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "cidade")
 *
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * #categoy Admin
 * @package Entity
 */
class Cidade {

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
    protected $descricao;
    
    /**
     * @ORM\OneToOne(targetEntity="Uf", cascade={"persist"})
     * @ORM\JoinColumn(name="id_uf", referencedColumnName="id")
     *
     * @var \Admin\Entity\Uf
     */
    protected $uf;

   
    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    
    
    /**
     * @param string $uf
     */
    public function setUf($uf) {
        $this->idUsr = $idUsr;
    }
    
    /**
     * @return integer
     * 
     */
    public function getUf(){
        return $this->ufr;
    }

    /**
     * @return string
     * 
     */
    public function getDescricao(){
        return $this->descricao;
    }
    
    /**
     * @param string $descricao
     */
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

}

?>
