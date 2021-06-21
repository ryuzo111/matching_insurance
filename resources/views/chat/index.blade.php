@extends('layouts.app')

@section('content')

<h1>Chat内容</h1>

<div style="background-color: lightgray">
	<div id="chat-data" data-receive-user-id="{{ $receive_user->id }}" data-send-user-id="{{ Auth::id() }}" data-base-url="{{ env('BASE_URL') }}">

	</div>
</div>
<br>

@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach

<div>
	{{Form::open(['route' => ['chat.store', 'receive_user' => $receive_user, 'send_user' => $send_user]])}}
		{{Form::text('message')}}
	{{Form::submit('送信')}}
	{{Form::close()}}
</div>

@endsection

@section('js')
	<script src="{{ asset('js/chat.js') }}"></script>
@endsection