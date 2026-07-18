<?php

namespace Zerp\ExamplePackage\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Zerp\ExamplePackage\Providers\ExamplePackageServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [ExamplePackageServiceProvider::class];
    }
}
