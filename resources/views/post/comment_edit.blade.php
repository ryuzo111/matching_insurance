@extends('layout')
<style>
	.user-image {
		width: 30px;
		height: 30px;
		border-radius: 50%;
	}
</style>

@section('content')
<div class="container">
<div class="top-button">
<a href="{{ route('post.detail', ['post_id' => $post->id]) }}"><button class="btn btn-default"><i class="fas fa-backward"> 悩み詳細ページへ戻る</i></button></a>
</div>

<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">コメント編集</h1>
</div>
<div>
	<div style="margin: 10px;">
    @if ($post->user->image_pass)
	    <img src="{{ asset('storage/image/' . $post->user->image_pass)}}" class="user-image" alt="">
    @else
	    <img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="">
	@endif
	</div>
	<ul class="tag list-inline">
		<li style="font-size: 20px;"><span class="label label-default">投稿者：<a href="{{ route('profile', ['id' => $post->user->id]) }}">{{ $post->user->name }}</a></span></li>
		<li style="font-size: 20px;"><span class="label label-default">タイトル：{{ $post->title }}</span></li>
		<li style="font-size: 20px;"><span class="label label-default">カテゴリー：{{ config('trouble_type.' . $post->trouble_type) }}</span></li>
		<li style="font-size: 20px;"><span class="label label-default">誰の？：{{ config('insurance_target.' . $post->insurance_target) }}</span></li>
		<li style="font-size: 20px;"><span class="label label-default">保険の種類：
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
		<li style="font-size: 20px;"><span class="label label-default">投稿時間：{{ $post->created_at->format('Y年m月d日H時i分') }}</span></li>
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

@if (!empty($post->comments))
    <p class="tag">コメント一覧</p>
    @foreach ($post->comments as $comment)
	<div style="margin: 10px;">
    @if ($comment->user->image_pass)
	    <img src="{{ asset('storage/image/' . $comment->user->image_pass)}}" class="user-image" alt="">
    @else
	    <img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="">
	@endif
	</div>
        <p class="tag">
            名前 : <a href="{{ route('profile', ['id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
            コメント時間 : {{ date('Y年m月d日H時i分', strtotime($post->created_at)) }}
        </p>
        @if ($comment->id === $target_comment->id)


		<form  class="horizontal"action="{{ route('comment.edit') }}" method="POST">
			<div class="form-group has-feedback {{ $errors->has('comment_id') ? 'has-error' : '' }}">
			<div class="form-group has-feedback {{ $errors->has('comment') ? 'has-error' : '' }}">
                {{ csrf_field() }}
                <input type="hidden" name="comment_id" value="{{$comment->id}}">
				<input type="text" name="comment" value="{{$comment->comment}}" class="form-control">
				@if ($errors->has('comment_id'))
					<span class="help-block">
						<strong>{{ $errors->first('comment_id') }}</strong>
					</span>
				@endif
				@if ($errors->has('comment'))
					<span class="help-block">
						<strong>{{ $errors->first('comment') }}</strong>
					</span>
				@endif
				<button class="btn btn-warning" type="submit">コメントを編集する</button>
			</div>
			</div>
         </form>
        @else
            <p class="tag">{{$comment->comment}}</p>
        @endif
        </br>
    @endforeach
@endif
</div>
</div>
</div>

@endsection
