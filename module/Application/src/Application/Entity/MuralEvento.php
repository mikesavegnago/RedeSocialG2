<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "mural_evento")
 *
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 * #categoy Admin
 * @package Entity
 */
class MuralEvento {

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
     * @ORM\Column (type="string)
     * 
     * @var string
     */
     protected $texto; 

      /**
     * @ORM\Column (type="string)
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


?>