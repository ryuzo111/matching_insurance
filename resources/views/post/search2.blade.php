@extends('layout')

@section('content')
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">保険の悩み一覧</h1>
</div>
<div class="container">
	<form  class="horizontal"action="{{ route('post.search') }}" method="GET">
		<div class="form-group">
			<label class="control-label col-xs-2">悩み検索</label>
			<div class="col-xs-5">
				<input type="text" name="word" class="form-control" value="{{ old('word', $request->word) }}">
			</div>
    		<label class="control-label col-xs-2">悩みのタイプ</label>
			<div class="col-xs-10">
				<label type="checkbox-inline">
					<input type="checkbox" name="trouble_type[]" class="form-control" value="1" {{ is_array($request->trouble_type) && in_array(1, $request->trouble_type) ? 'checked' : ''}}>保険加入について
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="trouble_type[]" class="form-control" value="2" {{ is_array($request->trouble_type) && in_array(2, $request->trouble_type) ? 'checked' : ''}}>現在加入の保険について
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="trouble_type[]" class="form-control" value="3" {{ is_array($request->trouble_type) && in_array(3, $request->trouble_type) ? 'checked' : ''}}>健康告知について
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="trouble_type[]" class="form-control" value="4" {{ is_array($request->trouble_type) && in_array(4, $request->trouble_type) ? 'checked' : ''}}>営業マンにおすすめされた保険について
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="trouble_type[]" class="form-control" value="5" {{ is_array($request->trouble_type) && in_array(5, $request->trouble_type) ? 'checked' : ''}}>その他の悩み
			</div>
    		<label class="control-label col-xs-2">誰の？</label>
			<div class="col-xs-10">
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="1" {{ is_array($request->insurance_target) && in_array(1, $request->insurance_target) ? 'checked' : ''}}>本人
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="2" {{ is_array($request->insurance_target) && in_array(2, $request->insurance_target) ? 'checked' : ''}}>配偶者
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="3" {{ is_array($request->insurance_target) && in_array(3, $request->insurance_target) ? 'checked' : ''}}>子供
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="4" {{ is_array($request->insurance_target) && in_array(4, $request->insurance_target) ? 'checked' : ''}}>親
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="5" {{ is_array($request->insurance_target) && in_array(5, $request->insurance_target) ? 'checked' : ''}}>祖母
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="6" {{ is_array($request->insurance_target) && in_array(6, $request->insurance_target) ? 'checked' : ''}}>祖父
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="7" {{ is_array($request->insurance_target) && in_array(7, $request->insurance_target) ? 'checked' : ''}}>孫
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="8" {{ is_array($request->insurance_target) && in_array(8, $request->insurance_target) ? 'checked' : ''}}>友人
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="insurance_target[]" class="form-control" value="9" {{ is_array($request->insurance_target) && in_array(9, $request->insurance_target) ? 'checked' : ''}}>その他
				</label>
			</div>
    		<label class="control-label col-xs-2">保険の種類</label>
			<div class="col-xs-10">
				<label type="checkbox-inline">
    				<input type="checkbox" name="interested_insurances[]" class="form-control" value="life" {{ is_array($request->interested_insurances) && in_array('life', $request->interested_insurances) ? 'checked' : ''}}>生命保険
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="interested_insurances[]" class="form-control" value="medical" {{ is_array($request->interested_insurances) && in_array('medical', $request->interested_insurances) ? 'checked' : ''}}>医療保険
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="interested_insurances[]" class="form-control" value="cancer" {{ is_array($request->interested_insurances) && in_array('cancer', $request->interested_insurances) ? 'checked' : ''}}>がん保険
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="interested_insurances[]" class="form-control" value="pension" {{ is_array($request->interested_insurances) && in_array('pension', $request->interested_insurances) ? 'checked' : ''}}>年金保険
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="interested_insurances[]" class="form-control" value="saving" {{ is_array($request->interested_insurances) && in_array('saving', $request->interested_insurances) ? 'checked' : ''}}>貯蓄型の保険
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="interested_insurances[]" class="form-control" value="all_life" {{ is_array($request->interested_insurances) && in_array('all_life', $request->interested_insurances) ? 'checked' : ''}}>終身保険
				</label>
				<label type="checkbox-inline">
    				<input type="checkbox" name="interested_insurances[]" class="form-control" value="home" {{ is_array($request->interested_insurances) && in_array('home', $request->interested_insurances) ? 'checked' : ''}}>火災保険
				</label>
				<label type="checkbox-inline">
					 <input type="checkbox" name="interested_insurances[]" class="form-control" value="other" {{ is_array($request->interested_insurances) && in_array('other', $request->interested_insurances) ? 'checked' : ''}}>その他
				</label>
    		</div>
    <input name="start_time" type="date" value="{{$request->start_time ?? null}}" placeholder="開始日">
    <i>〜</i>
    <input name="end_time" type="date" value="{{$request->end_time ?? null}}" placeholder="終了日">
    </br>
		<div class="form-group">
			<div class="col-xs-offset-2 col-xs-10">
				<button type="submit" class="btn btn-default">検索する</button>
			</div>
		</div>
	</form>

	<div>
		{{ ($posts->currentPage()-1) * $posts->perPage()+1 }} -
		{{ (($posts->currentPage()-1) * $posts->perPage()+1) + (count($posts)-1) }} 件

		/{{ $posts->total() }} 件を表示しています。
	 </div>

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
		<div class="table-responsive">
			<table class="table table-striped">
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
		</div>
        <p>悩みに対するコメントの数 : {{ count($post->comments) }}</p>

    </div>

    <br>
    <br>

@endforeach
{{ $posts->appends(['word' => $request->word, 'trouble_type' => $request->trouble_type, 'insurance_target' => $request->insurance_target, 'interested_insurances' => $request->interested_insurances, 'start_time' => $request->start_time, 'end_time' => $request->end_time])->links() }}

</div>
</div>
</div>

@endsection
