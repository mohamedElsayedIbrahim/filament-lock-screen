<?php

namespace MohamedElsayedIbrahim\FilamentLockscreen\Tests;

use MohamedElsayedIbrahim\FilamentLockscreen\FilamentLockScreenServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            FilamentLockScreenServiceProvider::class,
        ];
    }
}