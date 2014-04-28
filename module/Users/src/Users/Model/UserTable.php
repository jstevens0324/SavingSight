<?php

namespace Users\Model;

use Application\Model\DbModel;

class UserTable extends DbModel
{
    public function save($data)
    {
        $data['status']   = 'active';
        $data['password'] = $this->getRandomPassword();
        parent::save($data);
    }

    public function getRandomPassword($length = 10)
    {
        $characters   = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}

?>
