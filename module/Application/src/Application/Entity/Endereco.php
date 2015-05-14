<?php

namespace Prime\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "endereco")
 *
  * @category Prime
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * @author Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 */
class Endereco extends Entity
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
    protected $rua;
    
    /**
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $numero;

    /**
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $bairro;
    
     /**
     * @ORM\OneToOne(targetEntity="Cidade", cascade={"persist"})
     * @ORM\JoinColumn(name="id_cidade", referencedColumnName="id")
     *
     * @var \Admin\Entity\Cidade
     */
    protected $idCidade;
    
     /**
     * @ORM\OneToOne(targetEntity="Uf", cascade={"persist"})
     * @ORM\JoinColumn(name="id_uf", referencedColumnName="id")
     *
     * @var \Admin\Entity\Uf
     */
     protected $idUf;

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    
    
    /**
     * @param string $idUf
     */
    public function setIdUf($idUf) {
        $this->idUf = $idUsr;
    }
    
    /**
     * @return integer
     * 
     */
    public function getIdUf(){
        return $this->idUf;
    }

    /**
     * @return string
     * 
     */
    public function getRua(){
        return $this->rua;
    }
    
    /**
     * @param string $rua
     */
    public function setRua($rua){
        $this->rua = $rua;
    }
    
    /**
     * @return string
     * 
     */
    public function getNumero(){
        return $this->numero;
    }
    
    /**
     * @param string $numero
     */
    public function setNumero($numero){
        $this->numero = $numero;
    }
    
    /**
     * @return string
     * 
     */
    public function getBairro(){
        return $this->bairro;
    }
    
    /**
     * @param string $bairro
     */
    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
    
    /**
     * @return string
     * 
     */
    public function getIdCidade(){
        return $this->idCidade;
    }
    
    /**
     * @param string $idCidade
     */
    public function setIdCidade($idCidade){
        $this->idCidade = $idCIdade;
    }
   

}

?>
