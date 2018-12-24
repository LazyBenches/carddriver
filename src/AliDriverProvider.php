<?php

namespace LazyBench\CardDriver;

use Illuminate\Support\ServiceProvider;
use LazyBench\CardDriver\Driver\Ali;

/**
 * Author:LazyBench
 * Date:2018/12/24
 */
class AliDriverProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('aliBankDriver', function () {
            return new Ali();
        });
    }
}