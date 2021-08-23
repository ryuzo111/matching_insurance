@extends('layout')
@section('content')
<div class="container">
<div>
<a href="{{ route('profile', ['id' => $followed_user_id]) }}"><button class="btn btn-default">プロフィールへ戻る</button></a>
</div>
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">フォロワー</h1>
</div>

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
</div>
</div>
</div>
@endsection
