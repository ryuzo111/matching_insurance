<?php

use Illuminate\Database\Seeder;

class Interested_insuranceTableSeeder extends Seeder
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
            'medical' => 1,
            'pension' => 1, 
        ];

        DB::table('interested_insurances')->insert($param);
    }
}
