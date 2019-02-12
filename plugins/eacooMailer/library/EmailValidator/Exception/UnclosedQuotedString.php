<?php

namespace plugins\eacooMailer\library\EmailValidator\Exception;

class UnclosedQuotedString extends InvalidEmail
{
    const CODE = 145;
    const REASON = "Unclosed quoted string";
}
