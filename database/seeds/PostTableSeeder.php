<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'title' => '社会人３年目の保険について',
            'trouble_type' => 1,
            'insurance_target' => 1,
            'trouble_content' => '24歳未婚です。保険には加入しておりません。親、友人からは保険の加入を進められますが、必要なのでしょうか？',
        ];

        DB::table('posts')->insert($param);
    }
}
