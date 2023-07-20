<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_settings')->truncate();
        DB::table('admin_settings')->insert([
            array('id' => '1', 'kw' => '0', 'created_at' => '2021-12-17 10:11:54', 'updated_at' => '2021-12-17 19:48:37')
        ]);
    }
}
