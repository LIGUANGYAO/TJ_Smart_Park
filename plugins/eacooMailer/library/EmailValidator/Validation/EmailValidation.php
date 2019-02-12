<?php

namespace plugins\eacooMailer\library\EmailValidator\Validation;

use plugins\eacooMailer\library\EmailValidator\EmailLexer;
use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;
use plugins\eacooMailer\library\EmailValidator\Warning\Warning;

interface EmailValidation
{
    /**
     * Returns true if the given email is valid.
     *
     * @param string     $email      The email you want to validate.
     * @param EmailLexer $emailLexer The email lexer.
     *
     * @return bool
     */
    public function isValid($email, EmailLexer $emailLexer);

    /**
     * Returns the validation error.
     *
     * @return InvalidEmail|null
     */
    public function getError();

    /**
     * Returns the validation warnings.
     *
     * @return Warning[]
     */
    public function getWarnings();
}
