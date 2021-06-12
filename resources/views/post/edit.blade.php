@extends('layouts.app')

@section('content')
<a href="{{ route('post.index') }}">保険の悩み一覧ページ</a>

<h1>保険の悩み編集ページ</h1>

@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach

<form action="{{ route('post.edit', ['post' => $target_post]) }}" method="POST">
    {{ csrf_field() }}
    <div>
        <label>悩みのタイトル</label>
        <input type="text" name="title" value={{ old('title', $target_post->title) }}>
    </div>
    <div>
        <label>どんなタイプの悩み？</label>
        <input type="radio" name="trouble_type" value="1" {{ old('trouble_type', $target_post->trouble_type) == 1  ? 'checked' : ''}}>保険加入について
        <input type="radio" name="trouble_type" value="2" {{ old('trouble_type', $target_post->trouble_type) == 2  ? 'checked' : ''}}>現在加入の保険について
        <input type="radio" name="trouble_type" value="3" {{ old('trouble_type', $target_post->trouble_type) == 3  ? 'checked' : ''}}>健康告知について
        <input type="radio" name="trouble_type" value="4" {{ old('trouble_type', $target_post->trouble_type) == 4  ? 'checked' : ''}}>営業マンにおすすめされた保険について
        <input type="radio" name="trouble_type" value="5" {{ old('trouble_type', $target_post->trouble_type) == 5  ? 'checked' : ''}}>その他の悩み
    </div>
    <div>
        <label>誰に対する悩み？</label>
        <input type="radio" name="insurance_target" value="1" {{ old('insurance_target', $target_post->insurance_target) == 1  ? 'checked' : ''}}>本人
        <input type="radio" name="insurance_target" value="2" {{ old('insurance_target', $target_post->insurance_target) == 2  ? 'checked' : ''}}>配偶者
        <input type="radio" name="insurance_target" value="3" {{ old('insurance_target', $target_post->insurance_target) == 3  ? 'checked' : ''}}>子供
        <input type="radio" name="insurance_target" value="4" {{ old('insurance_target', $target_post->insurance_target) == 4  ? 'checked' : ''}}>親
        <input type="radio" name="insurance_target" value="5" {{ old('insurance_target', $target_post->insurance_target) == 5  ? 'checked' : ''}}>祖母
        <input type="radio" name="insurance_target" value="6" {{ old('insurance_target', $target_post->insurance_target) == 6  ? 'checked' : ''}}>祖父
        <input type="radio" name="insurance_target" value="7" {{ old('insurance_target', $target_post->insurance_target) == 7  ? 'checked' : ''}}>孫
        <input type="radio" name="insurance_target" value="8" {{ old('insurance_target', $target_post->insurance_target) == 8  ? 'checked' : ''}}>友人
        <input type="radio" name="insurance_target" value="9" {{ old('insurance_target', $target_post->insurance_target) == 9  ? 'checked' : ''}}>その他
    </div>
    <div>
        <label>興味のある保険</label>
        <input type="checkbox" name="interested_insurances[]" value="life" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('life', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>生命保険
        <input type="checkbox" name="interested_insurances[]" value="medical" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('medical', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>医療保険
        <input type="checkbox" name="interested_insurances[]" value="cancer" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('cancer', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>がん保険
        <input type="checkbox" name="interested_insurances[]" value="pension" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('pension', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>年金保険
        <input type="checkbox" name="interested_insurances[]" value="saving" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('saving', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>貯蓄型の保険
        <input type="checkbox" name="interested_insurances[]" value="all_life" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('all_life', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>終身保険
        <input type="checkbox" name="interested_insurances[]" value="home" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('home', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>火災保険
        <input type="checkbox" name="interested_insurances[]" value="other" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('other', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>その他

    </div>
    <textarea name="trouble_content">{{ old('trouble_content', $target_post->trouble_content) }}</textarea>
    <div>
        <input type="submit" value="悩みを共有してアドバイスをもらう">
    </div>
</form>
<br>


@endsection