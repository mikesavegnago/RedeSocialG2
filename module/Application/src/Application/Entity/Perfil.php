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
class Perfil extends Usuario
{
    /**
     * @ORM\Id
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
     * @ORM\Column (type="string")
     * 
     * @var string
     * 
     */
    protected $permissao;
    
    /**
     * @ORM\ManyToOne(targetEntity="Endereco", cascade={"persist"})
     * @ORM\JoinColumn(name="id_endereco", referencedColumnName="id")
     *
     * @var \Application\Entity\Endereco
     */
    protected $endereco;

    /**
     * @ORM\OneToOne(targetEntity="Imagem")
     * @ORM\JoinColumn(name="id_imagem",referencedColumnName="id")
     * 
     *  @var \Application\Entity\Imagem
     */
    protected $imagem;
    
    
    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
   }
    /**
     * @return integer
     */
    public function setId($id) {
        $this->id = $id;
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
    public function getPermissao(){
        return $this->permissao;
    }
    
    /**
     * @param $permissao
     */
    public function setPermissao($permissao){
        $this->permissao = $permissao;
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
    public function getEndereco(){
        return $this->endereco;
    }
    
    
    /**
     * @var endereco
     */
    public function setEndereco($endereco){
         $this->endereco = $endereco;
    }    
   
    /**
     * @return imagem
     */
    public function getImagem(){
        return $this->imagem;
    }
    
    /**
     * @var imagem
     */
    public function setImagem($imagem){
         $this->imagem = $imagem;
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
                            'name' => 'statusRelacionamento',
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
                                        'message' => 'O campo status relacionamento deve ser'
                                        . ' maior que 4 caracteres e menor que'
                                        . ' 30 caracteres'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo status de relacionamento não '
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
                            'name' => 'profissao',
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
                                        'min' => 1,
                                        'max' => 30,
                                        'message' => 'O campo profissao deve ser'
                                        . ' maior que 1 caracteres e menor que'
                                        . ' 30 caracteres'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo profissao não '
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
                            'name' => 'formacao',
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
                                        'min' => 1,
                                        'max' => 30,
                                        'message' => 'O campo formacao deve ser'
                                        . ' maior que 1 caracteres e menor que'
                                        . ' 30 caracteres'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo formacao não '
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
                            'name' => 'ondeTrabalha',
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
                                        'min' => 1,
                                        'max' => 30,
                                        'message' => 'O campo ondeTrabalha deve ser'
                                        . ' maior que 1 caracteres e menor que'
                                        . ' 30 caracteres'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo ondeTrabalha não '
                                        . ' pode estar vazio'
                                    )
                                )
                            )
                        )
                )
        );

        $input_filter->add($factory->createInput(array(
                'name' => 'endereco',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo endereco não pode estar vazio')
                    )
                ),
            )));
    
    $input_filter->add($factory->createInput(array(
                'name' => 'imagem',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo imagem não pode estar vazio')
                    )
                ),
            )));
    
    $input_filter->add($factory->createInput(array(
                'name' => 'permissao',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo permissao não pode estar vazio')
                    )
                ),
            )));
    
    $this->input_filter = $input_filter;
            return $this->input_filter;
    }

    }

?>