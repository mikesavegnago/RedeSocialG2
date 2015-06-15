<?php
namespace Application\Entity;

use Core\Model\Entity as Entity;
use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity
 * @ORM\Table (name = "imagem")
 *
 * @category Application
 * @package  Entity
 * @author Paulo José Cella <paulocella@unochapeco.edu.br>
 */
class Imagem extends Entity
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
     * @ORM\ManyToOne(targetEntity="Album", cascade={"persist"})
     * @ORM\JoinColumn(name="id_album", referencedColumnName="id")
     *
     * @var \Admin\Entity\Album 
     */
    protected $idAlbum;
    
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
     * @param blob $imagem
     *
     */
    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    /**
     * @return blob
     */
    public function getImagem(){
        return $this->imagem;
    }
    
    /**
     * @param $idAlbum
     */
    public function setIdAlbum($idAlbum){
        $this->idAlbum = $idAlbum;
    }
    
    /**
     * @return integer
     * 
     */
    public function getIdAlbum(){
        return $this->idAlbum;
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


/*$inputFilter->add($factory->createInput(array(
                'name' => 'idAlbum',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'O campo Sobrenome não pode estar vazio')
                    ),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 3,
                            'max' => 255,
                            'message' => 'O campo sobrenome deve ter mais que 3 caracteres e menos que 255',
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
            ))); */



    $inputFilter->add($factory->createInput(
            array(
                'name' => 'imagem',
                'required' => false
            )

        ));
         return $this->inputFilter;
    }
}

?>

