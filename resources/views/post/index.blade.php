@extends('layouts.app')

@section('content')

<h1>保険の悩み一覧</h1>

<a href="{{ route('post.create') }}">悩みを投稿する</a>

<form action="{{ route('post.search') }}" method="GET">
    <input type="text" name="word" value={{ old('word') }}>
</br>
    <label>悩みのタイプ</label>
        <input type="checkbox" name="trouble_type[]" value="1" {{ old('trouble_type') === 1 ? 'checked' : ''}}>保険加入について
        <input type="checkbox" name="trouble_type[]" value="2" {{ old('trouble_type') === 2 ? 'checked' : ''}}>現在加入の保険について
        <input type="checkbox" name="trouble_type[]" value="3" {{ old('trouble_type') === 3 ? 'checked' : ''}}>健康告知について
        <input type="checkbox" name="trouble_type[]" value="4" {{ old('trouble_type') === 4 ? 'checked' : ''}}>営業マンにおすすめされた保険について
        <input type="checkbox" name="trouble_type[]" value="5" {{ old('trouble_type') === 5 ? 'checked' : ''}}>その他の悩み
</br>
        <label>悩みの対象者</label>
        <input type="checkbox" name="insurance_target[]" value="1" {{ old('insurance_target') }}>本人
        <input type="checkbox" name="insurance_target[]" value="2" {{ old('insurance_target') }}>配偶者
        <input type="checkbox" name="insurance_target[]" value="3" {{ old('insurance_target') }}>子供
        <input type="checkbox" name="insurance_target[]" value="4" {{ old('insurance_target') }}>親
        <input type="checkbox" name="insurance_target[]" value="5" {{ old('insurance_target') }}>祖母
        <input type="checkbox" name="insurance_target[]" value="6" {{ old('insurance_target') }}>祖父
        <input type="checkbox" name="insurance_target[]" value="7" {{ old('insurance_target') }}>孫
        <input type="checkbox" name="insurance_target[]" value="8" {{ old('insurance_target') }}>友人
        <input type="checkbox" name="insurance_target[]" value="9" {{ old('insurance_target') }}>その他
</br>
        <label>興味のある保険</label>
        <input type="checkbox" name="interested_insurances[]" value="life" {{ is_array(old('interested_insurances')) && in_array('life', old('interested_insurances')) ? 'checked' : ''}}>生命保険
        <input type="checkbox" name="interested_insurances[]" value="medical" {{ is_array(old('interested_insurances')) && in_array('medical', old('interested_insurances')) ? 'checked' : ''}}>医療保険
        <input type="checkbox" name="interested_insurances[]" value="cancer" {{ is_array(old('interested_insurances')) && in_array('cancer', old('interested_insurances')) ? 'checked' : ''}}>がん保険
        <input type="checkbox" name="interested_insurances[]" value="pension" {{ is_array(old('interested_insurances')) && in_array('pension', old('interested_insurances')) ? 'checked' : ''}}>年金保険
        <input type="checkbox" name="interested_insurances[]" value="saving" {{ is_array(old('interested_insurances')) && in_array('saving', old('interested_insurances')) ? 'checked' : ''}}>貯蓄型の保険
        <input type="checkbox" name="interested_insurances[]" value="all_life" {{ is_array(old('interested_insurances')) && in_array('all_life', old('interested_insurances')) ? 'checked' : ''}}>終身保険
        <input type="checkbox" name="interested_insurances[]" value="home" {{ is_array(old('interested_insurances')) && in_array('home', old('interested_insurances')) ? 'checked' : ''}}>火災保険
        <input type="checkbox" name="interested_insurances[]" value="other" {{ is_array(old('interested_insurances')) && in_array('other', old('interested_insurances')) ? 'checked' : ''}}>その他   
</br>
        <input name="start_time" type="date" value="{{$start_time ?? null}}" placeholder="開始日">
        <input name="end_time" type="date" value="{{$end_time ?? null}}" placeholder="終了日">
</br>
    <input type="submit" value="検索する">
</form>
<br>

@foreach ($posts as $post)
    <div>
        @if ($post->user->image_pass)
		    <img src="{{ $post->user->image_pass }}" alt="" width="30">
		    <img src="{{ asset('storage/image/' . $post->user->image_pass)}}" alt="" width="30"> 
	    @else
		    <img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="30">
	    @endif

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

@endsection
