@include('home.header')
<body style="background: #fff">
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">自选菜地</span>
		</div>
	</header>
	<img src="{{asset('starm/images/caidi_top_bg.png')}}" width="100%">
	<div class="st_cd_top">
		<div class="st_cd_touxiang"><img src="{{$user->headimgurl}}"></div>
		<h5>{{$house->name}}</h5>
		<p>请选择菜地</p>
		<ul>
			<li><p></p>已售</li>
			<li><p></p>可选</li>
			<li><p></p>不可选</li>
		</ul>
		<img src="{{asset('starm/images/cao.png')}}" width="100%">
	</div>
	<div class="st_cd_box">
		<div class="st_cd_list">
			<div class="swiper-container">

			    <div class="swiper-wrapper">
					@foreach($ground as $item)
						@if($item->able==0)
							<div class="swiper-slide"><div class="cd_list ys"><a href='{{route('radio',['id'=>$item->id])}}'><p><span>{{$item->name}}</span></p></a></div></div>
						@else
							@if($item->status == 0)
							<div class="swiper-slide"><div class="cd_list kx"><a href="{{route('confirmpay',['id'=>$item->id])}}"><p><span>{{$item->name}}</span></p></a></div></div>
							@elseif($item->status == 1)
							<div class="swiper-slide"><div class="cd_list ys"><a href="{{route('radio',['id'=>$item->id])}}"><p><span>{{$item->name}}</span></p></a></div></div>
							@elseif($item->status ==2)
							<div class="swiper-slide"><div class="cd_list bx"><a href="{{route('radio',['id'=>$item->id])}}"><p><span>{{$item->name}}</span></p></a></div></div>
							@endif
						@endif
					@endforeach
					{{--<div class="swiper-slide"><div class="cd_list ys"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list kx"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list kx"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list kx"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list bx"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list bx"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list bx"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list bx"><p><span>1号菜地</span></p></div></div>
			        <div class="swiper-slide"><div class="cd_list bx"><p><span>1号菜地</span></p></div></div>--}}
			    </div>
			    <!-- Add Pagination -->
			</div>

		</div>
	</div>
</section>
@include('home.footer')
<!-- 引入YDUI脚本 -->
<script  src="{{asset('starm/js/swiper.min.js')}}"></script>

<script>
   var swiper = new Swiper('.swiper-container', {
       pagination: '.swiper-pagination',
       paginationClickable: true,
       slidesPerView: 5,
       spaceBetween: 50,
       breakpoints: {
           640: {
               slidesPerView: 6,
               spaceBetween: 0
           },
           320: {
               slidesPerView: 6,
               spaceBetween: 0
           }
       }
   });
   </script>
