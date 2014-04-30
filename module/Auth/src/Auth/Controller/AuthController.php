<?php

namespace Auth\Controller;

use Auth\Form\Login as LoginForm;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService as AuthService;
use Zend\Mvc\Controller\AbstractActionController;

class AuthController extends AbstractActionController
{

    public function indexAction()
    {
        $form   = new LoginForm;
        $errors = array();
        if ($this->request->isPost())
        {
            $form->setData($this->request->getPost());
            if ($form->isValid())
            {
                $params      = $this->request->getPost();
                $dbAdapter   = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
                $authAdapter = new AuthAdapter($dbAdapter, 'user', 'email', 'password');
                $authAdapter->setIdentity($params['username']);
                $authAdapter->setCredential(md5($params['password']));
                $authService = new AuthService(NULL, $authAdapter);
                $result      = $authService->authenticate();
                if ($result->isValid())
                {
                    $authService->getStorage()->write($authAdapter->getResultRowObject());
                    $this->redirect()->toRoute('home');
                }
                else
                {
                    $errors[] = 'Invalid Credentials';
                }
            }
        }
        return array(
            'form'   => $form,
            'errors' => $errors
        );
    }

    public function testAction()
    {
        $this->getServiceLocator()->get('Acl');
        $authService = new AuthService();
        if ($authService->hasIdentity())
        {
            die("I am a loggedin user");
        }
        else
        {
            die("I am a logged out user");
        }
    }

    public function logoutAction()
    {
        $authService = new AuthService();
        $authService->getStorage()->clear();
        $this->redirect()->toRoute('home');
    }

}