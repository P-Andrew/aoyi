@include('home.header')
<body style="background: #fff">
<section class="g-flexview">
	<header class="m-navbar navbar-bg">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">自选菜棚</span>
		</div>

	</header>
	<img src="{{asset('starm/images/caidi_top_bg.png')}}" width="100%">
	<div class="st-grids m-grids-2 caidi-peng">
		@foreach($house as $item)
		<a  href="{{route('site.ground',['id'=>$item->id])}}" class="grids-item">
			@if(count($item->subGround()->whereNotNull('user_id')->get())==count($item->subGround))<p></p>@else <p class="active"></p>@endif
			{{$item->name}}(<em>{{count($item->subGround()->whereNotNull('user_id')->get())}}</em>/{{count($item->subGround)}})
		</a>
		@endforeach

	</div>
</section>
@include('home.footer')

<!-- 引入YDUI脚本 -->
<script src="{{asset('starm/js/ydui.js')}}"></script>

