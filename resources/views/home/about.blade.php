@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="{{route('user')}}" class="navbar-item navbar-color">
			<i class="back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">关于</span>
		</div>
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<img src="{{asset('starm/images/xiaoxi.png')}}" width="18">
		</a>
	</header>
	<div class="g-scrollview">
		<div class="about">
			<img src="{{asset('starm/images/logo.png')}}">
			<p> "宇元农业" 宇2017年6月19日正式上线，是一款国内首款支持用户线上完成选地、种菜、视频、收菜、派送等一体化服务的移动客户端。</p>
		</div>
		<div class="m-cell">
		    <div class="cell-item">
		        <div class="cell-left">应用名称</div>
		        <div class="cell-right">宇元农业</div>
		    </div>
		    <div class="cell-item">
		        <div class="cell-left">当前版本</div>
		        <div class="cell-right">V1.0.0</div>
		    </div>
		</div>
	</div>
</section>
@include('home.footer')