<?php

use Illuminate\Database\Seeder;

class Family_insuranceTableSeeder extends Seeder
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
            'age' => 24,
            'relationship' => 1,
            'have_insurance_company' => '第一生命',
            'have_insurance_content' => '生命保障300万、入院したら日額10000円、がん保障あり',
        ];

        DB::table('family_insurances')->insert($param);
    }
}
