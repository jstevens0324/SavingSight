<?php

namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;

class User extends AbstractHelper
{

    public function __invoke()
    {
        $authService = new \Zend\Authentication\AuthenticationService;

        $userArray = array();
        if ($authService->hasIdentity())
        {
            $userRow = $authService->getIdentity();
            $user = new \Users\Model\User($userRow);
        }
        else
        {
            $userArray['first_name'] = 'Guest';
            $userArray['role'] = 'guest';
            $user = new \Users\Model\User;
            $user->exchangeArray($userArray);
        }
        return $user;
    }

}

?>
