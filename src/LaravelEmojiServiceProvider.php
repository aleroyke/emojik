<?php
namespace Emoji;

use Illuminate\Support\ServiceProvider;

class LaravelEmojiServiceProvider extends ServiceProvider {
    protected $defer = false;

    public function register() {
        $this->app->bind('laravel-emoji', function () {
            return new LaravelEmoji;
        });
    }

    public function provides() : array {
        return ['laravel-emoji'];
    }
}