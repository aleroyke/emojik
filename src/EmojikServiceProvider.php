<?php
namespace PantheraStudio\Emojik;

use Illuminate\Support\ServiceProvider;

class EmojikServiceProvider extends ServiceProvider {
    protected $defer = false;

    public function register() {
        $this->app->bind('emojik', function () {
            return new Emojik;
        });
    }

    public function provides() : array {
        return ['emojik'];
    }
}