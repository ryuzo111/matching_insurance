@extends('layouts.app')

@section('content')

<h1>悩み詳細</h1>
<div>
    <img src="{{ $post->user->image_pass }}" alt="" width="30">
    <p>
        名前 : {{ $post->user->name }}
        タイトル : {{ $post->title }}
        投稿時間 : {{ $post->created_at }}
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
                <td>{{ config('trouble_type.' . $post->trouble_type) }}</td>
                <td>{{ config('insurance_target.' . $post->insurance_target) }}</td>
                <td>{{ $post->trouble_content }}</td>
                <td>
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
                </td>
            </tr>
        </tbody>
    </table>
    <p>→悩みに対するコメントの数 : {{ count($post->comments) }}</p>
</div>

@if (Auth::check())
@if (!empty($post->comments))
<p>コメント一覧</p>
@foreach ($post->comments as $comment)

<img src="{{ $comment->user->image_pass }}" alt="" width="30">
<p>
    名前 : {{ $comment->user->name }}
    コメント時間 : {{ $comment->created_at }}
</p>
<p>{{$comment->comment}}</p>

</br>
@endforeach

<form action="{{ route('post.comment') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="text" name="comment">
    <input type="submit" value="コメントする">
</form>
<br>

@endif


@else
<p>コメントするにはログインする必要があります</p>
<a href="{{ route('login') }}">ログインする</a>
@endif



@endsection