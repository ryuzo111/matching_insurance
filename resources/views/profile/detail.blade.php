@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div>プロフィール</div>

<div>
	@if ($user->image_pass)
		<img src="{{ $user->image_pass }}" alt="" width="100">
		<img src="{{ asset('storage/image/' . $user->image_pass)}}" alt="" width="100">
	@else
		<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="100">
	@endif
	@auth
		@if ($is_following)
			<a href="{{ route('unfollow', ['followed_id' => $user->id])}}" onclick="return confirm('フォロー解除しますか？');">フォロー中</a>
		@elseif ($user->id != Auth::id())
			<a href="{{ route('follow', ['followed_id' => $user->id]) }}">フォローする</a>
		@endif
	@endauth
	@if ($is_followed)
		フォローされています
	@endif
	<p><a href="{{ route('following', ['following_user_id' => $user->id])}}">{{ count($user->following_user) }}フォロー中</a>
		<a href="{{ route('followers', ['followed_user_id' => $user->id])}}">{{ count($user->followed_user ) }}フォロワー</a>
	</p>
	<p>【名前】{{ $user->name }}</p>
	<p>【年齢】
	@if ($user->age)
		{{ $user->age }}</p>
	@else
		登録なし</p>
	@endif
	<p>【性別】
	@if ($user->sex)
		{{ Config::get('sex')[$user->sex] }}</p>
	@else
		登録なし</p>
	@endif
	<p>【勤務している保険会社】
	@if ($user->insurance_company)
		{{ $user->insurance_company }}</p>
	@else
		登録なし</p>
	@endif
	<p>【配偶者】
	@isset ($user->spouse)
		{{ $user->spouse }}人</p>
	@else
		登録なし</p>
	@endisset
	<p>【子供】
	@isset ($user->children)
		{{ $user->children }}人</p>
	@else
		登録なし</p>
	@endisset
	<p>【家の種類】
	@if ($user->house_type)
		{{ Config::get('house_type')[$user->house_type] }}</p>
	@else
		登録なし</p>
	@endif
	<p>【都道府県】
	@if ($user->pref)
		{{ Config::get('pref')[$user->pref] }}</p>
	@else
		登録なし</p>
	@endif
	<p>【フリーコメント】{{ $user->free_comment }}</p>
</div>
@if (Auth::id() == $user->id)
	<a href="{{ route('profile.edit', ['id' => $user->id]) }}">プロフィール情報編集</a>
@endif
<hr>
<div>家族加入保険</div>
@if (Auth::check())
	@if (Auth::id() == $user->id)
		<a href="{{ route('family_ins.create') }}">家族加入保険追加</a>
	@endif
	<div>
		@if ($family_insurances->isEmpty())
			<p>登録無し</p>
		@endif
		@foreach ($family_insurances as $family_insurance)
			<p>{{ $loop->iteration }}</p>
			<p>【続柄】{{ Config::get('relationship')[$family_insurance->relationship] }}</p>
			<p>【年齢】{{ $family_insurance->age }}</p>
			<p>【加入保険】{{ $family_insurance->have_insurance_company }}</p>
			<p>【加入保険説明】{{ $family_insurance->have_insurance_content }}</p>
			@if (Auth::id() == $user->id)
				<a href="{{ route('family_ins.edit', ['id' => $family_insurance->id]) }}">編集</a>
				<a href="{{ route('family_ins.delete', ['id' => $family_insurance->id]) }}">削除</a>
			@endif
			<br>
		@endforeach
	</div>
@else
	<a href="{{ route('login') }}">ログインしたユーザーのみ家族加入保険を閲覧できます</a>
@endif
<hr>
<div>投稿した悩み</div>
<div>
	@empty ($user->posts[0])
		<p>まだ投稿していません</p>
	@endempty
	@foreach ($user->posts as $post)
		<a href="{{ route('post.detail', ['post_id' => $post->id]) }}">{{ $post->title }}</a>
	@endforeach
</div>
@endsection
