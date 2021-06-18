<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class RankingController extends Controller
{

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
	public function index()
	{
		$comments = $this->comment->getWeeklyGoodComments();

		//同率順位表示のため、ランキングを作成し、コレクションに追加
		$rank = 1;
		$count = 1;
		$before_point = 0;
		$comments_array = $comments->toArray();
		$array = [];
		foreach ($comments_array as $comment) {
			if ($before_point != $comment['goods_count']) {
				$rank = $count;
			}
			$array[] = $rank;
			$before_point = $comment['goods_count'];
			$count++;
		}

		$comments->map(function ($item, $key) use($array) {
			$item['rank'] = $array[$key];
			return $item;
		});
		return view('ranking.index', compact('comments'));
	}
}
