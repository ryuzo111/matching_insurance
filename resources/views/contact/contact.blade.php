@extends('layouts.app')

@section('content')

<h1>お問い合わせ</h1>

<form action="{{ route('contact.contact') }}" method="POST">
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
</form>

@endsection