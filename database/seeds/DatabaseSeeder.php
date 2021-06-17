<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

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

        // factory(App\Models\Post::class, 15)->create();
        // factory(App\Models\Comment::class, 15)->create();
        factory(App\Models\Good::class, 15)->create();
        factory(App\Models\Relationship::class, 15)->create();

        //postsテーブルとusersテーブルを3件作成する
        $posts = factory(App\Models\Post::class, 3)->create();
        //interested_insurancesテーブルを作成
        $posts->each(function ($post) {
            factory(App\Models\InterestedInsurance::class, 1)->create(['post_id' => $post->id]);
        });

        //作成した$postに対してコメントをそれぞれ３件作成する。キーを指定することで属性をオーバーライドできる
        $posts->each(function ($post) {
            factory(App\Models\Comment::class, 3)->create(['post_id' => $post->id, 'user_id' => $post->user_id]);
        });
    }
}
