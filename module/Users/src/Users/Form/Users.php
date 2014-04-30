<?php

namespace Users\Form;

use Users\Model;
use Zend\Form\Form;

class Users extends Form
{

    protected $user;

    public function __construct($name = 'null')
    {
        parent::__construct('users');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'users');

        $this->add(array(
            'name'       => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name'       => 'username',
            'required'   => 'required',
            'attributes' => array(
                'type' => 'text',
                'size' => '32',
                'id'   => 'username',
            ),
            'options'    => array(
                'label' => 'Username'
            ),
        ));

        $this->add(array(
            'name'       => 'first_name',
            'required'   => 'required',
            'attributes' => array(
                'type' => 'text',
                'size' => '32',
                'id'   => 'first_name',
            ),
            'options'    => array(
                'label' => 'First Name'
            ),
        ));

        $this->add(array(
            'name'       => 'last_name',
            'required'   => 'required',
            'attributes' => array(
                'type' => 'text',
                'size' => '32',
                'id'   => 'last_name',
            ),
            'options'    => array(
                'label' => 'Last Name ',
            ),
        ));

        $this->add(array(
            'type'       => 'Zend\Form\Element\Email',
            'name'       => 'email',
            'required'   => 'required',
            'attributes' => array(
                'id'   => 'email',
                'size' => '32',
            ),
            'options'    => array(
                'label' => 'Email ',
            ),
        ));

        $this->add(array(
            'type'       => 'Zend\Form\Element\Password',
            'name'       => 'password',
            'required'   => 'required',
            'attributes' => array(
                'id'   => 'password',
                'size' => '32',
            ),
            'options'    => array(
                'label' => 'Password',
            ),

        ));
        $this->add(array(
            'type'       => 'Zend\Form\Element\Password',
            'name'       => 'passwordCheck',
            'required'   => 'required',
            'attributes' => array(
                'id'   => 'passwordCheck',
                'size' => '32',
            ),
            'validators' => array(
                array(
                    'name'    => 'Identical',
                    'options' => array(
                        'token' => 'password',
                    ),
                ),
            ),
            'options'    => array(
                'label' => 'Verify Password ',
            ),
        ));

        $this->add(array(
            'type'       => 'Zend\Form\Element\Select',
            'name'       => 'role',
            'required'   => 'required',
            'attributes' => array(
                'id'    => 'role',
                'class' => 'uniformselect'
            ),
            'options'    => array(
                'label'         => 'Role ',
                'value_options' => array(
                    ''      => 'Select Role',
                    'user'  => 'User',
                    'admin' => 'Admin',
                )
            ),
        ));

        $this->add(array(
            'name'       => 'status',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'type'       => 'Zend\Form\Element\Select',
            'name'       => 'timezone',
            'required'   => 'required',
            'attributes' => array(
                'id'      => 'timezone',
                'options' => array(
                    '0' => 'CDT',
                    '1' => 'EDT',
                    '2' => 'PDT',
                    '3' => 'MDT',
                ),
            ),
            'options'    => array(
                'label' => 'Timezone',
            ),
        ));
    }
}