<?php

return array(
    //extreme parent should come first and than so on
    'roles'       => array(
        array(
            'name'   => 'admin',
            'parent' => ''
        ),
        array(
            'name'   => 'user',
            'parent' => 'admin'
        ),
        array(
            'name'   => 'guest',
            'parent' => 'user'
        ),
    ),
    'resources'   => array(
        'Users',
        'Auth',
        'Application'
    ),
    'permissions' => array(
        array(
            'allow'     => array(
                'guest',
                'admin',
                'user'
            ),
            'deny'      => array(),
            'resource'  => 'Application',
            'privilege' => array( //controller:action
                                  'index:index',
            ),
        ),

        array(
            'deny'      => array(
                'user',
                'admin'
            ),
            'allow'     => array('guest'),
            'resource'  => 'Auth',
            'privilege' => array( //controller:action
                                  'auth:index',
            ),
        ),
        array(
            'allow'     => array(
                'admin',
                'user'
            ),
            'deny'      => array('guest'),
            'resource'  => 'Auth',
            'privilege' => array( //controller:action
                                  'auth:logout',
                                  'auth:test',
            ),
        ),
        array(
            'deny'      => array('guest'),
            'allow'     => array(
                'admin',
                'user'
            ),
            'resource'  => 'Users',
            'privilege' => array(
                'user:add',
                'user:index'
            ),
        ),
    ),
);
