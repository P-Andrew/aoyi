@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="{{route('user')}}" class="navbar-item navbar-color">
			<i class="back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">发票</span>
		</div>
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<img src="{{asset('starm/images/xiaoxi.png')}}" width="18">
		</a>
	</header>
	<div class="g-scrollview">
			<div class="m-cell">
			    <a class="cell-item" href="{{route('application')}}">
			        <div class="cell-left">申请开票</div>
			        <div class="cell-right cell-arrow"> </div>
			    </a>
			    <a class="cell-item" href="javascript:;">
			        <div class="cell-left">开票历史</div>
			        <div class="cell-right cell-arrow"></div>
			    </a>
			</div>


	</div>
</section>
@include('home.footer')
