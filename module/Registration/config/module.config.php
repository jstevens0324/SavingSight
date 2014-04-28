<?php

$default = array(
    'di' => array(
        'instance' => array(
            'alias'                            => array(
                'registration' => 'Registration\Controller\RegistrationController',
            ),
            'Registration\Controller\RegistrationController' => array(
                'parameters' => array(
                    'registrations' => 'Registration\Model\Registrations',
                ),
            ),
            'Registration\Model\Registrations'               => array(
                'parameters' => array(
                    'config' => 'Zend\Db\Adapter\Pdo_Mysql',
                )
            ),
            'Zend\Db\Adapter\Pdo_Mysql'           => array(
                'parameters' => array(
                    'config' => array(
                        'host'     => 'localhost',
                        'username' => 'rob',
                        'password' => '123456',
                        'dbname'   => 'zf2tutorial',
                    ),
                ),
            ),
            'Zend\View\PhpRenderer'            => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\TemplatePathStack',
                    'options'  => array(
                        'script_paths' => array(
                            'Registration' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
        )
    ),
);

// published environments
$production  = $default;
$staging     = $default;
$testing     = $default;
$development = $default;

$config = compact('production', 'staging', 'testing', 'development');
return $config;