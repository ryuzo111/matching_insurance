@extends('layout')
<style>
	.user-image {
		width: 30px;
		height: 30px;
		border-radius: 50%;
		margin-top: 5px;
	}
	.label {
		line-height: 2 !important;
		white-space: normal !important;
	}
</style>

@section('content')

<div class="container">
<div class="box box-solid box-warning">
	<div class="box-header">
		<h1 class="box-title">フォロー者投稿とコメント一覧</h1>
	</div>

<div class="row">
	<div class="col-xs-12">
	@if (empty($posts_and_comments))
		<p class="tag">投稿とコメントはありません</p>
	@else

	@foreach ($posts_and_comments as $post_and_comment)
	{{-- postか確認するコード --}}
	@if (!empty($post_and_comment->trouble_content))
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-1">
					@if ($post_and_comment->user->image_pass)
						<img src="{{ asset('storage/image/' . $post_and_comment->user->image_pass)}}" alt="" class="user-image">
					@else
						<img src="{{ asset('storage/default/default.jpeg') }}" alt="" class="user-image">
					@endif
					</div>
					<div class="col-md-3">
						<b><u><a href="{{ route('profile', ['user_id' => $post_and_comment->user_id]) }}" > {{ $post_and_comment->user->name }}</a></u></b>
					</div>
					<div class="col-md-8">
						<p>{{ date('Y年m月d日H時i分', strtotime($post_and_comment->created_at)) }}</p>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<ul class="tag list-inline">
					<li style="font-size: 20px;"><span class="label label-default mylabel">タイトル：{{ $post_and_comment->title }}</span></li>
					<li style="font-size: 20px;"><span class="label label-default mylabel">カテゴリー：{{ config('trouble_type.' . $post_and_comment->trouble_type) }}</span></li>
					<li style="font-size: 20px;"><span class="label label-default mylabel">コメント数：{{ count($post_and_comment->comments) }}</span></li>
				</ul>
				<div class="return-table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>内容</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $post_and_comment->trouble_content }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-12">
						<p><a class="btn btn-warning" href="{{ route('post.detail', ['post_id' => $post_and_comment->id]) }}">詳細を見る</a></p>
					</div>
				</div>
			</div>
		</div>
	@else
		<div class="panel panel-warning">
			<div class="panel-heading">
				<span class="label label-warning">コメント</span>
				<div class="row">
					<div class="col-md-1">
					@if ($post_and_comment->user->image_pass)
						<img src="{{ asset('storage/image/' . $post_and_comment->user->image_pass)}}" class="user-image" alt="">
					@else
						<img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="">
					@endif
					</div>
					<div class="col-md-3">
						<b><u><a href="{{ route('profile', ['user_id' => $post_and_comment->user_id]) }}">{{ $post_and_comment->user->name }}</a></u></b>
					</div>
					<div class="col-md-5">
						<p>{{ date('Y年m月d日H時i分', strtotime($post_and_comment->created_at)) }}</p>
					</div>
					<div class="col-md-3">
						<p>いいねの数：{{ count($post_and_comment->goods )}}</p>
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
								<td>{{ $post_and_comment->comment }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-xs-12">
					@if ($post_and_comment->goods->contains('user_id', Auth::id()))
						<p><a href="{{ route('comment.delete_good', ['comment_id' => $post_and_comment->id])}}" class="btn btn-warning btn-sm">いいね済</a></p>
					@elseif (Auth::check())
						<p><a href="{{ route('comment.good', ['comment_id' => $post_and_comment->id])}}" class="btn btn-warning btn-sm">いいね</a></p>
					@endif
						<p><a href="{{ route('post.detail', ['post_id' => $post_and_comment->post_id]) }}" class="btn btn-warning btn-sm">コメントした投稿を見る</a></p>
					</div>
				</div>
			</div>
		</div>
	@endif
	@endforeach
	{{ $posts_and_comments->links() }}
	@endif
</div>
</div>
</div>
</div>
@endsection
