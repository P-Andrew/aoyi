@include('home.header')
<body>
<section class="g-flexview">
	<header class="m-navbar">
		<a href="javascript:history.back();" class="navbar-item navbar-color">
			<i class="cells-icon back-ico"></i>返回
		</a>
		<div class="navbar-center ">
			<span class="navbar-title navbar-color">已收获的菜</span>
		</div>
	</header>
	<div class="g-scrollview">
	<div class="st_shoucai_list">
		<div class="m-cell st_shoucai">
			@foreach($vest as $item)
		    <label class="cell-item">
		        <span class="cell-left"><img src="{{$item->dish->thumb}}"></span>
		        <span class="cell-left">X <i>{{$item->vest_num}}</i></span>
		        <label class="cell-right">
					<p>收菜时间:</p>
		            {{$item->created_at}}
		        </label>
		    </label>
			@endforeach
		</div>
	</div>
	</div>
</section>
@include('home.footer')
