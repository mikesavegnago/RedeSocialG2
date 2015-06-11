<?php

namespace Application\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
/**
 * Controlador que para efetuar login
 *
 * @category Admin
 * @package Controller
 * @author Paulo Cella <paulocella@unochapeco.edu.br>
 */
class LoginController extends AbstractActionController 
{ 
     /**
     *
     * @return void
     */
    public function loginAction()
    {
        $em =  $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');      
        $request = $this->getRequest();
	$session = $this->getServiceLocator()->get('Session');
        
        if ($request->isPost()) {
            $values = $request->getPost();
            
	    try {
		$this->getServiceLocator()->get('Application\Service\Auth')->authenticate($values);
                
                if($session->offsetGet('role') == 'ADMIN'){
                    
                     return $this->redirect()->toUrl('/application/index/layout');
                }else{
                     return $this->redirect()->toUrl('/application/login/login');
                }    
            } catch (Exception $e) {
                $this->flashMessenger()->addErrorMessage($e->getMessage());
            }
            
            return $this->redirect()->toUrl('/application');
        }
        
         return new ViewModel();
    }
    
    public function logoutAction(){
        $this->getServiceLocator()->get('Application\Service\Auth')->logout();
        
        return $this->redirect()->toUrl('/application');
    }
        
}
