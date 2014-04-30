<?php

namespace Users\Controller;

use Users\Form\Users;
use Users\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\Register;

class UserController extends AbstractActionController
{

    protected $userTable;

    public function indexAction()
    {
        $authService = new \Zend\Authentication\AuthenticationService;

        $userArray = array();
        if ($authService->hasIdentity())
        {
            $userRow = $authService->getIdentity();
            $user    = new \Users\Model\User($userRow);
        }
        else
        {
            $userArray['first_name'] = 'Guest';
            $userArray['role']       = 'guest';
            $user                    = new \Users\Model\User;
            $user->exchangeArray($userArray);
        }

        return new ViewModel(array(
            'user' => $this->getUserTable()->getUser($user->id),
        ));
    }

    public function updateAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id)
        {
            return $this->redirect()->toRoute('user', array(
                'action' => 'index'
            ));
        }
        $user = $this->getUserTable()->getUser($id);

        $form = new Users();
        $form->bind($user);

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid())
            {
                $this->getUserTable()->saveUser($form->getData());

                // Redirect to list of users
                return $this->redirect()->toRoute('user');
            }
        }

        return array(
            'id'   => $id,
            'form' => $form,
        );
    }

    public function registerAction()
    {
        $form = new Register();
        //$form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid())
            {
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);

                // Redirect to list of users
                return $this->redirect()->toRoute('auth');
            }
        }
        return array('form' => $form);

    }

    public function getUserTable()
    {
        if (!$this->userTable)
        {
            $sm              = $this->getServiceLocator();
            $this->userTable = $sm->get('Users\Model\UserTable');
        }
        return $this->userTable;
    }

}