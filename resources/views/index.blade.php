<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>保険のアドバイスをもらうならほけんとーく</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('/img/favicon.ico') }}" rel="icon">
  <link href="{{ asset('/img/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
  <link href="{{ asset('/img/android-touch-icon.png') }}" type="image/png" rel="icon" sizes="192x192">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VJLLPCBFCQ"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'G-VJLLPCBFCQ');
</script>

  <!-- Template Main CSS File -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: SoftLand - v2.2.1
  * Template URL: https://bootstrapmade.com/softland-bootstrap-app-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Mobile Menu ======= -->
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <!-- ======= Header ======= -->
  <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-lg-2" style="padding-right: 0px;">
          <h1 class="mb-0 site-logo"><a href="{{ route('index') }}" class="mb-0">ほけんとーく</a></h1>
        </div>

        <div class="col-12 col-md-10 d-none d-lg-block">
          <nav class="site-navigation position-relative text-right" role="navigation">

            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
              <li><a href="#anchor1" class="nav-link">ほけんとーくの特徴</a></li>
              <li><a href="#anchor2" class="nav-link">ほけんとーくの使い方</a></li>
              <li><a href="#anchor3" class="nav-link">お悩みの例</a></li>

              <li><a href="{{ route('contact.contact') }}" class="nav-link">お問い合わせ</a></li>
              <li><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
            </ul>
          </nav>
        </div>

        <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">

          <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>
        </div>

      </div>
    </div>

  </header>

  <!-- ======= Hero Section ======= -->
  <section class="hero-section" id="hero">

    <div class="wave">

      <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
            <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
          </g>
        </g>
      </svg>

    </div>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 hero-text-image">
          <div class="row">
            <div class="col-lg-7 text-center text-lg-left top-login">
              <h2 data-aos="fade-right" style="color: #fff;">保険のアドバイスを<br class="br-sp">もらうなら</h2>
              <h1 data-aos="fade-right">「ほけんとーく」</h1>
              <p class="mb-5" data-aos="fade-right" data-aos-delay="100">「ほけんとーく」とは、保険に対する悩みを様々なユーザーからオンライン上でアドバイスをいただき<br class="br-pc">解決のお助けになることを目標とした、保険相談のSNSアプリです。</p>
              <p data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500"><span><a href="{{ route('login') }}" class="btn btn-outline-white">ログイン</a></span><span><a href="{{ route('register') }}" class="btn btn-outline-white ml-3">会員登録(無料)</a></span></p>
            </div>
            <div class="col-lg-5 iphone-wrap">
              <img src="{{ asset('/img/mockup2.png') }}" alt="Image" class="phone-1" data-aos="fade-right">
              <img src="{{ asset('/img/mockup1.png') }}" alt="Image" class="phone-2" data-aos="fade-right" data-aos-delay="200">
            </div>
          </div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Home Section ======= -->
    <section class="section">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-5" data-aos="fade-up">
            <h2 class="section-heading" id="anchor1">ほけんとーくの特徴</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-users"></span>
              </div>
              <h3 class="mb-3">しつこい営業を禁止！</h3>
              <p>ほけんとーくでは保険の勧誘にありがちなしつこい営業を禁止しています。</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-toggle-off"></span>
              </div>
              <h3 class="mb-3">誰でも参加可能◎</h3>
              <p>アドバイスをくれるのは営業マン、ファイナンシャルプランナー、一般の人など</br>多岐に渡ります</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-umbrella"></span>
              </div>
              <h3 class="mb-3">ランキング機能</h3>
              <p>人気のユーザーや評価の高いアドバイスを確認できます</br>チャットで直接相談してみよう！</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-users"></span>
              </div>
              <h3 class="mb-3">チャット機能</h3>
              <p>悩みを共有しなくても、チャットで直接相談することも可能です。<br>人気のユーザーに直接相談してみよう！</p>
            </div>
          </div>
          <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon la la-toggle-off"></span>
              </div>
              <h3 class="mb-3">コストなし</h3>
              <p>ほけんとーくは完全無料で利用できます！</p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="section">

      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8" data-aos="fade-up">
            <h2 class="section-heading" id="anchor2">ほけんとーくの<br class="br-sp">使い方</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center mb-5" data-aos="fade">
          <div class="col-md-6 mb-5">
            <img src="{{ asset('/img/undraw_svg_5.svg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="step step-pb">
              <span class="number">01</span>
              <h3>会員登録する</h3>
              <p>会員登録に必要なのは、お名前・メールアドレス・パスワードの設定のみです。会員登録をしなくても見ることが出来るページもあります。</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="step">
              <span class="number">02</span>
              <h3>プロフィール欄を入力する</h3>
              <p>プロフィールでは、家族構成や入っている保険などを登録することが出来ます。プロフィール欄を充実させると、あなたの状況に合ったより詳しいアドバイスを受けることが出来ます。</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="step step-pb">
              <span class="number">03</span>
              <h3>使ってみよう</h3>
              <p>保険の悩みを投稿したり、チャット機能を使ってみましょう。ランキング機能もあるので、人気の人に直接メッセージを送ることもできます。</p>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- ======= Testimonials Section ======= -->
    <section class="section border-top border-bottom">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-8">
            <h2 class="section-heading" id="anchor3">どんな悩みを<br class="br-sp">投稿できる？</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-7">
            <div class="owl-carousel testimonial-carousel">
              <div class="review text-center">
                <h3>例 その１</h3>
                <blockquote>
                  <p>妊娠しました。今から入れる保険とかあるのでしょうか？</p>
                </blockquote>

                <p class="review-user">
                  <img src="{{ asset('/img/person_1.jpg') }}" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">34歳 女性 既婚</span>, &mdash; App User
                  </span>
                </p>

              </div>

              <div class="review text-center">
                <h3>例 その２</h3>
                <blockquote>
                  <p>社会人になって、なんとなく、生命保障1000万とがん保険と医療保障に加入しました。<br>月々の支払いが6000円になっております。本当に必要な保障を教えてほしいです。</p>
                </blockquote>

                <p class="review-user">
                  <img src="{{ asset('/img/person_2.jpg') }}" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">24歳 男性 未婚</span>, &mdash; App User
                  </span>
                </p>

              </div>

              <div class="review text-center">
                <h3>例 その３</h3>
                <blockquote>
                  <p>29歳女性ですが、がんの保証は必要でしょうか？<br>もし必要なら、いくらくらい備えておけばよろしいでしょうか？</p>
                </blockquote>

                <p class="review-user">
                  <img src="{{ asset('/img/person_3.jpg') }}" alt="Image" class="img-fluid rounded-circle mb-3">
                  <span class="d-block">
                    <span class="text-black">29歳 女性 未婚</span>, &mdash; App User
                  </span>
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= CTA Section ======= -->
    <section class="section cta-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 mr-auto text-center text-md-left mb-5 mb-md-0">
            <h2>さあ、始めてみよう！</h2>
          </div>
          <div class="col-md-5 text-center text-md-right">
              <p data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500"><span><a href="{{ route('register') }}" class="btn btn-outline-white">会員登録</a></span><span><a href="{{ route('post.index') }}" class="btn btn-outline-white ml-3">会員登録せずに見る</a></span></p>
          </div>
        </div>
      </div>
    </section><!-- End CTA Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer class="footer" role="contentinfo" style="padding-top: 40px;">
    <div class="container">

      <div class="row justify-content-center text-center">
        <div class="col-md-7">
          <p class="copyright">&copy; 2021 ほけんとーく</p>
          <div class="credits">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=SoftLand
          -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
      </div>

    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('/vendor/jquery-sticky/jquery.sticky.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/js/lp.js') }}"></script>

</body>

</html>
