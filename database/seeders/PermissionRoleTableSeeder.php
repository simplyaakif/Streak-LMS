<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_'
                && substr($permission->title, 0, 5) != 'role_'
                && substr($permission->title, 0, 5) != 'permission_'
                && substr($permission->title, 0, 11) != 'staff_'
                && substr($permission->title, 0, 1) != 'study_'
                && substr($permission->title, 0, 1) != 'examination_'
                && substr($permission->title, 0, 22) != 'asset_';
        });
        Role::findOrFail(4)->permissions()->sync($user_permissions);
    }
}
