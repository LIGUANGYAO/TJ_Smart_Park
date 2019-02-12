<?php

namespace plugins\eacooMailer\library\EmailValidator\Warning;

use plugins\eacooMailer\library\EmailValidator\EmailParser;

class EmailTooLong extends Warning
{
    const CODE = 66;

    public function __construct()
    {
        $this->message = 'Email is too long, exceeds ' . EmailParser::EMAIL_MAX_LENGTH;
    }
}
