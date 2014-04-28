<?php

return array(
    'router' => array(
        'routes' => array(
            'auth' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/auth[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Auth\Controller\Auth',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Auth\Controller\Auth' => 'Auth\Controller\AuthController'
        )
    ),
    'acl' => include 'acl.config.php',
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
