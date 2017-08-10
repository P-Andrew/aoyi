@include('home.header')
<body style="background: #fff">
	<header class="m-navbar">
		<a href="{{route('user')}}" class="navbar-item" style="color: #17a636">
		   <i class="cells-icon icon-ucenter-outline"></i>会员中心
		</a>
		<div class="navbar-center">
			<span class="navbar-title">宇元农场</span>
		</div>
		<div class="navbar-item">
			<a href="{{route('site')}}">
			   选地
			</a>
		</div>
	</header>
	<div class="st-index g-scrollview">
		<div class="st_banner">
			<div class="m-slider" data-ydui-slider="{autoplay: 3000}"><!-- 参数在这里 -->
				<div class="slider-wrapper">
					<div class="slider-item">
						<a href="#">
							<img src="{{asset('starm/images/banner.png')}}">
						</a>
					</div>
					<div class="slider-item">
						<a href="#">
							<img src="{{asset('starm/images/banner-3.png')}}">
						</a>
					</div>
					<div class="slider-item">
						<a href="#">
							<img src="{{asset('starm/images/banner-4.png')}}">
						</a>
					</div>
					<div class="slider-item">
						<a href="#">
							<img src="{{asset('starm/images/banner-5.png')}}">
						</a>
					</div>
				</div>
				<!-- <div class="slider-pagination"></div>分页标识 -->

			</div>
		<!-- 	<div class="st_slider_img"><img src="{{asset('starm/images/banner_img.png')}}" width="100%"></div> -->
		</div>

		<div class="st-grids m-grid-2 sz_btn">
			<a href="{{route('harvest')}}" class="grids-item">
				<p><img src="{{asset('starm/images/s_btn.png')}}"><span class="badge badge-danger"><img src="{{asset('starm/images/ce.png')}}"></span></p>
				收菜
			</a>
			<a href="{{route('showdish')}}" class="grids-item">
				<p><img src="{{asset('starm/images/kc_icon.png')}}"><span class="badge badge-danger"><img src="{{asset('starm/images/ce.png')}}"></span></p>
				看菜
			</a>
			<a class="grids-item"  id="J_Confirm">
			<input type="text" name="xdname" hidden="" id="zcname" value="{{count($userGround)}}" >
				<p><img src="{{asset('starm/images/z_btn.png')}}"><span class="badge badge-danger">{{count($userGround)}}</span></p>
				种菜
			</a>

		</div>
		<!-- <div class="st-grids  m-grids-3 st-index-tit">
			<a href="" class="grids-item">
			   <img src="{{asset('starm/images/tit_left.png')}}" width="100%">
			</a>
			<a href="" class="grids-item">
				宇元农场
			</a>
			<a href="" class="grids-item">
				<img src="{{asset('starm/images/tit_right.png')}}" width="100%">
			</a>
		</div> -->

	</div>


	<div class="st-x-main m-tabbar bottom_main">
		<div class="x-btn-box">
			<input type="text" name="xdname" hidden="" id="xdname" value="2" >
			<a href="{{asset('site')}}"><div class="x-btn">+</div></a>
			选地
		</div>
	</div>

@include('home.footer')
<!-- 引入YDUI脚本 -->
<script src="{{asset('starm/js/ydui.js')}}"></script>
<script>
	!function (win, $) {
		var dialog = win.YDUI.dialog;
		/* 普通确认框 */
		$('#J_Confirm').on('click', function () {
			var hasGround = parseInt($('input[name="xdname"]').val());
			if(hasGround){
                window.location.href='{{route('crop')}}';
			}else{
				dialog.confirm('您还没有菜地，现在去购买菜地', [
					{
					    txt: '取消',
					    color: false, /* false:黑色  true:绿色 或 使用颜色值 */
					    callback: function () {
					    }
					},
				    // {
				    //     txt: '看菜',
				    //     stay: false, /* 是否保留提示框 */
				    //     color: '#000', /* 使用颜色值 */
				    //     callback: function () {
				    //          window.location.href='{{route('showdish')}}';
				    //     }
				    // },
				    {
				        txt: '买地',
				        color: true,
				        callback: function () {
				            window.location.href='{{route('site')}}';
				        }
				    }
				]);
			}
		});
	}(window, jQuery);
</script>

