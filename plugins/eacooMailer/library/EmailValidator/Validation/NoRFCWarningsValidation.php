<?php

namespace plugins\eacooMailer\library\EmailValidator\Validation;

use plugins\eacooMailer\library\EmailValidator\EmailLexer;
use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;
use plugins\eacooMailer\library\EmailValidator\Validation\Error\RFCWarnings;

class NoRFCWarningsValidation extends RFCValidation
{
    /**
     * @var InvalidEmail
     */
    private $error;

    /**
     * {@inheritdoc}
     */
    public function isValid($email, EmailLexer $emailLexer)
    {
        if (!parent::isValid($email, $emailLexer)) {
            return false;
        }

        if (empty($this->getWarnings())) {
            return true;
        }

        $this->error = new RFCWarnings();

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        return $this->error ?: parent::getError();
    }
}
