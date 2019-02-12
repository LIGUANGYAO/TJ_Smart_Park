<?php

namespace plugins\eacooMailer\library\EmailValidator\Validation\Error;

use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;

class SpoofEmail extends InvalidEmail
{
    const CODE = 998;
    const REASON = "The email contains mixed UTF8 chars that makes it suspicious";
}
