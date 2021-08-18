@extends('layout')

@if ($errors->any())
	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach
@endif

@section('content')
<div class="container">
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">パスワード編集</h1>
</div>

<div>
	{{ Form::open(['url' => route('profile.edit_pass', [$user->id]), 'files' => true]) }}
    <div class="form-group row">
	<div class="col-md-2 mb-3">
		{{ Form::label('inputPassword', '新パスワード') }}
	</div>
	<div class="col-md-10">
		{{ Form::password('inputPassword', ['class' => 'form-control', 'id' => 'inputPassword']) }}
	</div>
	</div>
    <div class="form-group row">
	<div class="col-md-2 mb-3">
		{{ Form::label('inputPassword', '新パスワード(確認用)') }}
	</div>
	<div class="col-md-10">
		{{ Form::password('inputPasswordConfirmation', ['class' => 'form-control', 'id' => 'inputPasswordConfirmation']) }}
	</div>
	</div>
    <div class="form-group row">
	<div class="col-md-2 mb-3">
		{{ Form::label('inputCurrentPassword', '現在のパスワード') }}
	</div>
	<div class="col-md-10">
		{{ Form::password('inputCurrentPassword', ['class' => 'form-control', 'id' => 'inputCurrentPassword']) }}
	</div>
	</div>
	<div class="form-group row">
	<div class="col-sm-12">
		{{ Form::submit('変更', ['class' => 'btn btn-warning']) }}
	</div>
	</div>
	{{Form::close()}}
</div>
</div>
</div>
@endsection
