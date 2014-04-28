<?php

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        $userModel       = $this->getServiceLocator()->get('User');
        $query           = $this->request->getQuery();
        $users           = $userModel->grid($query);
        $viewModel       = new ViewModel;
        $viewModel->grid = $users;
        return $viewModel;
    }

    public function addAction()
    {
        $form = new \Users\Form\Users('users', $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        if ($this->request->isPost())
        {
            $form->setData($this->request->getPost());
            $form->setInputFilter($form->getInputFilter());
            if ($form->isValid())
            {
                $userModel = $this->getServiceLocator()->get('User');
                $id        = $userModel->save($form->getData());
                $this->redirect()->toRoute('user', array('action' => 'index'));
            }
        }
        $viewModel       = new ViewModel;
        $viewModel->form = $form;
        return $viewModel;
    }

    public function editAction()
    {
        $form = new \Users\Form\Users('users', $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        if ($this->request->isPost())
        {
            $form->setData($this->request->getPost());
            $form->setInputFilter($form->getInputFilter());
            if ($form->isValid())
            {
                $userModel = $this->getServiceLocator()->get('User');
                $id        = $userModel->save($form->getData());
                $this->redirect()->toRoute('user', array('action' => 'index'));
            }
        }
        $viewModel       = new ViewModel;
        $viewModel->form = $form;
        return $viewModel;
    }
}