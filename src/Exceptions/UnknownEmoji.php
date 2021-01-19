<?php

namespace Emoji\Exceptions;

use Exception;

class UnknownEmoji extends Exception {
    public static function create($value) : UnknownEmoji {
        return new static("{$value} not found.");
    }
}