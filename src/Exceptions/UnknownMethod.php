<?php

namespace PantheraStudio\Emojik\Exceptions;

use Exception;

class UnknownMethod extends Exception {
    public static function create($value) : UnknownMethod {
        return new static("{$value} does not exist.");
    }
}