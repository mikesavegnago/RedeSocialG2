<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Login
*
* @category Application
* @package  Controller
* @author   Mike Savegnago <mikesavegnago@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class LoginController extends AbstractActionController
{
    public function indexAction()
    {
        
        return new ViewModel();
    }
    
    public function saveAction() {
        
    }
    
    public function deleteAction() {
        
    }
    
}
