@extends('layout')
<style>
	.user-image {
		width: 100px;
		height: 100px;
		border-radius: 50%;
	}
</style>

@section('content')

<div class="container">
<div class="top-button">
<a href="{{ route('profile', ['id' => $user->id]) }}"><button class="btn btn-default"><i class="fas fa-backward"> {{ $user->name }}さんのプロフィールへ戻る</i></button></a>
</div>

<div class="box box-solid box-warning">
	<div class="box-header">
		<h1 class="box-title">{{ $user->name }}さんの投稿一覧</h1>
	</div>
	<div class="center-block">
	<div style="text-align: center;">
		@if ($user->image_pass)
		<img class="user-image" src="{{ asset('storage/image/' . $user->image_pass)}}" alt="">
		@else
			<p class="text-center"><img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="100"></p>
		@endif
	</div>
	<div class="row">
		<div class="col-xs-12">
		@foreach ($posts as $post)
			<div class="panel panel-warning">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-12">
							<p>{{ $post->created_at->format('Y年m月d日H時i分') }}</p>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<ul class="tag list-inline">
						<li style="font-size: 20px;"><span class="label label-default">タイトル：{{ $post->title }}</span></li>
						<li style="font-size: 20px;"><span class="label label-default">カテゴリー：{{ config('trouble_type.' . $post->trouble_type) }}</span></li>
						<li style="font-size: 20px;"><span class="label label-default">コメント数：{{ count($post->comments) }}</span></li>
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
									<td>{{ $post->trouble_content }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-xs-12">
							<p><a class="btn btn-warning" href="{{ route('post.detail', ['post_id' => $post->id]) }}">詳細を見る</a></p>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>
</div>
</div>
</div>


@endsection
