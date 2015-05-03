<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "mural")
 *
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * #categoy Admin
 * @package Entity
 */
class Mural {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column (type="perfil")
     *
     * @var perfil
     */
    protected $perfil;
    
    /**
     * @ORM\Column (type="blob")
     *
     * @var blob
     */
    protected $foto;

    /**
     * @ORM\Column (type="string)
     * 
     * @var string
     */
    protected $descricao;
    
    /**
     * 
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $permissao;
    
    /**
     * @return id
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @param $perfil
     */
    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }
    
    /**
     * @return string
     */
    public function getPerfil(){
        return $this->perfil;
    }
    
    /**
     * @param $foto
     */
    public function setFoto($foto){
        $this->foto = $foto;
    }
    
    /**
     * @return string
     */
    public function getDescricao(){
        return $this->descricao;
    }
    
    /**
     * @param $descricao
     */
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    /**
     * @return string
     */
    public function getPermissao(){
        return $this->permissao;
    }
    
    /**
     * @param $permissao
     */
    public function setPermissao($permissao){
        $this->permissao = $permissao;
    }
}

?>