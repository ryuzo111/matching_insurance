@extends('layout')

@section('content')
<div class="container">
<div class="top-button">
<a href="{{ route('post.index') }}"><button class="btn btn-default"><i class="fas fa-backward"> 保険の悩み一覧ページへ戻る</i></button></a>
</div>
<br>
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">保険の悩み投稿ページ</h1>
</div>
<form action="{{ route('post.create') }}" method="POST">
    {{ csrf_field() }}
	<div class="form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
        <label>悩みのタイトル</label>
		<input type="text" class="form-control" name="title" value={{ old('title') }}>
		@if ($errors->has('title'))
			<span class="help-block">
				<strong>{{ $errors->first('title') }}</strong>
			</span>
		@endif
    </div>
    <div class="form-group has-feedback {{ $errors->has('trouble_type') ? 'has-error' : '' }}">
		<label>どんなタイプの悩み？</label>
	<div class="form-check">
        <input class="form-check-input" type="radio" name="trouble_type" value="1" {{ old('trouble_type') == 1  ? 'checked' : ''}}><label class="form-check-label">保険加入について</label>
        <input class="form-check-input" type="radio" name="trouble_type" value="2" {{ old('trouble_type') == 2  ? 'checked' : ''}}><label class="formcheck-input">現在加入の保険について</label>
        <input class="form-check-input" type="radio" name="trouble_type" value="3" {{ old('trouble_type') == 3  ? 'checked' : ''}}><label class="formcheck-input">健康告知について</label>
        <input class="form-check-input" type="radio" name="trouble_type" value="4" {{ old('trouble_type') == 4  ? 'checked' : ''}}><label class="formcheck-input">営業マンにおすすめされた保険について</label>
        <input class="form-check-input" type="radio" name="trouble_type" value="5" {{ old('trouble_type') == 5  ? 'checked' : ''}}><label class="formcheck-input">その他の悩み</label>
    </div>
		@if ($errors->has('trouble_type'))
			<span class="help-block">
				<strong>{{ $errors->first('trouble_type') }}</strong>
			</span>
		@endif
    </div>
    <div class="form-group has-feedback {{ $errors->has('insurance_target') ? 'has-error' : '' }}">
        <label>誰に対する悩み？</label>
	<div class="form-check">
        <input class="form-check-input" type="radio" name="insurance_target" value="1" {{ old('insurance_target') == 1  ? 'checked' : ''}}><label class="formcheck-label">本人</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="2" {{ old('insurance_target') == 2  ? 'checked' : ''}}><label class="formcheck-label">配偶者</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="3" {{ old('insurance_target') == 3  ? 'checked' : ''}}><label class="formcheck-label">子ども</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="4" {{ old('insurance_target') == 4  ? 'checked' : ''}}><label class="formcheck-label">親</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="5" {{ old('insurance_target') == 5  ? 'checked' : ''}}><label class="formcheck-label">祖母</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="6" {{ old('insurance_target') == 6  ? 'checked' : ''}}><label class="formcheck-label">祖父</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="7" {{ old('insurance_target') == 7  ? 'checked' : ''}}><label class="formcheck-label">孫</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="8" {{ old('insurance_target') == 8  ? 'checked' : ''}}><label class="formcheck-label">友人</label>
        <input class="form-check-input" type="radio" name="insurance_target" value="9" {{ old('insurance_target') == 9  ? 'checked' : ''}}><label class="formcheck-label">その他</label>
    </div>
		@if ($errors->has('insurance_target'))
			<span class="help-block">
				<strong>{{ $errors->first('insurance_target') }}</strong>
			</span>
		@endif
    </div>
    <div class="form-group has-feedback {{ $errors->has('interested_insurances') ? 'has-error' : '' }}">
        <label>興味のある保険(複数回答可)</label>
	<div class="form-check">
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="life" {{ is_array(old('interested_insurances')) && in_array('life', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">生命保険</label>
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="medical" {{ is_array(old('interested_insurances')) && in_array('medical', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">医療保険</label>
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="cancer" {{ is_array(old('interested_insurances')) && in_array('cancer', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">がん保険</label>
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="pension" {{ is_array(old('interested_insurances')) && in_array('pension', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">生命保険</label>
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="saving" {{ is_array(old('interested_insurances')) && in_array('saving', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">貯蓄型の保険</label>
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="all_life" {{ is_array(old('interested_insurances')) && in_array('all_life', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">終身保険</label>
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="home" {{ is_array(old('interested_insurances')) && in_array('home', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">火災保険</label>
        <input class="form-check-input" type="checkbox" name="interested_insurances[]" value="other" {{ is_array(old('interested_insurances')) && in_array('other', old('interested_insurances')) ? 'checked' : ''}}><label class="formcheck-label">その他</label>
	</div>
		@if ($errors->has('interested_insurances'))
			<span class="help-block">
				<strong>{{ $errors->first('interested_insurances') }}</strong>
			</span>
		@endif
	</div>
	<div class = "form-group has-feedback {{ $errors->has('trouble_content') ? 'has-error' : '' }}">
        <label>内容</label>
		<textarea class = "form-control" name="trouble_content">{{ old('trouble_content') }}</textarea>
		@if ($errors->has('trouble_content'))
			<span class="help-block">
				<strong>{{ $errors->first('trouble_content') }}</strong>
			</span>
		@endif
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-warning">悩みを共有してアドバイスをもらう</button>
	</div>
</form>
</div>
</div>


@endsection
