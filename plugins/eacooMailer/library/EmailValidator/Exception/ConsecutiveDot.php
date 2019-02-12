<?php

namespace plugins\eacooMailer\library\EmailValidator\Exception;

class ConsecutiveDot extends InvalidEmail
{
    const CODE = 132;
    const REASON = "Consecutive DOT";
}
