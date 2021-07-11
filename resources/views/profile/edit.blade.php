@extends('layouts.app')
@section('title', 'Profile')
@section('content')
@if ($errors->any())
	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach
@endif
<h2>プロフィール編集</h2>
<p>パスワード変更は<a href="{{ route('profile.edit_pass', ['id' => $user->id]) }}">こちら</a>から</p>

<p>【現在のプロフィール画像】</p>
@if ($user->image_pass)
	<img src="{{ $user->image_pass }}" alt="" width="100">
	<img src="{{ asset('storage/image/' . $user->image_pass)}}" alt="" width="100">
	<button onclick="location. href='{{route('profile.image_delete', ['id' => $user->id])}}'">画像削除</button>
@else
	<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="100">
@endif
<div>
	{{Form::open(['url' => route('profile.edit', [$user->id]), 'files' => true])}}
		<p>プロフィール画像をアップ：{{Form::file('image')}}</p>
		<p>【名前】{{Form::text('name', old('name', $user->name))}}</p>
		<p>【メールアドレス】{{Form::email('email', old('email', $user->email))}}</p>
		<p>【年齢】{{Form::number('age', old('age', $user->age))}}</p>
		<p>【性別】{{Form::select('sex', config('sex'), old('sex', $user->sex))}}</p>
		<p>【勤めている保険会社(※保険会社にお勤めの方のみ任意でご記入ください)】{{Form::text('insurance_company', old('insurance_company', $user->insurance_company))}}</p>
		<p>【配偶者】{{Form::select('spouse', ['' => '', 0 => 0, 1 => 1], old('spouse', $user->spouse))}}人</p>
		<p>【子供】{{Form::number('children', old('children', $user->children))}}人</p>
		<p>【家の種類】{{Form::select('house_type', config('house_type'), old('house_type', $user->house_type))}}</p>
		<p>【都道府県】{{Form::select('pref', config('pref'), old('pref', $user->pref))}}</p>
		<p>【フリーコメント】</p>{{Form::textarea('free_comment', old('free_comment', $user->free_comment))}}<br>
	{{Form::submit('変更')}}
	{{Form::close()}}
</div>
<a href="{{ route('profile', ['id' => $user->id]) }}"> プロフィールへ戻る</a>
@endsection
