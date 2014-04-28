<?php
return array(
    
    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/user[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Users\Controller\User',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    'controllers' => array(
        'invokables' => array(
            'Users\Controller\User' => 'Users\Controller\UserController'
        )
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
