<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "perfil")
 *
 * @category Prime
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Perfil extends Entity
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
    protected $statusRelacionamento;

    /**
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $profissao;
    
    /**
     * 
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $formacao;
    
    /**
     * 
     * @ORM\Column (type="string")
     * 
     * @var string
     * 
     */
    protected $ondeTrabalha;
    
    /**
     * 
     * @ORM\Column (type="integer")
     * 
     * @var integer
     */
    protected $idEnd;
    
    
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
    public function getStatusRelacionamento(){
        return $this->statusRelacionamento;
    }
    
    /**
     * @param string $statusRelacionamento
     */
    public function setStatusRelacionamento($statusRelacionamento){
        $this->statusRelacionamento = $statusRelacionamento;
    }
    
    /**
     * @return string
     */
    public function getProfissao(){
        return $this->profissao;
    }
    
    /**
     * @param $profissao
     */
    public function setProfissao($profissao){
        $this->profissao = $profissao;
    }
    
    /**
     * @return string
     */
    public function getFormacao(){
        return $this->formacao;
    }
    
    /**
     * @param  $formacao 
     */
    public function setFormacao(){
        $this->formacao = $formacao;
    }
    
    /**
     * @return string
     */
    public function getOndeTrabalha(){
        return $this->ondeTrabalha;
    }
    
    /**
     * @param $ondeTrabalha
     */
    public function setOndeTrabalha($ondeTrabalha){
        $this->ondeTrabalha = $ondeTrabalha;
    }
    
    /**
     * @return integer
     */
    public function getIdEnd(){
        return $this->idEnd;
    }
    
    
   

    

}

?>