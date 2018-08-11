<?php

namespace src\Validators;

abstract class Validator {

    public static $validateLog = [];

    public static function validate($entity) {

    }

    /**
     * Проверка на пустоту
     * @param $val
     * @return bool
     */
    protected static function checkRequired($val){
        if (is_string($val)) $val = trim($val);
        return !empty($val);
    }

    /**
     * Проверка корректности timestamp
     * @param $val
     * @return bool
     */
    protected static function checkTimestamp($val){
        return ((string) (int) $val === $val)
            && ($val <= PHP_INT_MAX)
            && ($val >= ~PHP_INT_MAX);
    }

}