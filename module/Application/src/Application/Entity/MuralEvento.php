<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "mural_evento")
 *
 * @category Application
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class MuralEvento extends Entity
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
     * @ORM\ManyToOne(targetEntity="Usuario", cascade={"persist"})
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     *
     * @var \Admin\Entity\Usuario
     */
    protected $evento;
    
          /**
     * @ORM\Column (type="text")
     * 
     * @var text
     */
     protected $texto; 

      /**
     * @ORM\Column (type="string")
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
     * @return string
     */

    public function getEvento(){
        return $this->evento;
    }

    /**
     * @param $evento
     */
    public function setEvento($evento){
        $this->evento = $evento;
    }


     /**
     * @return string
     */
    public function getTexto(){

        return $this-> texto;

    }
 
     /**
     * @param $texto
     */

   public function setTexto($texto){
    $this -> texto = $texto; 

   }

   /**
     * @return string
     */

    public function getImagem(){

        return $this-> imagem;

    }

     /**
     * @param $imagem
     */

   public function setImagem($imagem){
    $this -> imagem = $imagem; 
   }
 /**
    *
    * @return Zend/InputFilter/InputFilter
    */
    public function getInputFilter(){
        if (!$this->inputFilter) {

            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            $inputFilter->add($factory->createInput(array(
            'name' => 'id',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
            'name' => 'texto',
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
            'name' => 'imagem',
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
                        
                      
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
    
}

?>



