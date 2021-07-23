@extends('layouts.app')

@section('content')

<h1>Chat内容</h1>

{{-- <div style="background-color: lightgray">
	<div id="chat-data" data-receive-user-id="{{ $receive_user->id }}" data-send-user-id="{{ Auth::id() }}" data-base-url="{{ env('BASE_URL') }}">

	</div>
</div> --}}

{{-- @foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach --}}

{{-- <div>
	{{Form::open(['route' => ['chat.store', 'receive_user' => $receive_user, 'send_user' => $send_user]])}}
		{{Form::text('message')}}
	{{Form::submit('送信')}}
	{{Form::close()}}
</div> --}}

<div id="chat">
	<div id="chat-data" data-receive-user-id="{{ $receive_user->id }}" data-send-user-id="{{ Auth::id() }}" data-base-url="{{ config('baseurl.baseurl') }}">
	</div>

	<div class="" v-for="(chat, index) in chats">
		<div v-if="chat.receive_user_id == loginId">
			<p style="text-align: left">
				@if ($receive_user->image_pass)
					<img src="{{ asset('storage/image/' . $receive_user->image_pass)}}" alt="" width="50">
				@else
					<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="50">
				@endif
				@{{ chat.message }}
			</p>
		</div>
		<div v-else-if="chat.send_user_id == loginId">
			<p style="text-align: right">
				@if ($send_user->image_pass)
					<img src="{{ asset('storage/image/' . $send_user->image_pass)}}" alt="" width="50">
				@else
					<img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="50">
				@endif
				@{{ chat.message }}
				<button class="btn btn-xs btn-info" v-on:click="edit(index);">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>

				<button class="btn btn-xs btn-warning" v-on:click="remove(chat.created_at,index);"> 
					<span class="glyphicon glyphicon-trash"></span>
				</button>
			</p>
		</div>
	</div>

	<form>
		<div class="form-group">
			<div class="input-group">
				<input type="text" class="form-control" v-model="newChat" ref="editor">
				<span class="input-group-btn"><button id="send" v-on:click="send" class="btn btn-primary" type="button">送信</button></span>
			</div>

		</div>
	</form>
</div>


@endsection

@section('js')
	{{-- Vue.jsを読み込む --}}
	<script src="https://unpkg.com/vue@next"></script>
	{{-- Vueアプリケーション --}}
	<script src="{{ asset('js/main.js') }}"></script>

	{{-- <script src="{{ asset('js/chat.js') }}"></script> --}}
@endsection