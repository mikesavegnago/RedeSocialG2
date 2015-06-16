<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Perfis
*
* @category Application
* @package  Controller
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class PerfisController extends ActionController
{
    /**
    *Função index
    *
    *@return void
    */
    public function indexAction()
    {

        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $perfil= $em->getRepository('\Application\Entity\Perfil')->findAll();

        return new ViewModel();
    }

    /**
    *Função para criar o layout
    *
    *@return void
    */
    public function layoutAction()
    {
        return new ViewModel();
    }

    /**
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $form = new \Application\Form\Perfil($em);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $valores = $request->getPost();
            $fotoPerfil = $request->getFiles('foto_perfil');
            if ($fotoPerfil['name'] != '') {
                $valores['foto_perfil'] = $this->getService('Application\Service\UpLoadImagem')
                        ->uploadPhoto($fotoPerfil);
            }
            $fotoCapa = $request->getFiles('foto_capa');
            if ($fotoCapa['name'] != '') {
                $valores['foto_capa'] = $this->getService('Application\Service\UpLoadImagem')
                        ->uploadPhoto($fotoCapa);
            }
            $perfil = new \Application\Entity\Perfil();
            $endereco = new \Application\Entity\Endereco();


            $filtros = $perfil->getInputFilter();
            $form->setInputFilter($filtros);
            $form->setInputFilter($endereco->getInputFilter());
            
            $form->setData($valores);

            if (!$form->isValid()) {
                $values = $form->getData();
                try{
                    $perfil = $this->getService('Application\Service\Perfil')->savePerfil($values);
                    if(!$perfil){
                        $this->flashMessenger()->addErrorMessage('Você deve ser maior de 16 anos!');
                        return $this->redirect()->toUrl('/');
                    }
                }catch(\Exception $e){
                    echo $e->getMessage();
                    exit;
                }

                $session = $this->getServiceLocator()->get('Session');
                $usuario = $session->offsetGet('usuario');
                if(!$usuario){
                    $this->getService('Application\Service\Auth')
                            ->authenticate($values);
                }
                return $this->redirect()->toUrl('/application/index/sobre/perfil/'.$perfil->getId());
            } 
        }
    }

    /**
    *Função Adicionar
    *
    *@return void
    */
    public function adicionarAction()
    {
        $session = $this->getServiceLocator()->get('Session');
        $usuario = $session->offsetGet('usuario');

        $perfil = (int) $this->params()->fromRoute('perfil', 0);

        /* @var $em \Doctrine\ORM\EntityManager */
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $em->getConnection()->executeQuery(
                sprintf('INSERT INTO amigos (id_usuario, id_amigo) VALUES (%s,%s)', $usuario->getId(), $perfil)
                );
        return $this->redirect()->toUrl('/application/index/sobre/perfil/'.$perfil);
    }

}