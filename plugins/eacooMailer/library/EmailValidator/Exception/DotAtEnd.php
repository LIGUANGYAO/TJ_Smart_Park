<?php

namespace plugins\eacooMailer\library\EmailValidator\Exception;

class DotAtEnd extends InvalidEmail
{
    const CODE = 142;
    const REASON = "Dot at the end";
}
