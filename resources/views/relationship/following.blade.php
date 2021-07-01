@extends('layouts.app')
@section('content')
<h2>フォロー中</h2>

<div>
	@if ($followees->isEmpty())
		フォローしていません
	@else
		@foreach ($followees as $followee)
		<p><a href="{{ route('profile', ['id' => $followee->followed_id]) }}">
				@if ($followee->followed_user->image_pass)
					<img src="{{ $followee->followed_user->image_pass }}" alt="" width="50">
					<img src="{{ asset('storage/image/' . $followee->followed_user->image_pass)}}" alt="" width="50">
				@else
					<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="50">
				@endif
				{{ $followee->followed_user->name }}
			</a>
			@if ($followee->canUnfollow($followee->followed_id))
				<a href="{{ route('unfollow', ['followed_id' => $followee->followed_id])}}" onclick="return confirm('フォロー解除しますか？');">フォロー中</a>
			@elseif ($followee->followed_id != Auth::id())
				<a href="{{ route('follow', ['followed_id' => $followee->followed_id])}}">フォローする</a>
			@endif
			@if ($followee->isFollowed($followee->followed_id))
				フォローされています
			@endif
		</p>
		@endforeach
	@endif
	<p></p><a href="{{ route('profile', ['id' => $following_user_id]) }}"> プロフィールへ戻る</a></p>
</div>
@endsection
