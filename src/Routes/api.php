<?php

use Illuminate\Support\Facades\Route;
use Zerp\ExamplePackage\Http\Controllers\Api\ExamplePackageItemApiController;

// The module's mobile / third-party REST API. Same shape as every other Zerp
// module: api.json forces JSON responses, auth:sanctum guards the routes, and
// the module slug prefixes the group so paths never collide with another
// module's. Add real endpoints alongside the sample below.
Route::prefix('api')->middleware(['api.json'])->group(function () {
    Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'example-package'], function () {
        Route::get('items', [ExamplePackageItemApiController::class, 'index']);
    });
});
