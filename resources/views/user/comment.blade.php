@extends('layout')
<style>
	.user-image {
		width: 100px;
		height: 100px;
		border-radius: 50%;
		margin-bottom: 20px;
	}
</style>

@section('content')

<div class="container">
<div class="top-button">
<a href="{{ route('profile', ['id' => $user->id]) }}"><button class="btn btn-default"><i class="fas fa-backward"> {{ $user->name }}さんのプロフィールへ戻る</i></button></a>
</div>

<div class="box box-solid box-warning">
	<div class="box-header">
		<h1 class="box-title">{{ $user->name }}さんのコメント一覧</h1>
	</div>
	<div class="center-block">
	<div style="text-align: center;">
		@if ($user->image_pass)
		<img class="user-image" src="{{ asset('storage/image/' . $user->image_pass)}}" alt="">
		@else
			<p class="text-center"><img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="100"></p>
		@endif
	</div>
	<div class="panel panel-warning">
		@foreach ($comments as $comment)
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-6">
					<p>{{ date('Y年m月d日H時i分', strtotime($comment->created_at)) }}</p>
				</div>
				<div class="col-xs-6">
					<p>いいねの数：{{ count($comment->goods )}}</p>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="return-table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>コメント</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $comment->comment }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-12">
				@if ($comment->user_id === Auth::id())
					<p><a href="{{route('comment.edit_form', ['comment_id' => $comment->id])}}" class="btn btn-warning btn-sm">編集</a></p>
					<p><a href="{{route('comment.delete', ['comment_id' => $comment->id])}}" class="btn btn-warning btn-sm">削除</a></p>
				@elseif ($comment->goods->contains('user_id', Auth::id()))
					<p><a href="{{route('comment.delete_good', ['comment_id' => $comment->id])}}" class="btn btn-warning btn-sm">いいね済</a></p>
				@elseif (Auth::check())
					<p><a href="{{route('comment.good', ['comment_id' => $comment->id])}}" class="btn btn-warning btn-sm">いいね</a></p>
				@endif
				<p><a href="{{ route('post.detail', ['post_id' => $comment->post_id]) }}" class="btn btn-warning btn-sm">コメントした投稿を見る</a></p>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
</div>
</div>
</div>
</div>
</div>


@endsection
