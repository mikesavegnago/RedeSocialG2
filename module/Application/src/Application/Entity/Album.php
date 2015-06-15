<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "album")
 * 
 * @category Application
 * @package  Entity
 * @author Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 */
class Album extends Entity
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
     * @ORM\ManyToOne(targetEntity="Perfil", cascade={"persist"})
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     *
     * @var \Admin\Entity\Perfil
     */
    protected $perfil;   

    /**
     * @ORM\Column (type="text")
     * 
     * @var text
     */

    protected $descricao; 

/**
     * @ORM\Column (type="string", nullable=true)
     * 
     * @var string
     */
    protected $imagem; 


    
    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $perfil
     */
    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }
    
    /**
     * @return perfil
     * 
     */
    public function getPerfil(){
        return $this->perfil;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    /**
     * @return descricao
     * 
     */
    public function getDescricao(){
        return $this->descricao;
    }

       /**
     * @param string $imagem
     */
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    
    /**
     * @return imagem
     * 
     */
    public function getImagem(){
        return $this->imagem;
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

        $input_filter->add($factory->createInput(array(
            'name' => 'descricao',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
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
                'name' => 'imagem',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo imagem não pode estar vazio')
                    )
                ),
            )));




            $this->input_filter = $input_filter;
            return $this->input_filter;
} 

}



?>