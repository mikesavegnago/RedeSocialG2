<?php


namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "uf")
 *
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * #categoy Admin
 * @package Entity
 */
class Uf {

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
     * @return integer
     */
    public function getId() {
        return $this->id;
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