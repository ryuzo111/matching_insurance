@extends('layout')
<style>
	.user-image {
		width: 50px;
		height: 50px;
		border-radius: 50%;
	}
	h2 {
		color: #fff !important;
		font-size: 16px !important;
		background: #FF6615 !important;
		padding: 0.5em !important;
		border-radius: 0.5em;
	}
</style>

@section('content')
<div class="container">
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h1 class="box-title">チャット一覧</h1>
		</div>
		<div class="box-body">
		@isset ($dm_started_list)
			@foreach ($dm_started_list as $dm)
				<ul class="tag list-group">
					<li class="list-group-item">{{ $dm['user_name'] }}</li>
					@if ($dm['image_pass'])
						<li class="list-group-item"><img src="{{ asset('storage/image/' . $dm['image_pass'])}}" alt="" class="user-image"></li>
					@else
						<li class="list-group-item"><img src="{{ asset('storage/default/default.jpeg') }}" alt="" class="user-image"></li>
					@endif
					<li class="list-group-item">
						最新メッセージ :
						@if (mb_strlen($dm['message']) > 30)
							{!! nl2br(e(str_limit($dm['message'], 30))) !!}
						@else
							{{ $dm['message'] }}

						@endif
					</li>
					<li class="list-group-item">{{ date('Y年m月d日H時i分', strtotime($dm['created_at'])) }}</li>
				</ul>
				<form class="horizontal" action="{{ route('chat.index') }}" method="GET">
					<div class="form-group">
					{{ csrf_field() }}
						<input type="hidden" name="receive_user_id" value="{{ $dm['user_id'] }}">
						<input type="hidden" name="send_user_id" value="{{ Auth::id() }}">
						<button class="btn btn-warning" type="submit">チャットを見る</button>
					</div>
				</form>
			@endforeach
		</div>
		@endisset
		@empty ($dm_started_list)
			<p class="tag">まだチャットはありません</p>
		@endempty
		<div class="box-footer">
			<h2>はじめてのチャット</h2>
			@isset ($dm_not_started_list)
			@foreach ($dm_not_started_list as $dm)
				<div class="box-tools">
					<ul class="tag list-group">
						<li class="list-group-item">{{ $dm['user_name'] }}</li>
						@if ($dm['image_pass'])
							<li class="list-group-item"><img src="{{ asset('storage/image/' . $dm['image_pass'])}}" alt="" class="user-image"></li>
						@else
							<li class="list-group-item"><img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt=""</li>
						@endif
						<li class="list-group-item">
						最新メッセージ :
						@if (mb_strlen($dm['message']) > 30)
							{{ mb_substr($dm['message'], 0, 30) }}
						@else
							{{ $dm['message'] }}

						@endif
						</li>
						<li class="list-group-item">{{ $dm['created_at'] }}</li>
					</ul>
					<form class="horizontal" action="{{ route('chat.index') }}" method="GET">
						<div class="form-group">
							<input type="hidden" name="receive_user_id" value="{{ $dm['user_id'] }}">
							<input type="hidden" name="send_user_id" value="{{ Auth::id() }}">
							<button class="btn btn-warning" type="submit">チャットを見る</button>
						</div>
					</form>
				</div>
			@endforeach
			@endisset
			@empty ($dm_not_started_list)
				<p class="tag">まだチャットはありません</p>
			@endempty
		</div>
	</div>
</div>
@endsection
