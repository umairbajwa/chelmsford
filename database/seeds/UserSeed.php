<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'james@codetwofour.com',
            'password' => Hash::make('A76!MB#*45j&ksd'),
            'account_id' => 1,
            'is_admin' => 1,
            'active' => 1,
        ]);
    }
}
