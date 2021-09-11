@extends('layout')
<style>
	.user-image {
		width: 30px;
		height: 30px;
		border-radius: 50%;
		margin-top: 5px;
	}
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
	<div class="box box-solid box-warning">
		<div class="box-header">
			<h1 class="box-title">検索結果</h1>
		</div>
		<form class="form-horizontal tag" action="{{ route('post.search') }}" method="GET">
			<div class="form-group">
				<label class="control-label col-md-2">悩み検索</label>
				<div class="col-md-10">
					<input type="text" name="word" class="form-control" value="{{ old('word', $request->word) }}">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">カテゴリー</label>
				<div class="col-md-10">
					<div class="checkbox-inline checkbox-top">
						<label>
							<input type="checkbox" name="trouble_type[]" value="1" {{ is_array($request->trouble_type) && in_array(1, $request->trouble_type) ? 'checked' : '' }}>保険加入について
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="trouble_type[]" value="2" {{ is_array($request->trouble_type) && in_array(2, $request->trouble_type) ? 'checked' : '' }}>現在加入の保険について
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="trouble_type[]" value="3" {{ is_array($request->trouble_type) && in_array(3, $request->trouble_type) ? 'checked' : '' }}>健康告知について
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="trouble_type[]" value="4" {{ is_array($request->trouble_type) && in_array(4, $request->trouble_type) ? 'checked' : '' }}>営業マンにおすすめされた保険について
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="trouble_type[]" value="5" {{ is_array($request->trouble_type) && in_array(5, $request->trouble_type) ? 'checked' : '' }}>その他の悩み
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">誰の？</label>
				<div class="col-md-10">
					<div class="checkbox-inline checkbox-top">
						<label>
						<input type="checkbox" name="insurance_target[]" value="1" {{ is_array($request->insurance_target) && in_array(1, $request->insurance_target) ? 'checked' : '' }}>本人
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="insurance_target[]" value="2" {{ is_array($request->insurance_target) && in_array(2, $request->insurance_target) ? 'checked' : '' }}>配偶者
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
						<input type="checkbox" name="insurance_target[]" value="3" {{ is_array($request->insurance_target) && in_array(3, $request->insurance_target) ? 'checked' : '' }}>子ども
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
						<input type="checkbox" name="insurance_target[]" value="4" {{ is_array($request->insurance_target) && in_array(4, $request->insurance_target) ? 'checked' : '' }}>親
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
						<input type="checkbox" name="insurance_target[]" value="5" {{ is_array($request->insurance_target) && in_array(5, $request->insurance_target) ? 'checked' : '' }}>祖母
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
						<input type="checkbox" name="insurance_target[]" value="6" {{ is_array($request->insurance_target) && in_array(6, $request->insurance_target) ? 'checked' : '' }}>祖父
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
						<input type="checkbox" name="insurance_target[]" value="7" {{ is_array($request->insurance_target) && in_array(7, $request->insurance_target) ? 'checked' : '' }}>孫
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
						<input type="checkbox" name="insurance_target[]" value="8" {{ is_array($request->insurance_target) && in_array(8, $request->insurance_target) ? 'checked' : '' }}>友人
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
						<input type="checkbox" name="insurance_target[]" value="9" {{ is_array($request->insurance_target) && in_array(9, $request->insurance_target) ? 'checked' : '' }}>その他
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">ほけんの種類</label>
				<div class="col-md-10">
					<div class="checkbox-inline checkbox-top">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="life" {{ is_array($request->interested_insurances) && in_array('life', $request->interested_insurances) ? 'checked' : '' }}>生命保険
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="medical" {{ is_array($request->interested_insurances) && in_array('medical', $request->interested_insurances) ? 'checked' : '' }}>医療保険
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="cancer" {{ is_array($request->interested_insurances) && in_array('cancer', $request->interested_insurances) ? 'checked' : '' }}>がん保険
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="pension" {{ is_array($request->interested_insurances) && in_array('pension', $request->interested_insurances) ? 'checked' : '' }}>年金保険
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="saving" {{ is_array($request->interested_insurances) && in_array('saving', $request->interested_insurances) ? 'checked' : '' }}>貯蓄型の保険
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="all_life" {{ is_array($request->interested_insurances) && in_array('all_life', $request->interested_insurances) ? 'checked' : '' }}>終身保険
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="home" {{ is_array($request->interested_insurances) && in_array('home', $request->interested_insurances) ? 'checked' : '' }}>火災保険
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="interested_insurances[]" value="other" {{ is_array($request->interested_insurances) && in_array('other', $request->interested_insurances) ? 'checked' : '' }}>その他
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">検索範囲</label>
				<div class="col-md-10 form-inline">
					<input class="form-control" name="start_time" type="date" value="{{ $start_time ?? null }}"> ～
					<input class="form-control" name="end_time" type="date" value="{{ $end_time ?? null }}">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2">
				</div>
				<div class="col-md-10">
					<button type="submit" class="btn btn-warning">検索する</button>
				</div>
			</div>
		</form>
		<div class="row tag">
			<div class="col-xs-12">
			{{ ($posts->currentPage()-1) * $posts->perPage()+1 }} -
			{{ (($posts->currentPage()-1) * $posts->perPage()+1) + (count($posts)-1) }} 件

			/{{ $posts->total() }} 件を表示しています。
			</div>
		 </div>
		<div class="row">
			<div class="col-xs-12">
			@foreach ($posts as $post)
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-1">
							@if ($post->user->image_pass)
								<img src="{{ asset('storage/image/' . $post->user->image_pass)}}" class="user-image" alt="">
							@else
								<img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="">
							@endif
							</div>
							<div class="col-md-3">
								<b><u><a href="{{ route('profile', ['id' => $post->user->id]) }}"> {{ $post->user->name }}</a></u></b>
							</div>
							<div class="col-md-8">
								<p>{{ date('Y年m月d日H時i分', strtotime($post->created_at)) }}</p>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<ul class="tag list-inline">
							<li style="font-size: 20px;"><span class="label label-default">タイトル：{{ $post->title }}</span></li>
							<li style="font-size: 20px;"><span class="label label-default">カテゴリー：{{ config('trouble_type.' . $post->trouble_type) }}</span></li>
							<li style="font-size: 20px;"><span class="label label-default">コメント数：{{ count($post->comments) }}</span></li>
						</ul>
						<div class="return-table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>内容</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{ $post->trouble_content }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-xs-12">
								<p><a class="btn btn-warning" href="{{ route('post.detail', ['post_id' => $post->id]) }}">詳細を見る</a></p>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>
{{ $posts->appends(['word' => $request->word, 'trouble_type' => $request->trouble_type, 'insurance_target' => $request->insurance_target, 'interested_insurances' => $request->interested_insurances, 'start_time' => $request->start_time, 'end_time' => $request->end_time])->links() }}

	</div>
</div>
</div>
<script>
	$(function(){
		$('#datepicker1').datepicker({
			format: 'yyyy/mm/dd',
			language: 'ja',
			todayhighlight: false,
			autoclose: true,
			keyboardNavigation: false
		});
		$('#datepicker2').datepicker({
			format: 'yyyy/mm/dd',
			language: 'ja',
			todayhighlight: false,
			autoclose: true,
			keyboardNavigation: false
		});
	});
</script>

@endsection
