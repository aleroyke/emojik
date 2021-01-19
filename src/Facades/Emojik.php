<?php

namespace PantheraStudio\Emojik\Facades;

use Illuminate\Support\Facades\Facade;

class Emojik extends Facade {
    protected static function getFacadeAccessor() {
        return 'emojik';
    }
}
