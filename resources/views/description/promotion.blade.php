@extends('layout')

@section('content')

<div class="container">
<div class="box box-solid box-warning">
<div class="box-header">
<h1 class="box-title">保険のアドバイスをもらうなら「ほけんとーく」</h1>
</div>

<div>

<p class="tag">「ほけんとーく」とは、保険に対する悩みを様々なユーザーからオンライン上でアドバイスをいただき解決のお助けになることを目標とした、保険相談のSNSアプリです。</p>

<div class="tag">
<a href="{{ route('login') }}"><button class="btn btn-warning">ログイン</button></a>
<a href="{{ route('register') }}"><button class="btn btn-primary">今すぐ会員登録(無料)</button></a>
</div>

<h2 class="tag">例えば、こんなお悩みございませんか？</h2>
<ul>
	<li>ライフスタイルが変わったから保険を見直したいけど、保険の窓口だと営業されるのが嫌だな……断るのも申し訳ないしな〜</li>
	<li>保険の相談をしたいけど、保険の営業マンからではなく同じような年齢と性別の人からアドバイスがほしいな……</li>
	<li>保険の営業マンから提案された内容で加入しようか迷っています。他の保険の営業マンに聞いたら、絶対勧誘されるしな〜</li>
	<li>友人に悩みを共有したくないけど、保険の窓口とかで話すのも抵抗ある……</li>
	<li>営業マンの提案が良いのか分からない。様々な人に提案を受けたい。</li>
</ul>

<h2 class="tag">「ほけんとーく」なら解決できます！</h2>
<p class="tag">なぜなら……</p>
<ul>
	<li>しつこい営業を禁止！</li>
	<li>営業マン、FP、一般の人などの様々な方からアドバイスを受けられるため、より納得できる答えを見つけられる</li>
	<li>ほけんとーくは完全無料で利用できます！</li>
	<li>悩みを共有しなくても、チャットで直接オンライン相談することも可能です。人気のユーザーに直接相談してみよう！</li>
	<li>ランキング機能があるため、人気のユーザーや、評価の高いアドバイスを確認することができます。</li>
</ul>
<h2 class="tag">例えば、どんな悩みを投稿できる？</h2>

<p class="tag">・24歳　男性　未婚</p>
<p class="tag">社会人になって、なんとなく、生命保障1000万とがん保険と医療保障に加入しました。月々の支払いが6000円になっております。本当に必要な保障を教えてほしいです。</p>

<p class="tag">・34歳　女性　既婚</p>
<p class="tag">妊娠しました。今から入れる保険とかあるのでしょうか？</p>
<div class="bottom-button">
<a href="{{ route('post.index') }}"><button class="btn btn-warning">まずは、ログインしないで投稿一覧をみる</button></a>
</div>
</div>
</div>
</div>
@endsection
