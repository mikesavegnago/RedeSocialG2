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

    /**
     * @ORM\Column (type="string", nullable=true)
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
    protected $perfil_criador;

    /**
    * @ORM\ManyToMany(targetEntity="Usuario")
    * @ORM\JoinTable(name="participantes_evento",
    *      joinColumns={@ORM\JoinColumn(name="evento", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="perfil", referencedColumnName="id")}
    *      )
    **/
    protected $perfil;

    /**
     * @ORM\Column (type="text")
     *
     * @var text
     */
    protected $descricao;
    /**
     * @ORM\Column (type="text")
     *
     * @var text
     */
    protected $titulo;

    /**
     *
     * @ORM\Column (type="datetime",nullable = true)
     *
     * @var datetime
     */
    protected $dataEvento;
    
    public function __construct() {
        $this->perfil = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param  $capa
     *
     */
    public function setCapa($capa)
    {
        $this->capa = $capa;
    }
    /**
     * @return string
     */
    public function getCapa()
    {
        return $this->capa;
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
     * @param string $perfil
     */
    public function setPerfilCriador($perfil_criador) {
        $this->perfil_criador = $perfil_criador;
    }

    /**
     * @return Perfil
     *
     */
    public function getPerfilCriador(){
        return $this->perfil_criador;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    /**
     * @return $titulo
     *
     */
    public function getTitulo(){
        return $this->titulo;
    }
    /**
     * @param string $descricao
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    /**
     * @return $descricao
     *
     */
    public function getDescricao(){
        return $this->descricao;
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
            'name' => 'titulo',
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
            'name' => 'capa',
            'required' => false,
            )));

         $input_filter->add($factory->createInput(array(
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



