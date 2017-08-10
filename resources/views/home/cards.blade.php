@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="{{route('user')}}" class="navbar-item navbar-color">
			<i class="back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">礼品卡</span>
		</div>
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<img src="{{asset('starm/images/xiaoxi.png')}}" width="18">
		</a>
	</header>
	<div class="g-scrollview">
		<img src="{{asset('starm/images/banner.png')}}" width="100%">
		<div class="cards_main">
			<b>使用说明</b>
			<p>1、下载“宇元农业”APP，手机验证码直接登录选择菜地，确认后进入付款页</p>
		</div>


	</div>
</section>
@include('home.footer')