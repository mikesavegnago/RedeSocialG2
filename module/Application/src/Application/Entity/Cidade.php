<?php
namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 *
 * Model Cidade
 *
 * @category Application
 * @package  Entity
 * @author   Mike Savegnago <mikesavegnago@unochapeco.edu.br>
 *
 * @ORM\Entity
 * @ORM\Table(name="cidade")
 */

class Cidade extends Entity
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
    *@ORM\Column(type="string", nullable=true)
    *
    *@var string
    */
    protected $descricao;
    /**
    *Retorna identificador da entidade
    *
    *@return integer
    */

    public function getId( )
    {
        return $this->id;
    }
    /**
     *Set Descricao
     *
     *@param string $descricao variavel descricao
     *
     *@return string
     */
    public function setDescricao( $descricao )
    {
        $this->descricao = $descricao;
    }
     /**
     *@Descricao
     *
     *@return Descricao
     */
    public function getDescricao( )
    {
        return $this->descricao;
    }
    /**
    *Retorno
    *
    *@return Zend\InputFilter\InputFilter
    */
    public function getInputFilter( )
    {
        if ( !$this->input_filter ) {
            $input_filter = new InputFilter();
            $factory      = new InputFactory();
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
                        'name' => 'uf',
                        'required' => true,
                        'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'message' => 'O campo UF não pode estar vazio' 
                        ) 
                    ) 
                ) 
            )   
                )
            );
            $input_filter->add(
                $factory->createInput(
                    array(
                        'name' => 'cidade',
                        'required' => true,
                        'filters' => array(
                    array(
                        'name' => 'StripTags' 
                    ),
                    array(
                        'name' => 'StringTrim' 
                    ),
                    array(
                        'name' => 'StringToUpper',
                        'options' => array(
                            'encoding' => 'UTF-8' 
                        ) 
                    ) 
                ),
                'validators' => array(
                     array(
                         'name' => 'StringLength',
                        'options' => array(
                             'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255,
                            'message' => 'O campo descrição deve ter mais
                              que 1 caracteres e menos que 255' 
                        ) 
                    ),
                    array(
                         'name' => 'NotEmpty',
                        'options' => array(
                             'message' => 'O campo descrição não
                               pode estar vazio' 
                        ) 
                    ) 
                ) 
            )   
                )
            );
            $this->input_filter = $input_filter;
        } 

        return $this->input_filter;
    }
}