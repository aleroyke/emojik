<?php

namespace Emoji\Facades;

use Illuminate\Support\Facades\Facade;

class Emoji extends Facade {
    protected static function getFacadeAccessor() {
        return 'laravel-emoji';
    }
}
