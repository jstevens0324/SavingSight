<?php

namespace Registration\Controller;

use Registration\Form\RegistrationForm;
use Registration\Model\Registration;
use Zend\Mvc\Controller\AbstractActionController;

class RegistrationController extends AbstractActionController
{
    public function indexAction()
    {
        $form    = new RegistrationForm();
        $request = $this->getRequest();

        if ($request->isPost())
        {
            $registration = new Registration();

            $formValidator = new Validator();
            {
                $form->setInputFilter($formValidator->getInputFilter());
                $form->setData($request->getPost());
            }

            if ($form->isValid())
            {
                {
                    $registration->exchangeArray($form->getData());
                }
            }

            return ['form' => $form];
        }
    }
}