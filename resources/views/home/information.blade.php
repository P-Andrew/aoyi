@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="{{route('user')}}" class="navbar-item navbar-color">
			<i class="back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">农场信息</span>
		</div>
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<img src="{{asset('starm/images/xiaoxi.png')}}" width="18">
		</a>
	</header>
	<div class="g-scrollview">
		<div class="m-slider information_banner" data-ydui-slider="{autoplay: 3000}"><!-- 参数在这里 -->
			<div class="slider-wrapper">
				<div class="slider-item">
					<a href="#">
						<img src="{{asset('starm/images/banner.png')}}">
					</a>
				</div>
			</div>
			<p style="position: absolute;bottom:0;z-index: 99;height: 1rem;line-height:1rem;color:#fff;width:100%;background: rgba(000,000,000,.5);    font-size: 0.3rem;text-indent: 0.2rem;">宇元农业（旗舰店）</p>
			<!-- <div class="slider-pagination"></div>分页标识 -->
		</div>
		<div class="m-cell">
		    <div class="cell-item">
		        <div class="cell-left"><i class="icon-location" style="margin-right: 0.2rem;"></i>{{$address}}</div>
		        <div class="cell-right"><a href="tel:{{\App\System::first()->value('server_phone')}}" style="color:#17a636"><i class="icon-phone2"></i></a></div>
		    </div>
		</div>
	</div>
</section>
@include('home.footer')
