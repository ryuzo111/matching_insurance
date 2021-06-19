@extends('layouts.app_admin')

@section('content')

<p>いただいた問い合わせ:{{ $contact->content }}</p>

<h1>回答フォーム</h1>

@if ($errors->any())
	@foreach ($errors->all() as $error)
		<p class="text-danger">{{ $error }}</p>
	@endforeach
@endif

{{ Form::open(['url' => route('contact.answer'), 'method' => 'POST']) }}
{{ Form::textarea('answer', null, ['class' => 'contact-content', 'rows' => '4', 'cols' => '47', 'required']) }}
{{ Form::hidden('contact_id', ['value' => $contact->id]) }}
{{ Form::submit('回答を送る', ['class' => 'contact-submit']) }}

{{ Form::close() }}

@endsection