<?php

namespace Application\Service;

use Core\Service\Service;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

/**
 * Serviço para autenticação de um usuário simples no sistema
 * 
 * @category Application
 * @package Service
 * @author Mike Savegnago
 */
class Auth extends Service
{
    
    /**
     * Faz a autenticação
     * @param array $params 
     * @return array 
     */
    public function authenticate($params) 
    {
        if (!isset($params['email']) || !isset($params['senha']) || (!$params['email']) || !$params['senha']) {
            throw new \Exception("Parâmetros inválidos");
        }
        
        $senha = md5($params['senha']);
        
        $authService = $this->getServiceManager()->get('Zend\AuthenticationService');
        $authAdapter = $authService->getAdapter();
        $authAdapter->setIdentityValue($params['email'])
                ->setCredentialValue($senha);
        $result = $authService->authenticate();
        
        if (!$result->isValid()) {
            throw new \Exception("Login ou senha inválidos!");
        }
        
        $session = $this->getServiceManager()->get('session');
        $identity = $result->getIdentity();
        $session->offsetSet('user', $identity);
        $session->offsetSet('role', $identity->getRole());
        
        return true;
    }
}