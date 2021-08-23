@extends('layout')
<style>
	.label {
		line-height: 2 !important;
		white-space: normal !important;
	}
	.checkbox-top {
		margin-left: 10px;
	}
</style>

@section('content')

<div class="container">
	<div class="top-button">
		<a href="{{ route('post.index') }}"><button class="btn btn-default"><i class="fas fa-backward"> 悩み一覧ページへ戻る</i></button></a>
	</div>
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h1 class="box-title">ほけんの悩み編集</h1>
		</div>
		<form action="{{ route('post.edit', ['post' => $target_post]) }}" method="POST">
    	{{ csrf_field() }}
		<div class="form-group has-feedback {{ $errors->has('title') ? 'has-error' : '' }}">
			<label class="control-label col-md-2">悩みのタイトル</label>
			<div class="col-md-10">
			   <input type="text" class="form-control" name="title" value="{{ old('title', $target_post->title) }}">
			</div>
			@if ($errors->has('title'))
				<span class="help-block">
					<strong>{{ $errors->first('title') }}</strong>
				</span>
			@endif
		</div>
		<div class="form-group has-feedback {{ $errors->has('trouble_type') ? 'has-error' : '' }}">
			<label class="control-label col-md-2">カテゴリー</label>
			<div class="col-md-10">
				<div class="checkbox-inline checkbox-top">
					<label>
						<input class="form-check-input" id="category1" type="checkbox" name="trouble_type" value="1" {{ old('trouble_type', $target_post->trouble_type) == 1  ? 'checked' : ''}}>保険加入について
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="category2" type="checkbox" name="trouble_type" value="2" {{ old('trouble_type', $target_post->trouble_type) == 2  ? 'checked' : ''}}>現在加入の保険について
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="category3" type="checkbox" name="trouble_type" value="3" {{ old('trouble_type', $target_post->trouble_type) == 3  ? 'checked' : ''}}>健康告知について
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="category4" type="checkbox" name="trouble_type" value="4" {{ old('trouble_type', $target_post->trouble_type) == 4  ? 'checked' : ''}}>営業マンにおすすめされた保険について</label>
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="category5" type="checkbox" name="trouble_type" value="5" {{ old('trouble_type', $target_post->trouble_type) == 5  ? 'checked' : ''}}>その他の悩み
					</label>
				</div>
			</div>
			@if ($errors->has('trouble_type'))
				<span class="help-block">
					<strong>{{ $errors->first('trouble_type') }}</strong>
				</span>
			@endif
		</div>
		<div class="form-group has-feedback {{ $errors->has('insurance_target') ? 'has-error' : '' }}">
			<label class="control-label col-md-2">誰の？</label>
			<div class="col-md-10">
				<div class="checkbox-inline checkbox-top">
					<label>
						<input class="form-check-input" id="target1" type="checkbox" name="insurance_target" value="1" {{ old('insurance_target', $target_post->insurance_target) == 1  ? 'checked' : ''}}>本人
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="target2" type="checkbox" name="insurance_target" value="2" {{ old('insurance_target', $target_post->insurance_target) == 2  ? 'checked' : ''}}>配偶者
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="target3" type="checkbox" name="insurance_target" value="3" {{ old('insurance_target', $target_post->insurance_target) == 3  ? 'checked' : ''}}>子ども
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="target4" type="checkbox" name="insurance_target" value="4" {{ old('insurance_target', $target_post->insurance_target) == 4  ? 'checked' : ''}}>親
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="target5" type="checkbox" name="insurance_target" value="5" {{ old('insurance_target', $target_post->insurance_target) == 5  ? 'checked' : ''}}>祖母
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="target6" type="checkbox" name="insurance_target" value="6" {{ old('insurance_target', $target_post->insurance_target) == 6  ? 'checked' : ''}}>祖父
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="target7" type="checkbox" name="insurance_target" value="7" {{ old('insurance_target', $target_post->insurance_target) == 7  ? 'checked' : ''}}>孫
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="target8" type="checkbox" name="insurance_target" value="8" {{ old('insurance_target', $target_post->insurance_target) == 8  ? 'checked' : ''}}>友人
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
					<input class="form-check-input" id="target9" type="checkbox" name="insurance_target" value="9" {{ old('insurance_target', $target_post->insurance_target) == 9  ? 'checked' : ''}}>その他
					</label>
				</div>
			</div>
			@if ($errors->has('insurance_target'))
				<span class="help-block">
					<strong>{{ $errors->first('insurance_target') }}</strong>
				</span>
			@endif
		</div>
		<div class="form-group has-feedback {{ $errors->has('interested_insurances') ? 'has-error' : '' }}">
			<label class="control-label col-md-2">ほけんの種類</label>
			<div class="col-md-10">
				<div class="checkbox-inline checkbox-top">
					<label>
						<input class="form-check-input" id="kinds1"type="checkbox" name="interested_insurances[]" value="life" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('life', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>生命保険
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="kinds2" type="checkbox" name="interested_insurances[]" value="medical" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('medical', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>医療保険
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="kinds3" type="checkbox" name="interested_insurances[]" value="cancer" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('cancer', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>がん保険
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="kinds4" type="checkbox" name="interested_insurances[]" value="pension" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('pension', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>年金保険
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="kinds5" type="checkbox" name="interested_insurances[]" value="saving" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('saving', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>貯蓄型の保険
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="kinds6" type="checkbox" name="interested_insurances[]" value="all_life" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('all_life', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>終身保険
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="kinds7" type="checkbox" name="interested_insurances[]" value="home" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('home', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>火災保険
					</label>
				</div>
				<div class="checkbox-inline">
					<label>
						<input class="form-check-input" id="kinds8" type="checkbox" name="interested_insurances[]" value="other" {{ is_array(old('interested_insurances', $interested_insurance_arr)) && in_array('other', old('interested_insurances', $interested_insurance_arr)) ? 'checked' : ''}}>その他
					</label>
				</div>
			</div>
			@if ($errors->has('interested_insurances'))
				<span class="help-block">
					<strong>{{ $errors->first('interested_insurances') }}</strong>
				</span>
			@endif
		</div>
		<div class = "form-group has-feedback {{ $errors->has('trouble_content') ? 'has-error' : '' }}">
			<label class="control-label col-md-2">内容</label>
			<div class="col-md-10">
			<textarea class = "form-control" name="trouble_content">{{ old('trouble_content', $target_post->trouble_content) }}</textarea>
			@if ($errors->has('trouble_content'))
				<span class="help-block">
					<strong>{{ $errors->first('trouble_content') }}</strong>
				</span>
			@endif
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-warning">編集する</button>
		</div>
		</form>
	</div>
</div>

@endsection
