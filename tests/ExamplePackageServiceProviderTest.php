<?php

namespace Zerp\ExamplePackage\Tests;

use Illuminate\Support\Facades\Route;
use Zerp\ExamplePackage\Providers\ExamplePackageServiceProvider;

class ExamplePackageServiceProviderTest extends TestCase
{
    public function test_service_provider_boots(): void
    {
        $this->assertTrue(
            $this->app->providerIsLoaded(ExamplePackageServiceProvider::class)
        );
    }

    public function test_package_routes_are_registered(): void
    {
        // Route registration only stores middleware names, so this resolves
        // without the host app's PlanModuleCheck/auth middleware being defined.
        $this->assertTrue(Route::has('example-package.items.index'));
    }
}
