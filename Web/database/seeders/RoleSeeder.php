<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super admin']);
        $marketAdmin = Role::firstOrCreate(['name' => 'market admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $customer = Role::firstOrCreate(['name' => 'customer']);
        $models = [
            'user' => 'store, update, delete, register, index',
            'market' => 'store, update, delete'
        ];
        $superAdminPermissions = [];
        foreach ($models as $key => $model) {
            $actions = explode(',', $model);
            foreach ($actions as $action) {
                ${"permission" . ucwords($key) .ucwords(trim($action))} = Permission::firstOrCreate(['name' => $key . ':' .trim($action)]);
                array_push($superAdminPermissions, ${"permission" . ucwords($key) .ucwords(trim($action))});
            }
        }

        $superAdmin->givePermissionTo($superAdminPermissions);
        $marketAdmin->givePermissionTo($superAdminPermissions);
        $manager->givePermissionTo([$permissionMarketStore, $permissionMarketUpdate, $permissionMarketDelete]);
        $userFirst = User::first();
        $userFirst->assignRole($superAdmin);
    }
}
