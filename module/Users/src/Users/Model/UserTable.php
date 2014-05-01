<?php

namespace Users\Model;

use Application\Model\DbModel;
use Zend\Db\TableGateway\TableGateway;

class UserTable
{
    protected $tableGateway;
    protected $timezone;
    protected $offset;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function saveUser(User $user)
    {

        $this->setTimezone($user->timezone);
        $this->setOffset();
        $data = array(
            'username'        => $user->username,
            'first_name'      => $user->first_name,
            'last_name'       => $user->last_name,
            'email'           => $user->email,
            'password'        => md5($user->password),
            'role'            => $user->role,
            'status'          => 'active',
            'timezone'        => $this->timezone,
            'timezone_offset' => $this->offset,
        );

        $id = (int)$user->id;
        if ($id == 0)
        {
            $this->tableGateway->insert($data);
        }
        else
        {
            if ($this->getUser($id))
            {
                $this->tableGateway->update($data, array('id' => $id));
            }
            else
            {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getUser($id)
    {
        $id     = (int)$id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row    = $rowset->current();
        if (!$row)
        {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function deleteUser($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }

    public function setTimezone($timezone)
    {
        switch ($timezone)
        {
            case '0':
                $this->timezone = 'CDT';
                break;
            case '1':
                $this->timezone = 'EDT';
                break;
            case '2':
                $this->timezone = 'PDT';
                break;
            case '3':
                $this->timezone = 'MDT';
                break;
            default:
                $this->timezone = 'CDT';

        }
    }

    public function setOffset()
    {
        switch ($this->timezone)
        {
            case 'CDT':
                $this->offset = '-5 hour';
                break;
            case 'EDT':
                $this->offset = '-6 hour';
                break;
            case 'PDT':
                $this->offset = '-3 hour';
                break;
            case 'MDT':
                $this->offset = '-4 hour';
                break;
            default:
                $this->offset = '-5 hour';

        }
    }

}

?>
