<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller MuralEventos
*
* @category Application
* @package  Controller
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class MuralEventosController extends ActionController
{
    /**
    *Função index
    *
    *@return void
    */
    public function indexAction()
    {

        return new ViewModel();
    }

    /**
     * Função save
     *
     * @return void
     */
    public function saveAction() {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new \Application\Form\MuralEvento($em);
        $request = $this->getRequest();


        if ($request->isPost()) {
            $valores = $request->getPost();
            $file = $request->getFiles('foto');
            if ($file['name'] != '') {
                $valores['foto'] = $this->getService('Application\Service\UpLoadImagem')->uploadPhoto($file);
            }
            $mural = new \Application\Entity\MuralEvento();
            $filtros = $mural->getInputFilter();
            $form->setInputFilter($filtros);
            $filtros = $mural->getInputFilter();
            $form->setData($valores);

            if (!$form->isValid()) {
                $values = $form->getData();
                try {
                    $mural = $this->getService('Application\Service\MuralEventos')->saveMural($values);
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    exit;
                }

                return $this->redirect()->toUrl('/application/eventos/evento/id/'.$mural->getEvento()->getId().'/perfil/'.$mural->getPerfil()->getId());
            }
        }
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
            $this->getService('Application\Service\MuralEventos')->removerMural($id);
        } catch(\Exception $e) {
            echo $e->getMessage(); exit;
        }

        return $this->redirect()->toUrl('/application/index/layout');
    }
}