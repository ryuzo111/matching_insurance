<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
	<meta charset="utf-8">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>保険のアドバイスをもらうならほけんとーく</title>
	  <!-- Favicons -->
	<link href="{{ asset('/img/favicon.ico') }}" rel="icon">
	<link href="{{ asset('/img/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
	<link href="{{ asset('/img/android-touch-icon.png') }}" type="image/png" rel="icon" sizes="192x192">

	<!-- og設定 -->
	<meta property="og:image" content="{{asset('/img/og.png')}}" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.hoken-talk.net/">
	<meta property="og:title" content="ほけんとーく">
	<meta property="og:site_name" content="ほけんとーく" />
	<meta property="og:description" content="保険のアドバイスをもらうなら「ほけんとーく」" />
	<meta name="twitter:card" content="summary_large_image"/>
	<meta name="twitter:site" content="@yagiyagi44" />
	<meta name="twitter:player" content="@yagiyagi44" />

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-yellow-light.min.css') }}">
	<!-- JS -->
	<script src="{{ asset('js/app.js') }}"></script>
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Date time picker -->
	<link rel="stylesheet" type="text/css" href="{{ asset('../bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}">
	<script type="text/javascript" src="{{ asset('../bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('../bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.ja.min.js') }}"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-VJLLPCBFCQ"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-VJLLPCBFCQ');
	</script>
	<style madia="screen">
		.box, .top-button, .center-block {
			margin-top: 20px;
		}
		.bottom-button {
			margin-left: 10px;
			margin-bottom: 10px;
		}
		.form-group, .tag {
			margin: 10px;
		}
		.container-box {
			padding-left: 10px;
			padding-right: 10px;
		}

		.return-table-responsive {
			padding-left: 10px;
			padding-right: 10px;
			width: 100%;
			overflow-y: hidden;
			overflow-x: auto;
			-ms-overflow-style: -ms-autohiding-scrollbar;
			-webkit-overflow-scrolling: touch;
		}
		.alert-success {
			color: #3c763d !important;
			border-color: #3c763d !important;
		}
		.alert-danger {
			color: #d9534f !important;
			border-color: #d9534f;
		}
		.alert-success, .alert-danger {
			margin:10px;
			background-color: #fff!important;
			border: 2px solid;
		}
	</style>
</head>
<body class="skin-yellow-light">
<div class="wrapper">

<!-- ヘッダー -->
@include('header')

<!-- サイドバー -->
@include('sidebar')

<!-- content -->
<div class="content-wrapper">

@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>

@endif
@if (session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}
</div>
@endif
<!-- コンテンツ -->
@yield('content')
</div>
<!-- end content -->

<!-- フッター -->
@include('footer')

</div><!-- end wrapper -->
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
@yield('js')


</body>
</html>
