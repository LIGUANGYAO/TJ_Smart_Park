<?php

namespace plugins\eacooMailer\library\EmailValidator\Validation;

use plugins\eacooMailer\library\EmailValidator\EmailLexer;
use plugins\eacooMailer\library\EmailValidator\EmailParser;
use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;

class RFCValidation implements EmailValidation
{
    /**
     * @var EmailParser
     */
    private $parser;

    /**
     * @var array
     */
    private $warnings = [];

    /**
     * @var InvalidEmail
     */
    private $error;

    public function isValid($email, EmailLexer $emailLexer)
    {
        $this->parser = new EmailParser($emailLexer);
        try {
            $this->parser->parse((string)$email);
        } catch (InvalidEmail $invalid) {
            $this->error = $invalid;
            return false;
        }

        $this->warnings = $this->parser->getWarnings();
        return true;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getWarnings()
    {
        return $this->warnings;
    }
}
