<?php
return array(
    'db'              => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=savingsight;host=198.211.102.146',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);