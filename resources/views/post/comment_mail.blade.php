<p>こんにちは . {{$comment->post->user->name}} . さん</p>
<p>あなたの投稿にコメントが付きました</p>

<p>あなたの投稿</p>
<div>
    <p>
        タイトル : {{ $comment->post->title }}
        投稿時間 : {{ $comment->post->created_at }}
    </p>
    <table>
        <thead>
            <tr>
                <th>カテゴリー</th>
                <th>誰の？</th>
                <th>内容</th>
                <th>保険の種類</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ config('trouble_type.' . $comment->post->trouble_type) }}</td>
                <td>{{ config('insurance_target.' . $comment->post->insurance_target) }}</td>
                <td>{{ $comment->post->trouble_content }}</td>
                <td>
                    @if ($comment->post->interested_insurance['life'] === 1)
                        生命保険
                    @endif
                    @if ($comment->post->interested_insurance['medical'] === 1)
                        医療保険
                    @endif
                    @if ($comment->post->interested_insurance['cancer']=== 1)
                        がん保険
                    @endif
                    @if ($comment->post->interested_insurance['pension'] === 1)
                        年金保険
                    @endif
                    @if ($comment->post->interested_insurance['saving']=== 1)
                        貯蓄型の保険
                    @endif
                    @if ($comment->post->interested_insurance['all_life'] === 1)
                        終身保険
                    @endif
                    @if ($comment->post->interested_insurance['home'] === 1)
                        火災保険
                    @endif
                    @if ($comment->post->interested_insurance['other'] === 1)
                        その他
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <p>→悩みに対するコメントの数 : {{ count($comment->post->comments) }}</p>
</div>

<p>新たなコメント</p>
<p>
    名前 : {{ $comment->user->name }}
    コメント時間 : {{ $comment->created_at }}
</p>
<p>{{$comment->comment}}</p>
</br>
<a href="{{ route('login') }}">コメントに対しての返信やいいねはログインする必要があります</a>



