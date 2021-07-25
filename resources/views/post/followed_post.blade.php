@extends('layouts.app')

@section('content')

<h1>掲示版(フォローしているユーザーのみ)</h1>
@if (empty($posts_and_comments)) 
    <p>フォローユーザーの投稿とコメントはありません</p>
@else
<p>
    {{ ($posts_and_comments->currentPage()-1) * $posts_and_comments->perPage()+1 }} - 
    {{ (($posts_and_comments->currentPage()-1) * $posts_and_comments->perPage()+1) + (count($posts_and_comments)-1) }} 件 

    /{{ $posts_and_comments->total() }} 件を表示しています。
 </p>
 

@foreach ($posts_and_comments as $post_and_comment)
    {{-- postか確認するコード --}}
    @if (!empty($post_and_comment->trouble_content))
        <p>悩み投稿</p>
        @if ($post_and_comment->user->image_pass)
		    <img src="{{ $post_and_comment->user->image_pass }}" alt="" width="30">
		    <img src="{{ asset('storage/image/' . $post_and_comment->user->image_pass)}}" alt="" width="30"> 
	    @else
		    <img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="30">
	    @endif
        <p>
            <a href="{{ route('profile', ['user_id' => $post_and_comment->user_id]) }}">名前 : {{ $post_and_comment->user->name }}</a>
            <a href="{{ route('post.detail', ['post_id' => $post_and_comment->id]) }}">タイトル : {{ $post_and_comment->title }}</a>
            投稿時間 : {{ $post_and_comment->created_at }}
        </p>
        <table>
            <thead>
                <tr>
                    <th>悩みの種類</th>
                    <th>悩みを抱えている人</th>
                    <th>悩みの内容</th>
                    <th>興味のある保険を表示</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ config('trouble_type.' . $post_and_comment->trouble_type) }}</td>
                    <td>{{ config('insurance_target.' . $post_and_comment->insurance_target) }}</td>
                    <td>{{ $post_and_comment->trouble_content }}</td>
                    <td>
                        @if ($post_and_comment->interested_insurance['life'] === 1)
                           生命保険 
                        @endif
                        @if ($post_and_comment->interested_insurance['medical'] === 1)
                           医療保険 
                        @endif
                        @if ($post_and_comment->interested_insurance['cancer']=== 1)
                           がん保険 
                        @endif
                        @if ($post_and_comment->interested_insurance['pension'] === 1)
                           年金保険 
                        @endif
                        @if ($post_and_comment->interested_insurance['saving']=== 1)
                           貯蓄型の保険 
                        @endif
                        @if ($post_and_comment->interested_insurance['all_life'] === 1)
                           終身保険 
                        @endif
                        @if ($post_and_comment->interested_insurance['home'] === 1)
                           火災保険 
                        @endif
                        @if ($post_and_comment->interested_insurance['other'] === 1)
                           その他 
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <p>→悩みに対するコメントの数 : {{ count($post_and_comment->comments) }}</p>
    </div>

    <br>
    <br>

    @else
    <p>コメント</p>

    @if ($post_and_comment->user->image_pass)
        <img src="{{ $post_and_comment->user->image_pass }}" alt="" width="30">
        <img src="{{ asset('storage/image/' . $post_and_comment->user->image_pass)}}" alt="" width="30"> 
    @else
        <img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="30">
    @endif
    <p>
        <a href="{{ route('profile', ['user_id' => $post_and_comment->user_id]) }}">名前 : {{ $post_and_comment->user->name }}</a>
        コメント時間 : {{ $post_and_comment->created_at }}
    </p>
    <p>{{$post_and_comment->comment}}</p>
    <p>→いいね数 : {{count($post_and_comment->goods)}}</p>
    @if ($post_and_comment->goods->contains('user_id', Auth::id()))
        <a href="{{route('comment.delete_good', ['comment_id' => $post_and_comment->id])}}">いいね済み</a>
    @elseif (Auth::check())
        <a href="{{route('comment.good', ['comment_id' => $post_and_comment->id])}}">いいね</a>
    @endif
    <a href="{{ route('post.detail', ['post_id' => $post_and_comment->post_id]) }}">コメントした投稿を見る</a>

    </br>
    </br>
    @endif

    
@endforeach
{{ $posts_and_comments->links() }}
@endif

@endsection