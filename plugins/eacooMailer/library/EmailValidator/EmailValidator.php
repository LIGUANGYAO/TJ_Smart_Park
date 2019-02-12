<?php

namespace plugins\eacooMailer\library\EmailValidator;

use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;
use plugins\eacooMailer\library\EmailValidator\Validation\EmailValidation;

class EmailValidator
{
    /**
     * @var EmailLexer
     */
    private $lexer;

    /**
     * @var array
     */
    protected $warnings;

    /**
     * @var InvalidEmail
     */
    protected $error;

    public function __construct()
    {
        $this->lexer = new EmailLexer();
    }

    /**
     * @param                 $email
     * @param EmailValidation $emailValidation
     * @return bool
     */
    public function isValid($email, EmailValidation $emailValidation)
    {
        $isValid = $emailValidation->isValid($email, $this->lexer);
        $this->warnings = $emailValidation->getWarnings();
        $this->error = $emailValidation->getError();

        return $isValid;
    }

    /**
     * @return boolean
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return InvalidEmail
     */
    public function getError()
    {
        return $this->error;
    }
}
