<?php

namespace PantheraStudio\Emojik\Exceptions;

use Exception;

class UnknownUnicode extends Exception {
    public static function create($value) : UnknownUnicode {
        return new static("{$value} not found.");
    }
}