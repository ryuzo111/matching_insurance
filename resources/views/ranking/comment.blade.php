@extends('layouts.app')
@section('content')
<h2>週間いいね獲得コメントランキング</h2>
<p>ユーザーごとのランキングは<a href="{{ route('ranking.user')}}">こちら</a></p>
<h3>集計期間：{{ \Carbon\Carbon::today()->subDay(7)->format("Y年n月j日")}} ～
{{ \Carbon\Carbon::today()->format("Y年n月j日")}}</h3>

<div>
	@if ($comments->isEmpty())
		今週はまだいいねが無いようです
	@else
		@foreach ($comments as $comment)
		<h4>{{ $comment->rank }}位</h4>
		@if ($comment->user->image_pass)
			<img src="{{ $comment->user->image_pass }}" alt="" width="100">
			<img src="{{ asset('storage/image/' . $comment->user->image_pass)}}" alt="" width="100">
		@else
			<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="100">
		@endif
			<p><a href="{{ route('profile', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}さん</a>が投稿した
			<a href="{{ route('post.detail', ['post_id' => $comment->post->id]) }}">こちら</a>のお悩みに対するコメント</p>
			<p>「{{ $comment->comment}}」</p>
			<p>でした！1週間で取得したいいね数は{{ $comment->goods_count }}です！</p>
		@endforeach
	@endif
</div>
@endsection