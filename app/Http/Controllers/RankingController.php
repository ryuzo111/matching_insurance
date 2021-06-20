<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use App\Helpers\Ranking;

class RankingController extends Controller
{
	public $sevendays_ago;

	public function __construct(Comment $comment, User $user)
	{
		$this->comment = $comment;
		$this->user = $user;
		$this->sevendays_ago = Carbon::today()->subDay(7);
	}
	public function comment()
	{
		$comments = $this->comment->getGoodCommentsByDay($this->sevendays_ago);
		$comments = Ranking::getRanking($comments);

		return view('ranking.comment', compact('comments'));
	}

	public function user()
	{
		$users = $this->user->getGoodCommentsByDay($this->sevendays_ago);

		//それぞれのコメントのいいね数を集計し、コレクションに追加
		$goods_sum = [];
		foreach ($users as $user) {
			$comments = $user->comments;
			$sum = $comments->sum('goods_count');
			$goods_sum[] = $sum;
		}
		$users->map(function ($item, $key) use($goods_sum) {
			$item['goods_count'] = $goods_sum[$key];
			return $item;
		});
		$users = $users->whereNotIn('goods_count', 0)->sortByDesc('goods_count')->values();
		$users = Ranking::getRanking($users);

		return view('ranking.user', compact('users'));
	}
}
