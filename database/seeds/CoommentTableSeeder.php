<?php

use Illuminate\Database\Seeder;

class CoommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'post_id' => 1,
            'user_id' => 1,
            'comment' => '結婚する予定がないなら、将来のために、最低限の終身タイプの医療保障5000円で大丈夫。生命保障は結婚してから考えよう',
        ];

        DB::table('interested_insurances')->insert($param);
    }
}
