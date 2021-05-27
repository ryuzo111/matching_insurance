<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'yajima',
            'email' => 'yajima44ryu@yahoo.co.jp',
            'password' => Hash::make('yajima'),
        ];

        DB::table('users')->insert($param);
    }
}
