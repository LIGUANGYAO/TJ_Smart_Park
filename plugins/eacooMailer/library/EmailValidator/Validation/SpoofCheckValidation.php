<?php

namespace plugins\smtp\library\EmailValidator\Validation;

use plugins\smtp\library\EmailValidator\EmailLexer;
use plugins\smtp\library\EmailValidator\Exception\InvalidEmail;
use plugins\smtp\library\EmailValidator\Validation\Error\SpoofEmail;
use \Spoofchecker;

class SpoofCheckValidation implements EmailValidation
{
    /**
     * @var InvalidEmail
     */
    private $error;
    
    public function __construct()
    {
        if (!class_exists(Spoofchecker::class)) {
            throw new \LogicException(sprintf('The %s class requires the Intl extension.', __CLASS__));
        }
    }

    public function isValid($email, EmailLexer $emailLexer)
    {
        $checker = new Spoofchecker();
        $checker->setChecks(Spoofchecker::SINGLE_SCRIPT);

        if ($checker->isSuspicious($email)) {
            $this->error = new SpoofEmail();
        }

        return $this->error === null;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getWarnings()
    {
        return [];
    }
}
