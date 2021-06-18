@extends('layouts.app')
@section('title', 'Profile')
@section('content')
@if ($errors->any())
	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach
@endif
<h2>家族加入保険追加</h2>

<div>
	{{Form::open()}}
		<p>【続柄(必須)】{{Form::select('relationship', config('relationship'), old('relationship', $family_ins->relationship))}}</p>
		<p>【年齢】{{Form::number('age', old('age', $family_ins->age))}}</p>
		<p>【加入保険】</p>{{Form::textarea('have_insurance_company', old('have_insurance_company', $family_ins->have_insurance_company), ['placeholder' => '(例)〇〇保険会社の〇〇保険', 'style' => 'height:60px'])}}<br>
		<p>【加入保険説明(必須)】</p>{{Form::textarea('have_insurance_content', old('have_insurance_content', $family_ins->have_insurance_content))}}<br>
	{{Form::hidden('id', $family_ins->id)}}
	{{Form::submit('変更')}}
	{{Form::close()}}
</div>
<a href="{{ route('profile', ['id' => $family_ins->user_id]) }}"> プロフィールへ戻る</a>
@endsection
