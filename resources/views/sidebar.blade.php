
<!-- サイドバー -->
<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">

			<!-- メニューヘッダ -->
			<li class="header">メニュー</li>

			<!-- メニュー項目 -->
			<li><a href="{{ route('post.index') }}"><i class="fa fa-home"></i>ホーム</a></li>
			@auth
			<li><a href="{{ route('chat.list', ['id' => auth()->user()->id]) }}"><i class="fa fa-comments"></i>チャット</a></li>
			<li><a href="{{ route('followed_content') }}"><i class="fa fa-users"></i>フォロー者投稿</a></li>
			@endauth
			<li class="treeview">
				<a href="#">
					<i class="fa fa-crown"></i>
					<span>ランキング</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="{{ route('ranking.user') }}">ユーザーごと</a></li>
					<li><a href="{{ route('ranking.comment') }}">コメントごと</a></li>
				</ul>
			</li>
			@auth
			<!-- メニューヘッダ -->
			<li class="header">アカウント設定</li>

			<!-- メニュー項目 -->
			<li><a href="{{ route('profile', ['id' => auth()->user()->id]) }}"><i class="fa fa-user"></i>プロフィール</a></li>
			<li><a href="{{ route('profile.edit_pass', ['id' => auth()->user()->id]) }}"><i class="fa fa-lock"></i>パスワード変更</a></li>
			@endauth
			<!-- メニューヘッダ -->
			<li class="header">ほけんとーくからのお知らせ</li>

			<!-- メニュー項目 -->
			<li><a href="{{ route('contact.contact') }}"><i class="fa fa-envelope"></i>お問い合わせ</a></li>
			@guest
			<li><a href="{{ route('LP') }}"><i class="fa fa-sticky-note"></i>ほけんとーくとは</a></li>
			@endguest
			<li><a href="{{ route('prohibition') }}"><i class="fa fa-ban"></i>禁止事項</a></li>

		</ul>
	</section>
</aside><!-- end sidebar -->
