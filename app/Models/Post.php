<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\InterestedInsurance;

class Post extends Model
{
    protected $guarded = ['id'];
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function interested_insurance()
    {
        return $this->hasOne('App\Models\InterestedInsurance');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }



    public function getSearchResults($param)
    {
        $query = Post::query();
        if (!empty($param['word'])) {
            $query->where('title', 'like', '%' . $param['word'] . '%');
        }

        if (!empty($param['trouble_type'])) {
            $query->where('trouble_type', $param['trouble_type']);
        }

        if (!empty($param['insurance_target'])) {
            $query->where('insurance_target', $param['insurance_target']);
        }

        if (!empty($param['interested_insurances'])) {
            $all_interested_posts = collect();
            // 選択されたinterested_postの投稿を1つずつ取得する
            foreach ($param['interested_insurances'] as $interested_post) {
                $post = InterestedInsurance::where($interested_post, 1)->get();
                $all_interested_posts = $all_interested_posts->merge($post);
            }

            $all_interested_posts = $all_interested_posts->pluck('post_id')->unique();
            if (!empty($all_interested_posts)) {
                $query->whereIn('id', $all_interested_posts->toArray());
            }
        }
        if (!empty($param['start_time'])) {
            $query->whereDate('created_at', '>=', $param['start_time']);
        }
        if (!empty($param['end_time'])) {
            $query->whereDate('created_at', '>=', $param['end_time']);
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        return $posts;
    }




    public function getPaginatedPosts()
    {
        return $this->orderBy('created_at', 'desc')->paginate(10);
    }

    // public function getPaginatedSearchResults($word)
    // {
    //     $posts = $this->where('title', 'like', '%' . $word . '%')->paginate(10);
    //     return $posts;
    // }

    public function getDetailPostById($post_id)
    {
        $post = Post::findOrFail($post_id);
        return $post;
    }

    public function EditPost($request, $post)
    {
        $target_insurance = $post->interested_insurance;
        DB::transaction(function () use ($request, $post, $target_insurance) {
            $post->title = $request->title;
            $post->trouble_type = $request->trouble_type;
            $post->insurance_target = $request->insurance_target;
            $post->trouble_content = $request->trouble_content;
            $post->save();

            $insurances = ['life' => 0, 'medical' => 0, 'cancer' => 0, 'pension' => 0, 'saving' => 0, 'all_life' => 0, 'home' => 0, 'other' => 0,];
            //foreachでinterested_insurancesのvalueなカラムにvalueを入れる
            foreach ($request->interested_insurances as $interested_insurance) {
                $insurances[$interested_insurance] = 1;
            }

            $target_insurance->life = $insurances['life'];
            $target_insurance->medical = $insurances['medical'];
            $target_insurance->cancer = $insurances['cancer'];
            $target_insurance->pension = $insurances['pension'];
            $target_insurance->saving = $insurances['saving'];
            $target_insurance->all_life = $insurances['all_life'];
            $target_insurance->home = $insurances['home'];
            $target_insurance->other = $insurances['other'];
            $target_insurance->save();
        });
        return $post;
    }

    public function createPost($request)
    {
        DB::transaction(function () use ($request) {
            $post = $this->create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'trouble_type' => $request->trouble_type,
                'insurance_target' => $request->insurance_target,
                'trouble_content' => $request->trouble_content,
            ]);

            $insurances = ['life' => 0, 'medical' => 0, 'cancer' => 0, 'pension' => 0, 'saving' => 0, 'all_life' => 0, 'home' => 0, 'other' => 0,];

            //foreachでinterested_insurancesのvalueなカラムにvalueを入れる
            foreach ($request->interested_insurances as $interested_insurance) {
                $insurances[$interested_insurance] = 1;
            }
            InterestedInsurance::create([
                'post_id' => $post->id,
                'life' => $insurances['life'],
                'medical' => $insurances['medical'],
                'canner' => $insurances['cancer'],
                'pension' => $insurances['pension'],
                'saving' => $insurances['saving'],
                'all_life' => $insurances['all_life'],
                'home' => $insurances['home'],
                'other' => $insurances['other'],
            ]);
        });
        return true;
    }

    public function deletePostById($id)
    {
        $post = $this->getDetailPostById(($id));
        $interested_insurance = $post->interested_insurance;

        DB::transaction(function () use ($id, $post, $interested_insurance) {
            $post->delete();
            $interested_insurance->delete();
        });
        return true;
    }
}
