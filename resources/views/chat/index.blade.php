@extends('layout')
<style>
@media screen and (max-width:1024px) {
	.direct-chat-text {
		word-wrap: break-word;
	}
}
</style>
@section('content')

<div class="container">
	<div class="box box-solid box-warning direct-chat direct-chat-warning">
		<div class="box-header with-border">
			<h3 class="box-title">{{ $receive_user->name }}</h3>
		</div>
		<div id="chat">
			<div class="box-body">
				<div class="direct-chat-messages">
					<div id="chat-data" data-receive-user-id="{{ $receive_user->id }}" data-send-user-id="{{ Auth::id() }}" data-base-url="{{ config('baseurl.baseurl') }}">
					</div>
					<div class="" v-for="(chat, index) in chats">
						<div v-if="chat.receive_user_id == loginId">
							<div class="direct-chat-msg">
								<div class="direct-chat-info clearfix">
									<span class="direct-chat-name pull-left">{{ $receive_user->name }}</span>
								</div>
									@if ($receive_user->image_pass)
										<img class="direct-chat-img" src="{{ asset('storage/image/' . $receive_user->image_pass)}}" alt="">
									@else
										<img class="direct-chat-img" src="{{ asset('storage/default/default.jpeg') }}" alt="">
									@endif
								<div class="direct-chat-text">
									@{{ chat.message }}
								</div>
							</div>
						</div>
						<div v-else-if="chat.send_user_id == loginId">
							<div class="direct-chat-msg right">
								<div class="direct-chat-info clearfix">
									<span class="direct-chat-name pull-right">{{ $send_user->name }}</span>
								</div>
									@if ($send_user->image_pass)
										<img class="direct-chat-img" src="{{ asset('storage/image/' . $send_user->image_pass)}}" alt="">
									@else
										<img class="direct-chat-img" src="{{ asset('storage/default/default.jpeg') }}" alt="">
									@endif
								<div class="direct-chat-text">
									@{{ chat.message }}
								</div>
								<div class="text-right">
									<button class="btn btn-xs btn-info" v-on:click="edit(index);">
										<span class="glyphicon glyphicon-pencil"></span>
									</button>
									<button class="btn btn-xs btn-warning" v-on:click="remove(chat.created_at, index);">
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<div class="box-footer">
				<div class="input-group">
					<input type="text" class="form-control" v-model="newChat" ref="editor">
					<span class="input-group-btn">
					@if ($errors->has('message'))
						<div style="color: red;">
							{{ $errors->first('message') }}
						</div>
					@endif
							<button id="send" v-on:click="send" class="btn btn-warning" type="button">送信</button>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>


@endsection

@section('js')
	{{-- Vue.jsを読み込む --}}
	<script src="https://unpkg.com/vue@next"></script>
	{{-- Vueアプリケーション --}}
	<script src="{{ asset('js/main.js') }}"></script>

@endsection
