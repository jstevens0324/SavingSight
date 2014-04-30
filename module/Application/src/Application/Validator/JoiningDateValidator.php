<?php

namespace Application\Validator;

use Zend\Validator\AbstractValidator;

class JoiningDateValidator extends AbstractValidator
{

    const INVALID_JOINING_DATE = 'invalidJoiningDate';

    protected $messageTemplates = array(
        self::INVALID_JOINING_DATE => 'Please enter joining date',
    );

    public function isValid($value, $context = NULL)
    {
        if (empty($value) && !empty($context['leaving_date']))
        {
            $this->error(self::INVALID_JOINING_DATE);
            return FALSE;
        }
        return TRUE;
    }

}
