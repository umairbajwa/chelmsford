<?php

use Illuminate\Database\Seeder;

class AccountSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account')->insert([
            'company' => Str::random(10),
            'logo' => 'cgs.jpg',
            'url' => url('/')
        ]);
    }
}
