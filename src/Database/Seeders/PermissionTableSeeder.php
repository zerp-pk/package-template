<?php

namespace Zerp\ExamplePackage\Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        Artisan::call('cache:clear');

        $permission = [
            ['name' => 'manage-example-package', 'module' => 'example-package', 'label' => 'Manage ExamplePackage'],
            ['name' => 'manage-any-example-package', 'module' => 'example-package', 'label' => 'Manage All ExamplePackage'],
            ['name' => 'manage-own-example-package', 'module' => 'example-package', 'label' => 'Manage Own ExamplePackage'],
            ['name' => 'view-example-package', 'module' => 'example-package', 'label' => 'View ExamplePackage'],
            ['name' => 'create-example-package', 'module' => 'example-package', 'label' => 'Create ExamplePackage'],
            ['name' => 'edit-example-package', 'module' => 'example-package', 'label' => 'Edit ExamplePackage'],
            ['name' => 'delete-example-package', 'module' => 'example-package', 'label' => 'Delete ExamplePackage'],
        ];

        $company_role = Role::where('name', 'company')->first();

        foreach ($permission as $perm) {
            $permission_obj = Permission::firstOrCreate(
                ['name' => $perm['name'], 'guard_name' => 'web'],
                [
                    'module' => $perm['module'],
                    'label' => $perm['label'],
                    'add_on' => 'ExamplePackage',
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            if ($company_role && !$company_role->hasPermissionTo($permission_obj)) {
                $company_role->givePermissionTo($permission_obj);
            }
        }
    }
}