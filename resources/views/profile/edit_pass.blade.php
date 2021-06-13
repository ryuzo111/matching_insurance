@extends('layouts.app')
@section('title', 'Profile')
@section('content')
@if (session('message'))
	{{ session('message') }}
@endif
@if ($errors->any())
	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach
@endif
<h2>パスワード編集</h2>

<div>
	{{Form::open(['url' => route('profile.edit_pass', [$user->id]), 'files' => true])}}
		<p>【新パスワード】{{Form::password('password')}}</p>
		<p>【新パスワード（確認用)】{{Form::password('password_confirmation')}}</p>
		<p>【現在のパスワード】{{Form::password('current_password')}}</p>
	{{Form::submit('変更')}}
	{{Form::close()}}
</div>
	<a href="{{ route('profile.edit', ['id' => $user->id]) }}">プロフィール情報編集画面へ戻る</a><br>
	<a href="{{ route('profile', ['id' => $user->id]) }}"> プロフィールへ戻る</a>
@endsection
