<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        $permissions = array(
            // users
            array('module' => 'permissions', 'name' => 'Permissions', 'code' => 'permissions'),
            array('module' => 'estimates', 'name' => 'Estimates', 'code' => 'estimates'),
            array('module' => 'products', 'name' => 'Products', 'code' => 'products'),
            array('module' => 'questions', 'name' => 'Questions', 'code' => 'questions'),
            array('module' => 'postcodes', 'name' => 'Postcodes', 'code' => 'postcodes'),
            array('module' => 'users', 'name' => 'Users', 'code' => 'users'),
            array('module' => 'coverages', 'name' => 'Coverages', 'code' => 'coverages')
        );
        Permission::insert($permissions);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
