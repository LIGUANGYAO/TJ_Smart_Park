<?php

namespace plugins\eacooMailer\library\EmailValidator\Exception;

use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;

class NoDNSRecord extends InvalidEmail
{
    const CODE = 5;
    const REASON = 'No MX or A DSN record was found for this email';
}
