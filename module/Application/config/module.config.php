

<?php

// module/Application/conﬁg/module.config.php:
return array(
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Login' => 'Application\Controller\LoginController',
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Perfis' => 'Application\Controller\PerfisController',
            'Application\Controller\Albuns' => 'Application\Controller\AlbunsController',
            'Application\Controller\Imagens' => 'Application\Controller\ImagensController',
            'Application\Controller\Eventos' => 'Application\Controller\EventosController',
            'Application\Controller\Usuarios' => 'Application\Controller\UsuariosController',
            'Application\Controller\Comentarios' => 'Application\Controller\ComentariosController',
            'Application\Controller\Cidades' => 'Application\Controller\CidadesController',
            'Application\Controller\Ufs' => 'Application\Controller\UfsController',
            'Application\Controller\Murais' => 'Application\Controller\MuraisController',
            'Application\Controller\MuralEventos' => 'Application\Controller\MuralEventosController',
            'Application\Controller\Enderecos' => 'Application\Controller\EnderecosController',
        ),
    ),
    //Configuração doctrine
    'doctrine' => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Application\Entity\Usuario',
                'identity_property' => 'login',
                'credential_property' => 'senha',
            ),
            ),
        'driver' => array(
            'application_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Entity'
                      )
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Application\Entity' => 'application_entities'
                )
            ), 
        )
    ),
    //*********************************************************

    'router' => array(
        'routes' => array(
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'module'        => 'application'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                        'child_routes' => array( //permite mandar dados pela url 
                            'wildcard' => array(
                                'type' => 'Wildcard'
                            ),
                        ),
                    ),
                    
                ),
            ),
            'index_paginacao' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/[page/:page]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Main\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'module' => 'main',
                        'page' => 1,
                    ),
                ),
            ), 
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Session' => function ($sm) {
                return new Zend\Session\Container('SessionApplication');
            },
        )
    ),
    
//    'service_manager' => array(
//        'factories' => array(
//            'Session' => function ($sm) {
//                return new Zend\Session\Container('SessionApplication');
//            },
//        )
//    ),
    
                    
//                    
//    'service_manager' => array(
//       'factories' => array(
//           'Session' => function ($sm) {
//               return new Zend\Session\Container('SessionApplication');
//           },
//       ),
//       'abstract_factories' => array(
//           'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
//           'Zend\Log\LoggerAbstractServiceFactory',
//       ),
//       'aliases' => array(
//           'translator' => 'MvcTranslator',
//       ),
//   ),
//                    
                    
                    

    'view_manager' => array( 
        'template_path_stack' => array(
            'application' => __DIR__ . '/../view',
        ),
    ),
   
);
