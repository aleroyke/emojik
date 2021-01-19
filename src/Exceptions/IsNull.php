<?php

namespace Emoji\Exceptions;

use Exception;

class IsNull extends Exception {
    public static function create($value) {
        return new static("$value");
    }
}