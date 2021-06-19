@extends('layouts.app')
@section('title', 'Profile')
@section('content')
@if ($errors->any())
	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach
@endif
<h2>家族加入保険追加</h2>
<p>※配偶者・子供は、プロフィールの登録数以上は追加できません</p>

<div>
	{{Form::open()}}
		<p>【続柄(必須)】{{Form::select('relationship', config('relationship'), old('relationship'))}}</p>
		<p>【年齢】{{Form::number('age', old('age'))}}</p>
		<p>【加入保険】</p>{{Form::textarea('have_insurance_company', old('have_insurance_company'), ['placeholder' => '(例)〇〇保険会社の〇〇保険', 'style' => 'height:60px'])}}<br>
		<p>【加入保険説明(必須)】</p>{{Form::textarea('have_insurance_content', old('have_insurance_content'))}}<br>
	{{Form::submit('追加')}}
	{{Form::close()}}
</div>
<a href="{{ route('profile', ['id' => Auth::id()]) }}"> プロフィールへ戻る</a>
@endsection
