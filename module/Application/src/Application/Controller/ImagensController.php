<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Imagens
*
* @category Application
* @package  Controller
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class ImagensController extends ActionController
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
    *Função save
    *
    *@return void
    */
    public function saveAction()
    {
       
    }

    /**
    *Função delete
    *
    *@return void
    */
    public function deleteAction()
    {
    
    }
    
}