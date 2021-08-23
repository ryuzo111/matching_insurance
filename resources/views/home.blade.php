@extends('layout')

@section('content')

<!-- コンテンツヘッダー -->
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">保険の悩み一覧</h1>
</div>
<div class="container">
<a href="{{ route('post.create') }}">悩みを投稿する</a>

<form action="{{ route('post.search') }}" method="GET">
    <input type="text" name="word" value={{ old('word') }}>
    <input type="submit" value="検索する">
</form>
<br>

@foreach ($posts as $post)
    <div>
        <img src="{{ $post->user->image_pass }}" alt="" width="30">
        <p>
            名前 :<a href="{{ route('profile', ['id' => $post->user->id]) }}"> {{ $post->user->name }}</a>
            <a href="{{ route('post.detail', ['post_id' => $post->id]) }}">タイトル : {{ $post->title }}</a>
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

<br>
<br>

@endforeach
{{ $posts->links() }}
</div>
</div>
</div>
@endsection
