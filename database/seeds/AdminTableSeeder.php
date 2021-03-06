<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            'name' => 'yajima',
            'email' => 'yajima44ryu@yahoo.co.jp',
            'password' => Hash::make('yajima'),
        ];

        DB::table('admins')->insert($param);

        $param =[
            'name' => 'terukina',
            'email' => 'o104085t@gmail.com',
            'password' => Hash::make('terukina'),
        ];

        DB::table('admins')->insert($param);
    }
}
