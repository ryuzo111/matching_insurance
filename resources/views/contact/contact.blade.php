@extends('layout')

@section('content')

<div class="container">
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">お問い合わせ</h1>
</div>

<div>
	<div class="form-group row">
	<div class="col-md-2 mb-3">
		@guest
		{{ Form::label('email', 'メールアドレス') }}
	</div>
	<div class="col-md-10">
		{{ Form::open(['url' => route('contact.contact'), 'method' => 'POST']) }}
				@if ($errors->has('email'))
					<p>{{$errors->first('email')}}</p>
				@endif
				{{ Form::email('email', null, ['class' => 'contact-email', 'required', 'class' => 'form-control', 'id' => 'inputEmail']) }}
			@endguest
			@if ($errors->has('content'))
				<p>{{$errors->first('content')}}</p>
			@endif
	</div>
	</div>
	<div class="form-group row">
	<div class="col-md-2 mb-3">
		{{ Form::label('content', 'お問い合わせ内容') }}
	</div>
	<div class="col-md-10">
		{{ Form::textarea('content', null, ['class' => 'contact-content', 'rows' => '4', 'cols' => '47', 'required', 'class' => 'form-control', 'id' => 'textareaFreeComent']) }}
	</div>
	</div>
	<div class="form-group row">
	<div class="col-sm-12">
		{{ Form::submit('運営に問い合わせる', ['class' => 'btn btn-warning']) }}
	</div>
	</div>

{{ Form::close() }}


{{-- <form action="{{ route('contact.contact') }}" method="POST">
	{{ csrf_field() }}
	@guest
		@if ($errors->has('email'))
			<p>{{$errors->first('email')}}</p>
		@endif
		<p>メールアドレス</p>
		<input type="email" name="email" required>
	@endguest

	@if ($errors->has('content'))
		<p>{{$errors->first('content')}}</p>
	@endif
	<p>お問い合わせ内容</p>
	<textarea name="content" rows="4" cols="47"></textarea>
	<input type="submit" value="運営に問い合わせる">
</form> --}}
</div>
</div>
</div>

@endsection
