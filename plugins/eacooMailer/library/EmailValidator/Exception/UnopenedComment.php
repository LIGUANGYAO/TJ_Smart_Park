<?php

namespace plugins\eacooMailer\library\EmailValidator\Exception;

class UnopenedComment extends InvalidEmail
{
    const CODE = 152;
    const REASON = "No opening comment token found";
}
