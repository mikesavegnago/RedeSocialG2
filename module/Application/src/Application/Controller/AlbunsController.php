<?php
namespace Application\Controller;

use Core\Controller\ActionController as ActionController;
use Zend\View\Model\ViewModel;

/**
* Controller Albuns
*
* @category Application
* @package  Controller
* @author   Ana Paula Binda <anapaulasif@unochapeco.edu.br>
* @license  Copyright <http://www.softwarecontracts.net/p05_copyright_patent_software.htm>
* @link     localhost
*/
class AlbunsController extends ActionController
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