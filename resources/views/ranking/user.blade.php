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
<h1 class="box-title">週間いいね獲得ユーザーランキング</h1>
</div>
<div class="container">
<p class="tag">コメントごとのランキングは<a href="{{ route('ranking.comment')}}">こちら</a></p>
<p class="tag">集計期間：{{ \Carbon\Carbon::today()->subDay(7)->format("Y年n月j日")}} ～
{{ \Carbon\Carbon::today()->format("Y年n月j日")}}</p>

<div>
	@if ($users->isEmpty())
		今週はまだいいねが無いようです
	@else
		@foreach ($users as $user)
			<h4 style="text-align: center;">{{ $user->rank }}位</h4>
			<div style="text-align: center;">
			@if ($user->image_pass)
				<img class="user-image" src="{{ asset('storage/image/' . $user->image_pass)}}" alt="">
			@else
				<img class="user-image" src="{{ asset('storage/default/default.jpeg') }}" alt="">
			@endif
			</div>
			<p style="text-align: center;"><a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }}さん</a></p>
			<p style="text-align: center;">{{ $user->comments_count }}つコメントし、{{ $user->goods_count }}つのいいねをいただけました！</p>
		@endforeach
	@endif
</div>
</div>
</div>
</div>
</div>

@endsection
