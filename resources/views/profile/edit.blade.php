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
<div class="top-button">
<a href="{{ route('profile', ['id' => $user->id]) }}"><button class="btn btn-default"><i class="fas fa-backward"> プロフィールへ戻る</i></button></a>
</div>
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">プロフィール編集</h1>
</div>

<div class="container-box">
<p class="tag" style="font-weight: 700;">現在のプロフィール画像</p>
@if ($user->image_pass)
	<div class="tag">
			<img src="{{ asset('storage/image/' . $user->image_pass)}}" class="user-image" alt="">
		<button onclick="location. href='{{route('profile.image_delete', ['id' => $user->id])}}'">画像削除</button>
	</div>
@else
	<img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="">
@endif
<div>
	{{ Form::open(['url' => route('profile.edit', [$user->id]), 'files' => true]) }}
	{{ form::token() }}
	<div class="form-group row has-feedback {{ $errors->has('image') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('inputImage', 'プロフィール画像') }}
	</div>
	<div class="col-md-10">
		{{ Form::file('image'), ['class' => 'form-control', 'id' => 'inputImage'] }}
		@if ($errors->has('image'))
			<span class="help-block">
				<strong>{{ $errors->first('image') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('inputName', '名前') }}
	</div>
	<div class="col-md-10">
		{{ Form::text('name', old('name', $user->name), ['class' => 'form-control', 'id' => 'inputName']) }}
		@if ($errors->has('name'))
			<span class="help-block">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('inputEmail', 'メールアドレス') }}
	</div>
	<div class="col-md-10">
		{{ Form::email('email', old('email', $user->email), ['class' => 'form-control', 'id' => 'inputEmail']) }}
		@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('age') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('selectAge', '年齢') }}
	</div>
	<div class="col-md-10">
		{{ Form::select('age', config('age'), old('age', $user->age), ['class' => 'form-control', 'id' => 'selectAge']) }}
		@if ($errors->has('age'))
			<span class="help-block">
				<strong>{{ $errors->first('age') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('sex') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('selectSex', '性別') }}
	</div>
	<div class="col-md-10">
		{{ Form::select('sex', config('sex'), old('sex', $user->sex), ['class' => 'form-control', 'id' => 'selectSex']) }}
		@if ($errors->has('sex'))
			<span class="help-block">
				<strong>{{ $errors->first('sex') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('insurance_company') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('inputInsuranceCompany', '勤務先保険会社（お勤めの方のみ任意）') }}
	</div>
	<div class="col-md-10">
		{{ Form::text('insurance_company', old('insurance_company', $user->insurance_company), ['class' => 'form-control', 'id' => 'inputInsuranceCompany']) }}
		@if ($errors->has('insurance_company'))
			<span class="help-block">
				<strong>{{ $errors->first('insurance_company') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('spouse') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('selectSpouse', '配偶者') }}
	</div>
	<div class="col-md-10">
		{{ Form::select('spouse', ['' => '', 0 => 'なし', 1 => 'あり'], old('spouse', $user->spouse), ['class' => 'form-control', 'id' => 'seletSpouse']) }}
		@if ($errors->has('spouse'))
			<span class="help-block">
				<strong>{{ $errors->first('spouse') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('children') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('selectChildren', '子ども') }}
	</div>
	<div class="col-md-10">
		{{ Form::select('children', config('children'), old('children', $user->children), ['class' => 'form-control', 'id' => 'selectChildren']) }}
		@if ($errors->has('children'))
			<span class="help-block">
				<strong>{{ $errors->first('children') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('house_type') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('selectHouseType', '家の種類') }}
	</div>
	<div class="col-md-10">
		{{ Form::select('house_type', config('house_type'), old('house_type', $user->house_type), ['class' => 'form-control', 'id' => 'selectHouseType']) }}
		@if ($errors->has('house_type'))
			<span class="help-block">
				<strong>{{ $errors->first('house_type') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('pref') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('selectPref', '都道府県') }}
	</div>
	<div class="col-md-10">
		{{ Form::select('pref', config('pref'), old('pref', $user->pref), ['class' => 'form-control', 'id' => 'selectPref']) }}
		@if ($errors->has('pref'))
			<span class="help-block">
				<strong>{{ $errors->first('pref') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row has-feedback {{ $errors->has('free_comment') ? 'has-error' : '' }}">
	<div class="col-md-2 mb-3">
		{{ Form::label('textareaFreeComment', 'フリーコメント') }}
	</div>
	<div class="col-md-10">
		{{ Form::textarea('free_comment', old('free_comment', $user->free_comment), ['class' => 'form-control', 'id' => 'textareaFreeComment', 'style' => 'padding-right:12px;']) }}
		@if ($errors->has('free_comment'))
			<span class="help-block">
				<strong>{{ $errors->first('free_comment') }}</strong>
			</span>
		@endif
	</div>
	</div>
	<div class="form-group row">
	<div class="col-sm-12">
		{{ Form::submit('変更', ['class' => 'btn btn-warning']) }}
	</div>
	</div>
{{ Form::close() }}
</div>
</div>
</div>
</div>
@endsection
