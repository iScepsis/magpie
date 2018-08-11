<?php
/**
 * Created by PhpStorm.
 * User: Scepsis
 * Date: 11.08.2018
 * Time: 10:00
 */

namespace src\Exceptions;

use Exception;

class EntityValidateException extends Exception
{
    public $fieldName;

    public function __construct($fieldName, $message = "")
    {
        $this->fieldName = $fieldName;
        parent::__construct($message);
    }
}