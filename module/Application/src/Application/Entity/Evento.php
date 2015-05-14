<?php

namespace Prime\Entity;

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
     * @param string $idUsr
     */
    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
    
    /**
     * @return integer
     * 
     */
    public function getPerfil(){
        return $this->perfil;
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
    public function setFormacao($formacao){
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

