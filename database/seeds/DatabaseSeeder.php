<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(Family_insuranceTableSeeder::class);
        $this->call(Interested_insuranceTableSeeder::class);

        factory(App\Models\Post::class, 15)->create();
        factory(App\Models\Comment::class, 15)->create();
        factory(App\Models\Good::class, 15)->create();
    }
}
