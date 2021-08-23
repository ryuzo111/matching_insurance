@extends('layout')
<style>
	.user-image {
		width: 100px;
		height: 100px;
		border-radius: 50%;
	}
</style>

@section('content')
<div class="container">
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">週間いいね獲得コメントランキング</h1>
</div>
<div class="container">
<p class="tag">ユーザーごとのランキングは<a href="{{ route('ranking.user')}}">こちら</a></p>
<p class="tag">集計期間：{{ \Carbon\Carbon::today()->subDay(7)->format("Y年n月j日")}} ～
{{ \Carbon\Carbon::today()->format("Y年n月j日")}}</p>

<div>
	@if ($comments->isEmpty())
		今週はまだいいねが無いようです
	@else
		@foreach ($comments as $comment)
			<h4 style="text-align: center;">{{ $comment->rank }}位</h4>
			<div style="text-align: center;">
			@if ($comment->user->image_pass)
				<img class="user-image" src="{{ asset('storage/image/' . $comment->user->image_pass)}}" alt="">
			@else
				<img class="user-image" src="{{ asset('storage/default/default.jpeg') }}" alt="">
			@endif
			</div>
			<p style="text-align: center;"><a href="{{ route('profile', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}さん</a>が投稿した
			<a href="{{ route('post.detail', ['post_id' => $comment->post->id]) }}">こちら</a>のお悩みに対するコメント</p>
			<p style="text-align: center;">「{{ $comment->comment}}」</p>
			<p style="text-align: center;">でした！1週間で取得したいいね数は{{ $comment->goods_count }}です！</p>
		@endforeach
	@endif
</div>
</div>
</div>
</div>
@endsection
