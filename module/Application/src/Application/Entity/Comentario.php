<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "comentario")
 *
 * @category Application
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Comentario extends Entity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;

    protected $input_filter;

   /**
    *  @ORM\Column(type="string")
    *
     * @var comentario
     */
    protected $comentario;

    /**
     * @ORM\ManyToOne(targetEntity="Mural")
     * @ORM\JoinColumn(name="id_mural", referencedColumnName="id")
     *
     * @var \Admin\Entity\Mural
     */
    protected $mural;

    /**
     * @ORM\ManyToOne(targetEntity="Perfil", cascade={"persist"})
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id")
     *
     * @var \Admin\Entity\Perfil
     */
    protected $perfil;

    /**
     * @ORM\Column (type="datetime", nullable=true)
     *
     * @var Date
     */
    protected $data;

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $comentario
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    /**
     * @return string
     *
     */

    public function getComentario(){
        return $this->comentario;
    }

    /**
     * @return data
     */
    public function getData(){
        return $this->data;
    }

    /**
     * @param
     */
    public function setData(){
        $agora =  new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $this->data = $agora;
    }

    /**
     * @param  $mural
     */
    public function setMural($mural) {
        $this->mural= $mural;
    }

    /**
     * @return $mural
     *
     */

    public function getMural(){
        return $this->mural;
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


      public function getArrayCopy() {
        return get_object_vars($this);
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
                            'name' => 'comentario',
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
                                        'max' => 255,
                                        'message' => 'O campo comentario deve ser'
                                        . ' maior que 1 caracteres e menor que'
                                        . ' 255 caracteres'
                                    )
                                ),
                                array(
                                    'name' => 'NotEmpty',
                                    'options' => array(
                                        'message' => 'O campo comentario não '
                                        . ' pode estar vazio'
                                    )
                                ),
                            ),
                        )
                )
        );

        $this->input_filter = $input_filter;
        return $this->input_filter;
}
}

?>