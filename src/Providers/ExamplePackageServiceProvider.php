<?php

namespace Zerp\ExamplePackage\Providers;

use Illuminate\Support\ServiceProvider;

class ExamplePackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $routesPath = __DIR__.'/../Routes/web.php';
        if (file_exists($routesPath)) {
            $this->loadRoutesFrom($routesPath);
        }

        $apiRoutesPath = __DIR__.'/../Routes/api.php';
        if (file_exists($apiRoutesPath)) {
            $this->loadRoutesFrom($apiRoutesPath);
        }

        // Scoped Swagger/OpenAPI docs for this module at /docs/example-package.
        // Uncomment once you have renamed the package and real API endpoints
        // exist; guarded so the module still works if the host app has no
        // Scramble. Rename 'example-package' and 'zerp/example-package' to match
        // this module.
        //
        // if (class_exists(\Dedoc\Scramble\Scramble::class)) {
        //     \Dedoc\Scramble\Scramble::registerApi('example-package', [
        //         'api_path' => 'api/example-package',
        //         'info' => ['version' => \Composer\InstalledVersions::getPrettyVersion('zerp/example-package') ?? '1.0.0', 'description' => 'Zerp ExamplePackage module REST API for mobile and third-party clients.'],
        //         'ui' => ['title' => 'Zerp ExamplePackage API'],
        //     ])->expose(ui: '/docs/example-package', document: '/docs/example-package.json');
        // }

        $migrationsPath = __DIR__.'/../Database/Migrations';
        if (is_dir($migrationsPath)) {
            $this->loadMigrationsFrom($migrationsPath);
        }
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }
}