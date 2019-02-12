<?php

namespace plugins\eacooMailer\library\EmailValidator\Validation\Error;

use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;

class RFCWarnings extends InvalidEmail
{
    const CODE = 997;
    const REASON = 'Warnings were found.';
}
