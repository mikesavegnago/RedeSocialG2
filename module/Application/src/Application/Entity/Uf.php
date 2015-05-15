<?php
namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
* Model Uf
*
* @category Application
* @package  Entity
* @author   Mike Savegnago <mikesavegnago@unochapeco.edu.br>
*
* @ORM\Entity
* @ORM\Table(name="uf")
*/
class Uf extends Entity
{
    /**
    *@ORM\Id
    *@ORM\GeneratedValue(strategy="AUTO")
    *@ORM\Column(type="integer")
    *
    *@var integer
    */
    protected $id;

    /**
    *@ORM\Column(type="string")
    *
    *@var string
    */
    protected $descricao;

    /**
    *Get ID
    *
    *@return integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    *Set descrição
    *
    *@param string $descricao Variavel Descrição
    *
    *@return void
    */
    public function setDescricao($descricao)
    {
        $this->descricao = $this->valid('descricao', $descricao);
    }

    /**
    *Get descrição
    *
    *@return string
    */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
    *Filtros
    *
    *@return Zend\InputFilter\InputFilter
    */
    public function getInputFilter()
    {
        if (!$this->input_filter) {
            $input_filter = new InputFilter();
            $factory = new InputFactory();

            $input_filter->
            add(
                $factory->createInput(
                    array(
                        'name' => 'id',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )
                )
            );

            $input_filter->
            add(
                $factory->createInput(
                    array(
                    'name' => 'descricao',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                        array('name' => 'StringToUpper',
                            'options' => array('encoding' => 'UTF-8')
                        ),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 3,
                                'max' => 80,
                                'message' => 
                                'O campo descrição deve 
                                ter mais que 3 caracteres e menos que 80',
                            ),
                        ),
                        array(
                            'name' => 'NotEmpty',
                            'options' => array('message' => 
                                'O campo descrição não pode estar vazio')
                        )
                    ),
            )
                )
            );
            $this->input_filter = $input_filter;
        }

        return $this->input_filter;
    }
}