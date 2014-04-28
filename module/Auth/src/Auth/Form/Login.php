<?php

namespace Auth\Form;

use Zend\Form\Form;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class Login extends Form
{

    protected $inputFilter;

    public function __construct($name = NULL)
    {
        parent::__construct('login_form');

        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'login_form');
        $this->setAttribute('class', 'stdform');

        $this->add(array(
            'name'       => 'username',
            'required'   => 'true',
            'attributes' => array(
                'type' => 'text',
                'id'   => 'username',
            ),
            'options'    => array(
                'label' => 'Username'
            )
        ));

        $this->add(array(
            'name'       => 'password',
            'required'   => 'true',
            'attributes' => array(
                'type' => 'password',
                'id'   => 'password',
            ),
            'options'    => array(
                'label' => 'Password'
            )
        ));
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'       => 'username',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array('message' => 'Username cannot be empty'),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'       => 'password',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array('message' => 'Password cannot be empty'),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}

?>
