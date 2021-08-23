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
<h1 class="box-title">プロフィール</h1>
</div>

@if ($user->id != Auth::id())
	{{-- <a href="{{ route('chat.index', ['receive_user' => $user, 'send_user' => Auth::user()]) }}">DMを送る</a> --}}
	<form class="horizontal"action="{{ route('chat.index') }}" method="GET">
		<div class="form-group">
        {{ csrf_field() }}
        <input type="hidden" name="receive_user_id" value="{{$user->id}}">
        <input type="hidden" name="send_user_id" value="{{ Auth::id() }}">
		</div>
		<div class="form-group">
		<button class="btn btn-warning" type="submit">DMを送る</button>
		</div>
    </form>
@endif

<div>
<div class="center-block">
	<div style="text-align: center;">
	@if ($user->image_pass)
		<img class="user-image" src="{{ asset('storage/image/' . $user->image_pass)}}" alt="">
	@else
		<img class="user-image" src="{{ asset('storage/default/default.jpeg') }}" alt="">
	@endif
	</div>
	@auth
		@if ($is_following)
			<p class="text-center"><a href="{{ route('unfollow', ['followed_id' => $user->id])}}" onclick="return confirm('フォロー解除しますか？');">フォロー中</a></p>
		@elseif ($user->id != Auth::id())
			<p class="text-center"><a href="{{ route('follow', ['followed_id' => $user->id]) }}">フォローする</a></p>
		@endif
	@endauth
	@if ($is_followed)
		<p class="text-center">フォローされています</p>
	@endif
		<p class="text-center"><a href="{{ route('following', ['following_user_id' => $user->id])}}">{{ count($user->following_user) }}フォロー中</a>
			<a href="{{ route('followers', ['followed_user_id' => $user->id])}}">{{ count($user->followed_user ) }}フォロワー</a>
		</p>
</div>
	<div class="container-box">
		<table class="table table-striped">
			<tr>
				<th class="col-lg-3 col-xs-5">名前</th>
				<td class="col-lg-9 col-xs-7">{{ $user->name }}</td>
			</tr>
			<tr>
				<th>年齢</th>
				@if ($user->age)
				<td>{{ Config::get('age')[$user->age] }}</td>
				@else
				<td>登録なし</td>
				@endif
			</tr>
			<tr>
				<th>性別</th>
				@if ($user->sex)
				<td>{{ Config::get('sex')[$user->sex] }}</td>
				@else
				<td>登録なし</td>
				@endif
			</tr>
			<tr>
				<th>勤務先保険会社</th>
				@if ($user->insurance_company)
				<td>{{ $user->insurance_company }}</td>
				@else
				<td>登録なし</td>
				@endif
			</tr>
			<tr>
				<th>配偶者</th>
				@isset ($user->spouse)
				<td>{{ $user->spouse }}人</td>
				@else
				<td>登録なし</td>
				@endisset
			</tr>
			<tr>
				<th>子ども</th>
				@isset ($user->children)
				<td>{{ Config::get('children')[$user->children] }}</td>
				@else
				<td>登録なし</td>
				@endisset
			</tr>
			<tr>
				<th>家の種類</th>
				@if ($user->house_type)
				<td>{{ Config::get('house_type')[$user->house_type] }}</td>
				@else
				<td>登録なし</td>
				@endif
			</tr>
			<tr>
				<th>都道府県</th>
				@if ($user->pref)
				<td>{{ Config::get('pref')[$user->pref] }}</td>
				@else
				<td>登録なし</td>
				@endif
			</tr>
			<tr>
				<th>フリーコメント</th>
				@if ($user->free_comment)
				<td>{{ $user->free_comment }}</td>
				@else
				<td>登録なし</td>
				@endif
			</tr>
		</table>
@if (Auth::id() == $user->id)
	<a href="{{ route('profile.edit', ['id' => $user->id]) }}"><button class="tag btn btn-warning">編集</button></a>
@endif
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">家族加入保険</h1>
</div>
<div class="tag">
@if (Auth::id() == $user->id)
	<a href="{{ route('family_ins.create') }}"><button class="btn btn-warning">家族加入保険追加</button></a>
@endif
</div>
<div>
	@if ($family_insurances->isEmpty())
		<p class="tag">登録なし</p>
	@endif
	@foreach ($family_insurances as $family_insurance)
		<p class="tag">{{ $loop->iteration }}</p>
		<p class="tag">【続柄】{{ Config::get('relationship')[$family_insurance->relationship] }}</p>
		<p class="tag">【年齢】{{ Config::get('age')[$family_insurance->age] }}</p>
		<p class="tag">【加入保険】{{ $family_insurance->have_insurance_company }}</p>
		<p class="tag">【加入保険説明】{{ $family_insurance->have_insurance_content }}</p>
		@if (Auth::id() == $user->id)
			<a href="{{ route('family_ins.edit', ['id' => $family_insurance->id]) }}"><button class="tag btn btn-warning btn-sm">編集</button></a>
			<a href="{{ route('family_ins.delete', ['id' => $family_insurance->id]) }}"><button class="tag btn btn-warning btn-sm">削除</button></a>
		@endif
		<br>
	@endforeach
</div>
</div>
</div>

<div class="col-md-4">
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">投稿した悩み</h1>
</div>
<div>
	@empty ($user->posts[0])
		<p class="tag">まだ投稿していません</p>
	@endempty
	@isset ($user->posts[0])
	@foreach ($user->posts as $post)
		<p class="tag" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="{{ route('post.detail', ['post_id' => $post->id]) }}">{{ $post->title }}</a></p>
	@endforeach
	<p class="tag"><a class="btn btn-warning" href="{{ route('user.post', ['user_id' => $user->id]) }}">もっと見る</a></p>
	@endisset
</div>
</div>
</div>
<div class="col-md-4">
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">コメント</h1>
</div>
<div>
	@empty ($user->comments[0])
		<p class="tag">まだコメントしていません</p>
	@endempty
	@isset ($user->comments[0])
	@foreach ($user->comments as $comment)
		<p class="tag" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><a href="{{ route('post.detail', ['post_id' => $comment->post_id]) }}">{{ $comment->comment }}</a></p>
	@endforeach
	<p class="tag"><a class="btn btn-warning" href="{{ route('user.comment', ['user_id' => $user->id]) }}">もっと見る</a></p>
	@endisset
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
