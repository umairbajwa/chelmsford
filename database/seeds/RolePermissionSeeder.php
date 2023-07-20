<?php

use App\RolePermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_permissions')->truncate();
        $permissions = [
            1 => [1, 2, 3, 4, 5, 6, 7]
        ];
        foreach ($permissions as $role => $permission) {
            $rolePermissions = [];
            foreach ($permission as $key => $value) {
                $rolePermissions[] = [
                    "permission_id" => $value,
                    "role_id" => $role,
                    "action" => 1
                ];
                $rolePermissions[] = [
                    "permission_id" => $value,
                    "role_id" => $role,
                    "action" => 2
                ];
                $rolePermissions[] = [
                    "permission_id" => $value,
                    "role_id" => $role,
                    "action" => 3
                ];
            }
            RolePermission::insert($rolePermissions);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}
