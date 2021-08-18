@extends('layouts.app')

@section('content')

<h1>DM一覧</h1>
@foreach ($dm_started_list as $dm)
	{{ $dm['user_name'] }}
	@if ($dm['image_pass'])
		<img src="{{ asset('storage/image/' . $dm['image_pass'])}}" alt="" width="50">
	@else
		<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="50">
	@endif
	最新メッセージ : 
	@if (mb_strlen($dm['message']) > 30)
		{{ mb_substr($dm['message'], 0, 30) }}
	@else
		{{ $dm['message'] }}
	    
	@endif 
	{{ $dm['created_at'] }}
	<form action="{{ route('chat.index') }}" method="GET">
		<input type="hidden" name="receive_user_id" value="{{ $dm['user_id'] }}">
		<input type="hidden" name="send_user_id" value="{{ Auth::id() }}">
		<button type="submit">DMを見る</button>
	</form>
	<hr>
@endforeach

<h1>未返信DM</h1>
@foreach ($dm_not_started_list as $dm)
	{{ $dm['user_name'] }}
	@if ($dm['image_pass'])
		<img src="{{ asset('storage/image/' . $dm['image_pass'])}}" alt="" width="50">
	@else
		<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="50">
	@endif
	最新メッセージ : {{ $dm['message'] }}
	{{ $dm['created_at'] }}

	<form action="{{ route('chat.index') }}" method="GET">
		<input type="hidden" name="receive_user_id" value="{{ $dm['user_id'] }}">
		<input type="hidden" name="send_user_id" value="{{ Auth::id() }}">
		<button type="submit">DMを見る</button>
	</form>
	<hr>
@endforeach

@endsection