<?php

namespace plugins\eacooMailer\library\EmailValidator\Validation;

use plugins\eacooMailer\library\EmailValidator\Exception\InvalidEmail;

class MultipleErrors extends InvalidEmail
{
    const CODE = 999;
    const REASON = "Accumulated errors for multiple validations";
    /**
     * @var array
     */
    private $errors = [];

    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
