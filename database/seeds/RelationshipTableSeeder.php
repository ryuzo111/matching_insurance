<?php

use Illuminate\Database\Seeder;

class RelationshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'follower_id' => 1,
            'followed_id' => 2,
        ];

        DB::table('relationships')->insert($param);

        $param = [
            'follower_id' => 5,
            'followed_id' => 2,
        ];

        DB::table('relationships')->insert($param);

        $param = [
            'follower_id' => 6,
            'followed_id' => 2,
        ];

        DB::table('relationships')->insert($param);

        $param = [
            'follower_id' => 2,
            'followed_id' => 4,
        ];

        DB::table('relationships')->insert($param);

        $param = [
            'follower_id' => 2,
            'followed_id' => 5,
        ];

        DB::table('relationships')->insert($param);
    }
}
