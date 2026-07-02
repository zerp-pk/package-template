<?php

use Illuminate\Support\Facades\Route;
use Zerp\ExamplePackage\Http\Controllers\DashboardController;
use Zerp\ExamplePackage\Http\Controllers\ExamplePackageItemController;

Route::middleware(['web', 'auth', 'verified', 'PlanModuleCheck:ExamplePackage'])->group(function () {
    Route::get('/example-package', [DashboardController::class, 'index'])->name('example-package.index');

    Route::prefix('example-package/items')->name('example-package.items.')->group(function () {
        Route::get('/', [ExamplePackageItemController::class, 'index'])->name('index');
        Route::get('/create', [ExamplePackageItemController::class, 'create'])->name('create');
        Route::post('/', [ExamplePackageItemController::class, 'store'])->name('store');
        Route::get('/{item}/edit', [ExamplePackageItemController::class, 'edit'])->name('edit');
        Route::put('/{item}', [ExamplePackageItemController::class, 'update'])->name('update');
        Route::delete('/{item}', [ExamplePackageItemController::class, 'destroy'])->name('destroy');
    });
});