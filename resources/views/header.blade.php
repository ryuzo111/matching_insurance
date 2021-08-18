
        <!-- トップメニュー -->
        <header class="main-header">

            <!-- ロゴ -->
            <a href="" class="logo"><img src="{{ asset('img/logo.PNG') }}" alt="" style="width: 128px;"></a>

            <!-- トップメニュー -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- メニュー項目 -->
				<!-- サイドバー制御 -->
				<a href="#" class="sidebar-toggle fa5" data-toggle="push-menu" role="button">
         		 <span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav navbar-right">
					@guest
						<li><a href="{{ route('login') }}" style="margin-right: 30px;"><i class="fas fa-sign-in-alt"></i> ログイン</a></li>
					</ul>
					@endguest
					@auth
						<li class="dropdown user user-menu" style="margin-right: 30px;">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								@if (auth()->user()->image_pass)
								<img src="{{ asset('storage/image/' . auth()->user()->image_pass) }}" class="user-image" alt="User Image">
								@else
								<img src="{{ asset('storage/default/default.jpeg') }}" class="user-image" alt="User Image">
								@endif
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs">{{ auth()->user()->name }}</span>
							</a>
							<ul class="dropdown-menu">
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="{{ route('profile', ['id' => auth()->user()->id]) }}" class="btn btn-default btn-flat">プロフィール</a>
									</div>
									<div class="pull-right">
										<form action="{{ asset('logout') }}" method="POST">
											{{ csrf_field() }}
											<button type="submit" class="btn btn-default btn-flat">ログアウト</button>
										</form>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				@endauth
				</div>
            </nav>

        </header><!-- end header -->
