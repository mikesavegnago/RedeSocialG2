<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "usuario")
 *
 * @category Application
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Usuario extends Entity
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
     * @ORM\Column (type="string")
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
     * @ORM\Column (type="datetime")
     * 
     * @var datetime
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
     * 
     * @ORM\Column (type="string")
     * 
     * @var string
     */
    protected $role;
    
    
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
    
    /**
     * @param $role
     */
    public function setRole($role){
        $this->role = $role;
    }
    
    /**
     * @return string
     */
    public function getRole(){
        return $this->role;
    } 
    
    
    /**
     * Filtros
     *
     * @return Zend\InputFilter\InputFilter
     */
    public function getInputFilter() {
        $input_filter = new InputFilter();
        $factory = new InputFactory();

        $input_filter->add(
                $factory->createInput(
                        array(
                            'name' => 'id',
                            'required' => false,
                            'filters' => array(
                                array(
                                    'name' => 'Int'
                                )
                            )
                        )
                )
        );

        $input_filter->add(
                $factory->createInput(
                        array(
                            'name' => 'tipo_usuario',
                            'required' => false,
                            'validators' => array(
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array('message' =>
                                        'O campo tipo de usuário não pode estar vazio')
                                ),
                            ),
                        )
                )
        );

        $input_filter->add(
                $factory->createInput(
                        array(
                            'name' => 'login',
                            'required' => true,
                            'filters' => array(
                                array(
                                    'name' => 'StripTags'
                                ),
                                array(
                                    'name' => 'StringTrim'
                                ),
                            ),
                            'validators' => array(
                                array(
                                    'name' => 'StringLength',
                                    'options' => array(
                                        'encoding' => 'UTF-8',
                                        'min' => 4,
                                        'max' => 30,
                                        'message' => 'O campo login deve ser'
                                        . ' maior que 4 caracteres e menor que'
                                        . ' 20 caracteres'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo login não '
                                        . ' pode estar vazio'
                                    )
                                )
                            )
                        )
                )
        );

        $input_filter->add(
                $factory->createInput(
                        array(
                            'name' => 'senha',
                            'required' => true,
                            'filters' => array(
                                array(
                                    'name' => 'StripTags'
                                ),
                                array(
                                    'name' => 'StringTrim'
                                ),
                            ),
                            'validators' => array(
                                array(
                                    'name' => 'StringLength',
                                    'options' => array(
                                        'encoding' => 'UTF-8',
                                        'min' => 4,
                                        'max' => 255,
                                        'message' => 'O campo senha deve ter mais
                              que 4 caracteres e menos que 255'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo senha não
                               pode estar vazio'
                                    )
                                )
                            )
                        )
                )
        );
        
          $this->input_filter = $input_filter;
        return $this->input_filter;
    }
    
    

}
