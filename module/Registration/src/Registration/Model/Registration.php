<?php

namespace Registration\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Registration implements InputFilterAwareInterface
{
    public $Username;
    public $email;
    public $password;
    public $timezone;
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->Username = (isset($data['Username'])) ? $data['Username'] : NULL;
        $this->email    = (isset($data['email'])) ? $data['email'] : NULL;
        $this->password = (isset($data['password'])) ? $data['password'] : NULL;
        $this->timezone = (isset($data['timezone'])) ? $data['timezone'] : NULL;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput([
                'name'       => 'Username',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(),
            ]));

            $inputFilter->add($factory->createInput([
                'name'       => 'email',
                'filters'    => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    ),
                ),
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                        'options' => array(
                            'messages' => array(
                                'emailAddressInvalidFormat' => 'Email address format is not invalid'
                            ),
                        ),
                    ),
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                'isEmpty' => 'Email address is required'
                            ),
                        ),
                    ),
                ),
            ]));

            $inputFilter->add($factory->createInput([
                'name'       => 'password',
                'filters'    => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    ),
                ),
                'validators' => array(),
            ]));

            $inputFilter->add($factory->createInput([
                'name'       => 'timezone',
                'filters'    => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    ),
                ),
                'validators' => array(
                    array(
                        'name'    => 'InArray',
                        'options' => array(
                            'haystack' => array(
                                0,
                                1,
                                2,
                                3,
                                4
                            ),
                            'messages' => array(
                                'notInArray' => 'undefined'
                            ),
                        ),
                    ),

                ),
            ]));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}