<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Application\Form\Comentario as Form;
use Zend\View\Model\ViewModel;

/**
* Controller Comentarios
*
* @category Application
* @package  Controller
* @author   Paulo Cella <paulocella@unochapeco.edu.br>
*/
class ComentariosController extends ActionController
{
    /**
    *Função para criar a view
    *
    *@return void
    */
    public function indexAction()
    {
//        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
//        $comentarios= $em->getRepository('\Application\Entity\Comentarios')->findAll();
//        
//         return new ViewModel(array(
//             'comentarios' => $comentarios
//         ));
    }
    

    /**
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new  \Application\Form\Comentario();
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $valores = $request->getPost();
            $comentario = new \Application\Entity\Comentario();
            $filtros = $comentario->getInputFilter();
            $form->setInputFilter($filtros);
            $form->setData($valores);
            
            if ($form->isValid()) {
                $values = $form->getData();
                
                try{
                    $comentario = $this->getService('Application\Service\Comentario')
                            ->saveComentario($values);
                }catch(\Exception $e){
                    echo $e->getMessage(); 
                    exit;
                }
                return $this->redirect()->toUrl('/application/index/layout');    
            }                    
        }
        
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if ($id > 0) {
            $comentario = $this->getService('Application\Service\Comentario')
                    ->findComentario($id);
            $form->bind($comentario);
        }

        return new ViewModel(array('form' => $form));
    }

    /**
    *Função delete 
    *
    *@return void
    */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        try {
            $this->getService('Application\Service\Comentario')->removerComentario($id);
        } catch(\Exception $e) {
            echo $e->getMessage(); exit;
        }

        return $this->redirect()->toUrl('/application/index/layout');
    }
}