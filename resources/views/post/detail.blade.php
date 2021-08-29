@extends('layout')
<style>
	.user-image {
		width: 30px;
		height: 30px;
		border-radius: 50%;
	}
	.label {
		line-height: 2 !important;
		white-space: normal !important;
	}
</style>

@section('content')

<div class="container">
	<div class="top-button">
	<a href="{{ route('post.index') }}"><button class="btn btn-default"><i class="fas fa-backward"> 悩み一覧ページへ戻る</i></button></a>
	</div>
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h1 class="box-title">ほけんの悩み詳細</h1>
		</div>
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-1">
					@if ($post->user->image_pass)
						<img src="{{ asset('storage/image/' . $post->user->image_pass)}}" class="user-image" alt="">
					@else
						<img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="">
					@endif
					</div>
					<div class="col-md-2">
						<b><u><a href="{{ route('profile', ['id' => $post->user->id]) }}"> {{ $post->user->name }}</a></u></b>
					</div>
					<div class="col-md-9">
						<p>{{ date('Y年m月d日H時i分', strtotime($post->created_at)) }}</p>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<ul class="tag list-inline">
					<li style="font-size: 20px;"><span class="label label-default">タイトル：{{ $post->title }}</span></li>
					<li style="font-size: 20px;"><span class="label label-default">カテゴリー：{{ config('trouble_type.' . $post->trouble_type) }}</span></li>
					<li style="font-size: 20px;"><span class="label label-default">誰の？：{{ config('insurance_target.' . $post->insurance_target) }}</span></li>
					<li style="font-size: 20px;"><span class="label label-default">ほけんの種類：
								@if ($post->interested_insurance['life'] === 1)
									生命保険
								@endif
								@if ($post->interested_insurance['medical'] === 1)
									医療保険
								@endif
								@if ($post->interested_insurance['cancer']=== 1)
									がん保険
								@endif
								@if ($post->interested_insurance['pension'] === 1)
									年金保険
								@endif
								@if ($post->interested_insurance['saving']=== 1)
									貯蓄型の保険
								@endif
								@if ($post->interested_insurance['all_life'] === 1)
									終身保険
								@endif
								@if ($post->interested_insurance['home'] === 1)
									火災保険
								@endif
								@if ($post->interested_insurance['other'] === 1)
									その他
								@endif
			</span></li>
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
					@if ($post->user_id == Auth::id())
						<p><a href="{{ route('post.edit', ['post' => $post]) }}" class="btn btn-warning btn-sm">編集</a></p>
						<form method="post" action="{{ route('post.delete', ['post' => $post]) }}">
							 {{ csrf_field() }}
							<button class="btn btn-warning btn-sm" type="submit">削除</button>
						</form>
					@endif
					</div>
				</div>
			</div>
		</div>

@if (!empty($post->comments))
	<p class="tag">コメント一覧</p>
        <div class="row">
			<div class="col-xs-12">
			@foreach ($post->comments as $comment)
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-1">
							@if ($comment->user->image_pass)
								<img src="{{ asset('storage/image/' . $comment->user->image_pass)}}" class="user-image" alt="">
							@else
								<img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="">
							@endif
							</div>
							<div class="col-md-2">
								<b><u><a href="{{ route('profile', ['id' => $comment->user->id]) }}"> {{ $comment->user->name }}</a></u></b>
							</div>
							<div class="col-md-6">
								<p>{{ date('Y年m月d日H時i分', strtotime($comment->created_at)) }}</p>
							</div>
							<div class="col-md-3">
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
							</div>
						</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>
@endif


@if (Auth::check())

    @if ($errors->has('post_id'))
        <p>{{$errors->first('post_id')}}</p>
    @endif
    @if ($errors->has('comment'))
        <p>{{$errors->first('comment')}}</p>
    @endif
	<form  class="horizontal"action="{{ route('post.comment') }}" method="POST">
		<div class="form-group">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{$post->id}}">
		{{-- <input type="text" name="comment" class="form-control"> --}}
		<textarea name="comment" rows="4" class="form-control"></textarea>
		</div>
		<div class="form-group">
		<button class="btn btn-warning" type="submit">コメントする</button>
		</div>
    </form>
    <br>

@else
	<p class="tag">コメントするにはログインする必要があります</p>
		<div class="bottom-button">
		<a href="{{ route('login') }}"><button class="btn btn-warning">ログインする</button></a>
		</div>
@endif
</div>
</div>
</div>
@endsection
