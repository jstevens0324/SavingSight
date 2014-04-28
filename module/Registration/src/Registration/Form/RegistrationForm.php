<?php

namespace Registration\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class RegistrationForm extends Form
{
    public function __construct($name = NULL)
    {
        parent::__construct('registration');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name'       => 'Username',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'username',
                'required'    => 'required',
            ),
            'options'    => array(
                'label' => 'Username',
            ),
        ));

        $this->add(array(
            'name'       => 'email',
            'type'       => 'Zend\Form\Element\Email',
            'attributes' => array(
                'placeholder' => 'Email Address...',
                'required'    => 'required',
            ),
            'options'    => array(
                'label' => 'Email',
            ),
        ));

        $this->add(array(
            'name'       => 'password',
            'type'       => 'Zend\Form\Element\Password',
            'attributes' => array(
                'placeholder' => 'Password Here...',
                'required'    => 'required',
            ),
            'options'    => array(
                'label' => 'Password',
            ),
        ));

        $this->add(array(
            'name'       => 'timezone',
            'type'       => 'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
                'value'    => '0',
            ),
            'options'    => array(
                'label'         => 'Timezone',
                'value_options' => array(
                    '0' => 'CST',
                    '1' => 'EST',
                    '2' => 'MDT',
                    '3' => 'PDT ',
                    '4' => 'MST',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Zend\Form\Element\Csrf',
        ));
    }
}