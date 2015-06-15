<?php

namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "mural")
 *
 * @category Application
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Mural extends Entity
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
     * @ORM\Column (type="string")
     *
     * @var string
     */
    protected $foto;
    /**
     * @ORM\Column (type="datetime")
     *
     * @var Date
     */
    protected $data;

    /**
     * @ORM\Column (type="text")
     * 
     * @var text
     */
    protected $descricao;
    
    
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
     * @return data
     */
    public function getData(){
        return $this->data;
    }
    
    /**
     * @param $data
     */
    public function setData($data){
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getFoto(){
        return $this->foto;
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
                        
                      
			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
    
}

?>