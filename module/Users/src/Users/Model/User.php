<?php

namespace Users\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{

    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $email;
    public $role;
    public $status;
    public $created_date;
    public $updated_date;
    public $timezone;
    public $timezone_offset;

    protected $inputFilter;

    public function toArray()
    {
        return (array)$this;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    public function exchangeArray($row)
    {
        $this->id              = isset($row['id']) ? $row['id'] : NULL;
        $this->username        = isset($row['username']) ? $row['username'] : NULL;
        $this->first_name      = isset($row['first_name']) ? $row['first_name'] : NULL;
        $this->last_name       = isset($row['last_name']) ? $row['last_name'] : NULL;
        $this->email           = isset($row['email']) ? $row['email'] : NULL;
        $this->password        = isset($row['password']) ? $row['password'] : NULL;
        $this->role            = isset($row['role']) ? $row['role'] : NULL;
        $this->status          = isset($row['status']) ? $row['status'] : NULL;
        $this->created_date    = isset($row['created_date']) ? $row['created_date'] : NULL;
        $this->updated_date    = isset($row['updated_date']) ? $row['updated_date'] : NULL;
        $this->timezone        = isset($row['timezone']) ? $row['timezone'] : NULL;
        $this->timezone_offset = isset($row['timezone_offset']) ? $row['timezone_offset'] : NULL;
    }

    public function __construct($row = NULL)
    {
        if ($row != NULL)
        {
            $this->id              = isset($row->id) ? $row->id : NULL;
            $this->username        = isset($row->username) ? $row->username : NULL;
            $this->first_name      = isset($row->first_name) ? $row->first_name : NULL;
            $this->last_name       = isset($row->last_name) ? $row->last_name : NULL;
            $this->email           = isset($row->email) ? $row->email : NULL;
            $this->password        = isset($row->password) ? $row->password : NULL;
            $this->role            = isset($row->username) ? $row->username : NULL;
            $this->status          = isset($row->status) ? $row->status : NULL;
            $this->created_date    = isset($row->created_date) ? $row->created_date : NULL;
            $this->updated_date    = isset($row->updated_date) ? $row->updated_date : NULL;
            $this->timezone        = isset($row->timezone) ? $row->timezone : NULL;
            $this->timezone_offset = isset($row->timezone_offset) ? $row->timezone_offset : NULL;
        }
    }

    // Add content to this method:
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
                        'options' => array('message' => 'First Name cannot be empty'),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'       => 'first_name',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array('message' => 'First Name cannot be empty'),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(

                'name'       => 'last_name',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array('message' => 'Last Name cannot be empty'),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'       => 'email',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array('message' => 'Email cannot be empty'),
                    ),
                    array(
                        'name' => 'EmailAddress',
                        'options' => array('message' => 'Email must be a valid Email Address'),
                    )
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'       => 'role',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array('message' => 'Role cannot be empty'),
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
                        'options' => array('message' => 'password cannot be empty'),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'       => 'passwordCheck',
                'required'   => TRUE,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'Identical',
                        'options' => array(
                            'token' => 'password',
                            // name of first password field
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}

