@extends('layouts.app')

@section('content')

<h1>保険の悩み一覧</h1>
<form action="{{ route('post.search') }}" method="GET">
    <input type="text" name="word" value={{ old('word', $request->word) }}>
    </br>
    <label>悩みのタイプ</label>
    <input type="checkbox" name="trouble_type[]" value="1" {{ is_array($request->trouble_type) && in_array(1, $request->trouble_type) ? 'checked' : ''}}>保険加入について
    <input type="checkbox" name="trouble_type[]" value="2" {{ is_array($request->trouble_type) && in_array(2, $request->trouble_type) ? 'checked' : ''}}>現在加入の保険について
    <input type="checkbox" name="trouble_type[]" value="3" {{ is_array($request->trouble_type) && in_array(3, $request->trouble_type) ? 'checked' : ''}}>健康告知について
    <input type="checkbox" name="trouble_type[]" value="4" {{ is_array($request->trouble_type) && in_array(4, $request->trouble_type) ? 'checked' : ''}}>営業マンにおすすめされた保険について
    <input type="checkbox" name="trouble_type[]" value="5" {{ is_array($request->trouble_type) && in_array(5, $request->trouble_type) ? 'checked' : ''}}>その他の悩み
    </br>
    <label>悩みの対象者</label>
    <input type="checkbox" name="insurance_target[]" value="1" {{ is_array($request->insurance_target) && in_array(1, $request->insurance_target) ? 'checked' : ''}}>本人
    <input type="checkbox" name="insurance_target[]" value="2" {{ is_array($request->insurance_target) && in_array(2, $request->insurance_target) ? 'checked' : ''}}>配偶者
    <input type="checkbox" name="insurance_target[]" value="3" {{ is_array($request->insurance_target) && in_array(3, $request->insurance_target) ? 'checked' : ''}}>子供
    <input type="checkbox" name="insurance_target[]" value="4" {{ is_array($request->insurance_target) && in_array(4, $request->insurance_target) ? 'checked' : ''}}>親
    <input type="checkbox" name="insurance_target[]" value="5" {{ is_array($request->insurance_target) && in_array(5, $request->insurance_target) ? 'checked' : ''}}>祖母
    <input type="checkbox" name="insurance_target[]" value="6" {{ is_array($request->insurance_target) && in_array(6, $request->insurance_target) ? 'checked' : ''}}>祖父
    <input type="checkbox" name="insurance_target[]" value="7" {{ is_array($request->insurance_target) && in_array(7, $request->insurance_target) ? 'checked' : ''}}>孫
    <input type="checkbox" name="insurance_target[]" value="8" {{ is_array($request->insurance_target) && in_array(8, $request->insurance_target) ? 'checked' : ''}}>友人
    <input type="checkbox" name="insurance_target[]" value="9" {{ is_array($request->insurance_target) && in_array(9, $request->insurance_target) ? 'checked' : ''}}>その他
    </br>
    <label>興味のある保険</label>
    <input type="checkbox" name="interested_insurances[]" value="life" {{ is_array($request->interested_insurances) && in_array('life', $request->interested_insurances) ? 'checked' : ''}}>生命保険
    <input type="checkbox" name="interested_insurances[]" value="medical" {{ is_array($request->interested_insurances) && in_array('medical', $request->interested_insurances) ? 'checked' : ''}}>医療保険
    <input type="checkbox" name="interested_insurances[]" value="cancer" {{ is_array($request->interested_insurances) && in_array('cancer', $request->interested_insurances) ? 'checked' : ''}}>がん保険
    <input type="checkbox" name="interested_insurances[]" value="pension" {{ is_array($request->interested_insurances) && in_array('pension', $request->interested_insurances) ? 'checked' : ''}}>生命保険
    <input type="checkbox" name="interested_insurances[]" value="saving" {{ is_array($request->interested_insurances) && in_array('saving', $request->interested_insurances) ? 'checked' : ''}}>貯蓄型の保険
    <input type="checkbox" name="interested_insurances[]" value="all_life" {{ is_array($request->interested_insurances) && in_array('all_life', $request->interested_insurances) ? 'checked' : ''}}>終身保険
    <input type="checkbox" name="interested_insurances[]" value="home" {{ is_array($request->interested_insurances) && in_array('home', $request->interested_insurances) ? 'checked' : ''}}>火災保険
    <input type="checkbox" name="interested_insurances[]" value="other" {{ is_array($request->interested_insurances) && in_array('other', $request->interested_insurances) ? 'checked' : ''}}>その他   
    </br>
    <input name="start_time" type="date" value="{{$request->start_time ?? null}}" placeholder="開始日">
    <i>〜</i>
    <input name="end_time" type="date" value="{{$request->end_time ?? null}}" placeholder="終了日">
    </br>
    <input type="submit" value="検索する">
</form>
<br>

<p>
    {{ ($posts->currentPage()-1) * $posts->perPage()+1 }} - 
    {{ (($posts->currentPage()-1) * $posts->perPage()+1) + (count($posts)-1) }} 件 

    /{{ $posts->total() }} 件を表示しています。
 </p>

@foreach ($posts as $post)
    <div>
        @if ($post->user->image_pass)
		    <img src="{{ $post->user->image_pass }}" alt="" width="30">
		    <img src="{{ asset('storage/image/' . $post->user->image_pass)}}" alt="" width="30"> 
	    @else
		    <img src="{{ asset('storage/default/default.jpeg') }}" alt="" width="30">
	    @endif
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

    <br>
    <br>
    
@endforeach
{{ $posts->appends(['word' => $request->word, 'trouble_type' => $request->trouble_type, 'insurance_target' => $request->insurance_target, 'interested_insurances' => $request->interested_insurances, 'start_time' => $request->start_time, 'end_time' => $request->end_time])->links() }}

@endsection