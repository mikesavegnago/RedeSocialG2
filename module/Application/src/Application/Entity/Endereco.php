<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "endereco")
 *
  * @category Application
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
                            'name' => 'rua',
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
                                        'message' => 'O campo rua deve ser'
                                        . ' maior que 1 caracteres e menor que'
                                        . ' 30 caracteres'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo rua não '
                                        . ' pode estar vazio'
                                    )
                                ),
                            ),
                        )
                )
        );


       $input_filter->add(
            $factory->createInput(array(
                'name' => 'numero',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo numero nao pode estar vazio')
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 2,
                            'max' => 180,
                            'message' => 'O campo numero deve ter mais que 2 caracteres e menos que 180',
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StringToUpper',
                        'options' => array('encoding' => 'UTF-8')
                    ),
                ),
            )));

     $input_filter->add($factory->createInput(array(
                'name' => 'bairro',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo bairro nao pode estar vazio')
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 2,
                            'max' => 180,
                            'message' => 'O campo bairro deve ter mais que 2 caracteres e menos que 180',
                        ),
                    ),
                ),
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StringToUpper',
                        'options' => array('encoding' => 'UTF-8')
                    ),
                ),
            )));

 $input_filter->add($factory->createInput(array(
                'name' => 'idCidade',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo cidade não pode estar vazio')
                    )
                ),
            )));

 $input_filter->add($factory->createInput(array(
                'name' => 'idUf',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo uf não pode estar vazio')
                    )
                ),
            )));

        $this->input_filter = $input_filter;
        return $this->input_filter;
}
}

?>
   

