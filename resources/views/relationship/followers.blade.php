@extends('layouts.app')
@section('content')
<h2>フォロワー</h2>

<div>
	@if ($followers->isEmpty())
		フォローされていません
	@else
		@foreach ($followers as $follower)
		<p><a href="{{ route('profile', ['id' => $follower->follower_id]) }}">
				@if ($follower->following_user->image_pass)
					<img src="{{ $follower->following_user->image_pass }}" alt="" width="50">
					<img src="{{ asset('storage/image/' . $follower->following_user->image_pass)}}" alt="" width="50">
				@else
					<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="50">
				@endif
				{{ $follower->following_user->name }}
			</a>
			@if ($follower->canUnfollow($follower->follower_id))
				<a href="{{ route('unfollow', ['followed_id' => $follower->follower_id])}}" onclick="return confirm('フォロー解除しますか？');">フォロー中</a>
			@elseif ($follower->follower_id != Auth::id())
				<a href="{{ route('follow', ['followed_id' => $follower->follower_id])}}">フォローする</a>
			@endif
			@if ($follower->isFollowed($follower->follower_id))
				フォローされています
			@endif
		</p>
		@endforeach
	@endif
	<p></p><a href="{{ route('profile', ['id' => $followed_user_id]) }}"> プロフィールへ戻る</a></p>
</div>
@endsection
