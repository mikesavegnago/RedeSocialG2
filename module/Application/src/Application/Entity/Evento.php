<?php

namespace Application\Entity;

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
    
   // /**
    // * @ORM\Column (type="string")
    // *
    // * @var string
     //*/
    //protected $capa;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", cascade={"persist"})
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     *
     * @var \Admin\Entity\Usuario
     */
    protected $perfil;   

    /**
     * @ORM\Column (type="text")
     * 
     * @var text
     */
    protected $descricao; 

    /**
     * 
     * @ORM\Column (type="datetime",nullable = true)
     * 
     * @var datetime
     */
    protected $dataEvento;     
    
    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

   
   // /**
   //  * @return string
   //  */
   // public function getCapa(){
    //    return $this->capa;
    //}
    
    ///**
    // * @param $capa
    // */
    //public function setCapa($capa){
       // $this->capa = $capa;
    //}

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
     * @param string $dataEvento
     */
    public function setDataEvento($dataEvento) {
        $this->dataEvento = $dataEvento;
    }
    
    /**
     * @return dataEvento
     * 
     */
    public function getDataEvento(){
        return $this->dataEvento;
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

        $inputFilter->add($factory->createInput(array(
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

         $inputFilter->add($factory->createInput(array(
                        'name' => 'dataEvento',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'NotEmpty',
                                'options' => array('message' => 'O campo data de evento não pode estar vazio'),
                                ),
                        ),
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
            )));
    
    $this->input_filter = $input_filter;
            return $this->input_filter;
    }

    }

   

