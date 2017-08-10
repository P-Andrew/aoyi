@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="{{route('index')}}/" class="navbar-item navbar-color">
			<i class="cells-icon icon-home-outline"></i>
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">个人中心</span>
		</div>
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<img src="{{asset('starm/images/xiaoxi.png')}}" width="18">
		</a>
	</header>
	<div class="g-scrollview">
		<div class="st_user">
			<div class="st_user_info">
				<p><img src="{{$user->headimgurl}}"></p>
				<span>农场名字</span>
			</div>
			<div class="st-grids m-grids-2 sz_btn user_data">
				<a href="{{route('harvestrecord')}}" class="grids-item" >
					<p><img src="{{asset('starm/images/sc_data.png')}}" style="display: inline-block"><span class="badge badge-danger">{{count($farmuser->vest)}}</span></p>
					收菜记录
				</a>
				<a href="{{route('croprecord')}}" class="grids-item"  id="J_Confirm" >
				<input type="text" name="xdname" hidden="" id="zcname" value="2" >
					<p><img src="{{asset('starm/images/zc_data.png')}}" style="display: inline-block"><span class="badge badge-danger">{{count($farmuser->record)}}</span></p>
					种菜记录
				</a>
			</div>
		</div>
		<div class="m-cell">
			<a class="cell-item" href="{{route('orderecord')}}">
			    <div class="cell-left"><i class="cell-icon icon-order"></i>我的订单</div>
			    <div class="cell-right cell-arrow">查看全部订单</div>
			</a>
			<a class="cell-item" href="{{route('package')}}">
				<div class="cell-left"><i class="cell-icon icon-order"></i>我的包裹</div>
				<div class="cell-right cell-arrow"></div>
			</a>
		</div>
		<div class="m-cell">
			<a class="cell-item" href="{{route('cards')}}">
			    <div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-discount"></i></span>宇元礼品卡</div>
			    <div class="cell-right cell-arrow"></div>
			</a>
			<a class="cell-item" href="{{route('invoice')}}">
			    <div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-type"></i></span>发票</div>
			    <div class="cell-right cell-arrow"></div>
			</a>
		<!-- 	<a class="cell-item" href="javascript:;">
			    <div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-share1"></i></span>推荐分享</div>
			    <div class="cell-right cell-arrow"></div>
			</a> -->
			<!-- <a class="cell-item" href="javascript:;">
			    <div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-location"></i></span>地址管理</div>
			    <div class="cell-right cell-arrow"></div>
			</a> -->
			<a class="cell-item" href="{{route('information')}}">
			    <div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-footmark"></i></span>农场信息</div>
			    <div class="cell-right cell-arrow"></div>
			</a>
			<a class="cell-item" href="javascript:;">
				<div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-phone1"></i></span>客服电话</div>
				<div class="cell-right cell-arrow">{{\App\System::first()->value('server_phone')}}</div>
			</a>
		</div>

		<div class="m-cell">
			<a class="cell-item" href="{{route('help')}}">
				<div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-question"></i></span>帮助</div>
				<div class="cell-right cell-arrow"></div>
			</a>
			<a class="cell-item" href="{{route('back')}}">
				<div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-feedback"></i></span>反馈建议</div>
				<div class="cell-right cell-arrow"></div>
			</a>
			<a class="cell-item" href="{{route('about')}}">
				<div class="cell-left"><span class="cell-icon"><i class="cell-icon icon-ucenter-outline"></i></span>关于</div>
				<div class="cell-right cell-arrow"></div>
			</a>
		</div>
	</div>
</section>
@include('home.footer')




