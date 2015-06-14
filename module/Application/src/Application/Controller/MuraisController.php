<?php

namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\Exception\InvalidMagicMimeFileException;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

/**
 * Controller Perfis
 *
 * @category Application
 * @package  Controller
 * @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
 * @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
 * @link     localhost
 */
class MuraisController extends ActionController {

    /**
     * Função index
     *
     * @return void
     */
    public function indexAction() 
     {
                
    }

    /**
     * Função save
     *
     * @return void
     */
    public function saveAction() {
        // fazer com que o form /na parte de usuarios ja venha preechido quando clicado em cadsatrar perfiol
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new \Application\Form\Mural($em);
        $request = $this->getRequest();


        if ($request->isPost()) {
            $valores = $request->getPost();
            $file = $request->getFiles('foto');
            $valores['foto'] = $this->getService('Application\Service\UpLoadImagem')->uploadPhoto($file);
            $mural = new \Application\Entity\Mural();

            $filtros = $mural->getInputFilter();
            $form->setInputFilter($filtros);
            $filtros = $mural->getInputFilter();
            $form->setData($valores);

            if (!$form->isValid()) {
                $values = $form->getData();

                try {
                    $mural = $this->getService('Application\Service\Mural')->saveMural($values);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    exit;
                }

                return $this->redirect()->toUrl('/application/index/layout');
            }
        }
//        $id = (int) $this->params()->fromRoute('id', 0);
//        if ($id > 0) {
//            $usuario = $this->getService('Application\Service\Mural')->find($id);
//            $form->bind($usuario);
//        }
        //return new ViewModel(array('form' => $form));
    }

    /**
     * Função delete
     *
     * @return void
     */
    public function deleteAction() {
        $id = $this->params()->fromRoute('id', 0);
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        try {
            $this->getService('Application\Service\Mural')->removerMural($id);
        } catch(\Exception $e) {
            echo $e->getMessage(); exit;
        }

        return $this->redirect()->toUrl('/application/index/layout');
    }
    

}
