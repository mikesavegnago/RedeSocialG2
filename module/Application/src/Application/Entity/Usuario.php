<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "usuario")
 *
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * #categoy Admin
 * @package Entity
 */
class Usuario {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;
    
    
    /**
     * @ORM\OneToOne(targetEntity="Perfil", cascade={"persist"})
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     *
     * @var \Admin\Entity\Perfil
     */
    protected $perfil;

    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $nome;
    
    /**
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $sobrenome;

    /**
     * @ORM\Column (type="string)
     * 
     * @var string
     */
    protected $email;
    
    /**
     * 
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $celular;
    
    /**
     * 
     * @ORM\Column (type="string")
     * 
     * @var string
     * 
     */
    protected $senha;
    
    /**
     * 
     * @ORM\Column (type="dateTime")
     * 
     * @var dateTime
     */
    protected $dataNascimento;
    
    /**
     * 
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $sexo;
    
    /**
     * 
     * @ORM\Column (type="boolean")
     * 
     * @var boolean
     */
    protected $autenticado;
    
    
    /**
     * @return id
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @param $nome
     */
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    /**
     * @return string
     */
    public function getNome(){
        return $this->nome;
    }
    
    /**
     * @param $sobrenome
     */
    public function setSobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }
    
    /**
     * @return string
     */
    public function getSobrenome(){
        return $this->sobrenome;
    }
    
    /**
     * @param $email
     */
    public function setEmail($email){
        $this->email = $email;
    }
    
    /**
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }
    
    /**
     * @param $celular
     */
    public function setCelular($celular){
        $this->celular = $celular;
    }
    
    /**
     * @return string
     */
    public function getCelular(){
        return $this->celular;
    }
    
    /**
     * @param $senha
     */
    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    /**
     * @return string
     */
    public function getSenha(){
        return $this->senha;
    }
    
    /**
     * @param $dataNascimento
     */
    public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }
    
    /**
     * @return dateTime
     */
    public function getDataNascimento(){
        return $this->dataNascimento;
    }
    
    /**
     * @param $sexo
     */
    public function setSexo($sexo){
        $this->senha = $sexo;
    }
    
    /**
     * @return string
     */
    public function getSexo(){
        return $this->sexo;
    }
    
    /**
     * @param $autenticacao
     */
    public function setAutenticacao($autenticacao){
        $this->autenticado = $autenticacao;
    }
    
    /**
     * @return boolean
     */
    public function getAutenticacao(){
        return $this->autenticado;
    }
    
    
    
    
   

    

}

?>