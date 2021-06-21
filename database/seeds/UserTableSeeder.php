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
            'age' => 24,
            'sex' => 1,
            'insurance_company' => '第一生命',
            'spouse' => false,
            'children' => 0,
            'house_type' => 6,
            'pref' => 1,
            'free_comment' => '半年間、現場で個人営業、現在は、代理店営業',
        ];

        DB::table('users')->insert($param);

        $param = [
            'name' => 'aaa',
            'email' => 'aaa@aaa.aaa',
            'password' => Hash::make('aaaaaa'),
        ];

        DB::table('users')->insert($param);

        $param = [
            'name' => 'bbb',
            'email' => 'bbb@bbb.bbb',
            'password' => Hash::make('bbbbbb'),
        ];

        DB::table('users')->insert($param);
    }
}
