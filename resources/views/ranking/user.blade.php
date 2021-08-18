@extends('layouts.app')
@section('content')
<h2>週間いいね獲得ユーザーランキング</h2>
<p>コメントごとのランキングは<a href="{{ route('ranking.comment')}}">こちら</a></p>
<h3>集計期間：{{ \Carbon\Carbon::today()->subDay(7)->format("Y年n月j日")}} ～
{{ \Carbon\Carbon::today()->format("Y年n月j日")}}</h3>

<div>
	@if ($users->isEmpty())
		今週はまだいいねが無いようです
	@else
		@foreach ($users as $user)
		<h4>{{ $user->rank }}位</h4>
		@if ($user->image_pass)
			<img src="{{ $user->image_pass }}" alt="" width="100">
			<img src="{{ asset('storage/image/' . $user->image_pass)}}" alt="" width="100">
		@else
			<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="100">
		@endif
			<p><a href="{{ route('profile', ['id' => $user->id]) }}">{{ $user->name }}さん</a>
			<p>{{ $user->comments_count }}つコメントし、{{ $user->goods_count }}つのいいねをいただけました！</p>
		@endforeach
	@endif
</div>
@endsection
