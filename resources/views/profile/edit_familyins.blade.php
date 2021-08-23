@extends('layout')

@section('content')
<div class="container">
	<div class="top-button">
		<a href="{{ route('profile', ['id' => Auth::id()]) }}"><button class="btn btn-default"><i class="fas fa-backward"> プロフィールへ戻る</i></button></a>
	</div>
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h1 class="box-title">家族加入保険追加</h1>
		</div>

		<div>
			{{ Form::open() }}
			<div class="form-group row has-feedback {{ $errors->has('relationship') ? 'has-error' : '' }}">
				<div class="col-md-2 mb-3">
					{{ Form::label('relationship', '続柄(必須)') }}
				</div>
				<div class="col-md-10">
					{{ Form::select('relationship', config('relationship'), old('relationship', $family_ins->relationship), ['class' => 'form-control', 'id' => 'relationship']) }}
				@if ($errors->has('relationship'))
					<span class="help-block">
						<strong>{{ $errors->first('relationship') }}</strong>
					</span>
				@endif
				</div>
			</div>
			<div class="form-group row has-feedback {{ $errors->has('age') ? 'has-error' : '' }}">
				<div class="col-md-2 mb-3">
					{{ Form::label('age', '年齢') }}
				</div>
				<div class="col-md-10">
					{{ Form::select('age', config('age'), old('age', $family_ins->age), ['class' => 'form-control', 'id' => 'age']) }}
				@if ($errors->has('age'))
					<span class="help-block">
						<strong>{{ $errors->first('age') }}</strong>
					</span>
				@endif
				</div>
			</div>
			<div class="form-group row has-feedback {{ $errors->has('have_insurance_company') ? 'has-error' : '' }}">
				<div class="col-md-2 mb-3">
					{{ Form::label('have_insurance_company', '加入保険') }}
				</div>
				<div class="col-md-10">
					{{ Form::textarea('have_insurance_company', old('have_insurance_company', $family_ins->have_insurance_company), ['placeholder' => '(例)〇〇保険会社の〇〇保険', 'style' => 'height:60px', 'class' => 'form-control', 'id' => 'have_insurance_company']) }}
				@if ($errors->has('have_insurance_company'))
					<span class="help-block">
						<strong>{{ $errors->first('have_insurance_company') }}</strong>
					</span>
				@endif
				</div>
			</div>
			<div class="form-group row has-feedback {{ $errors->has('have_insurance_content') ? 'has-error' : '' }}">
				<div class="col-md-2 mb-3">
					{{ Form::label('have_insurance_content', '加入保険説明(必須)') }}
				</div>
				<div class="col-md-10">
					{{ Form::textarea('have_insurance_content', old('have_insurance_content', $family_ins->have_insurance_content), ['class' => 'form-control', 'id' => 'have_insurance_content']) }}
				@if ($errors->has('have_insurance_content'))
					<span class="help-block">
						<strong>{{ $errors->first('have_insurance_content') }}</strong>
					</span>
				@endif
				</div>
			</div>
			{{ Form::hidden('id', $family_ins->id) }}
			<div class="form-group row">
				<div class="col-sm-12">
					{{ Form::submit('変更', ['class' => 'btn btn-warning']) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection
